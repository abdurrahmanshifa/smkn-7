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
                        Judul
                    </label>
                    <div class="col-sm-9">
                        <input type="hidden" name="id">
                        <input type="text" class="form-control" name="nama">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleTextInput1" class="col-sm-3 control-label">
                        File
                    </label>
                    <div class="col-sm-9">
                        <input type="hidden" name="file_lama">
                        <input type="file" class="form-control" name="file" accept="image/*,application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        <span class="help-block"></span>
                        <span class="text-danger">*Maksimal file 2 Mb</span>
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
                        Deskripsi
                    </label>
                    <div class="col-sm-9">
                        <textarea name="keterangan" class="form-control" style="resize:none" id="" cols="30" rows="10"></textarea>
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
                <h4 class="modal-title">Edit Status</h4>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('file.edit-status') }}">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="exampleTextInput1" class="col-sm-12 control-label text-left">
                        Status 
                    </label>
                    <div class="col-sm-12">
                        <input type="hidden" name="id_flag">
                        <select name="flag_active" class="form-control" required id="flag_active">
                            <option value="">-Pilih Status-</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
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