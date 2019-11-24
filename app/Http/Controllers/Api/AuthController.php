<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class AuthController extends Controller 
{
	 public $successStatus = 200;
	 
	 /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
	 public function register(Request $request) {    
	 $validator = Validator::make($request->all(), 
	              [ 
	              'name' => 'required',
	              'email' => 'required|email',
	              'password' => 'required',  
	              'c_password' => 'required|same:password', 
	             ]);   
	 if ($validator->fails()) {

	 return response()->json(['error'=>$validator->errors()], 401);   
	 }    

	 $input = $request->all();  
	 $input['password'] = bcrypt($input['password']);


	$user = User::where('email', $input['email'])->first();
    if (is_null($user)) { 
    $user = User::create($input); 
	 $success['token'] =  $user->createToken('AppName')->accessToken;
	 return response()->json(['success'=>$success], $this->successStatus);  
    }else{
    	return response()->json(['error'=>'Email alread exists.']);
    }

	 
	}
	  
	/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */   
	public function login(){ 
	if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
	   $user = Auth::user(); 
	   $success['token'] =  $user->createToken('AppName')-> accessToken; 
	    return response()->json(['success' => $success], $this-> successStatus); 
	  } else{ 
	   return response()->json(['error'=>'Unauthorised, Email or password is incorrect.'], 401); 
	   } 
	}

	// public function logout(Request $request)
	// {
	//     $user = Auth::guard('api')->user();

	//     if ($user) {
	//         $user->api_token = null;
	//         $user->save();
	//     }

	//     return response()->json(['data' => 'User logged out.'], 200);
	// }
	  
	/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */
	public function getUser() {
	 $user = Auth::user();
	 return response()->json(['success' => $user], $this->successStatus); 
	 }
} 