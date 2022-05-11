<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Libraries\MCrypt;

use App\Http\Controllers\Controller;

class EncryptionDecryption extends Controller
{
    public function encryption($encrepteddata,$message)
    {

        $mcryptlib = new MCrypt();
        $email=$encrepteddata['email'];
        $password=$encrepteddata['password'];
        $encryptedemail = $mcryptlib->encrypt($email);
        $encryptedpassword = $mcryptlib->encrypt($password);


        $response=[
            'success'=>true,
            'data'=>$encrepteddata,
            'message'=>$message,

        ];

        return response()->json($response, 200);
    }

}
