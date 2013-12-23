<?php 
include_once '../../includes/helpers.inc.php'; 
$title = 'Reports';
require_once '../../includes/header.inc.html.php';
?>
<div id="mainContent">
    <div class="span12">
        <h1>Reports</h1> 
        
        <!--Output status messages -->
        <div id="status"></div>
        
        <h2>Employees</h2>
        <table class="table table-striped table-bordered table-condensed table-hover">  
            <tr>
                <th>Employee Number</th>
                <th>Employee Name</th>
                <th>Job Class</th>
                <th>Chg/Hr</th>
            </tr> 
              
            <?php foreach ($employees as $employee): ?>                   
                <tr>
                    <td><?php htmlout($employee['id']); ?></td>
                    <td><?php htmlout($employee['firstName'] .' '. ((!empty($employee['middleName'])) ? $employee['middleName'] . ' ': ''). $employee['lastName']); ?></td>
                    <td><?php htmlout($employee['class']); ?></td>
                    <td><?php htmlout('$' . $employee['chg']); ?></td>
                </tr>  
            <?php endforeach; ?>  
        </table> 
        <h2>Projects</h2>
        <table class="table table-striped table-bordered table-condensed table-hover">  
            <tr>
                <th>Project Number</th>
                <th>Project Name</th>
                <th>Project Leader</th>
            </tr> 
              
            <?php foreach ($projects as $project): ?>                   
                <tr>
                    <td><?php htmlout($project['id']); ?></td>
                    <td><?php htmlout($project['name']); ?></td>
                    <td><?php htmlout($project['leaderFirstName'] .' '. ((!empty($project['leaderMiddleName'])) ? $project['leaderMiddleName'] . ' ': ''). $project['leaderLastName']); ?></td>
                </tr>  
            <?php endforeach; ?>  
        </table>  
        <h2>Assignments</h2>
        <table class="table table-striped table-bordered table-condensed table-hover">  
            <tr>
                <th>Project Number</th>
                <th>Project Name</th>
                <th>Employee Number</th>
                <th>Employee Name</th>
                <th>Job Class</th>
                <th>Charge/Hour</th>
                <th>Hours</th>
                <th>Total Charge</th>
            </tr> 
              
            <?php foreach ($assignments as $assignment): ?>  
                <tbody>
                    <tr>
                        <td rowspan="<?php htmlout(count($assignment['employees'])); ?>"><?php htmlout($assignment['id']); ?></td>
                        <td rowspan="<?php htmlout(count($assignment['employees'])); ?>"><?php htmlout($assignment['name']); ?></td>
                    <?php foreach ($assignment['employees'] as $employee): ?> 
                        <td><?php htmlout($employee['id']); ?></td>
                        <td><?php htmlout($employee['firstName'] .' '. (!empty($employee['middleName']) ? $employee['middleName'] . ' ': ''). $employee['lastName']);
                            echo ($employee['id'] == $assignment['leaderId'] ? '<strong> *</strong>' : ''); ?></td>
                        <td><?php htmlout($employee['class']); ?></td>
                        <td><?php htmlout('$'.$employee['rate']); ?></td>
                        <td><?php htmlout($employee['hours']); ?></td>
                        <td><?php htmlout('$'. number_format($employee['charge'], 2)); ?></td>
                    </tr> 
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="3"><strong>Subtotal</strong></td>
                        <td><strong><?php htmlout('$'. number_format($assignment['total'], 2)); ?></strong></td>
                    </tr>    
                </tbody>                 
            <?php endforeach; ?> 
                <tbody>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="3"><strong>Total</strong></td>
                        <td><strong><?php htmlout('$'. number_format($projectsTotal, 2)); ?></strong></td>
                    </tr>   
                    <tr>
                        <td colspan="8"><strong>* </strong>Indicates Project Leader</td>
                    </tr> 
                </tbody>                 
        </table> 
       </div>
    <div class="clearfix"></div>
</div>
  
<?php 
require_once '../../includes/footer.inc.html.php';
?>
