<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends RegisterController
{

    public function forget(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => "required|email"
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }
    public function reset($token,Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required',
            'newPassword' => 'required',
            'retypepassword'=>'required',
            ]);
            if ($validator->fails())
            {
                return response(['errors'=>$validator->errors()], 422);
            }
                $user=DB::table('password_resets')->where('token',$token)->select('email')->first();
                $email=$user->email;
                $data=User::where('email',$email)->select('id')->first();
                $id=$data->id;
                $userid=User::find($id);
                if($userid)
                {
                    $userid->password=$input['newPassword'];
                    $userid->save();
                }
                return response()->json([
                    "success" => true,
                    "message" => "update successfully uploaded",
                ]);
            }





    }








