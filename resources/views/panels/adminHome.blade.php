
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
            Welcome <b>{{ Auth::user()->name }},</b> </h2>
        <p>
           Welcome, You logged in as <b><em>Admin</em></b> . Here is a Dashboard analysis for recent activities & requests.
        <hr>

            <div class="container-fluid">
                <div class="row justify-content-center analysis">
                    <div class="col-md-2 col-sm-12  card">
                        <h5>New Orders</h5>
                        <br>
                        <h1>{{ $Admin_newOrders->count() }}</h1>

                    </div>

                    
                     <div class="col-md-2 col-sm-12 card">
                        <h5>In Progress</h5>
                        <br>
                      
                        <h1>{{ $Admin_inProgress->count() }}</h1>
                         
                    </div>

                     <div class="col-md-2 col-sm-12 card">
                        <h5>Replied Orders</h5>
                        <br>
                        <h1>{{ $Admin_repliedOrders->count() }}</h1>
                    </div>
                   
                     <div class="col-md-2 col-sm-12 card">
                        <h5>Rejected Orders</h5>
                        <br>
                        <h1>{{ $Admin_rejectedOrders->count() }}</h1>
                    </div>
                </div>
                     <div class="row justify-content-center">
              <a href="{{ url('/operations') }}">
                <button class="btn btn-success ">New Orders</button>
              </a> 

              <a href="{{ url('/orders_for_Revision') }}">
                <button class="btn btn-info "> Orders For Revision</button>
              </a> 
              <a href="{{ url('/Replied_Orders') }}">
                <button class="btn btn-warning "> Replied Orders</button>
              </a>
        </div>
                
            </div>
<hr>

<div class="container-fluid widget">

     @include('panels.Admin.newOrders')
</div><br>

<div class="container-fluid widget">

     @include('panels.Admin.inProgress')
</div><br>

<div class="container-fluid widget">

     @include('panels.Admin.rejectedOrders')
</div><br>

<div class="container-fluid widget">

     @include('panels.Admin.Replied_Orders')
</div><br>
      

    </div>

</div>

</div>
<br>
<div class="col-md-4">
    <!-- aside section -->
     @include('panels.profileInfo')

</div>
</div>
</div>


