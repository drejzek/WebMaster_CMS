<?php
  $sql_modules = "SELECT * FROM customers WHERE customer_id = $c_id";
  $m_r = mysqli_query($con, $sql_modules);
  $module = mysqli_fetch_array($m_r);
  
  $u_m = explode(';', $module['customer_modules']);
  
  $mod_html = "";
?>


<style>

    .list-group-item{
      border: none;
    }
    .list-group-item:hover{
        background-color: #eee;
        border: none;
    }
    .list-group{
      border: none;
    }

</style>
<div class="col-md-2" style="padding:0">
  <!--id="sidebarMenu"-->
<nav
       class="bg-secoondary w-100 px-4"
       style="overflow-y:auto;background:#fff"
       >
          <div class="list-group mt-4">
           <div class="list-item">
            <form class="mb-3" action="result.php" style="padding-bottom: 5px;">
              <input class="form-control" id="myInput" class="me-2" type="text" placeholder="Zadejte co hledáte..." name="search_query" <?php if(isset($_GET['search_query'])){$query = $_GET["search_query"];echo "value='" . $query . "'";}?>>
            </form>
           </div>
<!--           <br>-->
<span class="mx-3">Obsah webu</span>
            <?php 
            
            if(strpos($_SERVER['PHP_SELF'], 'pages') || strpos($_SERVER['PHP_SELF'], 'articles') || strpos($_SERVER['PHP_SELF'], 'places') || strpos($_SERVER['PHP_SELF'], 'users') || strpos($_SERVER['PHP_SELF'], 'updates') || strpos($_SERVER['PHP_SELF'], 'banners') || strpos($_SERVER['PHP_SELF'], 'sections') || strpos($_SERVER['PHP_SELF'], 'galeries')){
              foreach($u_m as $value){
                $sql_user_modules = "SELECT * FROM modules WHERE module_id = $value";
                $mod_r = mysqli_query($con, $sql_user_modules);
                $mod = mysqli_fetch_array($mod_r);
                $mod_html = '<a href="../modules/' . $mod['module_fold_name'] . '/"class="list-group-item list-group-item-action py-2 ripple"><i class="' . $mod['module_ico_class'] . ' fa-fw me-3"></i> <span>' . $mod['module_name'] . '</span></a>';
                echo $mod_html;
              }
              echo '
              
              <span class="mx-3">Agenda</span>
              <a
              href="../files-manager.php"
              class="list-group-item list-group-item-action py-2 ripple"
              ><i class="fas fa-folder fa-fw me-3"></i> <span>Správa souborů</span></a
              >
              <br>
              <span class="mx-3">Nastavení</span>
            <a
              href="../settings.php"
              class="list-group-item list-group-item-action py-2 ripple" >
              <i class="fas fa-cog fa-fw me-3"></i> <span>Nastavení</span>
            </a>
            <a
              href="log.php"
              class="list-group-item list-group-item-action py-2 ripple" >
              <i class="fas fa-history fa-fw me-3"></i> <span>Log událostí</span>
            </a>
                    <a
              href="../users/"
              class="list-group-item list-group-item-action py-2 ripple"
              ><i class="fa fa-user fa-fw me-3"></i
              > <span>Uživatelé systému</span></a
              >
              
              ';
            }
            else{
              foreach($u_m as $value){
                $sql_user_modules = "SELECT * FROM modules WHERE module_id = $value";
                $mod_r = mysqli_query($con, $sql_user_modules);
                $mod = mysqli_fetch_array($mod_r);
                $mod_html = '<a href="modules/' . $mod['module_fold_name'] . '/"class="list-group-item list-group-item-action py-2 ripple"><i class="' . $mod['module_ico_class'] . ' fa-fw me-3"></i> <span>' . $mod['module_name'] . '</span></a>';
                echo $mod_html;
              }

              echo '
              
              <span class="mx-3">Agenda</span>
              <a
              href="files-manager.php"
              class="list-group-item list-group-item-action py-2 ripple"
              ><i class="fas fa-folder fa-fw me-3"></i> <span>Správa souborů</span></a
              >
              <br>
              <span class="mx-3">Nastavení</span>
            <a
              href="settings.php"
              class="list-group-item list-group-item-action py-2 ripple" >
              <i class="fas fa-cog fa-fw me-3"></i> <span>Nastavení</span>
            </a>
            <a
              href="log.php"
              class="list-group-item list-group-item-action py-2 ripple" >
              <i class="fas fa-history fa-fw me-3"></i> <span>Log událostí</span>
            </a>
                    <a
              href="users/"
              class="list-group-item list-group-item-action py-2 ripple"
              ><i class="fa fa-user fa-fw me-3"></i
              > <span>Uživatelé systému</span></a
              >
              
              ';

            }
            
            ?>
            <br>
    <div class="list-item mt-3 mb-5 text-center small">
      <span class="text-muted">Doména/alias: <?php echo $_SESSION['domain']?></span>
      <br> 
      <span class="text-muted">WebMasterCMS &copy; 2023</span>
      <br> 
      <span class="text-muted">All rights reserved.</span>
      <br>
      <span class="text-muted"> ver. 1.0.0.0</span>
    </div>
      </div>
  </nav>
</div>