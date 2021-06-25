@extends('layouts.master')

@section('title')
    <title>Management Tautan </title>
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
                                <h4>Manajemen Tautan</h4>
                            </div>
                        </div>
                    </header>
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="table-responsive">
							<table class="table table-striped"  width="100%" id="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Judul</th>
										<th>Url</th>
										<th>Warna Background</th>
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
    @include('pages.tautan.modal')
@endsection

@section('script')
    @include('pages.tautan.script')
@endsection