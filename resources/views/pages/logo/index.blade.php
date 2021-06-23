@extends('layouts.master')

@section('title')
    <title>Pengaturan Logo Aplikasi</title>
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
                                <h4>Pengaturan Logo Aplikasi</h4>
                            </div>
                        </div>
                    </header>
					<form class="form-horizontal" method="POST" action="" name="form_input">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="method" value="{{ (isset($logo->id)?'ubah':'simpan') }}">
                            <input type="hidden" name="id" value="{{ @$logo->id }}">
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Logo Utama
                                </label>
                                <div class="col-sm-9">
                                    <div class="thumbnail white utama">
                                        @if(@$logo->logo_utama != null)
                                            <img style="height:150px;" id="logo-utama" src="{{ url('app/logo/'.$logo->logo_utama)}}" />
                                            <div class="caption text-right">
                                                <button type="button" onclick="hapus_utama()" class="btn btn-danger">Hapus</button>
                                            </div>
                                        @else
                                            <img style="width:100%;" id="logo-utama" src="{{asset('img/preview.png') }}" />
                                        @endif;
                                    </div>
                                    <input type="hidden" name="logo_utama_old" value="{{ @$logo->logo_utama }}">
                                    <input type="file" class="form-control" name="logo" id="logo_utama" accept="image/png,image/jpg,image/jpeg">
                                    <span class="help-block">
                                        *hanya untuk format jpg dan png, maksimal file 2 Mb
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextInput1" class="col-sm-3 control-label">
                                    Logo Alternatif
                                </label>
                                <div class="col-sm-9">
                                    <div class="thumbnail white alt">
                                        @if(@$logo->logo_alt != null)
                                            <img style="height:150px;" id="logo-alt" src="{{ url('app/logo/'.$logo->logo_alt)}}" />
                                            <div class="caption text-right">
                                                <button type="button" onclick="hapus_alt()" class="btn btn-danger">Hapus</button>
                                            </div>
                                        @else
                                            <img style="width:100%;" id="logo-alt" src="{{asset('img/preview.png') }}" />
                                        @endif;
                                    </div>
                                    <input type="hidden" name="logo_alt_old" value="{{ @$logo->logo_alt }}">
                                    <input type="file" class="form-control" accept="image/png,image/jpg,image/jpeg" name="logo_alt" id="logo_alt">
                                    <span class="help-block">
                                        *hanya untuk format jpg dan png, maksimal file 2 Mb
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
    @include('pages.logo.script')
@endsection