<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokumentasi = Dokumentasi::select('id', 'judul', 'body', 'gambar', 'tanggal')->where('id_user', Auth::user()->id)->orderBy('tanggal', 'desc')->latest()->simplePaginate(5);
        return view('dokumentasi.dokumentasi', compact('dokumentasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $dokumentasi = Dokumentasi::select('id', 'judul', 'body', 'gambar', 'tanggal')->where('id_user', Auth::user()->id)->get();
        // return view('dokumentasi.create', compact('dokumentasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->tanggal) {
            # code...
            $request->validate([
                'tanggal' => 'required',
                'gambar' => ['required', 'mimes:jpg,jpeg,png'],
                'judul' => 'required',
                'body' => 'required'
            ]);

            $gambar = time() . '.' . $request->gambar->getClientOriginalExtension();
            $request->gambar->move('upload/gambar', $gambar);

            Dokumentasi::create([
                'tanggal' => request('tanggal'),
                'gambar' => $gambar,
                'judul' => request('judul'),
                'body' => request('body'),
                'id_user' => Auth::user()->id
            ]);

            Alert::success('Sukses', 'Data Dokumentasi Berhasil Ditambah');
            return redirect('/dokumentasi');
        } else {
            $dokumentasi = DB::table('dokumentasi')->get();
            # code...
            if ($request->judul) {
                $dokumentasi = Dokumentasi::where('judul', 'LIKE', '%' . $request->judul . '%')
                    ->where('id_user', Auth::user()->id)->simplePaginate();
            } else {
                # code...
                // $dokumentasi = Dokumentasi::all()->where('id_user', Auth::user()->id)->simplePaginate();
                return redirect('/dokumentasi');
            }

            return view('dokumentasi.dokumentasi', compact('dokumentasi'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dok = Dokumentasi::select('id', 'tanggal', 'gambar', 'body', 'judul')->whereId($id)->where('id_user', Auth::user()->id)->firstOrFail();
        return view('dokumentasi.show', compact('dok'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $dok = Dokumentasi::select('id', 'tanggal', 'gambar', 'body', 'judul')->whereId($id)->where('id_user', Auth::user()->id)->first();
        // return view('dokumentasi.edit', compact('dok'));
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
        $dok = Dokumentasi::find($id);
        $dok->tanggal = $request->input('tanggal');
        $dok->judul = $request->input('judul');
        $dok->body = $request->input('body');
        $dok->id_user = $request->input('id_user');

        if ($request->hasFile('gambar')) {
            $destinasi = 'upload/gambar/' . $dok->gambar;
            if (File::exists($destinasi)) {
                File::delete($destinasi);
            }

            $file = $request->file('gambar');
            $extensi = $file->getClientOriginalExtension();
            $namafile = time() . '.' . $extensi;
            $file->move('upload/gambar/', $namafile);
            $dok->gambar = $namafile;
        }

        $dok->update([
            'tanggal' => request('tanggal'),
            'judul' => request('judul'),
            'body' => request('body'),
            'id_user' => Auth::user()->id
        ]);

        Alert::success('Sukses', 'Data Dokumentasi Berhasil Diubah');
        return redirect('/dokumentasi');
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

    public function konfirmasi($id)
    {
        alert()->question('Peringatan!', 'Apakah anda yakin ingin menghapus?')
            ->showConfirmButton('<a href="/dokumentasi/' . $id . '/delete"
            class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
            ->showCancelButton('Batal', '#aaa')->reverseButtons();
        return redirect('/dokumentasi');
    }

    public function delete($id)
    {
        Dokumentasi::whereId($id)->where('id_user', Auth::user()->id)->delete();

        Alert::success('Sukses', 'Data Dokumentasi Berhasil Dihapus');
        return redirect('/dokumentasi');
    }
}
