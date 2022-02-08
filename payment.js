function ValidateInput(form)
{
	
if (document.activeElement.value == "delete" || document.activeElement.value == "search")
{
	//const childid = document.getElementById("childid").value;
	if (paymentid == "")
	{
		document.getElementById("message").innerHTML ="*Child id is required";
		return false;
	}
	else
	if (paymentid.length != 3)
	{
		document.getElementById("message").innerHTML ="Child id must have two characters";
		return false;
	}
	else
	if (isNaN(paymentid))
	{
		document.getElementById("message").innerHTML ="Child id must be a number";
		return false;
	}
}		
return true;	
}