<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Agama</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Agama</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <a href="#" data-target="#modal_add" data-toggle="modal" id="tambah_ref_agama" class="btn bg-gradient-primary">
                        <i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Agama</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>Islam
                    </td>
                    <td> 
                        <a href="#" data-toggle="modal" id="ubah_ref_agama" class="btn bg-gradient-warning">
                        <i class="fa fa-edit" aria-hidden="true"></i> Ubah Data</a>
                        <a href="#" data-toggle="modal" id="hapus_ref_agama" class="btn bg-gradient-danger">
                        <i class="fa fa-trash-alt" aria-hidden="true"></i> Ubah Data</a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Hindu
                    </td>
                    <td></td>
                  </tr>
                  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
      </div>
    </section>
    <!-- /.content -->


    

<!-- Modal Tambah tahun -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal_add" data-backdrop="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah/Ubah Agama</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="form_mon_anggaran" name="form_mon_anggaran" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Agama</label>
                <input type="text" class="form-control" id="agm_nama" name="agm_nama" placeholder="Masukkan Nama Agama">
            </div>
                
            </div>
        </div>
        <div class="modal-footer">
        <div id="notif_sukses"></div>
            <input type="submit" class="btn btn-primary" value="Simpan">
            <input type="text" style="display: none" name="agm_id" id="agm_id"/>
            <input type="text" style="display: none" name="action" id="action"/>
      </form>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
    <div class="modal fade" id="modal_hapus" role="dialog" data-backdrop="false">
        <div class="modal-dialog ">
          <div class="modal-content">
          <div class="modal-header">
        <h5 class="modal-title">Hapus Agama</h5>
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