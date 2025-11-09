<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class loginController extends Controller
{
    //This function will show login page for users
    public function index()
    {
        return view('globalsoft/login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Find the user by their username
        $user = User::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {

            if ($user->name == 'ADM' || $user->name == 'user') {
                if($user->email_verified_at === null){
                    return redirect()->back()
                    ->withErrors(['username' => 'First Verify Your Email'])
                    ->withInput();
                }
                // Login the user manually
                Auth::login($user);

                return redirect()->route('profile');
            } else {
                return redirect()->back()
                    ->withErrors(['username' => 'The provided credentials do not match our records.'])
                    ->withInput();
            }
        } else {
            return redirect()->back()
                ->withErrors(['username' => 'The provided credentials do not match our records.'])
                ->withInput();
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('AccountLogin');
    }

    public function sign_up()
    {
        return view('/globalsoft/Register');
    }
    public function sign_up_process(Request $request)
{
    $credentials = $request->validate([
        'username' => ['required', 'string', 'max:255', 'unique:user,username,'.$request->id],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:user,email'],
        'cellno' => ['required', 'digits_between:10,15'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required']
    ]);

    $user = User::create([
        'username' => $credentials['username'],
        'name' => $credentials['role'],
        'email' => $credentials['email'],
        'cellno' => $credentials['cellno'],
        'password' => Hash::make($credentials['password']),
    ]);

    // Don't login the user — just send email verification
    event(new Registered($user));

    return redirect()->route('sign_up')->with('success', 'User created! Verification email sent.');
}


    public function pw_change(){
        return view('/globalsoft/passwordChange');
    }

    public function pw_change_process(Request $request)
{
    // Validate input
    $request->validate([
        'username'      => 'required|string|exists:user,username',
        'prv_password'  => 'required|string',
        'new_password'  => 'required|string|min:8|different:prv_password',
    ]);

    // Find user
    $user = User::where('username', $request->username)->first();

    // If user not found (extra safety)
    if (!$user) {
        return back()->with('error', 'User not found.');
    }

    // Check if previous password matches
    if (!Hash::check($request->prv_password, $user->password)) {
        return back()->with('error', 'Previous password is incorrect.');
    }

    // Update password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password updated successfully.');
}

}
