<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Login;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('token')) {
            return $next($request);
        } else {
            // Get the username and password from the request
            $username = $request->input('username');
            $password = $request->input('password');

            // Call the authenticate method of the Login model
            $response = Login::authenticate($username, $password);

            // Check if the authentication was successful
            if ($response->status == 200) {
                // Save the token and username in the session
                session(['token' => $response->token, 'username' => $username]);

                // Continue with the request
                return $next($request);
            } else {
                // Return an error message
                return back()->withErrors(['message' => 'Invalid username or password']);
            }
        }
    }
}
