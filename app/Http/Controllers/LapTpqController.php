<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasmasuk;
use App\Models\Kaskeluar;
use App\Models\SumberKeluar;
use App\Models\SumberMasuk;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class LapTpqController extends Controller
{
    public function index(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', 3)->get();
        $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')->where('id_user', 3)->latest()->paginate(5);
        $jumlahmasuk = Kasmasuk::where('id_user', 3)->sum('jumlah');

        $sumberkeluar = SumberKeluar::select('id', 'nama')->where('id_user', 3)->get();
        $kaskeluar = Kaskeluar::select('id', 'tanggal', 'bukti', 'jumlah', 'deskripsi', 'id_sumberkeluar')->where('id_user', 3)->latest()->paginate(5);
        $jumlahkeluar = Kaskeluar::where('id_user', 3)->sum('jumlah');

        return  view('laporan/laptpq', compact('kasmasuk', 'jumlahmasuk', 'jumlahkeluar', 'awal', 'akhir', 'sumbermasuk', 'sumberkeluar', 'kaskeluar',));
    }

    public function carilaporantpq(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', 3)->get();
        $jumlahmasuk = Kasmasuk::where('id_user', 3)->sum('jumlah');

        $sumberkeluar = SumberKeluar::select('id', 'nama')->where('id_user', 3)->get();
        $jumlahkeluar = Kaskeluar::where('id_user', 3)->sum('jumlah');

        if (request()->awal) {
            $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 3)
                ->paginate();
            if (count($kasmasuk) == 0) {
                Alert::warning('Pencarian', 'Data yang anda cari tidak ditemukan');
            }
        }
        if (request()->awal) {
            $kaskeluar = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'bukti', 'id_sumberkeluar')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 3)
                ->paginate();
            if (count($kaskeluar) == 0) {
                Alert::warning('Pencarian', 'Data yang anda cari tidak ditemukan');
            }
        } else {
            return redirect('/laporantpq');
            // $kaskeluar = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumberkeluar')->where('id_user', 3)->latest()->paginate(5);
        }

        return view('laporan/laptpq', compact('kaskeluar', 'kasmasuk', 'sumbermasuk', 'jumlahmasuk', 'jumlahkeluar', 'awal', 'akhir', 'sumberkeluar'));
    }

    public function laptpqpdf(Request $request, $awal = false, $akhir = false)
    {

        $tanggal = Carbon::now()->toDateTimeString();
        if ($awal) {
            $laptpqmasukpdf = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 3)->paginate();
            $jumlahmasuk = Kasmasuk::where('id_user', 3)->sum('jumlah');
            $jumlahmasuk1 = Kasmasuk::where('id_user', 3)
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->sum('jumlah');
        }
        if ($awal) {
            $laptpqkeluarpdf = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'bukti', 'id_sumberkeluar')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 3)
                ->paginate();
            $jumlahkeluar = Kaskeluar::where('id_user', 3)->sum('jumlah');
            $jumlahkeluar1 = Kaskeluar::where('id_user', 3)
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->sum('jumlah');
        } else {
            $laptpqmasukpdf = Kasmasuk::all()->where('id_user', 3);
            $jumlahmasuk = Kasmasuk::where('id_user', 3)->sum('jumlah');
            $jumlahmasuk1 = Kasmasuk::where('id_user', 3)->sum('jumlah');

            $laptpqkeluarpdf = Kaskeluar::all()->where('id_user', 3);
            $jumlahkeluar = Kaskeluar::where('id_user', 3)->sum('jumlah');
            $jumlahkeluar1 = Kaskeluar::where('id_user', 3)->sum('jumlah');
        }


        $pdf = PDF::loadView('laporan/laptpqpdf', compact(
            'awal',
            'akhir',
            'tanggal',
            'laptpqmasukpdf',
            'laptpqkeluarpdf',
            'jumlahmasuk',
            'jumlahmasuk1',
            'jumlahkeluar',
            'jumlahkeluar1',
        ));
        return $pdf->stream();
    }
}
