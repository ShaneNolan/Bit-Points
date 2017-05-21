<script type="text/javascript">
function refreshChat(){
  loadXMLDoc();
  setTimeout("refreshChat()",1000);
}

var req;

var urlToFetch = '../modals/chat.php';

try{// Opera 8.0+, Firefox, Safari
      req = new XMLHttpRequest();
	}
catch (e){// Internet Explorer Browsers - Backward compatibility
		try
			{
			req = new ActiveXObject("Msxml2.XMLHTTP");
			}
		catch (e)
			{
			try
				{
				req = new ActiveXObject("Microsoft.XMLHTTP");
				}
			catch (e)
				{
				alert("Your browser does not support live updates");
				return false;
				}
			}
	}

req.open("POST",urlToFetch,true);
//Note: open(method, url, async) 	Specifies the type of request
//	method: the type of request: GET or POST
//	url: the file location
//	async: true (asynchronous) or false (synchronous)

req.send(); //Sends an HTTP request to the server and receives a response.

req.onreadystatechange=function(){  // Action to be performed when the document is read
  if (req.readyState==4 && req.status==200)  //When readyState=4 and status=200 the response is ready
    {
	//document.getElementById("myContent").innerHTML='urlToFetch:='+urlToFetch+'<p>'+req.responseText;
	document.getElementById("myContent").innerHTML=req.responseText;
    }
</script>
