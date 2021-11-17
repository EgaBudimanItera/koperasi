<script type="text/javascript">
	$('.select2modalsimpan').select2({
        width: '100%',         
    });
    $('.angka').number( true, 0 );
    $('#tambah_pembiayaan').on('hidden.bs.modal', function () {
        $('#tambah_pembiayaan form')[0].reset();
    });

    $('#tbi_ang_id').change(function(){
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
        
    });
        $('#tbi_sbi_id').change(function(){
        var id=$(this).val();
        console.log(id);
        if(id !== ""){
            $.ajax({
                url : '<?=base_url()?>admin/ref_setting_pembiayaan/get_ref_setting_pembiayaan_param_comp',
                type: 'POST',
                data: 'id='+id,
                dataType: 'JSON',
                success : function(msg){
                    $('#sbi_max_plafon').val(msg.sbi_max_plafon);
                    $('#sbi_max_waktu_pinjam').val(msg.sbi_max_waktu_pinjam);
                    console.log(msg);
                }
            });
        }
        
    });
</script>