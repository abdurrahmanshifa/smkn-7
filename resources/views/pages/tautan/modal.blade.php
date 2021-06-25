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
                    <div class="form-group">
                        <label for="exampleTextInput1" class="col-sm-3 control-label">
                            Judul
                        </label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id">
                            <input type="text" class="form-control" name="judul">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextInput1" class="col-sm-3 control-label">
                            Icon
                        </label>
                        <div class="col-sm-9">
                            <div class="col-sm-6 foto-icon" style="background:#000;padding:10px;"></div>
                            <input type="file" class="form-control" name="icon" accept="image/png">
                            <span class="help-block"></span>
                            <span style="color:red">*Maksimal 500 kb, hanya PNG</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextInput1" class="col-sm-3 control-label">
                            Foto Background
                        </label>
                        <div class="col-sm-9">
                            <div class="foto-bg"></div>
                            <input type="file" class="form-control" name="bg_img" accept="image/png,image/jpg,image/jpeg">
                            <span class="help-block"></span>
                            <span style="color:red">*Maksimal 5 Mb</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextInput1" class="col-sm-3 control-label">
                            URL
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="url">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextInput1" class="col-sm-3 control-label">
                            Kode Warna Background
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="bg_color">
                            <span class="help-block"></span>
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