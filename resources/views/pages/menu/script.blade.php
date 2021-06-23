<link rel="stylesheet" href="{{ asset('libs/bower/noty') }}/noty.css"> 
<link rel="stylesheet" href="{{ asset('css/nestable.css') }}"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="{{ asset('libs/bower/noty') }}/noty.js"></script>
<style>
    /* .child{
        margin-left:30px !important;
    } */
</style>
<script src="{{ asset('js/jquery.nestable.js') }}"></script>

<script>
    $(document).ready(function(){
        // var updateOutput = function(e){
        //     var list   = e.length ? e : $(e.target),
        //         output = list.data('output');
        //     if (window.JSON) {
        //         output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        //     } else {
        //         output.val('JSON browser support required for this demo.');
        //     }
        // };
        // // activate Nestable for list 1
        // $('#nestable').nestable({
        //     group: 1
        // })
        // .on('change', updateOutput);
        // // output initial serialised data
        // updateOutput($('#nestable').data('output', $('#nestable-output')));
    
        $('#nestable-menu').on('click', function(e){
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });
    });
  $(document).ready(function(){
    $("#load").hide();
        $("#submit").on('click',function(){
            $("#load").show();
            var dataString = { 
                    label : $("#label").val(),
                    link : $("#link").val(),
                    type_page : $("#type_page").val(),
                    parent_menu : $("#parent_menu").val(),
                    urutan : $("#urutan").val(),
                    id : $("#id").val(),
            };
            $.ajax({
                type: "POST",
                url: "{{ route('pengaturan.menu.simpan') }}",
                data: dataString,
                dataType: "json",
                cache : false,
                success: function(data){
                    if(data.type == 'add'){
                        // izitoast_berhasil();
                        $("#menu-id").append(data.menu);
                    }else if(data.type == 'edit'){
                        new Noty({
                            type: "info",
                            text: "Menu Berhasil Di Simpan"
                        }).show();
                        
                        $('#label_show'+data.id).html(data.label);
                        $('#link_show'+data.id).html(data.link);
                        $('[name="show"]').attr('checked', 'checked');
                    }
                        $('#label').val('');
                        $('#link').val('');
                        $('#pilih').val('');
                        $('#id').val('');
                        $("#load").hide();
                    },error: function(xhr, status, error) {
                        alert(error);
                    },
            });
        });

        $('.dd').on('change', function() {
            $("#load").show();
                var dataString = { 
                  data : $("#nestable-output").val(),
                };
                $.ajax({
                    type: "POST",
                    url: "{{ route('pengaturan.menu.simpan') }}",
                    data: dataString,
                    cache : false,
                    success: function(data){
                        new Noty({
                            type: "info",
                            text: "Menu Berhasil Di Simpan"
                        }).show();
                        $("#load").hide();
                    } ,error: function(xhr, status, error) {
                        alert(error);
                    },
                });
        });

        $("#save").on('click',function(){
            $("#load").show();
            var dataString = { 
              data : $("#nestable-output").val(),
            };
            $.ajax({
                type: "POST",
                url: "{{ route('pengaturan.menu.simpan') }}",
                data: dataString,
                cache : false,
                success: function(data){
                $("#load").hide();
                    swal({
                        title: 'Data berhasil di rubah !',
                        text : 'Klik tombol ok untuk kembali !',
                        type : 'info',
                        confirmButtonText : 'Ok',
                        }, function(){
                                window.location.href= '{{ route("pengaturan.menu") }}';
                        }, 1000);
                },error: function(xhr, status, error) {
                    alert(error);
                },
            });
        });

        $(document).on("click",".del-button",function() {
            
            var id = $(this).attr('id');
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
                                type: "POST",
                                url: "{{ route('pengaturan.menu.hapus') }}",
                                data: { id : id },
                                cache : false,
                                success: function(data){
                                $("#load").hide();
                                $("li[data-id='" + id +"']").remove();
                                } ,error: function(xhr, status, error) {
                                alert(error);
                                },
                            });
                    }
                });
            
        });

        $(document).on("click",".edit-button",function() {

            var id              = $(this).attr('id');
            var label           = $(this).attr('label');
            var link            = $(this).attr('link');
            var urutan          = $(this).attr('urutan');
            var type_page       = $(this).attr('type_page');
            var parent_menu     = $(this).attr('parent_menu');
            var parent_menu_id  = $(this).attr('parent_menu_id');
           
            $("#id").val(id);
            $("#label").val(label);
            $("#link").val(link);
            $("#urutan").val(urutan);
            $("#type_page").val(type_page);
            $("#parent_menu").append(new Option(parent_menu, parent_menu_id,true,true));

        });
        $(document).on("click",".add-button",function() {

            var id              = $(this).attr('id');
            var label           = $(this).attr('label');
            var link            = $(this).attr('link');
            var urutan          = $(this).attr('urutan');
            var type_page       = $(this).attr('type_page');
            var parent_menu     = $(this).attr('parent_menu');
            var parent_menu_id  = $(this).attr('parent_menu_id');
           
            $("#id").val(id);   
            $("#label").val(label);
            $("#link").val(link);
            $("#urutan").val(urutan);
            $("#type_page").val(type_page);
            
            $("#parent_menu").append(new Option(parent_menu, parent_menu_id,true,true));

        });

        $(document).on("click","#reset",function() {
            $('#parent_menu').val('');
            $('#label').val('');
            $('#type_page').val('');
            $('#link').val('');
            $('#urutan').val('');
        });
  });
</script>