@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.editing-user', ['name' => $order->name]) !!}
@endsection

@section('template_linked_css')
    <style type="text/css">
        .btn-save,
        .pw-change-container {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                       <div class="card-header text-white  bg-success ">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                #Batch:{{$order->OUID}}
                              <div class="float-right">
                                <a href="{{ route('operations') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                  <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                  {!! trans('Back to orders') !!}
                                </a>
                              </div>
                            </div>
                          </div>
                    <div class="card-body">
                       <!--  url('/reply/'.$order->id) 
 -->
                        {!! Form::open(array('url' => 'rejectOrder/'.$order->id, 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files'=>true)) !!}

                            {!! csrf_field() !!}

                                      <!--Clients Name-->


                            <!--User Email-->

                            <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                                {!! Form::label('Clients Email', trans('forms.create_user_label_email'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('email', $order->email, array('id' => 'email', 'class' => 'form-control','placeholder' => trans('forms.create_user_ph_email'))) !!}
                                        <div class="input-group-append">
                                            <label for="email" class="input-group-text">
                                                <i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!--Subject-->

                               <div class="form-group has-feedback row {{ $errors->has('subject') ? ' has-error ' : '' }}">
                                {!! Form::label('subject', trans('Subject'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group hidd">
                                        {!! Form::text('subject', NULL, array('id' => 'subject', 'class' => 'form-control', 'placeholder' => trans('Subject'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="subject">
                                                <i class="fa fa-fw {{ trans('subject') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('subject'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        

                            <!--Note-->
                                  <div class="form-group has-feedback row {{ $errors->has('instructions') ? ' has-error ' : '' }}">
                            {!! Form::label('Note', trans('Note'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group ">
                                    {!! Form::textarea('note', NULL, array('id' => 'note', 'class' => 'form-control', 'placeholder' => trans('Write a Note to client here.'))) !!}


                                    
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="note">
                                            <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                        </label>

                                    </div>
                                </div>
                                @if ($errors->has('instructions'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                           
                          
                           
                            {!! Form::button(trans('Reject Order'), array('class' => 'btn btn-danger margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                       
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-save')
    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
  @include('scripts.check-changed')
@endsection
