<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title ?></title>
<link rel="stylesheet" type="text/css" href="../../css/normalize.css">
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../css/main.css">
<link rel="stylesheet" type="text/css" href="../../css/bootstrap-responsive.css">
</head>
<body> 
        
<div class="navbar">
  <div class="navbar-inner">
    <ul class="nav">
        <li class = "<?php echo ($_SERVER['PHP_SELF'] == '/8162tech/admin/index.php') ? 'active' : '' ; ?>">
        <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/8162tech/admin/'?>">Home</a></li>
        <li class = "<?php echo ($_SERVER['PHP_SELF'] == '/8162tech/admin/jobs/index.php') ? 'active' : '' ; ?>">
        <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/8162tech/admin/jobs'?>">Jobs</a></li>
        <li class = "<?php echo ($_SERVER['PHP_SELF'] == '/8162tech/admin/employees/index.php') ? 'active' : '' ; ?>">
        <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/8162tech/admin/employees'?>">Employees</a></li>
        <li class = "<?php echo ($_SERVER['PHP_SELF'] == '/8162tech/admin/projects/index.php') ? 'active' : '' ; ?>">
        <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/8162tech/admin/projects'?>">Projects</a></li>
        <li class = "<?php echo ($_SERVER['PHP_SELF'] == '/8162tech/admin/assignments/index.php') ? 'active' : '' ; ?>">
        <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/8162tech/admin/assignments'?>">Assignments</a></li>
        <li class = "<?php echo ($_SERVER['PHP_SELF'] == '/8162tech/admin/reports/index.php') ? 'active' : '' ; ?>">
        <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/8162tech/admin/reports'?>">Reports</a></li>
        <li class = "<?php echo ($_SERVER['PHP_SELF'] == '/8162tech/admin/charts/index.php') ? 'active' : '' ; ?>">
        <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/8162tech/admin/charts'?>">Charts</a></li> 
     </ul>
  </div>
</div>