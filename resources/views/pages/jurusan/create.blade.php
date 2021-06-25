@extends('layouts.master')

@section('title')
    <title>Management Konten Jurusan </title>
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
                                <h4>Tambah Konten Jurusan</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('jurusan.index') }}" class="btn btn-primary pull-right">
                                    <i class="fa fa-chevron-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </header>
					<hr class="widget-separator">
					<div class="widget-body">
                        @include('includes.alert')
                        <form class="form-horizontal" action="{{ route('jurusan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">Kategori Artikel:<span class="text-danger">*</span></label>
                               <div class="col-sm-7">
                                   <select name="id_kategori" class="form-control select2" data-plugin="select2" required>
                                       <option value="">-Pilih Kategori-</option>
                                       @foreach ($kategori as $item)
                                           <option value="{{ $item->id }}" {{ old('id_kategori') ? 'selected="selected"' : '' }}>{{ $item->name }}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">Tanggal Artikel:<span class="text-danger">*</span></label>
                               <div class="col-sm-7">
                                   <div class="input-group date" id="datetimepicker2" data-plugin="datetimepicker" >
                                       <input type="text" class="form-control" value="{{ old('tanggal') }}" name="tanggal" autocomplete="off" data-date-format="DD-MM-YYYY"> 
                                       <span class="input-group-addon bg-info text-white">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="exampleTextInput1" class="col-sm-2 control-label">Judul Artikel:<span class="text-danger">*</span></label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" id="exampleTextInput1" name="judul" required placeholder="Judul jurusan..." value="{{ old('judul') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">Status:<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <select name="flag_active" class="form-control" data-plugin="select2" required>
                                        <option value="">-Pilih Status-</option>
                                        <option value="1" {{ old('flag_active') == 1 ? 'selected="selected"' : '' }}>Publish</option>
                                        <option value="0" {{ old('flag_active') == 0 ? 'selected="selected"' : '' }}>Draft</option>
                                    </select>
                                 </div>
                             </div>
                            <div class="form-group">
                               <label for="textarea1" class="col-sm-2 control-label">Cover:<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="col-md-6" id="img-preview"></div>
                                    </div>
                                    <div class="input-group date" id="cover">
                                        <input type="file" class="form-control" name="cover" id="cover-img" required> 
                                        <span class="input-group-addon bg-info text-white">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                               <label for="textarea1" class="col-sm-2 control-label">Isi Artkel:<span class="text-danger">*</span></label>
                               <div class="col-sm-9">
                                   <textarea class="form-control" name="isi_artikel" id="isi-artikel" placeholder="Isi jurusan...">{{ old('isi_artikel') }}</textarea>
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
    @include('pages.jurusan.modal')
@endsection

@section('script')
    @include('pages.jurusan.script')
@endsection