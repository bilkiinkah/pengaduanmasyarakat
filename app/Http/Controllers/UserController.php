<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use PDF;

class UserController extends Controller
{
    public function index(){
        $datauser = User::all();
        $data = Pengaduan::all();

        return view('pages.users', ['data'=>$data]);
    }

    public function generatepdf(){
        $datauser = User::all();
        $data = Pengaduan::all();

        $pdf = PDF::loadView('pages.users', [ 'data' => $data]);

        return $pdf->download('latihanpdf.pdf');
    }
}