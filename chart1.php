<!DOCTYPE html>
 
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Pie Chart</title>
</head>

<body>

 <script>
	element.addEventListener("événement_sans_on_devant", fonction_a_executer, propagation_evenement_(booleen));
	element.attachEvent("évènement", fonction);
	
	function addEvent(obj, event, fct) {
		if (obj.attachEvent) //Est-ce IE ?
			obj.attachEvent("on" + event, fct); //Ne pas oublier le "on"
		else
			obj.addEventListener(event, fct, true);
	}
 </script>
 blabla
<?php

//connexion bdd
			$nom_du_serveur ="localhost";
			$nom_de_la_base ="moodle2";
			$nom_utilisateur ="root";
			$passe ="";
			
$dbhandle = mysqli_connect($nom_du_serveur,$nom_utilisateur,"",$nom_de_la_base) or die("Error " . mysqli_error($dbhandle)); 

//forme

$formes = "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `formes/non formes`='forme'" . mysqli_error($dbhandle); 		 
$result1 = mysqli_query($dbhandle, $formes); 	  
//$resultat=mysql_fetch_row($result1); 

$nonformes = "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `formes/non formes`='non forme'" . mysqli_error($dbhandle); 		 
$result2 = mysqli_query($dbhandle, $nonformes); 	  

$tot = "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `formes/non formes`='non forme' or `formes/non formes`='forme' " . mysqli_error($dbhandle); 		 
$result3 = mysqli_query($dbhandle, $tot); 

//enreg

$formesg = "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `enreg/nonenreg`='enreg'" . mysqli_error($dbhandle); 		 
$result1g = mysqli_query($dbhandle, $formesg); 	  

$nonformesg= "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `enreg/nonenreg`='non enreg'" . mysqli_error($dbhandle); 		 
$result2g = mysqli_query($dbhandle, $nonformesg); 	  

$totg = "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `enreg/nonenreg`='non enreg' or `enreg/nonenreg`='enreg' " . mysqli_error($dbhandle); 		 
$result3g = mysqli_query($dbhandle, $totg); 

//scan

$formesr = "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `scans`='reussi'" . mysqli_error($dbhandle); 		 
$result1r = mysqli_query($dbhandle, $formesr); 	  

$nonformesr= "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `scans`='echoue'" . mysqli_error($dbhandle); 		 
$result2r = mysqli_query($dbhandle, $nonformesr); 	  

$totr = "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `scans`='reussi' or `scans`='echoue' " . mysqli_error($dbhandle); 		 
$result3r = mysqli_query($dbhandle, $totr); 

//politiques

$formesp = "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `politiques`='en place'" . mysqli_error($dbhandle); 		 
$result1p = mysqli_query($dbhandle, $formesp); 	  

$nonformesp= "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `politiques`='pas en place'" . mysqli_error($dbhandle); 		 
$result2p = mysqli_query($dbhandle, $nonformesp); 	  

$totp = "SELECT COUNT(*) FROM mdl_crscanrequest WHERE `politiques`='en place' or `politiques`='pas en place' " . mysqli_error($dbhandle); 		 
$result3p = mysqli_query($dbhandle, $totp); 

$color1 = "#C8C7C7";

$color2 = "#7390A2";





//forme

while(($resultat = mysqli_fetch_array($result1)) and ($resultat2 = mysqli_fetch_array($result2)) and ($resultat3 = mysqli_fetch_array($result3)))  {	
$pourcent = number_format((($resultat[0]*100)/$resultat3[0]),2);
//echo $pourcent;
$pourcent2 = number_format((($resultat2[0]*100)/$resultat3[0]),2); 
//echo $pourcent2;
?>
<div  style="width:600px;border: 1px solid silver;border-radius: 15px;position:relative;float:left;margin-left:5%;">
<h3 style="margin-left:15px;color:black;">Formés / Non formés</h3>

    <script>
        function PieChart(canvasId, data) {
            // user defined properties
            this.canvas = document.getElementById(canvasId);
            this.data = data;
            // constants
            this.padding = 10;
            this.legendBorder = 0.5;
            this.pieBorder = 5;
            this.colorLabelSize = 20;
            this.borderColor = "#555";
            this.shadowColor = "#777";
            this.shadowBlur = 10;
            this.shadowX = 2;
            this.shadowY = 2;
            this.font = "14pt Calibri";
            // relationships
            this.context = this.canvas.getContext("2d");
            this.legendWidth = this.getLegendWidth();
            this.legendX = this.canvas.width - this.legendWidth;
            this.legendY = this.padding;
            this.pieAreaWidth = (this.canvas.width - this.legendWidth);
            this.pieAreaHeight = this.canvas.height;
            this.pieX = this.pieAreaWidth / 2;
            this.pieY = this.pieAreaHeight / 2;
            this.pieRadius = (Math.min(this.pieAreaWidth, this.pieAreaHeight) / 2) - (this.padding);
            // draw Pie Chart
            this.drawPieBorder();
            this.drawSlices();
            this.drawLegend();
        }
 
        PieChart.prototype.getLegendWidth = function () {
            this.context.font = this.font;
            var labelWidth = 0;
            for (var n = 0; n < this.data.length; n++) {
                var label = this.data[n].label;
                labelWidth = Math.max(labelWidth, this.context.measureText(label).width);
            }
            return labelWidth + (this.padding * 2) + this.legendBorder + this.colorLabelSize;
        };

        PieChart.prototype.drawPieBorder = function () {
            var context = this.context;
            context.save();
            context.fillStyle = "white";
            context.shadowColor = this.shadowColor;
            context.shadowBlur = this.shadowBlur;
            context.shadowOffsetX = this.shadowX;
            context.shadowOffsetY = this.shadowY;
            context.beginPath();
            context.arc(this.pieX, this.pieY, this.pieRadius + this.pieBorder, 0, Math.PI * 2, false);
            context.fill();
            context.closePath();
            context.restore();
        };
 
        PieChart.prototype.drawSlices = function () {
            var context = this.context;
            context.save();
            var total = this.getTotalValue();
            var startAngle = 0;
            for (var n = 0; n < this.data.length; n++) {
                var slice = this.data[n];
                // draw slice
                var sliceAngle = 2 * Math.PI * slice.value / total;
                var endAngle = startAngle + sliceAngle;
                context.beginPath();
                context.moveTo(this.pieX, this.pieY);
                context.arc(this.pieX, this.pieY, this.pieRadius, startAngle, endAngle, false);
                context.fillStyle = slice.color;
                context.fill();
                context.closePath();
                startAngle = endAngle;
            }
            context.restore();
        };
 
        PieChart.prototype.getTotalValue = function () {
            var data = this.data;
            var total = 0;
            for (var n = 0; n < data.length; n++) {
                total += data[n].value;
            }
            return total;
        };
 
        PieChart.prototype.drawLegend = function () {
            var context = this.context;
            context.save();
            var labelX = this.legendX;
            var labelY = this.legendY;
            context.strokeStyle = "black";
            context.lineWidth = this.legendBorder;
            context.font = this.font;
            context.textBaseline = "middle";
            for (var n = 0; n < this.data.length; n++) {
                var slice = this.data[n];
                // draw legend label
                context.beginPath();
                context.rect(labelX, labelY, this.colorLabelSize, this.colorLabelSize);
                context.closePath();
                context.fillStyle = slice.color;
                context.fill();
                context.stroke();
                context.fillStyle = "black";
                context.fillText(slice.label, labelX + this.colorLabelSize + this.padding, labelY + this.colorLabelSize / 2);
                labelY += this.colorLabelSize + this.padding;
            }
            context.restore();
        };

		function al1() { 
		//alert(1);  //Fonction qui devra être appelée à la place de window.onload
			//On stocke les fonctions dans l'array. Il commence à 0, et length donne l'indice du dernier élément + 1.
			//}
			//window.onload = function () {
            var data = [{
                label: "Formés (<?php echo $resultat[0]; ?>/<?php echo $resultat3[0]; ?>) : <?php echo $pourcent ?> %",
                value: <?php echo $resultat[0]; ?>,
                color:  "<?php echo $color1; ?>"
            }, {
                label: "Non formés (<?php echo $resultat2[0]; ?>/<?php echo $resultat3[0]; ?>) : <?php echo $pourcent2 ?> %",
                value: <?php echo $resultat2[0]; ?>,
                color: "<?php echo $color2; ?>"
            }];
            new PieChart("myCanvas", data);
		};
    </script>
    <canvas id="myCanvas" width="600" height="300" ></canvas>
<?php
//include 'forme.php';
}
 ?>	
</div>

<?php

//enregistrés

while(($resultatg = mysqli_fetch_array($result1g)) and ($resultat2g = mysqli_fetch_array($result2g)) and ($resultat3g = mysqli_fetch_array($result3g)))  {	
$pourcentg = number_format((($resultatg[0]*100)/$resultat3g[0]),2);
//echo $pourcent;
$pourcent2g = number_format((($resultat2g[0]*100)/$resultat3g[0]),2); 
//echo $pourcent2;
?>
<div  style="width:600px;border: 1px solid silver;border-radius: 15px;position:relative;margin-left:50%;">
<h3 style="margin-left:15px;color:black;">Enregistrés / Non enregistrés</h3>
   <script>
        function PieChart(canvasId, data1) {
            // user defined properties
            this.canvas = document.getElementById(canvasId);
            this.data1 = data1;
            // constants
            this.padding = 10;
            this.legendBorder = 0.5;
            this.pieBorder = 5;
            this.colorLabelSize = 20;
            this.borderColor = "#555";
            this.shadowColor = "#777";
            this.shadowBlur = 10;
            this.shadowX = 2;
            this.shadowY = 2;
            this.font = "14pt Calibri";
            // relationships
            this.context = this.canvas.getContext("2d");
            this.legendWidth = this.getLegendWidth();
            this.legendX = this.canvas.width - this.legendWidth;
            this.legendY = this.padding;
            this.pieAreaWidth = (this.canvas.width - this.legendWidth);
            this.pieAreaHeight = this.canvas.height;
            this.pieX = this.pieAreaWidth / 2;
            this.pieY = this.pieAreaHeight / 2;
            this.pieRadius = (Math.min(this.pieAreaWidth, this.pieAreaHeight) / 2) - (this.padding);
            // draw Pie Chart
            this.drawPieBorder();
            this.drawSlices();
            this.drawLegend();
        }
 
        PieChart.prototype.getLegendWidth = function () {
            this.context.font = this.font;
            var labelWidth = 0;
            for (var n = 0; n < this.data1.length; n++) {
                var label = this.data1[n].label;
                labelWidth = Math.max(labelWidth, this.context.measureText(label).width);
            }
            return labelWidth + (this.padding * 2) + this.legendBorder + this.colorLabelSize;
        };
 
        PieChart.prototype.drawPieBorder = function () {
            var context = this.context;
            context.save();
            context.fillStyle = "white";
            context.shadowColor = this.shadowColor;
            context.shadowBlur = this.shadowBlur;
            context.shadowOffsetX = this.shadowX;
            context.shadowOffsetY = this.shadowY;
            context.beginPath();
            context.arc(this.pieX, this.pieY, this.pieRadius + this.pieBorder, 0, Math.PI * 2, false);
            context.fill();
            context.closePath();
            context.restore();
        };
 
        PieChart.prototype.drawSlices = function () {
            var context = this.context;
            context.save();
            var total = this.getTotalValue();
            var startAngle = 0;
            for (var n = 0; n < this.data1.length; n++) {
                var slice = this.data1[n];
                // draw slice
                var sliceAngle = 2 * Math.PI * slice.value / total;
                var endAngle = startAngle + sliceAngle;
                context.beginPath();
                context.moveTo(this.pieX, this.pieY);
                context.arc(this.pieX, this.pieY, this.pieRadius, startAngle, endAngle, false);
                context.fillStyle = slice.color;
                context.fill();
                context.closePath();
                startAngle = endAngle;
            }
            context.restore();
        };
 
        PieChart.prototype.getTotalValue = function () {
            var data1 = this.data1;
            var total = 0;
            for (var n = 0; n < data1.length; n++) {
                total += data1[n].value;
            }
            return total;
        };
 
        PieChart.prototype.drawLegend = function () {
            var context = this.context;
            context.save();
            var labelX = this.legendX;
            var labelY = this.legendY;
            context.strokeStyle = "black";
            context.lineWidth = this.legendBorder;
            context.font = this.font;
            context.textBaseline = "middle";
            for (var n = 0; n < this.data1.length; n++) {
                var slice = this.data1[n];
                // draw legend label
                context.beginPath();
                context.rect(labelX, labelY, this.colorLabelSize, this.colorLabelSize);
                context.closePath();
                context.fillStyle = slice.color;
                context.fill();
                context.stroke();
                context.fillStyle = "black";
                context.fillText(slice.label, labelX + this.colorLabelSize + this.padding, labelY + this.colorLabelSize / 2);
                labelY += this.colorLabelSize + this.padding;
            }
            context.restore();
        };

     // window.onload = function () {
		function al2() { 
		//alert(2);  //Fonction qui devra être appelée à la place de window.onload
		 //On stocke les fonctions dans l'array. Il commence à 0, et length donne l'indice du dernier élément + 1.
            var data1 = [{
                label: "Enregistrés (<?php echo $resultatg[0]; ?>/<?php echo $resultat3g[0]; ?>) : <?php echo $pourcentg ?> %",
                value: <?php echo $resultatg[0]; ?>,
                color:  "<?php echo $color1; ?>"
            }, {
                label: "Non enregistrés  (<?php echo $resultat2g[0]; ?>/<?php echo $resultat3g[0]; ?>) : <?php echo $pourcent2g?> %",
                value: <?php echo $resultat2g[0]; ?>,
                color:  "<?php echo $color2; ?>"
            }];
            new PieChart("myCanvas2", data1);
		};
    </script>
    <canvas id="myCanvas2" width="600" height="300" ></canvas>
<?php
//include 'enreg.php';
}
?>
</div>

<?php

//scans

while(($resultatr = mysqli_fetch_array($result1r)) and ($resultat2r = mysqli_fetch_array($result2r)) and ($resultat3r = mysqli_fetch_array($result3r)))  {	
$pourcentr = number_format((($resultatr[0]*100)/$resultat3r[0]),2);
//echo $pourcent;
$pourcent2r = number_format((($resultat2r[0]*100)/$resultat3r[0]),2); 
//echo $pourcent2;
?>

<div  style="width:600px;border: 1px solid silver;border-radius: 15px;position:relative;float:left;margin-left:5%;">

<h3 style="margin-left:15px;color:black;">Scans réussis / échoués </h3>

   <script>
        function PieChart(canvasId, data1) {
            // user defined properties
            this.canvas = document.getElementById(canvasId);
            this.data1 = data1;
            // constants
            this.padding = 10;
            this.legendBorder = 0.5;
            this.pieBorder = 5;
            this.colorLabelSize = 20;
            this.borderColor = "#555";
            this.shadowColor = "#777";
            this.shadowBlur = 10;
            this.shadowX = 2;
            this.shadowY = 2;
            this.font = "14pt Calibri";
            // relationships
            this.context = this.canvas.getContext("2d");
            this.legendWidth = this.getLegendWidth();
            this.legendX = this.canvas.width - this.legendWidth;
            this.legendY = this.padding;
            this.pieAreaWidth = (this.canvas.width - this.legendWidth);
            this.pieAreaHeight = this.canvas.height;
            this.pieX = this.pieAreaWidth / 2;
            this.pieY = this.pieAreaHeight / 2;
            this.pieRadius = (Math.min(this.pieAreaWidth, this.pieAreaHeight) / 2) - (this.padding);
            // draw Pie Chart
            this.drawPieBorder();
            this.drawSlices();
            this.drawLegend();
        }
 
        PieChart.prototype.getLegendWidth = function () {
            this.context.font = this.font;
            var labelWidth = 0;
            for (var n = 0; n < this.data1.length; n++) {
                var label = this.data1[n].label;
                labelWidth = Math.max(labelWidth, this.context.measureText(label).width);
            }
            return labelWidth + (this.padding * 2) + this.legendBorder + this.colorLabelSize;
        };
 
        PieChart.prototype.drawPieBorder = function () {
            var context = this.context;
            context.save();
            context.fillStyle = "white";
            context.shadowColor = this.shadowColor;
            context.shadowBlur = this.shadowBlur;
            context.shadowOffsetX = this.shadowX;
            context.shadowOffsetY = this.shadowY;
            context.beginPath();
            context.arc(this.pieX, this.pieY, this.pieRadius + this.pieBorder, 0, Math.PI * 2, false);
            context.fill();
            context.closePath();
            context.restore();
        };
 
        PieChart.prototype.drawSlices = function () {
            var context = this.context;
            context.save();
            var total = this.getTotalValue();
            var startAngle = 0;
            for (var n = 0; n < this.data1.length; n++) {
                var slice = this.data1[n];
                // draw slice
                var sliceAngle = 2 * Math.PI * slice.value / total;
                var endAngle = startAngle + sliceAngle;
                context.beginPath();
                context.moveTo(this.pieX, this.pieY);
                context.arc(this.pieX, this.pieY, this.pieRadius, startAngle, endAngle, false);
                context.fillStyle = slice.color;
                context.fill();
                context.closePath();
                startAngle = endAngle;
            }
            context.restore();
        };
 
        PieChart.prototype.getTotalValue = function () {
            var data1 = this.data1;
            var total = 0;
            for (var n = 0; n < data1.length; n++) {
                total += data1[n].value;
            }
            return total;
        };
 
        PieChart.prototype.drawLegend = function () {
            var context = this.context;
            context.save();
            var labelX = this.legendX;
            var labelY = this.legendY;
            context.strokeStyle = "black";
            context.lineWidth = this.legendBorder;
            context.font = this.font;
            context.textBaseline = "middle";
            for (var n = 0; n < this.data1.length; n++) {
                var slice = this.data1[n];
                // draw legend label
                context.beginPath();
                context.rect(labelX, labelY, this.colorLabelSize, this.colorLabelSize);
                context.closePath();
                context.fillStyle = slice.color;
                context.fill();
                context.stroke();
                context.fillStyle = "black";
                context.fillText(slice.label, labelX + this.colorLabelSize + this.padding, labelY + this.colorLabelSize / 2);
                labelY += this.colorLabelSize + this.padding;
            }
            context.restore();
        };

     // window.onload = function () {
		function al3() { 
		//alert(2);  //Fonction qui devra être appelée à la place de window.onload
		 //On stocke les fonctions dans l'array. Il commence à 0, et length donne l'indice du dernier élément + 1.
            var data1 = [{
				  
				
                label: "Réussis (<?php echo $resultatr[0]; ?>/<?php echo $resultat3r[0]; ?>) : <?php echo $pourcentr ?> %",
                value: <?php echo $resultatr[0]; ?>,
                color:  "<?php echo $color1; ?>"
            }, {
                label: "Echoués  (<?php echo $resultat2r[0]; ?>/<?php echo $resultat3r[0]; ?>) : <?php echo $pourcent2r ?> %",
                value: <?php echo $resultat2r[0]; ?>,
                color:  "<?php echo $color2; ?>"
            }];
 
            new PieChart("myCanvas3", data1);
			
		};
		
		addEvent(window , "load", al1);
		addEvent(window , "load", al2);
		addEvent(window , "load", al3);
    </script>
    <canvas id="myCanvas3" width="600" height="300" ></canvas>
<?php
//include 'enreg.php';
}
?>

</div>

<?php

//politiques

while(($resultatp = mysqli_fetch_array($result1p)) and ($resultat2p= mysqli_fetch_array($result2p)) and ($resultat3p = mysqli_fetch_array($result3p)))  {	
$pourcentp = number_format((($resultatp[0]*100)/$resultat3p[0]),2);
//echo $pourcent;
$pourcent2p = number_format((($resultat2p[0]*100)/$resultat3p[0]),2); 
//echo $pourcent2;
?>

<div  style="width:600px;border: 1px solid silver;border-radius: 15px;position:relative;margin-left:50%;">

<h3 style="margin-left:15px;color:black;">Politiques en Place / Pas en Place </h3>

   <script>
        function PieChart(canvasId, data1) {
            // user defined properties
            this.canvas = document.getElementById(canvasId);
            this.data1 = data1;
            // constants
            this.padding = 10;
            this.legendBorder = 0.5;
            this.pieBorder = 5;
            this.colorLabelSize = 20;
            this.borderColor = "#555";
            this.shadowColor = "#777";
            this.shadowBlur = 10;
            this.shadowX = 2;
            this.shadowY = 2;
            this.font = "14pt Calibri";
            // relationships
            this.context = this.canvas.getContext("2d");
            this.legendWidth = this.getLegendWidth();
            this.legendX = this.canvas.width - this.legendWidth;
            this.legendY = this.padding;
            this.pieAreaWidth = (this.canvas.width - this.legendWidth);
            this.pieAreaHeight = this.canvas.height;
            this.pieX = this.pieAreaWidth / 2;
            this.pieY = this.pieAreaHeight / 2;
            this.pieRadius = (Math.min(this.pieAreaWidth, this.pieAreaHeight) / 2) - (this.padding);
            // draw Pie Chart
            this.drawPieBorder();
            this.drawSlices();
            this.drawLegend();
        }
 
        PieChart.prototype.getLegendWidth = function () {
            this.context.font = this.font;
            var labelWidth = 0;
            for (var n = 0; n < this.data1.length; n++) {
                var label = this.data1[n].label;
                labelWidth = Math.max(labelWidth, this.context.measureText(label).width);
            }
            return labelWidth + (this.padding * 2) + this.legendBorder + this.colorLabelSize;
        };
 
        PieChart.prototype.drawPieBorder = function () {
            var context = this.context;
            context.save();
            context.fillStyle = "white";
            context.shadowColor = this.shadowColor;
            context.shadowBlur = this.shadowBlur;
            context.shadowOffsetX = this.shadowX;
            context.shadowOffsetY = this.shadowY;
            context.beginPath();
            context.arc(this.pieX, this.pieY, this.pieRadius + this.pieBorder, 0, Math.PI * 2, false);
            context.fill();
            context.closePath();
        };
 
        PieChart.prototype.drawSlices = function () {
            var context = this.context;
            context.save();
            var total = this.getTotalValue();
            var startAngle = 0;
            for (var n = 0; n < this.data1.length; n++) {
                var slice = this.data1[n];
                // draw slice
                var sliceAngle = 2 * Math.PI * slice.value / total;
                var endAngle = startAngle + sliceAngle;
                context.beginPath();
                context.moveTo(this.pieX, this.pieY);
                context.arc(this.pieX, this.pieY, this.pieRadius, startAngle, endAngle, false);
                context.fillStyle = slice.color;
                context.fill();
                context.closePath();
                startAngle = endAngle;
            }
            context.restore();
        };
 
        PieChart.prototype.getTotalValue = function () {
            var data1 = this.data1;
            var total = 0;
            for (var n = 0; n < data1.length; n++) {
                total += data1[n].value;
            }
            return total;
        };
 
        PieChart.prototype.drawLegend = function () {
            var context = this.context;
            context.save();
            var labelX = this.legendX;
            var labelY = this.legendY;
            context.strokeStyle = "black";
            context.lineWidth = this.legendBorder;
            context.font = this.font;
            context.textBaseline = "middle";
            for (var n = 0; n < this.data1.length; n++) {
                var slice = this.data1[n];
                // draw legend label
                context.beginPath();
                context.rect(labelX, labelY, this.colorLabelSize, this.colorLabelSize);
                context.closePath();
                context.fillStyle = slice.color;
                context.fill();
                context.stroke();
                context.fillStyle = "black";
                context.fillText(slice.label, labelX + this.colorLabelSize + this.padding, labelY + this.colorLabelSize / 2);
                labelY += this.colorLabelSize + this.padding;
            }
            context.restore();
        };

     // window.onload = function () {
		function al4() { 
		//alert(4);  //Fonction qui devra être appelée à la place de window.onload
		 //On stocke les fonctions dans l'array. Il commence à 0, et length donne l'indice du dernier élément + 1.
            var data1 = [{
                label: "Politiques en Place (<?php echo $resultatp[0]; ?>/<?php echo $resultat3p[0]; ?>) : <?php echo $pourcentp ?> %",
                value: <?php echo $resultatp[0]; ?>,
                color:  "<?php echo $color1; ?>"
            }, {
                label: "Pas en Place  (<?php echo $resultat2p[0]; ?>/<?php echo $resultat3p[0]; ?>) : <?php echo $pourcent2p ?> %",
                value: <?php echo $resultat2p[0]; ?>,
                color:  "<?php echo $color2; ?>"
            }];
 
            new PieChart("myCanvas4", data1);
		};
		
		addEvent(window , "load", al1);
		addEvent(window , "load", al2);
		addEvent(window , "load", al3);
		addEvent(window , "load", al4);
    </script>
    <canvas id="myCanvas4" width="600" height="300" ></canvas>
<?php

//include 'enreg.php';
}
?>
</div>

    <script>
function lancer(fct) {
    addEvent(window, "load", fct);
};
    </script>

</body>
</html>