<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="stylepdf.css">
</head>

<body>
    <table id="tabel1" style="margin-left:auto;margin-right:auto">
        <tr>
            <td style="text-align: center;">
                <font size="4" style="text-transform: uppercase">LAPORAN ARUS KAS TPQ AT-TAKWA</font><br>
                <font size="5"> <b>YAYASAN AL-BAHRI DESA LEMAHBANGKULON</b> </font><br>
                <font size="2">Jl. Tawang Alun No.77, Talangrejo, Lemahbang Kulon, Kec. Singojuruh, Kabupaten
                    Banyuwangi, Jawa Timur 68464</font><br>
                @if ($awal)
                    <font size="3">Laporan Arus kas periode tanggal
                        {{ Carbon\Carbon::parse($awal)->translatedFormat('d F Y') }} s/d
                        {{ Carbon\Carbon::parse($akhir)->translatedFormat('d F Y') }}</font><br>
                @else
                @endif
            </td>
        </tr>
    </table>
    <br><br>
    <p style="text-align: right"> {{ Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}</p>
    <table id="customers">
        <tr>
            <th colspan="4">Arus Kas Masuk</th>
        </tr>
        <tr>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
        </tr>
        @foreach ($laptpqmasukpdf as $row)
            <tr>
                <td>
                    {{ Carbon\Carbon::parse($row->tanggal)->translatedFormat('d F Y') }}
                </td>
                <td>{{ $row->sumbermasuk->nama }}</td>
                <td>{{ $row->deskripsi }}</td>
                <td>{{ matauangID($row->jumlah) }}</td>
            </tr>
        @endforeach
        <tr>
            <th style="text-align: center" colspan="3">Total Arus Kas Masuk</th>
            <td style="font-weight: bold">{{ matauangID($jumlahmasuk1) }}</td>
        </tr>
        <tr>
            <th colspan="4">Arus Kas Keluar</th>
        </tr>
        @foreach ($laptpqkeluarpdf as $row)
            <tr>
                <td>
                    {{ Carbon\Carbon::parse($row->tanggal)->translatedFormat('d F Y') }}
                </td>
                <td>{{ $row->sumberkeluar->nama }}</td>
                <td>{{ $row->deskripsi }}</td>
                <td>{{ matauangID($row->jumlah) }}</td>
            </tr>
        @endforeach
        <tr>
            <th style="text-align: center" colspan="3">Total Arus Kas Keluar</th>
            <td style="font-weight: bold">{{ matauangID($jumlahkeluar1) }}</td>
        </tr>
        <tr>
            <th style="text-align: center" colspan="3">Total Saldo Akhir</th>
            <td style="font-weight: bold">{{ matauangID($jumlahmasuk - $jumlahkeluar) }}</td>
        </tr>
    </table>
    <br>

    </table>

</body>

</html>
