<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//on va ajoyter ici le middleware de laravel. Seuls les personnes connectées puevent accéder à cette page
Route::group(['middleware'=>'auth'],function(){

    Route::resource('qrcodes', 'QrcodeController')->except(['show']);
    
    Route::resource('transactions', 'TransactionController')->except(['show']);

    Route::resource('users', 'UserController');
    
    Route::resource('accounts', 'AccountController')->except(['show']);


    //ici dans cette route le ? à côté de account dit que ce parametre est optionnel. Il risque de retourner une page vide si 
    //le compte n'existe pas.
    Route::get('/accounts/show/{id?}', 'AccountController@show')->name('accounts.show');

    Route::resource('accountHistories', 'AccountHistoriesController');

    //seuls les modérateurs et les admin
    Route::group(['middleware'=>'checkmoderateur'],function(){
    Route::get('/users','UserController@index')->name('users.index');

    });

    //seuls les admins ont accès     
    Route::resource('roles', 'RoleController')->middleware('checkadmin');
    Route::post('/accounts/apply_for_payout','AccountController@apply_for_payout')->name('accounts.apply_for_payout');
    
    Route::post('/accounts/mark_as_paid','AccountController@mark_as_paid')
        ->name('accounts.mark_as_paid')
        ->middleware('checkmoderateur');

    Route::get('/accounts', 'AccountController@index')
        ->name('accounts.index')
        ->middleware('checkmoderateur');
    
    Route::get('/accounts/create', 'AccountController@create')
        ->name('accounts.create')
        ->middleware('checkadmin');
    
    Route::get('/account_histories', 'accountHistoriesController@index')
        ->name('account_histories.index')
        ->middleware('checkmoderateur');
    
    Route::get('/account_histories/create', 'accountHistoriesController@create')
        ->name('account_histories.create')
        ->middleware('checkadmin');
    
    
});

//ici le fait de mettre cette route hors du middleware Auth permet d'y accéder sans s'authentifier

    Route::get('/qrcodes/{id}','QrcodeController@show')->name('qrcodes.show');

    //Le lien http://localhost:8000/pay a été utilisé pour Test Webhook URL afin de configurer l'API
    Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay'); 
//ici c'est la route du callback qui permet de rediriger vers le site de paystack au moment de la transaction.
// ce lien a été utilisé comme localhost:8000/payment/callback au niveau de l'API
    Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
    Route::post('/qrcodes/show_payment_page', 'QrcodeController@show_payment_page')->name('qrcodes.show_payment_page');

    Route::get('/transactions/{id}','TransactionController@show')->name('transactions.show');

    

