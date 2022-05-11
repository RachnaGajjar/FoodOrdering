<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Libraries\MCrypt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
    /*
        This function is use for registration with API.

    */
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'=>'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'retypepassword' => 'required|same:password',
                'role' => 'required',
                'city_id' => 'required'
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        try
        {
            $user = User::create($input);
        }
        catch(\Exception $e)
        {
            return $this->sendError('Email is already exist .');
        }
        $success['token'] =  $user->createToken('food_ordering_system')->accessToken;
        $success['first_name'] =  $user->first_name;
        $success['last_name'] =  $user->last_name;
        return $this->sendResponse($success, 'User register successfully.');
    }
    public function login(Request $request)
    {
       /*This API is for Login.
       In this API Send data as EncreptedForm and after that we can receive decryptedForm and perform some operation.*/
       $encryptedemail=$request->email;
        $encryptedpassword=$request->password;
        $mcryptlib = new MCrypt();
        /* Decrypt with Mcrypt function */
        $email=$mcryptlib->decrypt($encryptedemail);
        $password=$mcryptlib->decrypt($encryptedpassword);
        /* Check Login functionality */
        if (Auth::attempt(['email' => $email, 'password' => $password]))
         {
            $user = Auth::user();
            $user = User::where('email', $email)->first();
            $success['token']=  $user->createToken('food_ordering_system')->accessToken;
            $success['email'] =  $request->email;
            $success['password']=$request->password;
            return $this->encryption($success, 'User login successfully.');

        }
        else
        {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

}
