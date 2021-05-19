<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Models\Order;
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

class ActiveOrdersController extends Controller
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
    public function index()
    {
        //current user
        $activeUser = \Auth::user();

         $paginationEnabled = config('usersmanagement.enablePagination');
        if ($paginationEnabled) {
            $orders = Order::orderBy('id', 'desc')->where('user_id', '=', $activeUser->id)->where('status','=','New')->paginate(config('usersmanagement.paginateListSize'));
        } else {
           
        }

        return View('pages.Clients.activeOrders', compact('orders')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $orders = Order::find($id);


        $files = Files::all()->where('order_id','=', $orders->id);

        return view('pages.Clients.ShowOrder', [ 'orders'=>$orders,'files'=> $files]);

        
    }

    /**
     * Show the form for editing the specified resource. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $order = Order::find($id);

        return view('pages.Clients.editActiveOrder', compact('order'));
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
        $order = Order::find($id);

        $activeUser = \Auth::user(); 

            $ipAddress = new CaptureIpTrait();
            $pages = $request->input('pages');
            $duration = $request->input('duration');
    
            $budget = ( 10 * $pages);
    
            //initialise condition statement basing on urgency statement
            if( $duration <=  1 ){
                $newPricing = ($budget * 1.5);
            }
            elseif ( $duration <=  6) {
                $newPricing = ($budget * 1.4);
            }elseif ( $duration <=  12) {
                $newPricing = ($budget * 1.3);
            }elseif ( $duration <=  24) {
                $newPricing = ($budget * 1.3);
            }elseif ( $duration <=  36) {
                $newPricing = ($budget * 1.1);
            }else {
                $newPricing = ($budget * 1.0);
            }
           
    
            $order->category = strip_tags($request->input('category'));
            $order->topic = strip_tags($request->input('topic'));
            $order->question = strip_tags($request->input('question'));
            $order->instructions = strip_tags($request->input('instructions'));
            $order->pages = $request->input('pages');
            $order->format = strip_tags($request->input('format'));
            $order->duration = $request->input('duration');
            $order->pricing = $newPricing;
            $order->due = $request->input('due');
    
            $order->save(); 


        return redirect('active_orders')->with('success', trans('Your Order has been updated succesfully.We will update you as soon as your order is ready.'));

    //to save file 

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
else{
           $filename = $file->getClientOriginalName();
           $upload_success = $file->move($destination_path, $filename);
           

        $file = Files::create([

            'order_id'  => $order->id,
            'fileName'  =>  $request->file_name = $filename,



        ]);


        $file->save();
    }

    }
   }


}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
           $order = Order::find($id);
           $order->delete();   

            return redirect('active_orders')->with('success', trans('Order Deleted Successfully!'));
            
        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }
}
