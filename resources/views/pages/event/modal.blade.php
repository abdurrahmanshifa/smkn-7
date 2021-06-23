<div class="modal" id="modal_form" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <form class="form-horizontal" method="POST" action="" name="form_input">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleTextInput1" class="col-sm-3 control-label">
                                Nama Event
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id">
                                <input type="text" class="form-control" name="nama">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextInput1" class="col-sm-3 control-label">
                                Cover
                            </label>
                            <div class="col-sm-9">
                                <div class="foto-cover"></div>
                                <input type="file" class="form-control" id="images" name="images" accept="image/png,image/jpg,image/jpeg">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextInput1" class="col-sm-3 control-label">
                                Lokasi
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lokasi">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextInput1" class="col-sm-3 control-label">
                                Deskripsi
                            </label>
                            <div class="col-sm-9">
                                <textarea name="deskripsi" class="form-control" style="resize:none" id="" cols="30" rows="10"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleTextInput1" class="col-sm-3 control-label">
                                Tanggal Mulai
                            </label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control" name="tanggal_mulai">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextInput1" class="col-sm-3 control-label">
                                Tanggal Selesai
                            </label>
                            <div class="col-sm-9">
                                <input type="datetime-local" class="form-control" name="tanggal_akhir">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextInput1" class="col-sm-3 control-label">
                                Latitude
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lat">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextInput1" class="col-sm-3 control-label">
                                Longitude
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="long">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>