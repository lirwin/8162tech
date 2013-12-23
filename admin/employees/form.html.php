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
        
        <form action="?<?php htmlout($action); ?>" id ="employeeForm" class="form-horizontal well" method="post">  
        <div class="control-group">
            <label class="control-label" for="firstName">First Name</label>
            <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        <input type="text" name="firstName" id="firstName" <?php if (!empty($firstName)) { echo 'value = "'; htmlout($firstName); echo '"'; } else echo 'placeholder="First Name"'; ?> />
                   </div>    
            </div>
        </div>                  
        <div class="control-group">
            <label class="control-label" for="middleName">Middle Name</label>
            <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        <input type="text" name="middleName" id="middleName" <?php if (!empty($middleName)) { echo 'value = "'; htmlout($middleName); echo '"'; } else echo 'placeholder="Middle Name"'; ?> />
                   </div>    
            </div>
        </div>               
        <div class="control-group">
            <label class="control-label" for="lastName">Last Name</label>
            <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        <input type="text" name="lastName" id="lastName" <?php if (!empty($lastName)) { echo 'value = "'; htmlout($lastName); echo '"'; } else echo 'placeholder="Last Name"'; ?> />
                   </div>    
            </div>
        </div>   
        <div class="control-group">
            <label class="control-label" for="jobId">Select Job</label>
            <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-briefcase"></i></span>
                        <select name="jobId" id="jobId">
                            <option value="">*** Please Select ***</option>
                            <?php foreach ($jobs as $job): ?>
                            <option value="<?php htmlout($job['id']); ?>" <?php
                                  if ($job['selected'])
                                  {
                                    echo ' selected';
                                  }
                                  ?>>
                                <?php htmlout($job['name']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>       
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
