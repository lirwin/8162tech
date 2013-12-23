<?php 
$title = 'Manage Projects';
require_once '../../includes/header.inc.html.php';
?>
<div id="mainContent">
    <div class="span12">
        <h1>Manage Projects</h1> 
        
        <p><a class="btn-warning btn" href="?add">Add new project</a></p>
        
        <!--Output status messages -->
        <div id="status"></div>
        
        <table class="table table-striped table-bordered table-condensed table-hover">  
        <tr>
            <th>Project Number</th>
            <th>Project Name</th>
            <th>Project Leader</th>
            <th>Options</th>
        </tr> 
          
        <?php foreach ($projects as $project): ?>                   
            <tr>
                <td><?php htmlout($project['id']); ?></td>
                <td id='name'><?php htmlout($project['name']); ?></td>
                <td><?php htmlout($project['leaderFirstName'] .' '. ((!empty($project['leaderMiddleName'])) ? $project['leaderMiddleName'] . ' ': ''). $project['leaderLastName']); ?></td>
                <td>
                    <form action="?" method="post">
                      <div>
                        <input type="hidden" name="id" value="<?php
                            htmlout($project['id']); ?>">
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