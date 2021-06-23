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
                        Email
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleTextInput1" class="col-sm-3 control-label">
                        Password
                    </label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password">
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