<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  
  public function index()
  {
    return view('pages.auth.login');
  }

  /**
   * Handle an authentication attempt.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function authenticate(LoginRequest $request)
  {      
      $credentials = $request->getCredentials();

      if (Auth::attempt($credentials)) {
          $request->session()->regenerate();

          return redirect()->intended('employees');
      }

      return back()->withErrors([
          'username' => 'The provided credentials do not match our records.',
      ])->onlyInput('username');
  }

  /**
   * Log the user out of the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function logout(Request $request)
  {
      Auth::logout();
  
      $request->session()->invalidate();
  
      $request->session()->regenerateToken();
  
      return redirect('/');
  }
}