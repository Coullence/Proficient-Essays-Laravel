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


class SearchEngineController extends Controller
{

  /**
     * Method to search the Active Orders.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search_Active_Orders(Request $request)
    {
                //current user
        $activeUser = \Auth::user();

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

        // $data = Order::orderBy('id', 'desc')->where('user_id', '=', $activeUser->id)->where('status','=','New');

        $result = Order::where('id', 'like', $searchTerm.'%')
                            ->orWhere('OUID', 'like', $searchTerm.'%')
                            ->orWhere('category', 'like', $searchTerm.'%')
                            ->orWhere('topic', 'like', $searchTerm.'%')
                            ->orWhere('pages', 'like', $searchTerm.'%')
                            ->orWhere('format', 'like', $searchTerm.'%')
                            ->orWhere('duration', 'like', $searchTerm.'%')
                            ->orWhere('due', 'like', $searchTerm.'%')->get();

        $results = $result->where('user_id', '=', $activeUser->id)->where('status','=','New');

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }

      /**
     * Method to search the Active Orders.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search_Rejected_Orders(Request $request)
    {
                //current user
        $activeUser = \Auth::user();

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

        // $data = Order::orderBy('id', 'desc')->where('user_id', '=', $activeUser->id)->where('status','=','New');

        $result = Order::where('id', 'like', $searchTerm.'%')
                            ->orWhere('OUID', 'like', $searchTerm.'%')
                            ->orWhere('category', 'like', $searchTerm.'%')
                            ->orWhere('topic', 'like', $searchTerm.'%')
                            ->orWhere('pages', 'like', $searchTerm.'%')
                            ->orWhere('format', 'like', $searchTerm.'%')
                            ->orWhere('duration', 'like', $searchTerm.'%')
                            ->orWhere('due', 'like', $searchTerm.'%')->get();

        $results = $result->where('user_id', '=', $activeUser->id)->where('status','=','Rejected');

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }

      /**
     * Method to search the In progress.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search_inProgress_Orders(Request $request)
    {
                //current user
        $activeUser = \Auth::user();

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

        // $data = Order::orderBy('id', 'desc')->where('user_id', '=', $activeUser->id)->where('status','=','New');

        $result = Order::where('id', 'like', $searchTerm.'%')
                            ->orWhere('OUID', 'like', $searchTerm.'%')
                            ->orWhere('category', 'like', $searchTerm.'%')
                            ->orWhere('topic', 'like', $searchTerm.'%')
                            ->orWhere('pages', 'like', $searchTerm.'%')
                            ->orWhere('format', 'like', $searchTerm.'%')
                            ->orWhere('duration', 'like', $searchTerm.'%')
                            ->orWhere('due', 'like', $searchTerm.'%')->get();

        $results = $result->where('user_id', '=', $activeUser->id)->where('status','=','In Progress...');

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
