<?php foreach($userData as $a){}; ?>
<header class="main-header">
  <a href="<?=base_url()?>" class="logo">
    <span class="logo-mini" style="font-family: 'Poppins', sans-serif;"><b>NBR</b></span>
    <span class="logo-lg">
      <b style="font-family: 'Poppins', sans-serif;">NGEKENE BAE RESTO</b></span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="<?base_url()?>dashboard/" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?=base_url()?>assets/theme/img/<?=$a->u_img?>" class="user-image" alt="User Image">
            <span class="hidden-xs">
              <?php echo strtoupper($a->u_name); ?></span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>
<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?=base_url()?>assets/theme/img/<?=$a->u_img?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>
          <?=strtoupper($a->u_name)?>
        </p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN MENU</li>
      <li class="<?php if($this->uri->segment(1)=='dashboard'){echo 'active';}?>"><a href="<?=base_url("dashboard/");?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
      <?php if($a->u_rule=='Admin'){?>
      <li class="treeview menu-open <?php if($this->uri->segment(1)=='karyawan'){echo 'active';}?>">
        <a href="#">
          <i class="fa fa fa-list"></i><span>KARYAWAN</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url()?>karyawan/data/">TAMBAH KARYAWAN</a></li>
        </ul>
      </li>
      <li class="treeview menu-open <?php if($this->uri->segment(1)=='modal'){echo 'active';}?>">
        <a href="#">
          <i class="fa fa fa-list"></i><span>MODAL</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url()?>modal/data/">TAMBAH MODAL</a></li>
        </ul>
      </li>
      <li class="treeview menu-open <?php if($this->uri->segment(1)=='pendapatan'){echo 'active';}?>">
        <a href="#">
          <i class="fa fa fa-list"></i><span>PENDAPATAN</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url()?>pendapatan/data/">DATA PENDAPATAN</a></li>
        </ul>
      </li>
      <?php }else{ ?>
      <li class="treeview menu-open <?php if($this->uri->segment(1)=='produk'){echo 'active';}?>">
        <a href="#">
          <i class="fa fa fa-list"></i><span>PRODUK</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url()?>produk/data/">TAMBAH PRODUK</a></li>
          <!-- <li><a href="<?=base_url()?>produk/data-stok/">TAMBAH STOK PRODUK</a></li> -->
        </ul>
      </li>
      <li class="treeview menu-open  <?php if($this->uri->segment(1)=='transaksi'){echo 'active';}?>">
        <a href="#">
          <i class="fa fa-cart-plus"></i><span>KASIR (POS)</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url()?>transaksi/tambah/">TAMBAH TRANSAKSI</a></li>
          <li><a href="<?=base_url()?>transaksi/data/">DATA TRANSAKSI</a></li>
        </ul>
      </li>
      <li class="treeview menu-open  <?php if($this->uri->segment(1)=='saldo'){echo 'active';}?>">
        <a href="#">
          <i class="fa fa-credit-card"></i><span>PENDAPATAN</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url()?>saldo/data/">DATA PENDAPATAN</a></li>
        </ul>
      </li>
      <?php } ?>
      <li><a href="<?=base_url("logout-process/");?>"><i class="fa fa-sign-out"></i> <span>KELUAR</span></a></li>
    </ul>
  </section>
</aside>