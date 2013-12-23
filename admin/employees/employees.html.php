<?php 
include_once '../../includes/helpers.inc.php'; 
$title = 'Manage Employees';
require_once '../../includes/header.inc.html.php';
?>

<div id="mainContent">
    <div class="span12">

        <h1>Manage Employees</h1> 
        
        <p><a class="btn-warning btn" href="?add">Add new employee</a></p>
        
        <!--Output status messages -->
        <div id="status"></div>
        
        <table class="table table-striped table-bordered table-condensed table-hover">  
        <tr>
            <th>Employee Number</th>
            <th>Employee Name</th>
            <th>Job Class</th>
            <th>Options</th>
        </tr> 
          
        <?php foreach ($employees as $employee): ?>                   
            <tr>
                <td><?php htmlout($employee['id']); ?></td>
                <td id='name'><?php htmlout($employee['firstName'] .' '. ((!empty($employee['middleName'])) ? $employee['middleName'] . ' ': ''). $employee['lastName']); ?></td>
                <td><?php htmlout($employee['class']); ?></td>
                <td>
                    <form action="?" method="post">
                      <div>
                        <input type="hidden" name="id" value="<?php
                            htmlout($employee['id']); ?>">
                        <input class="btn-primary btn" type="submit" name="action" value="Edit">
                        <input class="btn-danger btn" type="submit" name="action" value="Delete">
                      </div>
                    </form>
                </td>
            </tr>  
        <?php endforeach; ?>  
        </table>

    </div>
    <div class="clearfix"></div>
</div>
  
<?php 
require_once '../../includes/footer.inc.html.php';
?>