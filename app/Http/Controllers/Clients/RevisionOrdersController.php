<?php
namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\MailController;
use App\Models\Profile;
use App\Models\User;
use App\Models\Order;
use App\Models\RevisionOrders;
use App\Models\ReadyOrders;
use App\Models\Files;
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


class RevisionOrdersController extends MailController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
               //current user
        $activeUser = \Auth::user();
        $readyOrders = ReadyOrders::all()->where('email', '=', $activeUser->email);


         $paginationEnabled = config('usersmanagement.enablePagination');
        if ($paginationEnabled) {
            $orders = Order::orderBy('id', 'desc')->where('user_id', '=', $activeUser->id)->where('status','=','Replied')->paginate(config('usersmanagement.paginateListSize'));
        } else { 
           
        }
        return View('pages.Clients.OrdersforRevision', compact('orders','readyOrders')); 
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
        // get order details
        $order = Order::find($id);
        return view('pages.Clients.RevisionForm', compact('order'));
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


         
        $activeUser = \Auth::user(); 

        $validator = Validator::make(
            $request->all(),
            [
                'revisionReason'  => 'required',
                

            ],
            [

                'revisionReason.required'      => trans('Provide Reason for revision!'),
               

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $revisionOrders = RevisionOrders::create([ 


            'OUID' => $request->input('OUID'),
            'user_id' => $activeUser->id,
            'order_id' => $request->input('order_id'),
            'revisionReason'=> strip_tags($request->input('revisionReason')),
            

        ]);

        // Call a function to save files to database



        // $order = self::storeFiles($id);
        $revisionOrders->save();


        $destination_path = storage_path('uploads');
        $files = $request->file('files');
        if($files == 0){


        }
        else{
        foreach($files as $file) {
        $validator = Validator::make(
            $request->all(),
            [
                'file'          => $file,
                'extension'     => Str::lower($file->getClientOriginalExtension()),
            ],
            [
                'file'                   => 'required|max:1',
                'extension'              => 'required|in:jpg,jpeg,bmp,png,doc,docx,zip,rar,pdf,rtf,xlsx,xls,txt, csv'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

           $filename = $file->getClientOriginalName();
           $upload_success = $file->move($destination_path, $filename);
           
           $newStatus="Revision";
        $file = Files::create([

            'order_id' => $request->input('order_id'),
            'revision_order_id' => $revisionOrders->id,
            'fileName'  =>  $request->file_name = $filename,
            'Status' => $newStatus,



        ]);


        $file->save();


    }
}


         $order = ReadyOrders::find($id);
         $order->status = ('To be Revised') ;
         $order->save();

         // call to notify Admin on email

         $this->sendMailOnOrderRevision();
        return redirect('downloads')->with('success', trans('Your Order has been PLaced for Revision succesfully.We will update you as soon as your order is ready.'));
        

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
