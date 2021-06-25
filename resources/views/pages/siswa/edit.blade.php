@extends('layouts.master')

@section('title')
    <title>Management Ubah Data Siswa </title>
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
                                <h4>Ubah</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('siswa.index') }}" class="btn btn-primary pull-right">
                                    <i class="fa fa-chevron-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </header>
					<hr class="widget-separator">
					<div class="widget-body">
                        @include('includes.alert')
                        <form class="form-horizontal" name="form_input" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    NIK
                                </label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id">
                                    <input type="text" class="form-control" name="nik" value="{{ $data->nik }}">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Nama <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Tanggal Lahir <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tgl_lahir" value="{{ $data->tgl_lahir }}">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Jenis Kelamin
                                </label>
                                <div class="col-sm-10">
                                    <select name="jns_kelamin" class="form-control select2">
                                        @foreach($jnskelamin as $val)
                                            <option {{ ($data->jns_kelamin == $val->id?'selected':'') }} value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Foto
                                </label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="foto"  accept="image/x-png,image/gif,image/jpeg">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Alamat
                                </label>
                                <div class="col-sm-10">
                                    <textarea style="resize:none;" name="alamat" class="form-control" cols="30" rows="5">{{ $data->alamat }}</textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                               <div class="col-sm-12 text-center">
                                   <button type="submit" id="btn" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                         </form>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
			
		</div><!-- .row -->
	</section><!-- .app-content -->
@endsection

@section('script')
    <script>
        var save_method = 'edit';
    </script>
    @include('pages.siswa.script')
@endsection