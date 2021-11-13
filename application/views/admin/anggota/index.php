<div class="section-header">
  <h1>Data Anggota</h1>
  
  <a data-target="#tambah_anggota" href="#" data-toggle="modal" id="tambah_mod_anggota" style="text-decoration:none;" class="btn btn-primary btn-xs ml-auto"><i class="fa fa-plus-square" aria-hidden="true"></i> Pendaftaran</a>
  
</div>
<div class="table-responsive">
  <table class="table table-sm dataTableExport table-bordered table-striped" style="width:100%">
      <thead>
          <tr>
              <th>No</th>
              <th>Nomor Anggota</th>
              <th>Nama Anggota</th>
              <th>Jenis Kelamin</th>
              <th>No Hp</th>
              <th>Pekerjaan</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
      <?php foreach($list as $key => $val) { ?>
          <tr>
              <td><?=$key+1?></td>
              <td><?=$val->ang_nomor?></td>
              <td><?=$val->ang_nama?></td>
              <td><?=$val->ang_jk?></td>
              <td><?=$val->ang_no_hp?></td>
              <td><?=$val->krj_nama?></td>
              <td>
                <a id="<?=$val->ang_id?>"  href="<?=base_url()?>admin/anggota/detail/<?=md5($val->ang_id)?>" class="btn btn-sm btn-warning"> <i class="fas fa-eye"></i> Detail </a>
                

              </td>
          </tr>
      <?php }?>
      </tbody>
  </table>
</div>
<!-- Modal Tambah anggota -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="tambah_anggota" data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pendaftaran anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_anggota" name="form_anggota" method="POST" onSubmit="return confirm('yakin Untuk menyimpan?');">
            
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Identitas</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Nomor Anggota</label>
                      <input type="text" id="ang_nomor" value="<?=$nomor_anggota?>" readonly name="ang_nomor" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Tanggal Daftar</label>
                      <input type="text" id="dft_tanggal_daftar" value="<?=date('d-m-Y')?>" name="dft_tanggal_daftar" class="form-control datepicker">
                    </div>
                    <div class="form-group">
                      <label>Nama Anggota</label>
                      <input type="text" id="ang_nama" name="ang_nama" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Tempat Lahir</label>
                      <input type="text" id="ang_tempat_lahir" name="ang_tempat_lahir" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="text" id="ang_tanggal_lahir" name="ang_tanggal_lahir" class="form-control datepicker">
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <select name="ang_jk" class="form-control" id="ang_jk" class="form-control">
                          <option value="">--Pilih--</option>
                          <option value="Pria">Pria</option>
                          <option value="Wanita">Wanita</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Agama</label>
                      <select name="ang_agm_id" id="ang_agm_id" class="form-control">
                          <option value="">--Pilih--</option>
                          <?php
                            foreach($ref_agama as $a){
                          ?>
                          <option value="<?=$a->agm_id?>"><?=$a->agm_nama?></option>
                          <?php
                            }
                          ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Pekerjaan</label>
                      <select name="ang_krj_id" id="ang_krj_id" class="form-control">
                          <option value="">--Pilih--</option>
                          <?php
                            foreach($ref_pekerjaan as $a){
                          ?>
                          <option value="<?=$a->krj_id?>"><?=$a->krj_nama?></option>
                          <?php
                            }
                          ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Ayah</label>
                      <input type="text" id="ang_nama_ayah" name="ang_nama_ayah" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Nama Ibu</label>
                      <input type="text" id="ang_nama_ibu" name="ang_nama_ibu" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <textarea name="ang_alamat" id="ang_alamat" cols="30" rows="10" style="height:70%" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>No Hp</label>
                      <input type="text" name="ang_no_hp" id="ang_no_hp" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Jenis Dokumen Identitas</label>
                      <select name="ang_idn_id" id="ang_idn_id" class="form-control">
                          <option value="">--Pilih--</option>
                          <?php
                            foreach($ref_dok_identitas as $a){
                          ?>
                          <option value="<?=$a->idn_id?>"><?=$a->idn_nama?></option>
                          <?php
                            }
                          ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nomor Identitas</label>
                      <input type="text" id="ang_no_identitas" name="ang_no_identitas" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Nama Ahli Waris</label>
                      <input type="text" id="ang_nama_ahli_waris" name="ang_nama_ahli_waris" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Alamat Ahli Waris</label>
                      <textarea name="ang_alamat_ahli_waris" id="ang_alamat_ahli_waris" cols="30" rows="10" style="height:70%" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Hubungan Keluarga</label>
                      <input type="text" id="ang_hub_keluarga" name="ang_hub_keluarga" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-header">
                           <h4>Simpanan Anggota</h4>  
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nomor Rekening</label>
                                <input type="text" readonly value='<?=$nomor_rekening?>' name="rek_no_rekening" id="rek_no_rekening" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Simpanan Pokok</label>
                                <input type="text" name="tsi_simpanan_pokok" id="tsi_simpanan_pokok" class="form-control angka">
                            </div>
                            <div class="form-group">
                                <label>Simpanan Wajib</label>
                                <input type="text" name="tsi_simpanan_wajib" id="tsi_simpanan_wajib" class="form-control angka">
                            </div>
                            <div class="form-group">
                                <label>Simpanan Sukarela</label>
                                <input type="text" name="tsi_simpanan_sukarela" id="tsi_simpanan_sukarela" class="form-control angka">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <input type="submit" class="btn btn-primary" value="Simpan">
            <input type="text" style="display: none" name="agm_id" id="agm_id"/>
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
	