<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\kategori_layanan;
use App\Models\kategori_operasi;
use App\Models\layanan;
use App\Models\tanggal_operasi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. seed user
        \App\Models\User::factory(10)->create();


        // 2. seed kategori layanan
        kategori_layanan::create(['nama' => 'Perawatan Rambut']);
        kategori_layanan::create(['nama' => 'Serba Lulur']);
        kategori_layanan::create(['nama' => 'SPA']);
        kategori_layanan::create(['nama' => 'Perawatan Tangan dan Kaki']);
        kategori_layanan::create(['nama' => 'Perawatan Wajah']);
        kategori_layanan::create(['nama' => 'Serba Pijat dan Urut']);

        // 3. seed layanan
        $data_layanan = [
            [1, 'haircut', 20000, true],
            [1, 'cuciblow', 20000, true],
            [1, 'creambat organik ', 60000, true],
            [1, 'creambat natural', 50000, true],
            [1, 'hair spa matrix', 70000, true],
            [1, 'henna', 50000, true],
            [1, 'coloring hair', 60000, true],
            [1, 'rebonding', 150000, true],
            [1, 'har treatment', 20000, true],
            [2, 'tradisional', 110000, true],
            [2, 'organik', 110000, true],
            [2, 'whitening', 110000, true],
            [2, 'dewi sri', 110000, true],
            [2, 'cangkag watnut', 150000, true],
            [3, 'coklat', 145000, true],
            [3, 'whitening', 150000, true],
            [3, 'strawberry', 125000, true],
            [3, 'dewi sri', 240000, true],
            [3, 'aromaterapy essential', 250000, true],
            [4, 'manicure', 40000, true],
            [4, 'pedicure', 50000, true],
            [4, 'Hand SPA Special', 45000, true],
            [4, 'Foot SPA', 55000, true],
            [4, 'Foot SPA Special', 75000, true],
            [5, 'totok wajah', 35000, true],
            [5, 'totok mata', 35000, true],
            [5, 'totok migran kolestrol', 100000, true],
            [5, 'totok wajah lumispa', 100000, true],
            [5, 'facial punggung', 50000, true],
            [5, 'facial message tererapy', 45000, true],
            [5, 'facial natural', 50000, true],
            [5, 'facial wardah', 60000, true],
            [5, 'facial Biokos', 65000, true],
            [5, 'facial anti acne', 100000, true],
            [5, 'facial whitening', 100000, true],
            [6, 'sauna', 15000, true],
            [6, 'pijat punggung dan kaki', 35000, true],
            [6, 'masker payudara', 40000, true],
            [6, 'refleksi', 45000, true],
            [6, 'pijat balita (1-5)', 55000, true],
            [6, 'pijat anak (5-10)', 60000, true],
            [6, 'body aroma terapy message', 80000, true],
            [6, 'essential body message', 150000, true],
            [6, 'ratus v', 35000, true],
            [6, 'bekam sehat', 65000, true],
            [6, 'waxing', 75000, true],
        ];

        foreach ($data_layanan as $layanan) {
            layanan::create([
                'kategori_layanan_id' => $layanan[0],
                'nama' => $layanan[1],
                'harga' => $layanan[2],
                'status' => $layanan[3]
            ]);
        }


        //5. kategori operasi seed
        kategori_operasi::create(['nama' => 'khusus jum at']);
        kategori_operasi::create(['nama' => 'hari biasa']);
        kategori_operasi::create(['nama' => 'khusus weekend']);
        kategori_operasi::create(['nama' => 'peringatan kemerdekaan']);

        // 4. seed tangal operasi
        $jumlah_tanggal = 10;
        for ($i = 0; $i < $jumlah_tanggal; $i++) {
            $tambah_hari = "+" . strval($i) . "day";
            $tanggal = strtotime($tambah_hari);

            tanggal_operasi::create([
                    'kategori_operasi_id' => mt_rand(1,4),
                    'tanggal_operasi' => date('Y-m-d', $tanggal),
                    'tanggal' => intval(date('d', $tanggal)),
                    'bulan' => intval(date('m', $tanggal)),
                    'tahun' => intval(date('Y', $tanggal))
                ]);
            }
                
        
        
    }
}
