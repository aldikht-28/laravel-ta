<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="stylepdf.css">
</head>

<body>

    <table id="tabel1" style="margin-left:auto;margin-right:auto">
        <tr>
            <td style="text-align: center;">
                <font size="4" style="text-transform: uppercase">DATA ARUS KAS MASUK
                    {{ auth()->user()->name }}</font><br>
                <font size="5"> <b>YAYASAN AL-BAHRI DESA LEMAHBANGKULON</b> </font><br>
                <font size="2">Jl. Tawang Alun No.77, Talangrejo, Lemahbang Kulon, Kec. Singojuruh, Kabupaten
                    Banyuwangi, Jawa Timur 68464</font><br>
                @if ($awal)
                    <font size="3">Data Arus kas kasuk periode tanggal
                        {{ Carbon\Carbon::parse($awal)->translatedFormat('d F Y') }} s/d
                        {{ Carbon\Carbon::parse($akhir)->translatedFormat('d F Y') }}</font><br>
                @else
                @endif
            </td>
        </tr>
    </table>
    <br><br>


    <table id="customers">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
            {{-- <th>total</th> --}}
        </tr>
        @foreach ($kasmasuk as $row)
            <tr>
                <th width='4%'>{{ $loop->iteration }}</th>
                <td>
                    {{ Carbon\Carbon::parse($row->tanggal)->translatedFormat('l, d F Y') }}
                </td>
                <td>{{ $row->sumbermasuk->nama }}</td>
                <td>{{ $row->deskripsi }}</td>
                <td>{{ matauangID($row->jumlah) }}</td>
                {{-- <td></td> --}}
            </tr>
        @endforeach
        <tr>
            <th style="text-align: center" colspan="4">Total Arus Kas Masuk</th>
            <td style="font-weight: bold">{{ matauangID($jumlah) }}</td>
        </tr>
    </table>

</body>

</html>
