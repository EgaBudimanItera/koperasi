<script type="text/javascript">
	$(document).on('click', '#tambah_mod_anggota', function(e){
        e.preventDefault();
        $('#tambah_anggota').modal();
        $('#action').val('tambah');
        
       
    });

    $('.angka').number( true, 0 );
    $('#tambah_anggota').on('hidden.bs.modal', function () {
        $('#tambah_anggota form')[0].reset();
    });
    $(document).on('submit', '#form_anggota', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_anggota'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/anggota/save',
                type : 'POST',
                data : data,
                processData: false, 
                contentType: false,
                success : function(msg){
                    $('#notif_sukses').html(msg);
                }
            });
        }else if(action =='ubah'){
            $.ajax({
                url : '<?=base_url()?>admin/anggota/update',
                type : 'POST',
                data : data,
                processData: false, 
                contentType: false,
                success : function(msg){
                    $('#notif_sukses').html(msg);
                }
            });
        }

    });

    $(document).on('click', '.ubah_anggota', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_anggota').modal();
        $('#id_anggota').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/anggota/get_anggota_param',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#agm_nama').val(msg.agm_nama);
                $('#agm_id').val(msg.agm_id);
                
            }
        });
    });

    $(document).on('click', '.hapus_anggota', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });


    $(document).on('click', '.btn_hapus_tahun', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/anggota/delete',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>