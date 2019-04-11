<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Save Post</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['baseUrl']?>/view/css/style.css">
         <script src="<?php echo $_SESSION['baseUrl']?>/view/js/formValidationsPosts.js"></script> 
    
    </head>
    <body>        
        <br/>
        <br/>
        <?php
        if ( $errors ) {
            print '<ul class="errors">';
            foreach ( $errors as $field => $error ) {
                print '<li>'.htmlentities($error).'</li>';
            }
            print '</ul>';
        }
        ?>        
        <button onclick="history.go(-1);">Back </button>
        <form name='savePost'  class='form' onsubmit="return validation();" method="POST" >
            <input type='hidden' name='id' value="<?php echo $post['id']?>" />
            <label>Title: * &nbsp;<span id='validationTitle'></span></label><br/>
            <input type="text" name="title" value="<?php print htmlentities($post['title']) ?>"/>
            <br/>
            <label>Content: * &nbsp; <span id='validationContent'></span></label><br/>
            <textarea name="content" id='content' rows="20" cols="80">
                <?php echo stripslashes(html_entity_decode($post['content'])); ?></textarea>
            <input type="hidden" name="form-submitted" value="1" />
            <input class='submit' type="submit" value="Submit" />
        </form>
        
    </body>
</html>
