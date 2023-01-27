<?php

namespace App\Http\Controllers;

use App\Models\kategori_layanan;
use App\Models\layanan;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class KategoriLayananController extends Controller
{

    public function checkSlug(request $request){
        $slug = SlugService::createSlug(kategori_layanan::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
    
    public function index(){
        return view('kategori_layanan.index',[
            'title' => 'Kategori Layanan',
            'kategori_layanan' => kategori_layanan::all()
        ]);
    }

    public function create()
    {
        return view('kategori_layanan.create',[
            'title'=>'Tambah Data Kategori Layanan'
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:30',
            'slug' => 'required|unique:kategori_layanan',
        ]);

        kategori_layanan::create($validatedData);

        return redirect('/kategori_layanan')->with('success','New Kategori Layanan has been added');
    }

    public function show(kategori_layanan $kategori_layanan)
    {
        // return 'mgapain';
    }

    
    public function edit(kategori_layanan $kategori_layanan)
    {
        return view('kategori_layanan.edit',[
            'title' => 'Edit kategori Layanan',
            'kategori_layanan' => $kategori_layanan,
        ]);
    }

    public function update(Request $request, kategori_layanan $kategori_layanan)
    {
        $rules = [
            'nama' => 'required|max:30',
            'slug' => 'required',
        ];

        if($request->slug != $kategori_layanan->slug){
            $rules['slug'] = 'required|unique:kategori_layanan';
        }

        $validatedData = $request->validate($rules);

        kategori_layanan::where('slug',$kategori_layanan->slug)
        ->update($validatedData);
        // return $validatedData;
        return redirect('/kategori_layanan')->with('success','Kategori layanan berhsil diupdate!');
    }


    public function destroy(kategori_layanan $kategori_layanan)
    {
        // return layanan::all();  //  YES
        // return layanan::where('kategori_layanan_id',$kategori_layanan->id)->get(); 

        if(layanan::where('kategori_layanan_id',$kategori_layanan->id)->get()->isEmpty()){
            kategori_layanan::destroy($kategori_layanan->id);
            return redirect('/kategori_layanan')->with('success','berhasil menghapus');
        }else{
            return redirect('/kategori_layanan')->with('fail','kategori '.$kategori_layanan->nama.' masih memiliki data layanan');
        }
    }

    
}