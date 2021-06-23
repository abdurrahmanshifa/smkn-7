@extends('layouts.master')

@section('title')
    <title>Management Ubah Data Pegawai </title>
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
                                <a href="{{ route('pegawai.index') }}" class="btn btn-primary pull-right">
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
                                    NIP / NIGS
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$data->nip}}" class="form-control" name="nip">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Nama*
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$data->nama}}" class="form-control" name="nama">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Email*
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$data->email}}" class="form-control" name="email">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Tempat Lahir
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$data->tmpt_lahir}}" class="form-control" name="tmpt_lahir">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Tanggal Lahir
                                </label>
                                <div class="col-sm-10">
                                    <div class="input-group date" id="datetimepicker2" data-plugin="datetimepicker" >
                                        <input type="text" class="form-control" name="tgl_lahir" autocomplete="off" value="{{ date('d-m-Y',strtotime($data->tgl_lahir)) }}"data-date-format="DD-MM-YYYY"> 
                                        <span class="input-group-addon bg-info text-white">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" name="tgl">
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
                                    Telepon
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="telp" value="{{ $data->telp }}">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Agama
                                </label>
                                <div class="col-sm-10">
                                    <select name="agama" class="form-control select2">
                                        @foreach($agama as $val)
                                        <option {{ ($data->agama == $val->id?'selected':'') }} value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Pendidikan
                                </label>
                                <div class="col-sm-10">
                                    <select name="pend_terakhir" class="form-control select2">
                                        @foreach($pendidikan as $val)
                                            <option {{ ($data->pend_terakhir == $val->id?'selected':'') }} value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Jabatan
                                </label>
                                <div class="col-sm-10">
                                    <select name="jabatan" class="form-control select2">
                                        @foreach($jabatan as $val)
                                            <option {{ ($data->jabatan == $val->id?'selected':'') }} value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Status
                                </label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control select2">
                                       <option  {{ ($data->status == 1 ?'selected':'') }} value="1">Aktif</option>
                                       <option {{ ($data->status == 0 ?'selected':'') }} value="0">Tidak Aktif</option>
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
                                    <input type="hidden" name="foto_lama" value="{{$data->foto}}">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-2 control-label">
                                    Alamat
                                </label>
                                <div class="col-sm-10">
                                    <textarea style="resize:none;" name="alamat" class="form-control" cols="30" rows="5">{{$data->alamat}}</textarea>
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
    @include('pages.pegawai.script')
@endsection