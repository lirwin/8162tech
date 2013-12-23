<?php
include_once '../../includes/magicquotes.inc.php';
include '../../includes/helpers.inc.php';


if (isset($_GET['add']))
{
  include '../../includes/db.inc.php';

  $pageTitle = 'Add Project';
  $headingTitle = 'Add Project';
  $action = 'addform';
  $name = '';
  $leaderFirstName = '';
  $leaderMiddleName = '';
  $leaderLastName = '';
  $id = '';
  $button = 'Add project';

  $employees = getEmployees();

  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
  include '../../includes/db.inc.php';

  $name = $_POST['name'];
  $leaderId = $_POST['leaderId'];
  if (empty($leaderId)) {
      $leaderId = NULL;
  }
   
  if (! empty($name))
  {
     try
      {
        $sql = 'INSERT INTO project SET
            name = :name,
            leaderId = :leaderId';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $name);
        $s->bindValue(':leaderId', $leaderId);
        $s->execute();
      }
      catch (PDOException $e)
      {
        $error = 'Error adding submitted project.';
        include 'error.html.php';
        exit();
      }      
  } else
  {
      $errormsg = 'Project name is required.';
      $pageTitle = 'Add Project';
      $headingTitle = 'Add Project';
      $action = 'addform';
      $id = '';
      $button = 'Add project';
      
      $employees = getEmployees();

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
    $sql = 'DELETE FROM project WHERE id = :id LIMIT 1';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error removing project from database.';
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
    $sql = 'SELECT * FROM project WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error fetching project details.';
    include 'error.html.php';
    exit();
  }

  $row = $s->fetch();

  $pageTitle = 'Edit Project';
  $headingTitle = 'Edit Project';
  $action = 'editform';
  $name = $row['name'];
  $id = $row['id'];
  $leaderId = $row['leaderId'];
  $button = 'Update project';

  $employees = getEmployees($leaderId);

  include 'form.html.php';
  exit();
}

if (isset($_GET['editform']))
{
  include '../../includes/db.inc.php';

  $name = $_POST['name'];
  $leaderId = $_POST['leaderId'];
  $id = $_POST['id'];
  
  if (empty($leaderId))  
  {
      $leaderId = NULL;
  } 
  if (! empty($name))
  {
      try
      {
        $sql = 'UPDATE project SET
            name = :name,
            leaderId = :leaderId
            WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $id);
        $s->bindValue(':name', $name);
        $s->bindValue(':leaderId', $leaderId);
        $s->execute();
      }
      catch (PDOException $e)
      {
        $error = 'Error updating submitted project.';
        include 'error.html.php';
        exit();
      }
  } else
  {
      $errormsg = 'Project name is required.';
      $pageTitle = 'Edit Project';
      $headingTitle = 'Edit Project';
      $action = 'editform';
      $button = 'Edit project';
      
      $employees = getEmployees($leaderId);

      include 'form.html.php';
      exit();
  }
 
  header('Location: .');
  exit();
}

include '../../includes/db.inc.php';

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

foreach ($result as $row)
{
  $projects[] = array('id' => $row['id'], 'name' => $row['name'], 'leaderFirstName' => $row['leaderFirstName'], 
  'leaderMiddleName' => $row['leaderMiddleName'], 'leaderLastName' => $row['leaderLastName']);
}

include 'projects.html.php';
