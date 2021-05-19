@extends('layouts.app')

@section('template_title')
    Bind an Order
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            Place an Order
                            <div class="pull-right">
                                <a href="{{ url('/') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back to Dashboard">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        {!! Form::open(array('route' => 'order.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files'=>true)) !!}

                            {!! csrf_field() !!}
               
                            <div class="form-group has-feedback row {{ $errors->has('category') ? ' has-error ' : '' }}">
                                {!! Form::label('category', trans('Category'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group hidd">
                                        {!! Form::text('category', NULL, array('id' => 'category', 'class' => 'form-control', 'placeholder' => trans('Category'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="category">
                                                <i class="fa fa-fw {{ trans('category') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group has-feedback row {{ $errors->has('topic') ? ' has-error ' : '' }}">
                                {!! Form::label('topic', trans('Topic'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group hidd">
                                        {!! Form::text('topic', NULL, array('id' => 'topic', 'class' => 'form-control', 'placeholder' => trans('Topic'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="category">
                                                <i class="fa fa-fw {{ trans('topic') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('topic'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('topic') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                           <div class="form-group has-feedback row {{ $errors->has('question') ? ' has-error ' : '' }}">
                            {!! Form::label('question', trans('Question'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group ">
                                    {!! Form::text('question', NULL, array('id' => 'question', 'class' => 'form-control', 'placeholder' => trans('Question'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="question">
                                            <i class="fa fa-fw {{ trans('topic') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('question'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('instructions') ? ' has-error ' : '' }}">
                            {!! Form::label('question', trans('Instructions'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group ">
                                    {!! Form::textarea('instructions', NULL, array('id' => 'instructions', 'class' => 'form-control', 'placeholder' => trans('Instructions'))) !!}


                                    
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="instructions">
                                            <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                        </label>

                                    </div>
                                </div>
                                @if ($errors->has('instructions'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('instructions') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                      

                         <div class="form-group has-feedback row {{ $errors->has('file') ? ' has-error ' : '' }}">
                            {!! Form::label('file', trans('Append a file'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group ">

                                    {!! Form::file('files[]', array('multiple'=>true),'file', NULL, array('id' => 'file', 'class' => 'form-control', 'placeholder' => trans('Additional file instructions'))) !!}
                                </div>
                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group has-feedback row {{ $errors->has('pages') ? ' has-error ' : '' }}">
                            {!! Form::label('pages', trans('Pages'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group ">
                                    {!! Form::number('pages', NULL, array('id' => 'pages', 'class' => 'form-control', 'placeholder' => trans('Pages'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="pages">
                                            <i class="fa fa-fw {{ trans('count') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('pages'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pages') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group has-feedback row {{ $errors->has('format') ? ' has-error ' : '' }}">
                            {!! Form::label('format', trans('Writing Format'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group ">
                                    {!! Form::text('format', NULL, array('id' => 'format', 'class' => 'form-control', 'placeholder' => trans('Writing Format'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="format">
                                            <i class="fa fa-fw {{ trans('count') }}" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('format'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('format') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group has-feedback row {{ $errors->has('duration') ? ' has-error ' : '' }}">
                            {!! Form::label('duration', trans('Duration'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group ">
                                    {!! Form::text('duration', NULL, array('id' => 'due', 'class' => 'form-control', 'placeholder' => trans('Duration'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="duration">
                                            <i class="fa fa-fw fa-date fa-rotate-90" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('duration'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('duration') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('due') ? ' has-error ' : '' }}">
                            {!! Form::label('due', trans('Due Date'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group ">
                                    {!! Form::date('due', NULL, array('id' => 'due', 'class' => 'form-control', 'placeholder' => trans('Due date'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="due">
                                            <i class="fa fa-fw fa-date fa-rotate-90" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('due'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('due') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                          
                            {!! Form::button(trans('Place Order'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
