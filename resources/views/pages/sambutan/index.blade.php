@extends('layouts.master')

@section('title')
    <title>Manajemen Sambutan</title>
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
                                <h4>Manajemen Sambutan</h4>
                            </div>
                        </div>
                    </header>
					<form class="form-horizontal" method="POST" action="" name="form_input">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="method" value="{{ (isset($data->id)?'ubah':'simpan') }}">
                            <input type="hidden" name="id" value="{{ @$data->id }}">
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Foto
                                </label>
                                <div class="col-sm-9">
                                    <div class="thumbnail white utama">
                                        @if(@$data->foto != null)
                                            <img style="height:150px;" id="logo-utama" src="{{ url('show-image/tentang/'.$data->foto)}}" />
                                            <div class="hapus-caption">
                                                <div class="caption text-right">
                                                    <button type="button" onclick="hapus_utama()" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </div>
                                        @else
                                            <img style="width:100%;" id="logo-utama" src="{{asset('img/preview.png') }}" />
                                        @endif
                                    </div>
                                    <input type="hidden" name="foto_old" value="{{ @$data->foto }}">
                                    <input type="file" class="form-control" name="foto" id="foto" accept="image/png,image/jpg,image/jpeg">
                                    <span class="help-block">
                                        *hanya untuk format jpg dan png, maksimal file 2 Mb
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Judul <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  name="judul" id="logo_alt" value="{{ @$data->judul }}">
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Deskripsi <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="deskripsi" id="isi-artikel" placeholder="Isi jurusan...">{{ @$data->deskripsi }}</textarea>
                                    <input type="hidden" name="is_text" id="">
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn" class="btn btn-primary">Simpan</button>
                            <button type="button" onClick="window.location.reload();" class="btn btn-danger">Batal</button>
                        </div>
                    </form>
				</div><!-- .widget -->
			</div><!-- END column -->
			
		</div><!-- .row -->
	</section><!-- .app-content -->
@endsection
@section('script')
    @include('pages.sambutan.script')
@endsection