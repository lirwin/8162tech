<?php

include_once '../../includes/magicquotes.inc.php';
include '../../includes/db.inc.php';

try
{
  $sql = $pdo->prepare(
  'CREATE OR REPLACE VIEW v AS
    SELECT project.id, project.name, employee.id as empId,
      projHours.hours, job.name as class, job.rate, (rate * hours) AS charge FROM employee
      LEFT JOIN projHours 
      ON projHours.empId = employee.id
      INNER JOIN project
      ON projHours.projId = project.id
      INNER JOIN job
      ON job.id = employee.jobId
      ORDER BY project.id;'
  );
  $sql->execute(); 
  $sql = $pdo->prepare(
  'SELECT id, name, class, SUM(charge) AS charge FROM v GROUP BY id, class;'
  );
  $sql->execute(); 
}
catch (PDOException $e)
{
  $error = 'Error fetching project data from database!';
  include 'error.html.php';
  exit();
} 

$assignments = array();

for ($i = 0, $row = $sql->fetch(); $row == TRUE ;$i++)  {
    $j = 0;
    $currentId = $row['id'];
    (object)$assignments[$i];
    $assignments[$i]['name'] = $row['name'];
    while ($row['id'] == $currentId) {
        (object)$assignments[$i]['jobs'][$j];
        $assignments[$i]['jobs'][$j]['name'] = $row['class'];
        $assignments[$i]['jobs'][$j]['charge'] = (float)$row['charge'];
        $j++;
        $row = $sql->fetch();
    } 
}

echo json_encode($assignments);