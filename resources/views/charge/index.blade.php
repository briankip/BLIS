@extends("app")

@section("content")
<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumb">
            <li><a href="{!! url('home') !!}"><i class="fa fa-home"></i> {!! trans('menu.home') !!}</a></li>
            <li class="active"><i class="fa fa-database"></i> {!! trans('menu.test-catalog') !!}</li>
            <li class="active"><i class="fa fa-cube"></i> {!! trans_choice('menu.charge', 2) !!}</li>
        </ul>
    </div>
</div>
<div class="conter-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-book"></i> {!! trans_choice('menu.charge', 2) !!} 
                    <span>
                        <a class="btn btn-sm btn-belize-hole" href="{!! url("charge/create") !!}" >
                            <i class="fa fa-plus-circle"></i>
                            {!! trans('action.new').' '.trans_choice('menu.charge', 1) !!}
                        </a>
                        <a class="btn btn-sm btn-carrot" href="#" onclick="window.history.back();return false;" alt="{!! trans('messages.back') !!}" title="{!! trans('messages.back') !!}">
                            <i class="fa fa-step-backward"></i>
                            {!! trans('action.back') !!}
                        </a>                
                    </span>
                </div>
                <div class="card-block">            
                    @if (Session::has('message'))
                        <div class="alert alert-info">{!! Session::get('message') !!}</div>
                    @endif
                    @if($errors->all())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">{!! trans('action.close') !!}</span></button>
                        {!! HTML::ul($errors->all(), array('class'=>'list-unstyled')) !!}
                    </div>
                    @endif
                    <table class="table table-bordered table-sm search-table">
                        <thead>
                            <tr>
                                <th>{!! trans('terms.test_id') !!}</th>
                                <th>{!! trans('terms.current_amount') !!}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($charges as $key => $value)
                            <tr @if(session()->has('active_charge'))
                                    {!! (session('active_charge') == $value->id)?"class='warning'":"" !!}
                                @endif
                                >
                                <td>{!! $value->test_id !!}</td>
                                <td>{!! $value->current_amount !!}</td>
                                
                                <td>

                                <!-- show the test category (uses the show method found at GET /charge/{id} -->
                                    <a class="btn btn-sm btn-success" href="{!! url("charge/" . $value->id) !!}" >
                                        <i class="fa fa-folder-open-o"></i>
                                        {!! trans('action.view') !!}
                                    </a>

                                <!-- edit this test category (uses edit method found at GET /charge/{id}/edit -->
                                    <a class="btn btn-sm btn-info" href="{!! url("charge/" . $value->id . "/edit") !!}" >
                                        <i class="fa fa-edit"></i>
                                        {!! trans('action.edit') !!}
                                    </a>
                                    
                                <!-- delete this test category (uses delete method found at GET /charge/{id}/destroy -->
                                    <button class="btn btn-sm btn-danger delete-item-link"
                                        data-toggle="modal" data-target=".confirm-delete-modal" 
                                        data-id='{!! route('charge.destroy', ['id' => $value->id]) !!}'>
                                        <i class="fa fa-trash-o"></i>
                                        {!! trans('action.delete') !!}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {!! session(['SOURCE_URL' => URL::full()]) !!}
</div>
@endsection
