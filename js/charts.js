$(function() {  
    
   function getProjectData() {
       var projectData = [];
       
        $.ajax({
            url: "projectData.php",
            dataType: "json",
            async: false
        }).done(function(data){
                projectData = data;
            });
        return projectData;
   }   

    var projectChart = null;
    var projectCtx = null;

    function numberWithCommas(n) {
        var parts=n.toString().split(".");
        return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
    }

    function drawChart(forWhichProject) {
        drawBackground();
        drawLabels(forWhichProject);
        drawProjectData(forWhichProject);
    }

    function drawBackground() {
        var x;
        
        projectCtx.save();

        // fill in the chart background
        projectCtx.fillStyle = "#e1d8b9";
        projectCtx.fillRect(0,0,projectCtx.canvas.width,projectCtx.canvas.height);

        // create the graph area
        projectCtx.strokeStyle = "#252525";
        projectCtx.strokeRect(300, 100, 780, 350);

        // draw the chart lines
        projectCtx.strokeStyle = "#989898";
        for (x = 300; x < 1100; x += 20) {
            projectCtx.beginPath();
            projectCtx.moveTo(x, 100);
            projectCtx.lineTo(x, 450);
            projectCtx.stroke();
        }
        
        projectCtx.restore();
    }

    function drawLabels(forWhichProject) {
        var i;
        
        projectCtx.save();

        // draw project name
        projectCtx.font = "24pt Arial";
        projectCtx.fillStyle = "#3C6B92";
        projectCtx.fillText("Project Name: " + projectData[forWhichProject].name, 20, 65);

        // draw the labels
        projectCtx.font = "20pt Arial";
        projectCtx.fillStyle = "#3C6B92";
        
        for (i = 0, labelY = 155; i < projectData[forWhichProject].jobs.length; i++){
            projectCtx.fillText(projectData[forWhichProject].jobs[i].name, 20, labelY);
            labelY += 55;
        }

        projectCtx.restore();
    }

    function drawProjectData(forWhichProject) {
        var i, totalCharge = 0;
       
        projectCtx.save();

        projectCtx.strokeStyle = "#606060";
        projectCtx.fillStyle = "#f7f700";
        // draw charge
        for (i=0, positionY = 130; i < projectData[forWhichProject].jobs.length; i++){
            projectCtx.fillRect(300, positionY, Math.round(projectData[forWhichProject].jobs[i].charge/8.00), 30);
            projectCtx.strokeRect(300, positionY, Math.round(projectData[forWhichProject].jobs[i].charge/8.00), 30);
            projectCtx.font = "12pt Arial";
            projectCtx.fillStyle = "#3C6B92";
            projectCtx.fillText("$" + numberWithCommas(projectData[forWhichProject].jobs[i].charge.toFixed(2)), 310, positionY + 20);
            positionY += 55;
            projectCtx.fillStyle = "#f7f700";
            totalCharge += projectData[forWhichProject].jobs[i].charge;
        }
        projectCtx.font = "20pt Arial";
        projectCtx.fillStyle = "#3C6B92";
        projectCtx.fillText("Total Cost: $" + numberWithCommas(totalCharge.toFixed(2)), 20, positionY + 40);
        projectCtx.restore();
    }
      
 
     
 /*
  *  draw chart using HTML5 canvas
  *  /charts/charts.html.php
  */
    var projects = '<p>Choose a project: <select id="projectSelector">';
    var projectData = getProjectData();
    var i;
        
    for (i=0; i < projectData.length; i++){
        projects += '<option value="' + projectData[i].name + '">' + projectData[i].name + '</option> ';
    }
    projects += '</select></p><canvas id="projectFinder" width="1100" height="500" style="border: 1px solid"></canvas>';
    $("#projectDescriptions").append(projects);
    
    projectChart = document.getElementById("projectFinder");
    projectCtx = projectChart.getContext("2d");

    $("#projectSelector").bind("change", function () { drawChart(this.selectedIndex) });
    
    drawChart(0); 
}); 