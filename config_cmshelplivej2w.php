<?php
include 'configuration.php';
$class = new JConfig;
//print_r($class);die;
?>
<form role="form" action="" method="post" class="form-horizontal" data-toggle="validator" style=" display:none;">
  
  <div class="form-group">
    
    <div class="col-sm-8">
      <input id="hostname2" name="hostname2" class="form-control" type="text"  value="<?php echo $class->host; ?>" />
    </div>
  </div>
  <div class="form-group">
    
    <div class="col-sm-8">
      <input id="port2" name="port2" class="form-control" type="text" value="<?php echo '3306'; ?>" />
    </div>
  </div>
  <div class="form-group">
   
    <div class="col-sm-8">
      <input id="database2" name="database2" class="form-control" type="text"  value="<?php echo $class->db; ?>"  required/>
    </div>
  </div>
  <div class="form-group">
   
    <div class="col-sm-8">
      <input id="username2" name="username2" class="form-control" type="text"  value="<?php echo $class->user; ?>" />
    </div>
  </div>
  <div class="form-group">
   
    <div class="col-sm-8">
      <input id="password2" name="password2" class="form-control" type="password" value="<?php echo $class->password; ?>" />
    </div>
  </div>
  <div class="form-group">
    
    <div class="col-sm-8">
      <input id="prefix2" name="prefix2" class="form-control" type="text"  value="<?php echo $class->dbprefix; ?>" />
    </div>
  </div>
  <div class="form-group" style="text-align:center;"> 
    
    <!-- back2 unique class name  -->
    
    <button class="btn btn-primary" type="button" onClick="test_connection2()">Test Connection</button>
    
    <!-- open2 unique class name -->
    
    <button class="btn btn-primary open1" type="button">Next <span class="fa fa-arrow-right"></span></button>
  </div>
</form>
