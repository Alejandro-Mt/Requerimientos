<?php
  
namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use App\Models\usr_data;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @var \Laravel\Socialite\Two\GoogleProvider $provider
     */
    public function redirectToGoogle()
    {
         if (!session()->has('url.intended') && !str_contains(url()->previous(), 'login')) {
            session(['url.intended' => url()->previous()]);
        }
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
                #return redirect(route('home'));
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
                #return redirect(route('home'));
                #dd($user->token);
            }
            return redirect()->intended(route('home'));
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function showGeminiForm()
    {
        return view('gemini.chat'); // apunta a resources/views/gemini/chat.blade.php
    }

    public function generateFromGemini(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
            'context' => 'nullable|string',
        ]);

        $gemini_api_key = config('services.google.api_key');
        //$gemini_api_key = 'AIzaSyAH9gxYQTJDv5LdPrX6x1FbASIUlC2Ap-Y'; #env('GEMINI_API_KEY');

        $full_prompt = "Eres un asistente del curso. Usa únicamente el siguiente contenido extraído de la wiki para responder.\n\n"
            . $request->context . "\n\n"
            . "Pregunta del usuario:\n"
            . $request->prompt;

        $data = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $full_prompt]
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$gemini_api_key}", $data);

        return response()->json($response->json(), $response->status());
    }

}