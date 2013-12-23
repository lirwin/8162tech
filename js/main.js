$(function() {
  /* 
    * Delete button event handler
    * @projects.html.php, employees.html.php
    */ 
   $("input[value = 'Delete']").on("click", function(event){
      var project = $(this).parents("tbody"),
          employee = $(this).parents("tr"),
          empName, projName, projId, empId;
       
      projName = project.find("td#projName").text(); 
      empName = employee.children("td#empName").text();
        
      //if projName && empName then we are deleting an assignment      
      if (projName && empName) {
          projId = employee.find("input[name = 'projId']").val();
          empId = employee.find("input[name = 'empId']").val();
          if (confirm('Are you sure you want to delete ' + empName + ' from ' + projName + '?')) {
               $.post("index.php", { projId: projId, empId: empId, action: 'Delete'})
                    .done(function() {
                            location.reload();
                        });
                        
          }  
      //else we are deleting either a job, employee or project          
      } else {
        var parent = $(this).parents("tr"),
            id = parent.find("input[name = 'id']").val(),
            name = parent.children("td#name").text();
         
        if (confirm('Are you sure you want to delete ' + name + '?')) {
           $.post("index.php", { id: id, action: 'Delete'})
                .done(function() {
                        location.reload();
                    });
                    
        }           
      }
      return false; 
   });
 /*
  * job form validation
  * submit /jobs/form.html.php
  */
  $('#jobForm').validate(
    { 
        rules: {
            name: {
            minlength: 2,
            required: true
            },
            rate: {
            required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            $(element).text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
        } 
    });    
 /*
  * project form validation
  * submit /projects/form.html.php
  */
  $('#projectForm').validate(
    { 
        rules: {
            name: {
            minlength: 2,
            required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            $(element).text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
        } 
    }); 
 /*
  * assignment form validation
  * submit /assignments/form.html.php
  */
  $('#assignmentForm').validate(
    {
        rules: {
            projId: {
            required: true
            },
            empId: {
            required: true
            },        
            hours: {
            required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            $(element).text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
        }
    });     
 /*
  * employee form validation
  * submit /employees/form.html.php
  */
  $('#employeeForm').validate(
    {
        rules: {
            firstName: {
            minlength: 2,
            required: true
            },
            lastName: {
            minlength: 2,
            required: true
            },        
            jobId: {
            required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            $(element).text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
        }
    }); 
    
});