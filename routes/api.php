<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\User\UsersController;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
 */

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    
    //Return json
    return response()->json(['status' => true, 'message' => 'Conexão com API bem sucedida!'], 200);
});



/**
 *
 * Controllers Inside API Folder
 *
 */

Route::prefix('v1')->namespace('API')->group(function ($router) {

     /**
     * Internal API Access NOT Authorization
     */
    Route::get('/status_not_authorization', function () {
        //Return json
        return response()->json(['status' => true, 'token'=> false, 'message' => 'Conexão com API bem sucedida!'], 200);
    });

    //Tutorial Login
    Route::post('/login', 'AuthController@login');
    
    //tutorial
    Route::get('/tutorial', 'Tutorial\TutorialController@getAll');
    Route::get('/tutorial/{id}', 'Tutorial\TutorialController@show');
    Route::post('/tutorial_add', 'Tutorial\TutorialController@add');
    Route::post('/tutorial_update', 'Tutorial\TutorialController@update');
    Route::post('/tutorial_delete', 'Tutorial\TutorialController@destroy');



    /**
    * Internal API Access Authorization
    */

    Route::group(['middleware' => ['token_validation:developer']], function () {

        Route::get('/status_authorization', function () {
            //Return json
            return response()->json(['status' => true, 'token'=> true, 'message' => 'Conexão com API bem sucedida!'], 200);
        });

        
    });
});

