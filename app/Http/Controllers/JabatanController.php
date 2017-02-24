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
use Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

 public function __construct()
    {
        $this->middleware('HRD');
    }
     public function index()
    {
        $jabatan=Jabatan::all();
       $jabatan=Jabatan::where('Nama_jabatan',request ('Nama_jabatan'))->paginate(0);
       if (request()->has('Nama_jabatan')) {
           # code...
        $jabatan=Jabatan::where('Nama_jabatan',request ('Nama_jabatan'))->paginate(0);
       }
        else{
            $jabatan=Jabatan::paginate(3);
        }
        return view('Jabatan.index',compact('jabatan'));

    }

    public function create()
    {
        return view('Jabatan.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $jab=['Kode_jabatan' => 'required|unique:jabatans,Kode_jabatan',
            'Nama_jabatan' => 'required','Besaran_uang' =>'required'];
        $atan=[
            'Kode_jabatan.required' => 'harus diisi!',
            'Kode_jabatan.unique' => 'data sudah ada!',
            'Nama_jabatan.required' => 'harus diisi!',
            'Besaran_uang.required' => 'harus diisi!',
            ];
        $validasi = Validator::make(Input::all(),$jab,$atan);
        if($validasi->fails()){
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();
        }

        $jabatan=Request::all();
        Jabatan::create($jabatan);
        return redirect('Jabatan');
    }
  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Jabatan::find($id);
        return view('Jabatan.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Jabatan::find($id);
        return view('Jabatan.edit',compact('data'));
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
        $data = Jabatan::find($id);
        $data->update($dataUpdate);
        return redirect('Jabatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jabatan::find($id)->delete();
        return redirect('Jabatan');
    }
}
