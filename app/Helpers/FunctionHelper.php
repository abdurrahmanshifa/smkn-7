<?php
namespace App\Helpers;
use App\Models\Logo;
use App\Models\Pegawai;
use App\Models\Lokasi;
use App\Models\File;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Jurusan;
use App\Models\Event;
use App\Models\Komentar;
use Ramsey\Uuid\Uuid;
use App\Models\Banner;
use App\Models\GaleriFoto;
use App\Models\GaleriVideo;
use Illuminate\Support\Facades\Http;

class FunctionHelper{

    public static function covertTimeToDate($data){
        if($data != '-'){
            $time =  date('Y-m-d H:i:s', $data);
            $hasil = self::indonesian_date($time);
            return $hasil;
        }else{
            return $data;
        }
    }

    public static function indonesian_date ($timestamp = '', $date_format = 'l, j F | H:i', $suffix = '') {

        if($timestamp == '0000-00-00 00:00:00' || $timestamp == null)
        {
             return '-';
             exit();
        }
   
        if (trim ($timestamp) == '')
        {
             $timestamp = time ();
        }
        elseif (!ctype_digit ($timestamp))
        {
             $timestamp = strtotime ($timestamp);
        }

        $date_format = preg_replace ("/S/", "", $date_format);
        $pattern = array (
             '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
             '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
             '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
             '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
             '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
             '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
             '/April/','/June/','/July/','/August/','/September/','/October/',
             '/November/','/December/',
        );
        $replace = array ( '','','','','','','',
             '','','','','','','',
             'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
             'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
             'Oktober','November','Desember',
        );
        $date = date ($date_format, $timestamp);
        $date = preg_replace ($pattern, $replace, $date);
        $date = "{$date} {$suffix}";
        $data = str_replace(",",' ', $date);
        return $data;
    }
    
    public static function indonesian_date_2 ($timestamp = '', $date_format = 'l, j F', $suffix = '') {

        if($timestamp == '0000-00-00 00:00:00' || $timestamp == null)
        {
             return '-';
             exit();
        }
   
        if (trim ($timestamp) == '')
        {
             $timestamp = time ();
        }
        elseif (!ctype_digit ($timestamp))
        {
             $timestamp = strtotime ($timestamp);
        }

        $date_format = preg_replace ("/S/", "", $date_format);
        $pattern = array (
             '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
             '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
             '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
             '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
             '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
             '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
             '/April/','/June/','/July/','/August/','/September/','/October/',
             '/November/','/December/',
        );
        $replace = array ( '','','','','','','',
             '','','','','','','',
             'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
             'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
             'Oktober','November','Desember',
        );
        $date = date ($date_format, $timestamp);
        $date = preg_replace ($pattern, $replace, $date);
        $date = "{$date} {$suffix}";
        $data = str_replace(",",' ', $date);
        return $data;
    }

    public static function logo()
    {
         $logo = Logo::first();
         return $logo;
    }
    public static function banner($limit=3)
    {
         $banner = Banner::where('status',1)->orderBy('created_at','desc')->limit(3)->get();
         return $banner;
    }

    public static function kategori()
    {
         $kategori = Kategori::with('artikel')->orderBy('created_at','desc')->get();
         return $kategori;
    }

    public static function detailkategori($id)
    {
         $kategori = Kategori::with('artikel')->find($id);
         return $kategori;
    }

    public static function lokasi(){
          $lokasi = Lokasi::first();
          return $lokasi;
    }

    public static function pegawai(){
     $pegawai = Pegawai::with('Datajabatan')->orderBy('jabatan')->where('status',1)->get();
     return $pegawai;
}

    public static function artikel($limit=null){
          $artikel = Artikel::where('flag_active',1)->where('id_kategori','!=','c60220a9914e4c6883ab61b225961a9c');

          if($limit != null){
               $data = $artikel->limit(3)->orderBy('view')->get();
          }else{
               $data = $artikel->with(['kategori','user','komentar'])->orderBy('created_at','desc')->paginate(6);
          }

          return $data;
     }
     public static function artikelbyKategori($id){
          $artikel = Artikel::where('flag_active',1)->where('id_kategori',$id);
          $data = $artikel->with(['kategori','user','komentar'])->orderBy('created_at','desc')->paginate(6);
          return $data;
     }

     public static function artikelPopuler($limit=null){
          $artikel = Artikel::where('flag_active',1)->where('id_kategori','=','9b84d069ced14b6e9867326666633dc0');
          $data = $artikel->limit($limit)->orderBy('view')->get();
          return $data;
     }

     public static function artikelPengumuman($limit=null){
          $artikel = Artikel::where('flag_active',1)->where('id_kategori','=','5a104f61acbe400087b330444c6c2fc7');
          $data = $artikel->limit($limit)->orderBy('created_at','desc')->get();
          return $data;
     }

     public static function detail_artikel($id){
          $artikel = Artikel::where('id',$id)->where('flag_active',1)->with(['kategori','user'])->first();

          if(isset($artikel))
          {
               $artikel->view = $artikel->view + 1;
               $artikel->save();
          }
          

          return $artikel;
     }

     public static function detail_jurusan($id){
          $jurusan = Jurusan::where('id',$id)->where('flag_active',1)->with(['kategori','user'])->first();

          if(isset($jurusan))
          {
               $jurusan->view = $jurusan->view + 1;
               $jurusan->save();
          }
          

          return $jurusan;
     }

     public static function komentar($id=null){

          $komentar = Komentar::where('flag_active',1)->with(['balasan','user']);

          if($id != null){
               $data = $komentar->where('id_artikel',$id)->get();
          }else{
               $data = $komentar->get();
          }
          return $data;
     }

     public static function foto($limit=null){
          $foto = GaleriFoto::where('flag_active',1);

          if($limit != null){
               $data = $foto->limit(3)->orderBy('view')->get();
          }else{
               $data = $foto->orderBy('created_at','desc')->get();
          }

          return $data;
     }

     public static function video($limit=null){
          $video = GaleriVideo::where('flag_active',1);

          if($limit != null){
               $data = $video->limit(3)->orderBy('view')->get();
          }else{
               $data = $video->orderBy('created_at','desc')->get();
          }

          return $data;
     }

     public static function download(){
          $file = File::get();
          return $file;
     }

     public static function event($limit){
          $event = Event::orderBy('created_at','desc')->take($limit)->get();
          return $event;
     }

     public static function profil()
     {
          $artikel = Artikel::where('flag_active',1);

          $data = $artikel->where('id_kategori','c60220a9914e4c6883ab61b225961a9c')->with(['kategori','user','komentar'])->orderBy('created_at','desc')->first();
          return $data;
     }


}
?>