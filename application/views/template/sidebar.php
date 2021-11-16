      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?=base_url()?>">koperasi</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?=base_url()?>">koperasi</a>
          </div>
          <ul class="sidebar-menu">
              <li class="<?=empty($link) || $link=='dashboard_admin'?'active':''?>"><a href="<?=base_url()?>beranda" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
              <li class="<?=$link=='anggota'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/anggota">
                  <i class="fas fa-money-bill"></i> Anggota</a></li>
                
             
              <li class="dropdown <?=empty($link) || $link2=='transaksi'?'active':''?>">
                <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-chart-line"></i> Transaksi</a>
                <ul class="dropdown-menu">
                  <?php
                    if($this->session->userdata('usr_simpan')==1){
                  ?>
                  <li class="<?=$link=='simpan'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/simpan">
                      <i class="fas fa-money-bill"></i> Simpanan</a></li>
                  <?php
                    }
                  ?>
                  <?php
                    if($this->session->userdata('usr_pembiayaan')==1){
                  ?>
                  <li class="<?=$link=='pembiayaan'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/pembiayaan">
                      <i class="fas fa-money-bill"></i> Pembiayaan</a></li>
                  <?php }
                  ?>
                  <?php
                    if($this->session->userdata('usr_bayar_pembiayaan')==1){
                  ?>
                  <li class="<?=$link=='bayar_pembiayaan'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/bayar_pembiayaan">
                      <i class="fas fa-money-bill"></i> Pembayaran</a></li>
                  <?php }?>
                </ul>
                
              </li>  
              <li class="dropdown <?=empty($link) || $link2=='laporan'?'active':''?>">
                <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-chart-line"></i> Laporan</a>
                <ul class="dropdown-menu">
                  <?php
                    if($this->session->userdata('usr_lap_pendaftaran')==1){
                  ?>
                  <li class="<?=$link=='lpendaftaran'?'active':''?>"><a class="nav-link" href="#">
                      <i class="fas fa-money-bill"></i> Pendaftaran</a></li>
                  <?php }?>
                  <?php
                    if($this->session->userdata('usr_lap_simpan')==1){
                  ?>
                  <li class="<?=$link=='lsimpan'?'active':''?>"><a class="nav-link" href="#">
                      <i class="fas fa-money-bill"></i> Simpanan</a></li>
                  <?php }?>
                  <?php
                    if($this->session->userdata('usr_lap_pembiayaan')==1){
                  ?>
                  <li class="<?=$link=='lpembiayaan'?'active':''?>"><a class="nav-link" href="#">
                      <i class="fas fa-money-bill"></i> Pembiayaan</a></li>
                  <?php }?>
                  <?php
                  
                    if($this->session->userdata('usr_lap_bayar_pembiayaan')==1){
                  ?>
                  <li class="<?=$link=='lbayar_pembiayaan'?'active':''?>"><a class="nav-link" href="#">
                      <i class="fas fa-money-bill"></i> Pembayaran</a></li>
                  <?php }?>
                </ul>
                
              </li>   
              <li class="dropdown <?=empty($link) || $link2=='master'?'active':''?>">
                <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-chart-line"></i> Master</a>
                  <ul class="dropdown-menu">
                    <?php
                      if($this->session->userdata('usr_muser')==1){
                    ?>
                    <li class="<?=$link=='managemen_user'?'active':''?>"><a class="nav-link" href="#">
                    <i class="fas fa-money-bill"></i> Managemen User</a></li>
                    <?php }?>
                    <?php
                      if($this->session->userdata('usr_ref_agama')==1){
                    ?>
                    <li class="<?=$link=='ref_agama'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/ref_agama">
                    <i class="fas fa-money-bill"></i> Agama</a></li>
                    <?php }?>
                    <?php
                      if($this->session->userdata('usr_ref_pekerjaan')==1){
                    ?>
                    <li class="<?=$link=='ref_pekerjaan'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/ref_pekerjaan">
                    <i class="fas fa-money-bill"></i> Pekerjaan</a></li>
                    <?php }?>
                    <?php
                      if($this->session->userdata('usr_setting_pembiayaan')==1){
                    ?>
                    <li class="<?=$link=='ref_setting_pembiayaan'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/ref_setting_pembiayaan">
                    <i class="fas fa-money-bill"></i> Ref Pembiayaan</a></li>
                    <?php }?>

                    <?php
                      if($this->session->userdata('usr_setting_simpanan')==1){
                    ?>
                    <li class="<?=$link=='ref_setting_simpanan'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/ref_setting_simpanan">
                    <i class="fas fa-money-bill"></i> Ref Simpanan</a></li>
                    <?php }?>
                    <?php
                      if($this->session->userdata('usr_ref_dok_identitas')==1){
                    ?>
                    <li class="<?=$link=='ref_dok_identitas'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/ref_dok_identitas">
                    <i class="fas fa-money-bill"></i> Dok Identitas</a></li>
                    <?php }?>

                  </ul>
              </li>
          </ul>
        </aside>
      </div>
      <div class="main-content">
        <section class="section">