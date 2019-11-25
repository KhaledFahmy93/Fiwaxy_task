<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $user['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $user], $this->successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [  
            'email' => 'required|email', 
            'password' => 'required', 
	    'user_type' => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']);
        $input['name'] = $input['name']; 
        $user = Customer::create($input); 
        $user['token'] =  $user->createToken('MyApp')-> accessToken; 
        return response()->json(['success'=>$user], $this-> successStatus); 
    }

    public function getUser() {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus); 
    }
}
