<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
    public function view()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required|min:3|max:25',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'tlp'     => 'required|numeric',
        ],
        [
            'name.required' => 'nama tidak boleh kosong',
            'name.min' => 'nama minimal 3 karakter',
            'name.max' => 'nama maksimal 25 karakter',
            'username.required'     => 'username tidak boleh kosong',
            'username.unique' => 'username sudah terdaftar',
            'password.required' => 'password tidak boleh kosong',
            'password.min' => 'password minimal 8 karakter',
            'tlp.required'     => 'telepon tidak boleh kosong',
            'tlp.numeric' => 'telepon harus berupa angka',
        ]);

            User::create([
               'name' => Str::camel($data['name']),
               'username' => Str::lower($data['username']),
               'password' => bcrypt($data['password']),
               'level' => 'masyarakat',
               'tlp' => $data['tlp'],
            
            ]);
            return redirect('/login');
            }
}
