@extends('layouts.master')

@section('title')
    <title>Pengaturan Informasi PPDB </title>
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
                                <h4>Pengaturan Informasi PPDB</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('ppdb.create') }}" class="btn btn-primary pull-right">
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
										<th>Judul</th>
										<th>Video Tutorial</th>
										<th>URL</th>
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
    @include('pages.ppdb.modal')
@endsection

@section('script')
    @include('pages.ppdb.script')
@endsection