<?php

namespace App\Http\Controllers\Manajemen;

use DB;
use Auth;
use Validator;
use DataTables;
use Ramsey\Uuid\Uuid;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\GaleriFoto;
use App\Models\GaleriVideo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GaleriVideoController extends Controller
{
    public function index()
    {
        return view('pages.galeri-video.index');
    }
    
    public function show($id)
    {
        $data = GaleriVideo::findOrFail($id);
        return $data;
    }
    
    public function create(){
        return view('pages.galeri-video.create');
    }
    
    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
                'judul' => 'required',
                'flag_active' => 'required',
                'tanggal' => 'required',
                'link' => 'required',
                'keterangan' => 'required',
            ],
            [
                'judul.required' => 'Judul Galeri tidak boleh kosong!',
                'flag_active.required' => 'Status Galeri Belum Di Pilih!',
                'link.required' => 'Foto Galeri Belum Dipilih!',
                'tanggal.required' => 'Tanggal Galeri Belum Dipilih!', 
                'keterangan.required' => 'Isi Keterangan tidak boleh kosong!',
            ]
        );

        if ($validator->passes()) {
            try{
                DB::beginTransaction();

                $insert = new GaleriVideo;
                $insert->id = Uuid::uuid4()->getHex();
                $insert->id_user = Auth::user()->id;
                $insert->judul = $request->judul;
                $insert->link = $request->link;
                $insert->tanggal = date('Y-m-d',strtotime($request->tanggal));
                $insert->flag_active = $request->flag_active;
                $insert->tags = $request->tags;
                $insert->keterangan = $request->keterangan;
                $insert->view = 0;
                $insert->save();

                DB::commit();
                return redirect()->route('galeri-video.index')->with('success','Data Baru Galeri Video Berhasil Di Simpan');
            }
            catch(Exception $ex)
            {
                DB::rollback();
                return redirect()->route('galeri-video.create')->with('failed','Data Baru Galeri Video Gagal Di Simpan');
            }
        }
        else{
            return redirect()->route('galeri-video.create')->with('failed','Data Baru Galeri Video Gagal Di Simpan');
        }

    }

    public function edit($id){
        $get = GaleriVideo::findOrFail($id);
        return view('pages.galeri-video.edit')
                ->with('id',$id)
                ->with('get',$get);
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
                'judul' => 'required',
                'flag_active' => 'required',
                'tanggal' => 'required',
                'keterangan' => 'required',
            ],
            [
                'judul.required' => 'Judul Galeri tidak boleh kosong!',
                'flag_active.required' => 'Status Galeri Belum Di Pilih!',
                'tanggal.required' => 'Tanggal Galeri Belum Dipilih!',
                'keterangan.required' => 'Isi Keterangan tidak boleh kosong!',
            ]
        );

        if ($validator->passes()) {
            try{
                DB::beginTransaction();
   
                
                $update = GaleriVideo::findOrFail($id);
                $update->id = Uuid::uuid4()->getHex();
                $update->id_user = Auth::user()->id;
                $update->judul = $request->judul;
                $update->link = $request->link;
                $update->tanggal = date('Y-m-d',strtotime($request->tanggal));
                $update->flag_active = $request->flag_active;
                $update->keterangan = $request->keterangan;
                $update->tags = $request->tags;
                $update->save();

                DB::commit();
                return redirect()->route('galeri-video.index')->with('success','Data Galeri Video Berhasil Di Edit');
            }
            catch(Exception $ex)
            {
                DB::rollback();
                return redirect()->route('galeri-video.update',$id)->with('failed','Data Galeri Video Gagal Di Edit');
            }
        }
        else{
            return redirect()->route('galeri-video.update',$id)->with('failed','Data Baru Galeri Video Gagal Di Edit');
        }

    }

    public function datatable()
    {
        $data = GaleriVideo::orderBy('tanggal','desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('aksi', function($data) {
                $hasil = '
                    <a href="'.route('galeri-video.edit',$data->id).'" data-toggle="tooltip" title="edit galeri foto" class="btn btn-warning btn-xs">
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
            ->addColumn('galeri_video', function($data) {
                return $data->galeri_video;
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
        $data = GaleriVideo::find($id);
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

        $data = GaleriVideo::find($id);
        $data->flag_active = $flag_active;
        $data->save();

        return redirect()->route('galeri-video.index')->with('success','Status Galeri Foto Berhasil Di Edit');
    }


    public function counter_view($id)
    {
        $data = GaleriVideo::find($id);
        $data->view = $data->view + 1;
        $data->save();
    }
}
