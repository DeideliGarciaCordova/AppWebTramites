<?php
include_once './model/model.stseguridad.php';
$vga_permisos = new Modelstseguridad();
$tblmenus= $vga_permisos->lstmenus();
$menu='';
foreach ($tblmenus as $row){
   $tblsm =$vga_permisos->lstsubmenus($row->idmenu); 
   $submenu='';
   foreach ($tblsm as $row2){
       $submenu.= st_itemsubmenu($row2->sm_control,$row2->sm_icono, $row2->sm_nombre);
   }

   if(count($tblsm)>0){

    $menu.= st_itemmenu('', $row->mnu_icono, $row->mnu_nombre,$submenu);
   }
     
}

if(!empty($vga_permisos->verlogo()->emp_logo)){
  $logo=' <img class="rounded-circle border border-primary shadow-lg center" style="width: 100px;height: 100px;" src="data:image/jpg;base64,'.base64_encode($vga_permisos->verlogo()->emp_logo).'" >';
  $empresa= $vga_permisos->verlogo()->emp_razonsocial;
}else{
  $logo=' <img src="'. URL .'/img/sinlogo.png" class="rounded-circle border border-primary shadow-lg center" style="width: 100px;height: 100px;">';
  $empresa='No hay nombre de empresa';
}

?></a> 
<!-- Main Sidebar Container-->
<aside class="main-sidebar sidebar-dark-primary elevation-4"> 

    <!-- Brand Logo -->
    <a href="#" class="brand-link">
    <h5 class=" text-center   "><?php echo $empresa; ?></h5>
    <div class="login-logo"  >
      <?php echo $logo; ?>
    </div> 
    </a>

    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->                               
                <?php echo $menu;?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>