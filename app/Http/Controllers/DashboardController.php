<?php

namespace App\Http\Controllers;

use App\Models\Kaskeluar;
use App\Models\Kasmasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kasmasuk = Kasmasuk::where('id_user', Auth::user()->id)->sum('jumlah');
        $kaskeluar = Kaskeluar::where('id_user', Auth::user()->id)->sum('jumlah');

        $kas_masuk = Kasmasuk::where('id_user', Auth::user()->id)->count();
        $kas_keluar = Kaskeluar::where('id_user', Auth::user()->id)->count();

        $masuk_jan = Kasmasuk::whereMonth('tanggal', '01')->where('id_user', Auth::user()->id)->sum('jumlah');
        $masuk_feb = Kasmasuk::whereMonth('tanggal', '02')->where('id_user', Auth::user()->id)->sum('jumlah');
        $masuk_mar = Kasmasuk::whereMonth('tanggal', '03')->where('id_user', Auth::user()->id)->sum('jumlah');
        $masuk_apr = Kasmasuk::whereMonth('tanggal', '04')->where('id_user', Auth::user()->id)->sum('jumlah');
        $masuk_mei = Kasmasuk::whereMonth('tanggal', '05')->where('id_user', Auth::user()->id)->sum('jumlah');
        $masuk_jun = Kasmasuk::whereMonth('tanggal', '06')->where('id_user', Auth::user()->id)->sum('jumlah');
        $masuk_jul = Kasmasuk::whereMonth('tanggal', '07')->where('id_user', Auth::user()->id)->sum('jumlah');
        $masuk_agu = Kasmasuk::whereMonth('tanggal', '08')->where('id_user', Auth::user()->id)->sum('jumlah');
        $masuk_sep = Kasmasuk::whereMonth('tanggal', '09')->where('id_user', Auth::user()->id)->sum('jumlah');
        $masuk_okt = Kasmasuk::whereMonth('tanggal', '10')->where('id_user', Auth::user()->id)->sum('jumlah');
        $masuk_nov = Kasmasuk::whereMonth('tanggal', '11')->where('id_user', Auth::user()->id)->sum('jumlah');
        $masuk_des = Kasmasuk::whereMonth('tanggal', '12')->where('id_user', Auth::user()->id)->sum('jumlah');

        $keluar_jan = Kaskeluar::whereMonth('tanggal', '01')->where('id_user', Auth::user()->id)->sum('jumlah');
        $keluar_feb = Kaskeluar::whereMonth('tanggal', '02')->where('id_user', Auth::user()->id)->sum('jumlah');
        $keluar_mar = Kaskeluar::whereMonth('tanggal', '03')->where('id_user', Auth::user()->id)->sum('jumlah');
        $keluar_apr = Kaskeluar::whereMonth('tanggal', '04')->where('id_user', Auth::user()->id)->sum('jumlah');
        $keluar_mei = Kaskeluar::whereMonth('tanggal', '05')->where('id_user', Auth::user()->id)->sum('jumlah');
        $keluar_jun = Kaskeluar::whereMonth('tanggal', '06')->where('id_user', Auth::user()->id)->sum('jumlah');
        $keluar_jul = Kaskeluar::whereMonth('tanggal', '07')->where('id_user', Auth::user()->id)->sum('jumlah');
        $keluar_agu = Kaskeluar::whereMonth('tanggal', '08')->where('id_user', Auth::user()->id)->sum('jumlah');
        $keluar_sep = Kaskeluar::whereMonth('tanggal', '09')->where('id_user', Auth::user()->id)->sum('jumlah');
        $keluar_okt = Kaskeluar::whereMonth('tanggal', '10')->where('id_user', Auth::user()->id)->sum('jumlah');
        $keluar_nov = Kaskeluar::whereMonth('tanggal', '11')->where('id_user', Auth::user()->id)->sum('jumlah');
        $keluar_des = Kaskeluar::whereMonth('tanggal', '12')->where('id_user', Auth::user()->id)->sum('jumlah');

        return view('dashboard', compact(
            'kasmasuk',
            'kaskeluar',

            'kas_masuk',
            'kas_keluar',

            'masuk_jan',
            'masuk_feb',
            'masuk_mar',
            'masuk_apr',
            'masuk_mei',
            'masuk_jun',
            'masuk_jul',
            'masuk_agu',
            'masuk_sep',
            'masuk_okt',
            'masuk_nov',
            'masuk_des',

            'keluar_jan',
            'keluar_feb',
            'keluar_mar',
            'keluar_apr',
            'keluar_mei',
            'keluar_jun',
            'keluar_jul',
            'keluar_agu',
            'keluar_sep',
            'keluar_okt',
            'keluar_nov',
            'keluar_des',

        ));
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
        //
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
        //
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
