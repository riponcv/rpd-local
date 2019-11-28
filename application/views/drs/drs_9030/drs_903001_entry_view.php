<style>
#recove_1 {
    background-color: #e9eaed;
}
#recove_1 input[type="text"], #recove_1 input[type="number"], 
#recove_1 input[type="date"]{
    height: 30px;
    font-size: 20px;
    border: 0;
}
#recove_1 textarea{
    width: 98%;
    font-size: 20px;
}
.seventy_px {
    height: 70px;
}

#recove_1 td, #recove_1 th {
    border-bottom: 2px solid #ddd;
    font-size: 20px;
}
#recove_1, span {
  font-size: 18px;
  font-weight: 300;
}
::-webkit-input-placeholder {
  color: #000;
  font-size: 16px;
}
::-moz-placeholder {
  color: #000;
  font-size: 16px;
}
:-ms-input-placeholder {
  color: #000;
  font-size: 16px;
}
::placeholder {
  color: #000;
  font-size: 16px;
}

#rec1_output tr td {
  border: 1px solid #4e4b4b;
}
#scrolly{
    width: 120%;
    height: 100%;
    overflow: auto;
    /*overflow-y: hidden;*/
    margin: 0 auto;
}

.drs_9030_css_0102 {  text-align: left;}
.drs_9030_css_0102 ul{margin:0; padding:0;list-style:none;}
.drs_9030_css_0102 li{display:inline-block; margin-right:10px; padding:5px;}
.drs_9030_css_0102 li a{text-decoration:none; text-transform:uppercase; transition:.3s}
.drs_9030_css_0102 li a:hover{background-color:#93c041; color:#333; padding:5px}

</style>


<?php echo form_open('drs/drs_903001_data_save_ctrler', 'class="" id="drs_903001_entry_id"'); ?>
    <div class="drs_9030_css_0102">
        <ul>
            <li><?php echo anchor('drs/drs_903001_entry_ctrler', 'Defaulter Input', array('title' => 'Top-300 Defaulters according to outstanding amount'));
    ?></li>
    <li><?php echo anchor('drs/drs_90300102_report_ctrler', 'Defaulter Report', array('title' => 'Written-off Loan related entry form'));
    ?></li>
        </ul>
    </div>
    <?php 
        if($login_office_status == 4) {
    ?>
    <table  align="right">
        <tr align="center"><th><a href="javascript:history.back();">Back</a></th></tr>
    </table>

    <p>Input Template</p>
   
    <table>
		<tr>
			<td>Report Of Date</td>

			<td>
			<?php
				echo '<select name="report_of_date" id="report_of_date" style="height:35px;font-size:18px">';
				echo '<option value="">Select Date</option>';
				foreach($records3 as $row)
				{
					$select='';
					if(isset($_POST['report_of_date']) && $_POST['report_of_date']==$row->ISSEntryDate)
					{
						$select="selected='selected'";
					}
				  echo '<option value="'.$row->ISSEntryDate.'" '.$select.'>'.$row->ISSEntryDate.'</option>';

				}
				echo '</select>';
				?>
			</td>
		</tr>
	 </table>

<table id="recove_1">
    <tr>
        <td rowspan="2">1</td>
        <td colspan="2"><label for="drs_903001_item_1_1">i. Name of the Borrower(Individual/Group) </label></td>
        <td colspan="2"><input type="text" name="drs_903001_1_1" id="drs_903001_item_1_1" class="" placeholder="Name of the Borrower(Individual/Group)"></td>
    </tr>
    <tr>
      
        <td colspan="2"><label for="drs_903001_item_1_2">ii. Group Code </label></td>
        <td colspan="2"><input type="text" name="drs_903001_1_2" id="drs_903001_item_1_2" class="" placeholder="Group Code"></td>
    </tr>
    <tr>
        <td rowspan="4">2</td>
        <td colspan="2"><label for="drs_903001_item_2_1">i. Name of Proprietor/Director </label></td>
        <td colspan="2"><input type="text" name="drs_903001_2_1" id="drs_903001_item_2_1" class="" placeholder="Name of Proprietor/Director"></td>
    </tr>
    <tr>
        <td colspan="2"><label for="drs_903001_item_2_2">ii. Present Address </label></td>
        <td colspan="2"><textarea name="drs_903001_2_2" id="drs_903001_item_2_2" rows="2" placeholder="Present Address"></textarea></td>
    </tr>
    <tr>
        <td colspan="2"><label for="drs_903001_item_2_3">ii. Permanent Address </label></td>
        <td colspan="2"><textarea name="drs_903001_2_3" id="drs_903001_item_2_3" rows="2" placeholder="Permanent Address"></textarea></td>
    </tr>
    <tr>
        <td colspan="2"><label for="drs_903001_item_2_4">iv. Mobile No. </label></td>
        <td colspan=""><input type="text" name="drs_903001_2_4" id="drs_903001_item_2_4" class="" placeholder="Mobile No."></td>
    </tr>
    <tr>
        <td><span>3</span></td>
        <td><label for="drs_903001_item_3">Nature of Loan </label></td>
        <td colspan="3"><input type="text" name="drs_90300103" id="drs_903001_item_3" class="" placeholder="Nature of Loan"></td>
    </tr>
    <tr>
        <td><span>4</span></td>
        <td><label for="drs_903001_item_4">Limit </label></td>
        <td colspan="3"><input type="number" name="drs_90300104" id="drs_903001_item_4" class="" step="0.01" placeholder="Limit"></td>
    </tr>
    <tr>
        <td><span>5</span></td>
        <td><label for="drs_903001_item_5">Sanctioned Amount</label></td>
        <td colspan="3"><input type="number" name="drs_90300105" id="drs_903001_item_5" class="" step="0.01" placeholder="Sanctioned Amount"></td>
    </tr>

    <tr>
        <td><span>6</span></td>
        <td colspan="3"><label for="drs_903001_item_6">Date of last Sanctioned/Rescheduled/Restructuted</label></td>
        <td><input type="date" name="drs_90300106" id="drs_903001_item_6" class="" placeholder="Date of last Sanctioned/Rescheduled/Restructuted"> <span style="font-size:12px">(DD/MM/YYYY)</span></td>
    </tr>
    <tr>
        <td><span>7</span></td>
        <td><label for="drs_903001_item_7">Name of the Sector</label></td>
        <td colspan="3"><input type="text" name="drs_90300107" id="drs_903001_item_7" class="" placeholder="Name of the Sector"></td>
    </tr>
    <tr>
        <td><span>8</span></td>
        <td><label for="drs_903001_item_8">Amount Outstanding</label></td>
        <td colspan="3"><input type="number" name="drs_90300108" id="drs_903001_item_8" class="" step="0.01" placeholder="Amount Outstanding"></td>
    </tr>
    <tr>
        <td><span>9</span></td>
        <td><label for="drs_903001_item_9">Classification Status</label></td>
        <td colspan="3"><input type="text" name="drs_90300109" id="drs_903001_item_9" class="" placeholder="Classification Status"></td>
    </tr>

    <tr>
        <td><span>10</span></td>
        <td><label for="drs_903001_item_10">Amount in Interest suspense</label></td>
        <td colspan="3"><input type="number" name="drs_90300110" id="drs_903001_item_10" class="" step="0.01" placeholder="Amount in Interest suspense"></td>
    </tr>

    <tr>
        <td><span>11</span></td>
        <td><label for="drs_903001_item_11">Provision maintained</label></td>
        <td colspan="3"><input type="number" name="drs_90300111" id="drs_903001_item_11" class="" step="0.01" placeholder="Provision maintained"></td>
    </tr>

    <tr>
        <td><span>12</span></td>
        <td><label for="drs_903001_item_12">Forced sale of collateral</label></td>
        <td colspan="3"><input type="number" name="drs_90300112" step="0.01" id="drs_903001_item_12" class="" placeholder="Forced sale of collateral"></td>
    </tr>

    <tr>
        <td><span>13</span></td>
        <td rowspan="6"><label for="">Recovery Amount</label></td>
        <td rowspan="2"><label for="drs_903001_item_13">Cumulative recovery (upto the reporting period)</label></td>
        <td><label for="drs_903001_item_13">Cash</label></td>
        <td><input type="number" name="drs_90300113" id="drs_903001_item_13" class="" step="0.01" placeholder="Recovery Amount (cash)"></td>
    </tr>

    <tr>
        <td><span>14</span></td>
        <td><label for="drs_903001_item_14">Others</label></td>
        <td><input type="number" name="drs_90300114" id="drs_903001_item_14" class="" step="0.01" placeholder="Recovery Amount (Others)"></td>
    </tr>

    <tr>
        <td><span>15</span></td>
        <td rowspan="2"><label for="drs_903001_item_15">Previous Month</label></td>
        <td><label for="drs_903001_item_15">Cash</label></td>
        <td><input type="number" name="drs_90300115" id="drs_903001_item_15" class="" step="0.01" placeholder="Previous Month (Cash)"></td>
    </tr>

    <tr>
        <td><span>16</span></td>
        <td><label for="drs_903001_item_16">Others</label></td>
        <td><input type="number" name="drs_90300116" id="drs_903001_item_16"  class="" step="0.01" placeholder="Previous Month (Others)"></td>
    </tr>

    <tr>
        <td><span>17</span></td>
        <td rowspan="2"><label for="drs_903001_item_17">Current Month</label></td>
        <td><label for="drs_903001_item_17">Cash</label></td>
        <td><input type="number" name="drs_90300117" id="drs_903001_item_17" class="" step="0.01" placeholder="Previous Month Current Month (Cash)"></td>
    </tr>

    <tr>
        <td><span>18</span></td>
        <td><label for="drs_903001_item_18">Others</label></td>
        <td><input type="number" name="drs_90300118" id="drs_903001_item_18" class="" step="0.01" placeholder="Previous Month Current Month (Others)"></td>
    </tr>

    <tr>
        <td><span>19</span></td>
        <td rowspan="2"><label for="">Court case Filed</label></td>
        <td><label for="drs_903001_item_19">No. of cases</label></td>
        <td colspan="2"><input type="number" name="drs_90300119" id="drs_903001_item_19" class="" placeholder="Court case Filed (No. of cases)"></td>
    </tr>
    <tr>
        <td><span>20</span></td>
        <td><label for="drs_903001_item_20">Amount of involved</label></td>
        <td colspan="2"><input type="number" name="drs_90300120" id="drs_903001_item_20" class="" step="0.01" placeholder="Court case Filed (Amount)"></td>
    </tr>

    <tr>
        <td><span>21</span></td>
        <td rowspan="2"><label for="">Court case Disposed of</label></td>
        <td colspan="2"><label for="drs_903001_item_21">No. of cases</label></td>
        <td><input type="number" name="drs_90300121" id="drs_903001_item_21" class="" placeholder="Court case Disposed o (No. of cases)"></td>
    </tr>
    <tr>
        <td><span>22</span></td>
        <td colspan="2"><label for="drs_903001_item_22">Amount of involved</label></td>
        <td><input type="number" name="drs_90300122" id="drs_903001_item_22" class="" step="0.01" placeholder="Court case Disposed o (Amount)"></td>
    </tr>
    <tr>
        <td><span>23</span></td>
        <td><label for="drs_903001_item_23">If target of recovery not achieved, reason for the same</label></td>
        <td colspan="3"><textarea  name="drs_90300123" id="drs_903001_item_23" class="seventy_px" placeholder="If target of recovery not achieved, reason for the same"></textarea></td>
    </tr>
    <tr>
        <td><span>24</span></td>
        <td><label for="drs_903001_item_24">Action taken for Recovery</label></td>
        <td colspan="3"><textarea name="drs_90300124" id="drs_903001_item_24" class="seventy_px" placeholder="Action taken for Recovery"></textarea></td>
    </tr>
    <tr>
        <td><span>25</span></td>
        <td colspan="2"><label for="drs_903001_item_25">Description of suit(name of the suit conducting law year, latest position of suit)</label></td>
        <td colspan="2"><textarea name="drs_90300125" id="drs_903001_item_25" class="seventy_px" placeholder="Description of suit(name of the suit conducting law year, latest position of suit)"></textarea></td>
    </tr>
    <tr>
        <td><span>26</span></td>
        <td rowspan="2" colspan="2"><label for="drs_903001_item_26">Security</label></td>
        <td><label for="drs_903001_item_26">Pimary</label></td>
        <td><input type="number" name="drs_90300126" class="" id="drs_903001_item_26" placeholder="Security(Pimary)"></td>
    </tr>
    <tr>
        <td><span>27</span></td>
        <td><label for="drs_903001_item_27">Collateral</label></td>
        <td><input type="number" name="drs_90300127" id="drs_903001_item_27" class="" placeholder="Security(Collateral)"></td>
    </tr>
    <tr>
        <td><span>28</span></td>
        <td><label for="drs_903001_item_28">Description of Writ</label></td>
        <td colspan="3"><textarea  name="drs_90300128" id="drs_903001_item_28" class="seventy_px" placeholder="Description of Writ"></textarea></td>
    </tr>
    <tr>
        <td><span>29</span></td>
        <td rowspan="3" colspan="2"><label for="drs_903001_item_29">Amount of classified loan</label></td>
        <td><label for="drs_903001_item_29">SS</label></td>
        <td><input type="number" name="drs_90300129" id="drs_903001_item_29" class="" step="0.01" placeholder="Amount of classified loan(SS)" onKeyUp="drs903001_auto_sum_function()"></td>
    </tr>
    <tr>
        <td><span>30</span></td>
        <td><label for="drs_903001_item_30">DF</label></td>
        <td><input type="number" name="drs_90300130" id="drs_903001_item_30" class="" step="0.01" placeholder="Amount of classified loan(DF)" onKeyUp="drs903001_auto_sum_function()"></td>
    </tr>
    <tr>
        <td><span>31</span></td>
        <td><label for="drs_903001_item_31">BL</label></td>
        <td><input type="number" name="drs_90300131" id="drs_903001_item_31" class="" step="0.01" placeholder="Amount of classified loan(BL)" onKeyUp="drs903001_auto_sum_function()"></td>
    </tr>
    <tr>
        <td><span>32</span></td>
        <td colspan="3"><label for="drs_903001_item_32" style="font-weight:700">Total</label></td>
        <td><input type="text" name="drs_90300132" id="drs_903001_item_32" class="" style="background-color: #efeaea;" placeholder="Total" readonly></td>
    </tr>
    <tr>
        <td><span>33</span></td>
        <td><label for="drs_903001_item_33">Remark</label></td>
        <td colspan="3"><textarea name="drs_90300133" id="drs_903001_item_33" class="" placeholder="Remark"></textarea></td>
    </tr>
    <tr>
        <td>
            <?php echo form_submit('mysubmit', 'Submit'); ?>
        </td>
    </tr>
</table>

<?php echo form_close(); ?>
<?php }else{ ?>
    <table>
        <tr><td style="color:red">Not Allow for Data Entry</td></tr>
    </table>
<?php } ?>

<script>
    function drs903001_auto_sum_function(){
        var drs_903001_item_29_Val = 0;
        var drs_903001_item_30_Val = 0;
        var drs_903001_item_31_Val = 0;
        var totalVal = 0;
        drs_903001_item_29_Val =  jQuery("#drs_903001_item_29").val();
        drs_903001_item_30_Val =  jQuery("#drs_903001_item_30").val();
        drs_903001_item_31_Val =  jQuery("#drs_903001_item_31").val();
        if(IsNumeric(drs_903001_item_29_Val) && drs_903001_item_29_Val !=""){
            drs_903001_item_29_Val = parseFloat(drs_903001_item_29_Val);
            totalVal += drs_903001_item_29_Val;
        }
        if(IsNumeric(drs_903001_item_30_Val) && drs_903001_item_30_Val !=""){
            drs_903001_item_30_Val = parseFloat(drs_903001_item_30_Val);
            totalVal += drs_903001_item_30_Val;
        }
        if(IsNumeric(drs_903001_item_31_Val) && drs_903001_item_31_Val !=""){
            drs_903001_item_31_Val = parseFloat(drs_903001_item_31_Val);
            totalVal += drs_903001_item_31_Val;
        }
        jQuery("#drs_903001_item_32").val(parseFloat(totalVal).toFixed(2));
    }
</script>



