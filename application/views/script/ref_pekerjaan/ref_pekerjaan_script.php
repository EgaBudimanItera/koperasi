<script type="text/javascript">
	$(document).on('click', '#tambah_mod_pekerjaan', function(e){
        e.preventDefault();
        $('#tambah_pekerjaan').modal();
        $('#action').val('tambah');
        
       
    });
    $('#tambah_pekerjaan').on('hidden.bs.modal', function () {
        $('#tambah_pekerjaan form')[0].reset();
    });
    $(document).on('submit', '#form_pekerjaan', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_pekerjaan'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/ref_pekerjaan/save',
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
                url : '<?=base_url()?>admin/ref_pekerjaan/update',
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

    $(document).on('click', '.ubah_pekerjaan', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_pekerjaan').modal();
        $('#id_pekerjaan').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/ref_pekerjaan/get_pekerjaan_param',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#krj_nama').val(msg.krj_nama);
                $('#krj_id').val(msg.krj_id);
                
            }
        });
    });

    
    $(document).on('click', '.hapus_pekerjaan', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });


    $(document).on('click', '.btn_hapus_tahun', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/ref_pekerjaan/delete',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>