<?php
include_once '../../includes/magicquotes.inc.php';
include '../../includes/helpers.inc.php';


include '../../includes/db.inc.php';
// Create employees list
try
{
  $result = $pdo->query(
  'SELECT employee.id, employee.firstName, employee.middleName, employee.lastName, job.name as class, job.rate as chg FROM employee 
  LEFT JOIN job
  ON employee.jobID = job.id
  ORDER BY employee.lastName'
  );
}
catch (PDOException $e)
{
  $error = 'Error fetching employees from the database!';
  include 'error.html.php';
  exit();
}

$employees = array();
$i = 0;
foreach ($result as $row)  {
    foreach ($row as $key => $value) {
                $employees[$i][$key] = $value;
     } 
    $i++;
}

// Create projects list
try
{
  $result = $pdo->query(
  'SELECT project.id, project.name, employee.firstName as leaderFirstName, employee.middleName as leaderMiddleName, employee.lastName as leaderLastName FROM project
  LEFT JOIN employee
  ON project.leaderID = employee.id
  GROUP BY project.name'
  );
}
catch (PDOException $e)
{
  $error = 'Error fetching projects from database!';
  include 'error.html.php';
  exit();
}

$projects = array();
$i = 0;
foreach ($result as $row)  {
    foreach ($row as $key => $value) {
                $projects[$i][$key] = $value;
     } 
    $i++;
}

// Create assignments list
try
{
  $sql = $pdo->prepare(
  'SELECT project.id, project.name, project.leaderId, employee.id as empId, employee.firstName, employee.middleName, employee.lastName,
   projHours.hours, job.name as class, job.rate FROM employee
  LEFT JOIN projHours 
  ON projHours.empId = employee.id
  INNER JOIN project
  ON projHours.projId = project.id
  INNER JOIN job
  ON job.id = employee.jobId
  ORDER BY project.name, employee.lastName'
  );
  $sql->execute(); 
}
catch (PDOException $e)
{
  $error = 'Error fetching assignments from database!';
  include 'error.html.php';
  exit();
}

$assignments = array();
$projectsTotal = 0;
for ($i = 0, $row = $sql->fetch(); $row == TRUE ;$i++)  {
    $j = 0;
    $currentId = $row['id'];
    $assignments[$i]['id'] = $currentId;
    $assignments[$i]['name'] = $row['name'];
    $assignments[$i]['leaderId'] = $row['leaderId'];
    $assignments[$i]['total'] = 0;
    while ($row['id'] == $currentId) {
        $assignments[$i]['employees'][$j]['id'] = $row['empId'];
        $assignments[$i]['employees'][$j]['firstName'] = $row['firstName'];
        $assignments[$i]['employees'][$j]['middleName'] = $row['middleName'];
        $assignments[$i]['employees'][$j]['lastName'] = $row['lastName'];
        $assignments[$i]['employees'][$j]['class'] = $row['class'];
        $assignments[$i]['employees'][$j]['rate'] = $row['rate'];
        $assignments[$i]['employees'][$j]['hours'] = $row['hours'];
        $assignments[$i]['employees'][$j]['charge'] = $row['rate'] * $row['hours'];
        $assignments[$i]['total'] += $row['rate'] * $row['hours']; 
        $j++;
        $row = $sql->fetch();
    } 
    $projectsTotal += $assignments[$i]['total'];
}

include 'reports.html.php';
