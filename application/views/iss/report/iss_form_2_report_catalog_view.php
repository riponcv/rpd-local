<style>
    table td {
    text-align: center;
    }
</style>
   	<?php 
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Integrated Supervision System(ISS) Form-2 vs Affairs vs OMIS vs CL vs TMS  Cross-Matching Report Section</th></tr></table>";
    echo "</table>";  
    echo form_open('iss/','id=""');?>
    <br>
    <table border="1">
        <tr>
            <td><strong>SL</strong></td>
            <td style="width:350px"><strong>ISS Form-2 Cross Report Module</strong></td>
            <td><strong>ISS Form-2 Cross-Matching Report Description</strong></td>
        </tr>
        <tr>
            <td>1</td>
            <td style="text-align: left; padding:5px"><?php echo anchor('iss/iss_2_003_report', 'ISS Form-2 vs CIBTA Cross Report', 'title="ISS Form-2 CIBTA-Cross Report"'); ?></td>
            <td style="text-align: left; padding:5px">
                ISS Form-2 and OMIS CIBTA Cross Report Items:
                (1)Inter Branch Un-reconciled Debit Entries(number), (2)Inter Branch Un-reconciled Debit Entries (amount),
                (3) Inter Branch Un-reconciled Credit Entries(number), (4) Inter Branch Un-reconciled Credit Entries(amount),
                (5) Last date of Inter Branch Reconciliation Completed(YYYYMMDD).<br>
                <p style="background-color:#ddd; font-weight: 700;">
                    বিঃদ্রঃ-OMIS থেকে CIBTA রিপোর্ট পাশের লিংকে পাওয়া যাবে 
                    <?php 
                        echo anchor('http://115.127.114.71:8033/rpd/index.php/report/misd_0035', 'CIBTA Statement (For ISS)', array('title' => 'CIBTA Statement (For ISS)', 'target'=>'_blank'));
                    ?>
                </p>
            </td>
            
        </tr>
        <tr>
            <td>2</td>
            <td style="text-align: left; padding:5px"><?php echo anchor('iss/iss_2_002_report', 'ISS Form-2 vs Affairs vs OMIS Cross Report', 'title="ISS Form-2 Cross Report"'); ?></td>
            <td style="text-align: left; padding:5px">
                ISS Form-2, OMIS and Affairs (Deposit and Advance). 
                <p style="background-color:#ddd; font-weight: 700;">
                    বিঃদ্রঃ-OMIS থেকে Affairs পাশের লিংকে পাওয়া যাবে 
                    <?php 
                        echo anchor('http://115.127.114.71:8033/rpd/index.php/report/view_report/2', 'Affairs', array('title' => 'Affairs', 'target'=>'_blank'));
                    ?>
                </p>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td style="text-align: left; padding:5px"><?php echo anchor('iss/iss_2_004_report', 'ISS Form-2 vs Affairs 10 items Report', 'title="ISS Form-2 10 items Report"'); ?></td>
            <td style="text-align: left; padding:5px">
                ISS Form-2 vs Affairs 10 items Report (This report depends on availability of Statement of Affairs of branches.<br> 
                ISS Form-2, Affairs and TMS 25 items: 
                (1) Total Asset, (2) Total Liability, (3) Total Deposit, (4) Total Loan Outstanding,
                (5) HO General Ledger Positive Balance, (6) HO General Ledger Negative Balance, (7) Total Other Asset, (8) Total Other Liability,
                (9) Fixed Asset, (10) Off Balance Sheet Exposure (Contra).<br>
                <p style="background-color:#ddd; font-weight: 700;">
                    বিঃদ্রঃ-OMIS থেকে Affairs পাশের লিংকে পাওয়া যাবে 
                    <?php 
                        echo anchor('http://115.127.114.71:8033/rpd/index.php/report/view_report/2', 'Affairs', array('title' => 'Affairs', 'target'=>'_blank'));
                    ?>
                </p>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td style="text-align: left; padding:5px"><?php echo anchor('iss/iss_2_005_report', 'ISS Form-2 vs Affairs vs TMS 25 items', 'title="ISS Form-2 vs Affairs vs TMS 25 items"'); ?></td>
            <td style="text-align: left; padding:5px">
                ISS Form-2 vs Affairs vs TMS 25 items Report (This report depends on availability of Statement of Affairs of branches.<br> 
                ISS Form-2, Affairs and TMS 25 items: 
                (1) Accrued Income,(2) Suspense Account, (3) Protested Bill, (4) Stationary and Stamp,
                (5) Current Deposit, (6) Savings Deposit, (7) STD, (8) Term Deposit,
                (9) Sundry Deposit, (10) Local DD, TT, MT, PO Payable, (11) Margin Deposit, (l2) OD/SOD Loan,
                (13) PC PSC, (14) ECC, (15) PAD General, (16) PAD EDF,
                (17) LTR/MPI, (18) LIM, (19) IBP/LDBP, (20) FDBP, 
                (21) Loan Against Credit-Cards, (22) TOD Outstanding, (23) TOD Against Cash Incentive,
                (24) Yearly Deposit Target, (25) Yearly Loan Target. <br>
                <p style="background-color:#ddd; font-weight: 700;">
                    বিঃদ্রঃ-OMIS থেকে Affairs পাশের লিংকে পাওয়া যাবে 
                    <?php 
                        echo anchor('http://115.127.114.71:8033/rpd/index.php/report/view_report/2', 'Affairs', array('title' => 'Affairs', 'target'=>'_blank'));
                    ?>
                </p>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td style="text-align: left; padding:5px"><?php echo anchor('iss/iss_2_006_report', 'ISS Form-2 vs PL 11 items', 'title="ISS Form-2 vs PL 11 items Report"'); ?></td>
            <td style="text-align: left; padding:5px">
                ISS Form-2 vs PL(Profit/Loss) 11 items Report (This report depends on availability of PL(Profit/Loss) of branches).<br> 
                ISS Form-2 and PL 11 items: 
                (1) Total Income,(2) Interest Income, (3) Non-Interest Income, (4) Net Interest Income,
                (5) Gross Profit(+/-), (6) Interest Expenses, (7) Operating Expenditure, (8) Administrative Cost,
                (9) Office Maintenance Expense, (10) Branch Renovation Cost, (11) Business Development Expense. <br>
                <p style="background-color:#ddd; font-weight: 700;">
                    বিঃদ্রঃ-OMIS থেকে PL Statement পাশের লিংকে পাওয়া যাবে 
                    <?php 
                        echo anchor('http://localhost:81/rpd/index.php/iss/iss_2_008_reportindex.php', 'PL Statement', array('title' => 'PL Statement', 'target'=>'_blank'));
                    ?>
                </p>
            </td>
        </tr>
        <tr>
            <td>6</td>
            <td style="text-align: left; padding:5px"><?php echo anchor('iss/iss_2_007_report', 'ISS Form-2 vs CL 12 items', 'title="ISS Form-2 vs CL 12 items Report"'); ?></td>
            <td style="text-align: left; padding:5px">
                ISS Form-2 vs CL 12 items Report (This report is applicable for quater month-March, June, September, December).<br> 
                ISS Form-2 and CL 12 items: 
                (1) Standard Loan,(2) SMA Loan, (3) SS Loan, (4) DF Loan,
                (5) BL Loan, (6) Total Loan Outstanding, (7) Base for Provision, (8) Provision Required,
                (9) Interest Suspense Loan, (10) Micro-Credit, (11) Staff Loan (12) SME Loan
            </td>
        </tr>
    </table>
<?php echo form_close(); ?>
    
 