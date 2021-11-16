<div class="section-header">
  <h1>Data Pembiayaan</h1>
  
  <a data-target="#tambah_setting_pembiayaan" href="#" data-toggle="modal" id="tambah_mod_setting_pembiayaan" style="text-decoration:none;" class="btn btn-primary btn-xs ml-auto"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
  
</div>
<div class="table-responsive">
<table class="table table-sm dataTableExport table-bordered table-striped" style="width:100%">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Kode Pembiayaan</th>
                  <th>Nama Pembiayaan</th>
                  <th>Max Plafon (Rp)</th>
                  <th>Max Waktu Pinjam (Bulan)</th>
                  <th>Bunga (%)</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach($list as $key => $val) { ?>
              <tr>
                  <td><?=$key+1?></td>
                  <td><?=$val->sbi_kode?></td>
                  <td><?=$val->sbi_nama?></td>
                  <td><?=number_format($val->sbi_max_plafon)?></td>
                  <td><?=number_format($val->sbi_max_waktu_pinjam)?></td>
                  <td><?=number_format($val->sbi_bunga,2)?></td>
                  <td>
                    <a id="<?=$val->sbi_id?>"  href="#" class="btn btn-sm btn-warning ubah_setting_pembiayaan"> <i class="fas fa-pencil-alt"></i> Ubah </a>
                    <a id="<?=$val->sbi_id?>" class="btn btn-sm btn-danger text-white hapus_setting_pembiayaan"> <i class="fas fa-trash"></i> Hapus </a> 

                  </td>
              </tr>
          <?php }?>
          </tbody>
      </table>
</div>
<!-- Modal Tambah setting_pembiayaan -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambah_setting_pembiayaan" data-backdrop="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah/Edit Pembiayaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_setting_pembiayaan" autocomplete="off" name="form_setting_pembiayaan" method="POST">
            <div class="form-group">
                <label for="exampleInputPassword1">Kode Pembiayaan</label>
                <input type="text" class="form-control" require id="sbi_kode" name="sbi_kode">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nama Pembiayaan</label>
                <input type="text" class="form-control" autocomplete="off" require id="sbi_nama" name="sbi_nama">
            </div>


            <div class="form-group">
                <label for="exampleInputPassword1">Max Plafon (Rupiah)</label>
                <input type="text" class="form-control angka" autocomplete="off" id="sbi_max_plafon" require name="sbi_max_plafon">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Max Waktu Pinjam (Bulan) </label>
                <input type="text" class="form-control angka" id="sbi_max_waktu_pinjam" require name="sbi_max_waktu_pinjam">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Bunga (%) </label>
                <input type="text" class="form-control" id="sbi_bunga" require name="sbi_bunga">
            </div>
      </div>
      <div class="modal-footer">
        <div id="notif_sukses"></div>
        <input type="submit" class="btn btn-primary" value="Simpan">
        <input type="text" style="display: none" name="sbi_id" id="sbi_id"/>
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
	