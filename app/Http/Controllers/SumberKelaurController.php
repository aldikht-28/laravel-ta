<?php

namespace App\Http\Controllers;

use App\Models\SumberKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class SumberKelaurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sumberkeluar = SumberKeluar::select('id', 'nama', 'id_user')->where('id_user', Auth::user()->id)->latest()->paginate(5);
        return  view('admin/sumber/sumberkeluar/index', compact('sumberkeluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return  view('admin/sumber/sumberkeluar/create');
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
            'nama' => 'required',
        ]);

        SumberKeluar::create([
            'nama' => Str::title($request->nama),
            'id_user' => Auth::user()->id
        ]);

        Alert::success('Sukses', 'Data Kategori Arus Kas Keluar Berhasil Ditambah');
        return redirect('/sumberkeluar');
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
        // $sumberkeluar = SumberKeluar::select('id', 'nama',)->whereId($id)->where('id_user', Auth::user()->id)->first();
        // return  view('admin/sumber/sumberkeluar/edit', compact('sumberkeluar'));
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
        $request->validate([
            'nama' => 'required',
        ]);

        SumberKeluar::whereId($id)->update([
            'nama' => Str::title($request->nama),
            'id_user' => Auth::user()->id
        ]);

        Alert::success('Sukses', 'Data Kategori Arus Kas Keluar Berhasil Diubah');
        return redirect('/sumberkeluar');
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
        alert()->question('Peringatan!', 'Apakah anda yakin ingin menghapus? Jika anda menghapus data kategori maka data arus kas akan ikut terhapus.')
            ->showConfirmButton('<a href="/sumberkeluar/' . $id . '/delete"
            class="text-white text-decoration-none">Hapus</a>', '#f00000 ')->toHtml()
            ->showCancelButton('Batal', '#aaa')->reverseButtons();
        return redirect('/sumberkeluar');
    }

    public function delete($id)
    {
        SumberKeluar::whereId($id)->where('id_user', Auth::user()->id)->delete();

        Alert::success('Sukses', 'Data Kategori Arus Kas Keluar Berhasil Dihapus');
        return redirect('/sumberkeluar');
    }
}
