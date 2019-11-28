<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Display Page</title>
</head>
 <body>
 <br />
 <?php echo base_url().'index.php/designation/get_all_desig';?>
 <form>
 <button type="button" name="getdata" id="getdata">Get Data.</button>
 </form>
  <div id="result_table"> </div> 
  
  <script type="text/javascript" language="javascript">
  	
	$('#getdata').click(function()
  	{    
		 $.ajax({            
		 	url: "<?php echo base_url().'index.php/designation/get_all_desig';?>",            
			type:'POST',            
			dataType: 'json',            
			success: function(output_string)
			{                    
				$("#result_table").append(output_string); 
			} 
			// End of success function of ajax form            
			});
			 // End of ajax call  
			 });
			
</script>
            </body>
            </html>