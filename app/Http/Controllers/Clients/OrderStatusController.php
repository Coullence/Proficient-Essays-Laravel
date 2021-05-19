<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\MailController;
use App\Models\Profile;
use App\Models\User;
use App\Models\Order;
use App\Models\ReadyOrders;
use App\Traits\CaptureIpTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class OrderStatusController extends MailController
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



     public function onDownload($id)
    {  
         $order = ReadyOrders::find($id);
         $order->status = ('Received') ;
         $order->save();
         return back()->with('success', 'Status Changed!');

    }
     public function onApproved($id)
    {
         $order = ReadyOrders::find($id);
         $order->status = ('Approved') ;
         $order->save();
         return back()->with('success', 'Approved Successfully!');
    }
     public function onRevision($id)
    {
         $order = ReadyOrders::find($id);
         $order->status = ('To be Revised') ;
         $order->save();
         $this->sendMailOnOrderRevision();
         return back()->with('success', 'Submited Successfully!');
    }
     public function onCancel($id)
    {         
         $order = ReadyOrders::find($id);
         $order->status = ('Canceled!') ;
         $order->save();
         return back()->with('success', 'Order Canceled!');
    }










    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
