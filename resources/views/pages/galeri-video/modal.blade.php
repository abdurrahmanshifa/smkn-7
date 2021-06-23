<div class="modal" id="modal_form" role="dialog" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <form class="form-horizontal" method="POST" action="" name="form_input">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="exampleTextInput1" class="col-sm-3 control-label">
                        Nama
                    </label>
                    <div class="col-sm-9">
                        <input type="hidden" name="id">
                        <input type="text" class="form-control" name="nama">
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
            <div class="modal-footer">
                <button type="submit" id="btn" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal_edit_status" role="dialog" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Status Galeri</h4>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('galeri-video.edit-status') }}" name="form_input">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="exampleTextInput1" class="col-sm-12 control-label text-left">
                        Status Galeri
                    </label>
                    <div class="col-sm-12">
                        <input type="hidden" name="id" id="id_galeri">
                        <select name="flag_active" class="form-control" required id="flag_active">
                            <option value="">-Pilih Status-</option>
                            <option value="1">Publish</option>
                            <option value="0">Draft</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn" class="btn btn-primary">Edit Status</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>