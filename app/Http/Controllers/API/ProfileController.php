<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ProfileController extends RegisterController
{
    //
    public function Profile()
    {
        $profile = auth::user();
        return $this->sendResponse($profile, 'User login successfully.');
    }
    public function Updateprofile(Request $request, User $user)
    {
        //upadte profile API
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'first_name' => 'required',
            'last_name'=>'required',
            'email'=>'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $profile = auth::user();
        $id = $profile->id;
        $user = User::find($id);

        if ($user)
        {
            $user->name = $input['name'];
            $user->first_name = $input['first_name'];
            $user->last_name = $input['last_name'];
            $user->email = $input['email'];
            $user->city_id = $input['city_id'];
            $user->role = $input['role'];
            $user->save();
        }

        return response()->json([
            "success" => true,
            "message" => "update successfully uploaded",
        ]);
    }
}
