<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Home;

class LoginController extends Controller
{
    public function login()
    {
        //cek user sudah login atau belum
        if (session()->has('token')) {
            $username = session('username');
            $token = session('token');
            $dataDevice = new Home();
            $data = $dataDevice->getData();

            // jika sudah login maka akan di redirect langsung ke halaman home
            return view('home', ['data' => $data]);
        } else {
            // jika user belum login maka di arahkan ke halama login
            return view('login');
        }
    }

    public function cek(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Get the username and password from the request
        $username = $request->input('username');
        $password = $request->input('password');

        // Call the authenticate method of the Login model
        $response = Login::authenticate($username, $password);

        // Check if the authentication was successful
        if ($response->status == 200) {
            // Save the token and username in the session
            session(['roles' => $response->roles, 'token' => $response->token, 'username' => $username]);

            // Redirect to the home page
            toast('Login Berhasil', 'success')->autoClose(1000);
            return redirect()->route('home');
        } else {
            toast()->error('Login Gagal', 'Username / Password Tidak Terdaftar');
            return back();
        }
    }

    public function logout()
    {
        // Remove the token and username from the session
        session()->forget(['token', 'username']);

        $response = response()->view('login')->header('cache-control', 'no-cache');

        // Return the response
        return redirect('/')->with('success', 'Berhasil Log-out')->header('cache-control', 'no-cache');
    }
}
