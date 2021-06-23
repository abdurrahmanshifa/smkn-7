<?php

namespace App\Http\Controllers\Pengaturan;

use App\Http\Controllers\Controller;
use App\Helpers\FunctionHelper;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\Logo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;
use DataTables;

class LogoController extends Controller
{
    public function index(Request $request)
    {
        $logo = Logo::take(1)->first();
        return view('pages.logo.index',compact('logo'));
    }

    public function simpan(Request $request)
    {
        if($request->input())
        {
            $validator = Validator::make($request->all(), [
                    'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'logo_alt' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ],
                [
                    'logo.required'     => 'Logo tidak boleh kosong!',
                    'logo.image'        => 'File yg boleh diupload JPG dan PNG!',
                    'logo.max'         => 'Upload logo gagal, maksimal ukuran logo 2 Mb!',
                    'logo_alt.required'     => 'Logo alternatif tidak boleh kosong!',
                    'logo_alt.image'        => 'File yg boleh diupload JPG dan PNG!',
                    'logo_alt.max'         => 'Upload logo alternatif gagal, maksimal ukuran logo 2 Mb!',
                ]
            );
            
         
            if ($validator->passes()) {
                
                if($request->hasFile('logo'))
                {
                    $dir = 'logo';
                    $file = $request->file('logo');
                    $filename_logo = Str::random(20). '.' . $file->getClientOriginalExtension();
                    $file->storeAs($dir, $filename_logo);
                }

                if($request->hasFile('logo_alt'))
                {
                    $dir_test = 'logo';
                    $file_alt = $request->file('logo_alt');
                    $filename_alt = Str::random(20). '.' . $file_alt->getClientOriginalExtension();
                    $file_alt->storeAs($dir_test, $filename_alt);
                }

                $data = new Logo();
                $data->id  = Uuid::uuid4()->getHex();
                $data->logo_utama = $filename_logo;
                $data->logo_alt = $filename_alt;
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
                    'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
                    'logo_alt' => 'image|mimes:jpeg,png,jpg|max:2048',
                ],
                [
                    'logo.image'        => 'File yg boleh diupload JPG dan PNG!',
                    'logo.max'         => 'Upload logo gagal, maksimal ukuran logo 2 Mb!',
                    'logo_alt.image'        => 'File yg boleh diupload JPG dan PNG!',
                    'logo_alt.max'         => 'Upload logo alternatif gagal, maksimal ukuran logo 2 Mb!',
                ]
            );
         
            if ($validator->passes()) {

                if($request->hasFile('logo'))
                {
                    $dir = 'logo';
                    $file = $request->file('logo');
                    $filename_logo = Str::random(20). '.' . $file->getClientOriginalExtension();
                    $file->storeAs($dir, $filename_logo);
                }else{
                    $filename_logo = $request->logo_utama_old;
                }

                if($request->hasFile('logo_alt'))
                {
                    $dir_test = 'logo';
                    $file_alt = $request->file('logo_alt');
                    $filename_alt = Str::random(20). '.' . $file_alt->getClientOriginalExtension();
                    $file_alt->storeAs($dir_test, $filename_alt);
                }else{
                    $filename_alt = $request->logo_alt_old;
                }

                $data = Logo::find($request->input('id'));
                $data->logo_utama = $filename_logo;
                $data->logo_alt = $filename_alt;
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

        if ($validator->errors()->has('logo')):
            $data['input_error'][] = 'logo';
            $data['error_string'][] = $validator->errors()->first('logo');
            $data['status'] = false;
        endif;

        if ($validator->errors()->has('logo_alt')):
          $data['input_error'][] = 'logo_alt';
          $data['error_string'][] = $validator->errors()->first('logo_alt');
          $data['status'] = false;
      endif;


        return $data;
    }

}