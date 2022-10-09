<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\PegawaiMail;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    

    public function index()
    {

        //get posts
        $pegawai = Pegawai::paginate(5);

        //render view with posts
        return view('pegawai.index', compact('pegawai'));

    }

    
    public function destroy($id){
        $pegawai = Pegawai::findOrFail($id);
        $pegawai -> delete();
        }


    public function create() {
        return view('pegawai.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'nomor_induk_pegawai' => 'required',
            'nama_pegawai' => 'required|max:15',
            'id_departemen' => 'required',
            'email' => 'required|email',
            'telepon' => 'required|min:10|max:13',
            'gender' => 'required',
            'status' => 'required'
        ]);

        Pegawai::create([
            'nomor_induk_pegawai' => $request->nomor_induk_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'id_departemen' => $request->id_departemen,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'gender' => $request->gender,
            'status' => $request->status
        ]);

        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function edit(Pegawai $pegawai)
    {

        return view('pegawai.edit', compact('pegawai'));
    }

    public function update (Request $request, $id){

        $this->validate($request, [
            'nomor_induk_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'id_departemen' => 'required',
            'email' => 'required',
            'telepon' => 'required|',
            'gender' => 'required',
            'status' => 'required'
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->fill($request->post())->save();

        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Di Edit']);


    }

}
