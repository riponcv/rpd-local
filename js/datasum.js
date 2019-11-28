// JavaScript Document

function displayText()
	{
	var te=0;
	var te1=0;
	var myArray = new Array();
	mytext= document.getElementsByName("ac[]");
	mytext1= document.getElementsByName("amt[]");
		for ( var i = 0; i <mytext.length; i++ )
		{
			if ( mytext[i].value!="" ) 
			{
			te += parseInt(mytext[i].value);
			document.getElementById('text3').value = te;		
			}
			
			if ( mytext1[i].value!="" ) 
			{
			te1 += parseInt(mytext1[i].value);
			document.getElementById('text4').value = te1;		
			}
		}
    } 