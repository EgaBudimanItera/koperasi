<script type="text/javascript">
	$(document).on('click', '#tambah_mod_agama', function(e){
        e.preventDefault();
        $('#tambah_agama').modal();
        $('#action').val('tambah');
        
       
    });
    $('#tambah_agama').on('hidden.bs.modal', function () {
        $('#tambah_agama form')[0].reset();
    });
    $(document).on('submit', '#form_agama', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_agama'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/ref_agama/save',
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
                url : '<?=base_url()?>admin/ref_agama/update',
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

    $(document).on('click', '.ubah_agama', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_agama').modal();
        $('#id_agama').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/ref_agama/get_agama_param',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#agm_nama').val(msg.agm_nama);
                $('#agm_id').val(msg.agm_id);
                
            }
        });
    });

    $(document).on('click', '.hapus_agama', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });


    $(document).on('click', '.btn_hapus_tahun', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/ref_agama/delete',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>