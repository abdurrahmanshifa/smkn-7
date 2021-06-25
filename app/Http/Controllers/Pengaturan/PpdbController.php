<?php

namespace App\Http\Controllers\Pengaturan;
use DB;
use Auth;
use Validator;
use DataTables;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Jurusan;
use App\Models\Ppdb;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PpdbController extends Controller
{
    public function index()
    {
        $kategori = Kategori::get();
        return view('pages.ppdb.index');
    }
    
    public function show($id)
    {
        $data = Ppdb::findOrFail($id);
        return $data;
    }
    
    public function create(){
        return view('pages.ppdb.create');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'judul' => 'required',
                'is_active' => 'required',
                'dark' => 'required|mimes:jpeg,jpg,png|max:3000',
                'light' => 'required|mimes:jpeg,jpg,png|max:3000',
                'deskripsi' => 'required',
            ],
            [
                'judul.required' => 'Judul Artikel tidak boleh kosong!',
                'is_active.required' => 'Status Artikel Belum Di Pilih!',
                'dark.required' => 'Background Kiri Belum Dipilih!',
                'dark.mimes' => 'Background Kiri Harus Format Gambar (Jpg, Png)!',
                'dark.max' => 'Maksimal Size Background Kiri 3 MB',
                'light.required' => 'Background Kanan Belum Dipilih!',
                'light.mimes' => 'Background Kanan Harus Format Gambar (Jpg, Png)!',
                'light.max' => 'Maksimal Size Background Kanan 3 MB',
                'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            ]
        );

        if ($validator->passes()) {
            try{
                DB::beginTransaction();
                $insert = new Ppdb;
                
                if($request->hasFile('dark'))
                {
                    $file = $request->file('dark');
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->getClientOriginalExtension();
                    $cover = time()."_ppdb_".Auth::user()->id."_".strtolower($file_name);
                    $file->storeAs('ppdb', $cover);
                    $insert->bg_dark = $cover;
                }

                if($request->hasFile('light'))
                {
                    $file = $request->file('light');
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->getClientOriginalExtension();
                    $cover = time()."_ppdb_".Auth::user()->id."_".strtolower($file_name);
                    $file->storeAs('ppdb', $cover);
                    $insert->bg_light = $cover;

                }
                
                $insert->id = Uuid::uuid4()->getHex();
                $insert->judul = $request->judul;
                $insert->is_active = $request->is_active;
                $insert->deskripsi = $request->deskripsi;
                $insert->video_tutorial = $request->video_tutorial;
                $insert->url = $request->url;
                $insert->save();

                Ppdb::where('id', '!=', $insert->id)->update(['is_active' => 0]);

                DB::commit();
                return redirect()->route('ppdb.index')->with('success','Data Baru Berhasil Di Simpan');
            }
            catch(Exception $ex)
            {
                DB::rollback();
                return redirect()->route('ppdb.create')->with('failed','Data Baru Gagal Di Simpan');
            }
        }
        else{
            return redirect()->route('ppdb.create')->with('failed','Data Baru Gagal Di Simpan');
        }

    }

    public function edit($id){
        $get = Ppdb::findOrFail($id);
        return view('pages.ppdb.edit')
                ->with('id',$id)
                ->with('get',$get);
    }

    public function update(Request $request , $id)
    {
            $validator = Validator::make($request->all(), [
                'judul' => 'required',
                'is_active' => 'required',
                'dark' => 'mimes:jpeg,jpg,png|max:3000',
                'light' => 'mimes:jpeg,jpg,png|max:3000',
                'deskripsi' => 'required',
            ],
            [
                'judul.required' => 'Judul Artikel tidak boleh kosong!',
                'is_active.required' => 'Status Artikel Belum Di Pilih!',
                'dark.mimes' => 'Background Kiri Harus Format Gambar (Jpg, Png)!',
                'dark.max' => 'Maksimal Size Background Kiri 3 MB',
                'light.mimes' => 'Background Kanan Harus Format Gambar (Jpg, Png)!',
                'light.max' => 'Maksimal Size Background Kanan 3 MB',
                'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            ]
        );


        if ($validator->passes()) {
            try{
                DB::beginTransaction();
   
                $insert = Ppdb::find($id);

                if($request->hasFile('dark'))
                {
                    $file = $request->file('dark');
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->getClientOriginalExtension();
                    $cover = time()."_ppdb_".Auth::user()->id."_".strtolower($file_name);
                    $file->storeAs('ppdb', $cover);
                    $insert->bg_dark = $cover;
                }

                if($request->hasFile('light'))
                {
                    $file = $request->file('light');
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->getClientOriginalExtension();
                    $cover = time()."_ppdb_".Auth::user()->id."_".strtolower($file_name);
                    $file->storeAs('ppdb', $cover);
                    $insert->bg_light = $cover;

                }

                $insert->judul = $request->judul;
                $insert->is_active = $request->is_active;
                $insert->deskripsi = $request->deskripsi;
                $insert->video_tutorial = $request->video_tutorial;
                $insert->url = $request->url;
                $insert->save();

                if($request->is_active == 1)
                {
                    Ppdb::where('id', '!=', $id)->update(['is_active' => 0]);
                }

                DB::commit();
                return redirect()->route('ppdb.index')->with('success','Data Baru Berhasil Di Ubah');
            }
            catch(Exception $ex)
            {
                DB::rollback();
                return redirect()->route('ppdb.update',$id)->with('failed','Data Baru Gagal Di Ubah');
            }
        }
        else{
            return redirect()->route('ppdb.update',$id)->with('failed','Data Baru Gagal Di Ubah');
        }

    }

    public function datatable()
    {
        $data = Ppdb::get();
        return Datatables::of($data)
            ->addIndexColumn()

            ->editColumn('aksi', function($data) {
                $hasil = '
                    <a href="'.route('ppdb.edit',$data->id).'" data-toggle="tooltip" title="Ubah Data" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" onclick="hapus(\''.$data->id.'\')" data-toggle="tooltip" title="Hapus Data" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
                return $hasil;
            })
            ->editColumn('video_tutorial', function($data) {
                $hasil = '
                    <a target="_blank" href="'.$data->video_tutorial.'">
                        '.$data->video_tutorial.'
                    </a>
                ';
                return $hasil;
            })
            ->editColumn('url', function($data) {
                $hasil = '
                    <a target="_blank" href="'.$data->url.'">
                        '.$data->url.'
                    </a>
                ';
                return $hasil;
            })
            ->addColumn('get_status', function($data) {
                $btn = '<button type="button" onclick="edit_flag(\''.$data->id.'\')" data-toggle="tooltip" title="Edit Status" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i>
                </button>';
                return $data->get_status.$btn;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function destroy($id)
    {
        $data = Ppdb::find($id);
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
        Ppdb::where('id', 'like', '%')->update(['is_active' => 0]);

        $id = $request->id;
        $flag_active = $request->flag_active;

        $data = Ppdb::find($id);
        $data->is_active = $flag_active;
        $data->save();

        return redirect()->route('ppdb.index')->with('success','Status Berhasil Di Ubah');
    }
}