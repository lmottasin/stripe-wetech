<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function redirectToGithubProvider(){
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubProviderCallback(){
        $user = Auth::user();
        $user = Socialite::driver('github')->user();
        return  $this->oauthLogin($user, 'github');

        // $user->token
    }
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        return $this->oauthLogin($user, 'google');
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        return $this->oauthLogin($user, 'facebook');
    }

    public function oauthLogin ($user, $type) {
        $userExists = User::where('email', '=', $user->email)->first();


        if (!$userExists) {
            $newUser = User::create([
                'name' => $user->name ? $user->name : $user->nickname,
                'email' => $user->email,
                'password' => Hash::make(md5(uniqid() . now())),
                'trial_ends_at' => now()->addDays(20),
                'email_verified_at' => now(),
                'auth_type' => $type
            ]);

            Auth::login($newUser);
        } else {
            if($userExists->auth_type != $type){
                if($userExists->auth_type == 'email'){
                    $message = 'This email is already associated with an account, please reset your password or login with your email and password below.';
                } else {
                    $message = 'This email has already been registered using ' . $type . '. Please login with ' . ucfirst($type) . ', or you may reset your password';
                }
                return redirect('login')->with(['alert' => $message, 'alert_type' => 'error']);
            }
            Auth::login($userExists);
        }

        return redirect('dashboard');
    }
}
