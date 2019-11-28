<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pdf Download</title>
</head>
<body>
<p>
    <table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">View Another Report</a></th></tr>
    </table><br/><br/>  
<!--First Title of Report-->
<table>
<?php 
$iss_cer = $this->session->userdata('certified');
/*Further Edit here start*/
$cc=0;
$dd=0;
$cer_datapol = array();
		
if(isset($certificate_data) && count($certificate_data)>0)
{
	if (is_array($certificate_data) || is_object($certificate_data))
	{
		foreach ($certificate_data as $cer_data)
		{
			$cer_datapol[$cc++] = $cer_data->certified_br_ar_div_code;
		}
	}
}

$top_cer =0;
if($login_office_status==3)
{
	foreach($cer_area_list as $row_are)
	{
		if($report_office_code==$row_are->certified_br_ar_div_code)
		{
			$top_cer =1;
		}
	}
}

if($login_office_status==2)
{
	foreach($cer_division_list as $row_test)
	{
		if($report_office_code==$row_test->certified_br_ar_div_code)
		{
			$top_cer =1;
		}
	}
}
if($login_office_status==1){ if($iss_cer==1){$top_cer =1;}}

//echo "<pre>";
//print_r($result_array);
//die();
/*Further Edit here start*/
if($top_cer==1){ ?>
<tr><th style="font-size: larger;">ISS Report</th> </tr>
<?php } else {
	if($top_cer==0) { ?>
<tr><th style="font-size: larger;">ISS Report</th> </tr>		
	<?php } } ?>

<tr><th><?php echo $report_of_office; ?></th></tr>
<tr><th>Report of : <?php echo isset($report_of_date)?$report_of_date:''; ?></th></tr>
<?php
if(isset($login_office_status)&&$login_office_status !=1)
{	
?>
<?php if(isset($count_all) && $count_all>1){ ?><tr align="center"><th><?php echo isset($sign)?$sign:'Count'; ?>: <?php echo isset($count_missing_completed)?$count_missing_completed:'0'; echo '/'; echo isset($count_all)?$count_all:'0'; ?></th></tr><?php } ?>
<?php if(isset($cer_completed_vs_total['total']) && $cer_completed_vs_total['total']>1){ ?><tr align="center"><th>
Certificate Reporting: <?php echo isset($cer_completed_vs_total['completed'])?$cer_completed_vs_total['completed']:'0'; echo '/'; echo isset($cer_completed_vs_total['total'])?$cer_completed_vs_total['total']:'0'; ?></th></tr><?php } ?>
<?php } ?>
<?php
if(isset($login_office_status)&&$login_office_status ==1)
{	
?>
<?php if(isset($count_all) && $count_all>1){ ?>
<tr align="center"><th><?php echo isset($sign)?$sign:'Count'; ?>: <?php $comp_count=0;foreach($result_array as $row_comp){if($row_comp->status==1){$comp_count++;}else{$comp_count++;}} echo isset($comp_count)?$comp_count:'0';echo '/'; echo isset($count_all)?$count_all:'0'; ?></th></tr>
<tr align="center"><th>Certificate Reporting: <?php $comp_cer=0; foreach($result_array as $row_comp){if($row_comp->is_certificate==1){$comp_cer++;}} echo isset($comp_cer)?$comp_cer:'0';echo '/';echo isset($comp_count)?$comp_count:'0';?></th></tr>
<?php  } ?>

<?php } ?>
<?php 

$style='';
$text='';
if(isset($report_click_btn) && $report_click_btn==2)
{
    $style='style="background-color: red;"';
    $text='Missing Branch List';
}
if(isset($report_click_btn) && $report_click_btn==3)
{
    $style='style="background-color: green;"';
    $text='Completed Branch List';
}
?>
<tr <?php echo $style; ?>><th><?php echo $text; ?></th></tr>
</table>

<!--End of Title-->
<?php
 
    if(isset($result_array) && count($result_array)>0)
    {
        echo "<table border=\"1\" align=\"center\">"; 	
        echo "<tr>";
    	echo "<td align='center' style='background-color:olive'>"."<strong>"."Serial No"."<strong>"."</td>";
		?>
		<td style='background-color:olive'>
			<table >
				<tbody>
					<tr><td align='center' style='background-color:olive;font-weight:bold'>Division</td></tr>
					<tr><td align='center' style='background-color:olive;font-size:9px;font-weight:bold'>Certificate status</td></tr>
				</tbody>
			</table>
		</td>
		<td style='background-color:olive'>
			<table >
				<tbody>
					<tr><td align='center' style='background-color:olive;font-weight:bold'>Area</td></tr>
					<tr><td align='center' style='background-color:olive;font-size:9px;font-weight:bold'>Certificate status</td></tr>
				</tbody>
			</table>
		</td>
		<td align='center' style='background-color:olive'>
			<table >
				<tbody>
					<tr><td  style='font-weight:bold;'>Branch</td></tr>
					<tr><td  style='font-size:9px;font-weight:bold'>Certificate status</td></tr>
				</tbody>
			</table>
		</td>
		<?php
        echo "<td align='center' style='background-color:olive'>"."<strong>"."Branch Code (BB)"."<strong>"."</td>";
        echo "<td align='center' style='width:80px;background-color:olive'>"."<strong>"."Office Phone"."<strong>"."</td>";
		
		if(isset($status) && $status == 1)
		{
			echo "<td align='center' style='background-color:olive; width:220px' colspan='2' >"."<strong>"."Action"."<strong>"."</td>";
		}
    	echo "</tr>";
        $count=1;
		
		//$is_div_code=0;
        foreach($result_array as $row)
        {
				if(isset($login_office_status)&&$login_office_status!=1)
				{
					$bbbcode6 ='12'.$row['bbbrcode'];
					$area_cer=0;$div_cer=0;
					if(isset($status) && $status == 1)
						{
							if(in_array($bbbcode6,$cer_datapol))
							{
								if($row['gradecode']==1 || $row['gradecode']==7 || $row['gradecode']==8){$area_cer=1;}
								else {$area_cer=0;}	
								if($row['gradecode']==7 || $row['gradecode']==8){$div_cer=1;}
								else {$div_cer=0;}		
							}
					}
				}		
					
				if(isset($login_office_status)&&$login_office_status==1)
				{
					$bbbcode6 ='12'.$row->bbbrcode;
					$area_cer=0;$div_cer=0;
					
						{
							if(in_array($bbbcode6,$cer_datapol))
							{
								if($row->gradecode==1 || $row->gradecode==7 || $row->gradecode==8){$area_cer=1;}
								else {$area_cer=0;}	
								if($row->gradecode==7 || $row->gradecode==8){$div_cer=1;}
								else {$div_cer=0;}		
							}
					}
				}
					
				
				//echo $area_cer;
			echo "<tr>";
        	echo "<td align='center'>"."<strong>".$count."<strong>"."</td>";
			?>
			<td>
				<table >
					<tbody>
						<?php if(isset($login_office_status)&&$login_office_status==1){ ?>
							<tr><td align='' style='font-weight:bold'><?php echo $row->dvname;?></td></tr>
							<?php 
							$is_div_code=0;
							foreach($cer_division_list as $row_div)
							{
								if($row->jbdvcode==$row_div->certified_br_ar_div_code)
								{ $is_div_code=1; }
								
							}
							if($row->gradecode==7 || $row->gradecode==8)
							{
								if(isset($div_cer)&& $div_cer==1)
								{
									?>
									<tr><td align='center' style='color:green;font-size:11px;font-weight:bold'>Certified</td></tr>
									<?php
								}
								else
								{
									?>
										<tr><td align='center' style='color:red;font-size:11px;font-weight:bold'>Not Certified</td></tr>
									<?php
								}
							}
							else
							{
								if($is_div_code==1) { ?>
								<tr><td align='center' style='color:green;font-size:11px;font-weight:bold'>Certified</td></tr>
								<?php } 
							   else 
								{  
								?>
								<tr><td align='center' style='color:red;font-size:11px;font-weight:bold'>Not Certified</td></tr>
								<?php } ?>
							<?php } ?>
						<?php } ?>
						<?php if(isset($login_office_status)&&$login_office_status!=1){ ?>
							<tr><td align='' style='font-weight:bold'><?php echo $row['dvname'];?></td></tr>
							<?php 
							$is_div_code=0;
							foreach($cer_division_list as $row_div)
							{
								if($row['jbdvcode']==$row_div->certified_br_ar_div_code)
								{ $is_div_code=1; }
								
							}
							if($row['gradecode']==7 || $row['gradecode']==8)
							{
								if(isset($div_cer)&& $div_cer==1)
								{
									?>
									<tr><td align='center' style='color:green;font-size:11px;font-weight:bold'>Certified</td></tr>
									<?php
								}
								else
								{
									?>
										<tr><td align='center' style='color:red;font-size:11px;font-weight:bold'>Not Certified</td></tr>
									<?php
								}
							}
							else
							{
								if($is_div_code==1) { ?>
								<tr><td align='center' style='color:green;font-size:11px;font-weight:bold'>Certified</td></tr>
								<?php } 
							   else 
								{  
								?>
								<tr><td align='center' style='color:red;font-size:11px;font-weight:bold'>Not Certified</td></tr>
								<?php } ?>
							<?php } ?>
						<?php } ?>
						
						
				
					</tbody>
				</table>
			</td>
            <td>
				<table >
					<tbody>
						<?php if(isset($login_office_status)&&$login_office_status==1){ ?>
								<tr><td align='' style='font-weight:bold'><?php echo $row->znname;?></td></tr>
						<?php 
							$is_area_code=0;
							foreach($cer_area_list as $row_area)
							{
								if($row->zncode==$row_area->certified_br_ar_div_code)
								{
									$is_area_code=1; 
						
								}
							}
						
						if($row->gradecode==1 || $row->gradecode==7 || $row->gradecode==8)
						{
							if(isset($area_cer)&& $area_cer==1)
							{
								?>
								<tr><td align='center' style='color:green;font-size:11px;font-weight:bold'>Certified</td></tr>
								<?php
							}
							else
							{
								?>
									<tr><td align='center' style='color:red;font-size:11px;font-weight:bold'>Not Certified</td></tr>
								<?php
							}
						}
						else
						{ 
							if(isset($is_area_code)&&$is_area_code==1) { 
							?>
							<tr><td align='center' style='color:green;font-size:11px;font-weight:bold'>Certified</td></tr>
							<?php } 
							else { ?>
							<tr><td align='center' style='color:red;font-size:11px;font-weight:bold'>Not Certified</td></tr>
						<?php	
							}
						}
						?>
						<?php } ?>
						
						<?php if(isset($login_office_status)&&$login_office_status!=1){ ?>
								<tr><td align='' style='font-weight:bold'><?php echo $row['znname'];?></td></tr>
						<?php 
							$is_area_code=0;
							foreach($cer_area_list as $row_area)
							{
								if($row['zncode']==$row_area->certified_br_ar_div_code)
								{
									$is_area_code=1; 
						
								}
							}
						
						if($row['gradecode']==1 || $row['gradecode']==7 || $row['gradecode']==8)
						{
							if(isset($area_cer)&& $area_cer==1)
							{
								?>
								<tr><td align='center' style='color:green;font-size:11px;font-weight:bold'>Certified</td></tr>
								<?php
							}
							else
							{
								?>
									<tr><td align='center' style='color:red;font-size:11px;font-weight:bold'>Not Certified</td></tr>
								<?php
							}
						}
						else
						{ 
							if(isset($is_area_code)&&$is_area_code==1) { 
							?>
							<tr><td align='center' style='color:green;font-size:11px;font-weight:bold'>Certified</td></tr>
							<?php } 
							else { ?>
							<tr><td align='center' style='color:red;font-size:11px;font-weight:bold'>Not Certified</td></tr>
						<?php	
							}
						}
						?>
											
						<?php } ?>
						
					</tbody>
				</table>
			</td>
			<td>
				<table >
					<tbody>
						<?php if(isset($login_office_status)&&$login_office_status!=1){
							?>	<tr><td align='center' style='font-weight:bold'><?php echo $row['branchname']."(".$row['brcode'].")";?></td></tr>
						<?php } ?>
						
						<?php if(isset($login_office_status)&&$login_office_status==1){
							?>	<tr><td align='center' style='font-weight:bold'><?php echo $row->branchname."(".$row->brcode.")";?></td></tr>
						<?php } ?>
						
						
						<?php 
							if(isset($login_office_status)&&$login_office_status!=1)
							{
								$bbbcode6 ='12'.$row['bbbrcode'];
								if(isset($status) && $status == 1)
								{
									if(in_array($bbbcode6,$cer_datapol))
									{ ?>
										<tr style='color:green;font-size:11px;font-weight:bold'><td align='center' >Certified</td></tr>
									<?php
									}
									else
									{
										?>
										<tr><td align='center' style='color:red;font-size:11px;font-weight:bold'>Not Certified</td></tr>
										<?php	
									}
								}
							}
							if(isset($login_office_status)&&$login_office_status==1)
							{
								if(isset($row->is_certificate)&&$row->is_certificate==1)
								{
									?>
										<tr style='color:green;font-size:11px;font-weight:bold'><td align='center' >Certified</td></tr>
									<?php
								}
								else
								{
									?>
										<tr><td align='center' style='color:red;font-size:11px;font-weight:bold'>Not Certified</td></tr>
										<?php	
								}
							}			
			?>
					</tbody>
				</table>
			</td>			
			<?php
        	
			if(isset($login_office_status)&&$login_office_status==1)
			{
				echo "<td align='left'>"."<strong>".$row->bbbrcode."<strong>"."</td>";
				echo "<td align='left'>"."<strong>".$row->OfficePhone."<strong>"."</td>";
				$bbbcode6 ='12'.$row->bbbrcode;
				if(isset($status) && $status == 1)
				{
					if(in_array($bbbcode6,$cer_datapol))
					{
						//echo "<td align='left' style='color:green;'>"."<strong>"."Certified"."<strong>"."</td>";
					}
					else
					{
						//echo "<td align='left'  style='color:Red;'>"."<strong>"."Not Certified"."<strong>"."</td>";
					}
					?><td><input type='button' name='view_report' value='View Report' class="test_width" onclick="check_individual_report('<?php echo "1#".$row->brcode;?>')"/> || <input type='button' name='save_as_pdf' value='Save As PDF' onclick="check_individual_report('<?php echo "2#".$row->brcode;?>')"/></td><?php	
				}
			}
			if(isset($login_office_status)&&$login_office_status!=1)
			{
				echo "<td align='left'>"."<strong>".$row['bbbrcode']."<strong>"."</td>";
				echo "<td align='left'>"."<strong>".$row['OfficePhone']."<strong>"."</td>";
				$bbbcode6 ='12'.$row['bbbrcode'];
				if(isset($status) && $status == 1)
				{
					if(in_array($bbbcode6,$cer_datapol))
					{
						//echo "<td align='left' style='color:green;'>"."<strong>"."Certified"."<strong>"."</td>";
					}
					else
					{
						//echo "<td align='left'  style='color:Red;'>"."<strong>"."Not Certified"."<strong>"."</td>";
					}
					?><td><input type='button' name='view_report' value='View Report' class="test_width" onclick="check_individual_report('<?php echo "1#".$row['brcode'];?>')"/> || <input type='button' name='save_as_pdf' value='Save As PDF' onclick="check_individual_report('<?php echo "2#".$row['brcode'];?>')"/></td><?php	
				}
			}
			
        	echo "</tr>";
            $count++;
        }
		
		echo form_open('iss/iss_report_details','id="iss_option"');
		?>
		<input type="hidden" name="report_of_date" value="<?php echo isset($report_of_date)?$report_of_date:''; ?>"/>
		<input type="hidden" name="report_option_selector" value="2"/>
		<input type="hidden" name="report_click_btn" value="1"/>
		<input type="hidden" name="iss_report_office_id" id="iss_report_office_id" value=""/>
		<?php
		echo form_close();
         
       	echo "<tr>";
        $attribute='style="background-color: #FF9900;"';
    	echo "</tr>";
    	
    	echo "</table>";
          
    }
    
    else
    {
        echo "<table border=\"1\" align=\"center\">"; 	
        echo "<tr>";
        if(isset($report_click_btn) && $report_click_btn==2)
        {
            echo "<td align='center' style='background-color:green'>"."<strong>All branch have submitted data successfully.<strong>"."</td>";
        }
        if(isset($report_click_btn) && $report_click_btn==3)
        {
            echo "<td align='center' style='background-color:red'>"."<strong>Any single branch have not submitted data yet.<strong>"."</td>";     
        }
        echo "</tr>";
    	echo "</table>"; 
    }
?>
</body>
</html>

