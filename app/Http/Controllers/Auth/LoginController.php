<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {        
        Session::put('previous_url', URL::previous());
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'email' => 'required|exists:user,email|email|max:50',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            if (Hash::check($request->password, $user->password) && $user->status == 'active') {
                Auth::login($user, $request->has('remember'));    
                
                $previousUrl = Session::get('previous_url', url('/')); 
                Session::forget('previous_url'); 
    
                return redirect()->to($previousUrl);
            }
    
            Session::flash('error', 'Invalid Authentication');
            return redirect()->back()->withInput();
        } 
        Session::flash('error', 'You are not registered');
        return redirect()->back()->withInput();  

    }
}
