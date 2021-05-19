<div class="card">
   <div class="card-header text-white  bg-success  @role('admin', true)  @endrole">

            <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i> Your Profile Info



    </div>
 

    <div class="card-body">

         <img src="{{ Gravatar::get(Auth::user()->email) }}" alt="{{Auth::user()->name }}" class="user-avatar">
         <hr>



         <ul class="list-group mt-3">
            <li class="list-group-item">
               <label> Username:</label>
               <p> {{ Auth::user()->name }}</p>
               </li>
            <li class="list-group-item">
                <label>Email:</label> 
                <p> {{ Auth::user()->email }}</p>
                </li>
            <li class="list-group-item">
                <label>Registered On:</label>
                <p> {{ Auth::user()->created_at}}</p>
                </li>
            <li class="list-group-item">
                <label>Updated On:</label>
                <p>{{ Auth::user()->updated_at}}</p>
                </li>
        </ul>

          <a class="float-right" href="{{ URL::to('update_Profile/' . Auth::user()->id . '/edit') }}" data-toggle="tooltip" title="Update Profile">
                                                    {!! trans('Update Profile') !!}
                                                </a>
                      
       


      

    </div>

</div>