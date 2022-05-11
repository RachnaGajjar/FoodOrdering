<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Http\Controllers\API\BaseController;
use App\Models\City;
use App\Models\Country;
use App\Models\Restaurant;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RestaurantController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants= Restaurant::with(['user','city'])->get();
        return view('Restaurant.index',compact('restaurants'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create  Restaurant
        $data['countries'] = Country::get(["country", "id"]);
        return view('Restaurant.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /*  $this->upload($request); */
        //store data of Restaurant
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'image'=>'required',
        ]);
        $normalPass = $request->input('password');
        $name=$request->name;
        $firstname=$request->name;
        $last_name='';
        $email=$request->email;
        $password = Hash::make($request->input('password'));
        $request['password'] = $password;
        $role="Owner";
        $city_id=$request->city;

            $token = Str::random(64);
            $user=User::create(['name'=>$name,'first_name'=> $firstname,'last_name'=> $last_name,'email'=>$email,'password'=>$password,'role'=>$role,'city_id'=>$city_id]);
            $user_id=$user->id;
            $request['token']=$token;
            $request['user_id'] = $user_id;
            $Restaurant = Restaurant::create($request->all());
            $Restaurant->password = $normalPass;
            $Restaurant->email = $request->input('email');

            $details = [
                'title' => 'Employee Created',
                'name'=>$Restaurant['name'],
                'email' => $Restaurant['email'],
                'password'=>$normalPass,
                'token'=>$Restaurant['token'],
            ];
            $this->fetchCity($request);
            $this->storeImage($request,$Restaurant->id);
            Mail::to($request->email)->send(new \App\Mail\RestaurantCreated($details));



    }
    public function verifyuser($token)
    {
        $verifieduser = Restaurant::where('token', $token)->first();
        if (isset($verifieduser))
        {
            $status = "Your e-mail is verified. You can now login.";
        }
        else
        {
                return redirect('/')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/')->with('status', $status);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeImage(Request $request,$id)
    {

        $request->validate([
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = Restaurant::find($id);

        if ($request->file('image'))
         {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');

        }

        $image->thumbnail_image = 'storage/uploads/'.$imageName;
        $image->save();
    }
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["state", "id"]);
        return response()->json($data);

    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function show(Restaurant $restaurant)
    {

        return view('Restaurant.show',compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {

        $id=$restaurant->user_id;
        $city_id=User::where('id',$id)->select('city_id')->first();
        $cityid=$city_id->city_id;
        $id=Restaurant::find($id);
        $city=city::pluck('id','name');
        return view('Restaurant.edit', compact('restaurant','city','cityid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Restaurant $restaurants)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'city_id'=>'required',

        ]);
        $restaurants= Restaurant::with('user')->where('id',$id)->first();
        $restaurants->user->update(array('name' => $request->name,'email'=>$request->email,'city_id'=>$request->city_id,'image'=>$request->image));
        return redirect()->route('restaurant.index')
        ->with('success', 'Employee updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {

        $restaurant->delete();
        return redirect()->route('restaurant.index')->with('success','restaurant deleted successfully');
    }


}
