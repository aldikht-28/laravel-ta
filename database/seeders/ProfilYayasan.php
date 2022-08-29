<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfilYayasan;

class ProfilYayasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfilYayasan::create(
            [
                'profily' => ' Yayasan Al-Bahri merupakan sebuah yayasan yang terletak di Jl. Tawang Alun No.77, Dusun Sukorejo, Desa Lemahbangkulon, Kecamatan Singojuruh, Kabupaten Banyuwangi, Provinsi Jawa Timur. Yayasan ini berstatus sebagai badan Ketakmiran Masjid dan Lembaga Pendidikan. Pada Yayasan Al-Bahri memiliki 2 lembaga pendidikan yaitu Taman Pendidikan Al-Qur’an (TPQ) dan Pendidikan Anak Usia Dini (PAUD).',
            ]
        );
    }
}
