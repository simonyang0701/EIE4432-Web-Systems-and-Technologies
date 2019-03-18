<!DOCTYPE html>
<html>
<head>
    <title> Question 2 </title>
    
    <style type="text/css">
	.ans {color:red; font-weight: bold}
    </style>
    
    <script type="text/javascript">
    function question(qNum){
        
        //url
        var xmlHttp=null;
        if(window.XMLHttpRequest){
            xmlHttp=new XMLHttpRequest();
        }
        else if(window.ActiveXObject){
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        if(xmlHttp!=null){
            
            xmlHttp.onreadystatechange=function()
            {
                if(xmlHttp.readyState==4)
                {
                    if(qNum==1)
                    document.getElementById("m1").innerHTML=xmlHttp.responseText;
                    if(qNum==2)
                    document.getElementById("m2").innerHTML=xmlHttp.responseText;
                    if(qNum==3)
                    document.getElementById("m3").innerHTML=xmlHttp.responseText;
                }
            }
            if(qNum==1)
            url="Q2A2.php?q1="+ document.getElementById("q1").value;
            if(qNum==2)
            url="Q2A2.php?q2="+ document.getElementById("q2").value;
            if(qNum==3)
            url="Q2A2.php?q3="+ document.getElementById("q3").value;
            
            xmlHttp.open("GET",url,true);
            xmlHttp.send(null);
        
        }
        else{
            alert("Your browser does not support XMLHTTP.");
        }
        
        
    }
    
    

    </script>

	
</head>
<body onload="show()" >

<form name="myForm1">
   <p> <label> Question 1. Given 1234x1234 = 1522756, find the last four digits of
	2468x2468 (from left to right).  </label> <br />
       <input type="text" name="q1" id="q1"/> <span class="ans" id="m1"> </span>
   </p>
   <input type="button" value="submit" onclick="question(1)" /> 
</form>

<form name="myForm2">
   <p> <label> Question 2. Let a, b, c be positive integers such that a!xb!xc! = 25920.
	Find the greatest possible value of a.  </label> <br />
       <input type="text" name="q2" id="q2"/> <span class="ans" id="m2"> </span>
   </p>
   <input type="button" value="submit" onclick="question(2)" /> 
</form>
<form name="myForm3">
   <p> <label> Question 3. Let p, q, r be prime numbers.  If pq+pr = 80 and pq+qr = 425,
	find the value of p+q+r. </label> <br />
       <input type="text" name="q3" id="q3"/> <span class="ans" id="m3" > </span>
   </p>
   <input type="button" value="submit" onclick="question(3)" /> 
</form>

</body>
</html>