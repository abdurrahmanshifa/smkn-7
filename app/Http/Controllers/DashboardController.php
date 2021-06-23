<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\DateHelper;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Artikel;
use App\Models\GaleriFoto;
use App\Models\GaleriVideo;
use App\Models\Komentar;
use App\Models\File;
use App\Models\Visits;
use DataTables;
use Shetabit\Visitor\Traits\Visitable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        // echo Visits::period(Period::create('10-01-2018', '17-02-2018'));
        // exit();
        // 
        // $visit =  Visits::select(DB::raw('count(*) as jumlah') )->groupBy(DB::raw('Date(created_at)'))->get();
        // echo json_encode($visit);
        // exit();
        $tahun = date('Y'); //Mengambil tahun saat ini
        $bulan = date('m'); //Mengambil bulan saat ini
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        
        for ($i=1; $i < $tanggal+1; $i++) {  
            $day = date("Y-m-".$i);
            $stat[$i]['tanggal'] = DateHelper::tglInd($day);
            $stat[$i]['jml']    = Visits::whereDate('created_at',$day)->get()->count();
        }

        // echo json_encode($stat);
        // exit();

        $pegawai = Pegawai::get();
        $jml_staf = 0;
        $jml_guru = 0;
        $laki= 0;
        $pr = 0;
        foreach($pegawai as $val){
            if($val->jabatan == '31f411bb5756407d952bb82c958913c1'){
                $jml_staf++;
            }else{
                $jml_guru++;
            }

            if($val->jns_kelamin == '7b0e838cf417482783036fbaf8681b4f'){
                $laki++;
            }else{
                $pr++;
            }
        }

        $jml_visit = Visits::whereDate('created_at', Carbon::today())->count();
        $jml_pengguna = User::count();
        $jml_artikel = Artikel::count();
        $komentar = Komentar::count();
        $foto = GaleriFoto::count();
        $video = GaleriVideo::count();

        return view('pages.dashboard.index')
        ->with('jml_staf',$jml_staf)
        ->with('jml_guru',$jml_guru)
        ->with('jml_pengguna',$jml_pengguna)
        ->with('jml_artikel',$jml_artikel)
        ->with('jml_visit',$jml_visit)
        ->with('laki',$laki)
        ->with('pr',$pr)
        ->with('stat',$stat)
        ->with('jml_komentar',$komentar)
        ->with('jml_foto',$foto)
        ->with('jml_video',$video)
        ;
    }
}