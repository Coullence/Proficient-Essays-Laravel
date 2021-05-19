<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\ReplyClient;
use App\Mail\NotifyOnOrderPlaced;
use App\Mail\NotifyOnOrderRejected;
use App\Mail\NotifyOnOrderRevision;
use App\Mail\RejectOrder;
use App\Models\User;
use App\Models\Order;
use App\Models\ReadyOrders;

use Mail;



class MailController extends Controller
{

    // Function to send email to client
    function sendMail(Request $request, $id)
	    {

	     $orders = Order::find($id);
      	 $orders->status = ('Replied') ;
      	 $orders->save() ;



	     $this->validate($request, [
	      'email'  		=>  'required|email',
	      'note' 		=>  'required',
	      'file' 		=>  'required',
	     ]);

	        $data = array(
	            'note'  	 =>   $request->note,
	            'file'       =>   $request->file,
	        );
	        
	        
	       // get file
        $destination_path = storage_path('downloads');
        $file = $request->file;
        $filename = $file->getClientOriginalName();
        
        $upload_success = $file->move($destination_path, $filename);
       
        
           $data = array(
	            'name'       	=>   $request->name,
	            'subject'    	=>   $request->subject,
	            'note'  	 	=>   $request->note,
	            'filename'      =>   $filename,
	        );
   
	        // email
	     $email = $request->email;

	     //To send data to database

	          $genString = bin2hex(random_bytes(3));


      $readyOrder = ReadyOrders::create([

            'OUID'  		=> $request->OUID,
            'email' 		=> $request->email,
            'note'  		=> $request->note,
	        'fileName'      => $filename,

        ]);
        $readyOrder->save();
           
        

	     Mail::to($email)->send(new ReplyClient($data));

	     return back()->with('success', 'Replied Successfully!');

	    }

	
	 // Function to send Notification on Order PLaced

    function sendMailOnOrderPlaced()
	     {
	     Mail::to('coullence@gmail.com')->send(new NotifyOnOrderPlaced());
	     return back();
	    }
	  // Function to send Notification on Order Rejected

    function sendMailOnOrderRejected()
	     {
	     Mail::to('coullence@gmail.com')->send(new NotifyOnOrderRejected());
	     return back();
	    }
	  // Function to send Notification on Order Revision

    function sendMailOnOrderRevision()
	     {
	     Mail::to('coullence@gmail.com')->send(new NotifyOnOrderRevision());
	     return back();
	    }



	        // Function to send email to client
    function rejectOrderMail(Request $request, $id)
	    {


	     $orders = Order::find($id);
      	 $orders->status = ('Rejected') ;
      	 $orders->save();



	     $this->validate($request, [
	      'name'     	=>  'required',
	      'email'  		=>  'required|email',
	      'subject'     =>  'required',
	      'note' 		=>  'required',
	     ]);

	        $data = array(
	            'name'       =>   $request->name,
	            'subject'    =>   $request->subject,
	            'note'  	 =>   $request->note,
	        );


	      $email = $request->email;

	     Mail::to($email)->send(new RejectOrder($data));
	     return back()->with('success', 'Replied Successfully!');
	     

	    }
}
