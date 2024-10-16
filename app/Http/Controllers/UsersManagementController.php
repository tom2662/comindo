<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;

use App\Models\User;

class UsersManagementController extends Controller
{
    //

    public function index(){

        $users = User::all()->sortBy('name');
        return view('management_users.index')->withUsers($users);
    }
    public function detail($id){
        $user = User::where('id',$id)->first();
        return view('management_users.detail')->withUser($user);
    }

    public function update(ProfileUpdateRequest $request){

        $request->user()->fill($request->validated());

        $user = User::where('id',$request->user_id)->first();

        if($user != null){
            if(!empty($request->file('photo'))){
         
                $photo = $request->file('photo');
                $ext = $photo->getClientOriginalExtension();
                $photoName = "user-".rand(10000, 99999).".".$ext;
                $photo->move('photo/', $photoName);
            };
    
            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }
      
            $request->user()->photo = $photoName;
            $request->user()->save();
        }

       

        return view('management_users.detail')->withUser($user);
    }

    public function delete($id){
        $user = User::where('id',$request->user_id)->first();

        unlink(public_path('photo/{$user->photo}'));

        $users = User::all()->sortBy('name');
        return view('management_users.index')->withUsers($users);
    }
}
