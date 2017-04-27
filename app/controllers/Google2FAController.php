<?php

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use \ParagonIE\ConstantTime\Base32;

class Google2FAController extends \BaseController {

    /**
     * Show the index page
     *
     * @return Response
     */
    public function index()
    {
        //
        return View::make('2FA.index');
    }


	 /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function enableTwoFactor()
    {
        //generate new secret
        $secret = $this->generateSecret();

        //get user
        $user = Auth::user();

        //encrypt and then save secret
        $user->google2fa_secret = Crypt::encrypt($secret);
        $user->save();

        //generate image for QR barcode
        $imageDataUri = Google2FA::getQRCodeInline(
            Request::getHttpHost(),
            $user->email,
            $secret,
            200
        );

        return View::make('2FA/enableTwoFactor',
            array(
                'image' => $imageDataUri,
                'secret' => $secret)
            ); 
            
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function disableTwoFactor()
    {
        $user = Auth::user();

        //make secret column blank
        $user->google2fa_secret = null;
        $user->save();

        return View::make('2FA.disableTwoFactor');
    }

    /**
     * Generate a secret key in Base32 format
     *
     * @return string
     */
    private function generateSecret()
    {
        $randomBytes = random_bytes(10);

        return Base32::encodeUpper($randomBytes); 
    }
}