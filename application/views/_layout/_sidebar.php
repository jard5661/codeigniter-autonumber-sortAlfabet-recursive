<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" style="height: auto;">
    <!-- Sidebar user panel -->

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu tree" data-widget="tree">
      <li class="header">DAFTAR MENU</li>
      <li <?php if ($page == 'home') {
            echo 'class="active"';
          } ?> class="treeview" style="height: auto;">
        <a href="<?php echo base_url('Home'); ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

    
      <li><a href="<?php echo base_url('Test1'); ?>"><i class="fa fa-folder"></i>TEST 1</a></li>
      <li><a href="<?php echo base_url('Test2'); ?>"><i class="fa fa-folder"></i>TEST 2</a></li>
      <li><a href="<?php echo base_url('Test3'); ?>"><i class="fa fa-folder"></i>TEST 3</a></li>
    

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>