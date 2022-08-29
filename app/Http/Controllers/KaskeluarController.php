<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kaskeluar;
use App\Models\SumberKeluar;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class KaskeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');
        $deskripsi = $request->input('deskripsi');

        $sumberkeluar = SumberKeluar::select('id', 'nama')->where('id_user', Auth::user()->id)->get();

        $kaskeluar = Kaskeluar::with('sumberkeluar')->where('id_user', Auth::user()->id)->orderBy('tanggal', 'desc')->latest()->paginate(5);

        $jumlah = Kaskeluar::where('id_user', Auth::user()->id)->sum('jumlah');

        return  view('admin/kas/kaskeluar/index', compact('kaskeluar', 'deskripsi', 'jumlah', 'awal', 'akhir', 'sumberkeluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $sumberkeluar = SumberKeluar::select('id', 'nama')->where('id_user', Auth::user()->id)->get();
        // return  view('admin/kas/kaskeluar/create', compact('sumberkeluar'));
    }

    public function store(Request $request)
    {
        if (request('jumlah')) {
            $request->validate([
                'tanggal' => 'required',
                'bukti' => 'required|mimes:jpg,jpeg,png',
                'jumlah' => 'required',
                'sumberkeluar' => 'required',
            ]);

            $bukti = time() . '.'  . $request->bukti->getClientOriginalExtension();
            $request->bukti->move('upload/bukti', $bukti);

            $kaskeluar = Kaskeluar::create([
                'tanggal' => request('tanggal'),
                'bukti' => $bukti,
                'jumlah' => request('jumlah'),
                'id_sumberkeluar' => request('sumberkeluar'),
                'deskripsi' => Str::title($request->deskripsi),
                'id_user' => Auth::user()->id
            ]);
            Alert::success('Sukses', 'Data Arus Kas Keluar Berhasil Ditambah');
            return redirect('/kaskeluar');
        } else {
            $kaskeluar = DB::table('kaskeluar')->get();
            $awal = $request->input('awal');
            $akhir = $request->input('akhir');
            $deskripsi = $request->input('deskripsi');

            $sumberkeluar = SumberKeluar::select('id', 'nama')->where('id_user', Auth::user()->id)->get();

            $jumlah = Kaskeluar::where('id_user', Auth::user()->id)->sum('jumlah');
            if ($request->deskripsi && $request->sumber && $request->awal) {
                $kaskeluar = Kaskeluar::where('deskripsi', 'LIKE', '%' . $request->deskripsi . '%')
                    ->where('id_sumberkeluar', 'LIKE', '%' . $request->sumber . '%')
                    ->where('tanggal', '>=', $awal)
                    ->where('tanggal', '<=', $akhir)
                    ->where('id_user', Auth::user()->id)->paginate();
                $jumlah = Kaskeluar::where('id_user', Auth::user()->id)
                    ->where('deskripsi', 'LIKE', '%' . $request->deskripsi . '%')
                    ->where('id_sumberkeluar', 'LIKE', '%' . $request->sumber . '%')
                    ->where('tanggal', '>=', $awal)
                    ->where('tanggal', '<=', $akhir)
                    ->sum('jumlah');
            } else if ($request->awal) {
                $kaskeluar = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'bukti', 'id_sumberkeluar')
                    ->where('tanggal', '>=', $awal)
                    ->where('tanggal', '<=', $akhir)->where('id_user', Auth::user()->id)
                    ->paginate();
                $jumlah = Kaskeluar::where('id_user', Auth::user()->id)
                    ->where('tanggal', '>=', $awal)
                    ->where('tanggal', '<=', $akhir)
                    ->sum('jumlah');
                if (count($kaskeluar) == 0) {
                    Alert::warning('Pencarian', 'Data yang anda cari tidak ditemukan');
                }
            } else if ($request->sumber) {
                $kaskeluar = Kaskeluar::where('id_sumberkeluar', 'LIKE', '%' . $request->sumber . '%')
                    ->where('id_user', Auth::user()->id)
                    ->paginate();
                $jumlah = Kaskeluar::where('id_user', Auth::user()->id)
                    ->where('id_sumberkeluar', 'LIKE', '%' . $request->sumber . '%')
                    ->sum('jumlah');
            } else if ($request->deskripsi) {
                $kaskeluar = Kaskeluar::where('deskripsi', 'LIKE', '%' . $request->deskripsi . '%')
                    ->where('id_user', Auth::user()->id)
                    ->paginate();
                $jumlah = Kaskeluar::where('id_user', Auth::user()->id)
                    ->where('deskripsi', 'LIKE', '%' . $request->deskripsi . '%')
                    ->sum('jumlah');
            } else {
                return redirect('/kaskeluar');
                // $kaskeluar = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumberkeluar')->where('id_user', Auth::user()->id)->latest()->paginate(5);
            }

            return view('admin/kas/kaskeluar/index', compact('kaskeluar', 'deskripsi', 'jumlah', 'awal', 'akhir', 'sumberkeluar'));
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
        // $data = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'bukti', 'id_sumberkeluar')->whereId($id)->where('id_user', Auth::user()->id)->firstOrFail();
        // return  view('admin/kas/kaskeluar/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $sumberkeluar = SumberKeluar::select('id', 'nama')->get();
        // $kaskeluar = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'bukti', 'id_sumberkeluar')->whereId($id)->where('id_user', Auth::user()->id)->first();
        // return  view('admin/kas/kaskeluar/edit', compact('kaskeluar', 'sumberkeluar'));
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
        // $request->validate([
        //     'tanggal' => 'required',
        //     'bukti' => 'required|mimes:jpg,jpeg,png',
        //     'jumlah' => 'required',
        //     'sumberkeluar' => 'required',
        // ]);

        $kaskeluar = Kaskeluar::find($id);
        $kaskeluar->tanggal = $request->input('tanggal');
        $kaskeluar->jumlah = $request->input('jumlah');
        $kaskeluar->deskripsi = $request->input('deskripsi');
        $kaskeluar->id_sumberkeluar = $request->input('id_sumberkeluar');
        $kaskeluar->id_user = $request->input('id_user');

        if ($request->hasFile('bukti')) {
            $destinasi = 'upload/bukti/' . $kaskeluar->bukti;
            if (File::exists($destinasi)) {
                File::delete($destinasi);
            }

            $file = $request->file('bukti');
            $extensi = $file->getClientOriginalExtension();
            $namafile = time() . '.' . $extensi;
            $file->move('upload/bukti/', $namafile);
            $kaskeluar->bukti = $namafile;
        }

        $kaskeluar->update([
            'tanggal' => request('tanggal'),
            'jumlah' => request('jumlah'),
            'deskripsi' => Str::title($request->deskripsi),
            'id_sumberkeluar' => request('sumberkeluar'),
            'id_user' => Auth::user()->id
        ]);

        Alert::success('Sukses', 'Data Arus Kas Keluar Berhasil Diubah');
        return redirect('/kaskeluar');
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
            ->showConfirmButton('<a href="/kaskeluar/' . $id . '/delete"
            class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
            ->showCancelButton('Batal', '#aaa')->reverseButtons();
        return redirect('/kaskeluar');
    }

    public function delete($id)
    {
        $kaskeluar = Kaskeluar::select('bukti', 'id')->whereId($id)->where('id_user', Auth::user()->id)->first();
        File::delete('upload/bukti/' . $kaskeluar->bukti);
        Kaskeluar::whereId($id)->delete();

        Alert::success('Sukses', 'Data Arus Kas Keluar Berhasil Dihapus');
        return redirect('/kaskeluar');
    }

    public function kaskeluarpdf(Request $request, $awal = false, $akhir = false)
    {
        if ($awal) {
            $kaskeluarpdf = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'bukti', 'id_sumberkeluar')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', Auth::user()->id)
                ->paginate();
            $jumlah = Kaskeluar::where('id_user', Auth::user()->id)
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)
                ->sum('jumlah');
        } else {
            $kaskeluarpdf = Kaskeluar::all()->where('id_user', Auth::user()->id);
            $jumlah = Kaskeluar::where('id_user', Auth::user()->id)
                ->sum('jumlah');
        }

        $pdf = PDF::loadView('admin/kas/kaskeluar/kaskeluarpdf', compact('awal', 'akhir', 'kaskeluarpdf', 'jumlah'));
        return $pdf->stream();
    }
}
