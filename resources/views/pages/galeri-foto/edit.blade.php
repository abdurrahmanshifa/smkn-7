@extends('layouts.master')

@section('title')
    <title>Management Galeri Foto </title>
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
                                <h4>Edit Galeri Foto</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('galeri-foto.index') }}" class="btn btn-primary pull-right">
                                    <i class="fa fa-chevron-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </header>
					<hr class="widget-separator">
					<div class="widget-body">
                        @include('includes.alert')
                        <form class="form-horizontal" action="{{ route('galeri-foto.update',$id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">Tanggal Posting:<span class="text-danger">*</span></label>
                               <div class="col-sm-7">
                                   <div class="input-group date" id="datetimepicker2" data-plugin="datetimepicker" >
                                       <input type="text" class="form-control" value="{{ date('d-m-Y',strtotime($get->tanggal)) }}" name="tanggal" autocomplete="off" data-date-format="DD-MM-YYYY"> 
                                       <span class="input-group-addon bg-info text-white">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">Judul Galeri:<span class="text-danger">*</span></label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" id="exampleTextInput1" name="judul" required placeholder="Judul Galeri..." value="{{ $get->judul }}">
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">Tags Galeri:<span class="text-danger">*</span></label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" data-plugin="tagsinput" id="exampleTextInput1" name="tags" required placeholder="Tags..." value="{{ $get->tags }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">Status:<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <select name="flag_active" class="form-control" data-plugin="select2" required>
                                        <option value="">-Pilih Status-</option>
                                        <option value="1" {{ $get->flag_active == 1 ? 'selected="selected"' : '' }}>Publish</option>
                                        <option value="0" {{ $get->flag_active == 0 ? 'selected="selected"' : '' }}>Draft</option>
                                    </select>
                                 </div>
                             </div>
                            <div class="form-group">
                               <label for="textarea1" class="col-sm-2 control-label">Foto :<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <div class="input-group date" id="cover">
                                        <input type="file" class="form-control" name="foto" id="cover-img"> 
                                        <span class="input-group-addon bg-info text-white">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </span>
                                    </div>
                                   <div class="row">
                                        <div class="col-md-6" id="img-preview">
                                            <img src="{{ url('show-image/galeri-foto/'.$get->foto) }}" class="img-thumbnail">
                                        </div>
                                   </div>
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="textarea1" class="col-sm-2 control-label">Keterangan:<span class="text-danger">*</span></label>
                               <div class="col-sm-9">
                                   <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan...">{{ $get->keterangan }}</textarea>
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
    @include('pages.galeri-foto.modal')
@endsection

@section('script')
    @include('pages.galeri-foto.script')
@endsection