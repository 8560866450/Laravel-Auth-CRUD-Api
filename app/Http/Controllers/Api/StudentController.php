<?php

namespace App\Http\Controllers\Api;

use App\Model\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    //
			protected $successStatus=200;
			protected $errorStatus=401;

			public function index(){

				$data=Student::where('auth_id',Auth::user()->id)->get();
				return response()->json(['list'=>$data],$this->successStatus);
			}



		    public function create(Request $request){
			    


			    	$input = $request->all();
		    		$validator=Validator::make($input, [
		            'name' => 'required',
		            'mobile' => 'required|min:10|numeric|unique:students',
		            'email' => 'required|email|unique:students',
		            'address' => 'required',
		            
		        ]);

		         if ($validator->fails()) {
		            $errors = $validator->errors();
		            
		            return response()->json(['error'=>$validator->errors()],$this->errorStatus);
		        }
		        else 
		        {

			         if(Student::create([
			            'auth_id' => Auth::user()->id,
			            'name' => $input['name'],
			            'mobile' => $input['mobile'],
			            'email' => $input['email'],
			            'address' => $input['address'],
			        ])){
			         	return response()->json(['success'=>'Student Created Successfully.'],$this->successStatus);
			         }else{
			         	return response()->json(['error'=>'sorry'],$this->errorStatus);
			         }
		        }

			}




			public function update(Request $request){
			    


			    	$input = $request->all();
		    		$validator=Validator::make($input, [
		            'id' => 'required|numeric',
		            'name' => 'required',
		            'mobile' => 'required|min:10|numeric|unique:students,mobile,' . (isset($input['id'])?$input['id']:'') . ',id',
		            'email' => 'required|email|unique:students,email,' . (isset($input['id'])?$input['id']:'') . ',id',
		            'address' => 'required',
		            
		        ]);

		         if ($validator->fails()) {
		            $errors = $validator->errors();
		            
		            return response()->json(['error'=>$validator->errors()],$this->errorStatus);
		        }
		        else 
		        {
		        	$client = Student::find($input['id']);
		        	$client->name=$input['name'];
		        	$client->mobile=$input['mobile'];
		        	$client->email=$input['email'];
		        	$client->address=$input['address'];
		        	if($client->save())
		        	{

			         	return response()->json(['success'=>'Student Updated Successfully.'],$this->successStatus);
			         }else{
			         	return response()->json(['error'=>'sorry'],$this->errorStatus);
			         }
		        }

			}


			public function delete(Request $request)
		    {
		        //

		        $input = $request->all();
		    		$validator=Validator::make($input, [
		            'id' => 'required|numeric',
		            
		            
		        ]);

		         if ($validator->fails()) {
		            $errors = $validator->errors();
		            
		            return response()->json(['error'=>$validator->errors()],$this->errorStatus);
		        }
		        else 
		        {
		            
		           Student::destroy($input); 
		        	
		        	return response()->json(['success'=>'Student Deleted Successfully.'],$this->successStatus);
		        }
		    }


}
