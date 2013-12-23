<?php

include_once '../../includes/magicquotes.inc.php';
include_once '../../includes/helpers.inc.php';

if (isset($_GET['add']))
{
    include '../../includes/db.inc.php';
     
    $pageTitle = 'Add Assignment';
    $headingTitle = 'Add Assignment';
    $action = 'addform';
    $id = '';
    $empId = '';
    $hours = '';
    $button = 'Add assignment';

    //Create employees list
    $employees = getEmployees();

    // Create projects list
    $projects = getProjects();
    
    include 'form.html.php';
    exit();
}

if (isset($_GET['addform']))
{
  include '../../includes/db.inc.php';

  $projId = $_POST['projId'];
  $empId = $_POST['empId'];
  $hours = $_POST['hours'];
 
// Data array for checking duplicate in projHours table
    $data = array('projId'=>$projId,'empId'=>$empId);

  if (!empty($projId) && !empty($empId) && !empty($hours) && !is_exist('projHours',$data))   
  {
     try
      {
        $sql = 'INSERT INTO projHours SET
            projId = :projId,
            empId = :empId,
            hours = :hours';
        $s = $pdo->prepare($sql);
        $s->bindValue(':projId', $projId);
        $s->bindValue(':empId', $empId);
        $s->bindValue(':hours', $hours);
        $s->execute();
      }
      catch (PDOException $e)
      {
        $error = 'Error adding submitted assignment.';
        include 'error.html.php';
        exit();
      }      
  } else {
    if (is_exist('projHours',$data)) {
       $errormsg = 'That assignment already exists.';
    } else {
      $errormsg = 'Project name, employee name and hours are required.';
    }
    $pageTitle = 'Add Assignment';
    $headingTitle = 'Add Assignment';
    $action = 'addform';
    $button = 'Add assignment';
    //Create employees list
    $employees = getEmployees($empId);

    // Create projects list
    $projects = getProjects($projId);
    
    include 'form.html.php';
    exit();  
  }
 
  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{
  include '../../includes/db.inc.php';

  try
  {
    $sql = 'DELETE FROM projHours WHERE projId = :projId AND empId = :empId LIMIT 1';
    $s = $pdo->prepare($sql);
    $s->bindValue(':projId', $_POST['projId']);
    $s->bindValue(':empId', $_POST['empId']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error removing assignment from database.';
    include 'error.html.php';
    exit();
  }

  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit')
{
  include '../../includes/db.inc.php';

  try
  {
    $sql = 'SELECT * FROM employee WHERE id = :empId';
    $s = $pdo->prepare($sql);
    $s->bindValue(':empId', $_POST['empId']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error fetching employee details.';
    include 'error.html.php';
    exit();
  }

    $row = $s->fetch();
    $empName = $row['firstName'].' '.$row['middleName'].' '.$row['lastName'];
    
  try
  {
    $sql = 'SELECT name FROM project WHERE id = :projId';
    $s = $pdo->prepare($sql);
    $s->bindValue(':projId', $_POST['projId']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error fetching project details.';
    include 'error.html.php';
    exit();
  }

    $row = $s->fetch();
    $projName = $row['name'];    
    
    $pageTitle = 'Edit Assignment';
    $headingTitle = 'Edit Assignment';
    $action = 'editform';
    $button = 'Edit assignment';
 
    $projId = $_POST['projId'];
    $empId = $_POST['empId'];
    $hours = $_POST['hours'];
    $button = 'Update assignment';

  include 'form.html.php';
  exit();
}

if (isset($_GET['editform']))
{
  include '../../includes/db.inc.php';

  $projId = $_POST['projId'];
  $projName = $_POST['projName'];
  $empId = $_POST['empId'];
  $empName = $_POST['empName'];
  $hours = $_POST['hours'];
 
  if (!empty($projId) && !empty($empId) && !empty($hours) )   
  {
     try
      {
        $sql = 'UPDATE projHours SET
            hours = :hours
            WHERE projId = :projId AND empId = :empId';
        $s = $pdo->prepare($sql);
        $s->bindValue(':projId', $projId);
        $s->bindValue(':empId', $empId);
        $s->bindValue(':hours', $hours);
        $s->execute();
      }
      catch (PDOException $e)
      {
        $error = 'Error updating submitted assignment.';
        include 'error.html.php';
        exit();
      }      
  } else {
    $errormsg = 'Hours required.';
    $pageTitle = 'Edit Assignment';
    $headingTitle = 'Edit Assignment';
    $action = 'editform';
    $button = 'Edit assignment';
    
    include 'form.html.php';
    exit();  
  }
 
  header('Location: .');
  exit();
}

// Create assignments list
include '../../includes/db.inc.php';

try
{
  $sql = $pdo->prepare(
  'SELECT project.id, project.name, employee.id as empId, employee.firstName, employee.middleName, employee.lastName,
   projHours.hours FROM employee
  LEFT JOIN projHours 
  ON projHours.empId = employee.id
  INNER JOIN project
  ON projHours.projId = project.id
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
$j = 0;
for ($i = 0, $row = $sql->fetch(); $row == TRUE ;$i++)  {
    $currentId = $row['id'];
    $assignments[$i]['id'] = $currentId;
    $assignments[$i]['name'] = $row['name'];
    while ($row['id'] == $currentId) {
        $assignments[$i]['employees'][$j]['id'] = $row['empId'];
        $assignments[$i]['employees'][$j]['firstName'] = $row['firstName'];
        $assignments[$i]['employees'][$j]['middleName'] = $row['middleName'];
        $assignments[$i]['employees'][$j]['lastName'] = $row['lastName'];
        $assignments[$i]['employees'][$j]['hours'] = $row['hours'];
        $j++;
        $row = $sql->fetch();
    } 
}

include 'assignments.html.php';