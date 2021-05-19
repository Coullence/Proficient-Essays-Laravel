
 <div class="table-responsive users-table">
 <span class="blue" >Active Orders</span>
	<table class="table table-striped table-sm data-table">
	    <caption id="user_count">
	    </caption>
	    <thead class="thead">
	        <tr>
	            <th>{!! trans('#Batch:') !!}</th>
	            <th>{!! trans('category') !!}</th>
	            <th >{!! trans('pages') !!}</th>
	            <th class="hidden-xs">{!! trans('Format') !!}</th>
	            <th class="hidden-xs">{!! trans('Duration') !!}</th>
	            <th class="hidden-xs">{!! trans('Due on') !!}</th>
	            <th class="hidden-xs">{!! trans('Budget') !!}</th>
	            <th>{!! trans('Status') !!}</th>
	        </tr>
	    </thead>
	    <tbody id="users_table">
	        @foreach($activeOrders as $order)
	            <tr>
                   <td> <span class="code">{{$order->OUID}}</span></td>
	               <td>{{$order->category}}</td>
	               <td >{{$order->pages}}</td>
	               <td class="hidden-xs">{{$order->format}}</td>
	               <td class="hidden-xs">{{$order->duration}}</td>
	               <td class="hidden-xs">{{$order->due}}</td>
                   <td class="hidden-xs" > <span class="green"> ${{$order->pricing}}.00</span></td>
	               <td> <span class="badge badge-warning">{{$order->status}}</span></td>
	                                                                                                                                           
	            </tr>
	        @endforeach
	    </tbody>


	</table>
	<a href="active_orders" class="float-right">Explore...</a>
</div>