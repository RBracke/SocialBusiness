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
	var output = document.getElementById("message_badge");
	if (xhr.readyState == 4 && xhr.status == 200)
	{
		if(xhr.responseText && xhr.responseText != 0)
		{

			output.innerHTML = "<span class='badge' id='message_aantal'>" +xhr.responseText+ "</span>";

		}
		else
		{
			output.innerHTML = "";
		}
	}
}