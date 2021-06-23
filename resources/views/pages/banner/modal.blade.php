<div class="modal" id="modal_form" role="dialog" data-backdrop="static">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <form class="form-horizontal" method="POST" action="" name="form_input">
            <div class="modal-body">
                @csrf
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
                        Link
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="link">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleTextInput1" class="col-sm-3 control-label">
                        Status
                    </label>
                    <div class="col-sm-9">
                        <select name="status" class="form-control select2" id="">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleTextInput1" class="col-sm-3 control-label">
                        Foto
                    </label>
                    <div class="col-sm-9">
                        <div class="thumbnail white utama">
                            <img style="width:100%;" id="images-utama" src="{{asset('img/preview.png') }}" />
                        </div>
                        <input type="hidden" name="images_old">
                        <input type="file" class="form-control" id="images" name="images" accept="image/png,image/jpg,image/jpeg">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleTextInput1" class="col-sm-3 control-label">
                        Deksripsi
                    </label>
                    <div class="col-sm-9">
                        <textarea name="deskripsi" class="form-control" style="resize:none" id="" cols="40"></textarea>
                        <span class="help-block"></span>
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