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
        
        <form action="?<?php htmlout($action); ?>" id ="assignmentForm" class="form-horizontal well" method="post">  
               
        <div class="control-group">
            <?php if ($action == 'editform') : ?>
            <label class="control-label" for="id">Project</label>
            <div class="controls">
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    <input type="text" name="projName" id="projName" readonly="readonly" value="<?php htmlout($projName); ?>" />
                    <input type="hidden" name="projId" id="projId" value="<?php htmlout($projId); ?>" />
                </div>    
            </div>            
            
            <?php else: ?>
            
            <label class="control-label" for="id">Select Project</label>
            <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        <select name="projId" id="$projId">
                            <option value="">*** Please Select ***</option>
                            <?php foreach ($projects as $project): ?>
                            <option value="<?php htmlout($project['id']); ?>" <?php
                                  if ($project['selected'])
                                  {
                                    echo ' selected';
                                  }
                                  ?>>
                                <?php htmlout($project['name']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>       
                    </div>    
            </div>
            <?php endif; ?>
        </div>  
        <div class="control-group">
            <?php if ($action == 'editform') : ?>
            <label class="control-label" for="id">Employee</label>
            <div class="controls">
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    <input type="text" name="empName" id="empName" readonly="readonly" value="<?php htmlout($empName); ?>" />
                    <input type="hidden" name="empId" id="empId" value="<?php htmlout($empId); ?>" />
                </div>    
            </div>            
            
            <?php else: ?>            
            <label class="control-label" for="leaderId">Select Employee</label>
            <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        <select name="empId" id="empId">
                            <option value="">*** Please Select ***</option>
                            <?php foreach ($employees as $employee): ?>
                            <option value="<?php htmlout($employee['id']); ?>" <?php
                                  if ($employee['selected'])
                                  {
                                    echo ' selected';
                                  }
                                  ?>>
                                <?php htmlout($employee['firstName'] .' '. ((!empty($employee['middleName'])) ? $employee['middleName'] . ' ': ''). $employee['lastName']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>       
                    </div>    
            </div>
            <?php endif; ?>
        </div>          
        <div class="control-group">
            <label class="control-label" for="hours">Hours</label>
            <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        <input type="text" name="hours" id="hours" <?php if (!empty($hours)) { echo 'value = "'; htmlout($hours); echo '"'; } else echo 'placeholder="Employee Hours"'; ?> />
                   </div>    
            </div>
        </div>   
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