<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasmasuk;
use App\Models\SumberMasuk;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Str;

class KasmasukController extends Controller
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
        $sumber = $request->input('sumber');

        $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', Auth::user()->id)->get();

        $kasmasuk = Kasmasuk::with('sumbermasuk')->where('id_user', Auth::user()->id)->orderBy('tanggal', 'desc')->latest()->paginate(5);

        $jumlah = Kasmasuk::where('id_user', Auth::user()->id)->sum('jumlah');

        return  view('admin/kas/kasmasuk/index', compact('kasmasuk', 'jumlah', 'awal', 'akhir', 'sumbermasuk', 'deskripsi', 'sumber'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', Auth::user()->id)->get();
        // return  view('admin/kas/kasmasuk/create', compact('sumbermasuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (request('jumlah')) {
            $request->validate([
                'tanggal' => 'required',
                'jumlah' => 'required',
                // 'deskripsi' => 'required',
                'sumbermasuk' => 'required',
            ]);

            Kasmasuk::create([
                'tanggal' => request('tanggal'),
                'jumlah' => request('jumlah'),
                'id_sumbermasuk' => request('sumbermasuk'),
                'deskripsi' => Str::title($request->deskripsi),
                'id_user' => Auth::user()->id
            ]);

            Alert::success('Sukses', 'Data Arus Kas Masuk Berhasil Ditambah');
            return redirect('/kasmasuk');
        } else {
            $awal = $request->input('awal');
            $akhir = $request->input('akhir');
            $deskripsi = $request->input('deskripsi');
            $sumber = $request->input('sumber');

            $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', Auth::user()->id)->get();

            if ($request->deskripsi && $request->sumber && $request->awal) {
                $kasmasuk = Kasmasuk::where('deskripsi', 'LIKE', '%' . $request->deskripsi . '%')
                    ->where('id_sumbermasuk', 'LIKE', '%' . $request->sumber . '%')
                    ->where('tanggal', '>=', $awal)
                    ->where('tanggal', '<=', $akhir)
                    ->where('id_user', Auth::user()->id)->paginate();
                $jumlah = Kasmasuk::where('id_user', Auth::user()->id)->sum('jumlah');
            } else
            if ($request->awal) {
                $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')
                    ->where('tanggal', '>=', $awal)
                    ->where('tanggal', '<=', $akhir)->where('id_user', Auth::user()->id)
                    ->paginate();
                $jumlah = Kasmasuk::where('id_user', Auth::user()->id)
                    ->where('tanggal', '>=', $awal)
                    ->where('tanggal', '<=', $akhir)
                    ->sum('jumlah');
            } else if ($request->deskripsi) {
                $kasmasuk = Kasmasuk::where('deskripsi', 'LIKE', '%' . $deskripsi . '%')
                    ->where('id_user', Auth::user()->id)->latest()
                    ->paginate();
                $jumlah = Kasmasuk::where('id_user', Auth::user()->id)
                    ->where('deskripsi', 'LIKE', '%' . $deskripsi . '%')
                    ->sum('jumlah');
            } else if ($request->sumber) {
                $kasmasuk = Kasmasuk::where('id_sumbermasuk', 'LIKE', '%' . $sumber . '%')
                    ->where('id_user', Auth::user()->id)->latest()
                    ->paginate();
                $jumlah = Kasmasuk::where('id_user', Auth::user()->id)
                    ->where('id_sumbermasuk', 'LIKE', '%' . $sumber . '%')
                    ->sum('jumlah');
            } else {
                $jumlah = Kasmasuk::where('id_user', Auth::user()->id)->sum('jumlah');
                // $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')->where('id_user', Auth::user()->id)->latest()->paginate(5);
                return redirect('/kasmasuk');
            }
            // dd($kasmasuk);
            return view('admin/kas/kasmasuk/index', compact('kasmasuk', 'jumlah', 'awal', 'akhir', 'sumbermasuk', 'deskripsi', 'sumber'));
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
        // $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', Auth::user()->id)->get();
        $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')->whereId($id)->where('id_user', Auth::user()->id)->firstOrFail();
        return  view('admin/kas/kasmasuk/show', compact('kasmasuk', 'sumbermasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $sumbermasuk = SumberMasuk::select('id', 'nama')->get();
        // $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')->whereId($id)->where('id_user', Auth::user()->id)->first();
        // return  view('admin/kas/kasmasuk/edit', compact('kasmasuk', 'sumbermasuk'));
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
            'tanggal' => 'required',
            'jumlah' => 'required',
            // 'deskripsi' => 'required',
            'sumbermasuk' => 'required',
        ]);

        Kasmasuk::whereId($id)->update([
            'tanggal' => request('tanggal'),
            'jumlah' => request('jumlah'),
            'deskripsi' => Str::title($request->deskripsi),
            'id_sumbermasuk' => request('sumbermasuk'),
            'id_user' => Auth::user()->id
        ]);

        Alert::success('Sukses', 'Data Arus Kas Masuk Berhasil Diubah');
        return redirect('/kasmasuk');
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
            ->showConfirmButton('<a href="kasmasuk/' . $id . '/delete"
            class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
            ->showCancelButton('Batal', '#aaa')->reverseButtons();
        return redirect('/kasmasuk');
    }

    public function delete($id)
    {
        Kasmasuk::whereId($id)->where('id_user', Auth::user()->id)->delete();

        Alert::success('Sukses', 'Data Arus Kas Masuk Berhasil Dihapus');
        return redirect('/kasmasuk');
    }

    public function kasmasukpdf(Request $request, $awal = false, $akhir = false, $sumber = false)
    {
        // return dd($sumber);

        if ($awal) {
            $kasmasuk = Kasmasuk::where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', Auth::user()->id)->get();
            $jumlah = Kasmasuk::where('id_user', Auth::user()->id)->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->sum('jumlah');
        } else if ($sumber) {
            $kasmasuk = Kasmasuk::where('id_sumbermasuk', 'LIKE', '%' . $sumber . '%')
                ->where('id_user', Auth::user()->id)
                ->get();
            $jumlah = Kasmasuk::where('id_user', Auth::user()->id)
                ->where('id_sumbermasuk', 'LIKE', '%' . $sumber . '%')
                ->sum('jumlah');
        } else {
            $kasmasuk = Kasmasuk::all()->where('id_user', Auth::user()->id);
            $jumlah = Kasmasuk::where('id_user', Auth::user()->id)->sum('jumlah');
        }

        $pdf = FacadePdf::loadView('admin/kas/kasmasuk/kasmasukpdf', compact('awal', 'akhir', 'kasmasuk', 'jumlah'));
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream();
    }
}
