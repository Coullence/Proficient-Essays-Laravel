<?php
namespace App\Http\Controllers\Admin;
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


use App\Mail\ReplyClient;
use App\Mail\NotifyOnOrderPlaced;
use App\Mail\NotifyOnOrderRejected;
use App\Mail\NotifyOnOrderRevision;

use Mail;


use App\Models\ReadyOrders;

class ReadyOrdersController extends Controller
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

    public function index()
    {         //current user
         $paginationEnabled = config('usersmanagement.enablePagination');
        if ($paginationEnabled) {
            $readyOrders = ReadyOrders::orderBy('id', 'desc')->paginate(config('usersmanagement.paginateListSize'));
        } else { 
           
        }
        return View('pages.admin.submitedOrders', compact('readyOrders')); 
        
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
    // public function store(Request $request)
    // {

    //     //get  active user id

    //     $activeUser = \Auth::user(); 

    //     $validator = Validator::make(
    //         $request->all(),
    //         [

    //             'email'         => 'required',
    //             'note'          => 'required',
    //         ],
    //         [

    //             'email.required'         => trans('category is Required!'),
    //             'note.required'         => trans('Note is Required!'),
               
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         return back()->withErrors($validator)->withInput();
    //     }

    //         // $genString = str_random(6);
    //          $genString = bin2hex(random_bytes(3));
           

    //     $readyOrders = ReadyOrders::create([

    //         'OUID' => $genString,
    //         'email'=> strip_tags($request->input('email')),
    //         'note' => strip_tags($request->input('note')),
           

    //     ]);

    //     $readyOrders->save();

    //     return redirect('makeOrder')->with('success', trans('Your Order has been placed succesfully.We will update you as soon as your order is ready.'));

    // }
 

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
        $order = ReadyOrders::find($id);

        return view('pages.admin.replyRevisionOrder', compact('order'));
    }

       public function Ready($id)
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

         $orders = ReadyOrders::find($id);
         $this->validate($request, [
          'email'       =>  'required|email',
          'note'        =>  'required',
          'file'        =>  'required',
         ]);

            $data = array(
                'note'       =>   $request->note,
                'file'       =>   $request->file,
            );
            
            
           // get file
        $destination_path = storage_path('downloads');
        $file = $request->file;
        $filename = $file->getClientOriginalName();
        
        $upload_success = $file->move($destination_path, $filename);
       
        
           $data = array(
                'name'          =>   $request->name,
                'subject'       =>   $request->subject,
                'note'          =>   $request->note,
                'filename'      =>   $filename, 
            );
   
            // email
         $email = $request->email;

         //To send data to database

        $orders->email = $request->input('email');
        $orders->note = strip_tags($request->input('note'));
        $orders->FileName = $filename;
        $orders->Status = ('Replied') ;

        $orders->save() ;

        

         Mail::to($email)->send(new ReplyClient($data));

         return back()->with('success', 'Replied Successfully!');

       
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
