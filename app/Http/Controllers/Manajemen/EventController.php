<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Helpers\DateHelper;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Event;
use Validator;
use DataTables;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Event::get();

            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('foto', function($data) {
                $hasil = "<img width='100px;' src='".url('show-image/event/'.$data->foto)."'>";
                return $hasil;
            })
            ->editColumn('tanggal', function($data) {
                $hasil = DateHelper::tglIndTimeIcon($data->tanggal_mulai).' <br> sampai <br> '.DateHelper::tglIndTimeIcon($data->tanggal_akhir);
                return $hasil;
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
        return view('pages.event.index');
    }

    public function simpan(Request $request)
    {
        if($request->input())
        {
            $validator = Validator::make($request->all(), [
                    'nama'      => 'required',
                    'lokasi'    => 'required',
                    'tanggal_mulai' => 'required',
                    'tanggal_akhir' => 'required'
                ],
                [
                    'nama.required'     => 'Nama event tidak boleh kosong!',
                    'lokasi.required'    => 'Lokasi event tidak boleh kosong!',
                    'tanggal_mulai.required'    => 'Tanggal mulai event tidak boleh kosong!',
                    'tanggal_akhir.required'    => 'Tanggal selesai event tidak boleh kosong!',
                ]
            );
            
         
            if ($validator->passes()) {
                $data = new Event();

                if($request->hasFile('images'))
                {
                    $dir = 'event';
                    $file = $request->file('images');
                    $filename = str_replace(' ','_',strtolower($request->input('nama'))).'_'.Str::random(5). '.' . $file->getClientOriginalExtension();
                    $file->storeAs($dir, $filename);
                    $data->foto = $filename;
                }

                $data->id  = Uuid::uuid4()->getHex();
                $data->nama = $request->input('nama');
                $data->deskripsi = $request->input('deskripsi');
                $data->lokasi = $request->input('lokasi');
                $data->tanggal_mulai = $request->input('tanggal_mulai');
                $data->tanggal_akhir = $request->input('tanggal_akhir');
                $data->lat = $request->input('lat');
                $data->long = $request->input('long');
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
                    'nama'      => 'required',
                    'lokasi'    => 'required',
                    'tanggal_mulai' => 'required',
                    'tanggal_akhir' => 'required'
                ],
                [
                    'nama.required'     => 'Nama event tidak boleh kosong!',
                    'lokasi.required'    => 'Lokasi event tidak boleh kosong!',
                    'tanggal_mulai.required'    => 'Tanggal mulai event tidak boleh kosong!',
                    'tanggal_akhir.required'    => 'Tanggal selesai event tidak boleh kosong!',
                ]
            );
         
            if ($validator->passes()) {
                $data = Event::find($request->input('id'));
                
                if($request->hasFile('images'))
                {
                    $dir = 'event';
                    $file = $request->file('images');
                    $filename = str_replace(' ','_',strtolower($request->input('nama'))).'_'.Str::random(5). '.' . $file->getClientOriginalExtension();
                    $file->storeAs($dir, $filename);
                    $data->foto = $filename;
                }
                $data->nama = $request->input('nama');
                $data->deskripsi = $request->input('deskripsi');
                $data->lokasi = $request->input('lokasi');
                $data->tanggal_mulai = $request->input('tanggal_mulai');
                $data->tanggal_akhir = $request->input('tanggal_akhir');
                $data->lat = $request->input('lat');
                $data->long = $request->input('long');
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
        $data = Event::where('id', $id)->first();
        $tgl_mulai = explode(' ',$data->tanggal_mulai);
        $data->tanggal_mulai = $tgl_mulai[0].'T'.$tgl_mulai[1];

        $tgl_akhir = explode(' ',$data->tanggal_akhir);
        $data->tanggal_akhir = $tgl_akhir[0].'T'.$tgl_akhir[1];
        return response()->json($data);
    }

    public function hapus(Request $request , $id)
    {
        $data = Event::find($id);
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
        if ($validator->errors()->has('lokasi')):
            $data['input_error'][] = 'lokasi';
            $data['error_string'][] = $validator->errors()->first('lokasi');
            $data['status'] = false;
        endif;
        if ($validator->errors()->has('tanggal_mulai')):
            $data['input_error'][] = 'tanggal_mulai';
            $data['error_string'][] = $validator->errors()->first('tanggal_mulai');
            $data['status'] = false;
        endif;
        if ($validator->errors()->has('tanggal_akhir')):
            $data['input_error'][] = 'tanggal_akhir';
            $data['error_string'][] = $validator->errors()->first('tanggal_akhir');
            $data['status'] = false;
        endif;

        return $data;
    }

}