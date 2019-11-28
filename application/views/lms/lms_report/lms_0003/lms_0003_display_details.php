<style>
.divider {
    border: 3px solid #333;
    width: 75%;
    margin-bottom: 40px;
    margin-left: 115px;
    margin-top: 10px;
}

table.table-head {
    margin-left: 250px;
}
.details-report {
    margin-left: 8%;
    border-left: 1px solid #afafaf;
}

.details-report table tr td {
    padding: 5px 7px;
}
</style>
<div class="container">
<?php
$attribute = '';
?>  
    <?php 
        $attributesForm = array('name' => 'lmsBasicForm', 'id'=>'lms_basic_entry_form');
        echo form_open('lms/', $attributesForm);
    ?>
    <br/>
    <table  border="1" style="margin-left: 750px;">
        <tr align=""><th><a href="javascript:history.back();">View Another Report</a></th></tr>
    </table>
    <div class="single-report-area">
        <div class="row">
            
            <br/><br/>
            <table class="table-head">
                <tr>
                    <td align="center" style="font-size:20px;">Suit/Case Information Management System</td>
                </tr>
                <!-- <tr>
                <?php $month_array=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'); ?>
                    <td align="center" >For the Month of <?php echo isset($month_array[$report_of_month])?$month_array[$report_of_month]:'';?> <?php echo isset($report_of_year)?$report_of_year:'';?> </td>
                </tr> -->
                <tr>
                    <td align="center" ><?php echo isset($report_of_office)?$report_of_office:''; ?></td>
                </tr>
                <tr>
                    <td align="center" ><?php echo isset($command_office)?$command_office:''; ?></td>
                </tr>
                <tr>
                    <td align="center" ><?php echo 'Suit/Case Details Report'; ?></td>
                </tr>
                
            </table>
        </div>
        <div class="divider"></div>
        <?php
        // if($lmssingleDatas[0]->lb_court_type != 51 && $lmssingleDatas[0]->lb_court_type != 52){
        //  echo "Medicine";   
        // }else{
        //     echo "No-Medicine";   
        // }
        //var_dump($lmssingleDatas[0]->lb_court_type);
        // echo "<pre>";
        // print_r($lmssingleDatas);
        // die();
        ?>
        
        <div class="details-report">
            <table>
                <tr>
                    <td>Branch Name</td>
                    <td>:</td>
                    <td><?php echo isset($report_branch[0]->branchname)?$report_branch[0]->branchname:''; ?></td>
                </tr>
                <tr>
                    <td>Loan A/C Name</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lb_loan_ac_name)?$lmssingleDatas[0]->lb_loan_ac_name:''; ?></td>
                </tr>
                <tr>
                    <td>A/C Holder Address</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lb_acholder_addres)?$lmssingleDatas[0]->lb_acholder_addres:''; ?></td>
                </tr>
                <tr>
                    <td>Loan A/C No</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lb_loan_ac_no)?$lmssingleDatas[0]->lb_loan_ac_no:''; ?></td>
                </tr>
                <tr>
                    <td>Suit/Case Category</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lmcc_cc_desc_l3)?$lmssingleDatas[0]->lmcc_cc_desc_l3:''; ?></td>
                </tr>
                <tr>
                    <td>Suit/Case Number</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lb_case_no)?$lmssingleDatas[0]->lb_case_no:''; ?></td>
                </tr>
                <tr>
                    <td>Filing date</td>
                    <td>:</td>
                    <td>
                        <?php echo date('d/m/Y', strtotime(isset($lmssingleDatas[0]->lb_filing_date)?$lmssingleDatas[0]->lb_filing_date:'')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Court Name</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lmct_ct_desc_l3)?$lmssingleDatas[0]->lmct_ct_desc_l3:''; ?></td>
                </tr>
                <tr>
                    <td>Claiming Amount</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lb_suitValue_amt)?number_format($lmssingleDatas[0]->lb_suitValue_amt, 2):''; ?></td>
                </tr>
                <tr>
                    <td>Plaintiff/Complainant/Petitioner Name</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lb_pl_co_pe_name)?$lmssingleDatas[0]->lb_pl_co_pe_name:''; ?></td>
                </tr>
                <tr>
                    <td>Defendant/Accused/Respondent Name</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lb_de_ac_re_name)?$lmssingleDatas[0]->lb_de_ac_re_name:''; ?></td>
                </tr>
                
                <tr>
                    <td class="">Lawyer Name</td>
                    <td class="">:</td>
                </tr>   
                <tr>
                    <td colspan="3">
                        <?php
                       
                       
                        if($lmssingleDatas[0]->lb_category_id != 5101){
                            $lawyerIdArr = explode(',', $lmssingleDatas[0]->lb_lawyer_id);
                            $dataLaws = $this->lmsmodel->lms_lawer_data($lawyerIdArr);
                        ?>   
                        <table  class="law-info-tbl">
                        <tr>
                            <th>Lawyer Name</th>
                            <th>Lawyer Position</th>
                        <tr>
                        <?php 
                            foreach($dataLaws as $lawAll){ ?>
                                <tr>
                                    <td><?php echo isset($lawAll->lml_lawer_name)?$lawAll->lml_lawer_name:'';?></td>
                                    <td><?php echo isset($lawAll->lml_lawer_advPosition)?$lawAll->lml_lawer_advPosition:'';?></td>
                                </tr>
                        <?php  } ?>
                        </table>    
                        <?php }?> 
                    </td> 
                </tr>  
                
                <tr>
                    <td>Primary Security value(Suit Time)</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lb_primary_secSan)?number_format($lmssingleDatas[0]->lb_primary_secSan, 2):''; ?></td>
                </tr>
                <tr>
                    <td>Primary Security value(Present)</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lb_primary_secP)?number_format($lmssingleDatas[0]->lb_primary_secP, 2):''; ?></td>
                </tr>
                <tr>
                    <td>Collateral Security value(Sanction)</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lb_coll_secSan)?number_format($lmssingleDatas[0]->lb_coll_secSan, 2):''; ?></td>
                </tr>
                <tr>
                    <td>Collateral Security value(Present)</td>
                    <td>:</td>
                    <td><?php echo isset($lmssingleDatas[0]->lb_coll_secP)?number_format($lmssingleDatas[0]->lb_coll_secP, 2):''; ?></td>
                </tr>               
                <tr>
                    <td>Present Position of the Case</td>
                    <td>:</td>
                    <?php if(isset($lmsppDatahas) && !empty($lmsppDatahas)){
                    foreach($lmsppDatahas as $lmsppData){
                        if($lmssingleDatas[0]->lb_tran_no == $lmsppData->lbpp_tran_no){?>
                        <td><?php echo isset($lmsppData->lmpp_pp_desc_l2)?$lmsppData->lmpp_pp_desc_l2:''; ?></td>
                    <?php } } }?>
                </tr>
               
                <tr>
                    <td>Date of Judgement and Decree</td>
                    <td>:</td>
                    <td>
                        <?php 
                            if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                                foreach($lmsdisDatahas as $lmsdisData){
                                    if($lmssingleDatas[0]->lb_tran_no == $lmsdisData->lbdis_tran_no){
                                        echo date('d/m/Y', strtotime(isset($lmsdisData->lbdis_date)?$lmsdisData->lbdis_date:''));
                                    }
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Decretal Amount</td>
                    <td>:</td>
                    <td>
                        <?php  
                        if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                            foreach($lmsdisDatahas as $lmsdisData){
                                if($lmssingleDatas[0]->lb_tran_no == $lmsdisData->lbdis_tran_no){
                                    echo isset($lmsdisData->lbdis_dis_amt)?number_format($lmsdisData->lbdis_dis_amt, 2):'';
                                }
                            }
                        }
                        ?>
                    </td>
                </tr>
                <?php
                
                if(isset($lmsOtherDatas) && !empty($lmsOtherDatas)){
                foreach($lmsOtherDatas as $lmsOtherData){
                    if($lmsOtherData->lb_category_id == 1405 || $lmsOtherData->lb_category_id == 3105 || $lmsOtherData->lb_category_id == 3114|| $lmsOtherData->lb_category_id == 3115){
                ?>
                <tr class="mt20">
                    <td>Execution Suit No.</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_case_no)?$lmsOtherData->lb_case_no:''; ?></td>
                </tr>
                <tr>
                    <td>Execution SUit Amount</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_suitValue_amt)?number_format($lmsOtherData->lb_suitValue_amt, 2):''; ?></td>
                </tr>
                <tr>
                    <td>Date of filing Execution Suit</td>
                    <td>:</td>
                    
                    <td><?php echo date('d/m/Y', strtotime(isset($lmsOtherData->lb_filing_date)?$lmsOtherData->lb_filing_date:'')); ?></td>
                </tr>
                <tr>
                    <td>Date of Auction Notice</td>
                    <td>:</td>
                    <td><?php  ?></td>
                </tr>
                <tr>
                    <td>Date of issuing Certificate under section 33(5)</td>
                    <td>:</td>
                    <?php if(isset($lmsppDatahas) && !empty($lmsppDatahas)){
                    foreach($lmsppDatahas as $lmsppData){
                        if($lmsppData->lbpp_present_position ==5208){?>
                        <td><?php echo date('d/m/Y', strtotime(isset($lmsppData->lbpp_date_of_position)?$lmsppData->lbpp_date_of_position:'')); ?></td>
                    <?php } } }?>
                </tr>
                <tr>
                    <td>Date of issuing Certificate under section 33(7)</td>
                    <td>:</td>
                    <?php 
                    if(isset($lmsppDatahas) && !empty($lmsppDatahas)){
                    foreach($lmsppDatahas as $lmsppData){
                        if($lmsppData->lbpp_present_position ==5212){?>
                        <td><?php echo date('d/m/Y', strtotime(isset($lmsppData->lbpp_date_of_position)?$lmsppData->lbpp_date_of_position:'')); ?></td>
                    <?php } } }?>
                </tr>
                <tr>
                    <td>Present Position of Execution suit</td>
                    <td>:</td>
                    <?php 
                    if(isset($lmsppDatahas) && !empty($lmsppDatahas)){
                    foreach($lmsppDatahas as $lmsppData){
                        if($lmsOtherData->lb_tran_no === $lmsppData->lbpp_tran_no){?>
                        <td><?php echo isset($lmsppData->lmpp_pp_desc_l2)?$lmsppData->lmpp_pp_desc_l2:''; ?></td>
                    <?php } } } ?>
                </tr>
                <tr>
                    <td>Recovery after filing suit</td>
                    <td>:</td>
                    <td><?php  ?></td>
                </tr>
                <tr>
                    <td>Present Outstanding</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_outstanding)?number_format($lmsOtherData->lb_outstanding, 2):''; ?></td>
                </tr>
                <tr>
                    <td>write off date (if any)</td>
                    <td>:</td>
                    <td><?php  ?></td>
                </tr>
                <tr>
                    <td>Date of Interest waived (if any)</td>
                    <td>:</td>
                    <td><?php  ?></td>
                </tr>
            <?php }
                if($lmsOtherData->lb_category_id == 1103 || $lmsOtherData->lb_category_id == 1203 || $lmsOtherData->lb_category_id == 1301 || $lmsOtherData->lb_category_id == 1307 || $lmsOtherData->lb_category_id == 1402 || $lmsOtherData->lb_category_id == 3106 || $lmsOtherData->lb_category_id == 3119 || $lmsOtherData->lb_category_id == 3124 || $lmsOtherData->lb_category_id == 3125 || $lmsOtherData->lb_category_id == 4106 || $lmsOtherData->lb_category_id == 4107){
            ?>
                 <tr class="mt20">
                    <td>Misc. Case No.</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_category_id)?$lmsOtherData->lb_category_id:''; ?></td>
                </tr>
                <tr>
                    <td>Misc. Case filing date</td>
                    <td>:</td>
                    <td><?php echo date('d/m/Y', strtotime(isset($lmsOtherData->lb_filing_date)?$lmsOtherData->lb_filing_date:'')); ?></td>
                </tr>
                <tr>
                    <td>Reason for filing Misc. Case</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_issue)?$lmsOtherData->lb_issue:''; ?></td>
                </tr>
                <tr>
                    <td>Conducting Lawyer's Name</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_lawyer_id)?$lmsOtherData->lb_lawyer_id:''; ?></td>
                </tr>
                <tr>
                    <td>Present position of the Misc. Case</td>
                    <td>:</td>
                    <?php if(isset($lmsppDatahas) && !empty($lmsppDatahas)){
                    foreach($lmsppDatahas as $lmsppData){
                        if($lmsOtherData->lb_tran_no === $lmsppData->lbpp_tran_no){?>
                        <td><?php echo isset($lmsppData->lmpp_pp_desc_l2)?$lmsppData->lmpp_pp_desc_l2:''; ?></td>
                    <?php } } } ?>
                </tr>
                <tr>
                    <td>Disposal Nature</td>
                    <td>:</td>
                    <td>
                    <?php  
                        if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                            foreach($lmsdisDatahas as $lmsdisData){
                                if($lmsOtherData->lb_tran_no == $lmsdisData->lbdis_tran_no){
                                    echo isset($lmsdisData->lmdn_dn_desc)?$lmsdisData->lmdn_dn_desc:'';
                                }
                            }
                        }
                    ?></td>
                </tr>
            <?php } ?>
            <?php 
                if("3112" == $lmsOtherData->lb_category_id){
            ?>
                <tr class="mt20">
                    <td>Appeal/Revision Case No.</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_case_no)?$lmsOtherData->lb_case_no:''; ?></td>
                </tr>
                <tr>
                    <td>Filing date</td>
                    <td>:</td>
                    <td><?php echo date('d/m/Y', strtotime(isset($lmsOtherData->lb_filing_date)?$lmsOtherData->lb_filing_date:'')); ?></td>
                </tr>
                <tr>
                    <td>Reason for filing Misc. Case</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_issue)?$lmsOtherData->lb_issue:''; ?></td>
                </tr>
                <tr>
                    <td>Conducting Lawyer's Name</td>
                    <td>:</td>
                    <td>
                    <?php //echo isset($lmsOtherData->lb_lawyer_id)?$lmsOtherData->lb_lawyer_id:''; 

                    ?>
                    </td>
                    <tr>
                    <td colspan="3">
                        <?php
                            $lawyerIdArr = explode(',', $lmsOtherData->lb_lawyer_id);
                            $dataLaws = $this->lmsmodel->lms_lawer_data($lawyerIdArr);
                        ?>   
                        <table  class="law-info-tbl">
                        <tr>
                            <th>Lawyer Name</th>
                            <th>Lawyer Position</th>
                        <tr>
                        <?php 
                            foreach($dataLaws as $lawAll){ ?>
                                <tr>
                                    <td><?php echo isset($lawAll->lml_lawer_name)?$lawAll->lml_lawer_name:'';?></td>
                                    <td><?php echo isset($lawAll->lml_lawer_advPosition)?$lawAll->lml_lawer_advPosition:'';?></td>
                                </tr>
                        <?php  } ?>
                        </table>     
                    </td> 
                </tr>
                </tr>
                <tr>
                    <td>Present Position of the Appeal/Revision</td>
                    <td>:</td>
                    <?php if(isset($lmsppDatahas) && !empty($lmsppDatahas)){
                    foreach($lmsppDatahas as $lmsppData){
                        if($lmsOtherData->lb_tran_no === $lmsppData->lbpp_tran_no){?>
                        <td><?php echo isset($lmsppData->lmpp_pp_desc_l2)?$lmsppData->lmpp_pp_desc_l2:''; ?></td>
                    <?php } } } ?>
                </tr>
                <tr>
                    <td>Date of Judgement</td>
                    <td>:</td>
                    <td><?php  
                     if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                        foreach($lmsdisDatahas as $lmsdisData){
                            if($lmsOtherData->lb_tran_no === $lmsdisData->lbdis_tran_no){
                                echo date('d/m/Y', strtotime(isset($lmsdisData->lbdis_date)?$lmsdisData->lbdis_date:''));
                            }
                        }
                    }
                    ?></td>
                </tr>
                <tr>
                    <td>Disposal Nature</td>
                    <td>:</td>
                    <td>
                    <?php  
                        if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                            foreach($lmsdisDatahas as $lmsdisData){
                                if($lmsOtherData->lb_tran_no === $lmsdisData->lbdis_tran_no){
                                    echo isset($lmsdisData->lmdn_dn_desc)?$lmsdisData->lmdn_dn_desc:'';
                                }
                            }
                        }
                    ?></td>
                </tr>
            <?php } ?>
            <?php 
                if($lmsOtherData->lb_category_id == 1501 || $lmsOtherData->lb_category_id == 1502 || $lmsOtherData->lb_category_id == 1503 || $lmsOtherData->lb_category_id == 1504 || $lmsOtherData->lb_category_id == 1505 ||
                $lmsOtherData->lb_category_id == 1506 || $lmsOtherData->lb_category_id == 1507 || $lmsOtherData->lb_category_id == 1508 || $lmsOtherData->lb_category_id == 1509 || $lmsOtherData->lb_category_id == 1510){
            ?>
                <tr class="mt20">
                    <td>Writ Petition No.</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_case_no)?$lmsOtherData->lb_case_no:''; ?></td>
                </tr>
                <tr>
                    <td>Date of filing Writ Petition</td>
                    <td>:</td>
                    <td><?php echo date('d/m/Y', strtotime(isset($lmsOtherData->lb_filing_date)?$lmsOtherData->lb_filing_date:'')); ?></td>
                </tr>
                <tr>
                    <td>Reason for filing Writ Petition</td>
                    <td>:</td>
                    <td>
                        <?php 
                            if(isset($subjectissue)&& !empty($subjectissue)){
                                foreach($subjectissue as $subject){
                                    if($lmsOtherData->lb_issue_writ == $subject->sub_fact_issue_id){
                                        echo isset($subject->sub_fact_issue_desc)?$subject->sub_fact_issue_desc:'';
                                    }
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Conducting Lawyer's Name</td>
                    <td>:</td>
                    <td><?php  ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php
                            $lawyerIdArr = explode(',', $lmsOtherData->lb_lawyer_id);
                            $dataLaws = $this->lmsmodel->lms_lawer_data($lawyerIdArr);
                        ?>   
                        <table  class="law-info-tbl">
                        <tr>
                            <th>Lawyer Name</th>
                            <th>Lawyer Position</th>
                        <tr>
                        <?php 
                            foreach($dataLaws as $lawAll){ ?>
                                <tr>
                                    <td><?php echo isset($lawAll->lml_lawer_name)?$lawAll->lml_lawer_name:'';?></td>
                                    <td><?php echo isset($lawAll->lml_lawer_advPosition)?$lawAll->lml_lawer_advPosition:'';?></td>
                                </tr>
                        <?php  } ?>
                        </table>     
                    </td> 
                </tr>
                <tr>
                    <td>Present Position of the Writ Petition</td>
                    <td>:</td>
                    <?php 
                    if(isset($lmsppDatahas) && !empty($lmsppDatahas)){
                    foreach($lmsppDatahas as $lmsppData){
                        if($lmsOtherData->lb_tran_no === $lmsppData->lbpp_tran_no){ ?>
                        <td><?php echo isset($lmsppData->lmpp_pp_desc_l2)?$lmsppData->lmpp_pp_desc_l2:''; ?></td>
                    <?php } } } ?>
                </tr>
                <tr>
                    <td>Date of Judgement</td>
                    <td>:</td>
                    <td><?php  
                     if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                        foreach($lmsdisDatahas as $lmsdisData){
                            if($lmsOtherData->lb_tran_no === $lmsdisData->lbdis_tran_no){
                                echo date('d/m/Y', strtotime(isset($lmsdisData->lbdis_date)?$lmsdisData->lbdis_date:''));
                            }
                        }
                    }
                    ?></td>
                </tr>
                <tr>
                    <td>Disposal Nature</td>
                    <td>:</td>
                    <td>
                    <?php  
                        if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                            foreach($lmsdisDatahas as $lmsdisData){
                                if($lmsOtherData->lb_tran_no == $lmsdisData->lbdis_tran_no){
                                    echo isset($lmsdisData->lmdn_dn_desc)?$lmsdisData->lmdn_dn_desc:'';
                                }
                            }
                        }
                    ?></td>
                </tr>
            <?php } ?>
            <?php 
                if($lmsOtherData->lb_category_id == "CMPLA"){
            ?>
                <tr class="mt20">
                    <td>CMPLA No.</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_case_no)?$lmsOtherData->lb_case_no:''; ?></td>
                </tr>
                <tr>
                    <td>CPLA No.</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_case_no)?$lmsOtherData->lb_case_no:''; ?></td>
                </tr>
                <tr>
                    <td>Date of filing CPLA</td>
                    <td>:</td>
                    <td><?php echo date('d/m/Y', strtotime(isset($lmsOtherData->lb_filing_date)?$lmsOtherData->lb_filing_date:'')); ?></td>
                </tr>
                <tr>
                    <td>Conducting Lawyer's Name</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_lawyer_id)?$lmsOtherData->lb_lawyer_id:''; ?></td>
                </tr>
                <tr>
                    <td>Present Position of CPLA</td>
                    <td>:</td>
                    <?php 
                    if(isset($lmsppDatahas) && !empty($lmsppDatahas)){
                    foreach($lmsppDatahas as $lmsppData){
                        if($lmsOtherData->lb_tran_no === $lmsppData->lbpp_tran_no){ ?>
                        <td><?php echo isset($lmsppData->lmpp_pp_desc_l2)?$lmsppData->lmpp_pp_desc_l2:''; ?></td>
                    <?php } } } ?>
                </tr>
                <tr>
                    <td>Date of Judgement</td>
                    <td>:</td>
                    <td><?php  
                     if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                        foreach($lmsdisDatahas as $lmsdisData){
                            if($lmsOtherData->lb_tran_no === $lmsdisData->lbdis_tran_no){
                                echo date('d/m/Y', strtotime(isset($lmsdisData->lbdis_date)?$lmsdisData->lbdis_date:''));
                            }
                        }
                    }
                    ?></td>
                </tr>
                <tr>
                    <td>Disposal Nature</td>
                    <td>:</td>
                    <td>
                    <?php  
                        if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                            foreach($lmsdisDatahas as $lmsdisData){
                                if($lmsOtherData->lb_tran_no == $lmsdisData->lbdis_tran_no){
                                    echo isset($lmsdisData->lmdn_dn_desc)?$lmsdisData->lmdn_dn_desc:'';
                                }
                            }
                        }
                    ?></td>
                </tr>
             <?php } ?>
             <?php 
                if($lmsOtherData->lb_category_id == 2101){
            ?>
                <tr class="mt20">
                    <td>Civil Appeal No.</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_case_no)?$lmsOtherData->lb_case_no:''; ?></td>
                </tr>
                <tr>
                    <td>Conducting Lawyer's Name</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_lawyer_id)?$lmsOtherData->lb_lawyer_id:''; ?></td>
                </tr>
                <tr>
                    <td>Present Position of Civil Appeal</td>
                    <td>:</td>
                    <?php 
                    if(isset($lmsppDatahas) && !empty($lmsppDatahas)){
                    foreach($lmsppDatahas as $lmsppData){
                        if($lmsOtherData->lb_tran_no === $lmsppData->lbpp_tran_no){ ?>
                        <td><?php echo isset($lmsppData->lmpp_pp_desc_l2)?$lmsppData->lmpp_pp_desc_l2:''; ?></td>
                    <?php } } } ?>
                </tr>
                <tr>
                    <td>Date of Judgement</td>
                    <td>:</td>
                    <td><?php  
                     if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                        foreach($lmsdisDatahas as $lmsdisData){
                            if($lmsOtherData->lb_tran_no === $lmsdisData->lbdis_tran_no){
                                echo date('d/m/Y', strtotime(isset($lmsdisData->lbdis_date)?$lmsdisData->lbdis_date:''));
                            }
                        }
                    }
                    ?></td>
                </tr>
                <tr>
                    <td>Disposal Nature</td>
                    <td>:</td>
                    <td>
                    <?php  
                        if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                            foreach($lmsdisDatahas as $lmsdisData){
                                if($lmsOtherData->lb_tran_no === $lmsdisData->lbdis_tran_no){
                                    echo isset($lmsdisData->lmdn_dn_desc)?$lmsdisData->lmdn_dn_desc:'';
                                }
                            }
                        }
                    ?></td>
                </tr>
            <?php } ?>

            <?php 
                if($lmsOtherData->lb_category_id == 2104){
            ?>
                <tr class="mt20">
                    <td>Civil Review Petition No.</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_case_no)?$lmsOtherData->lb_case_no:''; ?></td>
                </tr>
                <tr>
                    <td>Conducting Lawyer's Name</td>
                    <td>:</td>
                    <td><?php echo isset($lmsOtherData->lb_lawyer_id)?$lmsOtherData->lb_lawyer_id:''; ?></td>
                </tr>
                <tr>
                    <td>Present Position of Civil Review Petition</td>
                    <td>:</td>
                    <?php 
                    if(isset($lmsppDatahas) && !empty($lmsppDatahas)){
                    foreach($lmsppDatahas as $lmsppData){
                        if($lmsOtherData->lb_tran_no === $lmsppData->lbpp_tran_no){ ?>
                        <td><?php echo isset($lmsppData->lmpp_pp_desc_l2)?$lmsppData->lmpp_pp_desc_l2:''; ?></td>
                    <?php } } } ?>
                </tr>
                <tr>
                    <td>Date of Judgement</td>
                    <td>:</td>
                    <td><?php  
                     if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                        foreach($lmsdisDatahas as $lmsdisData){
                            if($lmsOtherData->lb_tran_no === $lmsdisData->lbdis_tran_no){
                                echo date('d/m/Y', strtotime(isset($lmsdisData->lbdis_date)?$lmsdisData->lbdis_date:''));
                            }
                        }
                    }
                    ?></td>
                </tr>
                <tr>
                    <td>Disposal Nature</td>
                    <td>:</td>
                    <td>
                    <?php  
                        if(isset($lmsdisDatahas) && !empty($lmsdisDatahas)){
                            foreach($lmsdisDatahas as $lmsdisData){
                                if($lmsOtherData->lb_tran_no === $lmsdisData->lbdis_tran_no){
                                    echo isset($lmsdisData->lmdn_dn_desc)?$lmsdisData->lmdn_dn_desc:'';
                                }
                            }
                        }
                    ?></td>
                </tr>
            <?php } ?>
            <?php } } ?>
            </table>
        </div>

    </div>

    <?php echo form_close(); ?>
</div>
