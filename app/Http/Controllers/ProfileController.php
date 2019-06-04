<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Log;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {   
        
        $user_data = User::where('id','=',Auth::user()->id)->first();
        $user_type = User::getUserType($user_data->id);
      
        return view('profile', compact('user_data','user_type'));
    }

    public function update(Request $request,$id)
    {  
         // Log::info($request);
        // dd($request->toArray()); 
       
        $user = User::findOrFail($id);
        $newDate = date("Y-m-d",strtotime($request['dob']));
         
        $constraints = [
            'name' => 'required|max:20',
            'email'=> 'required|max:60',            
            ];
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'education' => $request['education'],
            'dob' => $newDate
        ];
        if ($request['password'] != null && strlen($request['password']) > 0) {
            $constraints['password'] = 'required|min:6|confirmed';
            $input['password'] =  bcrypt($request['password']);
        }
        $this->validate($request, $constraints);
        User::where('id', $id)
            ->update($input);
        
        return redirect()->intended('/dashboard');
    }
   
}
