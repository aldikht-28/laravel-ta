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

class LapPaudController extends Controller
{
    public function index(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', 2)->get();
        $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')->where('id_user', 2)->orderBy('tanggal', 'desc')->latest()->paginate(5);
        $jumlahmasuk = Kasmasuk::where('id_user', 2)->sum('jumlah');

        $sumberkeluar = SumberKeluar::select('id', 'nama')->where('id_user', 2)->get();
        $kaskeluar = Kaskeluar::select('id', 'tanggal', 'bukti', 'jumlah', 'deskripsi', 'id_sumberkeluar')->where('id_user', 2)->orderBy('tanggal', 'desc')->latest()->paginate(5);
        $jumlahkeluar = Kaskeluar::where('id_user', 2)->sum('jumlah');

        return  view('laporan/lappaud', compact('kasmasuk', 'jumlahmasuk', 'jumlahkeluar', 'awal', 'akhir', 'sumbermasuk', 'sumberkeluar', 'kaskeluar',));
    }

    public function carilaporanpaud(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $sumbermasuk = SumberMasuk::select('id', 'nama')->where('id_user', 2)->get();
        $jumlahmasuk = Kasmasuk::where('id_user', 2)->sum('jumlah');

        $sumberkeluar = SumberKeluar::select('id', 'nama')->where('id_user', 2)->get();
        $jumlahkeluar = Kaskeluar::where('id_user', 2)->sum('jumlah');

        if (request()->awal) {
            $kasmasuk = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 2)
                ->paginate();
            if (count($kasmasuk) == 0) {
                Alert::warning('Pencarian', 'Data arus kas masuk yang anda cari tidak ditemukan');
            }
        }
        if (request()->awal) {
            $kaskeluar = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'bukti', 'id_sumberkeluar')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 2)
                ->paginate();
            if (count($kaskeluar) == 0) {
                Alert::warning('Pencarian', 'Data arus kas keluar yang anda cari tidak ditemukan');
            }
        } else {
            return redirect('/laporanpaud');
            // $kaskeluar = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumberkeluar')->where('id_user', 2)->latest()->paginate(5);
        }

        return view('laporan/lappaud', compact('kaskeluar', 'kasmasuk', 'sumbermasuk', 'jumlahmasuk', 'jumlahkeluar', 'awal', 'akhir', 'sumberkeluar'));
    }

    public function lappaudpdf(Request $request, $awal = false, $akhir = false)
    {

        $tanggal = Carbon::now()->toDateTimeString();
        if ($awal) {
            $lappaudmasukpdf = Kasmasuk::select('id', 'tanggal', 'jumlah', 'deskripsi', 'id_sumbermasuk')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 2)->paginate();
            $jumlahmasuk = Kasmasuk::where('id_user', 2)->sum('jumlah');
            $jumlahmasuk1 = Kasmasuk::where('id_user', 2)
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->sum('jumlah');
        }
        if ($awal) {
            $lappaudkeluarpdf = Kaskeluar::select('id', 'tanggal', 'jumlah', 'deskripsi', 'bukti', 'id_sumberkeluar')
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->where('id_user', 2)
                ->paginate();
            $jumlahkeluar = Kaskeluar::where('id_user', 2)->sum('jumlah');
            $jumlahkeluar1 = Kaskeluar::where('id_user', 2)
                ->where('tanggal', '>=', $awal)
                ->where('tanggal', '<=', $akhir)->sum('jumlah');
        } else {
            $lappaudmasukpdf = Kasmasuk::all()->where('id_user', 2);
            $jumlahmasuk = Kasmasuk::where('id_user', 2)->sum('jumlah');
            $jumlahmasuk1 = Kasmasuk::where('id_user', 2)->sum('jumlah');

            $lappaudkeluarpdf = Kaskeluar::all()->where('id_user', 2);
            $jumlahkeluar = Kaskeluar::where('id_user', 2)->sum('jumlah');
            $jumlahkeluar1 = Kaskeluar::where('id_user', 2)->sum('jumlah');
        }

        $pdf = PDF::loadView('laporan/lappaudpdf', compact(
            'awal',
            'akhir',
            'tanggal',
            'lappaudmasukpdf',
            'lappaudkeluarpdf',
            'jumlahmasuk',
            'jumlahmasuk1',
            'jumlahkeluar',
            'jumlahkeluar1',
        ));
        return $pdf->stream();
    }
}
