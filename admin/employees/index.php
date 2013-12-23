<?php

include_once '../../includes/magicquotes.inc.php';
include '../../includes/helpers.inc.php';


if (isset($_GET['add']))
{
  include '../../includes/db.inc.php';

  $pageTitle = 'Add Employee';
  $headingTitle = 'Add Employee';
  $action = 'addform';
  $firstName = '';
  $middleName = '';
  $lastName = '';
  $id = '';
  $button = 'Add employee';

  $jobs = getJobs();

  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
  include '../../includes/db.inc.php';

  $firstName = $_POST['firstName'];
  $middleName = $_POST['middleName'];
  $lastName = $_POST['lastName'];
  $jobId = $_POST['jobId'];
   
  if (empty($middleName))  
  {
      $middleName = NULL;
  } 
  if (! empty($firstName) && ! empty($lastName) && ! empty($jobId))
  {
     try
      {
        $sql = 'INSERT INTO employee SET
            firstName = :firstName,
            middleName = :middleName,
            lastName = :lastName,
            jobId = :jobId';
        $s = $pdo->prepare($sql);
        $s->bindValue(':firstName', $firstName);
        $s->bindValue(':middleName', $middleName);
        $s->bindValue(':lastName', $lastName);
        $s->bindValue(':jobId', $jobId);
        $s->execute();
      }
      catch (PDOException $e)
      {
        $error = 'Error adding submitted employee.';
        include 'error.html.php';
        exit();
      }      
  } else
  {
      $errormsg = 'First Name, Last Name, and Job are required.';
      $pageTitle = 'Add Employee';
      $headingTitle = 'Add Employee';
      $action = 'addform';
      $id = '';
      $button = 'Add employee';
      
      $jobs = getJobs();

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
    $sql = 'DELETE FROM employee WHERE id = :id LIMIT 1';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error removing employee from database.';
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
    $sql = 'SELECT * FROM employee WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error fetching employee details.';
    include 'error.html.php';
    exit();
  }

  $row = $s->fetch();

  $pageTitle = 'Edit Employee';
  $headingTitle = 'Edit Employee';
  $action = 'editform';
  $firstName = $row['firstName'];
  $middleName = $row['middleName'];
  $lastName = $row['lastName'];
  $id = $row['id'];
  $jobId = $row['jobId'];
  $button = 'Update employee';

  $jobs = getJobs($jobId);

  include 'form.html.php';
  exit();
}

if (isset($_GET['editform']))
{
  include '../../includes/db.inc.php';

  $firstName = $_POST['firstName'];
  $middleName = $_POST['middleName'];
  $lastName = $_POST['lastName'];
  $jobId = $_POST['jobId'];
  $id = $_POST['id'];
  
  if (empty($middleName))  
  {
      $middleName = NULL;
  } 
  if (! empty($firstName) && ! empty($lastName) && ! empty($jobId))
  {
      try
      {
        $sql = 'UPDATE employee SET
            firstName = :firstName,
            middleName = :middleName,
            lastName = :lastName,
            jobId = :jobId
            WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $id);
        $s->bindValue(':firstName', $firstName);
        $s->bindValue(':middleName', $middleName);
        $s->bindValue(':lastName', $lastName);
        $s->bindValue(':jobId', $jobId);
        $s->execute();
      }
      catch (PDOException $e)
      {
        $error = 'Error updating submitted employee.';
        include 'error.html.php';
        exit();
      }
  } else
  {
      $errormsg = 'First Name, Last Name, and Job are required.';
      $pageTitle = 'Edit Employee';
      $headingTitle = 'Edit Employee';
      $action = 'editform';
      $button = 'Edit employee';
      
      $jobs = getJobs($jobId);

      include 'form.html.php';
      exit();
  }
 
  header('Location: .');
  exit();
}

// Display employee list
include '../../includes/db.inc.php';

try
{
  $result = $pdo->query(
  'SELECT employee.id, employee.firstName, employee.middleName, employee.lastName, job.name as class FROM employee 
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

include 'employees.html.php';
