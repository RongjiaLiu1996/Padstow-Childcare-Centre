function ValidateInput(form)
{
    const nurseid =document.getElementById("nurseid").value;
    const nursename =document.getElementById("nursename").value;
    const nurseaddress =document.getElementById("nurseaddress").value;
    const nursephone =document.getElementById("nursephone").value;
    const nursemobile =document.getElementById("nursemobile").value;
    const nurseemail =document.getElementById("nurseemail").value;
    var nursegender =document.getElementsByName("nursegender").value;

if (document.activeElement.value == "Update")
	{	
		if (nurseid == "")
		{
			document.getElementById("message").innerHTML ="Nurse ID is required";
			return false;
		}
		else
		if (isNaN(nurseid))
		{
			document.getElementById("message").innerHTML ="Nurse ID must be a number";
			return false;
		}
		else
		if (nursename == "")
		{
			document.getElementById("message").innerHTML ="Nurse Name is required";
			return false;7
		}
		else
		if (nursegender[0].checked == false && nursegender[1] == false)
		{
			document.getElementById("message").innerHTML ="Nurse gender is required";
			return false;
		}
		else
		if (nurseaddress == "")
		{
			document.getElementById("message").innerHTML ="Child dob is required";
			return false;
		}
		const nursegender = document.getElementById("nursegender").checked;
        if    (!nursegender)
        {
            document.getElementById("message").innerHTML ="Nurse Gender is required";
            return false;
        }
	}
	else
	if (document.activeElement.value == "Add")
	{		
		if (nurseid == "")
		{
			document.getElementById("message").innerHTML ="Nurse ID is required to add";
			return false;
		}
		else
		if (isNaN(nurseid))
		{
			document.getElementById("message").innerHTML ="Nurse ID must be a number";
			return false;
		}
		else
		if (nursename == "")
		{
			document.getElementById("message").innerHTML ="Nurse name is required to add";
			return false;
		}
		else
		if (nurseaddress == "")
		{	
			document.getElementById("message").innerHTML ="Address is required";
			return false;
		}
		else
		if (nursephone == "")
		{
			document.getElementById("message").innerHTML ="Phone number is required";
			return false;
		}
		else
		if (nursemobile == "")
		{
			document.getElementById("message").innerHTML ="Mobile number is required";
			return false;
		}
		else
		if (nursemobile.length != 10 || nursephone.length !=10)
		{
			document.getElementById("message").innerHTML ="Mobile/Phone number must be 10 digital numbers";
			return false;
		}
		else
		if (nurseemail == "")
		{
			document.getElementById("message").innerHTML ="Email is required";
			return false;
		}
		else
		const nursegender = document.getElementById("nursegender").checked;
        if    (!nursegender)
        {
            document.getElementById("message").innerHTML ="Nurse Gender is required";
            return false;
        }

	}	
	else
	if (document.activeElement.value == "Delete" || document.activeElement.value == "Search")
	{
		//const childid = document.getElementById("childid").value;
		if (nurseid == "")
		{
			document.getElementById("message").innerHTML ="Nurse ID is required";
			return false;
		}
		else
		if (isNaN(nurseid))
		{
			document.getElementById("message").innerHTML ="Nurse ID must be a number";
			return false;
		}
	}		
	return true;	
    }
