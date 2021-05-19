<?php

namespace App\Http\Controllers;

use Auth;

use App\Models\Order;
use App\Models\ReadyOrders;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $activeUser = \Auth::user();

        // For Admin only

        $Admin_newOrders = Order::all()->where('status','=','New');
        $Admin_inProgress = Order::all()->where('status','=','In Progress...');
        $Admin_repliedOrders = Order::all()->where('status','=','Replied');
        $Admin_rejectedOrders = Order::all()->where('status','=','Rejected');
// for client
        $activeOrders = Order::all()->where('user_id', '=', $activeUser->id)->where('status','=','New');
        $inProgress = Order::all()->where('user_id', '=', $activeUser->id)->where('status','=','In Progress...');
        $repliedOrders = Order::all()->where('user_id', '=', $activeUser->id)->where('status','=','Replied');
        $rejectedOrders = Order::all()->where('user_id', '=', $activeUser->id)->where('status','=','Rejected');

        $readyOrders = ReadyOrders::all()->where('email', '=', $activeUser->email);

        //configure table analysis
         // $orders = Order::orderBy('id', 'desc')->where('user_id', '=', $activeUser->id)->where('status','=','New');


        // $activeOrders = Order

        //fetch all models regarding admin
        

        if ($user->isAdmin()) {
            return view('pages.admin.home', compact('Admin_newOrders','Admin_inProgress','Admin_repliedOrders','Admin_rejectedOrders'));
        }

        return view('pages.Clients.home', compact('activeOrders','inProgress','rejectedOrders','repliedOrders','readyOrders'));
    }

        public function getFile($filename)
      {
         $file_path = storage_path('downloads') . "/" . $filename;
         return response()->download($file_path);
      }
}
