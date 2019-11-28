<style>
.drs_9030_css_0102 {  text-align: left;}
.drs_9030_css_0102 ul{margin:0; padding:0;list-style:none;}
.drs_9030_css_0102 li{display:inline-block; margin-right:10px; padding:5px;}
.drs_9030_css_0102 li a{text-decoration:none; text-transform:uppercase; transition:.3s}
.drs_9030_css_0102 li a:hover{background-color:#93c041; color:#333; padding:5px}

.default_content{text-align:left}

.default_content table td {
  border: 1px solid #ddd;
  padding: 5px 10px;
  font-weight: 700;
}
</style>
<?php echo form_open('','id=""'); ?>
    <div class="drs_9030_css_0102">
        <ul>
            <li><?php echo anchor('drs/drs_903001_entry_ctrler', 'Defaulter Input', array('title' => 'Top-300 Defaulters according to outstanding amount'));
    ?></li>
    <li><?php echo anchor('drs/drs_90300102_report_ctrler', 'Defaulter Report', array('title' => 'Written-off Loan related entry form'));
    ?></li>
        <li><?php echo anchor('drs/drs_903201_entry_ctrler', 'Write-off Input', array('title' => 'Written-off Loan related entry form'));
    ?></li>
        </ul>
    </div>
    <div class="default_content">
        <table>
            <tr>
                <td>SL No.</td>
                <td>Reporting Date</td>
                <td>Name of the Borrower</td>
                <td>Nature of Loan</td>
                <td>Limit </td>
                <td>Sanctioned Amount </td>
                <td>Date of last Sanctioned/ Rescheduled/ Restructuted </td>
                <td>Classification Status </td>
                <td>Action</td>
            </tr>
        </table>
    </div>
<?php echo form_close(); ?>