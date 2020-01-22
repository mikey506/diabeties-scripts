<html>
<head>

<style>
table, th, td {
  border: 1px solid black;
}
</style>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>BGL Correction & Meal Calculations + Entry Logger (Serverside) </title>
<script> 
        $(document).ready(function() { 
            $("#submit").click(function() { 
                alert($("#myselection").val()); 
            }); 
        }); 
    </script> 
<script>

function calc(){
var bg=document.getElementById('bg').value;
var carbs=document.getElementById('carbs').value;
var correction=document.getElementById('correction').value;
var target=document.getElementById('target').value;
var carbratio=document.getElementById('carbratio').value;
var mealinfostr=document.getElementById('mealinfo').value;

// the 16 is correction factor and 10 is is BG target this can be changed as needed:
// For adults 5-8 BGL is a good range to have blood sugar levels:
// Change the range (10) and correction factor of (16) as needed
// carbratio can be adjusted to suit needs

var carbcorrect= carbs / carbratio;

// This here is a feature that endo wanted, any BGL below 10 would leave that calculation out
// when adding up the total amount for units. Without this correction would be negative which
// we were told to avoid working with.

var correct=((bg - target) / correction);

if (bg < 10) { 
  var correct=0; 
}
var units= correct + carbcorrect;
var formulas= '(BG) - ' + target + ' / ' + correction + ' = _____ <br> (Carbs) / ' + carbratio + ' = _______ </b>';
document.getElementById('result').innerHTML=units;
document.getElementById('result2').innerHTML=correct;
document.getElementById('result3').innerHTML=carbcorrect;
document.getElementById('result4').innerHTML=mealinfostr;
document.getElementById('result5').innerHTML=bg;
document.getElementById('result6').innerHTML=formulas;
return false
}

function setValue(){
var bg=document.getElementById('bg').value;
var carbs=document.getElementById('carbs').value;
var correction=document.getElementById('correction').value;
var target=document.getElementById('target').value;
var carbratio=document.getElementById('carbratio').value;
var mealinfostr=document.getElementById('mealinfo').value;
var carbcorrect= carbs / carbratio;
var correct=((bg - target) / correction);
var units= correct + carbcorrect;

  var units= correct + carbcorrect;
  var total = correct + carbcorrect + units;
  var element = document.getElementById("total");
  var theDate = new Date();
  element.value = '<font size="1"><br>Date: <b>' + theDate + '</b> / BG Reading:<b> ' + bg + ' </b> / Carbs Given: <b>' +  carbs + '</b> / BG Correct:<b> ' + correct + '</b> / CarbCorrect:<b> ' + carbcorrect + '</b> / Total Units:<b> ' + units + '</b> / Meal/Correction Info: <b>' + mealinfostr + ' </b><br></font>';
  element.form.submit();
}
</script>

</head>
<body><center><br><br>
<form>
<input type="hidden" name="output" value="">
<p>BGL Correct  <input type="text" id="correction" value="16" size="2"><br>
BGL Target <input type="text" id="target" value="10" size="2"><br>
Carb Ratio <input type="text" id="carbratio" value="20" size="2"><br><br>

BG Reading <input type="text" id="bg" size="2"/><br>
Carb Target <input type="text" id="carbs" size="2"/><br><br><br>


 <table style="width:75%">
  <tr>
    <th>Simple Sugar Food</th>
    <th>Complex Carb Food</th>
  </tr>
  <tr>
    <td><ol onclick="addText(event)">
      <li>Rocket Candies </li>
      <li>Juice </li>
      <li>Orange Slices </li>
      <li>Apple Slices </li>
      <li>Cookie </li>
      </ol>
    </td>
    <td>
      <ol onclick="addText(event)">
      <li>Crackers </li>
      <li>Bread Slice  </li>
      <li>Chips </li>
      <li> </li>
      <li> </li>
      </ol>
    </td>
</tr>
</table>
<table  style="width:70%">
<tr>
    <th>Simple & Complex Carb Food</th>
    <th>Low Carb Foods</th>
  </tr>
  <tr>
    <td>
      <ol onclick="addText(event)">
        <li>Cookies </li>
        <li>Nutragrain Bar  </li>
        <li> </li>
        <li> </li>
        <li> </li>
      </ol>
    </td>
    <td>     
      <ol onclick="addText(event)">
        <li>Cucomber </li>
        <li>Cherry Tomatoes  </li>
        <li>Sunflower Seeds </li>
        <li>Celary </li>
      </ol>
    </td>
  </tr>
</table> 

<table style="width:70%">
  <tr>
    <th>Carb amounts</th>
    <th></th>
    <th></th>
  </tr>
  <tr>
    <td>
      <ol onclick="addText(event)">
        <li>(1-2g Carbs) /</li>
        <li>(5g Carbs) /</li>
        <li>(7g Carbs) /</li>
      </td>
        <td>
        <ol onclick="addText(event)">
        <li>(10g Carbs) / </li>
        <li>(12g Carbs) / </li>
        <li>(15g Carbs) /</li>
      </td>
        <td>
        <ol onclick="addText(event)">
        <li>(17g Carbs) / </li>
        <li>(20g Carbs) / </li>
        <li>(20+g Carbs) /</li>
      </td>
    </ol>
  </td>
</tr>
</table>
		<script>

			function GetSelectedValue(){
				var e = document.getElementById("country");
				var result = e.options[e.selectedIndex].value;
				
				document.getElementById("result").innerHTML = result;
			}

			function GetSelectedText(){
				var e = document.getElementById("country");
				var result = e.options[e.selectedIndex].text;
				
				document.getElementById("result").innerHTML = result;
			}
function addText(event) {
    var targ = event.target || event.srcElement;
    document.getElementById("mealinfo").value += targ.textContent || targ.innerText;
}
			
		</script>

	<br><br><b>--==Meal/Correction Info==--</b><br> 
	<textarea rows = "8" cols = "60" id="mealinfo" name = "description"></textarea><br></p>
<br></p>
</form>

<form action="bglpost.php" method="post">

<input type="hidden" name="total" id="total">
<input type="button" onClick="calc()" onClick="addBreak(el)" value="Calculate" />
<input type="button" onClick="setValue()" value="LogEntry" />
</form>
 <table style="width:70%">
  <tr>
    <th>BG Reading</th>
    <th>BGL Correction</th>
    <th>Carb Correction</th>
    <th>Units of insulin</th>
  </tr>
  <tr>
    <td><center><b> <div id="result5"></div> </b></center></td>
    <td><center><b> <div id="result2"></div> </b></center></td>
    <td><center><b> <div id="result3"></div></b></center></td>
    <td><center><b> <div id="result"></div></b></center></td>
  </center></tr>
</table> 
<table style="width:70%">
 <tr>
   <th>--==Formula Info==--<br> <b></th>
 </tr>
<tr><td>
 <center><div id="result6"></div></b></center></td>
 </tr>
</table>
<table><tr>
  <th></b> --==Meal/Correction Info==-- </th>
</tr>
<tr><td><center> <div id="result4"></div></center></td></tr>
</table>

<table style="width:70%">
 <tr>
   <th>--==Logged Entries==-- ( <a href="BGLLog.html" > View Log Seperate </a> )<br> <b></th>
 </tr>
<tr><td>
 <center>
<?php readfile("BGLLog.html"); ?>
</center></td>
 </tr>
</table>
</body>
</html>
