$(document).ready(function(){
   
  
 /* $("#btn_login1").click( 
  
    function(){
    
        var pfileno=$("#pfno").val();
       // var password=$("#password").val();
	   //http://172.17.21.105:81/mytest/index.php/ajaxpost/post_action_me
      //http://172.17.21.105:81/mytest/index.php/userinfo/test_uname
	  //http://172.17.21.105:81/mytest/index.php/userinfo/test_uname
        $.ajax({
        type: "POST",
        url: "http://203.76.102.169:8033/rpd/index.php/userinfo/post_action_me",
		//url: "http://localhost/rpd/index.php/userinfo/post_action_me",
        dataType: "json",
        data: "pfno="+pfileno,
        cache:false,
        success: 
          function(data){
            $("#form_message").html(data.message).css({'background-color' : data.bg_color}).fadeIn('slow'); 
          }
        
        });

      return false;

    });
  
  
   $("input#txt_p_file_no").focusin( 
  
    function(){
    
        var pfileno=$("#pfno").val();
       // var password=$("#password").val();
      
        $.ajax({
        type: "POST",
       url: "http://203.76.102.169:8033/rpd/index.php/userinfo/post_action_me",
		//url: "http://localhost/rpd/index.php/userinfo/post_action_me",
        dataType: "json",
        data: "pfno="+pfileno,
        cache:false,
        success: 
          function(data){
            $("#form_message").html(data.message).css({'background-color' : data.bg_color}).fadeIn('slow'); 
          }
        
        });

      return false;

    });

	  $("input#dat_entry_date").focusin(function (){
		 document.getElementById("dat_entry_date").value= today_dd_mm_yyyy(); 
		// alert("This is focus in event.");
       });
       //Lost focus when document is ready
       $("input#dat_entry_date").focusout(function (){
         //alert("This is focus out event");
       });
	   
	   // get User Full name
  	
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
	mytext= document.getElementsByName("amt[]");
	mytext1= document.getElementsByName("ac[]");
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


		
    }
 
 
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
    var ValidChars = "0123456789.";
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
		var datdate = jQuery('#datdate').val();
		if(datdate=='')
		{
			alert("Please select a date.");
		}
		else
		{
			if(confirm("Do you want to submit data for selected date: "+datdate))
			{
				jQuery('#id_omis_entry_form').submit();	
			}
		}
	}
	else
	{
	jQuery('#id_omis_entry_form').find('input[type="text"]').val(''); 
	}
 }
 
  //control_omis_form_edit_mode end
  
  
  
  
  //COM & GRAPH start by zakariya
  function control_omis_com_graph_form(ptr)
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
 
 function check_search_form_omis_com_graph(str)
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
            if(str=='Comparison'){report_click_btn=1;}
            if(str=='Graph'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#omis_search_form').submit();
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
        if(jQuery("input[name='omis_com_graph_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='omis_com_graph_office_id']:checked").val();
        }
        var report_date1=jQuery('#report_of_date1').val();
        var report_date2=jQuery('#report_of_date2').val();
        var br_ao_do_text=jQuery('#search_text').val();
        if(br_ao_do !='0' && report_date1 !='' && report_date2 !='' && br_ao_do_text !='' && report_date1 != report_date2)
        {
            var report_click_btn=0;
            if(str=='Comparison'){report_click_btn=1;}
            if(str=='Graph'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#omis_search_form').submit();
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
   
     