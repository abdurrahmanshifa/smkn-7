<?php

namespace App\Http\Controllers\Manajemen;
use DB;
use Auth;
use Validator;
use DataTables;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Komentar;
use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use App\Models\KomentarBalasan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class KomentarBalasanController extends Controller
{
    public function index()
    {
        return view('pages.komentar.index');
    }
    
    public function show($id)
    {
        $data = Komentar::where('id',$id)->with('balasan')->with('artikel')->first();
        return $data;
    }

    public function edit($id){
        $get = Komentar::where('id',$id)->with('artikel')->with('balasan')->first();
        return view('pages.komentar.edit')
                ->with('id',$id)
                ->with('get',$get);
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
                'judul_balasan' => 'required',
                'isi_balasan' => 'required',
            ],
            [
                'isi_balasan.required' => 'Isi Balasan tidak boleh kosong!',
                'judul_balasan.required' => 'Judul Balasan tidak boleh kosong!',
            ]
        );

        if ($validator->passes()) {
            try{
                DB::beginTransaction();
                
                $komentar = KomentarBalasan::where('id_komentar',$id)->first();
                if($komentar)
                    $komentar->delete();

                $get = Komentar::find($id);

                $insert = new KomentarBalasan;
                $insert->id_artikel     = $get->id_artikel;
                $insert->id_komentar    = $id;
                $insert->id_user        = Auth::user()->id;
                $insert->judul_balasan  = $request->judul_balasan;
                $insert->tanggal        = date('Y-m-d');
                $insert->isi_balasan    = $request->isi_balasan;
                $insert->save();

                DB::commit();
                return redirect()->route('komentar.index')->with('success','Balasan Komentar Berhasil Di Tambahkan');
            }
            catch(Exception $ex)
            {
                DB::rollback();
                return redirect()->route('komentar.update',$id)->with('failed','Balasan Komentar Gagal Di Tambahkan');
            }
        }
        else{
            return redirect()->route('komentar.update',$id)->with('failed','Balasan Komentar Gagal Di Tambahkan');
        }

    }

    public function datatable()
    {
        $data = Komentar::with('balasan')->orderBy('tanggal','desc')->get();
        // return $data;
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('aksi', function($data) {
                $hasil = '
                    <a data-toggle="tooltip" title="detail komentar" class="btn btn-success btn-xs detail-row" data-id="'.$data->id.'">
                        <i class="fa fa-search"></i>
                    </a>
                    <a href="'.route('komentar.edit',$data->id).'" data-toggle="tooltip" title="edit komnetar" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" onclick="hapus(\''.$data->id.'\')" data-toggle="tooltip" title="hapus komnetar" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
                return $hasil;
            })
            ->addColumn('desc', function($data) {
                return $data->get_desc;
            })
            ->addColumn('artikel', function($data) {
                return $data->get_artikel;
            })
            ->addColumn('get_balasan', function($data) {
                return $data->get_balasan;
            })
            ->addColumn('get_user', function($data) {
                return $data->get_user;
            })
            ->addColumn('get_status', function($data) {
                return $data->get_status;
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
        $data = Komentar::find($id);
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

        $data = Komentar::find($id);
        $data->flag_active = $flag_active;
        $data->save();

        return redirect()->route('komentar.index')->with('success','Flag Komentar Berhasil Di Edit');
    }
}
