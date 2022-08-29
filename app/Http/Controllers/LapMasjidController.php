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

class LapMasjidController extends Controller
{
    public function index(Request $request)

    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', 1)->get();
        $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')->where('id_user', 1)->orderBy('tanggal', 'desc')->latest()->paginate(5);
        $jumlahmasuk = Kasmasuk::where('id_user', 1)->sum('jumlah');

        $sumberkeluar = SumberKeluar::select('id', 'nama')->where('id_user', 1)->get();
        $kaskeluar = Kaskeluar::select('id', 'tanggal', 'bukti', 'jumlah', 'deskripsi', 'id_sumberkeluar')->where('id_user', 1)->orderBy('tanggal', 'desc')->latest()->paginate(5);
        $jumlahkeluar = Kaskeluar::where('id_user', 1)->sum('jumlah');

        return  view('laporan/lapmas', compact('kasmasuk', 'jumlahmasuk', 'jumlahkeluar', 'awal', 'akhir', 'sumbermasuk', 'sumberkeluar', 'kaskeluar',));
    }

    public function carilaporanmas(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', 1)->get();
        $jumlahmasuk = Kasmasuk::where('id_user', 1)->sum('jumlah');

        $sumberkeluar = SumberKeluar::select('id', 'nama')->where('id_user', 1)->get();
        $jumlahkeluar = Kaskeluar::where('id_user', 1)->sum('jumlah');

        if (request()->awal) {
            $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 1)
                ->paginate();
            if (count($kasmasuk) == 0) {
                Alert::warning('Pencarian', 'Data arus kas masuk yang anda cari tidak ditemukan');
            }
        }
        if (request()->awal) {
            $kaskeluar = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'bukti', 'id_sumberkeluar')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 1)
                ->paginate();
            if (count($kaskeluar) == 0) {
                Alert::warning('Pencarian', 'Data arus kas keluar yang anda cari tidak ditemukan');
            }
        } else {
            return redirect('/laporanmasjid');
            // $kaskeluar = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumberkeluar')->where('id_user', 1)->latest()->paginate(5);
        }

        return view('laporan/lapmas', compact('kaskeluar', 'kasmasuk', 'sumbermasuk', 'jumlahmasuk', 'jumlahkeluar', 'awal', 'akhir', 'sumberkeluar'));
    }

    public function lapmaspdf(Request $request, $awal = false, $akhir = false)
    {

        $tanggal = Carbon::now()->toDateTimeString();
        if ($awal) {
            $lapmasukpdf = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 1)->paginate();
            $jumlahmasuk = Kasmasuk::where('id_user', 1)->sum('jumlah');
            $jumlahmasuk1 = Kasmasuk::where('id_user', 1)
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->sum('jumlah');
        }
        if ($awal) {
            $lapkeluarpdf = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumberkeluar')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 1)
                ->paginate();
            $jumlahkeluar = Kaskeluar::where('id_user', 1)->sum('jumlah');
            $jumlahkeluar1 = Kaskeluar::where('id_user', 1)
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->sum('jumlah');
        } else {
            $lapmasukpdf = Kasmasuk::all()->where('id_user', 1);
            $jumlahmasuk = Kasmasuk::where('id_user', 1)->sum('jumlah');
            $jumlahmasuk1 = Kasmasuk::where('id_user', 1)->sum('jumlah');

            $lapkeluarpdf = Kaskeluar::all()->where('id_user', 1);
            $jumlahkeluar = Kaskeluar::where('id_user', 1)->sum('jumlah');
            $jumlahkeluar1 = Kaskeluar::where('id_user', 1)->sum('jumlah');
        }

        $pdf = PDF::loadView('laporan/lapmaspdf', compact(
            'awal',
            'akhir',
            'tanggal',
            'lapmasukpdf',
            'lapkeluarpdf',
            'jumlahmasuk',
            'jumlahmasuk1',
            'jumlahkeluar',
            'jumlahkeluar1',
        ));
        return $pdf->stream();
    }
}
