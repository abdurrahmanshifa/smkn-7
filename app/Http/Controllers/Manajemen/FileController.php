<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Str;
use Validator;
use DataTables;

class FileController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = File::orderByDesc('created_at')->get();

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('jml_download', function($data) {
                return $data->get_jmldownload;
            })
            ->addColumn('file', function($data) {
                return "<a target='blank' href='".url('show-files/file/'.$data->file)."'>".$data->file."</a>";
            })
            ->addColumn('status', function($data) {
                $btn = '<button type="button" onclick="edit_flag(\''.$data->id.'\')" data-toggle="tooltip" title="Edit Status" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i>
                </button>';
                return $data->get_datastatus.' '.$btn;
            })
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
        return view('pages.file.index');
    }

    public function edit_status(Request $request)
    {
        $id = $request->id_flag;
        $data = File::find($id);
        $data->status = $request->input('flag_active');
        $data->save();

        return redirect()->route('file')->with('success','Status file Berhasil Di Edit');
    }

    public function simpan(Request $request)
    {
        if($request->input())
        {
            $validator = Validator::make($request->all(), [
                    'nama' => 'required',
                    'file' => 'required|mimes:jpeg,png,jpg,doc,csv,xlsx,xls,docx,pdf|max:2048',
                ],
                [
                    'nama.required'         => 'Judul file tidak boleh kosong!',
                    'file.required'         => 'File tidak boleh kosong!',
                    'file.mimes'        => 'Tipe file tidak dapat diupload.',
                    'file.max'         => 'Upload file gagal, maksimal ukuran file 2 Mb!',
                ]
            );
            
         
            if ($validator->passes()) {

                
                if($request->hasFile('file'))
                {
                    $dir = 'public/file';
                    $file = $request->file('file');
                    $filename = str_replace(' ','_',strtolower($request->input('nama'))).'_'.Str::random(5). '.' . $file->getClientOriginalExtension();
                    $file->storeAs($dir, $filename);
                }

                $data = new File();
                $data->id  = Uuid::uuid4()->getHex();
                $data->name = strtoupper($request->input('nama'));
                $data->file = $filename;
                $data->download = 0;
                $data->status = $request->input('status');
                $data->keterangan = $request->input('keterangan');
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
                    'file' => 'mimes:jpeg,png,jpg,doc,csv,xlsx,xls,docx,pdf|max:2048',
                ],
                [
                    'nama.required'         => 'Judul file tidak boleh kosong!',
                    'file.mimes'        => 'Tipe file tidak dapat diupload.',
                    'file.max'         => 'Upload file gagal, maksimal ukuran file 2 Mb!',
                ]
            );

            if($request->hasFile('file'))
            {
                $dir = 'public/file';
                $file = $request->file('file');
                $filename = str_replace(' ','_',strtolower($request->input('nama'))).'_'.Str::random(5). '.' . $file->getClientOriginalExtension();
                $file->storeAs($dir, $filename);
            }else{
                $filename = $request->input('file_lama');
            }
         
            if ($validator->passes()) {
                $data = File::find($request->input('id'));
                $data->name = strtoupper($request->input('nama'));
                $data->file = $filename;
                $data->status = $request->input('status');
                $data->keterangan = $request->input('keterangan');
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
        $data = File::where('id', $id)->first();
        return response()->json($data);
    }

    public function hapus(Request $request , $id)
    {
        $data = File::find($id);
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

        if ($validator->errors()->has('file')):
            $data['input_error'][] = 'file';
            $data['error_string'][] = $validator->errors()->first('file');
            $data['status'] = false;
        endif;

        return $data;
    }

}