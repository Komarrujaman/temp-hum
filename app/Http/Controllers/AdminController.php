<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use GuzzleHttp\Client;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // The user is authenticated, so you can display the home page
        $username = session('username');
        $token = session('token');
        $user = Admin::getAllUser();
        return view('pages.admin.admin', ['user' => $user]);
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                'roles' => 'required',
                'name' => 'required',
                'username' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'password' => 'required'
            ]
        );

        // Store the form inputs in variables
        $roles = $request->input('roles');
        $name = $request->input('name');
        $username = $request->input('username');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $password = $request->input('password');

        $response = Admin::createUser($username, $roles, $password, $email, $phone, $name);

        if ($response->status == 200) {
            Alert::success('Berhasil', 'User Baru Berhasil Dibuat')->autoClose(1000);
            return redirect()->route('admin');
        } else {
            Alert::error('Gagal')->autoClose(1000);
            return redirect()->route('admin');
        }
    }

    public function editUser(Request $request)
    {
        $client = new Client();
        $response = $client->post(env('APP_HOST_API') . '/user/info/edit/', [
            'headers' => [
                'token' =>  session('token'),
                'id' => $id = $request->input('id'),
            ],
            'form_params' => [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'roles' => $request->input('roles'),
                'username' => $request->input('username'),

            ]
        ]);

        Alert::success('User Berhasil Di Ubah')->autoClose(1000);
        return redirect()->route('admin');
    }

    public function hapus(Request $request)
    {
        $client = new Client();
        $user = Admin::getAllUser();

        $response = $client->post(env('APP_HOST_API') . '/user/info/delete/', [
            'headers' => [
                'token' => $request->input('token'),
                'id' => $request->input('id'),
            ]
        ]);
        Alert::info('User Berhasil Di Hapus')->autoClose(1000);
        return redirect()->route('admin');
    }

    public function changePass(Request $request)
    {
        $client = new Client();
        $user = Admin::getAllUser();

        $response = $client->post(env('APP_HOST_API') . '/user/info/edit/password/', [
            'headers' => [
                'token' => $request->input('token'),
                'id' => $request->input('id'),
            ],
            'form_params' => [
                'password' => $request->input('password'),
            ]
        ]);
        Alert::info('Berhasil Ganti Password')->autoClose(1000);
        return redirect()->route('admin');
    }
}
