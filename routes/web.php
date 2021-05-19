<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
      //Route::get('/', 'WelcomeController@welcome')->name('welcome');
      //Homepage Route - Redirect based on user role is in controller.
    Route::get('/', ['as' => 'public.home',   'uses' => 'UserController@index']);
    Route::get('/terms', 'TermsController@terms')->name('terms');
});
Route::permanentRedirect('/', '/home');

// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// twostep for Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);


    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/client', ['as' => 'public.client',   'uses' => 'Clients\ClientsController@index']);

     //  Make Order.
    Route::get('/makeOrder', ['as' => 'public.makeOrder',   'uses' => 'Clients\ClientsController@makeOrder']);


  


    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep', 'checkblocked']], function () {


Route::get('getFile/{filename}', ['as' => 'download', 'uses' => 'Clients\ClientsController@getFile']);
Route::get('download_file/{filename}', ['as' => 'download_file', 'uses' => 'Admin\AdminController@getFile']);

Route::get('download_order/{filename}', ['as' => 'download_order', 'uses' => 'UserController@getFile']);


// Search Engine
Route::post('search_ActiveOrders', 'Clients\SearchEngineController@search_Active_Orders')->name('search_ActiveOrders'); 
Route::post('search_RejectedOrders', 'Clients\SearchEngineController@search_Rejected_Orders')->name('search_RejectedOrders'); 
Route::post('search_inProgressOrders', 'Clients\SearchEngineController@search_inProgress_Orders')->name('search_inProgressOrders');

    // Route::resource('update_Profile', 'Clients\ClientProfileController', [
    //     'names' => [
    //         'index'   => 'update_Profile',
    //         'edit'   => 'update_Profile.edit',
    //         'update' => 'update_Profile.update',
    //     ],
    //     'except' => [
    //         'deleted',
    //     ],
    // ]);

// Route::resource('clientUser', 'UsersManagementController', [
//         'names' => [
//             'update' => 'clientUser.update',
//         ],
//         'except' => [
//             'deleted',
//         ],
//     ]);
Route::resource('update_Profile', 'Clients\ClientProfileController', [
        'names' => [

            'index'   => 'update_Profile',
            'edit'   => 'update_Profile.edit',
            'update' => 'update_Profile.update',
        ],
        'except' => [
            'deleted',


        ],
    ]);
    Route::resource('user><s', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'replyOrder' => 'users.replyOrder',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    // Order Routes
 Route::resource('order', 'Clients\ClientsController', [
        'names' => [
            'index'   => 'order',
            'destroy' => 'order.destroy',
            'update'  => 'order.update',

        ],
        'except' => [
            'deleted',
        ],
    ]);
  Route::resource('active_orders', 'Clients\ActiveOrdersController', [
        'names' => [
            'index'   => 'active_orders',
            'destroy' => 'active_orders.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::resource('in_Progress', 'Clients\InProgressController', [
        'names' => [
            'index'   => 'in_Progress',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::resource('rejected_orders', 'Clients\RejectedOrdersController', [
        'names' => [
            'index'   => 'rejected_orders',
            'destroy' => 'rejected_orders.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::resource('replied_orders', 'Clients\RepliedOrdersController', [
        'names' => [
            'index'   => 'replied_orders',
            'destroy' => 'replied_orders.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    Route::resource('Revision', 'Clients\RevisionOrdersController', [
        'names' => [
            'index'   => 'Revision',
            'destroy' => 'Revision.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::resource('downloads', 'Clients\DownlozadsController', [
        'names' => [
            'index'   => 'downloads',
            'destroy' => 'downloads.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
        // Status Changer 
// On Download
    Route::get('onDownload/{id}', ['as' => 'onDownload', 'uses' => 'Clients\OrderStatusController@onDownload']);
// On Approved
    Route::get('onApproved/{id}', ['as' => 'onApproved', 'uses' => 'Clients\OrderStatusController@onApproved']);
// On Revision
    Route::get('onRevision/{id}', ['as' => 'onRevision', 'uses' => 'Clients\OrderStatusController@onRevision']);
// On Canceled
    Route::get('onCancel/{id}', ['as' => 'onCancel', 'uses' => 'Clients\OrderStatusController@onCancel']);


    
 
 
 
 
    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController',
        [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
});

// Registered, activated, and is Admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep', 'checkblocked']], function () {


    Route::get('download/{filename}', ['as' => 'download', 'uses' => 'Admin\AdminController@getFile']);


    //sending reply emails 

    Route::post('reply/{id}', ['as' => 'reply_client/{id}', 'uses' => 'Admin\MailController@sendMail']);
    Route::post('rejectOrder/{id}', ['as' => 'rejectOrder/{id}', 'uses' => 'Admin\MailController@rejectOrderMail']);

    Route::PUT('replyRevisionOrder/{id}', ['as' => 'replyRevisionOrder/{id}', 'uses' => 'Admin\ReadyOrdersController@Update']);


// Admin Search Engine
Route::post('search_ActiveOrders', 'Admin\SearchEngineController@search_Active_Orders')->name('search_ActiveOrders'); 
Route::post('search_RejectedOrders', 'Admin\SearchEngineController@search_Rejected_Orders')->name('search_RejectedOrders'); 
Route::post('search_inProgressOrders', 'Admin\SearchEngineController@search_inProgress_Orders')->name('search_inProgressOrders');

    Route::PUT('update/{id}', ['as' => 'update/{id}', 'uses' => 'Admin\AdminController@update']);



    Route::resource('/users<>/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

     Route::resource('admin', 'Admin\AdminController', [
        'names' => [
            'index'   => 'admin',
            'destroy' => 'admin.destroy',
            'download' => 'admin.getFile',
        ],
        'except' => [
            'deleted',
        ],
    ]);



    Route::resource('orders_for_Revision', 'Admin\RevisionOrdersController', [
        'names' => [
            'index'   => 'orders_for_Revision',
            'destroy' => 'orders_for_Revision.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);



    Route::resource('operations', 'Admin\AdminController', [
        'names' => [
            'index'   => 'operations',
            'replyOrder' => 'operations.replyOrder',
            'destroy' => 'operations.destroy',
            'onRejected'=> 'operations.onRejected',
            'reply' => 'operations.reply',
            'show',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    Route::resource('reject_order', 'Admin\RejectOrderController', [
        'names' => [
            'index'   => 'reject_order',
            'show',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    //Route for Viewed Orders
      Route::resource('Viewed_Orders', 'Admin\ViewedOrdersController', [
        'names' => [
            'index'   => 'Viewed_Orders',
            'destroy' => 'Viewed_Orders.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    //Route for Rejected Orders
      Route::resource('rejectedOrders', 'Admin\RejectedOrdersController', [
        'names' => [
            'index'   => 'Viewed_Orders',
            'destroy' => 'Viewed_Orders.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    //Route for Replied Orders
       Route::resource('Replied_Orders', 'Admin\RepliedOrdersController', [
        'names' => [
            'index'   => 'Replied_Orders',
            'destroy' => 'Replied_Orders.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
           //Submited Orders
       Route::resource('submited_Orders', 'Admin\ReadyOrdersController', [
        'names' => [
            'index'   => 'Replied_Orders',
            'destroy' => 'Replied_Orders.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);




      Route::resource('/order/deleted', 'Admin\TrashController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);



    Route::resource('users><', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'replyOrder' => 'users.replyOrder',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users'); 

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');
});

Route::redirect('/php', '/phpinfo', 301);
