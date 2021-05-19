<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;


class TrashController extends Controller
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
     * Get Soft Deleted User.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDeletedUser($id)
    {
        $order = User::onlyTrashed()->where('id', $id)->get();
        if (count($order) !== 1) {
            return redirect('/operations/deleted/')->with('error', trans('usersmanagement.errorUserNotFound'));
        }

        return $order[0];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = User::onlyTrashed()->get();

        return View('pages.admin.TrashedOrders', compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = self::getDeletedUser($id);

        return view('usersmanagement.show-deleted-user')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = self::getDeletedUser($id);
        $user->restore();

        return redirect('/users/')->with('success', trans('usersmanagement.successRestore'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = self::getDeletedUser($id);
        $user->forceDelete();

        return redirect('/users/deleted/')->with('success', trans('usersmanagement.successDestroy'));
    }
}
