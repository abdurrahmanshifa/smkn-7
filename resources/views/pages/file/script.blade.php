<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    var table = $('#table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            info :false,
            ajax: {
               url: "{{ route('file') }}",
            },
            columns: [
                {"data":"DT_RowIndex"},
                {"data":"name"},
                {"data":"file"},
                {"data":"status"},
                {"data":"jml_download"},
                {"data":"aksi"},
            ],
            columnDefs: [
            {
                targets: [-1],
                className: 'text-center'
            },
          ]
    });
    $(".tambah_form").click(function(){
        save_method = 'add';
        $('[name="form_input"]')[0].reset();
        $('#modal_form').modal('show');
        $('#modal_form .modal-title').text('Tambah Data');
        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn').text('Simpan');
        $('#btn').attr('disabled', false);
    });

    $("[name=form_input]").on('submit', function(e) {
        e.preventDefault();

        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn').text('sedang menyimpan...');
        $('#btn').attr('disabled', true);

        var form = $('[name="form_input"]')[0];
        var data = new FormData(form);
        if(save_method == 'add'){
            var url = '{{route("file.simpan")}}';
        }else{
            var url = '{{route("file.ubah")}}';
        }

        Swal.fire({
            text: "Apakah data ini ingin disimpan?",
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
                                        table.ajax.reload(null,true);
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

    function ubah(id)
    {
        save_method = 'edit';
        $('[name="form_input"]')[0].reset();
        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn').text('Simpan');
        $('#btn').attr('disabled', false);

        $.ajax({
            url : "{{url('manajemen/file/data/')}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#modal_form').modal('show');
                $('#modal_form  .modal-title').text('Ubah Data');
                $('[name="id"]').val(id);
                $('[name="nama"]').val(data.name);
                $('[name="keterangan"]').val(data.keterangan);
                $('[name="status"]').val(data.status);
                $('[name="file_lama"]').val(data.file);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function edit_flag(id)
    {
        // id_artikel
        // flag_active
        $.ajax({
            url : "{{url('manajemen/file/data/')}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#modal_edit_status').modal('show');

                $('[name="id_flag"]').val(id);
                $('[name="flag_active"]').val(data.status).change();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
        // $('#modal_edit_status').modal('show');
    }


    function hapus(id){
        Swal.fire({
               text: "Apakah data ini ingin dihapus?",
               title: "Perhatian",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: "#2196F3",
               confirmButtonText: "Iya",
               cancelButtonText: "Tidak",
               closeOnConfirm: false,
               closeOnCancel: true
          }).then((result) => {
               if (result.value) {
                    $.ajax({
                        url : "{{url('manajemen/file/hapus/')}}"+"/"+id,
                        type: "POST",
                        data : {
                            '_method'   : 'delete',
                            '_token'    : '{{ csrf_token() }}',
                        },
                        dataType: "JSON",
                        success: function (obj) {
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
                                Swal.fire({
                                    text: obj.message,
                                    title: "Perhatian!",
                                    icon: "success",
                                    button: true,
                                }).then((result) => {
                                    if (result.value) {
                                        table.ajax.reload(null,true); 
                                    }
                                });
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            alert('Error get data from ajax');
                        }
                    });
               }
         });
    }
</script>