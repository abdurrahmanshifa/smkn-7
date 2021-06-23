<link rel="stylesheet" href="{{ asset('libs/bower/summernote/dist/summernote.css') }}"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('libs/bower/summernote/dist/summernote.js') }}"></script>
<script>
    $('#isi-artikel').summernote({
        height:300,
    });
    var table = $('#table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            info :false,
            ajax: {
               url: "{{ route('artikel.datatable') }}",
            },
            columns: [
                {"data":"DT_RowIndex"},
                {"data":"cover"},
                {"data":"kategori"},
                {"data":"judul"},
                {"data":"tgl_posting"},
                {"data":"get_status"},
                {"data":"get_view"},
                {"data":"aksi"},
            ],
            columnDefs: [
            {
                targets: [-1],
                className: 'text-center'
            },
          ]
    });
    

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
                        url : "{{url('manajemen/artikel')}}"+"/"+id,
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
            
            reader.onload = function(e) {
                var src = '<img src="'+e.target.result+'" class="img-thumbnail">';
                $('#img-preview').html(src);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#cover-img").on('change',function() {
        readURL(this);
    });

    function edit_flag(id)
    {
        // id_artikel
        // flag_active
        $.ajax({
            url : "{{url('manajemen/artikel/')}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#modal_edit_status').modal('show');

                $('#id_artikel').val(id);
                $('[name="flag_active"]').val(data.flag_active);
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
        // $('#modal_edit_status').modal('show');
    }
</script>
<style>
    .modal-body > .form-group{
        margin-left:0px !important;
        margin-right:0px !important;
    }
</style>