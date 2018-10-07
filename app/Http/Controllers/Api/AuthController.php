<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    //

	protected $successStatus=200;
	protected $errorStatus=401;
	  

    public function login(Request $request){



    	$input = $request->all();
    	$validator=Validator::make($input, [
            
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

         if ($validator->fails()) {
            $errors = $validator->errors();
            
            return response()->json(['error'=>$validator->errors()],$this->errorStatus);
        }
        else 
        {
 			$email = $request->input('email');
    		$password = $request->input('password');

	    	if(Auth::attempt(['email' => $email, 'password' => $password]))
	    	{
	    		$user = Auth::user();

	    		$success['token']=$user->createToken('ApiProject')->accessToken;

	    		return response()->json(['success'=>$success],$this->successStatus);
	    	}else{
	    		return response()->json(['error'=>'unauthorized'],$this->errorStatus);
	    	}
    	}
    }

    public function register(Request $request)
	    {


	    	$input = $request->all();
    		$validator=Validator::make($input, [
            'name' => 'required|',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'c_password' => 'required|min:6|same:password',
        ]);

         if ($validator->fails()) {
            $errors = $validator->errors();
            
            return response()->json(['error'=>$validator->errors()],$this->errorStatus);
        }
        else 
        {

	         if(User::create([
	            'name' => $input['name'],
	            'email' => $input['email'],
	            'password' => Hash::make($input['password']),
	        ])){
	         	return response()->json(['success'=>'Registration Done. You can now login'],$this->successStatus);
	         }else{
	         	return response()->json(['error'=>'sorry'],$this->successStatus);
	         }
        }

	    }


	   

  	
}
