<div class="modal" id="modal_edit_status" role="dialog" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Status Pegawai</h4>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('pegawai.edit-status') }}">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="exampleTextInput1" class="col-sm-12 control-label text-left">
                        Status 
                    </label>
                    <div class="col-sm-12">
                        <input type="hidden" name="id">
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