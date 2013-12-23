<?php 
include_once '../includes/helpers.inc.php'; 
$title = '8162 Technologists Group Management System';
require_once '../includes/header.inc.html.php';
?>

<div id="mainContent">
    <div class="span12">

        <h1>8162 Technologists Group Management System</h1> 
        <div class="row-fluid">
            <ul class="thumbnails">
              <li class="span4">
                <div class="thumbnail">
                  <a href="./jobs" class="thumbnail large">
                      <img src="../images/job.png" alt="Jobs">
                      <div class="caption">
                        <h3>Jobs</h3>
                        <p>Add, Update and Delete Jobs.</p>
                      </div>                  
                  </a>
                </div>
              </li>
              <li class="span4">
                <div class="thumbnail">
                  <a href="./employees" class="thumbnail large">
                      <img src="../images/team.png" alt="Employees">
                      <div class="caption">
                        <h3>Employees</h3>
                        <p>Add, Update and Delete Employees.</p>
                      </div>                  
                  </a>
                </div>
              </li>
              <li class="span4">
                <div class="thumbnail">
                  <a href="./projects" class="thumbnail large">
                      <img src="../images/project.png" alt="Projects">
                      <div class="caption">
                        <h3>Projects</h3>
                        <p>Add, Update and Delete Projects.</p>
                      </div>
                  </a>
                </div>
              </li>
            </ul>
            <ul class="thumbnails">
              <li class="span4">
                <div class="thumbnail">
                  <a href="./assignments" class="thumbnail large">
                      <img src="../images/assignment.png" alt="Assignments">
                      <div class="caption">
                        <h3>Assignments</h3>
                        <p>Add, Update and Delete Assignments.</p>
                      </div>
                  </a>
                </div>
              </li>
              <li class="span4">
                <div class="thumbnail">
                  <a href="./reports" class="thumbnail large">
                      <img src="../images/report.png" alt="Reports">
                      <div class="caption">
                        <h3>Reports</h3>
                        <p>View Reports.</p>
                      </div>
                  </a>
                </div>
              </li>
              <li class="span4">
                <div class="thumbnail">
                  <a href="./charts" class="thumbnail large">
                      <img src="../images/chart.png" alt="Charts">
                      <div class="caption">
                        <h3>Charts</h3>
                        <p>View Charts.</p>
                      </div>
                  </a>
                </div>
              </li> 
            </ul>   
        </div>
    </div>
    <div class="clearfix"></div>
</div>
  
<?php 
require_once '../includes/footer.inc.html.php';
?>