<script type="text/javascript">
	$(document).on('click', '#tambah_mod_setting_pembiayaan', function(e){
        e.preventDefault();
        $('#tambah_setting_pembiayaan').modal();
        $('#action').val('tambah');
        
    });
    $('.angka').number( true, 0 );
    $('#tambah_setting_pembiayaan').on('hidden.bs.modal', function () {
        $('#tambah_setting_pembiayaan form')[0].reset();
    });
    $(document).on('submit', '#form_setting_pembiayaan', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_setting_pembiayaan'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/ref_setting_pembiayaan/save',
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
                url : '<?=base_url()?>admin/ref_setting_pembiayaan/update',
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

    $(document).on('click', '.ubah_setting_pembiayaan', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_setting_pembiayaan').modal();
        $('#id_setting_pembiayaan').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/ref_setting_pembiayaan/get_setting_pembiayaan_param',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#sbi_kode').val(msg.sbi_kode);
                $('#sbi_id').val(msg.sbi_id);
                $('#sbi_max_plafon').val(msg.sbi_max_plafon);
                $('#sbi_max_waktu_pinjam').val(msg.sbi_max_waktu_pinjam);
                $('#sbi_bunga').val(msg.sbi_bunga);
                $('#sbi_nama').val(msg.sbi_nama);
            }
        });
    });

    
    $(document).on('click', '.hapus_setting_pembiayaan', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });


    $(document).on('click', '.btn_hapus_tahun', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/ref_setting_pembiayaan/delete',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>