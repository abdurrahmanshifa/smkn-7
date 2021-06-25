<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\FunctionHelper;
use App\Helpers\DateHelper;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Siswa;
use App\Models\Agama;
use App\Models\Jabatan;
use App\Models\JnsKelamin;
use App\Models\Pendidikan;
use Illuminate\Support\Facades\Hash;
use Validator;
use DataTables;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Siswa::with('jnskelamin')->orderBy('created_at','desc')->get();

            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('jenis_kelamin', function($data) {
                return $data->jnskelamin->name;
            })
            ->editColumn('tgl_lahir', function($data) {
                return DateHelper::tglIndSingkat($data->tgl_lahir);
            })
            ->editColumn('aksi', function($data) {

                $hasil = '
                    <a href="'.route('siswa.edit',$data->id).'" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" onclick="hapus(\''.$data->id.'\')" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
                return $hasil;
            })
            ->escapeColumns([])
            ->make(true);
        }

        return view('pages.siswa.index');
    }

    public function create(){
        $jnskelamin = JnsKelamin::get();

        return view('pages.siswa.create',compact('jnskelamin'));
    }

    public function edit($id){
        $jnskelamin = JnsKelamin::get();

        $data = Siswa::findOrFail($id);
        return view('pages.siswa.edit',compact('id','data','jnskelamin'));
    }

    public function store(Request $request)
    {
        if($request->input())
        {
            $validator = Validator::make($request->all(), [
                    'nama'          => 'required',
                    'tgl_lahir'     => 'required',
                    'jns_kelamin' => 'required',
                ],
                [
                    'nama.required' => 'Nama tidak boleh kosong!',
                    'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
                    'jns_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
                ]
            );
            
         
            if ($validator->passes()) {


                $data = new Siswa();
                $data->id  = Uuid::uuid4()->getHex();
                $data->nik = $request->input('nik');
                $data->nama = $request->input('nama');
                $data->tgl_lahir = $request->input('tgl_lahir');
                $data->jenis_kelamin = $request->input('jns_kelamin');
                $data->alamat = $request->input('alamat');
                
                if($request->hasFile('foto'))
                {
                    $file = $request->file('foto');
                    $file_ext = $file->getClientOriginalExtension();
                    $filename = strtolower(str_replace(' ','_',$request->input('nama'))).'_'.time().'.'.$file_ext;
                    $file->storeAs('siswa', $filename);
                    $data->foto = $filename;
                }
                
                $data->created_at = now();

                if($data->save()){
                    $msg = array(
                        'success' => true, 
                        'message' => 'Data berhasil disimpan!',
                        'status' => TRUE
                    );
                    return response()->json($msg);
                }else{
                    $msg = array(
                        'success' => false, 
                        'message' => 'Data gagal disimpan!',
                        'status' => TRUE
                    );
                    return response()->json($msg);
                }

            }

            $data = $this->_validate($validator);
            return response()->json($data);

        }
    }

    public function update(Request $request , $id)
    {
        // return $request;
        if($request->input())
        {
            $validator = Validator::make($request->all(), [
                    'nama'          => 'required',
                    'tgl_lahir'     => 'required',
                    'jns_kelamin' => 'required',
                ],
                [
                    'nama.required' => 'Nama tidak boleh kosong!',
                    'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
                    'jns_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
                ]
            );
         
            if ($validator->passes()) {

                $data = Siswa::find($id);
                $data->nik = $request->input('nik');
                $data->nama = $request->input('nama');
                $data->tgl_lahir = $request->input('tgl_lahir');
                $data->jenis_kelamin = $request->input('jns_kelamin');
                $data->alamat = $request->input('alamat');
                $data->updated_at = now();

                if($request->hasFile('foto'))
                {
                    $file = $request->file('foto');
                    $file_ext = $file->getClientOriginalExtension();
                    $filename = strtolower(str_replace(' ','_',$request->input('nama'))).'_'.time().'.'.$file_ext;
                    $file->storeAs('pegawai', $filename);
                    $data->foto = $filename;
                }

                if($data->save()){
                    $msg = array(
                        'success' => true, 
                        'message' => 'Data berhasil diubah!',
                        'status' => TRUE
                    );
                    return response()->json($msg);
                }else{
                    $msg = array(
                        'success' => false, 
                        'message' => 'Data gagal diubah!',
                        'status' => TRUE
                    );
                    return response()->json($msg);
                }

            }

            $data = $this->_validate($validator);
            return response()->json($data);

        }
    }

    public function show($id)
    {
        $data = Pegawai::where('id', $id)->first();
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = Siswa::find($id);
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

    private function _validate($validator){
        $data = array();
        $data['error_string'] = array();
        $data['input_error'] = array();

        if ($validator->errors()->has('nama')):
            $data['input_error'][] = 'nama';
            $data['error_string'][] = $validator->errors()->first('nama');
            $data['status'] = false;
        endif;

        if ($validator->errors()->has('tgl_lahir')):
          $data['input_error'][] = 'tgl_lahir';
          $data['error_string'][] = $validator->errors()->first('tgl_lahir');
          $data['status'] = false;
      endif;

      if ($validator->errors()->has('jns_kelamin')):
          $data['input_error'][] = 'jns_kelamin';
          $data['error_string'][] = $validator->errors()->first('jns_kelamin');
          $data['status'] = false;
      endif;

        return $data;
    }

}