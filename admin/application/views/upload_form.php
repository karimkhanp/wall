<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php 
    for( $i = 0; $i <= 5; $i++){
?>
<h2>
    Editing field no: <?php echo $i; ?>
</h2>    
<?php
        
        echo form_open_multipart('upload/do_upload')
;?> 
            <input type="hidden" name="id" value="<?php echo $i?>">
            <input type="file" name="post_image_<?php echo $i?>" size="20" />
            <br />
                <input type="text" name="Post_title" />
            <br />
                <textarea name ="Post_content" >
                </textarea>
            <br />
                <input type="text" name="Post_link" />
            <br />
                <input type="submit" value="upload" />
        </form>
<?php
    }
?>

    


</body>
</html>