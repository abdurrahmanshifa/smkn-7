@extends('layouts.master')

@section('title')
    <title>Pengaturan Lokasi </title>
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
                                <h4>Pengaturan Lokasi</h4>
                            </div>
                        </div>
                    </header>
					<form class="form-horizontal" method="POST" action="" name="form_input">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="method" value="{{ (isset($lokasi->id)?'ubah':'simpan') }}">
                            <input type="hidden" name="id" value="{{ (isset($lokasi->id)?$lokasi->id :0)}}">
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Nama Aplikasi
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" value="{{ @$lokasi->nama }}">
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Telepon
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="telp" value="{{ @$lokasi->telp }}">
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Alamat Email
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" value="{{ @$lokasi->email }}">
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Fax
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="fax" value="{{ @$lokasi->fax }}">
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Lattitude
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="lat" value="{{ @$lokasi->lat }}">
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Longitude
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="long" value="{{ @$lokasi->long }}">
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Alamat
                                </label>
                                <div class="col-sm-9">
                                    <textarea name="alamat" class="form-control" id="" cols="30" style="resize:none">{{ @$lokasi->alamat }}</textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn" class="btn btn-primary">Simpan</button>
                            <button type="button" onClick="window.location.reload();" class="btn btn-danger">Batal</button>
                            <button type="button" onclick="hapus()" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
				</div><!-- .widget -->
			</div><!-- END column -->
			
		</div><!-- .row -->
	</section><!-- .app-content -->
@endsection
@section('script')
    @include('pages.lokasi.script')
@endsection