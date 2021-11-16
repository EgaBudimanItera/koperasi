<script type="text/javascript">
	$('.select2modalsimpan').select2({
        width: '100%',         
    });
    $('.angka').number( true, 0 );
    $('#tambah_simpan').on('hidden.bs.modal', function () {
        $('#tambah_simpan form')[0].reset();
    });

    $('#tsi_ang_id').change(function(){
        var id=$(this).val();
        console.log(id);
        if(id !== ""){
            $.ajax({
                url : '<?=base_url()?>admin/anggota/get_anggota_param_comp',
                type: 'POST',
                data: 'id='+id,
                dataType: 'JSON',
                success : function(msg){
                    $('#rek_no_rekening').val(msg.rek_no_rekening);
                    $('#ang_tempat_lahir').val(msg.ang_tempat_lahir);
                    $('#ang_tanggal_lahir').val(msg.ang_tanggal_lahir);
                    $('#ang_jk').val(msg.ang_jk);
                    $('#ang_no_hp').val(msg.ang_no_hp);
                    $('#idn_nama').val(msg.idn_nama);
                    $('#ang_no_identitas').val(msg.ang_no_identitas);
                    $('#ang_tanggal_lahir').val(msg.ang_tanggal_lahir);
                }
            });
        }
        
    })
    $(document).on('click', '#tambah_mod_simpan', function(e){
        e.preventDefault();
        $('#tambah_simpan').modal();
        $('#action').val('tambah');
        var spw=<?php Print($simpanan_wajib->ssi_nominal)?>;
        $('#tsi_simpanan_wajib').val(spw);
        // $("#tsi_ang_id").select2('val', null);
        $('#tsi_ang_id').val('').trigger('change');
       
    });
    $('#tambah_simpan').on('hidden.bs.modal', function () {
        $('#tambah_simpan form')[0].reset();
    });
    $(document).on('submit', '#form_simpan', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_simpan'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/simpan/save',
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
                url : '<?=base_url()?>admin/simpan/update',
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

    $(document).on('click', '.ubah_simpan', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_simpan').modal();
        $('#id_simpan').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/ref_simpan/get_simpan_param',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#agm_nama').val(msg.agm_nama);
                $('#agm_id').val(msg.agm_id);
                
            }
        });
    });

    $(document).on('click', '.hapus_simpan', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });


    $(document).on('click', '.btn_hapus_tahun', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/simpan/delete',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>