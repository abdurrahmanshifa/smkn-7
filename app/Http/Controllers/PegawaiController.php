<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\FunctionHelper;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Agama;
use App\Models\Jabatan;
use App\Models\JnsKelamin;
use App\Models\Pendidikan;
use Illuminate\Support\Facades\Hash;
use Validator;
use DataTables;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Pegawai::with('Datajabatan')->orderBy('created_at','desc')->get();

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('jml_download', function($data) {
                return $data->get_jmldownload;
            })
            ->addColumn('jabatan', function($data) {
                return $data->get_datajabatan;
            })
            ->addColumn('status', function($data) {
                $btn = '<button type="button" onclick="edit_flag(\''.$data->id.'\')" data-toggle="tooltip" title="Edit Status" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i>
                </button>';
                return $data->get_datastatus.' '.$btn;
            })
            ->editColumn('aksi', function($data) {

                $hasil = '
                    <a href="'.route('pegawai.edit',$data->id).'" class="btn btn-warning btn-xs">
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

        return view('pages.pegawai.index');
    }

    public function create(){
        $agama = Agama::get();
        $jabatan = Jabatan::get();
        $jnskelamin = JnsKelamin::get();
        $pendidikan = Pendidikan::get();

        return view('pages.pegawai.create',compact('agama','jabatan','jnskelamin','pendidikan'));
    }

    public function edit($id){
        $agama = Agama::get();
        $jabatan = Jabatan::get();
        $jnskelamin = JnsKelamin::get();
        $pendidikan = Pendidikan::get();

        $data = Pegawai::findOrFail($id);
        return view('pages.pegawai.edit',compact('id','data','agama','jabatan','jnskelamin','pendidikan'));
    }

    public function store(Request $request)
    {
        if($request->input())
        {
            $validator = Validator::make($request->all(), [
                    'nama'      => 'required',
                    'email'     => 'required|email|unique:pegawai,email,'.$request->input('id'),
                ],
                [
                    'nama.required' => 'Nama tidak boleh kosong!',
                    'email.required'    => 'Alamat email tidak boleh kosong!',
                    'email.email'       => 'Alamat email tidak sesuai!',
                    'email.unique'      => 'Alamat email sudah terdaftar di data kami!',
                    'password.required' => 'Password tidak boleh kosong!',
                ]
            );
            
         
            if ($validator->passes()) {

                if($request->hasFile('foto'))
                {
                    $file = $request->file('foto');
                    $file_ext = $file->getClientOriginalExtension();
                    $filename = strtolower(str_replace(' ','_',$request->input('nama'))).'_'.time().'.'.$file_ext;
                    $file->storeAs('public/pegawai', $filename);

                }else{
                    $filename = null;
                }

                $data = new Pegawai();
                $data->id  = Uuid::uuid4()->getHex();
                $data->nip = $request->input('nip');
                $data->tmpt_lahir = $request->input('tmpt_lahir');
                $data->tgl_lahir = date('Y-m-d',strtotime($request->input('tgl_lahir')));
                $data->jns_kelamin = $request->input('jns_kelamin');
                $data->telp = $request->input('telp');
                $data->agama = $request->input('agama');
                $data->pend_terakhir = $request->input('pend_terakhir');
                $data->jabatan = $request->input('jabatan');
                $data->alamat = $request->input('alamat');
                $data->status = $request->input('status');
                $data->foto = $filename;
                $data->nama = $request->input('nama');
                $data->email = $request->input('email');
                $data->created_at = now();
                $data->updated_at = null;
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
                    'nama' => 'required',
                    'email'     => 'required|email|unique:pegawai,email,'.$id,
               ],
               [
                    'nama.required' => 'Nama tidak boleh kosong!',
                    'email.required'    => 'Alamat email tidak boleh kosong!',
                    'email.email'       => 'Alamat email tidak sesuai!',
                    'email.unique'      => 'Alamat email sudah terdaftar di data kami!',
               ]
          );
         
            if ($validator->passes()) {
                $data = Pegawai::find($id);
                if($request->hasFile('foto'))
                {
                    $file = $request->file('foto');
                    $file_ext = $file->getClientOriginalExtension();
                    $filename = strtolower(str_replace(' ','_',$request->input('nama'))).'_'.time().'.'.$file_ext;
                    $file->storeAs('public/pegawai', $filename);

                }else{
                    $filename = $request->input('foto_lama');
                }

                $data->nip = $request->input('nip');
                $data->tmpt_lahir = $request->input('tmpt_lahir');
                $data->tgl_lahir = date('Y-m-d',strtotime($request->input('tgl_lahir')));
                $data->jns_kelamin = $request->input('jns_kelamin');
                $data->telp = $request->input('telp');
                $data->agama = $request->input('agama');
                $data->pend_terakhir = $request->input('pend_terakhir');
                $data->jabatan = $request->input('jabatan');
                $data->alamat = $request->input('alamat');
                $data->status = $request->input('status');
                $data->foto = $filename;
                $data->nama = $request->input('nama');
                $data->email = $request->input('email');
                $data->updated_at = now();
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

    public function edit_status(Request $request)
    {
        $id = $request->id;
        $data = Pegawai::find($id);
        $data->status = $request->input('flag_active');
        $data->save();

        return redirect()->route('pegawai.index')->with('success','Status Pegawai Berhasil Di Edit');
    }

    public function destroy($id)
    {
        $data = Pegawai::find($id);
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

        if ($validator->errors()->has('email')):
          $data['input_error'][] = 'email';
          $data['error_string'][] = $validator->errors()->first('email');
          $data['status'] = false;
      endif;

      if ($validator->errors()->has('password')):
          $data['input_error'][] = 'password';
          $data['error_string'][] = $validator->errors()->first('password');
          $data['status'] = false;
      endif;

        return $data;
    }

}