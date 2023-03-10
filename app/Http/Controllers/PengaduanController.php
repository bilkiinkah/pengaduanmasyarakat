<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pengaduans = Pengaduan::select('id','tgl_pengaduan','isi_laporan', 'status')->get();
        return view('pengaduan.index', compact('pengaduans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pengaduans = Pengaduan::all();
        $users = User::all();
        return view('pengaduan.create', compact('users', 'pengaduans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // ddd($request);
        $request->validate([
            'isi_laporan' => 'required|min:10',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ],[
            'isi_laporan.required' => 'isi laporan wajib di isi',
            'isi_laporan.min' => 'isi laporan minimal 10 karakter',
            'foto.required' => 'foto wajib di isi',
            'foto.image' => 'wajib foto dengan ekstensi .jpg , .jpeg , .png',
            'foto.max' => 'maksimal 2mb'
        ]);

        

        $path = $request->file('foto')->store('/img');

        
        Pengaduan::create([
            'users_id' => Auth::user()->id,
            'tgl_pengaduan' => Carbon::now()->format('Y-m-d'),
             'isi_laporan' => $request->isi_laporan,
             'foto' => $path,
             'status' => '0'
         ]);

      
        return redirect('/pengaduan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        //
        // $pengaduans = Pengaduan::select('id','tgl_pengaduan','isi_laporan', 'status')->where('users_id', Auth::user()->id)->get();
        $pengaduans = Pengaduan::find($pengaduan->id);  
        return view('pengaduan.show', compact('pengaduans'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan)
    {
        //
        $pengduands = Pengaduan::find ($pengaduan->id);
        return view ('pengaduan.edit', compact('pengaduan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        //
        $pengaduan->update([
            
            'isi_laporan' => $request->isi_laporan,
        ]);
        return redirect ('/pengaduan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        //
        $pengaduans = $pengaduan::find($pengaduan->id);
        $pengaduans->delete();
        return redirect('pengaduan');
    }
}
