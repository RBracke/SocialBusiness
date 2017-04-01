function check_in_out()
{
	xhr = new XMLHttpRequest();
	if (xhr != null)
	{
		var url="check_in_out_validate.php";  

		xhr.onreadystatechange=refresh_in_building;
		xhr.open("GET",url,true);
		xhr.send(null);
	}
}

function refresh_in_building() {
	var output_icon = document.getElementById("in_building");
	var output_button = document.getElementById("check_in_out_button");
	if (xhr.readyState == 4 && xhr.status == 200)
	{
		if(xhr.responseText)
		{
			if (xhr.responseText == "in")
			{
				output_icon.src = "IMG/Green_circle.png";
				output_icon.alt = "In building";
				output_icon.title = "In building";
				output_button.className = "btn btn-danger";
				output_button.innerHTML = "Check out";

			}
			else
			{
				output_icon.src = "IMG/Red_circle.png";
				output_icon.alt = "Not in building";
				output_icon.title = "Not in building";
				output_button.className = "btn btn-success";
				output_button.innerHTML = "Check in";
			}
		}
		else
		{
			output_icon.src = "IMG/Red_circle.png";
			output_icon.alt = "Not in building";
			output_icon.title = "Not in building";
			output_button.className = "btn btn-success";
			output_button.innerHTML = "Check in";
		}
	}
}