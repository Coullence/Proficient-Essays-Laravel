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
                            Editing & Updating Order
                            <div class="pull-right">
                                <a href="{{ url('/active_orders') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back to Dashboard">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Orders
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        {!! Form::open(array('route' => ['Revision.update', $order->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation', 'files'=>true)) !!}


                            {!! csrf_field() !!}

               
                            <div class="form-group">
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('order_id', $order->id, array('id' => 'order_id', 'class' => 'form-control','hidden')) !!}
                                    </div>
                                </div>
                            </div>

               
                            <div class="form-group">
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('OUID', $order->OUID, array('id' => 'OUID', 'class' => 'form-control','hidden' )) !!}
                                    </div>
                                </div>
                            </div>


                        <div class="form-group has-feedback row {{ $errors->has('instructions') ? ' has-error ' : '' }}">
                            {!! Form::label('question', trans('revisionReason'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group ">
                                    {!! Form::textarea('revisionReason', NULL, array('id' => 'revisionReason', 'class' => 'form-control', 'placeholder' => trans('revisionReason'))) !!}


                                    
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="instructions">
                                            <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                        </label>

                                    </div>
                                </div>
                                @if ($errors->has('revisionReason'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('revisionReason') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                      



                         <div class="form-group has-feedback row {{ $errors->has('file') ? ' has-error ' : '' }}">
                            {!! Form::label('file', trans('You can attach a file'), array('class' => 'col-md-3 control-label')); !!}
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



            



                          
                            {!! Form::button(trans('Submit'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
