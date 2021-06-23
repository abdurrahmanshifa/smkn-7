<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    var table = $('#table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            info :false,
            ajax: {
               url: "{{ route('pengaturan.banner') }}",
            },
            columns: [
                {"data":"DT_RowIndex"},
                {"data":"judul"},
                {"data":"link"},
                {"data":"status"},
                {"data":"images"},
                {"data":"aksi"},
            ],
            columnDefs: [
            {
                targets: [-3,-2,-1],
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
            var url = '{{route("pengaturan.banner.simpan")}}';
        }else{
            var url = '{{route("pengaturan.banner.ubah")}}';
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
            url : "{{url('pengaturan/banner/data/')}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#modal_form').modal('show');
                $('#modal_form  .modal-title').text('Ubah Data');
                $('[name="id"]').val(id);
                $('[name="judul"]').val(data.judul);
                $('[name="status"]').val(data.status).change();
                $('[name="link"]').val(data.link);
                $('[name="deskripsi"]').val(data.deskripsi);
                $('[name="images_old"]').val(data.images);
                $('.utama').html('<img style="height:150px;" id="logo-alt" src="{{url("app/banner/")}}/'+data.images+'" /><div class="caption text-right"><button type="button" onclick="hapus_utama()" class="btn btn-danger">Hapus</button></div>');
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
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
                        url : "{{url('pengaturan/banner/hapus/')}}"+"/"+id,
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

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            $('#images-utama').attr('style','height: 150px;');
            reader.onload = function(e) {
                $('#images-utama').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#images").change(function() {
        readURL(this);
        $('.utama').append('<div class="caption text-right"><button type="button" onclick="hapus_utama()" class="btn btn-danger">Hapus</button></div>');
    });

    function hapus_utama(){
        $('[name="images_old"]').val('');
        $('.utama').html('<img style="width:100%;" id="logo-utama" src="{{asset("img/preview.png") }}" />');
        $('[name="images"]').val('');
    }
</script>