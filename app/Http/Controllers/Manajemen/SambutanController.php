<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Helpers\FunctionHelper;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\TentangAplikasi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;
use DataTables;

class SambutanController extends Controller
{
    public function index(Request $request)
    {
        $data = TentangAplikasi::take(1)->first();
        return view('pages.sambutan.index',compact('data'));
    }

    public function simpan(Request $request)
    {
        if($request->input())
        {
            $validator = Validator::make($request->all(), [
                    'judul'        => 'required',
                    'deskripsi'    => 'required',
                    'foto'         => 'image|mimes:jpeg,png,jpg|max:2048',
                ],
                [
                    'judul.required'   => 'Judul tidak boleh kosong',
                    'deskripsi.required'    => 'Deskripsi tidak boleh kosong',
                    'foto.image'        => 'Foto yg boleh diupload JPG dan PNG!',
                    'foto.max'         => 'Upload Foto gagal, maksimal ukuran logo 2 Mb!',
                ]
            );
            
         
            if ($validator->passes()) {
                
               $data = new TentangAplikasi();

               if($request->hasFile('foto'))
               {
                    $dir = 'tentang';
                    $file = $request->file('foto');
                    $filename_logo = Str::random(20). '.' . $file->getClientOriginalExtension();
                    $file->storeAs($dir, $filename_logo);
                    $data->foto = $filename_logo;
               }

                
                $data->id  = Uuid::uuid4()->getHex();
                $data->judul = $request->judul;
                $data->deskripsi = $request->deskripsi;
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

    public function ubah(Request $request)
    {
        if($request->input())
        {
               $validator = Validator::make($request->all(), [
                    'judul'        => 'required',
                    'deskripsi'    => 'required',
                    'foto'         => 'image|mimes:jpeg,png,jpg|max:2048',
               ],
               [
                    'judul.required'   => 'Judul tidak boleh kosong',
                    'deskripsi.required'    => 'Deskripsi tidak boleh kosong',
                    'foto.image'        => 'Foto yg boleh diupload JPG dan PNG!',
                    'foto.max'         => 'Upload Foto gagal, maksimal ukuran logo 2 Mb!',
               ]
          );
         
            if ($validator->passes()) {

               $data = TentangAplikasi::find($request->input('id'));

               if($request->hasFile('foto'))
               {
                    $dir = 'tentang';
                    $file = $request->file('foto');
                    $filename_logo = Str::random(20). '.' . $file->getClientOriginalExtension();
                    $file->storeAs($dir, $filename_logo);
                    $data->foto = $filename_logo;
               }else{
                    $data->foto = $request->foto_old;
               }
               
                $data->judul = $request->judul;
                $data->deskripsi = $request->deskripsi;
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

     private function _validate($validator){
          $data = array();
          $data['error_string'] = array();
          $data['input_error'] = array();

          if ($validator->errors()->has('judul')):
               $data['input_error'][] = 'judul';
               $data['error_string'][] = $validator->errors()->first('judul');
               $data['status'] = false;
          endif;

          if ($validator->errors()->has('deskripsi')):
               $data['input_error'][] = 'is_text';
               $data['error_string'][] = $validator->errors()->first('deskripsi');
               $data['status'] = false;
          endif;
               
          return $data;
     }

}