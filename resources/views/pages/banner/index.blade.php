@extends('layouts.master')

@section('title')
    <title>Pengaturan Menu Aplikasi </title>
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
                                <h4>Pengaturan Banner Aplikasi</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-primary pull-right tambah_form">
                                    <i class="fa fa-plus"></i> Tambah Data
                                </a>
                            </div>
                        </div>
                    </header>
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<table class="table table-striped"  width="100%" id="table">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Judul</th>
										<th class="text-center">Links</th>
										<th class="text-center">Status</th>
										<th class="text-center">Foto</th>
										<th class="text-center">Aksi</th>
									</tr>
								</thead>
							</table>
						</div>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
			
		</div><!-- .row -->
	</section><!-- .app-content -->
@endsection

@section('modal')
    @include('pages.banner.modal')
@endsection

@section('script')
    @include('pages.banner.script')
@endsection