/**
* Author : Rongjia Liu
* Date started 6th Oct 2021
* Version: 1.0
* Project Name: Padstow Childcare Centre
* Description: this is a document contains four functions.
* Date completed:
* @author Rongjia Liu
* @method 
...........................................
 * Adds two numbers together 
 * 
 * @method ValidateInput 
 * @param {HTMLElement} form
 * 
 * @returns {boolean} true/false
 * @description This function is called on submitting the child form. It validate the input data.
 * @name ValidateInput
 */


function ValidateInput()
{
	const childid = document.getElementById("childid").value;
	const childfirstname = document.getElementById("childfirstname").value;		
	const childfamilyname = document.getElementById("childfamilyname").value;
	const childdob = document.getElementById("childdob").value;
	var childgender = document.getElementsByName("childgender");
		if (document.activeElement.value == "Update")
	{	
		if (childid == "")
		{
			document.getElementById("message").innerHTML ="Cxxx id is required";
			return false;
		}
		else
		if (childid.length != 2)
		{
			document.getElementById("message").innerHTML ="*Child id must have two characters";
			return false;
		}
		else
		if (isNaN(childid))
		{
			document.getElementById("message").innerHTML ="*Child id must be a number";
			return false;
		}
		else
		if (childfamilyname == "")
		{
			document.getElementById("message").innerHTML ="Child family name is required";
			return false;7
		}
		else
			
		if (childgender[0].checked == false && childgender[1] == false)
		{
			document.getElementById("message").innerHTML ="Child gender is required";
			return false;
		}
		else
		if (childdob == "")
		{
			document.getElementById("message").innerHTML ="Child dob is required";
			return false;
		}
		const childgender = document.getElementById("childgender").checked;
        if    (!childgender)
        {
            document.getElementById("message").innerHTML ="Child Gender is required";
            return false;
        }
	}
	else
	if (document.activeElement.value == "Add")
	{
		
		/*const childfirstname = document.getElementById("childfirstname").value;
		const childfamilyname = document.getElementById("childfamilyname").value;
		const childgender = document.getElementById("childgender").value;
		const childdob = document.getElementById("childdob").value;*/
		
		if (childfirstname == "")
		{
			document.getElementById("message").innerHTML ="*****Child *first name is required";
			return false;
		}
		else
		if (childfamilyname == "")
		{
			document.getElementById("message").innerHTML ="Child* family name is required";
			return false;
		}
		else
		if (childgender.checked == false)
		{
			document.getElementById("message").innerHTML ="Child* gender is required";
			return false;
		}
		else
		if (childdob == "")
		{
			document.getElementById("message").innerHTML ="Child *dob is required";
			return false;
		}
	}
	else
	if (document.activeElement.value == "Delete" || document.activeElement.value == "Search")
	{
		//const childid = document.getElementById("childid").value;
		if (childid == "")
		{
			document.getElementById("message").innerHTML ="*Child id is required";
			return false;
		}
		else
		if (childid.length != 2)
		{
			document.getElementById("message").innerHTML ="Child id must have two characters";
			return false;
		}
		else
		if (isNaN(childid))
		{
			document.getElementById("message").innerHTML ="Child id must be a number";
			return false;
		}
	}		
	return true;	
}

