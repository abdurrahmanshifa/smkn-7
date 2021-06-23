@extends('layouts.master')

@section('title')
    <title>Managemen Konten Komentar </title>
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
                                <h4>Manajemen Konten Komentar</h4>
                            </div>
                            <div class="col-md-6">
                                
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
										<th>Judul Artikel</th>
										<th>Judul Komentar</th>
										<th>Komentar</th>
										<th>Tanggal</th>
										<th>Pengirim</th>
										<th>Status Balasan</th>
										<th>Status</th>
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
    @include('pages.komentar.modal')
@endsection

@section('script')
    @include('pages.komentar.script')
@endsection