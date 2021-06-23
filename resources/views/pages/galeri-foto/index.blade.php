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
                                <h4>Manajemen Galeri Foto</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('galeri-foto.create') }}" class="btn btn-primary pull-right">
                                    <i class="fa fa-plus"></i> Tambah Data
                                </a>
                            </div>
                        </div>
                    </header>
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							@include('includes.alert')
							<table class="table table-striped"  width="100%" id="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Foto</th>
										<th>Judul</th>
										<th>Tags</th>
										<th>Waktu Upload</th>
										<th>Status</th>
										<th>View</th>
										<th>Aksi</th>
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
    @include('pages.galeri-foto.modal')
@endsection

@section('script')
    @include('pages.galeri-foto.script')
@endsection