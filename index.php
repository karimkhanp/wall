<?php
if( 'DEVELOPMENT' ){
    
    error_reporting(E_ALL &&  !E_DEPRECATED);
    ini_set('display_errors', TRUE);
    var_dump($_POST);
    
}
else{
    error_reporting(0);
    
}
include_once 'includes/db.php';
include_once 'includes/functions.php';
include_once 'includes/tolink.php';
include_once 'includes/time_stamp.php';
include_once 'session.php';

$Wall = new Wall_Updates();
$updatesarray = $Wall->Updates($uid);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Version 3.1 modyfied</title>

        
       <?php
       include_once 'includes/script_loader.php';
       ?>
    </head>
    
<body>
    
     <ul class="nav nav-tabs" id="myTab">
        <li class="active">
            <a href="#home" data-toggle="tab" >Company</a>
        </li>
        <li>
            <a href="#group"  data-toggle="tab"><?php echo $group_name ?></a>
        </li>
       
    </ul>
     
    <div class="tab-content">
        <div class="tab-pane active" id="home">
            <div id="wall_container">
                <div id="updateboxarea">
                    <form method="post" action="">
                        <textarea cols="30" rows="4" name="update" id="update" maxlength="200" ></textarea>
                        <br />
                        <input type="submit"  value=" Update "  id="update_button"  class="update_button"/>
                    </form>
                </div>
                <div id='flashmessage'>
                    <div id="flash" align="left"  ></div>
                </div>
                <div id="content">
                    <?php include('load_messages.php'); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="group">
             <div id="wall_container" class="private">
                    <div id="updateboxarea">
                        <form method="post" action="">
                            <textarea cols="30" rows="4" name="update" id="update" maxlength="200" ></textarea>
                            <br />
                            <input type="hidden" id="group_id" name="group_id" value="<?php echo $group_id ?>">
                            <input type="submit"  value=" Update "  id="update_private_button"  class="update_button"/>
                        </form>
                    </div>
                <div id='flashmessage'>
                    <div id="flash" align="left"  ></div>
                </div>
                <div id="content">
                <?php
                    $Wall = new Wall_Updates();
                    $updatesarray = $Wall->Updates($uid , $group_id);
                    include('load_messages.php'); 
                ?>
                </div>
            </div>
        </div>
    </div>
     
    <script>
        jQuery(function () {
            jQuery('#myTab a:last').tab('show');
        })
    </script>
  
    
   
    
  
</body>
</html>
