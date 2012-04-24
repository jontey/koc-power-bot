<?php
$to = $_POST['to'];
$subject = $_POST['subject'];
$body = $_POST['msg'];

if(!filter_var($to, FILTER_VALIDATE_EMAIL))
	return "{ok:false, err:'Invalid email'}";


if(mail($to, $subject, $body))
	return "{ok:true}";
else
	return "{ok:false, err:'Failed to send email'}";

?>

<!---------------------- Part to add to powerbot ------>
sendemail : function (query, callback){
  var data = [];
  data.to = query.email;
  data.subject = query.subject;
  data.msg = query.subject;
  
  GM_xmlhttpRequest({
    method: 'POST',
    url: '../email.php',
	headers: {
		'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
    },
	data: implodeUrlArgs(data),
	onload: function(rslt){
		callback(rslt.responseText)
	}
	})
}
callback : function(rslt){
if(rslt.ok){

} else {
	alert(rslt.err);
}
}