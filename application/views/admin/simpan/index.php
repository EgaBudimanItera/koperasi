<div class="section-header">
  <h1>Data Simpanan Anggota</h1>
  
  <a data-target="#tambah_simpan" href="#" data-toggle="modal" id="tambah_mod_simpan" style="text-decoration:none;" class="btn btn-primary btn-xs ml-auto"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
  
</div>
<div class="table-responsive">
  <table class="table table-sm dataTableExport table-bordered table-striped" style="width:100%">
      <thead>
          <tr>
              <th>No</th>
              <th>Nama Anggota</th>
              <th>Nomor Transaksi</th>
              <th>Tanggal</th>
              <th>Jenis Simpanan</th>
              <th>Nominal (Rp)</th>
              
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
      <?php foreach($list as $key => $val) { ?>
          <tr>
              <td><?=$key+1?></td>
              <td><?=$val->ang_nama?></td>
              <td class='text-center'><?=$val->tsi_no_simpan?></td>
              <td><?=date('d-m-Y',strtotime(date($val->tsi_tanggal_simpan)))?></td>
              <td><?=$val->ssi_nama?></td>
              <td class='text-right'><?=number_format($val->tsi_nominal)?></td>
              
              <td>
                <!-- <a id="<?=$val->tsi_id?>"  href="#" class="btn btn-sm btn-warning ubah_simpan"> <i class="fas fa-pencil-alt"></i> Ubah </a> -->
                <a id="<?=$val->tsi_id?>" class="btn btn-sm btn-danger text-white hapus_simpan"> <i class="fas fa-trash"></i> Hapus </a> 

              </td>
          </tr>
      <?php }?>
      </tbody>
  </table>
</div>
<!-- Modal Tambah simpan -->
<div class="modal fade bd-example-modal-lg" role="dialog" id="tambah_simpan" data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Simpanan Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_simpan" autocomplete="off" name="form_simpan" method="POST" onSubmit="return confirm('yakin Untuk menyimpan?');">
            
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  
                  <div class="card-body">
                    <div class="form-group">
                      <label>Nomor simpan</label>
                      <input type="text"  id="tsi_no_simpan" value="<?=$nomor_simpan?>" readonly name="tsi_no_simpan" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Tanggal Simpan</label>
                      <input type="text" autocomplete="off" readonly id="tsi_tanggal_simpan" value="<?=date('d-m-Y')?>" name="tsi_tanggal_simpan" class="form-control datepicker">
                    </div>
                    
                    <div class="form-group">
                      <label>Nama Anggota</label>
                      <select name="tsi_ang_id" id="tsi_ang_id" autocomplete="off" readonly class="form-control select2modal">
                          <option value="">--Pilih--</option>
                          <?php
                            foreach($anggota as $l=>$val){
                          ?>
                          <option value="<?=$val->ang_id?>"><?=$val->ang_nama?></option>
                          <?php
                            }
                          ?>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label>Tempat Lahir</label>
                      <input type="text" require id="ang_tempat_lahir" autocomplete="off" name="ang_tempat_lahir" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="text" require id="ang_tanggal_lahir" autocomplete="off" readonly name="ang_tanggal_lahir" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <input type="text" require id="ang_jk" name="ang_jk" autocomplete="off" readonly class="form-control">
                    </div>
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  
                  <div class="card-body">
                  <div class="form-group">
                      <label>No Hp</label>
                      <input type="text" name="ang_no_hp" id="ang_no_hp" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Jenis Dokumen Identitas</label>
                      <input type="text" name="idn_nama" id="idn_nama" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Nomor Identitas</label>
                      <input type="text" id="ang_no_identitas" autocomplete="off" require name="ang_no_identitas" class="form-control">
                    </div>
                    <!-- <div class="form-group">
                        <label>Simpanan Pokok</label>
                        <input type="text" require name="tsi_simpanan_pokok" autocomplete="off" id="tsi_simpanan_pokok" value='0'class="form-control angka">
                    </div> -->
                    <div class="form-group">
                        <label>Simpanan Wajib</label>
                        <input type="text" require name="tsi_simpanan_wajib" autocomplete="off" id="tsi_simpanan_wajib" value='0'class="form-control angka">
                    </div>
                    <div class="form-group">
                        <label>Simpanan Sukarela</label>
                        <input type="text" require name="tsi_simpanan_sukarela" autocomplete="off" id="tsi_simpanan_sukarela" value='0'class="form-control angka">
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            
            <input type="submit" class="btn btn-primary" value="Simpan">
            <input type="text" style="display: none" name="tsi_id" id="tsi_id"/>
            <input type="text" style="display: none" name="action" id="action"/>
        </form>
      </div>
      <div class="modal-footer">
        <div id="notif_sukses"></div>
      
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
	