<?php

namespace App\Http\Controllers\Pengaturan;

use App\Http\Controllers\Controller;
use App\Helpers\FunctionHelper;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use Validator;
use DataTables;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Banner::get();

            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('status', function($data) {
                return $data->statusbanner;
            })
            ->editColumn('images', function($data) {
                return $data->banner;
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
        return view('pages.banner.index');
    }

    public function simpan(Request $request)
    {
        if($request->input())
        {
            $validator = Validator::make($request->all(), [
                    'judul'     => 'required',
                    'images'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ],
                [
                    'judul.required' => 'Judul tidak boleh kosong!',
                    'images.required'     => 'Foto banner tidak boleh kosong!',
                    'images.image'        => 'File yg boleh diupload JPG dan PNG!',
                    'images.max'         => 'Upload banner gagal, maksimal ukuran logo 2 Mb!',
                ]
            );
            
         
            if ($validator->passes()) {
                $data = new Banner();

                if($request->hasFile('images'))
                {
                    $dir_test = 'banner';
                    $file_alt = $request->file('images');
                    $filename = Str::random(20). '.' . $file_alt->getClientOriginalExtension();
                    $file_alt->storeAs($dir_test, $filename);
                }

                $data->id  = Uuid::uuid4()->getHex();
                $data->judul = $request->input('judul');
                $data->deskripsi = $request->input('deskripsi');
                $data->link = $request->input('link');
                $data->images = $filename;
                $data->status = $request->input('status');
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
                    'judul'     => 'required',
                    'images'     => 'image|mimes:jpeg,png,jpg|max:2048',
                ],
                [
                    'judul.required' => 'Judul tidak boleh kosong!',
                    'images.image'        => 'File yg boleh diupload JPG dan PNG!',
                    'images.max'         => 'Upload banner gagal, maksimal ukuran logo 2 Mb!',
                ]
            );
         
            if ($validator->passes()) {
                if($request->hasFile('images'))
                {
                    $dir_test = 'banner';
                    $file_alt = $request->file('images');
                    $filename = Str::random(20). '.' . $file_alt->getClientOriginalExtension();
                    $file_alt->storeAs($dir_test, $filename);
                }else{
                    $filename = $request->input('images_old');
                }

                $data = Banner::find($request->input('id'));
                $data->judul = $request->input('judul');
                $data->deskripsi = $request->input('deskripsi');
                $data->link = $request->input('link');
                $data->images = $filename;
                $data->status = $request->input('status');

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
        $data = Banner::where('id', $id)->first();
        return response()->json($data);
    }

    public function hapus(Request $request , $id)
    {
        $data = Banner::find($id);
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

        if ($validator->errors()->has('judul')):
            $data['input_error'][] = 'judul';
            $data['error_string'][] = $validator->errors()->first('judul');
            $data['status'] = false;
        endif;

        if ($validator->errors()->has('images')):
            $data['input_error'][] = 'images';
            $data['error_string'][] = $validator->errors()->first('images');
            $data['status'] = false;
        endif;

        return $data;
    }

}