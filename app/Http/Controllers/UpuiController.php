<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpuiController extends Controller
{
    // LIST DATA
    public function index()
    {
        $banner = DB::table('banner')->get();
        return view('upui.index', compact('banner'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('upui.create');
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'subjudul' => 'required',
            'gambar' => 'required|image'
        ]);

        $file = $request->file('gambar');
        $nama = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $nama);

        DB::table('banner')->insert([
            'judul'=>$request->judul,
            'subjudul'=>$request->subjudul,
            'gambar'=>'uploads/'.$nama
        ]);

        return redirect()->route('admin.upui.index')
                ->with('success','Banner berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $banner = DB::table('banner')->where('id',$id)->first();
        return view('upui.edit', compact('banner'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $data = [
            'judul'=>$request->judul,
            'subjudul'=>$request->subjudul
        ];

        if($request->gambar){
            $file = $request->file('gambar');
            $nama = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $nama);

            $data['gambar'] = 'uploads/'.$nama;
        }

        DB::table('banner')->where('id',$id)->update($data);

        return redirect()->route('admin.upui.index')
                ->with('success','Banner berhasil diupdate');
    }

    // HAPUS
    public function destroy($id)
    {
        DB::table('banner')->where('id',$id)->delete();

        return redirect()->route('admin.upui.index')
                ->with('success','Banner berhasil dihapus');
    }
}