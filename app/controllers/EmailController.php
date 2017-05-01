<?php

class EmailController extends \BaseController {

	public function send()
    {
        $title = Input::get('title');
        $content = Input::get('content');

       	Mail::send('register.mailtemplate', ['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('me@gmail.com', 'Brian');

            $message->to('kim@haha.com');

        });
    }

}
