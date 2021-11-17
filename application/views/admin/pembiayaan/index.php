<div class="section-header">
  <h1>Data Pembiayaan</h1>
  
  <a data-target="#tambah_pembiayaan" href="#" data-toggle="modal" id="tambah_mod_pembiayaan" style="text-decoration:none;" class="btn btn-primary btn-xs ml-auto"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
  
</div>
<div class="table-responsive">
<table class="table table-sm dataTableExport table-bordered table-striped" style="width:100%">
          <thead>
              <tr>
                  <th>No</th>
                  <th>No Transaksi</th>
                  <th>Tanggal Pinjam</th>
                  <th>Nama Anggota</th>
                  <th>Nama Pembiayaan</th>
                  <th>Tempo Pinjam (Bln)</th>
                  <th>Jumlah Pinjam (Rp)</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach($list as $key => $val) { ?>
              <tr>
                  <td><?=$key+1?></td>
                  <td><?=$val->tbi_no_pembiayaan?></td>
                  <td><?=date('d-m-Y',strtotime($val->tbi_tanggal_pembiayaan))?></td>
                  <td><?=$val->ang_nama?></td>
                  <td><?=$val->sbi_nama?></td>
                  <td><?=$val->tbi_waktu_pinjam?></td>
                  <td><?=$val->tbi_jumlah_pinjam?></td>
                
                  <td>
                    <a id="<?=$val->krj_id?>"  href="#" class="btn btn-sm btn-warning ubah_pembiayaan"> <i class="fas fa-pencil-alt"></i> Ubah </a>
                    <a id="<?=$val->krj_id?>" class="btn btn-sm btn-danger text-white hapus_pembiayaan"> <i class="fas fa-trash"></i> Hapus </a> 

                  </td>
              </tr>
          <?php }?>
          </tbody>
      </table>
</div>
<!-- Modal Tambah pembiayaan -->
<div class="modal fade bd-example-modal-lg"  role="dialog" id="tambah_pembiayaan" data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Pembiayaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="form_pembiayaan" name="form_pembiayaan" method="POST" autocomplete="off">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Identitas Anggota</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nomor Pembiayaan</label>
                        <input type="text" class="form-control" require id="tbi_no_pembiayaan" readonly value="<?=$nomor_pembiayaan?>" autocomplete="off" name="tbi_no_pembiayaan">
                    </div>
                    <div class="form-group">
                      <label>Tanggal Pinjaman</label>
                      <input type="text" autocomplete="off" readonly id="tbi_tanggal_pembiayaan" value="<?=date('d-m-Y')?>" name="tbi_tanggal_pembiayaan" class="form-control datepicker">
                    </div>
                    <div class="form-group">
                      <label>Nama Anggota</label>
                      <select name="tbi_ang_id" id="tbi_ang_id" autocomplete="off" readonly class="form-control select2modal">
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
                <div class="card-header">
                    <h4>Jenis Pinjaman</h4>
                </div>
                <div class="card-body">
                    
                    <div class="form-group">
                      <label>Jenis Pinjaman</label>
                      <select name="tbi_sbi_id" id="tbi_sbi_id" autocomplete="off" readonly class="form-control select2modal">
                          <option value="">--Pilih--</option>
                          <?php
                            foreach($setting_pembiayaan as $l=>$val){
                          ?>
                          <option value="<?=$val->sbi_id?>"><?=$val->sbi_nama?></option>
                          <?php
                            }
                          ?>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label>Max Plafon</label>
                      <input type="text" require id="sbi_max_plafon" autocomplete="off" name="sbi_max_plafon" class="form-control angka">
                    </div>
                    <div class="form-group">
                      <label>Max Waktu Pinjam (Bulan)</label>
                      <input type="text" require id="sbi_max_waktu_pinjam" autocomplete="off" readonly name="sbi_max_waktu_pinjam" class="form-control">
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Data Pinjaman</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                      <label>Jumlah Pinjaman</label>
                      <input type="text" require id="tbi_jumlah_pinjam" autocomplete="off" name="tbi_jumlah_pinjam" class="form-control angka">
                    </div>
                    <div class="form-group">
                      <label>Jangka Waktu Pinjaman (Bulan)</label>
                      <input type="text" require id="tbi_waktu_pinjam" autocomplete="off" name="tbi_waktu_pinjam" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Tanggal Jatuh Tempo Pertama</label>
                      <input type="text" autocomplete="off" readonly id="tbi_last_jatuh_tempo" value="<?=date('10-m-Y', strtotime(date('m', strtotime('+1 month')).'/10/'.date('Y')));?>" name="tbi_last_jatuh_tempo" class="form-control datepicker">
                    </div>
                </div>
            </div>
        </div>
      </div>
      
      
      </div>
      <div class="modal-footer">
      <div id="notif_sukses"></div>
      <input type="submit" class="btn btn-primary" value="Simpan">
      <input type="text" style="display: none" name="tbi_id" id="tbi_id"/>
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
	