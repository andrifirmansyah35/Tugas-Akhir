<?php

namespace App\Http\Controllers;

use App\Models\skema_operasi;
use App\Models\kategori_operasi;
use Illuminate\Http\Request;

class SkemaOperasiController extends Controller
{
    public function hapusSkemaOperasi(Request $request){
        // return $request;
        skema_operasi::where('id',$request->skema_operasi_id)->delete();
        return redirect('/kategori_operasi/'.$request->kategori_operasi_slug)->with('success','Sukses menghapus skema operasi');
    }
    
    public function tambahSkemaOperasi(Request $request){
        
        $validatedData = $request->validate([
            'kategori_operasi_id' => 'required',
            'waktu_mulai' => 'required|max:5|min:5',
            'waktu_selesai' => 'required|max:5|min:5',
        ]);

        // fungsin untuk menjumlahkan waktu
        function getTotalMinutes($string_waktu){
            $array_waktu = str_split($string_waktu);
            $waktu_jam = intval($array_waktu[0].$array_waktu[1]);
            $waktu_menit = intval($array_waktu[3].$array_waktu[4]);

            // konfersi ke menit waktu
            return ($waktu_jam * 60) + $waktu_menit;
        }
        
        // // algo menambahkan jam dan menit
        // $array_waktu_mulai = str_split($request->waktu_mulai);
        // $waktu_mulai_jam = intval($array_waktu_mulai[0].$array_waktu_mulai[1]);
        // $waktu_mulai_menit = intval($array_waktu_mulai[3].$array_waktu_mulai[4]);
        
        // $array_waktu_selesai = str_split($request->waktu_selesai);
        // $waktu_selesai_jam = intval($array_waktu_selesai[0].$array_waktu_selesai[1]);
        // $waktu_selesai_menit = intval($array_waktu_selesai[3].$array_waktu_selesai[4]);
    
        
        // // konfersi menit waktu operasi
        // $total_menit_waktu_mulai = ($waktu_mulai_jam * 60) + $waktu_mulai_menit;
        // $total_menit_waktu_selesai = ($waktu_selesai_jam * 60) + $waktu_selesai_menit;

        $total_menit_waktu_mulai = getTotalMinutes($request->waktu_mulai);
        $total_menit_waktu_selesai = getTotalMinutes($request->waktu_selesai); 

        // cek besar waktu 
        $cek_skema_operasi_a = false;
        
        if($total_menit_waktu_mulai < $total_menit_waktu_selesai){
            $cek_skema_operasi_a = true;    
        }
        else if($total_menit_waktu_mulai == $total_menit_waktu_selesai){
            return redirect('/kategori_operasi/'.$request->kategori_operasi_slug)->with('fail','data waktu mulai tidak boleh sama dengan waktu selesai');
        }else{
            return redirect('/kategori_operasi/'.$request->kategori_operasi_slug)->with('fail','data waktu mulai tidak boleh melebihi waktu selesai');
        }
            
        // cek database skema operasi 
        if(skema_operasi::where('kategori_operasi_id',$request->kategori_operasi_id)->get()->isEmpty()){
            skema_operasi::create($validatedData);
            return redirect('/kategori_operasi/'.$request->kategori_operasi_slug)->with('success','Sukses menambahklan data skema operasi');
        }
        
        // cek data terakhir : cari data terakhir
        $data_terakhir_skema_operasi =  skema_operasi::where('kategori_operasi_id',$request->kategori_operasi_id)->latest()->first();

        $data_terakhir_waktu_mulai = $data_terakhir_skema_operasi['waktu_mulai'];
        $data_terakhir_waktu_selesai = $data_terakhir_skema_operasi['waktu_selesai'];

        // membandingkan jumlahkan data waktu baru dengan data terakhir 
        

        // cek apakah data waktu terakhir lebih kecil
        // if($data_terakhir_skema_operasi)

        return [
            [
                'kategori operasi id' => $request->kategori_operasi_id,
                'kategori operasi slug' => $request->kategori_operasi_slug,
            ],
            [
                'waktu mulai jam' => $request->waktu_mulai,
                'waktu mulai menit'=> $request->waktu_selesai
            ],
            // [
            //     'waktu mulai jam' => $waktu_mulai_jam,
            //     'waktu mulai menit'=> $waktu_mulai_menit
            // ],
            // [
            //     'waktu selesai jam' => $waktu_selesai_jam,
            //     'waktu selesai menit' => $waktu_selesai_menit,
            // ],
            [
                'total menit waktu mulai' => $total_menit_waktu_mulai,
                'total menit waktu selesai' => $total_menit_waktu_selesai,
            ],
            [
                'data terakhir skema operasi array' => $data_terakhir_skema_operasi
            ],
            [
                'data terakhir skema operasi waktu mulai' => $data_terakhir_waktu_mulai,
                'data terakhir skema operasi waktu selesai' => $data_terakhir_waktu_selesai,
            ]
        ];
    }

    
}