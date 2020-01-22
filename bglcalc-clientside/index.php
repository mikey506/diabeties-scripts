
<html>
<head>
<meta charset="utf-8">
<title>BGL Correction & Meal Calculations Script</title>
<script>

function calc(){
var bg=document.getElementById('bg').value;
var carbs=document.getElementById('carbs').value;
var correction=document.getElementById('correction').value;
var target=document.getElementById('target').value;
var carbratio=document.getElementById('carbratio').value;

 
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

document.getElementById('result').innerHTML=units;
document.getElementById('result2').innerHTML=correct;
document.getElementById('result3').innerHTML=carbcorrect;

return false
}
</script>
</head>
<body><center><br><br>
Correction Formula: (BGL-10) / 16 = _____<br>
Carb Formula: (Carbs) / 20 = ______<br>
<br><br><br>
<form>
<p>BGL Correction Factor <input type="text" id="correction" value="16"></p>
<p>Blood Sugar Target <input type="text" id="target" value="10"></p>
<p>Carb Ratio <input type="text" id="carbratio" value="20"></p>
<p>Blood Sugar <input type="text" id="bg"/></p>
<p>Carb Target <input type="text" id="carbs" /></p>
<input type="button" onClick="calc()" value="Calcular" />
</form>
<br><br>BGL Correction:<b> <div id="result2"></div> </b>
<br>Carb Correction:<b> <div id="result3"></div></b><br><br>
Give This Many Units of insulin:<b> <div id="result"></div> </b>
</center></body>
</html>