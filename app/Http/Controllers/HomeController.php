<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $username = session('username');
            $token = session('token');
            $dataDevice = new Home();
            $data = $dataDevice->getData();
            return view('home', ['data' => $data]);
    }

    public function logout(Request $request)
    {
        // Clear the session data
        $request->session()->forget(['username', 'token']);

        // Redirect to the login page
        return redirect('login');
    }
}
