<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\MailController;
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

class ClientsController extends MailController
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

    /*---------------------------------------------------------------------
        Routes for respective pages
    ----------------------------------------------------------------------*/
    //  Homepage Route - Redirect based on user role is in controller.
       public function index()
    {
    

         $orders = Order::all();
       

        return View('pages.Clients.activeOrders', compact('orders'));

    }
    
     //  Make Order.
     public function makeOrder()
    {
        
     $paginationEnabled = config('usermanagement.enablePagination');
        if ($paginationEnabled) {
            $users = User::Userpaginate(config('pages.Clients.paginateListSize'));
        } else {
            $users = User::all();
        }
        $roles = Role::all();

        return View('pages.Clients.makeOrder', compact('users', 'roles'));    
    }
     //  Users' Orders.
     public function activeOrders()
    {
        
  
         $orders = Order::all();
       
        return View('pages.Clients.activeOrders', compact('orders'));    
    }
     //  users Order Status.
     public function orderStatus()
    {
        
     $paginationEnabled = config('pages.Clients.enablePagination');
        if ($paginationEnabled) {
            $users = User::paginate(config('pages.Clients.paginateListSize'));
        } else {
            $users = User::all();
        }
        $roles = Role::all();

        return View('pages.Clients.orderStatus', compact('users', 'roles'));    
     
    }
     //  Rejected Orders.
     public function rejectedOrders()
    {
        
     $paginationEnabled = config('pages.Clients.enablePagination');
        if ($paginationEnabled) {
            $users = User::paginate(config('pages.Clients.paginateListSize'));
        } else {
            $users = User::all();
        }
        $roles = Role::all();

        return View('pages.Clients.rejectedOrders', compact('users', 'roles'));    
    }
        
    
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('usersmanagement.create-user', compact('roles'));
    }

    public function store(Request $request)
    {
        $activeUser = \Auth::user(); 
        $validator = Validator::make(
            $request->all(),
            [

                'topic'         => 'required',
                'question'      => 'required',
                'instructions'  => 'required',
                'pages'         => 'required',
                'format'        => 'required',
                'duration'      => 'required',
                'due'           => 'required',

            ],
            [

                'category.required'      => trans('category is Required!'),
                'topic.required'         => trans('Topic is Required!'),
                'question.required'      => trans('Question is Required!'),
                'instructions.required'  => trans('Instructions are Required!'),
                'pages.required'         => trans('Pages are Required!'),
                'format.required'         => trans('Format is Required!'),
                'due.required'           => trans('Please input your due date!'),
                'duration.required'      => trans('Please input Order duration!'),

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
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
            }else{
                $newPricing = ($budget * 1.0);
            }

             $genString = bin2hex(random_bytes(3));
           

        $order = Order::create([

            'OUID' => $genString,
            'user_id' => $activeUser->id,
            'name' => $activeUser->name,
            'email' => $activeUser->email,
            'phone' => $activeUser->phone,
            'category'=> strip_tags($request->input('category')),
            'topic'=> strip_tags($request->input('topic')),
            'question'=> strip_tags($request->input('question')),
            'instructions'=> strip_tags($request->input('instructions')),
            'pages'=> $request->input('pages'),
            'format'=> $request->input('format'),
            'duration'=> $request->input('duration'),
            'pricing'=> $newPricing,
            'due'=> $request->input('due'),
            // 'file'  =>     $request->file_name = $filename,
            'order_ip_address' => $ipAddress->getClientIp(),

        ]);

        // Call a function to save files to database



        // $order = self::storeFiles($id);
        $order->save();

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
           

        $file = Files::create([

            'order_id' => $order->id,
            'fileName'  =>  $request->file_name = $filename,



        ]);


        $file->save();

    }
}

    // }

$this->sendMailOnOrderPlaced();

        return redirect('makeOrder')->with('success', trans('Your Order has been placed succesfully.We will update you as soon as your order is ready.'));

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

    public function upload_file() {
     $destination_path = storage_path('uploads');
     $files = $request->file('files');
     foreach($files as $file) {
         $validator = Validator::make(
                      [
                          'file' => $file,
                          'extension' => Str::lower($file->getClientOriginalExtension()),
                      ],
                      [
                          'file' => 'required|max:100000',
                          'extension' => 'required|in:jpg,jpeg,bmp,png,doc,docx,zip,rar,pdf,rtf,xlsx,xls,txt, csv'
                      ]
                     );
 
         if($validator->passes()){
             $filename = $file->getClientOriginalName();
             $upload_success = $file->move($destination_path, $filename);
             if ($upload_success) {
                     #if needed, save to your table
                     $attach = new attachments();
                     $attach->file_name = $filename;
                     $attach->mime = $file->getClientMimeType();
                     $attach->save();
             }
         }
     }
  }

     public function getFile($filename)
      {
         $file_path = storage_path('uploads') . "/" . $filename;
         return response()->download($file_path);
      }
}
