<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
            $finduser = User::where('external_id', $user->id)->first();
            if($finduser){
                #$fullname = explode(' ', $user['name']);
                $finduser->token_google = $user->token;
                $finduser->save();
                Auth::login($finduser);
                return redirect(route('home'));
            }else{
                $newUser = User::updateOrCreate(
                    ['email' => $user->email],
                    [
                        'name' => $user->nombre,
                        'external_id'=> $user->id,
                        'token_google' => $user->token
                    ]);
                Auth::login($newUser);
                return redirect(route('home'));
                #dd($user->token);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}