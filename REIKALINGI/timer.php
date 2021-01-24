<!DOCTYPE html>
<html>
<body>

<button type="button" value="Submit" onclick="settimer();">Try it</button>

<p id="demo"></p>
<p id="timer_value"></p>

<script>
function addZero(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}
  var d = new Date();
  var x = document.getElementById("demo");
  var h = addZero(d.getHours());
  var m = addZero(d.getMinutes());
  var s = addZero(d.getSeconds());
  
  x.innerHTML = h + ":" + m + ":" + s;

  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();
  dd =+dd + +1;
  
  var timer;
function settimer()
{
 clearInterval(timer);

 var timer_month=mm;
 var timer_day=dd;
 var timer_year=yyyy;
 var timer_hour=h;
 if(timer_hour=="")timer_hour=0;
 var timer_min=m;
 if(timer_min=="")timer_min=0;

 var timer_date=timer_month+"/"+timer_day+"/"+timer_year+" "+timer_hour+":"+timer_min;
 var end = new Date(timer_date); // Arrange values in Date Time Format
 var now = new Date(); // Get Current date time
 var second = 1000; // Total Millisecond In One Sec
 var minute = second * 60; // Total Sec In One Min
 var hour = minute * 60; // Total Min In One Hour
 var day = hour * 24; // Total Hour In One Day

 function showtimer() {
  var now = new Date();
  var remain = end - now; // Get The Difference Between Current and entered date time
  if(remain < 0) 
  {
   clearInterval(timer);
   document.getElementById("timer_value").innerHTML = 'Reached!';
   <?php
   ?>
     return;
    }
    var days = Math.floor(remain / day); // Get Remaining Days
    var hours = Math.floor((remain % day) / hour); // Get Remaining Hours
    var minutes = Math.floor((remain % hour) / minute); // Get Remaining Min
    var seconds = Math.floor((remain % minute) / second); // Get Remaining Sec
   
    document.getElementById("timer_value").innerHTML = days + 'Days ';
    document.getElementById("timer_value").innerHTML += hours + 'Hrs ';
    document.getElementById("timer_value").innerHTML += minutes + 'Mins ';
    document.getElementById("timer_value").innerHTML += seconds + 'Secs';
   }
   timer = setInterval(showtimer, 1000); // Display Timer In Every 1 Sec
  }