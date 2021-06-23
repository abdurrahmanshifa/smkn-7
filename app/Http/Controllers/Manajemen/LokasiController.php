<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Helpers\FunctionHelper;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;
use DataTables;

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $lokasi = Lokasi::take(1)->first();
        return view('pages.lokasi.index',compact('lokasi'));
    }

    public function simpan(Request $request)
    {
        if($request->input())
        {
            $validator = Validator::make($request->all(), [
                    'nama'      => 'required',
                    'telp'      => 'required',
                    'email'     => 'required|email',
                    'fax'     => 'required',
                    'lat'     => 'required',
                    'long'     => 'required',
                    'alamat'     => 'required',
                ],
                [
                    'nama.required'     => 'Nama Aplikasi tidak boleh kosong!',
                    'telp.required'     => 'Nomor Telepon tidak boleh kosong!',
                    'email.required'     => 'Email tidak boleh kosong!',
                    'email.email'     => 'Format Email tidak sesuai!',
                    'fax.required'     => 'Fax tidak boleh kosong!',
                    'lat.required'     => 'Lattitude tidak boleh kosong!',
                    'long.required'     => 'Longitude tidak boleh kosong!',
                    'alamat.required'     => 'Alamat tidak boleh kosong!',
                ]
            );
            
         
            if ($validator->passes()) {
            
                $data = new Lokasi();
                $data->id  = Uuid::uuid4()->getHex();
                $data->nama = $request->input('nama');
                $data->telp = $request->input('telp');
                $data->email = $request->input('email');
                $data->fax = $request->input('fax');
                $data->lat = $request->input('lat');
                $data->long = $request->input('long');
                $data->alamat = $request->input('alamat');
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
                    'nama'      => 'required',
                    'telp'      => 'required',
                    'email'     => 'required|email',
                    'fax'     => 'required',
                    'lat'     => 'required',
                    'long'     => 'required',
                    'alamat'     => 'required',
                ],
                [
                    'nama.required'     => 'Nama Aplikasi tidak boleh kosong!',
                    'telp.required'     => 'Nomor Telepon tidak boleh kosong!',
                    'email.required'     => 'Email tidak boleh kosong!',
                    'email.email'     => 'Format Email tidak sesuai!',
                    'fax.required'     => 'Fax tidak boleh kosong!',
                    'lat.required'     => 'Lattitude tidak boleh kosong!',
                    'long.required'     => 'Longitude tidak boleh kosong!',
                    'alamat.required'     => 'Alamat tidak boleh kosong!',
                ]
            );
         
            if ($validator->passes()) {

                $data = Lokasi::find($request->input('id'));
                $data->telp = $request->input('telp');
                $data->nama = $request->input('nama');
                $data->email = $request->input('email');
                $data->fax = $request->input('fax');
                $data->lat = $request->input('lat');
                $data->long = $request->input('long');
                $data->alamat = $request->input('alamat');
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

    public function hapus(Request $request , $id)
    {
        if($id == 0){
            $msg = array(
                'success' => false, 
                'message' => 'Tidak ada data yang direset',
                'status' => TRUE,
                'icon'  => 'warning'
            );
            return response()->json($msg);
            exit();
        }

        $data = Lokasi::find($id);
        if($data->delete()){
            $msg = array(
                'success' => true, 
                'message' => 'Data berhasil direset!',
                'status' => TRUE
            );
            return response()->json($msg);
        }else{
            $msg = array(
                'success' => false, 
                'message' => 'Data gagal direset!',
                'status' => TRUE,
                'icon'  =>'error'
            );
            return response()->json($msg);
        }
    }

    private function _validate($validator){
        $data = array();
        $data['error_string'] = array();
        $data['input_error'] = array();

        if ($validator->errors()->has('telp')):
            $data['input_error'][] = 'telp';
            $data['error_string'][] = $validator->errors()->first('telp');
            $data['status'] = false;
        endif;

        if ($validator->errors()->has('email')):
            $data['input_error'][] = 'email';
            $data['error_string'][] = $validator->errors()->first('email');
            $data['status'] = false;
        endif;

        if ($validator->errors()->has('fax')):
            $data['input_error'][] = 'fax';
            $data['error_string'][] = $validator->errors()->first('fax');
            $data['status'] = false;
        endif;

        if ($validator->errors()->has('lat')):
            $data['input_error'][] = 'lat';
            $data['error_string'][] = $validator->errors()->first('lat');
            $data['status'] = false;
        endif;

        if ($validator->errors()->has('long')):
            $data['input_error'][] = 'long';
            $data['error_string'][] = $validator->errors()->first('long');
            $data['status'] = false;
        endif;

        if ($validator->errors()->has('alamat')):
            $data['input_error'][] = 'alamat';
            $data['error_string'][] = $validator->errors()->first('alamat');
            $data['status'] = false;
        endif;


        return $data;
    }

}