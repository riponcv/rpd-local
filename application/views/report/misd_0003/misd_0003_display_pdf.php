<style type="text/css">
html { 
margin-left: 15px;
margin-bottom: 5px;
}
</style>
<style>
table#t1 td{margin:0;padding:0;border:1px solid #D2D2D2;spadding:0px;}
table#t1 th{margin:0;padding:0;border:1px solid #D2D2D2;padding:0px;}
</style>

<table align="center">
  <tr>
    <td align="center" style="font-size:18px;">PL Statement</td>
  </tr>
  <tr>
  <?php $month_array=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'); ?>
    <td align="center" >For the Month of <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?$report_of_year:'';?> </td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
  </tr>
  <tr>
    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
  </tr>
</table>
<?php
if(isset($result_array) && !empty($result_array))
{
?>
<table border="1" align="right" style="border: thin;margin-top: -90px;border-collapse:collapse;" id="t1">
  <tr>
    <td width="65">Report</td>
    <td width="140"><?php echo isset($report_details->report_id)?$report_details->report_id:''; ?></td>
  </tr>
  <tr>
    <td width="65">Printing Date </td>
    <td width="140"><?php echo date('d/m/y'); ?></td>
  </tr>
  <tr>
    <td width="65">Source </td>
    <td width="140">MISD RPD JBL HO Dhaka</td>
  </tr>
</table>
<br/>
<table style="margin-left: 878px;"><tr><td>Amount in Crore</td></tr></table>
<table border="1" style="border-collapse:collapse;" id="t1">
	<tr>
		<td rowspan="2" align="center" width="10" style="font-size:22px">SL</td>		
<td rowspan="2" align="center" width="200" style="font-size:22px"><?php echo isset($list_title)?$list_title:'Office'; ?></td>
		<td colspan="6" align="center" style="font-size:22px">Income</td>
		<td colspan="6" align="center" style="font-size:22px">Expenditure</td>
		<td rowspan="2" align="center" style="font-size:22px">Operating Profit</td>
	</tr>
	<tr>
		<td align="center">Interest Received from Loans & Advances</td>
		<td align="center">Commission</td>
		<td align="center">Exchange & Brokerage</td>
		<td align="center">Investment</td>
		<td align="center">Others</td>
		<td align="center">Total</td>
		<td align="center">Interest Paid on Deposit</td>
		<td align="center">Interest Paid on Borrowing</td>
		<td align="center">Salary & Allownaces</td>
		<td align="center">Rent, Taxes, Insurance etc.</td>
		<td align="center">Others</td>
		<td align="center">Total</td>
		</tr>
        <?php 
        //total calculation
        $int_rec_l_a=0;
        $com=0;
        $ex_bro=0;
        $invest=0;
        $in_other=0;
        $in_total=0;
        
        $int_paid_dep=0;
        $int_paid_borr=0;
        $sal_allow=0;
        $rent_tax_insu=0;
        $ex_other=0;
        $ex_total=0;
        
        $profit=0;
        ?>
        <?php foreach($result_array as $key=>$row) { ?>
		<tr>
        <?php 
        //total calculation
        $int_rec_l_a=$int_rec_l_a+$row['report_val']['income']['int_rec_l_a'];
        $com=$com+$row['report_val']['income']['com'];;
        $ex_bro=$ex_bro+$row['report_val']['income']['ex_bro'];;
        $invest=$invest+$row['report_val']['income']['invest'];;
        $in_other=$in_other+$row['report_val']['income']['other'];;
        $in_total=$in_total+$row['report_val']['income']['total'];;
        
        $int_paid_dep=$int_paid_dep+$row['report_val']['expenditure']['int_paid_dep'];;
        $int_paid_borr=$int_paid_borr+$row['report_val']['expenditure']['int_paid_borr'];;
        $sal_allow=$sal_allow+$row['report_val']['expenditure']['sal_allow'];;
        $rent_tax_insu=$rent_tax_insu+$row['report_val']['expenditure']['rent_tax_insu'];;
        $ex_other=$ex_other+$row['report_val']['expenditure']['other'];;
        $ex_total=$ex_total+$row['report_val']['expenditure']['total'];;
        
        $profit=$profit+$row['report_val']['profit'];
        
        ?>
		<td align="center"><?php echo ($key+1); ?></td>			
<td align="left"><?php echo isset($row['office_name'])?$row['office_name']:''; ?></td>
		<td align="right"><?php echo isset($row['report_val']['income']['int_rec_l_a'])?round($row['report_val']['income']['int_rec_l_a'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['income']['com'])?round($row['report_val']['income']['com'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['income']['ex_bro'])?round($row['report_val']['income']['ex_bro'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['income']['invest'])?round($row['report_val']['income']['invest'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['income']['other'])?round($row['report_val']['income']['other'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['income']['total'])?round($row['report_val']['income']['total'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['expenditure']['int_paid_dep'])?round($row['report_val']['expenditure']['int_paid_dep'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['expenditure']['int_paid_borr'])?round($row['report_val']['expenditure']['int_paid_borr'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['expenditure']['sal_allow'])?round($row['report_val']['expenditure']['sal_allow'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['expenditure']['rent_tax_insu'])?round($row['report_val']['expenditure']['rent_tax_insu'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['expenditure']['other'])?round($row['report_val']['expenditure']['other'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['expenditure']['total'])?round($row['report_val']['expenditure']['total'],2):'-'; ?></td>
		<td align="right"><?php echo isset($row['report_val']['profit'])?round($row['report_val']['profit'],2):'-'; ?></td>
		</tr>
        <?php } ?>
        
        <tr style="font-weight: bold;">
    		<td align="left" colspan="2">Total</td>
    		<td align="right"><?php echo round($int_rec_l_a,2); ?></td>
    		<td align="right"><?php echo round($com,2); ?></td>
    		<td align="right"><?php echo round($ex_bro,2); ?></td>
    		<td align="right"><?php echo round($invest,2); ?></td>
    		<td align="right"><?php echo round($in_other,2); ?></td>
    		<td align="right"><?php echo round($in_total,2); ?></td>
    		<td align="right"><?php echo round($int_paid_dep,2); ?></td>
    		<td align="right"><?php echo round($int_paid_borr,2); ?></td>
    		<td align="right"><?php echo round($sal_allow,2); ?></td>
    		<td align="right"><?php echo round($rent_tax_insu,2); ?></td>
    		<td align="right"><?php echo round($ex_other,2); ?></td>
    		<td align="right"><?php echo round($ex_total,2); ?></td>
    		<td align="right"><?php echo round($profit,2); ?></td>
        </tr>
        
        

</table>
<br/>
<?php 
}
?>