setInterval(function() {


	xhr = new XMLHttpRequest();
	if (xhr != null)
	{
		var url="check_new_message.php";

		xhr.onreadystatechange=refresh_inhoud_aantal;
		xhr.open("GET",url,true);
		xhr.send(null);
	}


}, 500);

function refresh_inhoud_aantal() 
{
	var output = document.getElementById("message_aantal");
	if (xhr.readyState == 4 && xhr.status == 200)
	{
		if(xhr.responseText)
		{

			output.innerHTML = xhr.responseText;

		}
		else
		{
			output.innerHTML = "0";
		}
	}
}