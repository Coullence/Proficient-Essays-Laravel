
 <style>
         .card{
            padding: 10px;
            margin: 10px;
         }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

       
        </style>

@php

    $levelAmount = 'level';

    if (Auth::User()->level() >= 2) {
        $levelAmount = 'levels';

    }

@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8">
<div class="card">
    <div class="card-header text-white  bg-info @role('admin', true)  @endrole">

        Dashboard

        @role('admin', true)
            <span class="pull-right badge badge-primary" style="margin-top:4px">
                Admin Access
            </span>
        @else
            <span class="pull-right badge badge-warning" style="margin-top:4px">
                User Access
            </span>
        @endrole

    </div>
    <div class="card-body">
        <h2 class="lead">
            Welcome {{ Auth::user()->name }}, </h2>
        <p>
            <em>Thank you</em> for Registering into our writing hub, We are Glad to have you.Here is a Dashboard analysis of your activity. Incase of any issue or enquiry, please feel free to sent us an email.</p>
        <div class="row justify-content-center">
              <a href="{{ url('/makeOrder') }}">
                <button class="btn btn-success "> Place New Order</button>
              </a> 

              <a href="{{ url('/downloads') }}">
                <button class="btn btn-info "> Download Your Ready Papers</button>
              </a> 
              <a href="{{ url('/downloads') }}">
                <button class="btn btn-warning "> Revision Paper</button>
              </a>
        </div>

        <hr>

            <div class="container-fluid">
                <div class="row justify-content-center analysis">
                    <div class="col-md-3 col-sm-12  card">
                        <h5>Active Orders</h5>
                        <br>
                        <h1>{{ $activeOrders->count() }}</h1>

                    </div>

                    
                     <div class="col-md-3 col-sm-12 card">
                        <h5>In Progress</h5>
                        <br>
                        <a href="">
                        <h1>{{ $inProgress->count() }}</h1>
                         </a>
                    </div>
                   
                     <div class="col-md-3 col-sm-12 card">
                        <h5>Rejected Orders</h5>
                        <br>
                        <h1>{{ $rejectedOrders->count() }}</h1>
                    </div>
                </div>
                
            </div>
<hr>

<div class="container-fluid widget">

     @include('panels.Clients.activeOrders')
</div><br>

<div class="container-fluid widget">

     @include('panels.Clients.inProgress')
</div><br>

<div class="container-fluid widget">

     @include('panels.Clients.rejectedOrders')
</div><br>
<div class="container-fluid widget">

     @include('panels.Clients.repliedOrders')
</div><br>
      

</div>

</div>

</div>
<br>
<div class="col-md-4">
    <!-- aside section -->
     @include('panels.profileInfo')
     <br>
     
     @include('panels.Clients.downloads')

</div>
</div>
</div>


