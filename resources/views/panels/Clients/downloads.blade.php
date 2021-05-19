<div class="card">
   <div class="card-header text-white  bg-success  @role('admin', true)  @endrole">

            <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i> Your Downloads



    </div>
 

    <div class="card-body">

         



         <ul class="list-group mt-3">
            <li class="list-group-item"> 
                <p>Kindly visit <strong>Download Page</strong> to get all your ready papers and download them. There you got the options to access you paper, Approve, Place for revision or Cancel all with a reason. Click here to be redirected: 
                 <a href="{{ url('/downloads') }}">
                Click here 
              </a>   </p>       
           </li>

       
           
        </ul>



      

    </div>

</div>