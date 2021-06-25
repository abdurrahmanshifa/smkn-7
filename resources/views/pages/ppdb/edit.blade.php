@extends('layouts.master')

@section('title')
    <title>Pengaturan Informasi PPDB </title>
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
                                <h4>Edit Informasi PPDB</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('ppdb.index') }}" class="btn btn-primary pull-right">
                                    <i class="fa fa-chevron-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </header>
					<hr class="widget-separator">
					<div class="widget-body">
                        @include('includes.alert')
                        <form class="form-horizontal" action="{{ route('ppdb.update',$id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">Judul<span class="text-danger">*</span></label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" id="exampleTextInput1" name="judul" required placeholder="" value="{{ $get->judul }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">Status:<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <select name="is_active" class="form-control" data-plugin="select2" required>
                                        <option value="1" {{ $get->is_active == 1 ? 'selected="selected"' : '' }}>Aktif</option>
                                        <option value="0" {{ $get->is_active == 0 ? 'selected="selected"' : '' }}>Tidak Aktif</option>
                                    </select>
                                 </div>
                             </div>
                             <div class="form-group">
                               <label for="textarea1" class="col-sm-2 control-label">Background Kiri:<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="col-md-6" id="img-preview">
                                        <img src="{{ url('show-image/ppdb/'.$get->bg_dark) }}" class="img-thumbnail">
                                        </div>
                                   </div>
                                    <div class="input-group date" id="dark">
                                        <input type="file" class="form-control" name="dark" id="dark-img"> 
                                        <span class="input-group-addon bg-info text-white">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="textarea1" class="col-sm-2 control-label">Background Kanan:<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="col-md-6" id="light-preview">
                                            <img src="{{ url('show-image/ppdb/'.$get->bg_light) }}" class="img-thumbnail">
                                        </div>
                                   </div>
                                    <div class="input-group date" id="light">
                                        <input type="file" class="form-control" name="light" id="light-img"> 
                                        <span class="input-group-addon bg-info text-white">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">URL</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" id="exampleTextInput1" name="url" placeholder="Alamat URL" value="{{ $get->url }}">
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">Video Tutorial</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" id="exampleTextInput1" name="video_tutorial" placeholder="Alamat URL Youtube" value="{{ $get->video_tutorial }}">
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="textarea1" class="col-sm-2 control-label">Deskripsi<span class="text-danger">*</span></label>
                               <div class="col-sm-9">
                                   <textarea class="form-control" name="deskripsi" id="isi-artikel">{{ $get->deskripsi }}</textarea>
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
    @include('pages.ppdb.modal')
@endsection

@section('script')
    @include('pages.ppdb.script')
@endsection