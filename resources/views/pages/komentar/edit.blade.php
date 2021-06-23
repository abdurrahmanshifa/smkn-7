@extends('layouts.master')

@section('title')
    <title>Managemen Komentar </title>
@endsection

@section('content')
    <section class="app-content">
		<div class="row">
			<!-- DOM dataTable -->
			<div class="col-md-12">
				<div class="widget">
                    <header class="widget-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Edit Komentar</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('komentar.index') }}" class="btn btn-primary pull-right">
                                    <i class="fa fa-chevron-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </header>
					<hr class="widget-separator">
					<div class="widget-body">
                        @include('includes.alert')
                        <form class="form-horizontal" action="{{ route('komentar.update',$id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">Judul Artikel:<span class="text-danger">*</span></label>
                               <div class="col-sm-7">
                                   <b class="form-control">{!! $get->artikel->judul !!}</b>
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">Tanggal Artikel:<span class="text-danger">*</span></label>
                               <div class="col-sm-7">
                                    <b class="form-control">{!! date('d-m-Y',strtotime($get->artikel->tanggal)) !!}</b>
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">Judul Komentar:<span class="text-danger">*</span></label>
                               <div class="col-sm-7">
                                   <b class="form-control">{!! $get->isi_komentar !!}</b>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">Tanggal Komentar:<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                     <b class="form-control">{!! date('d-m-Y',strtotime($get->tanggal)) !!}</b>
                                 </div>
                             </div>
                            
                            <div class="form-group">
                               <label for="textarea1" class="col-sm-2 control-label">Judul Balasan:<span class="text-danger">*</span></label>
                               <div class="col-sm-9">
                                   <input type="text" class="form-control" name="judul_balasan" placeholder="Judul Balasan..." value="{{ isset($get->balasan[0]->judul_balasan) ? $get->balasan[0]->judul_balasan : '' }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="textarea1" class="col-sm-2 control-label">Isi Balasan Komentar:<span class="text-danger">*</span></label>
                               <div class="col-sm-9">
                                   <textarea class="form-control" name="isi_balasan" id="isi-balasan" placeholder="Isi Balasan...">{{ isset($get->balasan[0]->isi_balasan) ? $get->balasan[0]->isi_balasan : '' }}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                               <div class="col-sm-9 col-sm-offset-4">
                                   <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                         </form>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
			
		</div><!-- .row -->
	</section><!-- .app-content -->
@endsection

@section('modal')
    @include('pages.komentar.modal')
@endsection

@section('script')
    @include('pages.komentar.script')
@endsection