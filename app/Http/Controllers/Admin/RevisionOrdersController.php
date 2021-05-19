<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ReadyOrders;
use App\Models\RevisionOrders;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\Models\Profile;
use App\Models\User;
use App\Models\Order;


use App\Models\Files;

class RevisionOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     //current user
         $paginationEnabled = config('usersmanagement.enablePagination');
        if ($paginationEnabled) {
            $readyOrders = ReadyOrders::where('status', '=', 'To be Revised')->orderBy('id', 'desc')->paginate(config('usersmanagement.paginateListSize'));
        } else { 
           
        }
        return View('pages.admin.OrdersforRevision', compact('readyOrders'));
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

      // $orders = Order::find($id);
       $orders = Order::find($id);
       $orders->status = ('Revision in Progress...');
       $orders->save() ;

       $files = Files::all()->where('order_id','=', $orders->id)->where('Status','=','New');
       $newFiles = Files::all()->where('revision_order_id','=', $orders->id);
       $revision = RevisionOrders::all()->where('order_id','=', $orders->id);

        return view('pages.admin.ShowRevisionOrder', [ 'orders'=>$orders,'revision'=>$revision,'files'=> $files, 'newFiles'=>$newFiles]);
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
