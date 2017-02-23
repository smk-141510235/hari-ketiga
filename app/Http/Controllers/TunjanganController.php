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
use App\Jabatan;
use App\Golongan;
use App\Tunjangans;
USE Validator;
class TunjanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
 public function __construct()
    {
        $this->middleware('Bendahara');
    }
   
    public function index()
    {
        $tunjangan=Tunjangans::all();
       $tunjangan=Tunjangans::where('Kode_tunjangan',request ('Kode_tunjangan'))->paginate(0);
       if (request()->has('Kode_tunjangan')) {
           # code...
        $tunjangan=Tunjangans::where('Kode_tunjangan',request ('Kode_tunjangan'))->paginate(0);
       }
        else{
            $tunjangan=Tunjangans::paginate(3);
        }
        return view('Tunjangan.index',compact('tunjangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        return view('Tunjangan.create',compact('jabatan','golongan')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $jab=['Kode_tunjangan' => 'required|unique:tunjangans,Kode_tunjangan',
            'jabatan_id' => 'required',
            'golongan_id' => 'required',
            'Status' => 'required',
            'Jumlah_anak' => 'required',
            'Besaran_uang' => 'required', ];
        $atan=[
            'Kode_tunjangan.required' => 'harus diisi!',
            'Kode_tunjangan.unique' => 'data sudah ada!',
            'jabatan_id.required' => 'harus diisi!',
            'golongan_id.required' => 'harus diisi!',
            'Status.required' => 'harus diisi!',
            'Jumlah_anak.required' => 'harus diisi!',
            'Besaran_uang.required' => 'harus diisi!',
            ];
        $validasi = Validator::make(Input::all(),$jab,$atan);
        if($validasi->fails()){
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();
        }
        $tunjangan = $request::all();
        Tunjangans::create($tunjangan);
        return redirect('Tunjangan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Tunjangans::find($id);
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        return view('Tunjangan.show',compact('data','jabtan','golongan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Tunjangans::find($id);
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        return view('Tunjangan.edit',compact('data','jabatan','golongan'));
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
        $data = Tunjangans::find($id);
        $data->update($dataUpdate);
        return redirect('Tunjangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tunjangans::find($id)->delete();
        return redirect('Tunjangan');
    }
}
