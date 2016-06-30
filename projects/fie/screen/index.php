<html>
<head>
<style>
#ta{
font-family: fixed,monospace;
font-size: 12px;
background: #000;
color: #0d0;
}
h1,h2,h3,h4,p{
padding: 0px;
margin: 0px;
}
</style>
<script>
String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}

function getsize(){
        if(navigator.appName == "Microsoft Internet Explorer") {
                  http = new ActiveXObject("Microsoft.XMLHTTP");
        } else {
                  http = new XMLHttpRequest();
        }

        http.open("GET", "ttysize");
        http.onreadystatechange=function() {
                if(http.readyState == 4) {
			x = new Array();
                        x = http.responseText.trim().split(" ");

                        document.getElementById('ta').rows = x[0];
                        document.getElementById('ta').cols = x[1];
                }
        }
        http.send(null);


}

var i = 200
function gettext(){
i++;
	if(navigator.appName == "Microsoft Internet Explorer") {
		  http = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		  http = new XMLHttpRequest();
	}

	http.open("GET", "scrhc");
	http.onreadystatechange=function() {
		if(http.readyState == 4) {
			x = http.responseText.split("\n");
			document.getElementById('ta').value = http.responseText;
			if(i > 20){
				getsize();
				i = 0;
			}
			loopback();
		}
	}
	http.send(null);

}

function loopback(){
  setTimeout("gettext()",500);
}



</script>
</head>
<body onload="gettext();">
<h2>Live Webscreen</h2>
<p>screen session on va2600</p>
<textarea id="ta" rows="1" cols="10" >Loading...</textarea>
<p><a href="source.tar">special sauce</a></p>
</body>
</html>
