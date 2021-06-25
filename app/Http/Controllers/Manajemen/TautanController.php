<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Helpers\DateHelper;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Tautan;
use Validator;
use DataTables;

class TautanController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Tautan::get();

            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('aksi', function($data) {
                $hasil = '
                    <button type="button" onclick="ubah(\''.$data->id.'\')" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                    </button>
                ';
                return $hasil;
            })
            ->escapeColumns([])
            ->make(true);
        }
        return view('pages.tautan.index');
    }

    public function ubah(Request $request)
    {
        if($request->input())
        {
            $validator = Validator::make($request->all(), [
                    'judul'      => 'required',
                ],
                [
                    'judul.required'     => 'Judul tidak boleh kosong!',
                ]
            );
         
            if ($validator->passes()) {
                $data = Tautan::find($request->input('id'));
                
                if($request->hasFile('icon'))
                {
                    $dir = 'tautan/icon';
                    $file = $request->file('icon');
                    $filename = str_replace(' ','_',strtolower($request->input('judul'))).'_'.Str::random(5). '.' . $file->getClientOriginalExtension();
                    $file->storeAs($dir, $filename);
                    $data->icon = $filename;
                }
                if($request->hasFile('bg_img'))
                {
                    $dir = 'tautan/bg';
                    $file = $request->file('bg_img');
                    $filename = str_replace(' ','_',strtolower($request->input('judul'))).'_'.Str::random(5). '.' . $file->getClientOriginalExtension();
                    $file->storeAs($dir, $filename);
                    $data->bg_img = $filename;
                }
                $data->judul = $request->input('judul');
                $data->bg_color = $request->input('bg_color');
                $data->url = $request->input('url');
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
        $data = Tautan::where('id', $id)->first();
        return response()->json($data);
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

        return $data;
    }

}