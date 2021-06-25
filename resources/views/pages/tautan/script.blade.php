<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    var table = $('#table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            info :false,
            ajax: {
               url: "{{ route('manajemen.tautan') }}",
            },
            columns: [
                {"data":"DT_RowIndex"},
                {"data":"judul"},
                {"data":"url"},
                {"data":"bg_color"},
                {"data":"aksi"},
            ],
            columnDefs: [
            {
                targets: [-1],
                className: 'text-center'
            },
          ]
    });


    $("[name=form_input]").on('submit', function(e) {
        e.preventDefault();

        $('.help-block').empty();
        $("div").removeClass("has-error");
        $('#btn').text('sedang menyimpan...');
        $('#btn').attr('disabled', true);

        var form = $('[name="form_input"]')[0];
        var data = new FormData(form);
        var url = '{{route("manajemen.tautan.ubah")}}';
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
            url : "{{url('manajemen/tautan/data/')}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#modal_form').modal('show');
                $('#modal_form  .modal-title').text('Ubah Data');
                $('[name="id"]').val(id);
                $('[name="judul"]').val(data.judul);
                $('[name="bg_color"]').val(data.bg_color);
                $('.foto-icon').html('<img src="{{ url("storage/tautan/icon") }}/'+data.icon+'"><br><br>');
                $('.foto-bg').html('<img src="{{ url("storage/tautan/bg") }}/'+data.bg_img+'"><br><br>');
                $('[name="url"]').val(data.url);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

</script>