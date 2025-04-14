<?php
  
namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use App\Models\usr_data;
use Illuminate\Support\Facades\Auth;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
        ->scopes([
            'https://www.googleapis.com/auth/spreadsheets', // Alcance para hojas de cálculo
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/drive'
        ])
        ->redirect();
    }
          
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = usr_data::where('external_id', $user->id)->first();
            if($finduser){
                $finduser->token_google = $user->token;
                $finduser->save();
                $auth = User::findOrFail($finduser->id_user);
                Auth::login($auth);
                return redirect(route('home'));
            }else{
                $parts = explode(" ", $user->name);
                $nombre = $parts[0];
                $a_pat = isset($parts[1]) ? $parts[1] : ''; // Segundo elemento, si existe
                $a_mat = isset($parts[2]) ? $parts[2] : ''; // Tercer elemento, si existe
                $newUser = User::updateOrCreate(
                    ['email' => $user->email],
                    [
                        'nombre' => $nombre,
                        'apaterno'=> $a_pat,
                        'amaterno' => $a_mat
                    ]);
                    usr_data::UpdateOrCreate(
                        ['id_user' => $newUser->id],
                        [
                            'id_area'        => 3,
                            'id_departamento'=> 35,
                            'id_division'    => 3,
                            'id_puesto'      => 1,
                            'external_id'    => $user->id,
                            'token_google'   => $user->token,
                            'activo'         => true
                        ]
                    );
                Auth::login($newUser);
                return redirect(route('home'));
                #dd($user->token);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}