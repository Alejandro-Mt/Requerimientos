<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function edit()
    {
        return view('profile');
    }
    public function update(Request $data){
        $user = Auth::user();
        $avatar = str_replace('storage','public',$user->avatar);
        Storage::delete($avatar);
        $data->validate(['avatar'=>'required|image|max:2048']);
        $update = User::findOrFail($user->id);
        $update->avatar =storage::url($data->file('avatar')->store('public/avatar'));
        $update->save(); 
        return redirect(route('profile',$user->id));
        #return $user->avatar;
        /*$user = $data->user();
        $user->fill($data->validate());
        
        if($user->isDirty('email')){
            $user->email_verified_at=null;
            $user->sendEmailVerificationNotification();
        }
        $user->save();
        if($data->hasFile('avatar')){
            if($user->avatar != null){
                Storage::disk('avatar')->delete($user->avatar->path);
                $user->avatar->delete();
            }
            $user->avatar->create([
                'path' => $data->avatar->store('avatar')
            ]);
        }
        return redirect()
            ->route('profile.edit')
            ->whithSuccess('Profile edited');*/
    }
}
