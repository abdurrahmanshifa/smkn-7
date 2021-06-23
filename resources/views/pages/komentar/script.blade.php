<link rel="stylesheet" href="{{ asset('libs/bower/summernote/dist/summernote.css') }}"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('libs/bower/summernote/dist/summernote.js') }}"></script>
<script>
    $('#isi-balasan').summernote({
        height:300,
    });
    var table = $('#table').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            info :false,
            ajax: {
               url: "{{ route('komentar.datatable') }}",
            },
            columns: [
                {"data":"DT_RowIndex"},
                {"data":"artikel"},
                {"data":"judul"},
                {"data":"desc"},
                {"data":"tgl_posting"},
                {"data":"get_user"},
                {"data":"get_balasan"},
                {"data":"get_status"},
                {"data":"aksi"},
            ],
            columnDefs: [
            {
                targets: [-1],
                className: 'text-center'
            },
          ]
    });

    $('#table tbody').on('click', '.detail-row', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );
            var id = $(this).attr("data-id");
            // alert(id)
            format(id);
        });

    function format ( id ) {
        $.ajax({
            url : '{{ url("/") }}/manajemen/komentar/'+id,
            success : function(res)
            {
                $('#komentar').html(res.isi_komentar);
                $('#judul-balasan').html(res.balasan[0].judul_balasan);
                $('#komentar-balasan').html(res.balasan[0].isi_balasan);
                $('#modal_form').modal('show');
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
                        url : "{{url('manajemen/komentar')}}"+"/"+id,
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
            url : "{{url('manajemen/komentar/')}}"+"/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#modal_edit_status').modal('show');

                $('#id_komentar').val(id);
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