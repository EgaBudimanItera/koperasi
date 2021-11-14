<div class="section-header">
  <h1>Detail Anggota</h1>
</div>

<h2 class="section-title">Identitas</h2>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                
                <div class="card-header-action">
                    
                </div>
                </div>
                <div class="card-body">
                    <form id="form_anggota" name="form_anggota" method="POST">
                        
                        <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                            <div class="card-header">
                                <h4>Identitas</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                <label>Nomor Anggota</label>
                                <input type="text" id="ang_nomor" value="<?=$list->ang_nomor?>" readonly name="ang_nomor" class="form-control">
                                </div>
                                <div class="form-group">
                                <label>Nama Anggota</label>
                                <input type="text" id="ang_nama" name="ang_nama" value="<?=$list->ang_nama?>" class="form-control">
                                </div>
                                <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" id="ang_tempat_lahir" value="<?=$list->ang_tempat_lahir?>" name="ang_tempat_lahir" class="form-control">
                                </div>
                                <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="text" id="ang_tanggal_lahir" name="ang_tanggal_lahir" value="<?=date('d-m-Y',strtotime($list->ang_tanggal_lahir))?>" class="form-control datepicker">
                                </div>
                                <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="ang_jk" class="form-control" id="ang_jk" class="form-control">
                                    <option value="">--Pilih--</option>
                                    <option value="Pria" <?=$list->ang_jk=='Pria'?'selected':''?>>Pria</option>
                                    <option value="Wanita" <?=$list->ang_jk=='Wanita'?'selected':''?>>Wanita</option>
                                </select>
                                </div>
                                <div class="form-group">
                                <label>Agama</label>
                                <select name="ang_agm_id" id="ang_agm_id" class="form-control">
                                    <option value="">--Pilih--</option>
                                    <?php
                                        foreach($ref_agama as $a){
                                    ?>
                                    <option value="<?=$a->agm_id?>" <?=$list->ang_agm_id==$a->agm_id?'selected':''?>><?=$a->agm_nama?></option>
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
                                    <option value="<?=$a->krj_id?>" <?=$list->ang_krj_id==$a->krj_id?'selected':''?>><?=$a->krj_nama?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                </div>
                                <div class="form-group">
                                <label>Nama Ayah</label>
                                <input type="text" id="ang_nama_ayah" value="<?=$list->ang_nama_ayah?>" name="ang_nama_ayah" class="form-control">
                                </div>
                                <div class="form-group">
                                <label>Nama Ibu</label>
                                <input type="text" id="ang_nama_ibu" value="<?=$list->ang_nama_ibu?>" name="ang_nama_ibu" class="form-control">
                                </div>
                                <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="ang_alamat" id="ang_alamat" cols="30" rows="10" style="height:70%" class="form-control"><?=$list->ang_alamat?></textarea>
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
                                <input type="text" name="ang_no_hp" value="<?=$list->ang_no_hp?>" id="ang_no_hp" class="form-control">
                                </div>
                                <div class="form-group">
                                <label>Jenis Dokumen Identitas</label>
                                <select name="ang_idn_id" id="ang_idn_id" class="form-control">
                                    <option value="">--Pilih--</option>
                                    <?php
                                        foreach($ref_dok_identitas as $a){
                                    ?>
                                    <option value="<?=$a->idn_id?>" <?=$list->ang_idn_id==$a->idn_id?'selected':''?>><?=$a->idn_nama?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                </div>
                                <div class="form-group">
                                <label>Nomor Identitas</label>
                                <input type="text" id="ang_no_identitas" value="<?=$list->ang_no_identitas?>" name="ang_no_identitas" class="form-control">
                                </div>
                                <div class="form-group">
                                <label>Nama Ahli Waris</label>
                                <input type="text" id="ang_nama_ahli_waris" value="<?=$list->ang_nama_ahli_waris?>" name="ang_nama_ahli_waris" class="form-control">
                                </div>
                                <div class="form-group">
                                <label>Alamat Ahli Waris</label>
                                <textarea name="ang_alamat_ahli_waris" id="ang_alamat_ahli_waris" cols="30" rows="10" style="height:70%" class="form-control"><?=$list->ang_alamat_ahli_waris?></textarea>
                                </div>
                                <div class="form-group">
                                <label>Hubungan Keluarga</label>
                                <input type="text" id="ang_hub_keluarga" name="ang_hub_keluarga" value="<?=$list->ang_hub_keluarga?>" class="form-control">
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-12 ">
                                <div class="card">
                                    <div class="card-header">
                                    <h4>Nomor Rekening Anggota</h4>  
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Nomor Rekening</label>
                                            <input type="text" readonly value='<?=$list->rek_no_rekening?>' name="rek_no_rekening" id="rek_no_rekening" class="form-control">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="notif_sukses"></div>
                        <input type="text" style="display: none" value="$list->ang_id" name="ang_id" id="ang_id"/>
                        <input type="text" style="display: none" name="action" value="ubah" id="action"/>
                        <input type="submit" class="btn btn-primary" value="Ubah">
                    </form>
                </div>
            </div>
        </div>
    </div>
<h2 class="section-title">Simpanan</h2>
  <div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
              
              <div class="card-header-action">
                  
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm dataTableExport table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nomor Transaksi</th>
                            <th>Simpanan Pokok (Rp)</th>
                            <th>Simpanan Wajib (Rp)</th>
                            <th>Simpanan Sukarela (Rp)</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list_simpanan as $key => $val) { ?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=date('d-m-Y',strtotime(date($val->tsi_tanggal_simpan)))?></td>
                            <td><?=$val->tsi_no_simpan?></td>
                            <td class="text-right"><?=number_format($val->tsi_simpanan_pokok)?></td>
                            <td class="text-right"><?=number_format($val->tsi_simpanan_wajib)?></td>
                            <td class="text-right"><?=number_format($val->tsi_simpanan_sukarela)?></td>
                            
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
  </div>
<h2 class="section-title">Pembiayaan</h2>
  <div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
            
              <div class="card-header-action">
                  
              </div>
            </div>
            <div class="card-body">
              <?php
                // var_dump(json_encode($list_pembiayaan));
                $no=1;
                foreach($list_pembiayaan as $l =>$val){
                  
              ?>
              <div class="row">
                <div class="col-6 col-md-6">Jenis Pembiayaan : <?=$val->sbi_nama?></div>
                
                <div class="col-6 col-md-6">Jumlah Pinjam : <?='Rp '.number_format($val->tbi_jumlah_pinjam)?></div>
                
              </div>
              <div class="row">
                <div class="col-6 col-md-6">&nbsp</div>
                
                <div class="col-6 col-md-6">Waktu Pinjam : <?=number_format($val->tbi_waktu_pinjam).' Bulan'?></div>
                
              </div>
              <div class="row">
                <div class="col-6 col-md-6">&nbsp</div>
                
                <div class="col-6 col-md-6">Angsuran Pokok : <?='Rp '.number_format($val->tbi_angsuran_pokok)?></div>
                
              </div>
              <br>
              <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" style="width:100%">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nomor Pembayaran</th>
                          <th>Tanggal Jatuh Tempo</th>
                          <th>Keterangan</th>
                          <th>Pokok</th>
                          <th>Denda</th>
                          <th>Tanggal Bayar</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php foreach($val->bayar as $b =>$val2) { ?>
                      <tr>
                          <td><?=$key+1?></td>
                          <td><?=$val2->byr_no_pembayaran?></td>
                          <td><?=$val2->byr_jatuh_tempo?></td>
                          <td><?=$val2->byr_keterangan?></td>
                          <td><?=$val2->byr_pokok?></td>
                          <td><?=$val2->byr_denda?></td>
                          <td>
                            <?=$val2->byr_tanggal_bayar?>
                          </td>
                      </tr>
                  <?php }?>
                  </tbody>
                </table>
              </div>
              <?php
                }
              ?>
              
              
            </div>
        </div>
    </div>
  </div>
