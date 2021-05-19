<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\RejectOrder;
use App\Models\User;
use App\Models\Order;

use Mail;



class MailRejectOrderController extends Controller
{
    // Function to send email to client
    function sendMail(Request $request, $id)
	    {

	     $orders = Order::find($id);
      	 $orders->status = ('Rejected') ;
      	 $orders->save() ;



	     $this->validate($request, [
	      'subject'     =>  'required',
	      'note' 		=>  'required',
	     ]);

	        $data = array(
	            'name'       =>   $request->name,
	            'subject'    =>   $request->subject,
	            'note'  	 =>   $request->note,


	      $email = $request->email;

	     Mail::to($email)->send(new RejectOrder($data));
	     return back()->with('success', 'Replied Successfully!');

	    }


}
