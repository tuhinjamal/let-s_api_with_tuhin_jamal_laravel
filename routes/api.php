<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\Cncode;
use App\Http\Controllers\Countrylist;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*warnigng!!! you must that you have to modify boot function by place  Schema::defaultStringLength(199); of AppServiceProvider.php */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('/home','App\Http\Controllers\FamilyController@home');
//Route::get('country','App\Http\Controllers\CountryCountryController@country');
Route::get('country',[DeviceController::class,'list']);
Route::get('country/{id?}',[DeviceController::class,'byid']);

//here all of this are for post method
// here {id?} is used to set param / parameter
Route::get('countrycode/{id?}',[Cncode::class,'countrycode']);
Route::post('add',[Cncode::class,'add']);
Route::put('update',[Cncode::class,'update']);
Route::get('search/{name}',[Cncode::class,'search']);
Route::delete('delete/{id}',[Cncode::class,'delete']);

//*************************special for resource controller routing ********************************************************
Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
	Route::apiResource("countrylist",countrylist::class);
	//we secured the resource route by using snactum groum route	
    });


//file upload route is below
Route::post("upload",[FileController::class,'upload']);

//laravel snactum routes is below
Route::post("login",[UserController::class,'index']);