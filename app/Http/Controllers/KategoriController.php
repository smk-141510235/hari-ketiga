<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Request;
use App\Http\Controllers\Controller;
use Form;
use Html;
use Input;
use Redirect;
use View;
use App\Kategori_lembur;
use App\Golongan;
use App\Jabatan;
use Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function __construct()
    {
        $this->middleware('Admin');
    }
    
    public function index()
    {
       $kategori=Kategori_lembur::all();
       $kategori=Kategori_lembur::where('Kode_lembur',request ('Kode_lembur'))->paginate(0);
       if (request()->has('Kode_lembur')) {
           # code...
        $kategori=Kategori_lembur::where('Kode_lembur',request ('Kode_lembur'))->paginate(0);
       }
        else{
            $kategori=Kategori_lembur::paginate(3);
        }
        return view('Kategori.index',compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $jabatan = Jabatan::all();
        $gol = Golongan::all();
        return view('Kategori.create',compact('jabatan','gol')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $jab=['Kode_lembur' => 'required|unique:Kategori_lemburs,Kode_lembur',
            'jabatan_id' => 'required',
            'golongan_id' => 'required',
            'Besaran_uang' => 'required', ];
        $atan=[
            'Kode_lembur.required' => 'harus diisi!',
            'Kode_lembur.unique' => 'data sudah ada!',
            'jabatan_id.required' => 'harus diisi!',
            'golongan_id.required' => 'harus diisi!',
            'Besaran_uang.required' => 'harus diisi!',
            ];
        $validasi = Validator::make(Input::all(),$jab,$atan);
        if($validasi->fails()){
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();
        }

        $kategori = $request::all();
        Kategori_lembur::create($kategori);
        return redirect('Kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = kategori_lembur::find($id);
        $jabatan = Jabatan::all();
        $gol = Golongan::all();
        return view('Kategori.show',compact('data','jabatan','gol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = kategori_lembur::find($id);
        $jabatan = Jabatan::all();
        $gol = Golongan::all();
        return view('Kategori.edit',compact('data','jabatan','gol'));
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
        $dataUpdate = Request::all();
        $data = kategori_lembur::find($id);
        $data->update($dataUpdate);
        return redirect('Kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        kategori_lembur::find($id)->delete();
        return redirect('Kategori');
    }
}
