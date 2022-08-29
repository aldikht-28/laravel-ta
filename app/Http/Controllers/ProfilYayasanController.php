<?php

namespace App\Http\Controllers;

use App\Models\ProfilYayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class ProfilYayasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = ProfilYayasan::select('id', 'profily', 'fotoprofil')->get();
        return view('profilyayasan.index', compact('profil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fotoprofil' => ['required', 'mimes:jpg,jpeg,png'],
            'profily' => 'required'
        ]);

        $fotoprofil = time() . '.' . $request->fotoprofil->getClientOriginalExtension();
        $request->fotoprofil->move('upload/fotoprofil', $fotoprofil);

        ProfilYayasan::create([
            'fotoprofil' => $fotoprofil,
            'profily' => request('profily'),
            // 'id_user' => Auth::user()->id
        ]);

        Alert::success('Sukses', 'Data Profil Yayasan Berhasil Ditambah');
        return redirect('/profily');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profil = ProfilYayasan::find($id);
        $profil->profily = $request->input('profily');


        if ($request->hasFile('fotoprofil')) {
            $destinasi = 'upload/fotoprofil/' . $profil->fotoprofil;
            if (File::exists($destinasi)) {
                File::delete($destinasi);
            }

            $file = $request->file('fotoprofil');
            $extensi = $file->getClientOriginalExtension();
            $namafile = time() . '.' . $extensi;
            $file->move('upload/fotoprofil/', $namafile);
            $profil->fotoprofil = $namafile;
        }

        $profil->update([
            'profily' => request('profily'),
        ]);

        Alert::success('Sukses', 'Data Dokumentasi Berhasil Diubah');
        return redirect('/profily');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
