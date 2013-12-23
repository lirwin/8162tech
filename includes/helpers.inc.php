<?php
function isCurrency($number)
{
  return preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $number);
}
function is_exist($table, $data){
    global $pdo;
     
    $sql = "SELECT COUNT(*) FROM " . $table . " WHERE TRUE "  ;

    foreach ($data as $key => $val) :
    $sql .= " AND " . $key. "='" . $val . "'";
    endforeach;

    $result = $pdo->query($sql);    
    return ($result->fetchColumn() > 0) ? true: false;
}   
function getProjects($projectId)
{
  global $pdo;
    
  // Build the list of projects  
    try
    {
      $result = $pdo->query('SELECT id, name FROM project ORDER BY name');
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
        $projects[$i]['selected'] = ($projects[$i]['id'] == $projectId ) ? TRUE : FALSE;
        $i++;
    }  
  
  return $projects;
}

function getEmployees($employeeId)
{
  global $pdo;
    
  // Build the list of employees
  try
  {
    $result = $pdo->query('SELECT id, firstName, middleName, lastName FROM employee ORDER BY lastName');
  }
  catch (PDOException $e)
  {
    $error = 'Error fetching list of employees.';
    include 'error.html.php';
    exit();
  }

  foreach ($result as $row)
  {
    $employees[] = array(
      'id' => $row['id'],
      'firstName' => $row['firstName'],
      'middleName' => $row['middleName'],
      'lastName' => $row['lastName'],
      'selected' => ($row['id'] == $employeeId) ? TRUE : FALSE);
  }    
  return $employees;
}

function getJobs($jobId)
{  
  global $pdo;
  
  // Build the list of jobs
  try
  {
    $result = $pdo->query('SELECT * FROM job ORDER BY name');
  }
  catch (PDOException $e)
  {
    $error = 'Error fetching list of jobs.';
    include 'error.html.php';
    exit();
  }

  foreach ($result as $row)
  {
    $jobs[] = array(
      'id' => $row['id'],
      'name' => $row['name'],
      'rate' => $row['rate'],
      'selected' => ($row['id'] == $jobId) ? TRUE : FALSE);
  }    
  return $jobs;
}

function html($text)
{
  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function htmlout($text)
{
  echo html($text);
}

function markdown2html($text)
{
  $text = html($text);

  // strong emphasis
  $text = preg_replace('/__(.+?)__/s', '<strong>$1</strong>', $text);
  $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);

  // emphasis
  $text = preg_replace('/_([^_]+)_/', '<em>$1</em>', $text);
  $text = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $text);

  // Convert Windows (\r\n) to Unix (\n)
  $text = str_replace("\r\n", "\n", $text);
  // Convert Macintosh (\r) to Unix (\n)
  $text = str_replace("\r", "\n", $text);

  // Paragraphs
  $text = '<p>' . str_replace("\n\n", '</p><p>', $text) . '</p>';
  // Line breaks
  $text = str_replace("\n", '<br>', $text);

  // [linked text](link URL)
  $text = preg_replace(
      '/\[([^\]]+)]\(([-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\)/i',
      '<a href="$2">$1</a>', $text);

  return $text;
}

function markdownout($text)
{
  echo markdown2html($text);
}
