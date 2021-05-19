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

class AdminController extends Controller
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
        $paginationEnabled = config('usersmanagement.enablePagination');
        if ($paginationEnabled) {
            $orders = Order::orderBy('id', 'desc')->where('status', '=', 'New')->paginate(config('usersmanagement.paginateListSize'));
        } else {
           
        }

       

        return View('pages.admin.NewOrders', compact('orders'));
    }


    //functions to render tiles

    ///Functions to update the order status
    public function onView($id){
        //change status to In progress

       $order = Order::find($id);
       $order->status = ('In Progress...') ;
       $order->save() ;

       return redirect('Viewed_Orders', compact('orders'));



    }

    public function onRejected($id){
        //change status to In progress

       $order = Order::find($id);
       $order->status = ('Rejected') ;
       $order->save() ;

       return redirect('Viewed_Orders', compact('orders'))->with('success', trans('Order Rejected Successfully!'));



    }
    public function onReplied(){
        //change status to replied 

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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'                  => 'required|max:255|unique:users|alpha_dash',
                'email'                 => 'required|email|max:255|unique:users',
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                'role'                  => 'required',
            ],
            [
                'name.unique'         => trans('auth.userNameTaken'),
                'name.required'       => trans('auth.userNameRequired'),
                'email.required'      => trans('auth.emailRequired'),
                'email.email'         => trans('auth.emailInvalid'),
                'password.required'   => trans('auth.passwordRequired'),
                'password.min'        => trans('auth.PasswordMin'),
                'password.max'        => trans('auth.PasswordMax'),
                'role.required'       => trans('auth.roleRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();
        $profile = new Profile();

        $user = User::create([
            'name'             => strip_tags($request->input('name')),
            'email'            => $request->input('email'),
            'password'         => Hash::make($request->input('password')),
            'token'            => str_random(64),
            'admin_ip_address' => $ipAddress->getClientIp(),
            'activated'        => 1,
        ]);

        $user->profile()->save($profile);
        $user->attachRole($request->input('role'));
        $user->save();

        return redirect('users')->with('success', trans('usersmanagement.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      // $orders = Order::find($id);
       $orders = Order::find($id);
       $orders->status = ('In Progress...');
       $orders->save() ;

       $files = Files::all()->where('order_id','=', $orders->id);



        return view('pages.admin.ShowOrder', [ 'orders'=>$orders,'files'=> $files]);

        
    }

    public function getFile($filename)
      {
         $file_path = storage_path('uploads') . "/" . $filename;
         return response()->download($file_path);
      }


    /**
     * Reply a particular user
     *It instantiate a  mail transporter
     * @param User $user Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function reply($id)
    {
        $order = Order::find($id);

        return view('pages.admin.Reply', compact('order'));
    }


    /**
     * Reject a particular order
     *It instantiate a  mail transporter
     * @param User $user Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        $order = Order::find($id); 

        return view('pages.admin.rejectOrderEmailForm', compact('order'));
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);

        return view('pages.admin.Reply', compact('order'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User                     $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $orders, $id)
    {
       $orders = Order::find($id);
       $orders->status = ('Rejected') ;
       $orders->save() ;

       return redirect('/Viewed_Orders')->with('success', trans('Order Rejected Successfully!'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
     
           $order = Order::find($id);
           $order->delete();
            

            return redirect('Replied_Orders')->with('success', trans('Order Deleted Successfully!'));




        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }

    /**
     * Method to search the users.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('user_search_box');
        $searchRules = [
            'user_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'user_search_box.required' => 'Search term is required',
            'user_search_box.string'   => 'Search term has invalid characters',
            'user_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = User::where('id', 'like', $searchTerm.'%')
                            ->orWhere('name', 'like', $searchTerm.'%')
                            ->orWhere('email', 'like', $searchTerm.'%')->get();

        // Attach roles to results
        foreach ($results as $result) {
            $roles = [
                'roles' => $result->roles,
            ];
            $result->push($roles);
        }

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
