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
        $data = user::select('nombre','apaterno','avatar','p.puesto')
                    ->leftjoin('puestos as p','users.id_puesto','p.id_puesto')
                    ->where('id', auth::user()->id)->get();
        return view('profile',compact('data'));
        #return $data;
    }

    public function update(Request $data){
        $user = Auth::user();
        $avatar = str_replace('storage','public',$user->avatar);
        Storage::delete($avatar);
        $data->validate(['avatar'=>'required|image|max:2048']);
        $update = User::findOrFail($user->id);
        $update->avatar = storage::url($data->file('avatar')->store('public/avatar'));
        $update->save(); 
        #return redirect(route('profile',$user->id));
        #return $data->avatar;
    }
}
