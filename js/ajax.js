function createXMLHttpRequest() {
	var xmlHttp = null;
	 
	try{
		// Opera 8.0+, Firefox, Safari, Chrome
		xmlHttp = new XMLHttpRequest();		
		return xmlHttp;
	} catch (e){
		// Internet Explorer Browsers
		try{
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");			
			return xmlHttp;
		} catch (e) {
			try{
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");				
				return xmlHttp;
			} catch (e){
				// Something went wrong
				//most likely activex disabled				
				return null;
			}
		}
	}
}


function postUserRequest(action) {
  xmlHttp = createXMLHttpRequest();	
	if(	xmlHttp != null)
	{
		var url = "UserRequestHandler.php";
		data = "action="+action;
		data += "&userid=" 	+ document.getElementById("userid").value 
			+ "&fname=" 	+ document.getElementById("fname").value 
			+ "&lname=" 	+ document.getElementById("lname").value 
			+ "&email=" 	+ document.getElementById("email").value
			+ "&phone1=" 	+ document.getElementById("phone1").value
			+ "&phone2=" 	+ document.getElementById("phone2").value;
			
		xmlHttp.open('POST', url, true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	  xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
		//alert(xmlHttp.responseText);
		 
		  var user = xmlHttp.responseText.split(',');
		  for(i=0;i<user.length;i++)
		  {
			var pair = user[i].split('.');
			if(pair[0] != null) {
				
				document.getElementById(pair[0]).value = pair[1];
				
			}
			
		  }
			
		}
	  }
	  xmlHttp.send(data);
  }
}


function userData(action){	
	//sned or recieve user data to database via Ajax request to UserRequestHandler	 
	xmlHttp = createXMLHttpRequest();	
	if(	xmlHttp != null)
	{
		var url = "../UserRequestHandler.php";
		url += "?action=" 	+ action 
			+ "&userid=" 	+ document.getElementById("userid").value 
			+ "&fname=" 	+ document.getElementById("fname").value 
			+ "&lname=" 	+ document.getElementById("lname").value 
			+ "&email=" 	+ document.getElementById("email").value
			+ "&phone1=" 	+ document.getElementById("phone1").value
			+ "&phone2=" 	+ document.getElementById("phone2").value;
		
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var user = JSON.parse(xmlhttp.responseText);
				document.getElementById("userid").innerHTML = user.user_id;
				document.getElementById("fname").innerHTML = user.fname;
				document.getElementById("lname").innerHTML = user.lname;
				document.getElementById("email").innerHTML = user.email;
				document.getElementById("phone1").innerHTML = user.phone1;
				document.getElementById("phone2").innerHTML = user.phone2;
			}
		};
		xmlHttp.open("GET", url, true);	
		xmlHttp.send("");
			
	} else {
		//error display error unable to load product info
		//most likely activex disabled
		alert("error retrieving data - you may need to access our site with a newer browser");	
	}
}
