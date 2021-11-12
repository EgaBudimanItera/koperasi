<div class="section-header">
  <h1>Data Pekerjaan</h1>
  
  <a data-target="#tambah_pekerjaan" href="#" data-toggle="modal" id="tambah_mod_pekerjaan" style="text-decoration:none;" class="btn btn-primary btn-xs ml-auto"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
  
</div>
<div class="table-responsive">
<table class="table table-sm dataTableExport table-bordered table-striped" style="width:100%">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Nama Pekerjaan</th>
                  
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach($list as $key => $val) { ?>
              <tr>
                  <td><?=$key+1?></td>
                  <td><?=$val->krj_nama?></td>
                  
                  <td>
                    <a id="<?=$val->krj_id?>"  href="#" class="btn btn-sm btn-warning ubah_pekerjaan"> <i class="fas fa-pencil-alt"></i> Ubah </a>
                    <a id="<?=$val->krj_id?>" class="btn btn-sm btn-danger text-white hapus_pekerjaan"> <i class="fas fa-trash"></i> Hapus </a> 

                  </td>
              </tr>
          <?php }?>
          </tbody>
      </table>
</div>
<!-- Modal Tambah pekerjaan -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambah_pekerjaan" data-backdrop="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah/Edit Pekerjaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="form_pekerjaan" name="form_pekerjaan" method="POST">
      <div class="form-group">
        <label for="exampleInputPassword1">Nama pekerjaan</label>
        <input type="text" class="form-control" id="krj_nama" name="krj_nama">
      </div>
      
      </div>
      <div class="modal-footer">
      <div id="notif_sukses"></div>
      <input type="submit" class="btn btn-primary" value="Simpan">
      <input type="text" style="display: none" name="krj_id" id="krj_id"/>
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
	