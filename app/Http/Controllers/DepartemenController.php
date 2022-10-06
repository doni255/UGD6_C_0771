<?php

namespace App\Http\Controllers;

/* Import Model */
use Mail;
use App\Mail\DepartemenMail; /* import mode mail */
use App\Models\Departemen;  /* import model departemen */
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    
    /**
    * index
    *
    * @return void
    */
    public function index()
    {

        //get departemen
        $departemen = Departemen::latest()->paginate(5);

        //render view with posts
        return view('departemen.index', compact('departemen'));
    }
    /**
     * create
     * 
     * @return void
     */
    public function create() {
        return view('departemen.create');
    }

    

    //Edit
    public function edit($id){
        $departemen=Departemen::find($id);
        return view('departemen.edit',compact('departemen'));
    }
    //Destroy data
    public function destroy($id){
        Departemen::find($id)->delete();   
        return redirect()->route('departemen.index')->with('success', 'Departemen Berhasil dihapus!');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'nama_departemen' => 'required',
            'nama_manager' => 'required',
            'jumlah_pegawai' => 'required'
            ]);

            Departemen::find($id)->update($request->all());

            return redirect()->route('departemen.index')->with('success', 'Berhasil mengedit Departemen!');
    }   

   
    
    
    
    /**
     * store
     * 
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'nama_departemen' => 'required',
            'nama_manager' => 'required',
            'jumlah_pegawai' => 'required', 
        ]);

        //Function to save to in database
        Departemen::create([
            'nama_departemen' => $request->nama_departemen,
            'nama_manager' => $request->nama_manager,
            'jumlah_pegawai' => $request->jumlah_pegawai
        ]);
        
        try{
            //Fill variable that will show in the view of email
            $content = [
                'body' => $request->nama_departemen,
            ];

            //Send email to emailtujuan@gmail.com
            Mail::to('doniwj38@gmail.com')->send(new
            DepartemenMail($content));

            //Redirect if succes send the email
            return redirect() -> route('departemen.index')->with(['succes'
            => 'Data berhasil disimpan, email telah terkirim']);

        }catch(Exception $e){
            //Redirect if fail to send the email
            return redirect() -> route('departemen.index') -> with(['succes'
            => 'Data saved, but fail to send the mail']);
        }

        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    
}
