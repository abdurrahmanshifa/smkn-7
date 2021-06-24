<?php

namespace App\Http\Controllers\Manajemen;
use DB;
use Auth;
use Validator;
use DataTables;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Jurusan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class JurusanController extends Controller
{
    public function index()
    {
        $kategori = Kategori::get();
        return view('pages.jurusan.index');
    }
    
    public function show($id)
    {
        $data = Jurusan::findOrFail($id);
        return $data;
    }
    
    public function create(){
        $kategori = Kategori::orderBy('name')->get();
        return view('pages.jurusan.create')
                ->with('kategori',$kategori);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'id_kategori' => 'required',
                'judul' => 'required',
                'flag_active' => 'required',
                'tanggal' => 'required',
                'cover' => 'required|mimes:jpeg,jpg,png|max:3000',
                'isi_artikel' => 'required',
            ],
            [
                'id_kategori.required' => 'Kategori Artikel Belum Di Pilih!',
                'judul.required' => 'Judul Artikel tidak boleh kosong!',
                'flag_active.required' => 'Status Artikel Belum Di Pilih!',
                'cover.required' => 'Cover Artikel Belum Dipilih!',
                'tanggal.required' => 'Tanggal Artikel Belum Dipilih!',
                'cover.mimes' => 'Cover Artikel Harus Format Gambar (Jpg, Png)!',
                'cover.max' => 'Maksimal Size Cover Artikel 3 MB',
                'isi_jurusan.required' => 'Isi Artikel tidak boleh kosong!',
            ]
        );

        if ($validator->passes()) {
            try{
                DB::beginTransaction();

                $cover = null;
                if($request->hasFile('cover'))
                {
                    $file = $request->file('cover');
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->getClientOriginalExtension();
                    $cover = time()."_jurusan_".Auth::user()->id."_".strtolower($file_name);
                    $file->storeAs('jurusan', $cover);

                }
                $insert = new Jurusan;
                $insert->id = Uuid::uuid4()->getHex();
                $insert->id_kategori = $request->id_kategori;
                $insert->id_user = Auth::user()->id;
                $insert->judul = $request->judul;
                $insert->cover = $cover;
                $insert->tanggal = date('Y-m-d',strtotime($request->tanggal));
                $insert->flag_active = $request->flag_active;
                $insert->isi_artikel = $request->isi_artikel;
                $insert->view = 0;
                $insert->save();

                DB::commit();
                return redirect()->route('jurusan.index')->with('success','Data Baru Artikel Berhasil Di Simpan');
            }
            catch(Exception $ex)
            {
                DB::rollback();
                return redirect()->route('jurusan.create')->with('failed','Data Baru Artikel Gagal Di Simpan');
            }
        }
        else{
            return redirect()->route('jurusan.create')->with('failed','Data Baru Artikel Gagal Di Simpan');
        }

    }

    public function edit($id){
        $kategori = Kategori::orderBy('name')->get();
        $get = Jurusan::findOrFail($id);
        return view('pages.jurusan.edit')
                ->with('id',$id)
                ->with('kategori',$kategori)
                ->with('get',$get);
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
                'id_kategori' => 'required',
                'judul' => 'required',
                'flag_active' => 'required',
                'tanggal' => 'required',
                'cover' => 'mimes:jpeg,jpg,png|max:3000',
                'isi_artikel' => 'required',
            ],
            [
                'id_kategori.required' => 'Kategori Artikel Belum Di Pilih!',
                'judul.required' => 'Judul Artikel tidak boleh kosong!',
                'flag_active.required' => 'Status Artikel Belum Di Pilih!',
                'cover.required' => 'Cover Artikel Belum Dipilih!',
                'cover.mimes' => 'Cover Artikel Harus Format Gambar (Jpg, Png)!',
                'cover.max' => 'Maksimal Size Cover Artikel 3 MB',
                'isi_jurusan.required' => 'Isi Artikel tidak boleh kosong!',
            ]
        );

        if ($validator->passes()) {
            try{
                DB::beginTransaction();
   
                $insert = Jurusan::find($id);
                $insert->id_kategori = $request->id_kategori;
                $insert->id_user = Auth::user()->id;
                $insert->judul = $request->judul;

                if($request->hasFile('cover'))
                {
                    $file = $request->file('cover');
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->getClientOriginalExtension();
                    $cover = time()."_jurusan_".Auth::user()->id."_".strtolower($file_name);
                    $file->storeAs('jurusan', $cover);

                    $insert->cover = $cover;
                }

                $insert->tanggal = date('Y-m-d',strtotime($request->tanggal));
                $insert->flag_active = $request->flag_active;
                $insert->isi_artikel = $request->isi_artikel;
                $insert->save();

                DB::commit();
                return redirect()->route('jurusan.index')->with('success','Data Baru Artikel Berhasil Di Edit');
            }
            catch(Exception $ex)
            {
                DB::rollback();
                return redirect()->route('jurusan.update',$id)->with('failed','Data Baru Artikel Gagal Di Edit');
            }
        }
        else{
            return redirect()->route('jurusan.update',$id)->with('failed','Data Baru Artikel Gagal Di Edit');
        }

    }

    public function datatable()
    {
        $data = Jurusan::orderBy('tanggal','desc')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('aksi', function($data) {
                $hasil = '
                    <a href="'.route('jurusan.edit',$data->id).'" data-toggle="tooltip" title="edit artikel" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" onclick="hapus(\''.$data->id.'\')" data-toggle="tooltip" title="hapus artikel" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
                return $hasil;
            })
            ->addColumn('cover', function($data) {
                return $data->get_cover;
            })
            ->addColumn('desc', function($data) {
                return $data->get_desc;
            })
            ->addColumn('kategori', function($data) {
                return $data->get_kategori;
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
        $data = Jurusan::find($id);
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

        $data = Jurusan::find($id);
        $data->flag_active = $flag_active;
        $data->save();

        return redirect()->route('jurusan.index')->with('success','Status Artikel Berhasil Di Edit');
    }


    public function counter_view($id)
    {
        $data = Jurusan::find($id);
        $data->view = $data->view + 1;
        $data->save();
    }
}