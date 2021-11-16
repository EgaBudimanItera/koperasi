<div class="section-header">
  <h1>Data Ref Simpanan</h1>
  
  <!-- <a data-target="#tambah_ref_setting_simpanan" href="#" data-toggle="modal" id="tambah_mod_ref_setting_simpanan" style="text-decoration:none;" class="btn btn-primary btn-xs ml-auto"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a> -->
  
</div>
<!-- <?=var_dump($list)?> -->
<div class="table-responsive">
<table class="table table-sm dataTableExport table-bordered table-striped" style="width:100%">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Nama Simpanan</th>
                  <th>Nominal</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach($list as $key => $val) { ?>
              <tr>
                  <td><?=$key+1?></td>
                  <td><?=$val->ssi_nama?></td>
                  <td class="text-right"><?=number_format($val->ssi_nominal)?></td>
                  <td>
                    <?php
                    if($val->ssi_edit_nominal==1){
                    ?>
                    <a id="<?=$val->ssi_id?>"  href="#" class="btn btn-sm btn-warning ubah_ref_setting_simpanan"> <i class="fas fa-pencil-alt"></i> Ubah </a>
                    <?php
                    }
                    ?>
                    
                    <!-- <a id="<?=$val->ssi_id?>" class="btn btn-sm btn-danger text-white hapus_ref_setting_simpanan"> <i class="fas fa-trash"></i> Hapus </a>  -->

                  </td>
              </tr>
          <?php }?>
          </tbody>
      </table>
</div>
<!-- Modal Tambah ref_setting_simpanan -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambah_ref_setting_simpanan" data-backdrop="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="form_ref_setting_simpanan" name="form_ref_setting_simpanan" method="POST" autocomplete="off">
      <div class="form-group">
        <label for="exampleInputPassword1">Nama Simpanan</label>
        <input type="text" class="form-control" id="ssi_nama" autocomplete="off" require name="ssi_nama">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Nominal Simpanan</label>
        <input type="text" class="form-control angka" id="ssi_nominal" autocomplete="off" require name="ssi_nominal">
      </div>
      </div>
      <div class="modal-footer">
      <div id="notif_sukses"></div>
      <input type="submit" class="btn btn-primary" value="Simpan">
      <input type="text" style="display: none" name="ssi_id" id="ssi_id"/>
      <input type="text" style="display: none" name="action" id="action"/>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
    <div class="modal fade" id="modalHapus" role="dialog" data-backdrop="false">
        <div class="modal-dialog ">
          <div class="modal-content">
          <div class="modal-header">
        <h5 class="modal-title">Hapus tahun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
                Anda yakin menghapus data ini ? <br>
            </div>
            <div class="modal-footer">
            <div id="notif"></div>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tidak</button> 
                <button type="button" class="btn btn-danger btn_hapus_tahun">Hapus</button>
                
                <input type="text" style="display: none" name="id_hapus" id="id_hapus">
            </div>
            
          </div>
        </div>
    </div>
<!--  End Delete Modal -->
	