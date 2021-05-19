@extends('layouts.app')

@section('template_title')
  {!! trans('usersmanagement.showing-user', ['name' => $orders->name]) !!}
@endsection



@section('content')

  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">

        <div class="card">

          <div class="card-header text-white  bg-success ">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              {!! trans('usersmanagement.showing-user-title', ['name' => $orders->category]) !!}
              <div class="float-right">
                <a href="{{ route('active_orders') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                  <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                  {!! trans('Back to orders') !!}
                </a>
              </div>
            </div>
          </div>

          <div class="card-body">

            <div class="row">
             
              
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
              @if ($orders->instructions)

                      <div class="col-sm-12 col-12 text-small">
                            <strong>
                                {{ trans('Additional Information') }}
                            </strong>
                      </div>

                      <div class="col-sm-12">
                            {{ $orders->instructions }}
                      </div>

                      <div class="clearfix"></div>
                      <div class="border-bottom"></div>

            @endif
              

                      <div class="col-sm-5 col-6 text-larger">
                            <strong>
                                {{ trans('Additional Files') }}
                            </strong>
                      </div>

                      <div class="col-sm-12">
                         Click to download: <br>


                      

                       @foreach($files as $file)
                        <tr>
                            <td class=""><a href="{{ url('download_file', $file->fileName) }}">{{ $file->fileName }}</a>
                            </td><br>
                        </tr>
                        @endforeach
                           
                          
                      </div>

                      <div class="clearfix"></div>
                      <div class="border-bottom"></div>

          






                      <div class="border-bottom"></div>
                      <b>Requirements & Formatt </b>

                    <div class="row">
                        <div class="col-6">
                             <strong>
                                {{ trans('Pages Required') }}
                            </strong><br>

                              {{ $orders->pages }} Pages

                            
                        </div>

                        <div class="col-6">
                             <strong>
                                {{ trans('Format Required') }}
                            </strong><br>

                             Wring Format:  {{ $orders->format }}
                        </div>

                    
                        
                    </div>
                    
                      <div class="clearfix"></div>
                      <div class="border-bottom"></div>

                    <div class="row">
                        <div class="col-5 float-right">
                             <strong>
                                {{ trans('Submitted On: ') }}
                            </strong>
                              {{ $orders->created_at }}
                        </div>
                        <div class="col-5">
                             <strong>
                                {{ trans('Expected Date: ') }}
                            </strong>

                                {{ $orders->due }}
                        </div>

                           
                         <div class="col-2 float-right">
                             <strong>
                                {{ trans('Duration: ') }}
                            </strong>
                             
                                {{ $orders->duration }} 
                        </div>
                        

                        
                    </div>



                                    

                    <div class="clearfix"></div>
                      <div class="border-bottom"></div>

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
