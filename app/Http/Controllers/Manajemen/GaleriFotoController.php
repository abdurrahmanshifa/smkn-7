<?php

namespace App\Http\Controllers\Manajemen;

use DB;
use Auth;
use Validator;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use DataTables;

class GaleriFotoController extends Controller
{
    public function index()
    {
        return view('pages.galeri-foto.index');
    }
    
    public function show($id)
    {
        $data = GaleriFoto::findOrFail($id);
        return $data;
    }
    
    public function create(){
        return view('pages.galeri-foto.create');
    }
    
    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
                'judul' => 'required',
                'flag_active' => 'required',
                'tanggal' => 'required',
                'foto' => 'required|mimes:jpeg,jpg,png|max:3000',
                'keterangan' => 'required',
            ],
            [
                'judul.required' => 'Judul Galeri tidak boleh kosong!',
                'flag_active.required' => 'Status Galeri Belum Di Pilih!',
                'foto.required' => 'Foto Galeri Belum Dipilih!',
                'tanggal.required' => 'Tanggal Galeri Belum Dipilih!',
                'foto.mimes' => 'Foto Galeri Harus Format Gambar (Jpg, Png)!',
                'foto.max' => 'Maksimal Size Foto Galeri 3 MB',
                'keterangan.required' => 'Isi Keterangan tidak boleh kosong!',
            ]
        );

        if ($validator->passes()) {
            try{
                DB::beginTransaction();

                $foto = null;
                if($request->hasFile('foto'))
                {
                    $file = $request->file('foto');
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->getClientOriginalExtension();
                    $foto = time()."_foto_".Auth::user()->id."_".strtolower($file_name);
                    $file->storeAs('galeri-foto', $foto);

                }
                $insert = new GaleriFoto;
                $insert->id = Uuid::uuid4()->getHex();
                $insert->id_user = Auth::user()->id;
                $insert->judul = $request->judul;
                $insert->foto = $foto;
                $insert->tanggal = date('Y-m-d',strtotime($request->tanggal));
                $insert->flag_active = $request->flag_active;
                $insert->tags = $request->tags;
                $insert->keterangan = $request->keterangan;
                $insert->view = 0;
                $insert->save();

                DB::commit();
                return redirect()->route('galeri-foto.index')->with('success','Data Baru Galeri Foto Berhasil Di Simpan');
            }
            catch(Exception $ex)
            {
                DB::rollback();
                return redirect()->route('galeri-foto.create')->with('failed','Data Baru Galeri Foto Gagal Di Simpan');
            }
        }
        else{
            return redirect()->route('galeri-foto.create')->with('failed','Data Baru Galeri Foto Gagal Di Simpan');
        }

    }

    public function edit($id){
        $get = GaleriFoto::findOrFail($id);
        return view('pages.galeri-foto.edit')
                ->with('id',$id)
                ->with('get',$get);
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
                'judul' => 'required',
                'flag_active' => 'required',
                'tanggal' => 'required',
                'foto' => 'mimes:jpeg,jpg,png|max:3000',
                'keterangan' => 'required',
            ],
            [
                'judul.required' => 'Judul Galeri tidak boleh kosong!',
                'flag_active.required' => 'Status Galeri Belum Di Pilih!',
                'tanggal.required' => 'Tanggal Galeri Belum Dipilih!',
                'foto.mimes' => 'Foto Galeri Harus Format Gambar (Jpg, Png)!',
                'foto.max' => 'Maksimal Size Foto Galeri 3 MB',
                'keterangan.required' => 'Isi Keterangan tidak boleh kosong!',
            ]
        );

        if ($validator->passes()) {
            try{
                DB::beginTransaction();
   
                
                $update = GaleriFoto::findOrFail($id);
                $update->id = Uuid::uuid4()->getHex();
                $update->id_user = Auth::user()->id;
                $update->judul = $request->judul;

                if($request->hasFile('foto'))
                {
                    $file = $request->file('foto');
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->getClientOriginalExtension();
                    $foto = time()."_foto_".Auth::user()->id."_".strtolower($file_name);
                    $file->storeAs('galeri-foto', $foto);
                    $update->foto = $foto;
                }
                
                $update->tanggal = date('Y-m-d',strtotime($request->tanggal));
                $update->flag_active = $request->flag_active;
                $update->keterangan = $request->keterangan;
                $update->tags = $request->tags;
                $update->save();

                DB::commit();
                return redirect()->route('galeri-foto.index')->with('success','Data Galeri Foto  Berhasil Di Edit');
            }
            catch(Exception $ex)
            {
                DB::rollback();
                return redirect()->route('galeri-foto.update',$id)->with('failed','Data Galeri Foto  Gagal Di Edit');
            }
        }
        else{
            return redirect()->route('galeri-foto.update',$id)->with('failed','Data Baru Galeri Foto Gagal Di Edit');
        }

    }

    public function datatable()
    {
        $data = GaleriFoto::orderBy('tanggal','desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('aksi', function($data) {
                $hasil = '
                    <a href="'.route('galeri-foto.edit',$data->id).'" data-toggle="tooltip" title="edit galeri foto" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" onclick="hapus(\''.$data->id.'\')" data-toggle="tooltip" title="hapus galeri foto" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
                return $hasil;
            })
            ->addColumn('judul', function($data) {
                return '<b>'.$data->judul.'</b>';
            })
            ->addColumn('galeri_foto', function($data) {
                return $data->galeri_foto;
            })
            ->addColumn('desc', function($data) {
                return $data->get_desc;
            })
            ->addColumn('tgl_posting', function($data) {
                return $data->tgl_posting;
            })
            ->addColumn('get_status', function($data) {
                $btn = '<button type="button" onclick="edit_flag(\''.$data->id.'\')" data-toggle="tooltip" title="Edit Status" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i>
                </button>';
                return $data->get_status.$btn;
            })
            ->addColumn('get_view', function($data) {
                return $data->get_view;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function destroy($id)
    {
        $data = GaleriFoto::find($id);
        if($data->delete()){
            $msg = array(
                'success' => true, 
                'message' => 'Data berhasil dihapus!',
                'status' => TRUE
            );
            return response()->json($msg);
        }else{
            $msg = array(
                'success' => false, 
                'message' => 'Data gagal dihapus!',
                'status' => TRUE
            );
            return response()->json($msg);
        }
    }

    public function edit_status(Request $request)
    {
        $id = $request->id;
        $flag_active = $request->flag_active;

        $data = GaleriFoto::find($id);
        $data->flag_active = $flag_active;
        $data->save();

        return redirect()->route('galeri-foto.index')->with('success','Status Galeri Foto Berhasil Di Edit');
    }


    public function counter_view($id)
    {
        $data = GaleriFoto::find($id);
        $data->view = $data->view + 1;
        $data->save();
    }
}
