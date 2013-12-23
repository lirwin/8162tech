<?php 
include_once '../../includes/helpers.inc.php'; 
$title = 'Manage Jobs';
require_once '../../includes/header.inc.html.php';
?>

<div id="mainContent">
    <div class="span12">
        <h1>Manage Jobs</h1> 
        
        <p><a class="btn-warning btn" href="?add">Add new job</a></p>
        
        <!--Output status messages -->
        <div id="status"></div>
        
        <table class="table table-striped table-bordered table-condensed table-hover">  
        <tr>
            <th>Job Name</th>
            <th>Job Rate</th>
            <th>Options</th>
        </tr> 
          
        <?php foreach ($jobs as $job): ?>                   
            <tr>
                <td id='name'><?php htmlout($job['name']); ?></td>
                <td><?php htmlout('$'.$job['rate']); ?></td>
                <td>
                    <form action="?" method="post">
                      <div>
                        <input type="hidden" name="id" value="<?php
                            htmlout($job['id']); ?>">
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