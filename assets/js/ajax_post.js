
$(document).ready(function(){

 /* $("#btn_login1").click(

	$('input#pfno').focusout(function()
  	{

		 $.ajax({
		 	url: "http://203.76.102.169:8033/rpd/index.php/userinfo/user_full_name_get",
			//url: "http://localhost/rpd/index.php/userinfo/user_full_name_get",
			type:'POST',
			dataType: 'json',
			success: function(output_string)
			{
				alert('Full Name is coming');
				$("#txt_your_name").append(output_string);
			}
			// End of success function of ajax form
			});
			 // End of ajax call
			 });

*/



});

/*
function pwd_chk(str)
{
	var xmlhttp;
 if (str=="")
   {
   alert('Insert Personal File first');
   return;
   }
 if (window.XMLHttpRequest)
   {// code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
   }
 else
   {// code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
 xmlhttp.onreadystatechange=function()
   {
   if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
     	//alert(xmlhttp.responseText)  //document.getElementById("txt_your_name").value=xmlhttp.responseText;
		//alert( document.getElementById("txt_Password").value);
		 if (document.getElementById("txt_Password").value!=xmlhttp.responseText)
		 {
		 	alert('Password Not Matched. Pls Try Again.....!!!');
			//document.getElementById("txt_Password").focus();
		 }
     }
   }
 xmlhttp.open("GET","http://203.76.102.169:8033/rpd/index.php/userinfo/user_pwd_chk/"+str,true);
 //xmlhttp.open("GET","http://localhost/rpd/index.php/userinfo/user_pwd_chk/"+str,true);
 xmlhttp.send();


	//alert(str);
}

function User_Full_Name_Show(str)
 {
 var xmlhttp;
 if (str=="")
   {
   document.getElementById("txt_your_name").value="";
   return;
   }
 if (window.XMLHttpRequest)
   {// code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
   }
 else
   {// code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
 xmlhttp.onreadystatechange=function()
   {
   if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
     	document.getElementById("txt_your_name").value=xmlhttp.responseText;
     }
   }
 xmlhttp.open("GET","http://203.76.102.169:8033/rpd/index.php/userinfo/user_full_name_get_uri/"+str,true);
// xmlhttp.open("GET","http://localhost/rpd/index.php/userinfo/user_full_name_get_uri/"+str,true);
 xmlhttp.send();
 }


function Office_Name_Show(str)
 {
 var xmlhttp;
 if (str=="")
   {
   document.getElementById("txt_office_name").value="";
   return;
   }
 if (window.XMLHttpRequest)
   {// code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
   }
 else
   {// code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
 xmlhttp.onreadystatechange=function()
   {
   if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {

     document.getElementById("txt_office_name").value=xmlhttp.responseText;
     }
   }

 xmlhttp.open("GET","http://203.76.102.169:8033/rpd/index.php/userinfo/office_name_get/"+str,true);
 //xmlhttp.open("GET","http://localhost/rpd/index.php/userinfo/office_name_get/"+str,true);
 xmlhttp.send();
 }
*/

 function initbody()
 {
	//alert('body inited');
//	var a=today_dd_mm_yyyy();
	document.getElementById("todaydt").innerHTML= "Today: " + today_dd_mm_yyyy();
	var temp=document.getElementById("pfno");
	if (temp) document.getElementById("pfno").focus();
	//document.getElementById("pfno").focus();
 }

 function today_dd_mm_yyyy()
 {
 	var a = new Date();
			if(a.getDate().toString().length==2)
			{
			var dd=a.getDate().toString();
			}
			else
			{
			var dd="0"+a.getDate().toString();
			}

			if((parseInt(a.getMonth())+1).toString().length==2)
			{
			//var mm=(parseInt(a.getMonth())+1).toString();
			var mm=mon_char(a.getMonth());
			}
			else
			{
			//var mm="0"+(parseInt(a.getMonth())+1).toString();
			var mm=mon_char(a.getMonth());
			}

			var yy=a.getFullYear();

         return dd+"-"+mm+"-"+yy;
 }

 function pwd_check()
 {

	 if( document.getElementById("password").value!= document.getElementById("conf_password").value)
	 {
	 	alert('Confirm password is not matched with your password');
	setTimeout('document.getElementById(\'conf_password\').focus();document.getElementById(\'conf_password\').select();',0);
		//document.getElementById("conf_password").select();
		//document.getElementById("conf_password").focus();
	 }
 }

 function displayText()
	{
	var te=0;
	var te1=0;
	var myArray = new Array();
	mytext1= document.getElementsByName("ac[]");
	mytext= document.getElementsByName("amt[]");
		for ( var i = 0; i <mytext.length; i++ )
		{
			if ( mytext1[i].value!="" )
			{
			te1 += parseInt(mytext1[i].value);
			document.getElementById('text3').value = te1;
			}
			if ( mytext[i].value!="" )
			{
			te += parseInt(mytext[i].value);
			document.getElementById('text4').value = te;
			}
		}
    }

	function mon_char(nmon)
	{
		var mon_num = new Array(12);
			mon_num[0]='Jan';
			mon_num[1]='Feb';
			mon_num[2]='Mar';
			mon_num[3]='Apr';
			mon_num[4]='May';
			mon_num[5]='Jun';
			mon_num[6]='Jul';
			mon_num[7]='Aug';
			mon_num[8]='Sep';
			mon_num[9]='Oct';
			mon_num[10]='Nov';
			mon_num[11]='Dec';

		return mon_num[nmon];
	}

$(function() {
				$( "#datepicker" ).datepicker({ dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2020' });
				$( "#datepicker1" ).datepicker({ dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2020' });
				$( "#datepicker2" ).datepicker({ dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2020' });
                $( "#datepicker3" ).datepicker({ dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2020' });
                $( "#datepicker4" ).datepicker({ dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2020' });
                $( "#datepicker5" ).datepicker({ dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2020' });
                $( "#datepicker6" ).datepicker({ dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2020' });
				$( "#datepicker7" ).datepicker({ dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2020' });
                $( "#datepicker8" ).datepicker({ dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2020' });
				$( "#datepicker9" ).datepicker({ dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2020' });
                $( "#datepicker10" ).datepicker({ dateFormat: 'dd-M-yy',changeMonth: true,changeYear: true, yearRange: '1940:2020' });
			});

$(function() {
	   $("#trandate" ).datepicker(
	                 { dateFormat: 'dd-M-yy',
	                   showAnim: 'slide',
	                   changeMonth: true,
	                   changeYear: true,
	                   yearRange: '1990:2020'
	                }
	                );
	 });


function displayOmisText()
	{
		myamt= document.getElementsByName("amount[]");
		myac= document.getElementsByName("ac[]");
		mytotalamt= document.getElementsByName("totalamt[]");
		mytotalac= document.getElementsByName("totalac[]");

		var end=new Array(7,8,14,15,17,21,26,34,37,38,39,40,44,48,49,51,52,53,56,57,58,60,62,64,66,68,70,71,72,73,74,75);
		var xx=0;
		var te=0.0;
		var to1=0;
		var end_index=0;
		for ( var a=0; a<myamt.length; a++)
		{
			for(var j=xx; j<end[end_index]; j++)
			{
				if ( myamt[j].value!="" )
				{
					te += parseFloat(myamt[j].value);
					mytotalamt[a].value= parseFloat(te).toFixed(2);
				}
				if ( myac[j].value!="" )
				{
					to1 += parseInt(myac[j].value);
					mytotalac[a].value= parseInt(to1);
				}
			}
			xx=end[end_index];
			end_index++;
			te=0.0;
			to1=0;
		}
	}
/*
function displayOmisText()
	{
	myamt= document.getElementsByName("amount[]");
	myac= document.getElementsByName("ac[]");

	mytotalamt= document.getElementsByName("totalamt[]");
	mytotalac= document.getElementsByName("totalac[]");

		   ///0.deposit
	  var te=0.0;
	  var to1=0;
	  for ( var a = 0; a <7; a++)
		{
				if ( myamt[a].value!="" )
				{
			  	te += parseFloat(myamt[a].value);
			  	mytotalamt[0].value= parseFloat(te);
				}

				if ( myac[a].value!="" )
				{
			  	to1 += parseInt(myac[a].value);
			  	mytotalac[0].value= parseInt(to1);
				}
		}

	   ///1.Bills Payable
	   var te=0.0;
	   var to1=0;
	   for ( var b = a; b<8; b++)
		{
				if ( myamt[b].value!="" )
				{
			  	te += parseFloat(myamt[b].value);
			  	mytotalamt[1].value= parseFloat(te);
				}

				if ( myac[b].value!="" )
				{
			  	to1 += parseInt(myac[b].value);
			  	mytotalac[1].value= parseInt(to1);
				}
		}

	   ///2.Loan and Advance Outstanding
	   var te=0.0;
	   var to1=0;
	   for ( var c = b; c<14; c++)
		{
				if ( myamt[c].value!="" )
				{
			  	te += parseFloat(myamt[c].value);
			  	mytotalamt[2].value= parseFloat(te);
				}

				if ( myac[c].value!="" )
				{
			  	to1 += parseInt(myac[c].value);
			  	mytotalac[2].value= parseInt(to1);
				}
		}

	   ///3.Interest Suspense A/C
	   	var te=0.0;
	    var to1=0;
	   	for ( var d = c; d<15; d++)
		{
				if ( myamt[d].value!="" )
				{
			  	te += parseFloat(myamt[d].value);
			  	mytotalamt[3].value= parseFloat(te);
				}

				if ( myac[d].value!="" )
				{
			  	to1 += parseInt(myac[d].value);
			  	mytotalac[3].value= parseInt(to1);
				}
		}
	   ///4.Limit Sanction
	   	var te=0.0;
	    var to1=0;
	   	for ( var e = d; e<17; e++)
		{
				if ( myamt[e].value!="" )
				{
			  	te += parseFloat(myamt[e].value);
			  	mytotalamt[4].value= parseFloat(te);
				}

				if ( myac[e].value!="" )
				{
			  	to1 += parseInt(myac[e].value);
			  	mytotalac[4].value= parseInt(to1);
				}
		}
	   ///5.Not Disburse
	   	var te=0.0;
		var to1=0;
	   	for ( var f = e; f<21; f++)
		{
				if ( myamt[f].value!="" )
				{
			  	te += parseFloat(myamt[f].value);
			  	mytotalamt[5].value= parseFloat(te);
				}

				if ( myac[f].value!="" )
				{
			  	to1 += parseInt(myac[f].value);
			  	mytotalac[5].value= parseInt(to1);
				}
		}
	   ///6.Loan Classification
	  var te=0.0;
	  var to1=0;
	  for ( var g = f; g<26; g++)
		{
				if ( myamt[g].value!="" )
				{
			  	te += parseFloat(myamt[g].value);
			  	mytotalamt[6].value= parseFloat(te);
				}

				if ( myac[g].value!="" )
				{
			  	to1 += parseInt(myac[g].value);
			  	mytotalac[6].value= parseInt(to1);
				}
		}
	   ///7.Cash Recovery from Janu
	  var te=0.0;
	  var to1=0;
	  for ( var h = g; h<34; h++)
		{
				if ( myamt[h].value!="" )
				{
			  	te += parseFloat(myamt[h].value);
			  	mytotalamt[7].value= parseFloat(te);
				}

				if ( myac[h].value!="" )
				{
			  	to1 += parseInt(myac[h].value);
			  	mytotalac[7].value= parseInt(to1);
				}
		}
	   ///8.CL reduction from Janu
	  var te=0.0;
	  var to1=0;
	  for ( var i = h; i<37; i++)
		{
				if ( myamt[i].value!="" )
				{
			  	te += parseFloat(myamt[i].value);
			  	mytotalamt[8].value= parseFloat(te);
				}

				if ( myac[i].value!="" )
				{
			  	to1 += parseInt(myac[i].value);
			  	mytotalac[8].value= parseInt(to1);
				}
		}
	   ///9.Write off position
	  var te=0.0;
	  var to1=0;
	  for ( var j = i; j<38; j++)
		{
				if ( myamt[j].value!="" )
				{
			  	te += parseFloat(myamt[j].value);
			  	mytotalamt[9].value= parseFloat(te);
				}

				if ( myac[j].value!="" )
				{
			  	to1 += parseInt(myac[j].value);
			  	mytotalac[9].value= parseInt(to1);
				}
		}
	   ///10.F. Remitance
	  var te=0.0;
	  var to1=0;
	  for ( var k = j; k<39; k++)
		{
				if ( myamt[k].value!="" )
				{
			  	te += parseFloat(myamt[k].value);
			  	mytotalamt[10].value= parseFloat(te);
				}

				if ( myac[k].value!="" )
				{
			  	to1 += parseInt(myac[k].value);
			  	mytotalac[10].value= parseInt(to1);
				}
		}
	   ///11.Non Intt. Income
	  var te=0.0;
	  var to1=0;
	  for ( var l = k; l<40; l++)
		{
				if ( myamt[l].value!="" )
				{
			  	te += parseFloat(myamt[l].value);
			  	mytotalamt[11].value= parseFloat(te);
				}

				if ( myac[l].value!="" )
				{
			  	to1 += parseInt(myac[l].value);
			  	mytotalac[11].value= parseInt(to1);
				}
		}
	   ///12.Audit Exception
	  var te=0.0;
	  var to1=0;
	  for ( var m = l; m<44; m++)
		{
				if ( myamt[m].value!="" )
				{
			  	te += parseFloat(myamt[m].value);
			  	mytotalamt[12].value= parseFloat(te);
				}

				if ( myac[m].value!="" )
				{
			  	to1 += parseInt(myac[m].value);
			  	mytotalac[12].value= parseInt(to1);
				}
		}
	   ///13.Audit Exception compiled
	  var te=0.0;
	  var to1=0;
	  for ( var n = m; n<48; n++)
		{
				if ( myamt[n].value!="" )
				{
			  	te += parseFloat(myamt[n].value);
			  	mytotalamt[13].value= parseFloat(te);
				}

				if ( myac[n].value!="" )
				{
			  	to1 += parseInt(myac[n].value);
			  	mytotalac[13].value= parseInt(to1);
				}
		}
	   ///14.Cash In Hand
	  var te=0.0;
	  var to1=0;
	  for ( var o = n; o<49; o++)
		{
				if ( myamt[o].value!="" )
				{
			  	te += parseFloat(myamt[o].value);
			  	mytotalamt[14].value= parseFloat(te);
				}

				if ( myac[o].value!="" )
				{
			  	to1 += parseInt(myac[o].value);
			  	mytotalac[14].value= parseInt(to1);
				}
		}
	   ///15.Sundry Assets
	  var te=0.0;
	  var to1=0;
	  for ( var p = o; p<51; p++)
		{
				if ( myamt[p].value!="" )
				{
			  	te += parseFloat(myamt[p].value);
			  	mytotalamt[15].value= parseFloat(te);
				}

				if ( myac[p].value!="" )
				{
			  	to1 += parseInt(myac[p].value);
			  	mytotalac[15].value= parseInt(to1);
				}
		}
	   ///16.Suspense A/C
	  var te=0.0;
	  var to1=0;
	  for ( var q = p; q<52; q++)
		{
				if ( myamt[q].value!="" )
				{
			  	te += parseFloat(myamt[q].value);
			  	mytotalamt[16].value= parseFloat(te);
				}

				if ( myac[q].value!="" )
				{
			  	to1 += parseInt(myac[q].value);
			  	mytotalac[16].value= parseInt(to1);
				}
		}
	   ///17.PL
	  var te=0.0;
	  var to1=0;
	  for ( var r = q; r<53; r++)
		{
				if ( myamt[r].value!="" )
				{
			  	te += parseFloat(myamt[r].value);
			  	mytotalamt[17].value= parseFloat(te);
				}

				if ( myac[r].value!="" )
				{
			  	to1 += parseInt(myac[r].value);
			  	mytotalac[17].value= parseInt(to1);
				}
		}
	   ///18.SME
	  var te=0.0;
	  var to1=0;
	  for ( var s = r; s<56; s++)
		{
				if ( myamt[s].value!="" )
				{
			  	te += parseFloat(myamt[s].value);
			  	mytotalamt[18].value= parseFloat(te);
				}

				if ( myac[s].value!="" )
				{
			  	to1 += parseInt(myac[s].value);
			  	mytotalac[18].value= parseInt(to1);
				}
		}
	   ///19.F.Trade(Import)
	  var te=0.0;
	  var to1=0;
	  for ( var t = s; t<57; t++)
		{
				if ( myamt[t].value!="" )
				{
			  	te += parseFloat(myamt[t].value);
			  	mytotalamt[19].value= parseFloat(te);
				}

				if ( myac[t].value!="" )
				{
			  	to1 += parseInt(myac[t].value);
			  	mytotalac[19].value= parseInt(to1);
				}
		}
	   ///20 F.Trade(Export)

	   var te=0.0;
	   var to1=0;
	   for ( var u = t; u<58; u++)
		{
				if ( myamt[u].value!="" )
				{
			  	te += parseFloat(myamt[u].value);
			  	mytotalamt[20].value= parseFloat(te);
				}

				if ( myac[u].value!="" )
				{
			  	to1 += parseInt(myac[u].value);
			  	mytotalac[20].value= parseInt(to1);
				}
		}

		///21. LDBP
		te=0.0;
		to1=0;
		for ( var v = u; v<60; v++)
		{
				if ( myamt[v].value!="" )
				{
			  	te += parseFloat(myamt[v].value);
			  	mytotalamt[21].value= parseFloat(te);
				}

				if ( myac[v].value!="" )
				{
			  	to1 += parseInt(myac[v].value);
			  	mytotalac[21].value= parseInt(to1);
				}
		}

		///21. FDBP
		te=0.0;
		to1=0;
		for ( var w = v; w<62; w++)
		{
				if ( myamt[w].value!="" )
				{
			  	te += parseFloat(myamt[w].value);
			  	mytotalamt[22].value= parseFloat(te);
				}

				if ( myac[w].value!="" )
				{
			  	to1 += parseInt(myac[w].value);
			  	mytotalac[22].value= parseInt(to1);
				}
		}

		///21. PC
		te=0.0;
		to1=0;
		for ( var x = w; x<64; x++)
		{
				if ( myamt[x].value!="" )
				{
			  	te += parseFloat(myamt[x].value);
			  	mytotalamt[23].value= parseFloat(te);
				}

				if ( myac[x].value!="" )
				{
			  	to1 += parseInt(myac[x].value);
			  	mytotalac[23].value= parseInt(to1);
				}
		}

		///21. LTR
		te=0.0;
		to1=0;
		for ( var y = x; y<66; y++)
		{
				if ( myamt[y].value!="" )
				{
			  	te += parseFloat(myamt[y].value);
			  	mytotalamt[24].value= parseFloat(te);
				}

				if ( myac[y].value!="" )
				{
			  	to1 += parseInt(myac[y].value);
			  	mytotalac[24].value= parseInt(to1);
				}
		}

		///21. PAD
		te=0.0;
		to1=0;
		for ( var z = y; z<68; z++)
		{
				if ( myamt[z].value!="" )
				{
			  	te += parseFloat(myamt[z].value);
			  	mytotalamt[25].value= parseFloat(te);
				}

				if ( myac[z].value!="" )
				{
			  	to1 += parseInt(myac[z].value);
			  	mytotalac[25].value= parseInt(to1);
				}
		}

		///21. LIM
		te=0.0;
		to1=0;
		for ( var aa = z; aa<70; aa++)
		{
				if ( myamt[aa].value!="" )
				{
			  	te += parseFloat(myamt[aa].value);
			  	mytotalamt[26].value= parseFloat(te);
				}

				if ( myac[aa].value!="" )
				{
			  	to1 += parseInt(myac[aa].value);
			  	mytotalac[26].value= parseInt(to1);
				}
		}



    }*/


  //TMS Start By Zakariya
//TMS Start By Zakariya
  function control_tms_form(btn_click)
 {
    if(btn_click =='Submit' || btn_click =='Save Changes')
    {
		var year = jQuery('#target_year').val();
		if(year=='')
		{
			alert("Please select a Year.");
		}
		else
		{
            is_empty=0;
            for ( var loop_val=1; loop_val<=13; loop_val++)
        	{
        	  var val_=jQuery('#amount_'+loop_val).val();
              if(val_=='' || !IsNumeric(val_))
              {
                is_empty=1;
                jQuery('#amount_'+loop_val).css('background-color','#FF6600');
              }
        	}

            if(is_empty == 1)
            {
                alert('Fill all amount fields & must input neumaric value only.');
            }
            else
            {
                if(confirm("Do you want to submit data for selected year: "+year))
    			{
    				if(btn_click =='Submit')
                    {
                     jQuery('#id_tms_entry_form').submit();
                    }
                    if(btn_click =='Save Changes')
                    {
                     jQuery('#id_tms_edit_form').submit();
                    }
    			}
            }
		}
	}
 }

 function checkAttrColor(id)
 {
    var val_=jQuery('#amount_'+id).val();
    if(val_!='' && IsNumeric(val_))
    {
        jQuery('#amount_'+id).css('background-color','');
    }
 }

 function IsNumeric(sText)
 {
    var ValidChars = "0123456789.-";
    var IsNumber = true;
    var Char;
    for (i = 0; i < sText.length && IsNumber == true; i++) {
        Char = sText.charAt(i);
        if (ValidChars.indexOf(Char) == -1) {
            IsNumber = false;
        }
    }
    return IsNumber;
}

 function displayTMSText()
	{
	myamt= document.getElementsByName("amount[]");
	mytotalamt= document.getElementsByName("totalamt[]");

    //first empty
    for ( var loop_val=0; loop_val<10; loop_val++)
	{
	  mytotalamt[loop_val].value='';
	}


    ///0.deposit
	  var te=0.0;
	  for ( var a = 0; a <1; a++)
		{
				if ( myamt[a].value!="" )
				{
			  	te += parseFloat(myamt[a].value);
			  	mytotalamt[0].value= parseFloat(te);
				}

		}

	   ///1.Advance
	   var te=0.0;
	   for ( var b = a; b<2; b++)
		{
				if ( myamt[b].value!="" )
				{
			  	te += parseFloat(myamt[b].value);
			  	mytotalamt[1].value= parseFloat(te);
				}
		}

	   ///2.CL Amount
	   var te=0.0;
	   for ( var c = b; c<3; c++)
		{
				if ( myamt[c].value!="" )
				{
			  	te += parseFloat(myamt[c].value);
			  	mytotalamt[2].value= parseFloat(te);
				}
		}

	   ///3.CL Recovery/Reduce
	   	var te=0.0;
	   	for ( var d = c; d<7; d++)
		{
				if ( myamt[d].value!="" )
				{
			  	te += parseFloat(myamt[d].value);
			  	mytotalamt[3].value= parseFloat(te);
				}
		}
	   ///4.Cash Recovery
	   	var te=0.0;
	   	for ( var e = d; e<8; e++)
		{
				if ( myamt[e].value!="" )
				{
			  	te += parseFloat(myamt[e].value);
			  	mytotalamt[4].value= parseFloat(te);
				}
		}
	   ///5.Export
	   	var te=0.0;
	   	for ( var f = e; f<9; f++)
		{
				if ( myamt[f].value!="" )
				{
			  	te += parseFloat(myamt[f].value);
			  	mytotalamt[5].value= parseFloat(te);
				}
		}
	   ///6.Import
	  var te=0.0;
	  for ( var g = f; g<10; g++)
		{
				if ( myamt[g].value!="" )
				{
			  	te += parseFloat(myamt[g].value);
			  	mytotalamt[6].value= parseFloat(te);
				}
		}
	   ///7.Foreign Remittance
	  var te=0.0;
	  for ( var h = g; h<11; h++)
		{
				if ( myamt[h].value!="" )
				{
			  	te += parseFloat(myamt[h].value);
			  	mytotalamt[7].value= parseFloat(te);
				}
		}
	   ///8.Non Interest Income
	  var te=0.0;
	  for ( var i = h; i<12; i++)
		{
				if ( myamt[i].value!="" )
				{
			  	te += parseFloat(myamt[i].value);
			  	mytotalamt[8].value= parseFloat(te);
				}
		}
	   ///9.Profit & Loss
	  var te=0.0;
	  for ( var j = i; j<13; j++)
		{
				if ( myamt[j].value!="" )
				{
			  	te += parseFloat(myamt[j].value);
			  	mytotalamt[9].value= parseFloat(te);
				}
		}
    }


 function control_tms_report_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 /*function check_search_form(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#tms_search_form').submit();
        }
        else
        {
            alert('First Select Year Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='tms_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='tms_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#tms_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }*/
 function check_search_form(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#tms_search_form').submit();
        }
        else
        {
            alert('First Select Year Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='tms_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='tms_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#tms_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }


 function fetch_br_ao_do(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_doindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="2"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="2"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }

  function fetch_login_property(identity,sign)
 {
    if(identity !='' && sign != '')
    {
       var url = "http://localhost/rpd/index.php/auth_user/fetch_login_propertyindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'identity='+identity+'&sign='+sign,
              success: function (response) {
                if(response=='')
                {
                   if(sign=='emp_name'){jQuery('#txt_your_name').val('File No Not Exists');}
                   if(sign=='office_name'){jQuery('#txt_office_name').val('Give Correct Information');}
                }
                else
                {
                   if(sign=='emp_name'){jQuery('#txt_your_name').val(response);}
                   if(sign=='office_name'){jQuery('#txt_office_name').val(response);}
                }
              }
        });
    }
 }

 //TMS End By Zakariya

 //omis edit


  //omis start by zakariya
  function control_omis_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="2"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_omis(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5 || report_option_selector==7)
      {
        var report_date=jQuery('#report_of_date').val();
        if(report_date !='')
        {
            var report_click_btn=0;
            if(str=='Detail Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            if(str=='Summary Report'){report_click_btn=4;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#omis_search_form').submit();
        }
        else
        {
            alert('Select Date Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='omis_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='omis_report_office_id']:checked").val();
        }
        var report_date=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='Detail Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            if(str=='Summary Report'){report_click_btn=4;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#omis_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

 function fetch_br_ao_do_omis(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_do_omisindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="2"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="2"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }
 //omis end by zakariya


//cdms start by zakariya
  function control_cdms_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_cdms(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#cdms_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='cdms_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='cdms_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#cdms_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

 function fetch_br_ao_do_cdms(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_doindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="2"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="2"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }
 //cdms end by zakariya

  //co_cdms start by zakariya
  function control_co_cdms_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1)
        {
           jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else if(ptr==2)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');
          jQuery('#missing_list,#completed_list').show('slow');
        }
        else
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
          jQuery('#missing_list,#completed_list').show('slow');
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_co_cdms(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==4 || report_option_selector==3)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#co_cdms_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='co_cdms_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='co_cdms_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#co_cdms_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

 function fetch_br_ao_do_co_cdms(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_do_coindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }
 //co_cdms end by zakariya

  function fetch_login_property(identity)
 {
    if(identity !='')
    {
       var url = "index.php/auth_user/fetch_login_propertyindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'identity='+identity,
              success: function (response) {
                if(response=='')
                {
                   jQuery('#txt_your_name').val('File Number Not Exists');
                   jQuery('#txt_office_id').val('Give Correct Information');
                   jQuery('#txt_office_name').val('Give Correct Information');
                }
                else
                {
                   var response_arr=response.split('#');
                   jQuery('#txt_your_name').val(response_arr[0]);
                   jQuery('#txt_office_id').val(response_arr[1]);
                   jQuery('#txt_office_name').val(response_arr[2]);
                }
              }
        });
    }
 }



 //control_omis_form_edit_mode start
  function control_omis_form_edit_mode(btn_click)
 {
	if(btn_click =='Submit')
    {
		var dt_error=0;
		var adv_cl_amt_error=0;
		var adv_cl_ac_error=0;
		var msg='Instruction :\n';


		var datdate = jQuery('#datdate').val();
		if(datdate=='')
		{
			msg +='\n->Please select a date.';
			dt_error=1;
		}
		var adv_amt_total = jQuery('#totalamt_2').val();
		var cl_amt_total = jQuery('#totalamt_6').val();

		if(adv_amt_total !=cl_amt_total)
		{
			adv_cl_amt_error=1;
			msg +=' \n->Amount of Advance total (column:9-14) & CL Total (column:22-26) must be equal.';
		}

		var adv_ac_total = jQuery('#totalac_2').val();
		var cl_ac_total = jQuery('#totalac_6').val();

		if(adv_ac_total !=cl_ac_total)
		{
			adv_cl_ac_error=1;
			msg +=' \n->Account of Advance total (column:9-14) & CL Total (column:22-26) must be equal.';
		}

		if(dt_error==0 && adv_cl_amt_error==0 && adv_cl_ac_error==0)
		{
			if(confirm("Do you want to submit data for selected date: "+datdate))
			{
				jQuery('#id_omis_entry_form').submit();
			}
		}
		else
		{
			alert(msg);
		}
	}
	else
	{
	jQuery('#id_omis_entry_form').find('input[type="text"]').val('');
	}
 }

  function control_omis_form_edit_mode_edit(btn_click)
 {
	if(btn_click =='Save Changes')
    {
		var adv_cl_amt_error=0;
		var adv_cl_ac_error=0;
		var msg='Instruction :\n';

		var datdate = jQuery('#datdate').val();

		var adv_amt_total = jQuery('#totalamt_2').val();
		var cl_amt_total = jQuery('#totalamt_6').val();

		if(adv_amt_total !=cl_amt_total)
		{
			adv_cl_amt_error=1;
			msg +=' \n->Amount of Advance total (column:9-14) & CL Total (column:22-26) must be equal.';
		}

		var adv_ac_total = jQuery('#totalac_2').val();
		var cl_ac_total = jQuery('#totalac_6').val();

		if(adv_ac_total !=cl_ac_total)
		{
			adv_cl_ac_error=1;
			msg +='\n->Account of Advance total (column:9-14) & CL Total (column:22-26) must be equal.';
		}

		if(adv_cl_amt_error==0 && adv_cl_ac_error==0)
		{
			if(confirm("Do you want to submit data for selected date: "+datdate))
			{
				jQuery('#id_omis_entry_form_edit').submit();
			}
		}
		else
		{
			alert(msg);
		}
	}
	else
	{
	jQuery('#id_omis_entry_form_edit').find('input[type="text"]').val('');
	}
 }


  //control_omis_form_edit_mode end




  //COM & GRAPH start by zakariya

   function control_omis_com_graph_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="6"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_omis_com_graph(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5 || report_option_selector==7)
      {
        var report_date1=jQuery('#report_of_date1').val();
        var report_date2=jQuery('#report_of_date2').val();
        var report_date3=jQuery('#report_of_date3').val();

        if((report_date1 !='' && report_date2 !='' && report_date1 != report_date2) || (report_date2 !='' && report_date3 !='' && report_date2 != report_date3) || (report_date1 !='' && report_date3 !='' && report_date1 != report_date3) || (report_date1 !='' && report_date2 && report_date3 !='' && report_date1 != report_date2 && report_date2 != report_date3 && report_date1 != report_date3))
        {
            var report_click_btn=0;
            if(str=='Comparison'){report_click_btn=1;}
            if(str=='Graph'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#omis_search_form').submit();
        }
        else
        {
            if((report_date1 ==report_date2) || (report_date2 ==report_date3) || (report_date1 == report_date3))
            {
                alert('Please select atleast two dates. Each date should be different.');
            }
            else
            {
                alert('Please select date.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='omis_com_graph_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='omis_com_graph_office_id']:checked").val();
        }
        var report_date1=jQuery('#report_of_date1').val();
        var report_date2=jQuery('#report_of_date2').val();
        var report_date3=jQuery('#report_of_date3').val();
        var br_ao_do_text=jQuery('#search_text').val();
        if((br_ao_do !='0') && ((report_date1 !='' && report_date2 !='' && report_date1 != report_date2) || (report_date2 !='' && report_date3 !='' && report_date2 != report_date3) || (report_date1 !='' && report_date3 !='' && report_date1 != report_date3) || (report_date1 !='' && report_date2 && report_date3 !='' && report_date1 != report_date2 && report_date2 != report_date3 && report_date1 != report_date3)))
        {
            var report_click_btn=0;
            if(str=='Comparison'){report_click_btn=1;}
            if(str=='Graph'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#omis_search_form').submit();
        }
        else
        {
            if((report_date1 ==report_date2) || (report_date2 ==report_date3) || (report_date1 == report_date3))
            {
                alert('Please select atleast two dates. Each date should be different.');
            }
            else
            {
                alert('First Fill The Search Form Properly.');
            }
        }
      }
    }
 }

 function fetch_br_ao_do_omis_com_graph(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_do_omis_com_graphindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="6"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="6"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }


 // COMPARISON & GRAPH END

 //omis end by zakariya


 //misd_0001 start by zakariya
  function control_misd_0001_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0001(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0001_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0001_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

 function fetch_br_ao_do_report(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_do_reportindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }
 //misd_0001 end by zakariya


//misd_0002 start by zakariya

  function control_misd_0002_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0002(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_date=jQuery('#report_of_date').val();
        if(report_date !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0002_search_form').submit();
        }
        else
        {
            if(report_date =='')
            {
                alert('Select Date Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0002_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0002 end by zakariya


   //misd_0003 start by zakariya
  function control_misd_0003_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0003(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0003_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0003_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0003 end by zakariya


 //misd_0004 start by zakariya
  function control_misd_0004_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0004(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0004_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0004_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0004 end by zakariya


//misd_0005 start by zakariya
  function control_misd_0005_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0005(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0005_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0005_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0005 end by zakariya
 //misd_0006 start by RIPON
  function control_misd_0006_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0006(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_date').val();
        //var report_month=jQuery('#report_of_month').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0006_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Date Of Report.');
            }

        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date=jQuery('#report_of_date').val();
       // var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0006_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0006 end by RIPON

 //misd_0007 start by zakariya
  function control_misd_0007_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0007(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_date=jQuery('#report_of_date').val();
        if(report_date !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0007_search_form').submit();
        }
        else
        {
            if(report_date =='')
            {
                alert('Select Date Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0007_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0007 end by zakariya

 //misd_0008 start by zakariya
  function control_misd_0008_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0008(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_date=jQuery('#report_of_date').val();
        if(report_date !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0008_search_form').submit();
        }
        else
        {
            if(report_date =='')
            {
                alert('Select Date Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0008_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0008 end by zakariya

 //agg_tms_report start by zakariya
  function control_agg_tms_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_agg_tms_report(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#agg_tms_report_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='tms_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='tms_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#agg_tms_report_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //agg_tms_report end by zakariya

 //misd_0009 start by zakariya
  function control_misd_0009_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#upper_text').html('FILL FORM FOR REPORT');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#upper_text').html('JUST CLICK ON OPTION');
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0009(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0009_search_form').submit();
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0009_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0009 end by zakariya

 //misd_0010 start by zakariya
  function control_misd_0010_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0010(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0010_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0010_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

function showDevelopingBrList(ptr)
{
    if(ptr !='')
    {
      jQuery('#ptr_str').val(ptr);
      jQuery('#showDevelopingBrList').submit();
    }
}

 //misd_0010 end by zakariya

 //misd_0011 start by zakariya
  function control_misd_0011_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#upper_text').html('FILL FORM FOR REPORT');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#upper_text').html('JUST CLICK ON OPTION');
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0011(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0011_search_form').submit();
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0011_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

 function showDevelopingBrList_continuous(ptr)
{
    if(ptr !='')
    {
      jQuery('#ptr_str').val(ptr);
      jQuery('#showDevelopingBrList_continuous').submit();
    }
}
 //misd_0011 end by zakariya

 //misd_0012 start by zakariya
  function control_misd_0012_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0012(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='Cumulative Report'){report_click_btn=1;}
            if(str=='Analysis Report'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0012_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='Cumulative Report'){report_click_btn=1;}
            if(str=='Analysis Report'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0012_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

 //MISD_0012 End

   //misd_0013 start by RIPON
  function control_misd_0013_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0013(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_date').val();
        //var report_month=jQuery('#report_of_month').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0013_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Date Of Report.');
            }

        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date=jQuery('#report_of_date').val();
       // var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0013_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0013 end by RIPON


 //misd_0014 start by zakariya
  function control_misd_0014_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#upper_text').html('FILL FORM FOR REPORT');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#upper_text').html('JUST CLICK ON OPTION');
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0014(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0014_search_form').submit();
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0014_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

 function showBrList_specification(ptr)
{
    if(ptr !='')
    {
      jQuery('#ptr_str').val(ptr);
      jQuery('#showBrList_specification').submit();
    }
}
 //misd_0014 end by zakariya


 //misd_0015 start by zakariya
  function control_misd_0015_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0015(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_date=jQuery('#report_of_date').val();
        var range1=jQuery('#range1').val();
        var range2=jQuery('#range2').val();
        if(report_date !='' && (range1 !='' || range2 !=''))
        {

            var my_range_check=1;
            if(!IsNumeric(range1) || !IsNumeric(range2) || (range1=='' && range2==''))
            {
              my_range_check=0;
            }
            if(range1!='' && range2!='')
            {
            if(parseFloat(range1)>parseFloat(range2)){my_range_check=0;}
            }


            if(my_range_check==1)
            {
                jQuery('#report_click_btn').val(str);
                jQuery('#misd_0015_search_form').submit();
            }
            else
            {
              alert('Put valid range');
            }
        }
        else
        {
            if(report_date =='')
            {
                alert('Select Date Of Report.');
            }

            if(range1=='' && range2=='')
            {
                alert('Select atleast one range.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date=jQuery('#report_of_date').val();
        var range1=jQuery('#range1').val();
        var range2=jQuery('#range2').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='' && (range1 !='' || range2 !=''))
        {
            var my_range_check=1;
            if(!IsNumeric(range1) || !IsNumeric(range2) || (range1=='' && range2==''))
            {
              my_range_check=0;
            }
            if(range1!='' && range2!='')
            {
            if(parseFloat(range1)>parseFloat(range2)){my_range_check=0;}
            }

            if(my_range_check==1)
            {
                jQuery('#report_click_btn').val(str);
                jQuery('#misd_0015_search_form').submit();
            }
            else
            {
              alert('Put valid range');
            }
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0015 end by zakariya


 //start--misd_0016
    function controlPagination_all_history(total_page,present_page,movement)
    {
        var num=0;
        var check1=0;
        var check2=0;
        if(total_page>0)
        {
          if(movement=='front')
          {
            if(present_page==total_page)
            {
               check1 = 1;
               alert("This is the last page of "+total_page);
            }
            else
            {
                num=parseInt(present_page)+1;
            }
          }
          else
          {
            if(present_page==1)
            {
               check2 = 1;
               alert("This is the first page of "+total_page);
            }
            else
            {
                num=parseInt(present_page)-1;
            }
          }
        }
        else
        {
            num=1;
        }
        if(!(check1==1 || check2==1))
        {
            /*var cur_url =  window.location+'_';
            var array = cur_url.split("/");
            var lastsegment = array[array.length-1];
            if(lastsegment=='misd_0016_')
            {
                var next_url=window.location+'/'+num;
            }
            else if(lastsegment=='misd_0016index.php_')
            {
                var next_url=cur_url.replace(lastsegment,'misd_0016/'+num);
            }
            else
            {
               var next_url=cur_url.replace(lastsegment,num);
            }
            window.location.href=next_url;*/
            window.location.href='http://203.76.102.169:8033/rpd/index.php/report/misd_0016/'+num;
        }
    }


      function controlPagination_all_history_user(total_page,present_page,movement)
    {
        var num=0;
        var check1=0;
        var check2=0;
        if(total_page>0)
        {
          if(movement=='front')
          {
            if(present_page==total_page)
            {
               check1 = 1;
               alert("This is the last page of "+total_page);
            }
            else
            {
                num=parseInt(present_page)+1;
            }
          }
          else
          {
            if(present_page==1)
            {
               check2 = 1;
               alert("This is the first page of "+total_page);
            }
            else
            {
                num=parseInt(present_page)-1;
            }
          }
        }
        else
        {
            num=1;
        }
        if(!(check1==1 || check2==1))
        {
            /*var cur_url =  window.location+'_';
            var array = cur_url.split("/");
            var lastsegment = array[array.length-1];
            if(lastsegment=='misd_0016_')
            {
                var next_url=window.location+'/'+num;
            }
            else if(lastsegment=='misd_0016index.php_')
            {
                var next_url=cur_url.replace(lastsegment,'misd_0016/'+num);
            }
            else
            {
               var next_url=cur_url.replace(lastsegment,num);
            }
            window.location.href=next_url;*/
            window.location.href='http://203.76.102.169:8033/rpd/index.php/report/misd_0016_specific/'+num;
        }
    }

    function show_specific_user_history(file_no)
    {

       if(file_no !='')
        {
            jQuery('#specific_history_show').val('1');
            jQuery('#file_no').val(file_no);
            jQuery('#misd_0016_specific_form').submit();


        }
    }
	//end--misd_0016

	//misd_0017 start by zakariya
 function control_misd_0017_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0017(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_date=jQuery('#report_of_date').val();
        if(report_date !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0017_search_form').submit();
        }
        else
        {
            if(report_date =='')
            {
                alert('Select Date Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0017_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

//misd_0017 end by zakariya

//misd_0018 start by zakariya
 function control_misd_0018_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0018(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_date_one=jQuery('#report_of_date_one').val();
		var report_date_two=jQuery('#report_of_date_two').val();
		if(report_date_one !='' && report_date_two !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0018_search_form').submit();
        }
        else
        {
            if(report_date_one =='')
            {
                alert('Select first point.');
            }
			else
			{
			alert('Select second point.');
			}
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date_one=jQuery('#report_of_date_one').val();
		var report_date_two=jQuery('#report_of_date_two').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_date_one !='' &&report_date_two !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0018_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

//misd_0018 end by zakariya


//misd_0019 start by zakariya
  function control_misd_0019_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0019(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_date=jQuery('#report_of_date').val();
        if(report_date !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0019_search_form').submit();
        }
        else
        {
            if(report_date =='')
            {
                alert('Select Date Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0019_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0019 end by zakariya


 //misd_0020 start by zakariya
  function control_misd_0020_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0020(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0020_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0020_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

 //misd_0020 end by zakariya


 //misd_0021 start by zakariya
  function control_misd_0021_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0021(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0021_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0021_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

 //misd_0021 end by zakariya

 //misd_0022 start by ripon
  function control_misd_0022_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0022(str)
 {
    if(str !='')
    {
		var report_option_selector = jQuery('#report_option_selector').val();
		if(report_option_selector==1 || report_option_selector==5)
		{
			jQuery('#report_click_btn').val(str);
            jQuery('#misd_0022_search_form').submit();
			var report_date=jQuery('#report_of_year').val();
            if(report_date =='')
            {
                alert('Select Date Of Report.');
            }
		}
		else
		{
			var br_ao_do=0;
			if(jQuery("input[name='report_report_office_id']:checked").val()>0)
			{
				br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
			}
			var report_date=jQuery('#report_of_year').val();
            var br_ao_do_text=jQuery('#search_text').val();

			if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='')
			{
                jQuery('#report_click_btn').val(str);
                jQuery('#misd_0022_search_form').submit();
            }
			else
			{
				alert('First Fill The Search Form Properly.');
			}
      }
    }
 }
 //misd_0022 end by ripon


 //VSM Start
 function control_vsm_form(btn_click)
 {
    if(btn_click =='Submit')
    {

        var distance_adjacent_road=jQuery('#distance_adjacent_road').val();

        var cash_safe_limit = jQuery('#cash_safe_limit').val();
		var cash_counter_limit = jQuery('#cash_counter_limit').val();
		var cash_transit_limit = jQuery('#cash_transit_limit').val();

		var repair_no = jQuery('#repair_no').val();
        var premises_area = jQuery('#premises_area').val();
        var total_premises_rent = jQuery('#total_premises_rent').val();

		var mutilated_note_1 = jQuery('#mutilated_note_1').val();
        var mutilated_note_2 = jQuery('#mutilated_note_2').val();
        var mutilated_note_5 = jQuery('#mutilated_note_5').val();
        var mutilated_note_10 = jQuery('#mutilated_note_10').val();
        var mutilated_note_20 = jQuery('#mutilated_note_20').val();
        var mutilated_note_50 = jQuery('#mutilated_note_50').val();
        var mutilated_note_100 = jQuery('#mutilated_note_100').val();
        var mutilated_note_500 = jQuery('#mutilated_note_500').val();
        var mutilated_note_1000 = jQuery('#mutilated_note_1000').val();

		var approved_head_of_branch_name=jQuery('#approved_head_of_branch_name').val();
		var approved_head_of_branch_dsg=jQuery('#approved_head_of_branch_dsg').val();
        var approved_manager_name=jQuery('#approved_manager_name').val();
		var approved_manager_dsg=jQuery('#approved_manager_dsg').val();
		var approved_asst_manager_name=jQuery('#approved_asst_manager_name').val();
		var approved_asst_manager_dsg=jQuery('#approved_asst_manager_dsg').val();
		var approved_cashier_name=jQuery('#approved_cashier_name').val();
		var approved_cashier_dsg=jQuery('#approved_cashier_dsg').val();

        var vault_room_position=jQuery('#vault_room_position').val();

		var form_ok_status=1;
        form_ok_status_msg='';

		if(approved_head_of_branch_name=='')
        {
          form_ok_status_msg +="<br/>Head of branch name required";
          form_ok_status=0;
        }
		if(approved_head_of_branch_dsg=='')
        {
          form_ok_status_msg +="<br/>Head of branch designation required";
          form_ok_status=0;
        }

		if(approved_manager_name=='')
        {
          form_ok_status_msg +="<br/>Manager name required";
          form_ok_status=0;
        }
		if(approved_manager_dsg=='')
        {
          form_ok_status_msg +="<br/>Manager designation required";
          form_ok_status=0;
        }
		if(approved_asst_manager_name=='')
        {
          form_ok_status_msg +="<br/>Assistant Manager name required";
          form_ok_status=0;
        }
		if(approved_asst_manager_dsg=='')
        {
          form_ok_status_msg +="<br/>Assistant Manager designation required";
          form_ok_status=0;
        }

		if(approved_cashier_name=='')
        {
          form_ok_status_msg +="<br/>Cashier name required";
          form_ok_status=0;
        }
		if(approved_cashier_dsg=='')
        {
          form_ok_status_msg +="<br/>Cashier designation required";
          form_ok_status=0;
        }

		if(vault_room_position=='')
        {
          form_ok_status_msg +="<br/>Position of vault room required(1.4)";
          form_ok_status=0;
        }

        if(distance_adjacent_road=='' || !IsNumeric(distance_adjacent_road))
        {
          form_ok_status_msg +="<br/>Please fill adjacent road distance with numeric value(1.13)";
          form_ok_status=0;
        }
        if(cash_safe_limit=='' || !IsNumeric(cash_safe_limit))
        {
          form_ok_status_msg +="<br/>Please fill cash-safe-limit with numeric value(4.1)";
          form_ok_status=0;
        }
		if(cash_counter_limit=='' || !IsNumeric(cash_counter_limit))
        {
          form_ok_status_msg +="<br/>Please fill cash-counter-limit with numeric value(4.2)";
          form_ok_status=0;
        }
		if(cash_transit_limit=='' || !IsNumeric(cash_transit_limit))
        {
          form_ok_status_msg +="<br/>Please fill cash-transit-limit with numeric value(4.3)";
          form_ok_status=0;
        }
        if((mutilated_note_1 =='' || !IsNumeric(mutilated_note_1)) || (mutilated_note_2 =='' || !IsNumeric(mutilated_note_2)) || (mutilated_note_5 =='' || !IsNumeric(mutilated_note_5)) || (mutilated_note_10 =='' || !IsNumeric(mutilated_note_10)) || (mutilated_note_20 =='' || !IsNumeric(mutilated_note_20)) || (mutilated_note_50 =='' || !IsNumeric(mutilated_note_50)) || (mutilated_note_100 =='' || !IsNumeric(mutilated_note_100)) || (mutilated_note_500 =='' || !IsNumeric(mutilated_note_500)) || (mutilated_note_1000 =='' || !IsNumeric(mutilated_note_1000)))
        {
          form_ok_status_msg +="<br/>Number of mutilated note should be numeric(4.5)";
          form_ok_status=0;
        }

		if(repair_no=='' || !IsNumeric(repair_no))
        {
          form_ok_status_msg +="<br/>Please fill 'No of Repair' with numeric value(1.16).Fill with '0' if not applicable.";
          form_ok_status=0;
        }
		if(premises_area=='' || !IsNumeric(premises_area))
        {
          form_ok_status_msg +="<br/>Please fill 'Area of branch premises' with numeric value(1.17).Fill with '0' if not applicable.";
          form_ok_status=0;
        }
		if(total_premises_rent=='' || !IsNumeric(total_premises_rent))
        {
          form_ok_status_msg +="<br/>Please fill 'Total rent of branch premises' with numeric value(1.18).Fill with '0' if not applicable.";
          form_ok_status=0;
        }

        if(form_ok_status==1)
        {
            jQuery('#form_fill_warning_span').html('');
            jQuery('#form_fill_warning_div').css("display", "none");

            if(confirm("Do you want to submit?"))
			{
                if(btn_click =='Submit')
                {
                 jQuery('form#id_vsm_data_submit_form').submit();
                }
			}
        }
        else
        {
          jQuery(window).scrollTop(0);
          jQuery('#form_fill_warning_span').html(form_ok_status_msg);
          jQuery('#form_fill_warning_div').css("display", "block");
        }
	}
 }

  function control_vsm_report_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        var login_office_status=jQuery('#login_office_status').val();
        if(login_office_status==4 || ptr==2)
        {
            jQuery('#missing_list,#completed_list').hide('slow');
            jQuery('#view_report').show('slow');
        }
        else
        {
            jQuery('#missing_list,#completed_list').show('slow');
            jQuery('#view_report').hide('slow');
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function fetch_br_ao_do_vsm(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_doindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }

 function check_search_form_vsm(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#vsm_search_form').submit();
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='vsm_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='vsm_report_office_id']:checked").val();
        }
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#vsm_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //VSM End



 ////////////////Weekly Position Start here//////////////////
function check_search_form_weekly(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_date').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#weekly_pos_search_form').submit();
        }
        else
        {
            alert('First Select Date Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='weekly_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='weekly_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#weekly_pos_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

function control_weekly_position_form(btn_click)
 {

	if(btn_click =='Submit' || btn_click =='Save Changes')
    {
		var year = jQuery('#weekly_date').val();
		if(year=='')
		{
			alert("Please select a Date.");
		}
		else
		{
            is_empty=0;
            for ( var loop_val=1; loop_val<=51; loop_val++)
        	{
        	  var val_=jQuery('#amount_'+loop_val).val();
              if(val_=='' || !IsNumeric(val_))
              {
                is_empty=1;
                jQuery('#amount_'+loop_val).css('background-color','#FF6600');
              }
        	}

            if(is_empty == 1)
            {
                alert('Fill all amount fields & must input neumaric value only.');
            }
            else
            {
                if(confirm("Do you want to submit data for selected date: "+year))
    			{
    				if(btn_click =='Submit' || btn_click =='Save Changes')
                    {
						 var date_exist = jQuery('#omis_date_exist').val();
						 if(date_exist==3)
						 {
							jQuery('#id_weekly_position_entry_form').submit();
						 }
						 else if(date_exist==4)
						 {
							var weekly_deposit = jQuery('#total_amt_deposit_weekly').val();
							var weekly_advance = jQuery('#total_amt_advance_weekly').val();
							var weekly_cash = jQuery('#total_amt_cash_weekly').val();

							var omis_deposit = jQuery('#total_amt_deposit_omis').val();
							var omis_advance = jQuery('#total_amt_advance_omis').val();
							var omis_cash = jQuery('#total_amt_cash_omis').val();

							weekly_deposit=parseFloat(weekly_deposit);
							omis_deposit=parseFloat(omis_deposit);

							weekly_advance=parseFloat(weekly_advance);
							omis_advance=parseFloat(omis_advance);

							weekly_cash=parseFloat(weekly_cash);
							omis_cash=parseFloat(omis_cash);

							var deposit=0;
							var advance=0;
							var cashhand=0;
							if(weekly_deposit>omis_deposit)
							{
								deposit=weekly_deposit-omis_deposit;
							}
							else if(weekly_deposit<omis_deposit)
							{
								deposit=omis_deposit-weekly_deposit;
							}

							if(weekly_advance>omis_advance)
							{
								advance=weekly_advance-omis_advance;
							}
							else if(weekly_advance<omis_advance)
							{
								advance=omis_advance-weekly_advance;
							}

							if(weekly_cash>omis_cash)
							{
								cashhand=weekly_cash-omis_cash;
							}
							else if(weekly_cash<omis_cash)
							{
								cashhand=omis_cash-weekly_cash;
							}
							if(btn_click =='Submit')
							{
								if(deposit<=500 && advance<=500 && cashhand<=500)
								{
									jQuery('#id_weekly_position_entry_form').submit();
								}
								else
								{
									alrt_msg='';
									if(deposit>500)
										{
											alrt_msg='Deposit';
										}

										if(advance>500)
										{
											if(alrt_msg !=''){alrt_msg +=',';}
											alrt_msg +='Advance';
										}
										if(cashhand>500)
										{
											if(alrt_msg !=''){alrt_msg +=',';}
											alrt_msg +='Cash in hand';
										}

										alert('Difference between OMIS Total & Weekly Total should be equal for : '+alrt_msg);

								}
							}
							if(btn_click =='Save Changes')
							{
								if(deposit<=500 && advance<=500 && cashhand<=500)
								{
									jQuery('#id_weekly_position_edit_form').submit();
								}
								else
								{
									alrt_msg='';
									if(deposit>500)
										{
											alrt_msg='Deposit';
										}

										if(advance>500)
										{
											if(alrt_msg !=''){alrt_msg +=',';}
											alrt_msg +='Advance';
										}
										if(cashhand>500)
										{
											if(alrt_msg !=''){alrt_msg +=',';}
											alrt_msg +='Cash in hand';
										}

										alert('Difference between OMIS Total & Weekly Total should be less than or equal to 500 for : '+alrt_msg);

								}
							 }
							}
/////////////////////////////////////////////////////////////////////////////////////////////////////
						else if(date_exist==10)
						 {
							if(btn_click =='Save Changes')
							{
								jQuery('#id_weekly_position_edit_form').submit();
							}
						}
///////////////////////////////////////////////////////////////////////////////////////////////////////
					}

    			}
            }
		}
	}
 }

 function control_weekly_pos_report_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

	/*
	function displayweeklyText()
	{

		var total_dp_ex_bp=0;
		var total_dp=0;
        var total_dp_fc=0;
		var total_adv=0;
		var total_cashInHand=0;

		for ( var i = 1; i<55; i++)
		{
			var cur_amt=jQuery('#amount_'+i).val();

			if((i>0 && i<15) || i==19){total_dp_ex_bp=total_dp_ex_bp+parseFloat(cur_amt);}
			if((i>0 && i<15) || (i>18 && i<23)){total_dp=total_dp+parseFloat(cur_amt);}
            if(i>14 && i<19)
            {
                if(i==18)
                {
                 total_dp_fc=total_dp_fc-parseFloat(cur_amt);
                }
                else
                {
                  total_dp_fc=total_dp_fc+parseFloat(cur_amt);
                }

            }
			if(i>32 && i<42){total_adv=total_adv+parseFloat(cur_amt);}
			if(i>41 && i<53){total_cashInHand=total_cashInHand+parseFloat(cur_amt);}

		}

		jQuery('#total_amt_deposit_weekly_ex_bp').val(total_dp_ex_bp.to);
		jQuery('#total_amt_deposit_weekly').val(total_dp);
        jQuery('#deposit_foreign_currency').val(total_dp_fc);
		jQuery('#total_amt_advance_weekly').val(total_adv);
		jQuery('#total_amt_cash_weekly').val(total_cashInHand);
	}*/

	function displayweeklyText()
	{

		var total_dp_ex_bp=0;
		var total_dp=0;
        var total_dp_fc=0;
		var total_adv=0;
		var total_cashInHand=0;

		for ( var i = 1; i<55; i++)
		{
			var cur_amt=jQuery('#amount_'+i).val();

			if((i>0 && i<20)){total_dp_ex_bp=total_dp_ex_bp+parseFloat(cur_amt);}
			if((i>0 && i<23)){total_dp=total_dp+parseFloat(cur_amt);}
            if(i>14 && i<18)
            {
                total_dp_fc=total_dp_fc+parseFloat(cur_amt);
            }
			if(i>32 && i<42){total_adv=total_adv+parseFloat(cur_amt);}
			if(i>41 && i<53){total_cashInHand=total_cashInHand+parseFloat(cur_amt);}

		}

		jQuery('#total_amt_deposit_weekly_ex_bp').val(total_dp_ex_bp.toFixed(2));
		jQuery('#total_amt_deposit_weekly').val(total_dp.toFixed(2));
        jQuery('#deposit_foreign_currency').val(total_dp_fc.toFixed(2));
		jQuery('#total_amt_advance_weekly').val(total_adv.toFixed(2));
		jQuery('#total_amt_cash_weekly').val(total_cashInHand.toFixed(2));
	}

	/////////////////Weekly Position End///////////////////


	//misd_0023 start by zakariya
  function control_misd_0023_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0023(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0023_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0023_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0023 end by zakariya

//misd_0032 start by zakariya
  function control_misd_0032_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0032(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0032_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0032_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0032 end by zakariya

 //misd_0033 start
  function control_misd_0033_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0033(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0033_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0033_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0033 end


 //misd_0034 start
  function control_misd_0034_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0034(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0034_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0034_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0034 end


 //misd_0035 start by zakariya

 function check_search_form_misd_0035(str)
 {
    if(str !='')
    {
        var error_msg='';
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var login_office_status=jQuery('#login_office_status').val();
        if(report_year !='' && report_month !='' && login_office_status==4)
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#error_msg').html('');
            jQuery('#error_msg').hide('slow');
            jQuery('#misd_0035_search_form').submit();
        }
        else
        {

            if(login_office_status !=4)
            {
               alert('You are not allowed to view this report. Only Branch user can view their own report.');
               error_msg='You are not allowed to view this report. Only Branch user can view their own report.';
            }
            else
            {
                if(report_year =='')
                {
                    alert('Select year of report.');
                    error_msg='Select year of report.';
                }
                else
                {
                  alert('Select month of report.');
                  error_msg='Select month of report.';
                }
            }
            jQuery('#error_msg').show('slow');
            jQuery('#error_msg').html(error_msg);
        }
    }
 }
 //misd_0035 end by zakariya

     //misd_0036 start by zakariya
  function control_misd_0036_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0036(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0036_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0036_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0036 end by zakariya

 //misd_0037 start by zakariya
  function control_misd_0037_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0037(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0037_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Quarter Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0037_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0037 end by zakariya

     //misd_0038 start by zakariya
  function control_misd_0038_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0038(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0038_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0038_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0038 end by zakariya

 //misd_0040 start

 function control_misd_0040_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0040(str)
 {
   if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5 || report_option_selector==7)
      {
        var report_date1=jQuery('#report_of_date1').val();
        var report_date2=jQuery('#report_of_date2').val();
        if(report_date1 !='' && report_date2 !='' && report_date1 != report_date2)
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0040_search_form').submit();
        }
        else
        {
            if(report_date1 ==report_date2)
            {
                alert('Same date selected. Please select different date.');
            }
            else
            {
                alert('Please select date.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date1=jQuery('#report_of_date1').val();
        var report_date2=jQuery('#report_of_date2').val();
        var br_ao_do_text=jQuery('#search_text').val();
        if(br_ao_do !='0' && report_date1 !='' && report_date2 !='' && br_ao_do_text !='' && report_date1 != report_date2)
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0040_search_form').submit();
        }
        else
        {
            if(report_date1 ==report_date2)
            {
                alert('Same date selected. Please select different date.');
            }
            else
            {
                alert('First Fill The Search Form Properly.');
            }
        }
      }
    }
 }

 //misd_0040 end


  //misd_0041 start by zakariya

  function control_misd_0041_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0041(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_date=jQuery('#report_of_date').val();
        var head_account_radio=jQuery('input[name=head_account_radio]:checked').val();
        if(report_date !='' && typeof(head_account_radio) !='undefined')
        {

            var final_error=0;
            if(head_account_radio==1)
            {
               var head_account=jQuery('#head_account').val();
               if(head_account=='')
               {
                final_error=1;
                alert('Please select head account');
               }
            }
            if(head_account_radio==2)
            {
               var single_account=jQuery('#single_account').val();
               if(single_account=='')
               {
                final_error=1;
                alert('Please select single account');
               }
            }

            if(final_error==0)
            {
                var head_text=jQuery('select[name="head_account"] option:selected').text();
                var single_text=jQuery('select[name="single_account"] option:selected').text();

                var report_click_btn=0;
                if(str=='View Report'){report_click_btn=1;}
                if(str=='Save Report As PDF'){report_click_btn=2;}
                jQuery('#report_click_btn').val(report_click_btn);
                jQuery('#head_text').val(head_text);
                jQuery('#single_text').val(single_text);
                jQuery('#misd_0041_search_form').submit();
            }
        }
        else
        {
            if(report_date =='' && typeof(head_account_radio)=='undefined')
            {
                alert('Please select date and head/single account');
            }
            else
            {
             if(report_date==''){alert('Please select date');}
             if(typeof(head_account_radio)=='undefined'){alert('Please select head/single account');}
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();
        var head_account_radio=jQuery('input[name=head_account_radio]:checked').val();

        if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='' && typeof(head_account_radio) !='undefined')
        {
            var final_error=0;
            if(head_account_radio==1)
            {
               var head_account=jQuery('#head_account').val();
               if(head_account=='')
               {
                final_error=1;
                alert('Please select head account');
               }
            }
            if(head_account_radio==2)
            {
               var single_account=jQuery('#single_account').val();
               if(single_account=='')
               {
                final_error=1;
                alert('Please select single account');
               }
            }

            if(final_error==0)
            {
                var head_text=jQuery('select[name="head_account"] option:selected').text();
                var single_text=jQuery('select[name="single_account"] option:selected').text();

                var report_click_btn=0;
                if(str=='View Report'){report_click_btn=1;}
                if(str=='Save Report As PDF'){report_click_btn=2;}
                jQuery('#report_click_btn').val(report_click_btn);
                jQuery('#head_text').val(head_text);
                jQuery('#single_text').val(single_text);
                jQuery('#misd_0041_search_form').submit();
            }
        }
        else
        {
            if(report_date =='' && typeof(head_account_radio)=='undefined' && br_ao_do =='0')
            {
                alert('Please select date,head/single account and office');
            }
            else
            {
             if(report_date==''){alert('Please select date');}
             else if(typeof(head_account_radio)=='undefined'){alert('Please select head/single account');}
             else if(br_ao_do =='0'){alert('Please select office');}
             else
             {
                alert('Please fill search form properly to view report');
             }
            }
        }
      }
    }
 }

 function manage_group_subgroup_option(sign)
 {
    if(sign !='')
    {
        if(sign==1)
        {
          jQuery('#single_account').val('');
          jQuery('#single_account_div').hide('slow');
          jQuery('#head_account_div').show('slow');
        }
        if(sign==2)
        {
          jQuery('#head_account').val('');
          jQuery('#head_account_div').hide('slow');
          jQuery('#single_account_div').show('slow');
        }
    }

 }
 //misd_0041 end by zakariya

 //misd_0042 start by zakariya

  function control_misd_0042_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0042(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_date1=jQuery('#report_of_date1').val();
        var report_date2=jQuery('#report_of_date2').val();
        var head_account_radio=jQuery('input[name=head_account_radio]:checked').val();
        if(report_date1 !='' && report_date2 !='' && typeof(head_account_radio) !='undefined')
        {

            var final_error=0;
            if(head_account_radio==1)
            {
               var head_account=jQuery('#head_account').val();
               if(head_account=='')
               {
                final_error=1;
                alert('Please select head account');
               }
            }
            if(head_account_radio==2)
            {
               var single_account=jQuery('#single_account').val();
               if(single_account=='')
               {
                final_error=1;
                alert('Please select single account');
               }
            }

            if(final_error==0)
            {
                var head_text=jQuery('select[name="head_account"] option:selected').text();
                var single_text=jQuery('select[name="single_account"] option:selected').text();

                var report_click_btn=0;
                if(str=='View Report'){report_click_btn=1;}
                if(str=='Save Report As PDF'){report_click_btn=2;}
                jQuery('#report_click_btn').val(report_click_btn);
                jQuery('#head_text').val(head_text);
                jQuery('#single_text').val(single_text);
                jQuery('#misd_0042_search_form').submit();
            }
        }
        else
        {
            if(report_date1 =='' && report_date2 =='' && typeof(head_account_radio)=='undefined')
            {
                alert('Please select 1st date,2nd date and head/single account');
            }
            else
            {
             if(report_date1==''){alert('Please select 1st date');}
             if(report_date2==''){alert('Please select 2nd date');}
             if(typeof(head_account_radio)=='undefined'){alert('Please select head/single account');}
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date1=jQuery('#report_of_date1').val();
        var report_date2=jQuery('#report_of_date2').val();
        var br_ao_do_text=jQuery('#search_text').val();
        var head_account_radio=jQuery('input[name=head_account_radio]:checked').val();

        if(br_ao_do !='0' && report_date1 !='' && report_date2 !='' && br_ao_do_text !='' && typeof(head_account_radio) !='undefined')
        {
            var final_error=0;
            if(head_account_radio==1)
            {
               var head_account=jQuery('#head_account').val();
               if(head_account=='')
               {
                final_error=1;
                alert('Please select head account');
               }
            }
            if(head_account_radio==2)
            {
               var single_account=jQuery('#single_account').val();
               if(single_account=='')
               {
                final_error=1;
                alert('Please select single account');
               }
            }

            if(final_error==0)
            {
                var head_text=jQuery('select[name="head_account"] option:selected').text();
                var single_text=jQuery('select[name="single_account"] option:selected').text();

                var report_click_btn=0;
                if(str=='View Report'){report_click_btn=1;}
                if(str=='Save Report As PDF'){report_click_btn=2;}
                jQuery('#report_click_btn').val(report_click_btn);
                jQuery('#head_text').val(head_text);
                jQuery('#single_text').val(single_text);
                jQuery('#misd_0042_search_form').submit();
            }
        }
        else
        {
            if(report_date1 =='' && report_date2 =='' && typeof(head_account_radio)=='undefined' && br_ao_do =='0')
            {
                alert('Please select 1st date,2nd date,head/single account and office');
            }
            else
            {
             if(report_date1==''){alert('Please select 1st date');}
             if(report_date2==''){alert('Please select 2nd date');}
             else if(typeof(head_account_radio)=='undefined'){alert('Please select head/single account');}
             else if(br_ao_do =='0'){alert('Please select office');}
             else
             {
                alert('Please fill search form properly to view report');
             }
            }
        }
      }
    }
 }
 //misd_0042 end by zakariya

 //misd_0043 start by zakariya

 function check_search_form_misd_0043(str)
 {
    if(str !='')
    {
        var error_msg='';
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var login_office_status=jQuery('#login_office_status').val();
        if(report_year !='' && report_month !='' && login_office_status==4)
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#error_msg').html('');
            jQuery('#error_msg').hide('slow');
            jQuery('#misd_0043_search_form').submit();
        }
        else
        {

            if(login_office_status !=4)
            {
               alert('You are not allowed to view this report. Only Branch user can view their own report.');
               error_msg='You are not allowed to view this report. Only Branch user can view their own report.';
            }
            else
            {
                if(report_year =='')
                {
                    alert('Select year of report.');
                    error_msg='Select year of report.';
                }
                else
                {
                  alert('Select month of report.');
                  error_msg='Select month of report.';
                }
            }
            jQuery('#error_msg').show('slow');
            jQuery('#error_msg').html(error_msg);
        }
    }
 }
 //misd_0043 end by zakariya

  //REI Start By Zakariya
  function control_rei_form(btn_click)
 {
    if(btn_click =='Submit' || btn_click =='Save Changes')
    {
		var year = jQuery('#rei_year').val();
		if(year=='')
		{
            alert("Please select year.");
		}
		else
		{
            is_empty=0;
            for ( var loop_val=1; loop_val<=34; loop_val++)
        	{
        	  var val_=jQuery('#amount_'+loop_val).val();
              if(val_=='' || !IsNumeric(val_))
              {
                is_empty=1;
                jQuery('#amount_'+loop_val).css('background-color','#FF6600');
              }
        	}

            if(is_empty == 1)
            {
                alert('Fill all amount fields & must input neumaric value only.');
            }
            else
            {
                if(confirm("Do you want to submit data for selected year: "+year+" ?"))
    			{
    				if(btn_click =='Submit')
                    {
                     jQuery('#id_rei_entry_form').submit();
                    }
                    if(btn_click =='Save Changes')
                    {
                     jQuery('#id_rei_edit_form').submit();
                    }
    			}
            }
		}
	}
 }

 function displayREIText()
	{
    myamt= document.getElementsByName("amount[]");
	mytotalamt= document.getElementsByName("totalamt[]");

    //first empty
    for ( var loop_val=0; loop_val<11; loop_val++)
	{
	  mytotalamt[loop_val].value='';
	}


    ///0.Aggregate Outstanding Amount(End of the year)
	  var te=0.0;
	  for ( var a = 0; a <4; a++)
		{
                if ( myamt[a].value!="" )
				{
			  	te += parseFloat(myamt[a].value);
			  	mytotalamt[0].value= parseFloat(te);
				}

		}

	   ///1.Aggregate value of all *Eligible Collateral(End of the year)
	   var te=0.0;
	   for ( var b = a; b<8; b++)
		{
				if ( myamt[b].value!="" )
				{
			  	te += parseFloat(myamt[b].value);
			  	mytotalamt[1].value= parseFloat(te);
				}
		}

	   ///2.Value of Land and Building as * Eligible Collateral(End of the year)
	   var te=0.0;
	   for ( var c = b; c<12; c++)
		{
				if ( myamt[c].value!="" )
				{
			  	te += parseFloat(myamt[c].value);
			  	mytotalamt[2].value= parseFloat(te);
				}
		}

	   ///3.**Market value of Land & Building kept as collateral(End of the year)
	   	var te=0.0;
	   	for ( var d = c; d<16; d++)
		{
				if ( myamt[d].value!="" )
				{
			  	te += parseFloat(myamt[d].value);
			  	mytotalamt[3].value= parseFloat(te);
				}
		}
	   ///4.**Forced Sales Value of Land & Building kept as collateral(End of the year)
	   	var te=0.0;
	   	for ( var e = d; e<20; e++)
		{
				if ( myamt[e].value!="" )
				{
			  	te += parseFloat(myamt[e].value);
			  	mytotalamt[4].value= parseFloat(te);
				}
		}
	   ///5.***Aggregate size of land & Building(in million square feet)
	   	var te=0.0;
	   	for ( var f = e; f<24; f++)
		{
				if ( myamt[f].value!="" )
				{
			  	te += parseFloat(myamt[f].value);
			  	mytotalamt[5].value= parseFloat(te);
				}
		}

        ///6.Aggregate Outstanding Loan Amount(End of the year)
	   	var te=0.0;
	   	for ( var g = f; g<26; g++)
		{
				if ( myamt[g].value!="" )
				{
			  	te += parseFloat(myamt[g].value);
			  	mytotalamt[6].value= parseFloat(te);
				}
		}

        ///7.Aggregate Classified Loan in Real Estate(End of the year)
	   	var te=0.0;
	   	for ( var h = g; h<28; h++)
		{
				if ( myamt[h].value!="" )
				{
			  	te += parseFloat(myamt[h].value);
			  	mytotalamt[7].value= parseFloat(te);
				}
		}

        ///8.Aggregate Outstanding Loan Amount in Dhaka and Chittagong City(End of the year)
	   	var te=0.0;
	   	for ( var i = h; i<30; i++)
		{
				if ( myamt[i].value!="" )
				{
			  	te += parseFloat(myamt[i].value);
			  	mytotalamt[8].value= parseFloat(te);
				}
		}

        ///9.Aggregate Outstanding Loan Amount other than Dhaka and Chittagong City(End of the year)
	   	var te=0.0;
	   	for ( var j = i; j<32; j++)
		{
				if ( myamt[j].value!="" )
				{
			  	te += parseFloat(myamt[j].value);
			  	mytotalamt[9].value= parseFloat(te);
				}
		}

        ///10.****Aggregate Market Value of Real Estate property
	   	var te=0.0;
	   	for ( var k = j; k<34; k++)
		{
				if ( myamt[k].value!="" )
				{
			  	te += parseFloat(myamt[k].value);
			  	mytotalamt[10].value= parseFloat(te);
				}
		}

    }


 function control_rei_report_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_rei(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#rei_search_form').submit();
        }
        else
        {
            alert('First Select Year Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='rei_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='rei_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#rei_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //REI End By Zakariya

  //misd_0044 start by zakariya
  function control_misd_0044_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0044(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='Deposit'){report_click_btn=1;}
            if(str=='Advance'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0044_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Quarter Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='Deposit'){report_click_btn=1;}
            if(str=='Advance'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0044_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0044 end by zakariya

 //misd_0045 start by zakariya
  function control_misd_0045_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0045(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5 || report_option_selector==7)
      {
        var report_date1=jQuery('#report_of_date1').val();
        var report_date2=jQuery('#report_of_date2').val();

        if(report_date1 !='' && report_date2 !='' && report_date1 != report_date2)
        {
            jQuery('#report_click_btn').val(str);
            jQuery('#misd_0045_search_form').submit();
        }
        else
        {
            if((report_date1 ==report_date2))
            {
                alert('Please select atleast two dates. Each date should be different.');
            }
            else
            {
                alert('Please select date.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_date1=jQuery('#report_of_date1').val();
        var report_date2=jQuery('#report_of_date2').val();
        var br_ao_do_text=jQuery('#search_text').val();
        if((br_ao_do !='0') && (report_date1 !='' && report_date2 !='' && report_date1 != report_date2))
        {
            jQuery('#report_click_btn').val(str);
            jQuery('#misd_0045_search_form').submit();
        }
        else
        {
            if((report_date1==report_date2))
            {
                alert('Please select atleast two dates. Each date should be different.');
            }
            else
            {
                alert('First Fill The Search Form Properly.');
            }
        }
      }
    }
 }
 //misd_0045 end by zakariya

 //misd_0046 start by zakariya
  function control_misd_0046_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0046(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='Summary Report'){report_click_btn=1;}
            if(str=='Detail Report'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0046_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='Summary Report'){report_click_btn=1;}
            if(str=='Detail Report'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0046_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0046 end by zakariya

  //misd_0047 start
  function control_misd_0047_report_form(ptr)
 {

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0047(str)
 {
	if(str !='')
    {
		var report_option_selector = jQuery('#report_option_selector').val();
		if(report_option_selector==1 || report_option_selector==5)
		{
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0047_search_form').submit();
			var report_date=jQuery('#report_of_year').val();
            if(report_date =='')
            {
                alert('Select Date Of Report.');
            }
		}
		else
		{
			var br_ao_do=0;
			if(jQuery("input[name='report_report_office_id']:checked").val()>0)
			{
				br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
			}
			var report_date=jQuery('#report_of_year').val();
            var br_ao_do_text=jQuery('#search_text').val();

			if(br_ao_do !='0' && report_date !='' && br_ao_do_text !='')
			{
                var report_click_btn=0;
                if(str=='View Report'){report_click_btn=1;}
                if(str=='Save Report As PDF'){report_click_btn=2;}
                jQuery('#report_click_btn').val(report_click_btn);
                jQuery('#misd_0047_search_form').submit();
            }
			else
			{
				alert('First Fill The Search Form Properly.');
			}
      }
    }
 }
 //misd_0047 end

 //misd_0048 start by zakariya
  function control_misd_0048_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0048(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0048_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0048_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0048 end by zakariya

  //misd_0049 start by zakariya
  function control_misd_0049_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0049(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0049_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0049_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0049 end by zakariya

   //misd_0050 start by zakariya
  function control_misd_0050_report_form(ptr)
 {
    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="3"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function check_search_form_misd_0050(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        if(report_year !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0050_search_form').submit();
        }
        else
        {
            if(report_year =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_year').val();
        var report_month=jQuery('#report_of_month').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='' && report_month !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#misd_0050_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
 //misd_0050 end by zakariya



//ISS Stsrt here/////////
function fetch_br_ao_do_iss(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_do_issindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="2"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="2"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }


 function control_iss_report_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }


 function check_search_form_iss(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_date').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_search_form').submit();
        }
        else
        {
            alert('First Select Date Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='iss_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='iss_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
function control_iss_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }

 function control_iss_2_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table_n').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table_n').hide('slow');
    }
 }

/*Edit this start*/
function certificate_iss_form(btn_click)
 {

	if(btn_click =='Submit')
    {
		var test= $("#cer_check").is(':checked')
		if(test)
		{
			var option_selector = jQuery('#report_option_selector').val();
			var office_status = jQuery('#login_office_status').val();
			var office_check = jQuery('#report_office_check').val();

			//if(office_status==4 && option_selector==1 && office_check==1)
			if(office_status==4 && office_check==1)
			{
				var br_concern_officer_name = jQuery('#br_concern_officer_name').val();
				var br_head_name = jQuery('#br_head_name').val();
				var br_concern_officer_desig = jQuery('#br_concern_officer_designation').val();
				var br_head_desig = jQuery('#br_head_designation').val();
				//if(br_concern_officer_name !='' && br_head_name !='' && br_concern_officer_desig !='' && br_head_desig !='')
				//alert("NOMM");
				//if(br_head_name !='' && br_head_desig !='')
				if(br_concern_officer_name !='' && br_head_name !='' && br_concern_officer_desig !='' && br_head_desig !='')
				{
					var valid_check= jQuery('#valid_check').val();
					if(valid_check == 1)
					{
						alert("Your Data is wrong format, Please upload correct data.");
					}
					else
					{
						if(valid_check == 0)
						{
							jQuery('#id_iss_certificate_form').submit();
						}
					}
				}
				else
				{
					alert("Please fill up all field.");
				}

			}
			else
			{
				//if(office_status !=4 && option_selector==1 && office_check==1)
				if(office_status !=4 && office_check==1)
				{
					var bad_concern_officer_name_1 = jQuery('#concern_officer_name_1').val();
					var bad_concern_officer_name_2 = jQuery('#concern_officer_name_2').val();
					var bad_concern_officer_name_3 = jQuery('#concern_officer_name_3').val();
					var bad_head_name = jQuery('#ro_dv_head_name').val();
					var bad_concern_officer_desig_1 = jQuery('#concern_officer_desig_1').val();
					var bad_concern_officer_desig_2 = jQuery('#concern_officer_desig_2').val();
					var bad_concern_officer_desig_3 = jQuery('#concern_officer_desig_3').val();
					var bad_head_desig = jQuery('#ro_dv_head_designation').val();

					//if(bad_concern_officer_name_1 !='' && bad_concern_officer_name_2 !='' && bad_concern_officer_name_3 !='' && bad_head_name !=''
					  //&& bad_concern_officer_desig_1 && bad_concern_officer_desig_2 && bad_concern_officer_desig_3 && bad_head_desig)
					  //if(bad_head_name !='' && bad_head_desig !='')

						var total_list = jQuery('#total_list').val();
						var com_list = jQuery('#com_list').val();
						if(total_list == com_list)
						{
							//alert("Yes");
							var valid_check= jQuery('#valid_check').val();
							if(valid_check == 1)
							{
								alert("Your Data is wrong format, Please upload correct data.");
							}
							else
							{
								if(valid_check == 0)
								{
									jQuery('#id_iss_certificate_form').submit();
								}
							}

						}
						else
						{
							alert("All Branch is not Certified....");
						}
				}
			}
		}
		else
		{
			alert("Please Select Check Box!!");
		}
	}
	else
	{
		alert("Please Select Check Box!!");
	}
 }
/*Edit this end*/

/*Add this start*/
function view_iss_form_pdf(btn_click)
 {

	if(btn_click =='Save AS PDF')
    {
		//alert("Hello");
		jQuery('#id_iss_certificate_form').attr('action','');
		jQuery('#id_iss_certificate_form').attr('action','iss_report_details/1');
		jQuery('#id_iss_certificate_form').submit();
	}
	else
	{
		alert("Please Select Check Box!!");
	}
 }
/*Add this end*/

 function check_search_form_iss_cer(str)
 {

	if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_date').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='Fetch ISS Data for Certificate'){report_click_btn=1;}
            if(str=='Certificate Info.'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_data_certificate_form').submit();
        }
        else
        {
            alert('First Select Date Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='iss_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='iss_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_date').val();
        /*var br_ao_do_text=jQuery('#search_text').val();*/

        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Certificate Info.'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_data_certificate_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

 function check_individual_report(str)
 {
	alert(str);
	if(str !='')
	{
		var arr = str.split('#');
		if(arr[0]==1)
		{
			jQuery('#iss_option').attr('action','');
			jQuery('#iss_option').attr('action','iss_report_details');
		}
		if(arr[0]==2)
		{
			jQuery('#iss_option').attr('action','');
			jQuery('#iss_option').attr('action','iss_report_details/1');
		}

		jQuery('#iss_report_office_id').val(arr[1]);
		jQuery('#iss_option').attr('target','_blank');
		jQuery('#iss_option').submit();

	}
 }


///////////////////////ISS Comparision start//////////////////
function control_iss_comp_report_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }
function fetch_br_ao_do_iss_2_comparision(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_do_issindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }

 function check_search_form_iss_2_comparision(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();

      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_date1=jQuery('#report_of_date1').val();
        var report_date2=jQuery('#report_of_date2').val();

		var report_date1_temp = report_date1.toString(report_date1);
		var report_date2_temp = report_date2.toString(report_date2);
		var report_date1_res = report_date1_temp.substring(7, 11);
		var report_date2_res = report_date2_temp.substring(7, 11);

        if(report_date1 !='' && report_date2 !='')
        {
			if(report_date1_res >= 2016 && report_date2_res >= 2016)
			{
				var report_click_btn=0;
				if(str=='View Report'){report_click_btn=1;}
				if(str=='Missing List'){report_click_btn=2;}
				if(str=='Completed List'){report_click_btn=3;}
				jQuery('#report_click_btn').val(report_click_btn);
				jQuery('#iss_search_form').submit();
			}
			else
			{
				alert("Select Higher year date..");
			}
			/*if(report_date1_res != report_date2_res)
			{
				alert("Please select Same year date.");
			}
			else
			{
				var report_click_btn=0;
				if(str=='View Report'){report_click_btn=1;}
				if(str=='Missing List'){report_click_btn=2;}
				if(str=='Completed List'){report_click_btn=3;}
				jQuery('#report_click_btn').val(report_click_btn);
				jQuery('#iss_search_form').submit();
			}*/

        }
        else
        {
            alert('First Select Date Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='iss_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='iss_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
///////////////////////ISS Comparision end//////////////////

///////////////////////ISS form-2 item wise report start//////////////////
function control_iss_form2_itemwise_report_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table_n').show('slow');
        jQuery('#search_form_table_iss2_1').show('slow');
        jQuery('#search_form_table_iss2_2').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table_n').hide('slow');
      jQuery('#search_form_table_iss2_1').hide('slow');
      jQuery('#search_form_table_iss2_2').hide('slow');
    }
 }
function fetch_br_ao_do_iss_2_item(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_do_issindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }

 /* Edit here start*/
 function check_search_form_iss_2_item(str)
 {
   if(str !='')
    {
        var iss_form_2_item = jQuery('#report_of_iss2_item').val();
	    if(iss_form_2_item !='')
	    {
			jQuery('#report_of_iss2_item').css( "background", "white" );
			var report_option_selector = jQuery('#report_option_selector').val();
			var report_date1 = jQuery('#report_of_date1').val();
			var report_date2 = jQuery('#report_of_date2').val();

		  if(report_option_selector == 1 || report_option_selector == 5)
		  {
			var report_date1_temp = report_date1.toString(report_date1);
			var report_date2_temp = report_date2.toString(report_date2);
			var report_date1_res = report_date1_temp.substring(7, 11);
			var report_date2_res = report_date2_temp.substring(7, 11);

			if(report_date1 !='' && report_date2 !='')
			{
				jQuery('#report_of_date1').css( "background", "white" );
				jQuery('#report_of_date2').css( "background", "white" );
				if(report_date1_res >= 2016 && report_date2_res >=2016)
				{
					jQuery('#report_of_date1').css( "background", "white" );
					jQuery('#report_of_date2').css( "background", "white" );

					var report_click_btn=0;
					if(str=='View Report'){ report_click_btn = 1; }
					if(str=='Graph'){ report_click_btn = 2; }
					jQuery('#report_click_btn').val(report_click_btn);

					/*if( str == 'Graph' ){
						var iss2_item_val = jQuery('#report_of_iss2_item_2').val();

						if( iss2_item_val == 0)
						{
							jQuery('#report_of_iss2_item_2').css( "background", "red" );
							alert('Select ISS Form-2 item for graph!');
						}
						else
						{
							jQuery('#report_of_iss2_item_2').css( "background", "white" );
							jQuery('#iss_item_search_form').submit();
						}


					}
					else {
						jQuery('#iss_item_search_form').submit();
					}*/
					jQuery('#iss_item_search_form').submit();
				}
				else
				{
					alert("Please select Higher year date..");
				}

			}
			else
			{
				alert('First Select Date Of Report.');
				if(report_date1 != ''){jQuery('#report_of_date1').css( "background", "red" );}
				if(report_date2 != ''){jQuery('#report_of_date2').css( "background", "red" );}
			}
		  }
		  else
		  {
			var br_ao_do = 0;
			if(jQuery("input[name='iss_report_office_id']:checked").val()>0)
			{
				br_ao_do = jQuery("input[name='iss_report_office_id']:checked").val();
			}
			var br_ao_do_text = jQuery('#search_text').val();

			if(report_date1 !='' && report_date2 !='' && br_ao_do != 0)
			{
				jQuery('#report_of_date1').css( "background", "white" );
				jQuery('#report_of_date2').css( "background", "white" );

				var report_click_btn=0;
				if(str=='View Report'){report_click_btn=1;}
				if(str=='Graph'){ report_click_btn = 2; }
				jQuery('#report_click_btn').val(report_click_btn);



				jQuery('#iss_item_search_form').submit();
			}
			else
			{
				alert('First Fill The Search Form Properly.');

				if(report_date1 == ''){jQuery('#report_of_date1').css( "background", "red" );}
				else{jQuery('#report_of_date1').css( "background", "white" );}
				if(report_date2 == ''){jQuery('#report_of_date2').css( "background", "red" );}
				else{jQuery('#report_of_date2').css( "background", "white" );}
			}
		  }
	    }
	   else
	    {
			alert("Please Select ISS Form-2 Item!!!!");
			jQuery('#report_of_iss2_item').css( "background", "red" );
	    }

    }
 }
 /* Edit here end*/
///////////////////////ISS form-2 item wise report end//////////////////

///////////////////////ISS Form-2 Continous start//////////////////
function control_iss_continous_report_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }
function fetch_br_ao_do_iss_2_continous(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_do_issindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }

 function check_search_form_iss_2_continous(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();

      if(report_option_selector==1 || report_option_selector==5)
      {

        var report_year = jQuery('#report_of_date_con_year').val();
        var br_ao_do_text = jQuery('#search_text').val();

        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_con_report_search_form').submit();
        }
        else
        {
            alert('First Select Date Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='iss_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='iss_report_office_id']:checked").val();
        }
        var report_year = jQuery('#report_of_date_con_year').val();
        var br_ao_do_text = jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_con_report_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
///////////////////////ISS  Form-2 Continous end//////////////////
/////////////////*ISS Bangladesh Bank report start*//////////

 function add_branch_bb_letter_info()
 {
	var br_ao_do_val = $("input:checked").val();
	var br_ao_do_name_val = $("input:checked + label").text();
	if(br_ao_do_val !== undefined && br_ao_do_name_val !== undefined)
	{
		$(".abb_br_here").append('<table border="1"><tr><td style="width:90px">'+br_ao_do_val+'</td><td style="text-align:center;width:360px">'+br_ao_do_name_val+'</td><td><input type="button" name="remove_br" id="remove_br" value="Remove" style="background-color: #DDEEFF;height:25px" onclick="remove_branch_bb_letter_info()"/></td><td><input type="hidden" name="bbrcode_test[]" id="bbrcode_test" value="'+br_ao_do_val+'" ></td></tr></table>');
	}
	else if(br_ao_do_val === undefined)
	{
		alert('Please select branch!');
	}
 }
  function remove_branch_bb_letter_info()
  {
	if($(".abb_br_here table").length != 0)
    {
        $(".abb_br_here table:last-child").remove();
    }
	else
    {
        alert("You cannot delete first row");
    }
  }
/*-----------Branch Letter report start------------------*/
 function fetch_br_ao_do_iss_2_bb_letter(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_do_issindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+2+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="2"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }

  function check_search_form_iss_bb_letter(str_val)
  {
		var br_ao_do = 0;
		var report_of_iss2_item_val = $('#report_of_iss2_item').val();
		br_ao_do = jQuery("input[name='iss_report_office_id']:checked").val();
		if(report_of_iss2_item_val !='' && br_ao_do !== undefined)
		{
			jQuery('#iss_bb_letter_form').submit();
		}
		else
		{
			alert("Please select Form appropiately");
		}
  }

  function check_search_form_iss_bb_display_letter(str_val)
  {
		var br_ao_do = 0;
		br_ao_do = jQuery("input[name='iss_report_office_id']:checked").val();
		if(br_ao_do !== undefined)
		{
			jQuery('#iss_bb_letter_search_form').submit();
		}
		else
		{
			alert("Please select Form appropiately");
		}
		//jQuery('#iss_bb_letter_search_form').submit();
  }
 /*-----------Branch Letter report end------------------*/
  function check_iss_form_1_view(str_val)
  {
		var fetched_date_val = $('#fetched_date').val();
		var fetched_deptt_val = $('#fetched_deptt').val();
		if(fetched_date_val != '' && fetched_deptt_val != '')
		{

			jQuery('#iss_data_form_1').submit();
		}
		else
		{
			alert('First Select Date and Department.');
		}

  }
  function check_iss1_data_entry_form(str_val)
  {
	var iss_rel_off_name1_val = $('#iss_rel_off_name1').val();
	var iss_rel_off_name2_val = $('#iss_rel_off_name2').val();
	var iss_rel_off_name3_val = $('#iss_rel_off_name3').val();
	var iss_rel_off_name4_val = $('#iss_rel_off_name4').val();
	var iss_rel_off_desig1_val = jQuery("select[name='iss_rel_off_desig1']").val();
	var iss_rel_off_desig2_val = jQuery("select[name='iss_rel_off_desig2']").val();
	var iss_rel_off_desig3_val = jQuery("select[name='iss_rel_off_desig3']").val();
	var iss_rel_off_desig4_val = jQuery("select[name='iss_rel_off_desig4']").val();

	var flag1 = 0; var flag2 = 0; var flag3 = 0; var flag4 = 0;
	if(iss_rel_off_name1_val !='' && iss_rel_off_desig1_val =='')
	{
		alert('Please Select designation');
		flag1 = 1;
	}
	else if(iss_rel_off_name1_val =='' && iss_rel_off_desig1_val !='')
	{
		alert('Please Write Name of Officer or Executive');
		flag1 = 1;
	}
	else
	{
		flag1 = 0;
	}

	if(iss_rel_off_name2_val !='' && iss_rel_off_desig2_val =='')
	{
		alert('Please Select designation');
		flag2 = 1;
	}
	else if(iss_rel_off_name2_val =='' && iss_rel_off_desig2_val !='')
	{
		alert('Please Write Name of Officer or Executive');
		flag2 = 1;
	}
	else
	{
		flag2 = 0;
	}

	if(iss_rel_off_name3_val !='' && iss_rel_off_desig3_val =='')
	{
		alert('Please Select designation');
		flag3 = 1;
	}
	else if(iss_rel_off_name3_val =='' && iss_rel_off_desig3_val !='')
	{
		alert('Please Write Name of Officer or Executive');
		flag3 = 1;
	}
	else
	{
		flag3 = 0;
	}

	if(iss_rel_off_name4_val !='' && iss_rel_off_desig4_val =='')
	{
		alert('Please Select designation');
		flag4 = 1;
	}
	else if(iss_rel_off_name4_val =='' && iss_rel_off_desig4_val !='')
	{
		alert('Please Write Name of Officer or Executive');
		flag4 = 1;
	}
	else
	{
		flag4 = 0;
	}

	if(flag1 == 0 && flag2 ==0 && flag3 ==0 && flag4 ==0)
	{
        var n = jQuery("input[name^= 'amount_iss1_bdt']").length;
        var amt_array = $("input[name^='amount_iss1_bdt']");
        var amt_flag = 1;
        for(var i=0;i<n;i++)
        {
            if($.isNumeric(amt_array[i].value)){
                $('#amt_iss1_ho_bdt_'+(i+1)+'').css("background-color", "#EEEEEE");
            }else{
                $('#amt_iss1_ho_bdt_'+(i+1)+'').css("background-color", "red");
                amt_flag = 0;
            }
        }
        var ho_date = jQuery('#ho_data_date').val();
        if(amt_flag==1){
            if(confirm("Do you want to submit data for selected Date: "+ho_date)){
            jQuery('#iss1_data_entry_form').submit();
        }
        }else{
            alert("Fill all amount fields & must input neumaric value only.");
        }
	}
	else
	{
		alert('Please select form appropiately');
	}
  }

  function check_iss1_bb_data_entry_form(str_val)
  {
	jQuery('#iss1_bb_data_entry_form').submit();
  }
/////////////////*ISS Bangladesh Bank report end*//////////
/*Guideline start*/
/*
function iss_data_generate_guideline(btn_click)
{
	if(btn_click =='Generate ISS Data')
    {

		var val_lblty_ttl_deposit_id = jQuery('#lblty_ttl_deposit_id').val();
		var val_lblty_ttl_billspayable_id = jQuery('#lblty_ttl_billspayable_id').val();
		var val_lblty_otherliability_id = jQuery('#lblty_otherliability_id').val();

		var val_lblty_hogeneral_ac_id = jQuery('#lblty_hogeneral_ac_id').val();
		var val_llblty_ho_central_ac_id = jQuery('#lblty_ho_central_ac_id').val();

		var val_lblty_cibt_id = jQuery('#lblty_cibt_id').val();
		var val_lblty_oibt_id = jQuery('#lblty_oibt_id').val();
		var val_lblty_ibfexc_id = jQuery('#lblty_ibfexc_id').val();
		var val_lblty_cashremittance_id = jQuery('#lblty_cashremittance_id').val();

		var val_ass_cashbnkblance_id = jQuery('#ass_cashbnkblance_id').val();
		var val_ass_advanceloan_id = jQuery('#ass_advanceloan_id').val();
		var val_ass_advanceoverdraft_id = jQuery('#ass_advanceoverdraft_id').val();
		var val_ass_advancediscount_id = jQuery('#ass_advancediscount_id').val();
		var val_ass_otherasset_id = jQuery('#ass_otherasset_id').val();

		var val_ass_fur_fix_id = jQuery('#ass_fur_fix_id').val();
		var val_ass_computer_id = jQuery('#ass_computer_id').val();
		var val_ass_land_building_id = jQuery('#ass_land_building_id').val();

		var val_ass_hogeneral_ac_id = jQuery('#ass_hogeneral_ac_id').val();
		var val_ass_hocentral_ac_id = jQuery('#ass_hocentral_ac_id').val();

		var val_ass_cibt_id = jQuery('#ass_cibt_id').val();
		var val_ass_oibt_id = jQuery('#ass_oibt_id').val();
		var val_ass_ibfexch_id = jQuery('#ass_ibfexch_id').val();
		var val_ass_cashremittance_id = jQuery('#ass_cashremittance_id').val();

		var cal_iss_total_asset = '0';
		var cal_iss_total_liability = '0';
		var cal_iss_total_deposit = '0';
		var cal_iss_total_loanoutstanding = '0';
		var cal_iss_total_hoglpb = '0';
		var cal_iss_total_hoglnb = '0';
		var cal_iss_total_totalotherasset = '0';
		var cal_iss_total_totalotherliability = '0';
		var cal_iss_total_fixedasset = '0';


		var is_ok = 0;
		if(!$.isNumeric($('#lblty_ttl_deposit_id').val()) && $('#lblty_ttl_deposit_id').val() !=''){jQuery('#lblty_ttl_deposit_id').css('background','red');	}
		else { jQuery('#lblty_ttl_deposit_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_ttl_billspayable_id').val()) && $('#lblty_ttl_billspayable_id').val() !=''){jQuery('#lblty_ttl_billspayable_id').css('background','red');}
		else { jQuery('#lblty_ttl_billspayable_id').css('background','white');}
		if(!$.isNumeric($('#lblty_otherliability_id').val()) && $('#lblty_otherliability_id').val() !=''){ jQuery('#lblty_otherliability_id').css('background','red'); }
		else{ jQuery('#lblty_otherliability_id').css('background','white'); }

		if(!$.isNumeric($('#lblty_hogeneral_ac_id').val()) && $('#lblty_hogeneral_ac_id').val() !=''){ jQuery('#lblty_hogeneral_ac_id').css('background','red'); }
		else{ jQuery('#lblty_hogeneral_ac_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_ho_central_ac_id').val()) && $('#lblty_ho_central_ac_id').val() !=''){ jQuery('#lblty_ho_central_ac_id').css('background','red'); }
		else{ jQuery('#lblty_ho_central_ac_id').css('background','white'); }

		if(!$.isNumeric($('#lblty_cibt_id').val()) && $('#lblty_cibt_id').val() !=''){ jQuery('#lblty_cibt_id').css('background','red'); }
		else{ jQuery('#lblty_cibt_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_oibt_id').val()) && $('#lblty_oibt_id').val() !=''){ jQuery('#lblty_oibt_id').css('background','red'); }
		else{ jQuery('#lblty_oibt_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_ibfexc_id').val()) && $('#lblty_ibfexc_id').val() !=''){ jQuery('#lblty_ibfexc_id').css('background','red'); }
		else{ jQuery('#lblty_ibfexc_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_cashremittance_id').val()) && $('#lblty_cashremittance_id').val() !=''){ jQuery('#lblty_cashremittance_id').css('background','red'); }
		else{ jQuery('#lblty_cashremittance_id').css('background','white'); }

		if(!$.isNumeric($('#ass_cashbnkblance_id').val()) && $('#ass_cashbnkblance_id').val() !=''){ jQuery('#ass_cashbnkblance_id').css('background','red'); }
		else{ jQuery('#ass_cashbnkblance_id').css('background','white'); }
		if(!$.isNumeric($('#ass_advanceloan_id').val()) && $('#ass_advanceloan_id').val() !=''){ jQuery('#ass_advanceloan_id').css('background','red'); }
		else{ jQuery('#ass_advanceloan_id').css('background','white'); }
		if(!$.isNumeric($('#ass_advanceoverdraft_id').val()) && $('#ass_advanceoverdraft_id').val() !=''){ jQuery('#ass_advanceoverdraft_id').css('background','red'); }
		else{ jQuery('#ass_advanceoverdraft_id').css('background','white'); }
		if(!$.isNumeric($('#ass_advancediscount_id').val()) && $('#ass_advancediscount_id').val() !=''){ jQuery('#ass_advancediscount_id').css('background','red'); }
		else{ jQuery('#ass_advancediscount_id').css('background','white'); }
		if(!$.isNumeric($('#ass_otherasset_id').val()) && $('#ass_otherasset_id').val() !=''){ jQuery('#ass_otherasset_id').css('background','red'); }
		else{ jQuery('#ass_otherasset_id').css('background','white'); }

		if(!$.isNumeric($('#ass_fur_fix_id').val()) && $('#ass_fur_fix_id').val() !=''){ jQuery('#ass_fur_fix_id').css('background','red'); }
		else{ jQuery('#ass_fur_fix_id').css('background','white'); }
		if(!$.isNumeric($('#ass_computer_id').val()) && $('#ass_computer_id').val() !=''){ jQuery('#ass_computer_id').css('background','red'); }
		else{ jQuery('#ass_computer_id').css('background','white'); }
		if(!$.isNumeric($('#ass_land_building_id').val()) && $('#ass_land_building_id').val() !=''){ jQuery('#ass_land_building_id').css('background','red'); }
		else{ jQuery('#ass_land_building_id').css('background','white'); }

		if(!$.isNumeric($('#ass_hogeneral_ac_id').val()) && $('#ass_hogeneral_ac_id').val() !=''){ jQuery('#ass_hogeneral_ac_id').css('background','red'); }
		else{ jQuery('#ass_hogeneral_ac_id').css('background','white'); }
		if(!$.isNumeric($('#ass_hocentral_ac_id').val()) && $('#ass_hocentral_ac_id').val() !=''){ jQuery('#ass_hocentral_ac_id').css('background','red'); }
		else{ jQuery('#ass_hocentral_ac_id').css('background','white'); }

		if(!$.isNumeric($('#ass_cibt_id').val()) && $('#ass_cibt_id').val() !=''){ jQuery('#ass_cibt_id').css('background','red'); }
		else{ jQuery('#ass_cibt_id').css('background','white'); }
		if(!$.isNumeric($('#ass_oibt_id').val()) && $('#ass_oibt_id').val() !=''){ jQuery('#ass_oibt_id').css('background','red'); }
		else{ jQuery('#ass_oibt_id').css('background','white'); }
		if(!$.isNumeric($('#ass_ibfexch_id').val()) && $('#ass_ibfexch_id').val() !=''){ jQuery('#ass_ibfexch_id').css('background','red'); }
		else{ jQuery('#ass_ibfexch_id').css('background','white'); }
		if(!$.isNumeric($('#ass_cashremittance_id').val()) && $('#ass_cashremittance_id').val() !=''){ jQuery('#ass_cashremittance_id').css('background','red'); }
		else{ jQuery('#ass_cashremittance_id').css('background','white'); }


		 if((!$.isNumeric($('#lblty_ttl_deposit_id').val()) || $('#lblty_ttl_deposit_id').val() =='') &&
		   (!$.isNumeric($('#lblty_ttl_billspayable_id').val()) || $('#lblty_ttl_billspayable_id').val() =='') &&
		   (!$.isNumeric($('#lblty_otherliability_id').val()) || $('#lblty_otherliability_id').val() =='') &&

		   (!$.isNumeric($('#lblty_hogeneral_ac_id').val()) || $('#lblty_hogeneral_ac_id').val() =='') &&
		   (!$.isNumeric($('#val_llblty_ho_central_ac_id').val()) || $('#val_llblty_ho_central_ac_id').val() =='') &&

		   (!$.isNumeric($('#lblty_cibt_id').val()) || $('#lblty_cibt_id').val() =='') &&
		   (!$.isNumeric($('#lblty_oibt_id').val()) || $('#lblty_oibt_id').val() =='') &&
		   (!$.isNumeric($('#lblty_ibfexc_id').val()) || $('#lblty_ibfexc_id').val() =='') &&
		   (!$.isNumeric($('#lblty_cashremittance_id').val()) || $('#lblty_cashremittance_id').val() =='') &&
		   (!$.isNumeric($('#ass_cashbnkblance_id').val()) || $('#ass_cashbnkblance_id').val() =='') &&
		   (!$.isNumeric($('#ass_advanceloan_id').val()) || $('#ass_advanceloan_id').val() =='') &&
		   (!$.isNumeric($('#ass_advanceoverdraft_id').val()) || $('#ass_advanceoverdraft_id').val() =='') &&
		   (!$.isNumeric($('#ass_advancediscount_id').val()) || $('#ass_advancediscount_id').val() =='') &&
		   (!$.isNumeric($('#ass_otherasset_id').val()) || $('#ass_otherasset_id').val() =='') &&

		   (!$.isNumeric($('#ass_hogeneral_ac_id').val()) || $('#ass_hogeneral_ac_id').val() =='') &&
		   (!$.isNumeric($('#ass_hocentral_ac_id').val()) || $('#ass_hocentral_ac_id').val() =='') &&

		   (!$.isNumeric($('#ass_fur_fix_id').val()) || $('#ass_fur_fix_id').val() =='') &&
		   (!$.isNumeric($('#ass_computer_id').val()) || $('#ass_computer_id').val() =='') &&
		   (!$.isNumeric($('#ass_land_building_id').val()) || $('#ass_land_building_id').val() =='') &&

		   (!$.isNumeric($('#ass_cibt_id').val()) || $('#ass_cibt_id').val() =='') &&
		   (!$.isNumeric($('#ass_oibt_id').val()) || $('#ass_oibt_id').val() =='') &&
		   (!$.isNumeric($('#ass_ibfexch_id').val()) || $('#ass_ibfexch_id').val() =='') &&
		   (!$.isNumeric($('#ass_cashremittance_id').val()) || $('#ass_cashremittance_id').val() ==''))
		   {
				alert('Please give valid digit!!');
		   }
		else
		{

			if(!$.isNumeric(val_lblty_ttl_deposit_id)){val_lblty_ttl_deposit_id=0;}
			if(!$.isNumeric(val_lblty_ttl_billspayable_id)){val_lblty_ttl_billspayable_id=0;}
			if(!$.isNumeric(val_lblty_otherliability_id)){val_lblty_otherliability_id=0;}

			if(!$.isNumeric(val_lblty_hogeneral_ac_id)){val_lblty_hogeneral_ac_id=0;}
			if(!$.isNumeric(val_llblty_ho_central_ac_id)){val_llblty_ho_central_ac_id=0;}

			if(!$.isNumeric(val_lblty_cibt_id)){val_lblty_cibt_id=0;}
			if(!$.isNumeric(val_lblty_oibt_id)){val_lblty_oibt_id=0;}
			if(!$.isNumeric(val_lblty_ibfexc_id)){val_lblty_ibfexc_id=0;}
			if(!$.isNumeric(val_lblty_cashremittance_id)){val_lblty_cashremittance_id=0;}


			if(!$.isNumeric(val_ass_cashbnkblance_id)){val_ass_cashbnkblance_id=0;}
			if(!$.isNumeric(val_ass_advanceloan_id)){val_ass_advanceloan_id=0;}
			if(!$.isNumeric(val_ass_advanceoverdraft_id)){val_ass_advanceoverdraft_id=0;}
			if(!$.isNumeric(val_ass_advancediscount_id)){val_ass_advancediscount_id=0;}
			if(!$.isNumeric(val_ass_otherasset_id)){val_ass_otherasset_id=0;}

			if(!$.isNumeric(val_ass_fur_fix_id)){val_ass_fur_fix_id=0;}
			if(!$.isNumeric(val_ass_computer_id)){val_ass_computer_id=0;}
			if(!$.isNumeric(val_ass_land_building_id)){val_ass_land_building_id=0;}

			if(!$.isNumeric(val_ass_hogeneral_ac_id)){val_ass_hogeneral_ac_id=0;}
			if(!$.isNumeric(val_ass_hocentral_ac_id)){val_ass_hocentral_ac_id=0;}

			if(!$.isNumeric(val_ass_cibt_id)){val_ass_cibt_id=0;}
			if(!$.isNumeric(val_ass_oibt_id)){val_ass_oibt_id=0;}
			if(!$.isNumeric(val_ass_ibfexch_id)){val_ass_ibfexch_id=0;}
			if(!$.isNumeric(val_ass_cashremittance_id)){val_ass_cashremittance_id=0;}

			val_lblty_ttl_deposit_id = parseFloat(val_lblty_ttl_deposit_id);
			val_lblty_ttl_billspayable_id = parseFloat(val_lblty_ttl_billspayable_id);
			val_lblty_otherliability_id = parseFloat(val_lblty_otherliability_id);

			val_lblty_hogeneral_ac_id = parseFloat(val_lblty_hogeneral_ac_id);
			val_llblty_ho_central_ac_id = parseFloat(val_llblty_ho_central_ac_id);

			val_lblty_cibt_id = parseFloat(val_lblty_cibt_id);
			val_lblty_oibt_id = parseFloat(val_lblty_oibt_id);
			val_lblty_ibfexc_id = parseFloat(val_lblty_ibfexc_id);
			val_lblty_cashremittance_id = parseFloat(val_lblty_cashremittance_id);

			val_ass_cashbnkblance_id = parseFloat(val_ass_cashbnkblance_id);
			val_ass_advanceloan_id = parseFloat(val_ass_advanceloan_id);
			val_ass_advanceoverdraft_id = parseFloat(val_ass_advanceoverdraft_id);
			val_ass_advancediscount_id = parseFloat(val_ass_advancediscount_id);
			val_ass_otherasset_id = parseFloat(val_ass_otherasset_id);

			val_ass_fur_fix_id = parseFloat(val_ass_fur_fix_id);
			val_ass_computer_id = parseFloat(val_ass_computer_id);
			val_ass_land_building_id = parseFloat(val_ass_land_building_id);

			val_ass_hogeneral_ac_id = parseFloat(val_ass_hogeneral_ac_id);
			val_ass_hocentral_ac_id = parseFloat(val_ass_hocentral_ac_id);

			val_ass_cibt_id = parseFloat(val_ass_cibt_id);
			val_ass_oibt_id = parseFloat(val_ass_oibt_id);
			val_ass_ibfexch_id = parseFloat(val_ass_ibfexch_id);
			val_ass_cashremittance_id = parseFloat(val_ass_cashremittance_id);


			if((val_ass_advanceloan_id+val_ass_advanceoverdraft_id+val_ass_advancediscount_id) > val_lblty_ttl_deposit_id)
			{
				cal_iss_total_asset = val_ass_advanceloan_id + val_ass_advanceoverdraft_id + val_ass_advancediscount_id + val_ass_cashbnkblance_id +val_ass_otherasset_id + val_ass_fur_fix_id + val_ass_computer_id + val_ass_land_building_id;
				cal_iss_total_liability = (cal_iss_total_asset);
			}
			if((val_ass_advanceloan_id+val_ass_advanceoverdraft_id+val_ass_advancediscount_id) < val_lblty_ttl_deposit_id)
			{
				cal_iss_total_liability = val_lblty_ttl_deposit_id + val_lblty_ttl_billspayable_id + val_lblty_otherliability_id;
				cal_iss_total_asset = (cal_iss_total_liability);
			}
			cal_iss_total_deposit = val_lblty_ttl_deposit_id + val_lblty_ttl_billspayable_id;
			cal_iss_total_loanoutstanding = val_ass_advanceloan_id + val_ass_advanceoverdraft_id + val_ass_advancediscount_id;
			cal_iss_total_fixedasset = val_ass_fur_fix_id + val_ass_computer_id + val_ass_land_building_id;
			cal_iss_total_totalotherasset = val_ass_otherasset_id;
			cal_iss_total_totalotherliability = val_lblty_otherliability_id;
			var cal_iss_total_hoglpb_temp = (val_ass_hogeneral_ac_id+val_ass_hocentral_ac_id+val_ass_cibt_id+val_ass_oibt_id+val_ass_ibfexch_id+val_ass_cashremittance_id)-(val_lblty_hogeneral_ac_id+val_llblty_ho_central_ac_id+val_lblty_cibt_id+val_lblty_oibt_id+val_lblty_ibfexc_id+val_lblty_cashremittance_id);
			cal_iss_total_hoglpb_temp = parseInt(cal_iss_total_hoglpb_temp);
			if(cal_iss_total_hoglpb_temp >=0)
			{
				cal_iss_total_hoglpb = cal_iss_total_hoglpb_temp;
				cal_iss_total_hoglnb = 0;

			}
			else{
				if(cal_iss_total_hoglpb_temp < 0)
				{
					cal_iss_total_hoglpb = 0;
					cal_iss_total_hoglnb = Math.abs(cal_iss_total_hoglpb_temp);
				}
			}

		}

		$(".iss_total_asset span.span_total_asset").text(cal_iss_total_asset);
		$(".iss_total_liability span.span_total_liability").text(cal_iss_total_liability);
		$(".iss_total_deposit span.span_total_deposit").text(cal_iss_total_deposit);
		$(".iss_total_loanoutstanding span.span_total_loanoutstanding").text(cal_iss_total_loanoutstanding);
		$(".iss_total_hoglpb span.span_total_hoglpb").text(cal_iss_total_hoglpb);
		$(".iss_total_hoglnb span.span_total_hoglnb").text(cal_iss_total_hoglnb);
		$(".iss_total_totalotherasset span.span_totalotherasset").text(cal_iss_total_totalotherasset);
		$(".iss_total_totalotherliability span.span_total_totalotherliability").text(cal_iss_total_totalotherliability);
		$(".iss_total_fixedasset span.span_total_fixedasset").text(cal_iss_total_fixedasset);
	}
	else
	{
		alert("No");
	}
}*/
/*
function iss_data_generate_guideline(btn_click)
{
	if(btn_click =='Generate ISS Data')
    {

		var val_lblty_ttl_deposit_id = jQuery('#lblty_ttl_deposit_id').val();
		var val_lblty_ttl_billspayable_id = jQuery('#lblty_ttl_billspayable_id').val();
		var val_lblty_otherliability_id = jQuery('#lblty_otherliability_id').val();

		var val_lblty_hogeneral_ac_id = jQuery('#lblty_hogeneral_ac_id').val();
		var val_llblty_ho_central_ac_id = jQuery('#lblty_ho_central_ac_id').val();

		var val_lblty_cibt_id = jQuery('#lblty_cibt_id').val();
		var val_lblty_oibt_id = jQuery('#lblty_oibt_id').val();
		var val_lblty_ibfexc_id = jQuery('#lblty_ibfexc_id').val();
		var val_lblty_cashremittance_id = jQuery('#lblty_cashremittance_id').val();
		var val_lblty_incomeac_id = jQuery('#lblty_incomeac_id').val();

		var val_ass_cashbnkblance_id = jQuery('#ass_cashbnkblance_id').val();
		var val_ass_advanceloan_id = jQuery('#ass_advanceloan_id').val();
		var val_ass_advanceoverdraft_id = jQuery('#ass_advanceoverdraft_id').val();
		var val_ass_advancediscount_id = jQuery('#ass_advancediscount_id').val();
		var val_ass_otherasset_id = jQuery('#ass_otherasset_id').val();

		var val_ass_fur_fix_id = jQuery('#ass_fur_fix_id').val();
		var val_ass_computer_id = jQuery('#ass_computer_id').val();
		var val_ass_land_building_id = jQuery('#ass_land_building_id').val();

		var val_ass_hogeneral_ac_id = jQuery('#ass_hogeneral_ac_id').val();
		var val_ass_hocentral_ac_id = jQuery('#ass_hocentral_ac_id').val();

		var val_ass_cibt_id = jQuery('#ass_cibt_id').val();
		var val_ass_oibt_id = jQuery('#ass_oibt_id').val();
		var val_ass_ibfexch_id = jQuery('#ass_ibfexch_id').val();
		var val_ass_cashremittance_id = jQuery('#ass_cashremittance_id').val();
		var val_ass_expenditureac_id = jQuery('#ass_expenditureac_id').val();

		var cal_iss_icome_expen_diff = '0';

		var cal_iss_total_asset = '0';
		var cal_iss_total_liability = '0';
		var cal_iss_total_deposit = '0';
		var cal_iss_total_loanoutstanding = '0';
		var cal_iss_total_hoglpb = '0';
		var cal_iss_total_hoglnb = '0';
		var cal_iss_total_totalotherasset = '0';
		var cal_iss_total_totalotherliability = '0';
		var cal_iss_total_fixedasset = '0';


		var is_ok = 0;
		if(!$.isNumeric($('#lblty_ttl_deposit_id').val()) && $('#lblty_ttl_deposit_id').val() !=''){jQuery('#lblty_ttl_deposit_id').css('background','red');	}
		else { jQuery('#lblty_ttl_deposit_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_ttl_billspayable_id').val()) && $('#lblty_ttl_billspayable_id').val() !=''){jQuery('#lblty_ttl_billspayable_id').css('background','red');}
		else { jQuery('#lblty_ttl_billspayable_id').css('background','white');}
		if(!$.isNumeric($('#lblty_otherliability_id').val()) && $('#lblty_otherliability_id').val() !=''){ jQuery('#lblty_otherliability_id').css('background','red'); }
		else{ jQuery('#lblty_otherliability_id').css('background','white'); }

		if(!$.isNumeric($('#lblty_hogeneral_ac_id').val()) && $('#lblty_hogeneral_ac_id').val() !=''){ jQuery('#lblty_hogeneral_ac_id').css('background','red'); }
		else{ jQuery('#lblty_hogeneral_ac_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_ho_central_ac_id').val()) && $('#lblty_ho_central_ac_id').val() !=''){ jQuery('#lblty_ho_central_ac_id').css('background','red'); }
		else{ jQuery('#lblty_ho_central_ac_id').css('background','white'); }

		if(!$.isNumeric($('#lblty_cibt_id').val()) && $('#lblty_cibt_id').val() !=''){ jQuery('#lblty_cibt_id').css('background','red'); }
		else{ jQuery('#lblty_cibt_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_oibt_id').val()) && $('#lblty_oibt_id').val() !=''){ jQuery('#lblty_oibt_id').css('background','red'); }
		else{ jQuery('#lblty_oibt_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_ibfexc_id').val()) && $('#lblty_ibfexc_id').val() !=''){ jQuery('#lblty_ibfexc_id').css('background','red'); }
		else{ jQuery('#lblty_ibfexc_id').css('background','white'); }

		if(!$.isNumeric($('#lblty_cashremittance_id').val()) && $('#lblty_cashremittance_id').val() !=''){ jQuery('#lblty_cashremittance_id').css('background','red'); }
		else{ jQuery('#lblty_cashremittance_id').css('background','white'); }

		if(!$.isNumeric($('#lblty_incomeac_id').val()) && $('#lblty_incomeac_id').val() !=''){ jQuery('#lblty_incomeac_id').css('background','red'); }
		else{ jQuery('#lblty_incomeac_id').css('background','white'); }

		if(!$.isNumeric($('#ass_cashbnkblance_id').val()) && $('#ass_cashbnkblance_id').val() !=''){ jQuery('#ass_cashbnkblance_id').css('background','red'); }
		else{ jQuery('#ass_cashbnkblance_id').css('background','white'); }
		if(!$.isNumeric($('#ass_advanceloan_id').val()) && $('#ass_advanceloan_id').val() !=''){ jQuery('#ass_advanceloan_id').css('background','red'); }
		else{ jQuery('#ass_advanceloan_id').css('background','white'); }
		if(!$.isNumeric($('#ass_advanceoverdraft_id').val()) && $('#ass_advanceoverdraft_id').val() !=''){ jQuery('#ass_advanceoverdraft_id').css('background','red'); }
		else{ jQuery('#ass_advanceoverdraft_id').css('background','white'); }
		if(!$.isNumeric($('#ass_advancediscount_id').val()) && $('#ass_advancediscount_id').val() !=''){ jQuery('#ass_advancediscount_id').css('background','red'); }
		else{ jQuery('#ass_advancediscount_id').css('background','white'); }
		if(!$.isNumeric($('#ass_otherasset_id').val()) && $('#ass_otherasset_id').val() !=''){ jQuery('#ass_otherasset_id').css('background','red'); }
		else{ jQuery('#ass_otherasset_id').css('background','white'); }

		if(!$.isNumeric($('#ass_fur_fix_id').val()) && $('#ass_fur_fix_id').val() !=''){ jQuery('#ass_fur_fix_id').css('background','red'); }
		else{ jQuery('#ass_fur_fix_id').css('background','white'); }
		if(!$.isNumeric($('#ass_computer_id').val()) && $('#ass_computer_id').val() !=''){ jQuery('#ass_computer_id').css('background','red'); }
		else{ jQuery('#ass_computer_id').css('background','white'); }
		if(!$.isNumeric($('#ass_land_building_id').val()) && $('#ass_land_building_id').val() !=''){ jQuery('#ass_land_building_id').css('background','red'); }
		else{ jQuery('#ass_land_building_id').css('background','white'); }

		if(!$.isNumeric($('#ass_hogeneral_ac_id').val()) && $('#ass_hogeneral_ac_id').val() !=''){ jQuery('#ass_hogeneral_ac_id').css('background','red'); }
		else{ jQuery('#ass_hogeneral_ac_id').css('background','white'); }
		if(!$.isNumeric($('#ass_hocentral_ac_id').val()) && $('#ass_hocentral_ac_id').val() !=''){ jQuery('#ass_hocentral_ac_id').css('background','red'); }
		else{ jQuery('#ass_hocentral_ac_id').css('background','white'); }

		if(!$.isNumeric($('#ass_cibt_id').val()) && $('#ass_cibt_id').val() !=''){ jQuery('#ass_cibt_id').css('background','red'); }
		else{ jQuery('#ass_cibt_id').css('background','white'); }
		if(!$.isNumeric($('#ass_oibt_id').val()) && $('#ass_oibt_id').val() !=''){ jQuery('#ass_oibt_id').css('background','red'); }
		else{ jQuery('#ass_oibt_id').css('background','white'); }
		if(!$.isNumeric($('#ass_ibfexch_id').val()) && $('#ass_ibfexch_id').val() !=''){ jQuery('#ass_ibfexch_id').css('background','red'); }
		else{ jQuery('#ass_ibfexch_id').css('background','white'); }
		if(!$.isNumeric($('#ass_cashremittance_id').val()) && $('#ass_cashremittance_id').val() !=''){ jQuery('#ass_cashremittance_id').css('background','red'); }
		else{ jQuery('#ass_cashremittance_id').css('background','white'); }

		if(!$.isNumeric($('#ass_expenditureac_id').val()) && $('#ass_expenditureac_id').val() !=''){ jQuery('#ass_expenditureac_id').css('background','red'); }
		else{ jQuery('#ass_expenditureac_id').css('background','white'); }


		 if((!$.isNumeric($('#lblty_ttl_deposit_id').val()) || $('#lblty_ttl_deposit_id').val() =='') &&
		   (!$.isNumeric($('#lblty_ttl_billspayable_id').val()) || $('#lblty_ttl_billspayable_id').val() =='') &&
		   (!$.isNumeric($('#lblty_otherliability_id').val()) || $('#lblty_otherliability_id').val() =='') &&

		   (!$.isNumeric($('#lblty_hogeneral_ac_id').val()) || $('#lblty_hogeneral_ac_id').val() =='') &&
		   (!$.isNumeric($('#val_llblty_ho_central_ac_id').val()) || $('#val_llblty_ho_central_ac_id').val() =='') &&

		   (!$.isNumeric($('#lblty_cibt_id').val()) || $('#lblty_cibt_id').val() =='') &&
		   (!$.isNumeric($('#lblty_oibt_id').val()) || $('#lblty_oibt_id').val() =='') &&
		   (!$.isNumeric($('#lblty_ibfexc_id').val()) || $('#lblty_ibfexc_id').val() =='') &&

		   (!$.isNumeric($('#lblty_cashremittance_id').val()) || $('#lblty_cashremittance_id').val() =='') &&
		   (!$.isNumeric($('#lblty_incomeac_id').val()) || $('#lblty_incomeac_id').val() =='') &&

		   (!$.isNumeric($('#ass_cashbnkblance_id').val()) || $('#ass_cashbnkblance_id').val() =='') &&
		   (!$.isNumeric($('#ass_advanceloan_id').val()) || $('#ass_advanceloan_id').val() =='') &&
		   (!$.isNumeric($('#ass_advanceoverdraft_id').val()) || $('#ass_advanceoverdraft_id').val() =='') &&
		   (!$.isNumeric($('#ass_advancediscount_id').val()) || $('#ass_advancediscount_id').val() =='') &&
		   (!$.isNumeric($('#ass_otherasset_id').val()) || $('#ass_otherasset_id').val() =='') &&

		   (!$.isNumeric($('#ass_hogeneral_ac_id').val()) || $('#ass_hogeneral_ac_id').val() =='') &&
		   (!$.isNumeric($('#ass_hocentral_ac_id').val()) || $('#ass_hocentral_ac_id').val() =='') &&

		   (!$.isNumeric($('#ass_fur_fix_id').val()) || $('#ass_fur_fix_id').val() =='') &&
		   (!$.isNumeric($('#ass_computer_id').val()) || $('#ass_computer_id').val() =='') &&
		   (!$.isNumeric($('#ass_land_building_id').val()) || $('#ass_land_building_id').val() =='') &&

		   (!$.isNumeric($('#ass_cibt_id').val()) || $('#ass_cibt_id').val() =='') &&
		   (!$.isNumeric($('#ass_oibt_id').val()) || $('#ass_oibt_id').val() =='') &&
		   (!$.isNumeric($('#ass_ibfexch_id').val()) || $('#ass_ibfexch_id').val() =='') &&
		   (!$.isNumeric($('#ass_cashremittance_id').val()) || $('#ass_cashremittance_id').val() =='')
		   (!$.isNumeric($('#ass_expenditureac_id').val()) || $('#ass_expenditureac_id').val() ==''))
		   {
				alert('Please input valid digit!!');
		   }
		else
		{

			if(!$.isNumeric(val_lblty_ttl_deposit_id)){val_lblty_ttl_deposit_id=0;}
			if(!$.isNumeric(val_lblty_ttl_billspayable_id)){val_lblty_ttl_billspayable_id=0;}
			if(!$.isNumeric(val_lblty_otherliability_id)){val_lblty_otherliability_id=0;}

			if(!$.isNumeric(val_lblty_hogeneral_ac_id)){val_lblty_hogeneral_ac_id=0;}
			if(!$.isNumeric(val_llblty_ho_central_ac_id)){val_llblty_ho_central_ac_id=0;}

			if(!$.isNumeric(val_lblty_cibt_id)){val_lblty_cibt_id=0;}
			if(!$.isNumeric(val_lblty_oibt_id)){val_lblty_oibt_id=0;}
			if(!$.isNumeric(val_lblty_ibfexc_id)){val_lblty_ibfexc_id=0;}
			if(!$.isNumeric(val_lblty_cashremittance_id)){val_lblty_cashremittance_id=0;}
			if(!$.isNumeric(val_lblty_incomeac_id)){val_lblty_incomeac_id = 0;}


			if(!$.isNumeric(val_ass_cashbnkblance_id)){val_ass_cashbnkblance_id=0;}
			if(!$.isNumeric(val_ass_advanceloan_id)){val_ass_advanceloan_id=0;}
			if(!$.isNumeric(val_ass_advanceoverdraft_id)){val_ass_advanceoverdraft_id=0;}
			if(!$.isNumeric(val_ass_advancediscount_id)){val_ass_advancediscount_id=0;}
			if(!$.isNumeric(val_ass_otherasset_id)){val_ass_otherasset_id=0;}

			if(!$.isNumeric(val_ass_fur_fix_id)){val_ass_fur_fix_id=0;}
			if(!$.isNumeric(val_ass_computer_id)){val_ass_computer_id=0;}
			if(!$.isNumeric(val_ass_land_building_id)){val_ass_land_building_id=0;}

			if(!$.isNumeric(val_ass_hogeneral_ac_id)){val_ass_hogeneral_ac_id=0;}
			if(!$.isNumeric(val_ass_hocentral_ac_id)){val_ass_hocentral_ac_id=0;}

			if(!$.isNumeric(val_ass_cibt_id)){val_ass_cibt_id=0;}
			if(!$.isNumeric(val_ass_oibt_id)){val_ass_oibt_id=0;}
			if(!$.isNumeric(val_ass_ibfexch_id)){val_ass_ibfexch_id=0;}
			if(!$.isNumeric(val_ass_cashremittance_id)){val_ass_cashremittance_id = 0;}
			if(!$.isNumeric(val_ass_expenditureac_id)){val_ass_expenditureac_id = 0;}

			val_lblty_ttl_deposit_id = parseFloat(val_lblty_ttl_deposit_id);
			val_lblty_ttl_billspayable_id = parseFloat(val_lblty_ttl_billspayable_id);
			val_lblty_otherliability_id = parseFloat(val_lblty_otherliability_id);

			val_lblty_hogeneral_ac_id = parseFloat(val_lblty_hogeneral_ac_id);
			val_llblty_ho_central_ac_id = parseFloat(val_llblty_ho_central_ac_id);

			val_lblty_cibt_id = parseFloat(val_lblty_cibt_id);
			val_lblty_oibt_id = parseFloat(val_lblty_oibt_id);
			val_lblty_ibfexc_id = parseFloat(val_lblty_ibfexc_id);
			val_lblty_cashremittance_id = parseFloat(val_lblty_cashremittance_id);
			val_lblty_incomeac_id = parseFloat(val_lblty_incomeac_id);

			val_ass_cashbnkblance_id = parseFloat(val_ass_cashbnkblance_id);
			val_ass_advanceloan_id = parseFloat(val_ass_advanceloan_id);
			val_ass_advanceoverdraft_id = parseFloat(val_ass_advanceoverdraft_id);
			val_ass_advancediscount_id = parseFloat(val_ass_advancediscount_id);
			val_ass_otherasset_id = parseFloat(val_ass_otherasset_id);

			val_ass_fur_fix_id = parseFloat(val_ass_fur_fix_id);
			val_ass_computer_id = parseFloat(val_ass_computer_id);
			val_ass_land_building_id = parseFloat(val_ass_land_building_id);

			val_ass_hogeneral_ac_id = parseFloat(val_ass_hogeneral_ac_id);
			val_ass_hocentral_ac_id = parseFloat(val_ass_hocentral_ac_id);

			val_ass_cibt_id = parseFloat(val_ass_cibt_id);
			val_ass_oibt_id = parseFloat(val_ass_oibt_id);
			val_ass_ibfexch_id = parseFloat(val_ass_ibfexch_id);
			val_ass_cashremittance_id = parseFloat(val_ass_cashremittance_id);
			val_ass_expenditureac_id = parseFloat(val_ass_expenditureac_id);


			cal_iss_total_asset = val_ass_advanceloan_id + val_ass_advanceoverdraft_id + val_ass_advancediscount_id + val_ass_cashbnkblance_id +val_ass_otherasset_id + val_ass_fur_fix_id + val_ass_computer_id + val_ass_land_building_id;

			cal_iss_total_liability = val_lblty_ttl_deposit_id + val_lblty_ttl_billspayable_id + val_lblty_otherliability_id;


			cal_iss_total_deposit = val_lblty_ttl_deposit_id + val_lblty_ttl_billspayable_id;
			cal_iss_total_loanoutstanding = val_ass_advanceloan_id + val_ass_advanceoverdraft_id + val_ass_advancediscount_id;
			cal_iss_total_fixedasset = val_ass_fur_fix_id + val_ass_computer_id + val_ass_land_building_id;
			cal_iss_total_totalotherasset = val_ass_otherasset_id;
			cal_iss_total_totalotherliability = val_lblty_otherliability_id;
			var cal_iss_total_hoglpb_temp = (val_ass_hogeneral_ac_id+val_ass_hocentral_ac_id+val_ass_cibt_id+val_ass_oibt_id+val_ass_ibfexch_id+val_ass_cashremittance_id)-(val_lblty_hogeneral_ac_id+val_llblty_ho_central_ac_id+val_lblty_cibt_id+val_lblty_oibt_id+val_lblty_ibfexc_id+val_lblty_cashremittance_id);
			cal_iss_total_hoglpb_temp = parseInt(cal_iss_total_hoglpb_temp);
			if(cal_iss_total_hoglpb_temp >=0)
			{
				cal_iss_total_hoglpb = cal_iss_total_hoglpb_temp;

				cal_iss_total_hoglnb = 0;

			}
			else{
				if(cal_iss_total_hoglpb_temp < 0)
				{
					cal_iss_total_hoglpb = 0;
					cal_iss_total_hoglnb = Math.abs(cal_iss_total_hoglpb_temp);
					cal_iss_total_hoglpb_temp = Math.abs(cal_iss_total_hoglpb_temp);
				}
			}

			if( cal_iss_total_asset < cal_iss_total_liability )
			{
				cal_iss_total_asset = cal_iss_total_asset + cal_iss_total_hoglpb_temp;
			}
			else
			{
				cal_iss_total_liability = cal_iss_total_liability + cal_iss_total_hoglpb_temp;
			}

			cal_iss_icome_expen_diff = val_lblty_incomeac_id - val_ass_expenditureac_id;
			var cal_iss_icome_expen_diff_after;
			if( cal_iss_icome_expen_diff < 0)
			{
				cal_iss_icome_expen_diff = Math.abs(cal_iss_icome_expen_diff);

				cal_iss_total_asset = cal_iss_total_asset + cal_iss_icome_expen_diff;


			}
			else
			{

				cal_iss_total_liability = cal_iss_total_liability + cal_iss_icome_expen_diff;
			}

		}

		$(".iss_total_asset span.span_total_asset").text(Math.round(cal_iss_total_asset));
		$(".iss_total_liability span.span_total_liability").text(Math.round(cal_iss_total_liability));
		$(".iss_total_deposit span.span_total_deposit").text(Math.round(cal_iss_total_deposit));
		$(".iss_total_loanoutstanding span.span_total_loanoutstanding").text(Math.round(cal_iss_total_loanoutstanding));
		$(".iss_total_hoglpb span.span_total_hoglpb").text(Math.round(cal_iss_total_hoglpb));
		$(".iss_total_hoglnb span.span_total_hoglnb").text(Math.round(cal_iss_total_hoglnb));
		$(".iss_total_totalotherasset span.span_totalotherasset").text((cal_iss_total_totalotherasset));
		$(".iss_total_totalotherliability span.span_total_totalotherliability").text((cal_iss_total_totalotherliability));
		$(".iss_total_fixedasset span.span_total_fixedasset").text(Math.round(cal_iss_total_fixedasset));
	}
	else
	{
		alert("No");
	}
}

function iss_data_generate_reset(btn_click)
{
	if(btn_click =='Reset')
    {

		$("#lblty_ttl_deposit_id").val( ' ' );
		jQuery("#lblty_ttl_deposit_id").css('background','white');
		$("#lblty_ttl_billspayable_id").val( ' ' );
		jQuery("#lblty_ttl_billspayable_id").css('background','white');

		$("#lblty_otherliability_id").val( ' ' );
		jQuery("#lblty_otherliability_id").css('background','white');


		$("#lblty_hogeneral_ac_id").val( ' ' );
		jQuery("#lblty_hogeneral_ac_id").css('background','white');

		$("#lblty_ho_central_ac_id").val( ' ' );
		jQuery("#lblty_ho_central_ac_id").css('background','white');

		$("#lblty_cibt_id").val( ' ' );
		jQuery("#lblty_cibt_id").css('background','white');
		$("#lblty_oibt_id").val( ' ' );
		jQuery("#lblty_oibt_id").css('background','white');
		$("#lblty_ibfexc_id").val( ' ' );
		jQuery("#lblty_ibfexc_id").css('background','white');

		$("#lblty_cashremittance_id").val( ' ' );
		jQuery("#lblty_cashremittance_id").css('background','white');
		$("#lblty_incomeac_id").val( ' ' );
		jQuery("#lblty_incomeac_id").css('background','white');

		$("#ass_cashbnkblance_id").val( ' ' );
		jQuery("#ass_cashbnkblance_id").css('background','white');
		$("#ass_advanceloan_id").val( ' ' );
		jQuery("#ass_advanceloan_id").css('background','white');

		$("#ass_advanceoverdraft_id").val( ' ' );
		jQuery("#ass_advanceoverdraft_id").css('background','white');

		$("#ass_advancediscount_id").val( ' ' );
		jQuery("#ass_advancediscount_id").css('background','white');

		jQuery("#ass_otherasset_id").css('background','white');
		$("#ass_otherasset_id").val( ' ' );

		jQuery("#ass_fur_fix_id").css('background','white');
		$("#ass_fur_fix_id").val( ' ' );
		jQuery("#ass_computer_id").css('background','white');
		$("#ass_computer_id").val( ' ' );
		jQuery("#ass_land_building_id").css('background','white');
		$("#ass_land_building_id").val( ' ' );

		jQuery("#ass_hogeneral_ac_id").css('background','white');
		$("#ass_hogeneral_ac_id").val( ' ' );
		jQuery("#ass_hocentral_ac_id").css('background','white');
		$("#ass_hocentral_ac_id").val( ' ' );


		$("#ass_cibt_id").val( ' ' );
		jQuery("#ass_cibt_id").css('background','white');
		$("#ass_oibt_id").val( ' ' );
		jQuery("#ass_oibt_id").css('background','white');
		$("#ass_ibfexch_id").val( ' ' );
		jQuery("#ass_ibfexch_id").css('background','white');
		$("#ass_cashremittance_id").val( ' ' );
		jQuery("#ass_cashremittance_id").css('background','white');
		$("#ass_expenditureac_id").val( ' ' );
		jQuery("#ass_expenditureac_id").css('background','white');

	}
	else
	{
		alert("No");
	}
}
*/

function iss_data_generate_guideline(btn_click)
{
	if(btn_click =='Generate ISS Data')
    {

		var val_lblty_ttl_deposit_id = jQuery('#lblty_ttl_deposit_id').val();
		var val_lblty_ttl_billspayable_id = jQuery('#lblty_ttl_billspayable_id').val();
		var val_lblty_otherliability_id = jQuery('#lblty_otherliability_id').val();

		var val_lblty_hogeneral_ac_id = jQuery('#lblty_hogeneral_ac_id').val();
		var val_llblty_ho_central_ac_id = jQuery('#lblty_ho_central_ac_id').val();

		var val_lblty_cibt_id = jQuery('#lblty_cibt_id').val();
		var val_lblty_oibt_id = jQuery('#lblty_oibt_id').val();
		var val_lblty_ibfexc_id = jQuery('#lblty_ibfexc_id').val();
		var val_lblty_cashremittance_id = jQuery('#lblty_cashremittance_id').val();
		var val_lblty_incomeac_id = jQuery('#lblty_incomeac_id').val();

		var val_ass_cashbnkblance_id = jQuery('#ass_cashbnkblance_id').val();
		var val_ass_advanceloan_id = jQuery('#ass_advanceloan_id').val();
		var val_ass_advanceoverdraft_id = jQuery('#ass_advanceoverdraft_id').val();
		var val_ass_advancediscount_id = jQuery('#ass_advancediscount_id').val();
		var val_ass_otherasset_id = jQuery('#ass_otherasset_id').val();

		var val_ass_fur_fix_id = jQuery('#ass_fur_fix_id').val();
		var val_ass_computer_id = jQuery('#ass_computer_id').val();
		var val_ass_land_building_id = jQuery('#ass_land_building_id').val();

		var val_ass_hogeneral_ac_id = jQuery('#ass_hogeneral_ac_id').val();
		var val_ass_hocentral_ac_id = jQuery('#ass_hocentral_ac_id').val();

		var val_ass_cibt_id = jQuery('#ass_cibt_id').val();
		var val_ass_oibt_id = jQuery('#ass_oibt_id').val();
		var val_ass_ibfexch_id = jQuery('#ass_ibfexch_id').val();
		var val_ass_cashremittance_id = jQuery('#ass_cashremittance_id').val();
		var val_ass_expenditureac_id = jQuery('#ass_expenditureac_id').val();

		var cal_iss_icome_expen_diff = '0';

		var cal_iss_total_asset = '0';
		var cal_iss_total_liability = '0';
		var cal_iss_total_deposit = '0';
		var cal_iss_total_loanoutstanding = '0';
		var cal_iss_total_hoglpb = '0';
		var cal_iss_total_hoglnb = '0';
		var cal_iss_total_totalotherasset = '0';
		var cal_iss_total_totalotherliability = '0';
		var cal_iss_total_fixedasset = '0';


		var is_ok = 0;
		if(!$.isNumeric($('#lblty_ttl_deposit_id').val()) && $('#lblty_ttl_deposit_id').val() !=''){jQuery('#lblty_ttl_deposit_id').css('background','red');	}
		else { jQuery('#lblty_ttl_deposit_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_ttl_billspayable_id').val()) && $('#lblty_ttl_billspayable_id').val() !=''){jQuery('#lblty_ttl_billspayable_id').css('background','red');}
		else { jQuery('#lblty_ttl_billspayable_id').css('background','white');}
		if(!$.isNumeric($('#lblty_otherliability_id').val()) && $('#lblty_otherliability_id').val() !=''){ jQuery('#lblty_otherliability_id').css('background','red'); }
		else{ jQuery('#lblty_otherliability_id').css('background','white'); }

		if(!$.isNumeric($('#lblty_hogeneral_ac_id').val()) && $('#lblty_hogeneral_ac_id').val() !=''){ jQuery('#lblty_hogeneral_ac_id').css('background','red'); }
		else{ jQuery('#lblty_hogeneral_ac_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_ho_central_ac_id').val()) && $('#lblty_ho_central_ac_id').val() !=''){ jQuery('#lblty_ho_central_ac_id').css('background','red'); }
		else{ jQuery('#lblty_ho_central_ac_id').css('background','white'); }

		if(!$.isNumeric($('#lblty_cibt_id').val()) && $('#lblty_cibt_id').val() !=''){ jQuery('#lblty_cibt_id').css('background','red'); }
		else{ jQuery('#lblty_cibt_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_oibt_id').val()) && $('#lblty_oibt_id').val() !=''){ jQuery('#lblty_oibt_id').css('background','red'); }
		else{ jQuery('#lblty_oibt_id').css('background','white'); }
		if(!$.isNumeric($('#lblty_ibfexc_id').val()) && $('#lblty_ibfexc_id').val() !=''){ jQuery('#lblty_ibfexc_id').css('background','red'); }
		else{ jQuery('#lblty_ibfexc_id').css('background','white'); }

		if(!$.isNumeric($('#lblty_cashremittance_id').val()) && $('#lblty_cashremittance_id').val() !=''){ jQuery('#lblty_cashremittance_id').css('background','red'); }
		else{ jQuery('#lblty_cashremittance_id').css('background','white'); }

		if(!$.isNumeric($('#lblty_incomeac_id').val()) && $('#lblty_incomeac_id').val() !=''){ jQuery('#lblty_incomeac_id').css('background','red'); }
		else{ jQuery('#lblty_incomeac_id').css('background','white'); }

		if(!$.isNumeric($('#ass_cashbnkblance_id').val()) && $('#ass_cashbnkblance_id').val() !=''){ jQuery('#ass_cashbnkblance_id').css('background','red'); }
		else{ jQuery('#ass_cashbnkblance_id').css('background','white'); }
		if(!$.isNumeric($('#ass_advanceloan_id').val()) && $('#ass_advanceloan_id').val() !=''){ jQuery('#ass_advanceloan_id').css('background','red'); }
		else{ jQuery('#ass_advanceloan_id').css('background','white'); }
		if(!$.isNumeric($('#ass_advanceoverdraft_id').val()) && $('#ass_advanceoverdraft_id').val() !=''){ jQuery('#ass_advanceoverdraft_id').css('background','red'); }
		else{ jQuery('#ass_advanceoverdraft_id').css('background','white'); }
		if(!$.isNumeric($('#ass_advancediscount_id').val()) && $('#ass_advancediscount_id').val() !=''){ jQuery('#ass_advancediscount_id').css('background','red'); }
		else{ jQuery('#ass_advancediscount_id').css('background','white'); }
		if(!$.isNumeric($('#ass_otherasset_id').val()) && $('#ass_otherasset_id').val() !=''){ jQuery('#ass_otherasset_id').css('background','red'); }
		else{ jQuery('#ass_otherasset_id').css('background','white'); }

		if(!$.isNumeric($('#ass_fur_fix_id').val()) && $('#ass_fur_fix_id').val() !=''){ jQuery('#ass_fur_fix_id').css('background','red'); }
		else{ jQuery('#ass_fur_fix_id').css('background','white'); }
		if(!$.isNumeric($('#ass_computer_id').val()) && $('#ass_computer_id').val() !=''){ jQuery('#ass_computer_id').css('background','red'); }
		else{ jQuery('#ass_computer_id').css('background','white'); }
		if(!$.isNumeric($('#ass_land_building_id').val()) && $('#ass_land_building_id').val() !=''){ jQuery('#ass_land_building_id').css('background','red'); }
		else{ jQuery('#ass_land_building_id').css('background','white'); }

		if(!$.isNumeric($('#ass_hogeneral_ac_id').val()) && $('#ass_hogeneral_ac_id').val() !=''){ jQuery('#ass_hogeneral_ac_id').css('background','red'); }
		else{ jQuery('#ass_hogeneral_ac_id').css('background','white'); }
		if(!$.isNumeric($('#ass_hocentral_ac_id').val()) && $('#ass_hocentral_ac_id').val() !=''){ jQuery('#ass_hocentral_ac_id').css('background','red'); }
		else{ jQuery('#ass_hocentral_ac_id').css('background','white'); }

		if(!$.isNumeric($('#ass_cibt_id').val()) && $('#ass_cibt_id').val() !=''){ jQuery('#ass_cibt_id').css('background','red'); }
		else{ jQuery('#ass_cibt_id').css('background','white'); }
		if(!$.isNumeric($('#ass_oibt_id').val()) && $('#ass_oibt_id').val() !=''){ jQuery('#ass_oibt_id').css('background','red'); }
		else{ jQuery('#ass_oibt_id').css('background','white'); }
		if(!$.isNumeric($('#ass_ibfexch_id').val()) && $('#ass_ibfexch_id').val() !=''){ jQuery('#ass_ibfexch_id').css('background','red'); }
		else{ jQuery('#ass_ibfexch_id').css('background','white'); }
		if(!$.isNumeric($('#ass_cashremittance_id').val()) && $('#ass_cashremittance_id').val() !=''){ jQuery('#ass_cashremittance_id').css('background','red'); }
		else{ jQuery('#ass_cashremittance_id').css('background','white'); }

		if(!$.isNumeric($('#ass_expenditureac_id').val()) && $('#ass_expenditureac_id').val() !=''){ jQuery('#ass_expenditureac_id').css('background','red'); }
		else{ jQuery('#ass_expenditureac_id').css('background','white'); }


		 if((!$.isNumeric($('#lblty_ttl_deposit_id').val()) || $('#lblty_ttl_deposit_id').val() =='') &&
		   (!$.isNumeric($('#lblty_ttl_billspayable_id').val()) || $('#lblty_ttl_billspayable_id').val() =='') &&
		   (!$.isNumeric($('#lblty_otherliability_id').val()) || $('#lblty_otherliability_id').val() =='') &&

		   (!$.isNumeric($('#lblty_hogeneral_ac_id').val()) || $('#lblty_hogeneral_ac_id').val() =='') &&
		   (!$.isNumeric($('#val_llblty_ho_central_ac_id').val()) || $('#val_llblty_ho_central_ac_id').val() =='') &&

		   (!$.isNumeric($('#lblty_cibt_id').val()) || $('#lblty_cibt_id').val() =='') &&
		   (!$.isNumeric($('#lblty_oibt_id').val()) || $('#lblty_oibt_id').val() =='') &&
		   (!$.isNumeric($('#lblty_ibfexc_id').val()) || $('#lblty_ibfexc_id').val() =='') &&

		   (!$.isNumeric($('#lblty_cashremittance_id').val()) || $('#lblty_cashremittance_id').val() =='') &&
		   (!$.isNumeric($('#lblty_incomeac_id').val()) || $('#lblty_incomeac_id').val() =='') &&

		   (!$.isNumeric($('#ass_cashbnkblance_id').val()) || $('#ass_cashbnkblance_id').val() =='') &&
		   (!$.isNumeric($('#ass_advanceloan_id').val()) || $('#ass_advanceloan_id').val() =='') &&
		   (!$.isNumeric($('#ass_advanceoverdraft_id').val()) || $('#ass_advanceoverdraft_id').val() =='') &&
		   (!$.isNumeric($('#ass_advancediscount_id').val()) || $('#ass_advancediscount_id').val() =='') &&
		   (!$.isNumeric($('#ass_otherasset_id').val()) || $('#ass_otherasset_id').val() =='') &&

		   (!$.isNumeric($('#ass_hogeneral_ac_id').val()) || $('#ass_hogeneral_ac_id').val() =='') &&
		   (!$.isNumeric($('#ass_hocentral_ac_id').val()) || $('#ass_hocentral_ac_id').val() =='') &&

		   (!$.isNumeric($('#ass_fur_fix_id').val()) || $('#ass_fur_fix_id').val() =='') &&
		   (!$.isNumeric($('#ass_computer_id').val()) || $('#ass_computer_id').val() =='') &&
		   (!$.isNumeric($('#ass_land_building_id').val()) || $('#ass_land_building_id').val() =='') &&

		   (!$.isNumeric($('#ass_cibt_id').val()) || $('#ass_cibt_id').val() =='') &&
		   (!$.isNumeric($('#ass_oibt_id').val()) || $('#ass_oibt_id').val() =='') &&
		   (!$.isNumeric($('#ass_ibfexch_id').val()) || $('#ass_ibfexch_id').val() =='') &&
		   (!$.isNumeric($('#ass_cashremittance_id').val()) || $('#ass_cashremittance_id').val() =='')
		   (!$.isNumeric($('#ass_expenditureac_id').val()) || $('#ass_expenditureac_id').val() ==''))
		   {
				alert('Please input valid digit!!');
		   }
		else
		{

			if(!$.isNumeric(val_lblty_ttl_deposit_id)){val_lblty_ttl_deposit_id=0;}
			if(!$.isNumeric(val_lblty_ttl_billspayable_id)){val_lblty_ttl_billspayable_id=0;}
			if(!$.isNumeric(val_lblty_otherliability_id)){val_lblty_otherliability_id=0;}

			if(!$.isNumeric(val_lblty_hogeneral_ac_id)){val_lblty_hogeneral_ac_id=0;}
			if(!$.isNumeric(val_llblty_ho_central_ac_id)){val_llblty_ho_central_ac_id=0;}

			if(!$.isNumeric(val_lblty_cibt_id)){val_lblty_cibt_id=0;}
			if(!$.isNumeric(val_lblty_oibt_id)){val_lblty_oibt_id=0;}
			if(!$.isNumeric(val_lblty_ibfexc_id)){val_lblty_ibfexc_id=0;}
			if(!$.isNumeric(val_lblty_cashremittance_id)){val_lblty_cashremittance_id=0;}
			if(!$.isNumeric(val_lblty_incomeac_id)){val_lblty_incomeac_id = 0;}


			if(!$.isNumeric(val_ass_cashbnkblance_id)){val_ass_cashbnkblance_id=0;}
			if(!$.isNumeric(val_ass_advanceloan_id)){val_ass_advanceloan_id=0;}
			if(!$.isNumeric(val_ass_advanceoverdraft_id)){val_ass_advanceoverdraft_id=0;}
			if(!$.isNumeric(val_ass_advancediscount_id)){val_ass_advancediscount_id=0;}
			if(!$.isNumeric(val_ass_otherasset_id)){val_ass_otherasset_id=0;}

			if(!$.isNumeric(val_ass_fur_fix_id)){val_ass_fur_fix_id=0;}
			if(!$.isNumeric(val_ass_computer_id)){val_ass_computer_id=0;}
			if(!$.isNumeric(val_ass_land_building_id)){val_ass_land_building_id=0;}

			if(!$.isNumeric(val_ass_hogeneral_ac_id)){val_ass_hogeneral_ac_id=0;}
			if(!$.isNumeric(val_ass_hocentral_ac_id)){val_ass_hocentral_ac_id=0;}

			if(!$.isNumeric(val_ass_cibt_id)){val_ass_cibt_id=0;}
			if(!$.isNumeric(val_ass_oibt_id)){val_ass_oibt_id=0;}
			if(!$.isNumeric(val_ass_ibfexch_id)){val_ass_ibfexch_id=0;}
			if(!$.isNumeric(val_ass_cashremittance_id)){val_ass_cashremittance_id = 0;}
			if(!$.isNumeric(val_ass_expenditureac_id)){val_ass_expenditureac_id = 0;}

			val_lblty_ttl_deposit_id = parseFloat(val_lblty_ttl_deposit_id);
			val_lblty_ttl_billspayable_id = parseFloat(val_lblty_ttl_billspayable_id);
			val_lblty_otherliability_id = parseFloat(val_lblty_otherliability_id);

			val_lblty_hogeneral_ac_id = parseFloat(val_lblty_hogeneral_ac_id);
			val_llblty_ho_central_ac_id = parseFloat(val_llblty_ho_central_ac_id);

			val_lblty_cibt_id = parseFloat(val_lblty_cibt_id);
			val_lblty_oibt_id = parseFloat(val_lblty_oibt_id);
			val_lblty_ibfexc_id = parseFloat(val_lblty_ibfexc_id);
			val_lblty_cashremittance_id = parseFloat(val_lblty_cashremittance_id);
			val_lblty_incomeac_id = parseFloat(val_lblty_incomeac_id);

			val_ass_cashbnkblance_id = parseFloat(val_ass_cashbnkblance_id);
			val_ass_advanceloan_id = parseFloat(val_ass_advanceloan_id);
			val_ass_advanceoverdraft_id = parseFloat(val_ass_advanceoverdraft_id);
			val_ass_advancediscount_id = parseFloat(val_ass_advancediscount_id);
			val_ass_otherasset_id = parseFloat(val_ass_otherasset_id);

			val_ass_fur_fix_id = parseFloat(val_ass_fur_fix_id);
			val_ass_computer_id = parseFloat(val_ass_computer_id);
			val_ass_land_building_id = parseFloat(val_ass_land_building_id);

			val_ass_hogeneral_ac_id = parseFloat(val_ass_hogeneral_ac_id);
			val_ass_hocentral_ac_id = parseFloat(val_ass_hocentral_ac_id);

			val_ass_cibt_id = parseFloat(val_ass_cibt_id);
			val_ass_oibt_id = parseFloat(val_ass_oibt_id);
			val_ass_ibfexch_id = parseFloat(val_ass_ibfexch_id);
			val_ass_cashremittance_id = parseFloat(val_ass_cashremittance_id);
			val_ass_expenditureac_id = parseFloat(val_ass_expenditureac_id);


			cal_iss_total_asset = val_ass_advanceloan_id + val_ass_advanceoverdraft_id + val_ass_advancediscount_id + val_ass_cashbnkblance_id +val_ass_otherasset_id + val_ass_fur_fix_id + val_ass_computer_id + val_ass_land_building_id;

			cal_iss_total_liability = val_lblty_ttl_deposit_id + val_lblty_ttl_billspayable_id + val_lblty_otherliability_id;


			cal_iss_total_deposit = val_lblty_ttl_deposit_id + val_lblty_ttl_billspayable_id;
			cal_iss_total_loanoutstanding = val_ass_advanceloan_id + val_ass_advanceoverdraft_id + val_ass_advancediscount_id;

			cal_iss_total_fixedasset = val_ass_fur_fix_id + val_ass_computer_id + val_ass_land_building_id;
			cal_iss_total_totalotherasset = val_ass_otherasset_id;
			cal_iss_total_totalotherliability = val_lblty_otherliability_id;

			var cal_iss_total_hoglpb_temp = (val_ass_hogeneral_ac_id+val_ass_hocentral_ac_id+val_ass_cibt_id+val_ass_oibt_id+val_ass_ibfexch_id+val_ass_cashremittance_id)-(val_lblty_hogeneral_ac_id+val_llblty_ho_central_ac_id+val_lblty_cibt_id+val_lblty_oibt_id+val_lblty_ibfexc_id+val_lblty_cashremittance_id);

			cal_iss_total_hoglpb_temp = parseInt(cal_iss_total_hoglpb_temp);

			if(cal_iss_total_hoglpb_temp >=0)
			{
				cal_iss_total_hoglpb = cal_iss_total_hoglpb_temp;

				cal_iss_total_hoglnb = 0;

			}
			else{
				if(cal_iss_total_hoglpb_temp < 0)
				{
					cal_iss_total_hoglpb = 0;
					cal_iss_total_hoglnb = Math.abs(cal_iss_total_hoglpb_temp);
				}
			}

			cal_iss_icome_expen_diff = val_lblty_incomeac_id - val_ass_expenditureac_id;
			var cal_iss_icome_loss =0 ;
			var cal_iss_icome_expen_profit = 0;
			if( cal_iss_icome_expen_diff < 0)
			{
				cal_iss_icome_loss = Math.abs(cal_iss_icome_expen_diff);

			}
			else
			{

				cal_iss_icome_expen_profit = cal_iss_icome_expen_diff;
			}

			cal_iss_total_asset = cal_iss_total_asset + cal_iss_total_hoglpb + cal_iss_icome_loss;

			cal_iss_total_liability = cal_iss_total_liability + cal_iss_total_hoglnb + cal_iss_icome_expen_profit;



			cal_iss_total_asset = parseFloat(cal_iss_total_asset).toFixed(2);
			cal_iss_total_liability = parseFloat(cal_iss_total_liability).toFixed(2);
			cal_iss_total_deposit = parseFloat(cal_iss_total_deposit).toFixed(2);
			cal_iss_total_loanoutstanding = parseFloat(cal_iss_total_loanoutstanding).toFixed(2);
			cal_iss_total_hoglpb = parseFloat(cal_iss_total_hoglpb).toFixed(2);
			cal_iss_total_hoglnb = parseFloat(cal_iss_total_hoglnb).toFixed(2);
			cal_iss_total_totalotherasset = parseFloat(cal_iss_total_totalotherasset).toFixed(2);
			cal_iss_total_totalotherliability = parseFloat(cal_iss_total_totalotherliability).toFixed(2);
			cal_iss_total_fixedasset = parseFloat(cal_iss_total_fixedasset).toFixed(2);

		}

		$(".iss_total_asset span.span_total_asset").text((cal_iss_total_asset));
		$(".iss_total_liability span.span_total_liability").text((cal_iss_total_liability));
		$(".iss_total_deposit span.span_total_deposit").text((cal_iss_total_deposit));
		$(".iss_total_loanoutstanding span.span_total_loanoutstanding").text((cal_iss_total_loanoutstanding));
		$(".iss_total_hoglpb span.span_total_hoglpb").text((cal_iss_total_hoglpb));
		$(".iss_total_hoglnb span.span_total_hoglnb").text((cal_iss_total_hoglnb));
		$(".iss_total_totalotherasset span.span_totalotherasset").text((cal_iss_total_totalotherasset));
		$(".iss_total_totalotherliability span.span_total_totalotherliability").text((cal_iss_total_totalotherliability));
		$(".iss_total_fixedasset span.span_total_fixedasset").text((cal_iss_total_fixedasset));
	}
	else
	{
		alert("No");
	}
}

function iss_data_generate_reset(btn_click)
{
	if(btn_click =='Reset')
    {

		$("#lblty_ttl_deposit_id").val( ' ' );
		jQuery("#lblty_ttl_deposit_id").css('background','white');
		$("#lblty_ttl_billspayable_id").val( ' ' );
		jQuery("#lblty_ttl_billspayable_id").css('background','white');

		$("#lblty_otherliability_id").val( ' ' );
		jQuery("#lblty_otherliability_id").css('background','white');


		$("#lblty_hogeneral_ac_id").val( ' ' );
		jQuery("#lblty_hogeneral_ac_id").css('background','white');

		$("#lblty_ho_central_ac_id").val( ' ' );
		jQuery("#lblty_ho_central_ac_id").css('background','white');

		$("#lblty_cibt_id").val( ' ' );
		jQuery("#lblty_cibt_id").css('background','white');
		$("#lblty_oibt_id").val( ' ' );
		jQuery("#lblty_oibt_id").css('background','white');
		$("#lblty_ibfexc_id").val( ' ' );
		jQuery("#lblty_ibfexc_id").css('background','white');

		$("#lblty_cashremittance_id").val( ' ' );
		jQuery("#lblty_cashremittance_id").css('background','white');
		$("#lblty_incomeac_id").val( ' ' );
		jQuery("#lblty_incomeac_id").css('background','white');

		$("#ass_cashbnkblance_id").val( ' ' );
		jQuery("#ass_cashbnkblance_id").css('background','white');
		$("#ass_advanceloan_id").val( ' ' );
		jQuery("#ass_advanceloan_id").css('background','white');

		$("#ass_advanceoverdraft_id").val( ' ' );
		jQuery("#ass_advanceoverdraft_id").css('background','white');

		$("#ass_advancediscount_id").val( ' ' );
		jQuery("#ass_advancediscount_id").css('background','white');

		jQuery("#ass_otherasset_id").css('background','white');
		$("#ass_otherasset_id").val( ' ' );

		jQuery("#ass_fur_fix_id").css('background','white');
		$("#ass_fur_fix_id").val( ' ' );
		jQuery("#ass_computer_id").css('background','white');
		$("#ass_computer_id").val( ' ' );
		jQuery("#ass_land_building_id").css('background','white');
		$("#ass_land_building_id").val( ' ' );

		jQuery("#ass_hogeneral_ac_id").css('background','white');
		$("#ass_hogeneral_ac_id").val( ' ' );
		jQuery("#ass_hocentral_ac_id").css('background','white');
		$("#ass_hocentral_ac_id").val( ' ' );


		$("#ass_cibt_id").val( ' ' );
		jQuery("#ass_cibt_id").css('background','white');
		$("#ass_oibt_id").val( ' ' );
		jQuery("#ass_oibt_id").css('background','white');
		$("#ass_ibfexch_id").val( ' ' );
		jQuery("#ass_ibfexch_id").css('background','white');
		$("#ass_cashremittance_id").val( ' ' );
		jQuery("#ass_cashremittance_id").css('background','white');
		$("#ass_expenditureac_id").val( ' ' );
		jQuery("#ass_expenditureac_id").css('background','white');

	}
	else
	{
		alert("No");
	}
}


/*Guideline end*/
/** ISS Graph start*/
 function fetch_br_ao_do_iss_com_graph(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_do_iss_com_graphindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="6"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="6"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }

/** ISS Graph end*/

/** ISS Form-4 start*/
function check_search_form_iss_4(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year=jQuery('#report_of_date').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_form_4_search_form').submit();
        }
        else
        {
            alert('First Select Date Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='iss_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='iss_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_form_4_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }
/** ISS Form-4 end*/

///////////////////////ISS Abnormal Increase decrease start//////////////////
function control_iss_abn_incr_dec_report_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }
        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
 }
function fetch_br_ao_do_iss_2_abn_incr_dec(str_val)
 {
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var url =  "fetch_br_ao_do_issindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }

 function check_search_form_iss_2_abn_incr_decr(str)
 {
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();

      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_date1=jQuery('#report_of_date1').val();
		var report_date1_temp = report_date1.toString(report_date1);
		var report_date1_res = report_date1_temp.substring(7, 11);
        if(report_date1 !='')
        {
			if( report_date1_res >= 2016 )
			{
				var report_click_btn=0;
				if(str=='View Report'){report_click_btn=1;}
				if(str=='Missing List'){report_click_btn=2;}
				if(str=='Completed List'){report_click_btn=3;}
				jQuery('#report_click_btn').val(report_click_btn);
				jQuery('#iss_abn_incr_dec_search_form').submit();
			}
			else
			{
				alert("Select Higher year date..");
			}
        }
        else
        {
            alert('First Select Date Of Report.');
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='iss_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='iss_report_office_id']:checked").val();
        }
        var report_year=jQuery('#report_of_date').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year !='' && br_ao_do_text !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Missing List'){report_click_btn=2;}
            if(str=='Completed List'){report_click_btn=3;}
            jQuery('#report_click_btn').val(report_click_btn);
			var val_incrdecr_param1 = jQuery('#incrdecr_param1').val();
			var val_incrdecr_param2 = jQuery('#incrdecr_param2').val();

			if($("#incrdecr_param1").val().trim().length == 0 && $("#incrdecr_param2").val().trim().length == 0) {
				alert("Please enter Increase/Decrease Value!");
			}
			else {
				var is_flag;
				if(isNaN( $("#incrdecr_param1").val())){
					is_flag = 0;
				}
				else { is_flag = 1;
					if(isNaN( $("#incrdecr_param2").val())){
					is_flag =0;
					}
				else { is_flag =1; }
				}
				if(isNaN( $("#incrdecr_param2").val())){
					is_flag = 0;
				}
				else { is_flag = 1;
					if(isNaN( $("#incrdecr_param1").val())){
					is_flag =0;
					}
				else { is_flag =1; }
				}

				if( is_flag == 1 )
				{
					jQuery('#iss_abn_incr_dec_search_form').submit();
				}
				else {
					alert("Please Enter a valid digit!!");
				}
			}
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }


 ///////////////////////ISS-1 Continous start --16/06/2017--//////////////////
 function check_search_form_iss_1_continous(str)
 {
    if(str !='')
    {
		var report_year = jQuery('#report_of_date_con_year').val();
		if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            jQuery('#report_click_btn').val(report_click_btn);
			jQuery('#iss1_con_report_search_form').submit();
        }
        else
        {
            alert('First Select Date Of Report.');
        }
    }
 }
///////////////////////ISS-1 Continous end --16/06/2017--//////////////////
/* ISS Form-3 start --16/06/2017--*/
function check_search_form_iss_3(str)
 {
    if(str !='')
    {
        var report_year=jQuery('#report_of_date').val();
        if(report_year !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#iss_form_3_search_form').submit();
        }
        else
        {
            alert('First Select Date Of Report.');
        }
    }
 }
/* ISS Form-3 end --16/06/2017--*/

///////////////////////ISS Abnormal Increase decrease end//////////////////
///////////////////////ISS form-1 item wise report start//////////////////
 function check_search_form_iss_1_item(str)
 {
   if(str !='')
    {
        var iss_form_1_item = jQuery('#report_of_iss1_item').val();
        var report_of_iss1_item_val = jQuery('#report_of_iss1_item').val();

	    if(report_of_iss1_item_val !='')
	    {
			jQuery('#report_of_iss2_item').css( "background", "white" );
			var report_option_selector = jQuery('#report_option_selector').val();
			var report_date1 = jQuery('#report_of_date1').val();
			var report_date2 = jQuery('#report_of_date2').val();

		  if(report_option_selector == 1 || report_option_selector == 5)
		  {
			var report_date1_temp = report_date1.toString(report_date1);
			var report_date2_temp = report_date2.toString(report_date2);
			var report_date1_res = report_date1_temp.substring(7, 11);
			var report_date2_res = report_date2_temp.substring(7, 11);

			if(report_date1 !='' && report_date2 !='')
			{
				jQuery('#report_of_date1').css( "background", "white" );
				jQuery('#report_of_date2').css( "background", "white" );
				//if(report_date1_res >= 2016 && report_date2_res >=2016)
				{
					//jQuery('#report_of_date1').css( "background", "white" );
					//jQuery('#report_of_date2').css( "background", "white" );

					var report_click_btn=0;
					if(str=='View Report'){ report_click_btn = 1; }
					if(str=='Graph'){ report_click_btn = 2; }
					jQuery('#report_click_btn').val(report_click_btn);


					jQuery('#iss_item_search_form').submit();
				}
				//else
				{
					//alert("Please select Higher year date..");
				}

			}
			else
			{
				alert('First Select Date Of Report.');
				if(report_date1 != ''){jQuery('#report_of_date1').css( "background", "red" );}
				if(report_date2 != ''){jQuery('#report_of_date2').css( "background", "red" );}
			}
		  }
		  else
		  {

			if(report_date1 !='' && report_date2 !='')
			{
				jQuery('#report_of_date1').css( "background", "white" );
				jQuery('#report_of_date2').css( "background", "white" );

				var report_click_btn=0;
				if(str=='View Report'){report_click_btn=1;}
				if(str=='Graph'){ report_click_btn = 2; }
				jQuery('#report_click_btn').val(report_click_btn);

				jQuery('#iss_item_search_form').submit();
			}
			else
			{
				alert('First Fill The Search Form Properly.');

				if(report_date1 == ''){jQuery('#report_of_date1').css( "background", "red" );}
				else{jQuery('#report_of_date1').css( "background", "white" );}
				if(report_date2 == ''){jQuery('#report_of_date2').css( "background", "red" );}
				else{jQuery('#report_of_date2').css( "background", "white" );}
			}
		  }
	    }
	   else
	    {
			alert("Please Select Atleat one ISS Form-1 Item!!!!");
			jQuery('#report_of_iss2_item').css( "background", "red" );
	    }

    }
 }
 /* Edit here end*/


function check_fig_indication_iss1(str)
{
    if(str !='')
    {
        var r = $("input[name='amt_fig']:checked").val();
		$("#fig_indication_post").val(r);

		$("#pdf_btn_inst").val(0);

        $('#iss_item_1_dis_form').submit();
    }
}

function check_fig_indication_gr_iss1(str)
{
    if(str !='')
    {
        var r = $("input[name='amt_fig']:checked").val();
		$("#fig_indication_post").val(r);

		$("#pdf_btn_inst").val(0);

        $('#iss_item_1_dis_gr_form').submit();
    }
}

function check_iss_form1_item_pdf(str)
{
   if(str !='')
    {
		var report_pdf_btn = 0;
		if(str=='Save AS PDF')
		{
			report_pdf_btn = 1;
			jQuery('#pdf_btn_inst').val(report_pdf_btn);
			jQuery('#iss_item_1_dis_form').submit();
		}
    }
}
///////////////////////ISS form-1 item wise report end//////////////////

///////////////////////ISS form-2 item wise report start//////////////////
function check_fig_indication_iss2_item(str)
{
    if(str !='')
    {
        var r = $("input[name='amt_fig']:checked").val();
		$("#fig_indication_post").val(r);

		$("#pdf_btn_inst").val(0);

        $('#iss_item_2_item_wise_form').submit();
    }
}
function check_fig_indication_gr_iss2(str)
{
    if(str !='')
    {
        var r = $("input[name='amt_fig']:checked").val();
		$("#fig_indication_post").val(r);

		$("#pdf_btn_inst").val(0);

        $('#iss_item_2_dis_gr_form').submit();
    }
}
///////////////////////ISS form-2 item wise report end//////////////////

///////////////////////ISS form-2 comparison report start//////////////////
function check_fig_indication_iss2_compar(str)
{
    if(str !='')
    {
        var r = $("input[name='amt_fig']:checked").val();
		$("#fig_indication_post").val(r);
		$("#pdf_btn_inst").val(0);
        $('#iss_item_2_compar_form').submit();
    }
}

function check_fig_indication_iss2_cust_compar(str)
{
    if(str !='')
    {
        var r = $("input[name='amt_fig']:checked").val();
		$("#fig_indication_post").val(r);
		$("#pdf_btn_inst").val(0);
        $('#iss_item_2_cust_compar_form').submit();
    }
}


function check_iss_form2_compar_pdf(str)
{
   if(str !='')
    {
		var report_pdf_btn = 0;
		if(str=='Save AS PDF')
		{
			report_pdf_btn = 1;
			jQuery('#pdf_btn_inst').val(report_pdf_btn);
			jQuery('#iss_item_2_compar_form').submit();
		}
    }
}
///////////////////////ISS form-2 comparison report start//////////////////

///////////////////////ISS form-2 query report start//////////////////
function check_fig_indication_iss2_query(str)
{
    if(str !='')
    {
        var r = $("input[name='amt_fig']:checked").val();
		$("#fig_indication_post").val(r);
		$("#pdf_btn_inst").val(0);
        $('#iss_item_2_query_form').submit();
    }
}

function check_iss_form2_query_pdf(str)
{
   if(str !='')
    {
		var report_pdf_btn = 0;
		if(str=='Save AS PDF')
		{
			report_pdf_btn = 1;
			jQuery('#pdf_btn_inst').val(report_pdf_btn);
			jQuery('#iss_item_2_query_form').submit();
		}
    }
}
///////////////////////ISS form-2 query report start//////////////////

///////////////////////ISS form-1 report start//////////////////
function check_fig_indication_iss1_rep(str)
{
    if(str !='')
    {
        var r = $("input[name='amt_fig']:checked").val();
		$("#fig_indication_post").val(r);
		$("#pdf_btn_inst").val(0);
        $('#iss_item_2_query_form').submit();
    }
}

function check_iss_form1_rep_pdf(str)
{
   if(str !='')
    {
		var report_pdf_btn = 0;
		if(str=='Save AS PDF')
		{
			report_pdf_btn = 1;
			jQuery('#pdf_btn_inst').val(report_pdf_btn);
			jQuery('#iss_item_2_query_form').submit();
		}
    }
}
///////////////////////ISS form-1 report end//////////////////

///////////////////////ISS form-1 continouus report start//////////////////
function check_fig_indication_iss1_con_rep(str)
{
    if(str !='')
    {
        var r = $("input[name='amt_fig']:checked").val();
		$("#fig_indication_post").val(r);
		$("#pdf_btn_inst").val(0);
        $('#iss_form_1_continous_report__form').submit();
    }
}

function check_iss_form1_con_rep_pdf(str)
{
   if(str !='')
    {
		var report_pdf_btn = 0;
		if(str=='Save AS PDF')
		{
			report_pdf_btn = 1;
			jQuery('#pdf_btn_inst').val(report_pdf_btn);
			jQuery('#iss_form_1_continous_report__form').submit();
		}
    }
}
///////////////////////ISS form-1 continouus report end//////////////////

///////////////////////ISS form-2 continouus report//////////////////
function check_fig_indication_iss2_con_rep(str)
{
    if(str !='')
    {
        var r = $("input[name='amt_fig']:checked").val();
		$("#fig_indication_post").val(r);
		$("#pdf_btn_inst").val(0);
        $('#iss_form_2_continous_report_form').submit();
    }
}

function check_iss_form2_con_rep_pdf(str)
{
   if(str !='')
    {
		var report_pdf_btn = 0;
		if(str=='Save AS PDF')
		{
			report_pdf_btn = 1;
			jQuery('#pdf_btn_inst').val(report_pdf_btn);
			jQuery('#iss_form_2_continous_report_form').submit();
		}
    }
}
///////////////////////ISS form-2 continouus report end//////////////////
///////////////////////ISS form-2 iss_2_0001 report start//////////////////
function control_iss_2_0001_report_form(ptr)
 {

    if(ptr>0)
    {
        jQuery('#search_form_table_n').show('slow');
       jQuery('#search_form_table_iss2_1').show('slow');
        jQuery('#search_form_table_iss2_2').show('slow');
        if(ptr==1 || ptr==5)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

        //control missing & completed
        if(ptr==2)
        {
           jQuery('#missing_list,#completed_list').hide('slow');
        }
        else
        {
            var login_office_status=jQuery('#login_office_status').val();
            if(login_office_status != 4)
            {
              jQuery('#missing_list,#completed_list').show('slow');
            }
            else
            {
               jQuery('#missing_list,#completed_list').hide('slow');
            }
        }

    }
    else
    {
      jQuery('#search_form_table_n').hide('slow');
      jQuery('#search_form_table_iss2_1').hide('slow');
      jQuery('#search_form_table_iss2_2').hide('slow');
    }



 }
 function control_iss_2_0001_item_form(ptr)
 {

 	if(ptr !='')
    {
       var key_val_pre = jQuery('#report_of_iss2_item').val();
       var url = "fetch_iss2_itemindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'key_val_pre='+key_val_pre,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_iss2_items_msg').html(response);
                }
                else
                {
                   jQuery('#report_iss2_items_msg').html('<td COLSPAN="4"><h6 style="color: red;">Please select ISS form-2 item </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_iss2_items_msg').html('<td COLSPAN="4"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }

 function do_this(){

        var checkboxes = document.getElementsByName('iss2chk[]');
        var button = document.getElementById('toggle');

        if(button.value == 'select'){
            for (var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
            button.value = 'deselect'
        }else{
            for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
            button.value = 'select';
        }
    }

function check_search_form_iss_2_0001_item(str)
 {
   if(str !='')
    {
        var atLeastOneIsChecked = $('input[name="iss2chk[]"]:checked').length > 0;


	    if(atLeastOneIsChecked)
	    {
			jQuery('#report_of_iss2_item').css( "background", "white" );
			var report_option_selector = jQuery('#report_option_selector').val();
			var report_date1 = jQuery('#report_of_date1').val();
			var report_date2 = jQuery('#report_of_date2').val();

		  if(report_option_selector == 1 || report_option_selector == 5)
		  {
			var report_date1_temp = report_date1.toString(report_date1);
			var report_date2_temp = report_date2.toString(report_date2);
			var report_date1_res = report_date1_temp.substring(7, 11);
			var report_date2_res = report_date2_temp.substring(7, 11);

			if(report_date1 !='' && report_date2 !='')
			{
				jQuery('#report_of_date1').css( "background", "white" );
				jQuery('#report_of_date2').css( "background", "white" );
				if(report_date1_res >= 2016 && report_date2_res >=2016)
				{
					jQuery('#report_of_date1').css( "background", "white" );
					jQuery('#report_of_date2').css( "background", "white" );

					var report_click_btn=0;
					if(str=='View Report'){ report_click_btn = 1; }
					if(str=='Graph'){ report_click_btn = 2; }
					jQuery('#report_click_btn').val(report_click_btn);


					jQuery('#iss_2_001_report_details_form').submit();
				}
				else
				{
					alert("Please select Higher year date..");
				}

			}
			else
			{
				alert('First Select Date Of Report.');
				if(report_date1 != ''){jQuery('#report_of_date1').css( "background", "red" );}
				if(report_date2 != ''){jQuery('#report_of_date2').css( "background", "red" );}
			}
		  }
		  else
		  {
			var br_ao_do = 0;
			if(jQuery("input[name='iss_report_office_id']:checked").val()>0)
			{
				br_ao_do = jQuery("input[name='iss_report_office_id']:checked").val();
			}
			var br_ao_do_text = jQuery('#search_text').val();

			if(report_date1 !='' && report_date2 !='' && br_ao_do != 0)
			{
				jQuery('#report_of_date1').css( "background", "white" );
				jQuery('#report_of_date2').css( "background", "white" );

				var report_click_btn=0;
				if(str=='View Report'){report_click_btn=1;}
				if(str=='Graph'){ report_click_btn = 2; }
				jQuery('#report_click_btn').val(report_click_btn);



				jQuery('#iss_2_001_report_details_form').submit();
			}
			else
			{
				alert('First Fill The Search Form Properly.');

				if(report_date1 == ''){jQuery('#report_of_date1').css( "background", "red" );}
				else{jQuery('#report_of_date1').css( "background", "white" );}
				if(report_date2 == ''){jQuery('#report_of_date2').css( "background", "red" );}
				else{jQuery('#report_of_date2').css( "background", "white" );}
			}
		  }
	    }
	   else
	    {
			alert("Please Select Atleast one ISS Form-2 Item!!!!");
			jQuery('#report_of_iss2_item').css( "background", "red" );
	    }

    }
 }

 function check_fig_indication_iss2_data_cat(str)
{
    if(str !='')
    {
        var r = $("input[name='amt_fig']:checked").val();
		$("#fig_indication_post").val(r);

		$("#pdf_btn_inst").val(0);

        $('#iss_2_001_report_details_form').submit();
    }
}
function check_fig_indication_iss2_data_cat_pdf(str)
{
   if(str !='')
    {
		var report_pdf_btn = 0;
		if(str=='Save AS PDF')
		{
			report_pdf_btn = 1;
			jQuery('#pdf_btn_inst').val(report_pdf_btn);
			jQuery('#iss_2_001_report_details_form').submit();
		}
    }
}



 ///////////////////////ISS form-2 iss_2_0001 report end//////////////////
// Iss End here ////////////
