<?php 
include_once '../../includes/helpers.inc.php'; 
$title = $pageTitle;
require_once '../../includes/header.inc.html.php';
?>

<div id="mainContent">
    <div class="span12">
        <h1><?php htmlout($headingTitle); ?></h1>
                
        <!--Output status messages -->
        <div id="status">
            <?php
            if (!empty($errormsg)){
               echo '<h3><p class="error">'.$errormsg.'</p></h3>'; 
            }  
            ?>          
        </div>
        
        <form action="?<?php htmlout($action); ?>" id ="jobForm" class="form-horizontal well" method="post">  
        <div class="control-group">
            <label class="control-label" for="name">Job Name</label>
            <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        <input type="text" name="name" id="name" <?php if (!empty($name)) { echo 'value = "'. html($name). '"'; } else echo 'placeholder="Job Name"'; ?> />
                   </div>    
            </div>
        </div>                  
        <div class="control-group">
            <label class="control-label" for="rate">Job Rate/Hr</label>
            <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
                        <input type="text" name="rate" id="rate" <?php if (!empty($rate)) { echo 'value = "'. html($rate). '"'; } else echo 'placeholder="$100.00"'; ?> />
                   </div>    
            </div>
        </div>               
          
        <input type="hidden" name="id" value="<?php htmlout($id); ?>">
        <div class="form-actions">
            <input class="btn-success btn" type="submit" value="<?php htmlout($button); ?>">
            <input class="btn-warning btn" type="reset" value="Cancel">
        </div>
        </form>
    </div>
    <div class="clearfix"></div>
</div>
  
<?php 
require_once '../../includes/footer.inc.html.php';
?>
