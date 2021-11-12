<script type="text/javascript">
	$(document).on('click', '#tambah_mod_ref_dok_identitas', function(e){
        e.preventDefault();
        $('#tambah_ref_dok_identitas').modal();
        $('#action').val('tambah');
        
       
    });
    $('#tambah_ref_dok_identitas').on('hidden.bs.modal', function () {
        $('#tambah_ref_dok_identitas form')[0].reset();
    });
    $(document).on('submit', '#form_ref_dok_identitas', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_ref_dok_identitas'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/ref_dok_identitas/save',
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
                url : '<?=base_url()?>admin/ref_dok_identitas/update',
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

    $(document).on('click', '.ubah_ref_dok_identitas', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_ref_dok_identitas').modal();
        $('#id_ref_dok_identitas').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/ref_dok_identitas/get_ref_dok_identitas_param',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#idn_nama').val(msg.idn_nama);
                $('#idn_id').val(msg.idn_id);
                
            }
        });
    });

    $(document).on('click', '.hapus_ref_dok_identitas', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });


    $(document).on('click', '.btn_hapus_tahun', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/ref_dok_identitas/delete',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>