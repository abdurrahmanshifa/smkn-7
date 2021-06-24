<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\File;
use App\Models\Komentar;

class FrontendController extends Controller
{
    public function pages($page,$detail=null)
    {
          if(($page == 'artikel' || $page == 'jurusan') && $detail != null)
          {
               $detail = explode('-',$detail);
               return view('template.education.pages.detail')->with('page', $page)->with('id',$detail);
          }
          else if($page == 'download' && $detail != null){

               $file = File::findOrFail($detail);

               if(isset($file))
               {
                    $file->download = $file->download + 1;
                    $file->save();
               }
               return response()->download(public_path('storage/file/'.$file->file));
          }
          else{
               return view('template.education.pages.index')->with('page', $page)->with('id', $detail);
          }
    }

    public function store_comment_artikel(Request $request)
    {
        try{
            DB::beginTransaction();
            $id = $request->id;
            
            $komen = new Komentar;
            $komen->id_artikel = $id;
            $komen->nama = strip_tags($request->name);
            $komen->email = strip_tags($request->email);
            $komen->website = strip_tags($request->website);
            $komen->isi_komentar = strip_tags($request->isi_komentar);
            $komen->save();

            DB::commit();

            $msg = array(
                'success' => true, 
                'message' => 'Komentar berhasil di tambah!',
                'status' => TRUE,
                'icon'  => 'success'
            );
           
        }
        catch(Exception $ex)
        {
            DB::rollback();
            $msg = array(
                'success' => false, 
                'message' => 'Komentar gagal di tambah!',
                'status' => TRUE,
                'icon'  => 'error'
            );
            return response()->json($msg);
        }
    }

    public function imageCode()
    {
        $random_alpha = sha1(md5(rand()));    
        $captcha_code = substr($random_alpha, 0, 6);   

        // $_SESSION['captcha_code'] = $captcha_code; 
        Session::put('captcha_code',$captcha_code);

        header('Content-Type: image/png');  

        $image = imagecreatetruecolor(200, 38); 
        $background_color = imagecolorallocate($image, 231, 100, 18);   
        $text_color = imagecolorallocate($image, 255, 255, 255);    
        imagefilledrectangle($image, 0, 0, 200, 38, $background_color); 
        // return dirname(__FILE__);
        $font = public_path('fonts/arial.ttf');   
        // return $font;
        imagettftext($image, 20, 0, 60, 28, $text_color, $font, $captcha_code); 
        imagepng($image);   
        imagedestroy($image);
    }

    public function check_captcha_code(Request $request)
    {
        // return $request;
        //$rules = ['captcha' => 'required|captcha'];
        //$validator = validator()->make(request()->all(), $rules);
        try{
            DB::beginTransaction();
            
            $komen = new Komentar;
            $komen->id_artikel = $request->id_artikel;
            $komen->nama = strip_tags($request->name);
            $komen->email = strip_tags($request->email);
            $komen->website = strip_tags($request->website);
            $komen->isi_komentar = strip_tags($request->isi_komentar);
            $komen->tanggal = date('Y-m-d');
            $komen->save();
            DB::commit();
            $msg = array(
                'title' => "Berhasil", 
                'message' => 'Komentar Anda Berhasil Di Simpan',
                'status' => True,
                'icon'  => 'success'
            );
                
            // if ($validator->fails() == true) {
            //     $msg = array(
            //         'title' => "Perhatian !", 
            //         'message' => 'Kode Keamanan Tidak Sesuai',
            //         'status' => FALSE,
            //         'icon'  => 'error'
            //     );
            // } else {

                
            // }
            
            return response()->json($msg);
        }
        catch(Exception $ex){
            DB::rollback();
            $msg = array(
                'success' => false, 
                'message' => 'Terjadi Kesalahan',
                'status' => FALSE,
                'icon'  => 'error'
            );
            return response()->json($msg);
        }
    }

    function refereshCapcha()
    {
        return captcha_img('flat'); 
    }
}