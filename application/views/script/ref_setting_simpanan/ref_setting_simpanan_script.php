<script type="text/javascript">
	$(document).on('click', '#tambah_mod_ref_setting_simpanan', function(e){
        e.preventDefault();
        $('#tambah_ref_setting_simpanan').modal();
        $('#action').val('tambah');
        
       
    });
    $('.angka').number( true, 0 );
    $('#tambah_ref_setting_simpanan').on('hidden.bs.modal', function () {
        $('#tambah_ref_setting_simpanan form')[0].reset();
    });
    $(document).on('submit', '#form_ref_setting_simpanan', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_ref_setting_simpanan'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/ref_setting_simpanan/save',
                type : 'POST',
                data : data,
                processData: false, 
                contentType: false,
                success : function(msg){
                    $('#notif_sukses').html(msg);
                }
            });
        }else if(action == 'edit'){
            $.ajax({
                url : '<?=base_url()?>admin/ref_setting_simpanan/update',
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

    $(document).on('click', '.ubah_ref_setting_simpanan', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_ref_setting_simpanan').modal();
        $('#id_ref_setting_simpanan').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/ref_setting_simpanan/get_ref_setting_simpanan_param',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#ssi_nama').val(msg.ssi_nama);
                $('#ssi_id').val(msg.ssi_id);
                $('#ssi_nominal').val(msg.ssi_nominal);
                
            }
        });
    });

    $(document).on('click', '.hapus_ref_setting_simpanan', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });


    $(document).on('click', '.btn_hapus_tahun', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/ref_ref_setting_simpanan/delete',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>