<?php

include_once '../../includes/magicquotes.inc.php';
include '../../includes/helpers.inc.php';

if (isset($_GET['add']))
{
  include '../../includes/db.inc.php';

  $pageTitle = 'Add Job';
  $headingTitle = 'Add Job';
  $action = 'addform';
  $name = '';
  $rate = '';
  $button = 'Add job';

  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
  include '../../includes/db.inc.php';

  $name = $_POST['name'];
  $rate = $_POST['rate'];
  
  $rate = preg_replace("/([^0-9\\.])/i", "", $rate);
  $validRate = isCurrency($rate);
  
  if (!empty($name) && !empty($rate) && $validRate)   
  {
     try
      {
        $sql = 'INSERT INTO job SET
            name = :name,
            rate = :rate';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $name);
        $s->bindValue(':rate', $rate);
        $s->execute();
      }
      catch (PDOException $e)
      {
        $error = 'Error adding submitted job.';
        include 'error.html.php';
        exit();
      }      
  } else
  {
      $errormsg = 'Job name and rate are required.';
      $pageTitle = 'Add Job';
      $headingTitle = 'Add Job';
      $action = 'addform';
      $id = '';
      $button = 'Add job';
      
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
    $sql = 'DELETE FROM job WHERE id = :id LIMIT 1';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error removing job from database.';
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
    $sql = 'SELECT * FROM job WHERE id = :id';
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

  $pageTitle = 'Edit Job';
  $headingTitle = 'Edit Job';
  $action = 'editform';
  $name = $row['name'];
  $rate = $row['rate'];
  $id = $row['id'];
  $button = 'Update job';

  include 'form.html.php';
  exit();
}

if (isset($_GET['editform']))
{
  include '../../includes/db.inc.php';

  $name = $_POST['name'];
  $rate = $_POST['rate'];
  $id = $_POST['id'];
  
  $rate = preg_replace("/([^0-9\\.])/i", "", $rate);
  
  $validRate = isCurrency($rate);

  if (!empty($name) && !empty($rate) && $validRate)
  {
      try
      {
        $sql = 'UPDATE job SET
            name = :name,
            rate = :rate
            WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $id);
        $s->bindValue(':name', $name);
        $s->bindValue(':rate', $rate);
        $s->execute();
      }
      catch (PDOException $e)
      {
        $error = 'Error updating submitted job.';
        include 'error.html.php';
        exit();
      }
  } else
  {
      $errormsg = 'Job name and rate are required.';
      $pageTitle = 'Edit Job';
      $headingTitle = 'Edit Job';
      $action = 'editform';
      $button = 'Edit job';

      include 'form.html.php';
      exit();
  }

  header('Location: .');
  exit();
}

// Get jobs list
include '../../includes/db.inc.php';

$jobs = getJobs();

include 'jobs.html.php';
