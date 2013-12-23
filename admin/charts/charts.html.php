<?php 
include_once '../../includes/helpers.inc.php'; 
$title = 'Charts';
require_once '../../includes/header.inc.html.php';
?>
<div id="mainContent">
    <div class="span12">
        <h1>Charts</h1> 
        
        <!--Output status messages -->
        <div id="status"></div>
        
        <h2>Project Cost By Job Class</h2>
          
         <div id="projectDescriptions"></div>
      </div>
    <div class="clearfix"></div>
</div>

<!-- JQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
window.jQuery || document.write('<script src="../../js/vendor/jquery-1.9.1.min.js"><\/script>')
</script>

<script src="../../js/vendor/bootstrap.min.js"></script>

<!-- Validate Plugin -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
window.validator || document.write('<script src="../../js/vendor/jquery.validate.min.js"><\/script>')
</script>

<!-- Form Plugin -->
<script src="http://malsup.github.com/jquery.form.js"></script> 

<!-- script src="js/plugins.js"></script>
 -->
<script src="../../js/charts.js"></script>
</body>
</html>