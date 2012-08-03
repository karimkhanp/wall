<?php
    include_once 'header.php';
    include_once 'script_loader.php';
?>

<body>

     
<div class="row span12">

<?php echo isset($error)?$error:'';?>
    
<ul class="nav nav-tabs" id="myTab">
            <?php
                for( $i = 0; $i <= 4; $i++){
            ?>
                    <li class="<?php if( $i == 0){ echo "active" ;}?>">
                        <a href="#box<?php echo $i?>" data-toggle="tab" >Edit box no:<?php echo $i + 1 ?></a>
                    </li>
            <?php 
                }
            ?>
</ul>

<div class="tab-content admin">
<?php
  
    for( $i = 0; $i <= 4; $i++){
?>
    <div class="tab-pane span10" id="box<?php echo $i?>">
    
            <h2>
                Editing field no: <?php echo $i + 1; ?>
            </h2>    
                <?php

                        echo form_open_multipart('upload/do_upload')
                ;?> 
                            <input type="hidden" name="id" value="<?php echo $i?>">
                            <?php echo form_label('change icon') ?>
                            <input type="file" class="input-file" name="userfile" size="2 000 000" />
                            <?php 
                            if(isset($post[$i])){
                                echo form_label('Actual Icon:<br> <img class="thumbnail" src="' . $post[$i]->post_image.'">') ;
                            }
                            else{
                                echo form_label('No icon set') ;
                            }
                            ?> 
                            <br/>
                            <?php
                                 echo form_label("Title");
                                 
                                 echo form_input('Post_title',isset($post[$i]) ? $post[$i]->post_title : '');
                                 echo "<br/>";

                                 echo form_label("Content");

                                 echo form_textarea('Post_content',isset($post[$i]) ? $post[$i]->post_content : '');
                                 echo "<br/>";

                                 echo form_label("Link");
                                 echo form_input('Post_link',isset($post[$i]) ? $post[$i]->post_link : '');
                                 echo "<br/>";
                             ?>


                            <input type="submit" class="btn btn-primary" value="save" />
                        </form>
                </div>
                <?php
                }
                ?>
</div>

  <script>
    jQuery(function () {
        jQuery('#myTab a').tab('show');
    })
</script>
</div>
</div>

</body>
</html>
