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
              
                
              
              <li class="menu-header">Master</li>
                  <li class="<?=$link=='ref_agama'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/ref_agama">
                  <i class="fas fa-money-bill"></i> Ref Agama</a></li>

                  <li class="<?=$link=='ref_pekerjaan'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/ref_pekerjaan">
                  <i class="fas fa-money-bill"></i> Ref Pekerjaan</a></li>
                  <li class="<?=$link=='ref_setting_pembiayaan'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/ref_setting_pembiayaan">
                  <i class="fas fa-money-bill"></i> Ref Setting Pembiayaan</a></li>
                  <li class="<?=$link=='ref_dok_identitas'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/ref_dok_identitas">
                  <i class="fas fa-money-bill"></i> Ref Dokumen Identitas</a></li>
                  <li class="<?=$link=='anggota'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/anggota">
                  <i class="fas fa-money-bill"></i> Anggota</a></li>
              
              <li class="menu-header">Transaksi</li>
                <li class="<?=$link=='pendaftaran'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/pendaftaran">
                    <i class="fas fa-money-bill"></i> Pendaftaran</a></li>
                
                <li class="<?=$link=='simpan'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/simpan">
                    <i class="fas fa-money-bill"></i> Simpanan</a></li>
                <li class="<?=$link=='pembiayaan'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/pembiayaan">
                    <i class="fas fa-money-bill"></i> Pembiayaan</a></li>
                <li class="<?=$link=='bayar_pembiayaan'?'active':''?>"><a class="nav-link" href="<?=base_url()?>admin/bayar_pembiayaan">
                    <i class="fas fa-money-bill"></i> Pembayaran Pembiayaan</a></li>
          </ul>
        </aside>
      </div>
      <div class="main-content">
        <section class="section">