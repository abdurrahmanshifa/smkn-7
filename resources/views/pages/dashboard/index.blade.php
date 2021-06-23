@extends('layouts.master')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
    <section class="app-content">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="widget stats-widget">
                    <div class="widget-body clearfix">
                        <div class="pull-left">
                            <h3 class="widget-title text-primary">
                                <span class="counter" data-plugin="counterUp">{{$jml_pengguna}}</span>
                            </h3>
                            <small class="text-color">Pengguna</small>
                        </div>
                        <span class="pull-right big-icon watermark">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>
                    <footer class="widget-footer bg-primary">
                        <a href="{{ route('pengguna') }}">
                            <small>
                                Lihat Detail
                            </small>
                        </a>
                        <span class="small-chart pull-right" data-plugin="sparkline" data-options="[4,3,5,2,1], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                    </footer>
                </div><!-- .widget -->
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="widget stats-widget">
                    <div class="widget-body clearfix">
                        <div class="pull-left">
                            <h3 class="widget-title text-danger">
                                <span class="counter" data-plugin="counterUp">{{$jml_guru}}</span>
                            </h3>
                            <small class="text-color">Guru</small>
                        </div>
                        <span class="pull-right big-icon watermark"><i class="fa fa-users"></i></span>
                    </div>
                    <footer class="widget-footer bg-danger">
                        <a href="{{ route('pegawai.index') }}">
                            <small>Lihat Detail</small>
                        </a>
                        <span class="small-chart pull-right" data-plugin="sparkline" data-options="[1,2,3,5,4], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                    </footer>
                </div><!-- .widget -->
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="widget stats-widget">
                    <div class="widget-body clearfix">
                        <div class="pull-left">
                            <h3 class="widget-title text-success">
                                <span class="counter" data-plugin="counterUp">{{$jml_staf}}</span>
                            </h3>
                            <small class="text-color">Staff</small>
                        </div>
                        <span class="pull-right big-icon watermark"><i class="fa fa-user"></i></span>
                    </div>
                    <footer class="widget-footer bg-success">
                        <a href="{{ route('pegawai.index') }}">
                            <small>Lihat Detail</small>
                        </a>
                        <span class="small-chart pull-right" data-plugin="sparkline" data-options="[2,4,3,4,3], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                    </footer>
                </div><!-- .widget -->
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="widget stats-widget">
                    <div class="widget-body clearfix">
                        <div class="pull-left">
                            <h3 class="widget-title text-warning">
                                <span class="counter" data-plugin="counterUp">{{$jml_visit}}</span>
                            </h3>
                            <small class="text-color">Pengunjung Hari Ini</small>
                        </div>
                        <span class="pull-right big-icon watermark"><i class="fa fa-line-chart "></i></span>
                    </div>
                    <footer class="widget-footer bg-warning">
                        <a href="#">
                            <small>Lihat Detail</small>
                        </a>
                        <span class="small-chart pull-right" data-plugin="sparkline" data-options="[2,1,4,2,1], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                    </footer>
                </div><!-- .widget -->
            </div>
            <div class="col-md-12">
				<div class="row">
                    <div class="col-md-3">
                        <div class="widget">
                            <header class="widget-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('pegawai.index') }}">
                                            <h4>Pegawai Berdasarkan Jenis Kelamin</h4>
                                        </a>
                                    </div>
                                </div>
                            </header>
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div id="jenis_kelamin">
                                    
                                </div>
                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div>
                    <div class="col-md-9">
                        <div class="widget">
                            <header class="widget-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="#">
                                            <h4>Pengunjung Bulan Ini</h4>
                                        </a>
                                    </div>
                                </div>
                            </header>
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div id="visitor">
                                    
                                </div>
                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div>
                </div>
			</div><!-- END column -->
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-warning">
                                        <span class="counter" data-plugin="counterUp">{{$jml_komentar}}</span>
                                    </h3>
                                    <small class="text-color">Komentar</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="fa fa-comment "></i></span>
                            </div>
                            <footer class="widget-footer bg-warning">
                                <a href="{{ route('komentar.index') }}">
                                    <small>Lihat Detail</small>
                                </a>
                                <span class="small-chart pull-right" data-plugin="sparkline" data-options="[2,4,2,4,1], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                            </footer>
                        </div><!-- .widget -->
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-success">
                                        <span class="counter" data-plugin="counterUp">{{$jml_foto}}</span>
                                    </h3>
                                    <small class="text-color">Foto</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="fa fa-file-image-o "></i></span>
                            </div>
                            <footer class="widget-footer bg-success">
                                <a href="{{ route('galeri-foto.index') }}">
                                    <small>Lihat Detail</small>
                                </a>
                                <span class="small-chart pull-right" data-plugin="sparkline" data-options="[2,4,2,2,1], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                            </footer>
                        </div><!-- .widget -->
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="widget stats-widget">
                            <div class="widget-body clearfix">
                                <div class="pull-left">
                                    <h3 class="widget-title text-danger">
                                        <span class="counter" data-plugin="counterUp">{{$jml_video}}</span>
                                    </h3>
                                    <small class="text-color">Video</small>
                                </div>
                                <span class="pull-right big-icon watermark"><i class="fa fa-file-video-o"></i></span>
                            </div>
                            <footer class="widget-footer bg-danger">
                                <a href="{{ route('galeri-video.index') }}">
                                    <small>Lihat Detail</small>
                                </a>
                                <span class="small-chart pull-right" data-plugin="sparkline" data-options="[4,2,1,4,3], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                            </footer>
                        </div><!-- .widget -->
                    </div>
                </div>
            </div>
            <div class="col-md-9">
				<div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <header class="widget-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('artikel.index') }}">
                                            <h4>Artikel</h4>
                                        </a>
                                    </div>
                                </div>
                            </header>
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table_artikel"  width="100%" id="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul</th>
                                                <th>Status</th>
                                                <th>Dilihat</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div>
                    <div class="col-md-12">
                        <div class="widget">
                            <header class="widget-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('file') }}">
                                            <h4>File</h4>
                                        </a>
                                    </div>
                                </div>
                            </header>
                            <hr class="widget-separator">
                            <div class="widget-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table_file"  width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul</th>
                                                <th>Status</th>
                                                <th>Download</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div><!-- .widget-body -->
                        </div><!-- .widget -->
                    </div><!-- END column -->
                </div>
			</div><!-- END column -->

        </div><!-- .row -->

    </section>
@endsection
@section('script')
    @include('pages.dashboard.script')
@endsection
