@extends('layouts.app')

@section('template_title')
  {!! trans('usersmanagement.showing-user', ['name' => $orders->name]) !!}
@endsection



@section('content')

  <div class="container show">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">

        <div class="card">

          <div class="card-header text-white  bg-success ">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              {!! trans('usersmanagement.showing-user-title', ['name' => $orders->category]) !!}
              <div class="float-right">
                <a href="{{ route('operations') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                  <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                  {!! trans('Back to orders') !!}
                </a>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="float-right">
              <h4>
              #Batch: 
              <span class="code"> 
              {{$orders->OUID }}
            </span>
          </h4>
            </div>



            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            @if ($orders->name)

              <div class="col-sm-5 col-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelUserName') }}
                </strong>
              </div>

              <div class="col-sm-12">
                {{ $orders->name }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            @if ($orders->email)

            <div class="col-sm-5 col-6 text-larger">
              <strong>
                {{ trans('usersmanagement.labelEmail') }}
              </strong>
            </div>

            <div class="col-sm-12">
              <span data-toggle="tooltip" data-placement="top" title="{{ trans('usersmanagement.tooltips.email-user', ['operations' => $orders->email]) }}">
                {{ HTML::mailto($orders->email, $orders->email) }}
              </span>
            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            @endif


             @if ($orders->category)

                      <div class="col-sm-5 col-6 text-larger">
                            <strong>
                                {{ trans('Category') }}
                            </strong>
                      </div>

                      <div class="col-sm-12">
                            {{ $orders->category }}
                      </div>

                      <div class="clearfix"></div>
                      <div class="border-bottom"></div>

            @endif

              @if ($orders->topic)

                      <div class="col-sm-5 col-6 text-larger">
                            <strong>
                                {{ trans('Topic') }}
                            </strong>
                      </div>

                      <div class="col-sm-12">
                            {{ $orders->topic }}
                      </div>

                      <div class="clearfix"></div>
                      <div class="border-bottom"></div>

            @endif

              @if ($orders->question)

                      <div class="col-sm-5 col-6 text-larger">
                            <strong>
                                {{ trans('Question') }}
                            </strong>
                      </div>

                      <div class="col-sm-12">
                            {{ $orders->question }}
                      </div>

                      <div class="clearfix"></div>
                      <div class="border-bottom"></div>

            @endif
            <div class="row">
              <div class="col-md-6 col-sm-12 prevInstructions">

              @if ($orders->instructions)
                      <div class="col-sm-12 col-12 text-small">
                            <strong>
                                {{ trans('Previouse Instructions') }}
                            </strong>
                      </div>

                      <div class="col-sm-12">
                            {{ $orders->instructions }}
                      </div>

                 @endif
              </div>
              <div class="col-md-6 col-sm-12 newInstructions">

             @foreach($revision as $revisionOrder)
                      <div class="col-sm-12 col-12 text-small">
                            <strong>
                                {{ trans('Reason for Revision & Instructions') }}
                            </strong>
                      </div>

                      <div class="col-sm-12">
                            {{ $revisionOrder->revisionReason}}
                      </div>

              @endforeach
              </div>

                      <div class="clearfix"></div>
                      <div class="border-bottom"></div>
            </div>
              
                      <div class="clearfix"></div>
                      <div class="border-bottom"></div>


                            <strong>
                                {{ trans('Additional Files') }}
                            </strong>
            <div class="row">
                     

              <div class="col-md-6 col-sm-12">


                            <strong>
                                {{ trans('Previouse Files') }}
                            </strong><br>
                         Click to download: <br>

                       @foreach($files as $file)
                        <tr>
                            <td class=""><a href="{{ url('download', $file->fileName) }}">{{ $file->fileName }}</a>
                            </td><br>
                        </tr>
                        @endforeach
                           
                          
                      </div>
              <div class="col-md-6 col-sm-12">


                            <strong>
                                {{ trans('New Addition Files') }}
                            </strong><br>
                         Click to download: <br>


                      

                       @foreach($newFiles as $newFile)
                        <tr>
                            <td class=""><a href="{{ url('download', $newFile->fileName) }}">{{ $newFile->fileName }}</a>
                            </td><br>
                        </tr>
                        @endforeach
                           
                          
              </div>
            </div>

                      <div class="clearfix"></div>
                      <div class="border-bottom"></div>
                      <b>Requirements & Formatt </b>

                    <div class="row">
                        <div class="col-5">
                             <strong>
                                {{ trans('Pages Required') }}
                            </strong><br>

                              {{ $orders->pages }} Pages

                            
                        </div>

                        <div class="col-5">
                             <strong>
                                {{ trans('Format Required') }}
                            </strong><br>

                             Wring Format:  {{ $orders->format }}
                        </div>
                        <div class="col-2">
                             <strong>
                                {{ trans('Duration: ') }}<br>
                            </strong>
                             
                                {{ $orders->duration }} 
                        </div>

                    
                        
                    </div>
                    
                      <div class="clearfix"></div>
                      <div class="border-bottom"></div>

                    <div class="row">
                        <div class="col-5 float-right">
                             <strong>
                                {{ trans('Submitted On: ') }}<br>
                            </strong>
                              {{ $orders->created_at }}
                        </div>
                        <div class="col-5">
                             <strong>
                                {{ trans('Expected Date: ') }}<br>
                            </strong>

                                {{ $orders->due }}
                        </div>

                           
                         <div class="col-2">
                             <strong>
                                {{ trans('Charges: ') }}<br>
                            </strong>
                             <span class="green">$
                                {{ $orders->pricing }} 
                              .00</span>

                              
                        </div>
                        

                        
                    </div>



                                    

                    <div class="clearfix"></div>
                      <div class="border-bottom"></div>

                    



        

         <div class="row">
          <div class="col-6">
            



             <!--  {!! Form::open(array('route' => ['operations.update', $orders->id], 'method' => 'PUT', 'role' => 'form')) !!}
              {!! csrf_field() !!}
           
                 {!! Form::button( trans('Reject Order'), array('class' => 'btn btn-danger btn-block mb-0 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmReject', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
                               
                        {!! Form::close() !!}
                     -->
            <a class="btn btn-danger btn-block" href="{{ URL::to('reject_order/' . $orders->id . '/edit') }}" data-toggle="tooltip" title="Reply">
              Reject This Order {!! trans('usersmanagement.buttons.replyOrder') !!}
             </a>

          </div>
          <div class="col-6">
             <a class="btn btn-info btn-block" href="{{ URL::to('operations/' . $orders->id . '/edit') }}" data-toggle="tooltip" title="Reply">
              Reply Now {!! trans('usersmanagement.buttons.replyOrder') !!}
             </a>
          </div>
                           
         </div>

           


          </div>

        </div>
      </div>
    </div>
  </div>

  @include('modals.modal-delete')
   @include('modals.modal-save')
   @include('modals.modal-reject')

@endsection


@section('footer_scripts')


    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.check-changed')
    @include('scripts.toggleStatus')

    @include('scripts.reject-modal-script')

@endsection
