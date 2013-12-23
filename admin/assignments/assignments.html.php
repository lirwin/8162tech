<?php 
$title = 'Manage Assignments';
require_once '../../includes/header.inc.html.php';
?>
<div id="mainContent">
    <div class="span12">
        <h1>Manage Assignments</h1> 
        
        <p><a class="btn-warning btn" href="?add">Add new assignment</a></p>
        
        <!--Output status messages -->
        <div id="status"></div>
        
        <table class="table table-striped table-bordered table-condensed table-hover">  
        <tr>
            <th>Project Number</th>
            <th>Project Name</th>
            <th>Employee Number</th>
            <th>Employee Name</th>
            <th>Hours</th>
            <th>Options</th>
        </tr> 
        <?php foreach ($assignments as $assignment): ?>  
            <tbody>
                <tr>
                    <td rowspan="<?php htmlout(count($assignment['employees'])); ?>"><?php htmlout($assignment['id']); ?></td>
                    <td id="projName" rowspan="<?php htmlout(count($assignment['employees'])); ?>"><?php htmlout($assignment['name']); ?></td>
                <?php foreach ($assignment['employees'] as $employee): ?> 
                    <td><?php htmlout($employee['id']); ?></td>
                    <td id="empName"><?php htmlout($employee['firstName'] .' '. (!empty($employee['middleName']) ? $employee['middleName'] . ' ': ''). $employee['lastName']);
                        echo ($employee['id'] == $assignment['leaderId'] ? '<strong> *</strong>' : ''); ?></td>
                    <td><?php htmlout($employee['hours']); ?></td>
                    <td>
                        <form action="?" method="post">
                          <div>
                            <input type="hidden" name="projId" value="<?php htmlout($assignment['id']); ?>">
                            <input type="hidden" name="empId" value="<?php htmlout($employee['id']); ?>">
                            <input type="hidden" name="hours" value="<?php htmlout($employee['hours']); ?>">
                            <input class="btn-primary btn" type="submit" name="action" value="Edit">
                            <input class="btn-danger btn" type="submit" name="action" value="Delete">
                          </div>
                        </form>
                    </td>
                </tr> 
                <?php endforeach; ?>
            </tbody>                 
        <?php endforeach; ?> 
        </table>
    </div>
    <div class="clearfix"></div>
</div>
  
<?php 
require_once '../../includes/footer.inc.html.php';
?>