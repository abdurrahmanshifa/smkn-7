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
                                <h4>Pengaturan Menu Aplikasi</h4>
                            </div>
                            <div class="col-md-6">
                                {{-- <a href="javascript:void(0);" class="btn btn-primary pull-right tambah_form">
                                    <i class="fa fa-plus"></i> Tambah Data
                                </a> --}}
                            </div>
                        </div>
                    </header>
					<hr class="widget-separator">
					<div class="widget-body">
						<div class="row">
							<div class="col-md-12">
								<!-- Profile Image -->
								<div class="col-md-12">
									<!-- Profile Image -->
										<div class="box box-primary" style="border-top: 3px solid #dd4b39;width:100%;padding:10px;">
											<div class="box-body box-profile text-center">
												<div class="row">
													<div class="col-md-4 text-left">
														<div class="form-group">
															<div class="col-md-12" style="padding-bottom: 10px">
																<label class="control-label">Parent Menu</label>
																	<select id="parent_menu" class="form-control" name="parent_menu">
																		<option value="">-- Pilih --</option>
																		<option value="0">Menu Utama</option>
																	</select>
															</div>
														</div>
														<div class="form-group">
															<div class="col-md-12" style="padding-bottom: 10px">
																<label class="control-label">Nama Menu</label>
																<input type="text" name="label" class="form-control" id="label" placeholder="Nama Menu ..." required>
															</div>
														</div>
														<div class="form-group">
																<div class="col-md-12" style="padding-bottom: 10px">
																	<label class="control-label">Pilih Konten</label>
																		<select id="type_page" class="form-control" name="type_page">
																			<option value="">-- Pilih --</option>
																			<option value="page">Page</option>
																			<option value="custom">Custom Link</option>
																			<option value="model_tabel">Nama Tabel</option>
																		</select>
																</div>
														</div>
														<div class="form-group" id="custome-link">
															<div class="col-md-12" style="padding-bottom: 10px">
																<label class="control-label">Custome Link</label>
																<input type="text" class="form-control" id="link" name="link" placeholder="Ketik Url/Link" required>
															</div>
														</div>
														<div class="form-group" id="">
															<div class="col-md-12" style="padding-bottom: 10px">
																<label class="control-label">Urutan</label>
																<input type="text" class="form-control" name="urutan" id="urutan" placeholder="Urutan" required>
															</div>
														</div>
														
														<div class="form-group">
																<div class="col-md-12" style="padding-bottom: 10px">
																	<button class="btn btn-flat btn-info" id="submit">Simpan</button> 
																	<button class="btn btn-flat btn-default" type="reset" id="reset">Reset</button>
																</div>
														</div>
														<input type="hidden" id="id">
														<input type="hidden" id="nestable-output">
														{{-- <div class="form-group">
																<div class="col-md-12" style="padding-bottom: 10px">
																<menu id="nestable-menu" style="margin: 0px">
																	<button type="button" class="btn btn-flat btn-primary" data-action="expand-all">Expand All</button>
																	<button type="button" class="btn btn-flat btn-warning" data-action="collapse-all">Collapse All</button>
																</menu>
																</div>
														</div> --}}
													</div>
													<div class="col-md-8 text-left">
														<h4>List Menu</h4>
														<div class="cf nestable-lists text-left">
															@php
																// $query = $this->db->order_by('sort')->get('master_menu')->result();
																$query = \App\Models\MasterMenu::with('getParent')->orderBy('urutan')->get();
								
																$ref   = [];
																$items = [];
																foreach($query as $data) {
																	$thisRef = &$ref[$data->id];
																	$thisRef['access_show']     = $data->access_show;
																	$thisRef['access_create']      = $data->access_create;    
																	$thisRef['access_detail']   = $data->access_detail;
																	$thisRef['access_update']     = $data->access_update;
																	$thisRef['access_delete']   = $data->access_delete;
																	$thisRef['parent']          = $data->parent;
																	$thisRef['label']           = $data->label;
																	$thisRef['link_page']            = $data->link_page;
																	$thisRef['link_custom']    = $data->link_custom;
																	$thisRef['id']              = $data->id;
																	$thisRef['urutan']            = $data->urutan;

																	if($data->parent == 0) {
																			$items[$data->id] = &$thisRef;
																	}else{
																			$ref[$data->parent]['child'][$data->id] = &$thisRef;
																	}
																}
															@endphp     
															<div class="dd" id="nestable" style="width: 100%;">
																
																@php
																	print \App\Helpers\MenuHelper::get_menu($items);
																@endphp
															</div>
		
														</div>
													</div>
												</div>
											</div>
											<!-- /.box-body -->
										</div>
									<!-- /.box -->
									</div>
								<!-- /.box -->
								</div>
							</div>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
			</div><!-- END column -->
			
		</div><!-- .row -->
	</section><!-- .app-content -->
@endsection

@section('modal')
@endsection

@section('script')
    @include('pages.menu.script')
@endsection