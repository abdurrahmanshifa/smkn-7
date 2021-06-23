<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use Validator;
use DataTables;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Jurusan::get();

            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('aksi', function($data) {
                $hasil = '
                    <button type="button" onclick="ubah(\''.$data->id.'\')" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button type="button" onclick="hapus(\''.$data->id.'\')" class="btn btn-danger btn-xs">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
                return $hasil;
            })
            ->escapeColumns([])
            ->make(true);
        }
        return view('pages.jurusan.index');
    }

    public function simpan(Request $request)
    {
        if($request->input())
        {
            $validator = Validator::make($request->all(), [
                    'nama' => 'required',
                ],
                [
                    'nama.required' => 'Nama tidak boleh kosong!',
                ]
            );
            
         
            if ($validator->passes()) {
                $data = new Jurusan();
                $data->id  = Uuid::uuid4()->getHex();
                $data->name = strtoupper($request->input('nama'));
                $data->deskripsi = $request->input('deskripsi');
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

    public function ubah(Request $request)
    {
        if($request->input())
        {
               $validator = Validator::make($request->all(), [
                    'nama' => 'required',
               ],
               [
                    'nama.required' => 'Nama tidak boleh kosong!',
               ]
          );
         
            if ($validator->passes()) {
                $data = Jurusan::find($request->input('id'));
                $data->name = strtoupper($request->input('nama'));
                $data->deskripsi = $request->input('deskripsi');
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

    public function data($id)
    {
        $data = Jurusan::where('id', $id)->first();
        return response()->json($data);
    }

    public function hapus(Request $request , $id)
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

    private function _validate($validator){
        $data = array();
        $data['error_string'] = array();
        $data['input_error'] = array();

        if ($validator->errors()->has('nama')):
            $data['input_error'][] = 'nama';
            $data['error_string'][] = $validator->errors()->first('nama');
            $data['status'] = false;
        endif;

        return $data;
    }

}