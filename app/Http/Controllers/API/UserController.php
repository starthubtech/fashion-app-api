<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller

{

    public $successStatus = 200;
    /**

     * login api

     *

     * @return \Illuminate\Http\Response

     */
    public function login(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){

            $user = Auth::user();

            $success['token'] =  $user->createToken(config('app.name'))->accessToken;

            return response()->json(['success' => $success], $this->successStatus);

        }

        else{

            return response()->json(['error'=>'Unauthorised'], 401);

        }

    }


    /**

     * Register api

     *

     * @return \Illuminate\Http\Response

     */

    public function register(Request $request)

    {

    	$data = $request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'password' => 'required',
			'confirm_password' => 'required|same:password',
    	]);

    	//We don't want to insert confirm_password
    	unset($data['confirm_password']);

        $user = User::create($data);

        $success['token'] =  $user->createToken(config('app.name'))->accessToken;

        $success['name'] =  $user->name;


        return response()->json(['success'=>$success], $this->successStatus);

    }


    /**

     * details api

     *

     * @return \Illuminate\Http\Response

     */

    public function details()

    {

        $user = Auth::user();

        return response()->json(['success' => $user], $this->successStatus);

    }

}