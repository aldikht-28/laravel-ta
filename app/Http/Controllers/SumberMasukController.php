<?php

namespace App\Http\Controllers;

use App\Models\SumberMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;


class SumberMasukController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sumbermasuk = SumberMasuk::select('id', 'nama', 'id_user')->where('id_user', Auth::user()->id)->latest()->paginate(5);
        return  view('admin/sumber/sumbermasuk/index', compact('sumbermasuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return  view('admin/sumber/sumbermasuk/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
        ]);

        SumberMasuk::create([
            'nama' => Str::title($request->nama),
            'id_user' => Auth::user()->id,
        ]);

        Alert::success('Sukses', 'Data Kategori Arus Kas Masuk Berhasil Ditambahkan');
        return redirect('/sumbermasuk');
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
        // $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', Auth::user()->id)->whereId($id)->first();
        // return  view('admin/sumber/sumbermasuk/edit', compact('sumbermasuk'));
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

        SumberMasuk::whereId($id)->update([
            'nama' => Str::title($request->nama),
            'id_user' => Auth::user()->id
        ]);

        Alert::success('Sukses', 'Data Kategori Arus Kas Masuk Berhasil Diubah');

        return redirect('/sumbermasuk');
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
        alert()->question('Peringatan!', 'Apakah anda yakin ingin menghapus?. Jika anda menghapus data kategori maka data arus kas masuk akan ikut terhapus.')
            ->showConfirmButton('<a href="sumbermasuk/' . $id . '/delete"
            class="text-white text-decoration-none">Hapus</a>', '#f00000    ')->toHtml()
            ->showCancelButton('Batal', '#aaa')->reverseButtons();
        return redirect('/sumbermasuk');
    }

    public function delete($id)
    {
        SumberMasuk::whereId($id)->where('id_user', Auth::user()->id)->delete();
        // $this->nama()->delete();

        Alert::success('Sukses', 'Data Kategori Arus Kas Masuk Berhasil Dihapus');
        return redirect('/sumbermasuk');
    }
}
