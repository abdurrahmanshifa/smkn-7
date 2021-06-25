<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

    $("[name=form_input]").on('submit', function(e) {
        e.preventDefault();
        var save_method = $('[name="method"]').val();
        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn').text('sedang menyimpan...');
        $('#btn').attr('disabled', true);

        var form = $('[name="form_input"]')[0];
        var data = new FormData(form);
        if(save_method == 'simpan'){
            var url = '{{route("pengaturan.logo.simpan")}}';
        }else{
            var url = '{{route("pengaturan.logo.ubah")}}';
        }

        Swal.fire({
            text: "Apakah data ini ingin di"+save_method+' ?',
            title: "Perhatian",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: "#2196F3",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(obj) {
                        if(obj.status)
                        {
                            if (obj.success !== true) {
                                Swal.fire({
                                    text: obj.message,
                                    title: "Perhatian!",
                                    icon: "error",
                                    button: true,
                                    timer: 1000
                                });
                            }
                            else {
                                $('#modal_form').modal('hide');
                                Swal.fire({
                                    text: obj.message,
                                    title: "Perhatian!",
                                    icon: "success",
                                    button: true,
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            }
                            $('#btn').text('Simpan');
                            $('#btn').attr('disabled', false);
                        }else{
                            Swal.fire({
                                text: obj.error_string[0],
                                title: 'Perhatian!',
                                icon: 'error',
                                button: true,
                            });
                            for (var i = 0; i < obj.input_error.length; i++) 
                            {
                                $('[name="'+obj.input_error[i]+'"]').parent().parent().addClass('has-error');
                                $('[name="'+obj.input_error[i]+'"]').next().text(obj.error_string[i]);
                            }
                            $('#btn').text('Simpan');
                            $('#btn').attr('disabled', false);
                        }
                    }
                });
            } else {
                $('#btn').text('Simpan');
                $('#btn').attr('disabled', false);
            }

        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            $('#logo-utama').attr('style','height: 150px;');
            reader.onload = function(e) {
                $('#logo-utama').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#logo_utama").change(function() {
        readURL(this);
        $('.utama').append('<div class="caption text-right"><button type="button" onclick="hapus_utama()" class="btn btn-danger">Hapus</button></div>');
    });

    function readURLs(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            $('#logo-alt').attr('style','height: 150px;');
            reader.onload = function(e) {
                $('#logo-alt').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#logo_alt").change(function() {
        readURLs(this);
        $('.alt').append('<div class="caption text-right"><button type="button" onclick="hapus_alt()" class="btn btn-danger">Hapus</button></div>');
        
    });

    function hapus_utama(){
        $('[name="logo_utama_old"]').val('');
        $('.utama').html('<img style="width:100%;" id="logo-utama" src="{{asset("img/preview.png") }}" />');
        $('[name="logo"]').val('');
    }

    function hapus_alt(){
        $('[name="logo_alt_old"]').val('');
        $('.alt').html('<img style="width:100%;" id="logo-alt" src="{{asset("img/preview.png") }}" />');
        $('[name="logo_alt"]').val('');
    }
</script>