<?php

namespace App\Http\Controllers;
use App\ModelKontak;
use Illuminate\Http\Request;
use Validator;

class kontak extends Controller{
  public function index(){
    $data = ModelKontak::all();
    return view('kontak', compact('data'));
    // return view('newkontak', compact('data'));
  }

  public function create(){
    return view('kontak_create');
  }

  public function store(Request $request){
    $this->validate($request,[
      'nama' => 'required',
      'email' => 'required',
      'nohp' => 'required',
      'alamat' => 'required',
    ]);

    $data = new ModelKontak();
    $data->nama = $request->nama;
    $data->email = $request->email;
    $data->nohp = $request->nohp;
    $data->alamat = $request->alamat;
    $data->save();

    return redirect()->route('kontak.index')->with('alert_message', 'Berhasil menambah data!');
  }

  public function edit($id)
  {
    $data = ModelKontak::where('id', $id)->get();
    return view('kontak_edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
      $this->validate($request, [
        'nama' => 'required',
        'email' => 'required',
        'nohp' => 'required',
        'alamat' => 'required',
      ]);

      $data = ModelKontak::where('id', $id)->first();
      $data->nama = $request->nama;
      $data->email = $request->email;
      $data->nohp = $request->nohp;
      $data->alamat = $request->alamat;
      $data->save();

      return redirect()->route('kontak.index')->with('alert_message', 'Berhasil mengubah data data!');
  }

  public function destroy($id)
  {
    $data = ModelKontak::where('id', $id)->first();
    $data->delete();

    return redirect()->route('kontak.index')->with('alert_message', 'Berhasil menghapus data!');
  }

}
