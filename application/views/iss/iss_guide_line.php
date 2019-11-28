<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
    
	<?php
		echo  "<h2 style='color:#000000'>Integrated Supervision System Guide Line</h2>";?>
		<?php
			if(isset($login_office_status) && $login_office_status !=4 )
			{
				echo form_open('');
			}
			else
			{
				echo form_open('iss/iss_2_guide_line_view_details','id="iss2_generate_id"');   
			}
		?>
		<div style="background: #ddd none repeat scroll 0 0;    height: 80px; width: 100%;">
		<!--<table style="padding: 12px">
			<tr>
				<td>Select Date for ISS </td>
				<td>
					<?php
						/*$attribute='';
						if(isset($login_office_status) && $login_office_status !=4 )
						{
							$attribute='disabled="disabled"';
						}
						echo '<select id="fetched_date_9item" name="fetched_date_9item" '.$attribute.'>';
						echo '<option value="">Select Date</option>';
						foreach($records3 as $row)
						{
							$select='';
							if(isset($_POST['fetched_date_9item']) && $_POST['fetched_date_9item']==$row->ISSEntryDate)
							{
								$select="selected='selected'";
							}
						  echo '<option value="'.$row->ISSEntryDate.'" '.$select.'>'.$row->ISSEntryDate.'</option>';
						}
						echo '</select>';*/
					?>
				</td>
				
				<td>
					<input type="button" name="fetch_iss_9item" id="fetch_iss_9item" value="Generate ISS-2 Items" style="background-color: #FF9900;" <?php //echo $attribute; ?> onclick="if((jQuery('#fetched_date_9item').val() != '')){jQuery('#iss2_generate_id').submit();;}else{alert('First Select Date..')}"/>
				</td>
				<td>
					This Generate ISS-2 Items derived from affairs, this items depends on affairs. IF any branch differ from 
					this items avoid this generate items.
				</td>
				<input type="hidden" name="iss_guideline_br_id" value="<?php //echo $off_id; ?>"/>
			</tr>
		</table>-->
		</div>
		<?php echo form_close(); ?>
		<?php
		$msg ='<fieldset style="border:px solid green;">';
		$msg.='<legend style="color:black;font-weight:700;font-size:16px;">'.'Few Items Calculation of your given data(optional)'.'</legend>';
		//$tmt = 'http://203.76.102.169:8033/rpd/index.php/report/misd_0021';
		$tmt = 'http://localhost:81/rpd/index.php/report/misd_0021';
		$blnk_pr = '_blank';
		$msg.='<a href="'.$tmt.'" target="'.$blnk_pr.'">View Statement of Affairs</a>';
		
		$msg.='<table>';	
		$msg.='<tr><td>';
		$msg.='<table border="\1\">';	

		
		$msg.='<tr style="color:black;font-weight:700;font-size:16px; text-align:center"><td colspan="3">Liability Side</td></tr>';
		$msg.='<tr style="color:black;font-weight:700;font-size:16px;"><td>SL</td><td>Liability</td><td>Amount</td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>1</td><td>Total Deposit</td><td><input type="text" name="" class="" id="lblty_ttl_deposit_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>2</td><td>Total Bills Payable</td><td><input type="text" name="" class="" id="lblty_ttl_billspayable_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:500;font-size:14px;"><td>3</td><td>Other liability <span style="color:red">Excluding All IBT A/C(in any)
		 & Including Intt. suspense A/C</span></td><td><input type="text" name="" class="" id="lblty_otherliability_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>4</td><td>H.O General A/C</td><td><input type="text" name="" class="" id="lblty_hogeneral_ac_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>5</td><td>H.O Central A/C</td><td><input type="text" name="" class="" id="lblty_ho_central_ac_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>6</td><td>CIBT A/C</td><td><input type="text" name="" class="" id="lblty_cibt_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>7</td><td>OIBT A/C</td><td><input type="text" name="" class="" id="lblty_oibt_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>8</td><td>IBF Exch. Transaction A/C</td><td><input type="text" name="" class="" id="lblty_ibfexc_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>9</td><td>Cash Remittance A/C</td><td><input type="text" name="" class="" id="lblty_cashremittance_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>9</td><td>Income A/C</td><td><input type="text" name="" class="" id="lblty_incomeac_id" value="" ></td></tr>';
		$msg.="</table>";
		$msg.='</td><td>';
		$msg.='<table border="\1\">';	
		$msg.='<tr style="color:black;font-weight:700;font-size:16px; text-align:center"><td colspan="3">Asset Side</td></tr>';
		$msg.='<tr style="color:black;font-weight:700;font-size:16px;"><td>SL</td><td>Assets</td><td>Amount</td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>1</td><td>Cash & Bank Balance</td><td><input type="text" name="" class="" id="ass_cashbnkblance_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>2</td><td>Advances-Loans</td><td><input type="text" name="" class="" id="ass_advanceloan_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>3</td><td>Advances-Overdraft</td><td><input type="text" name="" class="" id="ass_advanceoverdraft_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>4</td><td>Advance-Discount</td><td><input type="text" name="" class="" id="ass_advancediscount_id" value="" ></td></tr>';
		//$msg.='<tr style="font-weight:500;font-size:14px;"><td>5</td><td>Other Assets  <span style="color:red">Excluding All IBT A/C(if any), Fixed asset & Including Suspense A/C.</span></td><td><input type="text" name="" class="" id="ass_otherasset_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:500;font-size:14px;"><td>5</td><td>Other Assets  <span style="color:red"></td><td><input type="text" name="" class="" id="ass_otherasset_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>6</td><td>Furniture & Fixture</td><td><input type="text" name="" class="" id="ass_fur_fix_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>7</td><td>Computer</td><td><input type="text" name="" class="" id="ass_computer_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>8</td><td>Land & Building</td><td><input type="text" name="" class="" id="ass_land_building_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>9</td><td>H.O General A/C</td><td><input type="text" name="" class="" id="ass_hogeneral_ac_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>10</td><td>H.O Central A/C</td><td><input type="text" name="" class="" id="ass_hocentral_ac_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>11</td><td>CIBT A/C</td><td><input type="text" name="" class="" id="ass_cibt_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>12</td><td>OIBT A/C</td><td><input type="text" name="" class="" id="ass_oibt_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>13</td><td>IBF Exch. Transaction A/C</td><td><input type="text" name="" class="" id="ass_ibfexch_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>14</td><td>Cash Remittance A/C </td><td><input type="text" name="" class="" id="ass_cashremittance_id" value="" ></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>14</td><td>Expenditure A/C</td><td><input type="text" name="" class="" id="ass_expenditureac_id" value="" ></td></tr>';
		$msg.="</table>";
		$msg.='</td></tr>';
		
		$msg.='<tr>';
		$msg.='<td style="text-align:right"><input type="button" name="btn_generate_iss_data" class="" id="btn_generate_iss_data" value="Generate ISS Data" onclick="iss_data_generate_guideline(this.value)" style="width:282px;background:olive">
		</td>';
		$msg.='<td ><input type="submit" name="btn_clear" class="" id="" value="Reset"  onclick="iss_data_generate_reset(this.value)" style="width:100px;background:yellow"></td>';
		
		$msg.='</tr>';
		$msg.="</table>";
		
		$msg.='<table border="\1\">';	
		$msg.='<tr style="color:black;font-weight:700;font-size:16px;text-align:center"><td>SL</td><td>GENERATED ISS ITEMS</td><td>Amount</td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>1</td><td>Total Asset</td><td><div class="iss_total_asset"><span class="span_total_asset"></span></div></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>2</td><td>Total Liability</td><td><div class="iss_total_liability"><span class="span_total_liability"></span></div></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>3</td><td>Total Deposit</td><td><div class="iss_total_deposit"><span class="span_total_deposit"></span></div></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>4</td><td>Total Loan Outstanding</td><td><div class="iss_total_loanoutstanding"><span class="span_total_loanoutstanding"></span></div></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:14px;"><td>5</td><td>Head Office General Ledger Positive Balance (after netting off)</td><td><div class="iss_total_hoglpb"><span class="span_total_hoglpb"></span></div></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:14px;"><td>6</td><td>Head Office General Ledger Negative Balance (after netting off)</td><td><div class="iss_total_hoglnb"><span class="span_total_hoglnb"></span></div></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>7</td><td>Total Other Asset</td><td><div class="iss_total_totalotherasset"><span class="span_totalotherasset"></span></div></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>8</td><td>Total Other Liability</td><td><div class="iss_total_totalotherliability"><span class="span_total_totalotherliability"></span></div></td></tr>';
		$msg.='<tr style="font-weight:700;font-size:16px;"><td>9</td><td>Total Fixed Asset</td><td><div class="iss_total_fixedasset"><span class="span_total_fixedasset"></span></div></td></tr>';
		$msg.="</table>";
		
		$msg.="</fieldset>";
		
		$msg.="<fieldset style='border:px solid green;'>";
		$msg.="<table>";	
		$msg.="<legend style='color:green;font-weight:700;font-size:16px;'>"."সংশোধিত আইএসএস ফরম-২ এ তথ্য প্রদান প্রসঙ্গে"."</legend>";
		$msg.="<tr style='color:Red;font-weight:700;font-size:16px;'><td>ইন্টিগ্রেটেড সুপারভিশন সিষ্টেমকে অধিকতর কার্যকর করে তোলার লক্ষ্যে সকল এডি ও নন-এডি শাখার জন্য  আইএসএস ফরম-২-এ কতিপয় তথ্য সংযোজন এবং বিদ্যমান তথ্যের ব্যাখা আরো সহজবোধ্যকরতঃ তা নতুনভাবে প্রণয়ন করা হয়েছে।</td></tr>";
		$msg.="<tr style='color:Red;font-weight:700;font-size:16px;'><td>এ প্রক্ষিতে জানুয়ারী, ২০১৬ হতে সকল শাখাকে পূর্বের  T_PS_M_FI_MONITOR_BR  Template -এর পরিবর্তে সংশোধিত আকারে প্রণয়নকৃত আইএসএস ফরম-২ (T_PS_M_FI_MONITOR_BR) সঠিকভাবে পূরণপূর্বক অত্র ব্যাংকের OMIS Upload Portal Server ও বাংলাদেশ ব্যাংকের ওয়েব পোর্টালে আপলোড করতে নির্দেশনা প্রদান করেছেন।</td></tr>";
		$msg.="<tr style='color:Red;font-weight:700;font-size:16px;'><td>এমতবস্থায় অত্র ব্যাংকের সকল শাখাকে বাংলাদেশ ব্যাংকের আইএসএস ওয়েব পোর্টাল হতে আইএসএস ফরম-২ এর সংশোধিত Template (T_PS_M_FI_MONITOR_BR) ডাউনলোড করতঃ সঠিকভাবে পূরণপূর্বক অত্র ব্যাংকের OMIS Upload Portal Server ও বাংলাদেশ ব্যাংকের ওয়েব পোর্টালে আপলোড করার জন্য নির্দেশক্রমে অনুরোধ করা হল।</td></tr>";
		$msg.="</table>";	
		$msg.="</fieldset>";
		$msg.="<fieldset style='border:px solid #ccc;'>";
		$msg.="<legend style='color:green;font-weight:700;font-size:20px;'>"."ISS সংক্রান্ত গুরুত্বপূর্ন বিষয়"."</legend>";
		$msg.= "<p style='text-align:left;color:red;font-size:16px;'>1.শাখা কর্তৃক বাংলাদেশ ব্যাংক ও অত্র ব্যাংকের Ulpoad Portal Server এ 
				আপলোডকৃত সিএসভি (csv) ফাইল সবসময় অভিন্ন হতে হবে, সিএসভি (csv) ফাইল দুটির মধ্যে ভিন্নতা পরিলক্ষিত হওয়ার দরুন কোন প্রকার অনাকাঙ্ক্ষিত আর্থিক জরিমানা হলে তার 
				দায়-দায়িত্ব সংশ্লিষ্ট শাখার উপর বর্তাবে।</p>";
		$msg.= "<p style='text-align:left;color:red;font-size:16px;'>2.প্রত্যেকশাখা কর্তৃক আইএসএস ফরম-২ এরসিএসভি (csv) ফাইল অত্র ব্যাংকের 
				Upload Portal Server এ সঠিকভাবেআপলোডকরা হলে ISS FORM-2 REPORT হতে সংশ্লিষ্ট মাসের রিপোর্ট দেখতে পারবেন, যদি শাখা সংশ্লিষ্ট মাসের রিপোর্ট 
				দেখতে না পাওয়া যায় তবে সংশ্লিষ্ট শাখাকে পুনরায় সিএসভি (csv) ফাইল সঠিকভাবে আপলোড করতে হবে। সিএসভি (csv) ফাইল সঠিকভাবে আপলোড না হওয়া পর্যন্ত রিপোর্ট দেখা যাবে না।</p>
				<p style='text-align:left;color:red;font-size:16px;'>3.শাখা কর্তৃক আইএসএস ফরম-২ এরসিএসভি (csv) ফাইল অত্র ব্যাংকের Upload Portal Server এ সঠিকভাবে আপলোড করার পর শাখার প্রধানকে উক্ত রিপোর্টে এর প্রত্যয়ন পত্র 
				প্রদান করতে হবে। 
				<p style='text-align:left;color:red;font-size:16px;'>4.প্রত্যয়ন পত্র প্রদান করার জন্য ISS FORM-2 REPORT হতে ISS Report For: এ My Office Report সিলেক্ট করে  সংশ্লিষ্ট আইএসএস 
				সংক্রান্ত অফিসার ও শাখা প্রধানরে  নাম ও পদবী লিখে সাবমিট বাটনে ক্লিক করে প্রত্যয়ন পত্র প্রদান করতে হবে। শাখা কর্তৃক একবার প্রত্যয়ন পত্র প্রদান করার পর পুনরায় Upload Portal 
				Server এ আইএসএস ফরম-২ এর সিএসভি (csv) ফাইল আপলোড করলে সংশ্লিষ্ট মাসের ইতিপূর্বে প্রদানকৃত প্রত্যয়ন পত্র বাতিল হয়ে যাবে এবং পুনরায় সংশ্লিষ্ট শাখাকে প্রত্যয়ন পত্র প্রদান করতে হবে। 
				<p style='text-align:left;color:red;font-size:16px;'>5.এরিয়া অফিস ও বিভাগীয় অফিসকে প্রত্যেক মাসের জন্য স্ব-স্ব অফিস এর পক্ষে প্রত্যয়ন পত্র প্রদান করতে হবে।</p>";
		$msg.="</fieldset>";	
		
		$msg.="<fieldset style='border:px solid #ccc;'>";
		$msg.="<legend style='color:green;font-weight:700;font-size:20px;'>"."ISS Form-2 পূরনে কিছু গুরুত্বপূর্ন বিষয়"."</legend>";
		$msg.="<table>";
		$msg.="<tr style='color:#ff4dd2;'><td>(**Total Deposit, Bills Payable সহ  হিসাব করতে হবে ) </td></tr>";	
		
		$msg.="<tr><td>1. Form download করার পর File  এর নাম by default </td></tr>";	
		$msg.="<tr><td>T_PS_M_FI_MONITOR_BR.BANK_ID.BRANCH_ID.YYYYMMDD.xls – এই নামে থাকবে।  File- এর নাম নিম্নরূপে Rename করতে হবেঃ </td></tr>";	
		$msg.="<tr><td>T_PS_M_FI_MONITOR_BR.12.12XXXX.YYYYMMDD.xls</td></tr>";	
		$msg.="<tr><td>এখানে, XXXX - এর স্থলে বাংলাদেশ ব্যাংক কর্তৃক আপনাদের শাখার জন্য প্রদত্ত চার ডিজিট এর কোড দিতে হবে। </td></tr>";	
		$msg.="<tr><td>YYYY= চার ডিজিট এর বৎসর (যেমনঃ ২০১৫) </td></tr>";	
		$msg.="<tr><td>MM = দুই ডিজিট এর মাস (যেমনঃ মে মাসের জন্য ০৫ দিতে হবে)</td></tr>";	
		$msg.="<tr><td>DD = দুই ডিজিট এর রিপোর্টিং মাসের শেষ দিন (যেমনঃ ২৮, ৩০, ৩১ দিতে হবে)</td></tr>";	
		$msg.="<tr><td>2. File Open করার পর</td></tr>";	
		$msg.="<tr><td>Date অবশ্যই রিপোর্টিং month এর শেষ দিন হবে। (Example: 30-Jun-2015)</td></tr>";	
		$msg.="<tr><td>Bank_id অবশ্যই 12 হবে। </td></tr>";	
		$msg.="<tr><td>Branch _id বাংলাদেশ ব্যাংক কতৃক নির্ধারিত 6 digit এর হবে। যেমনঃ 12XXXX (XXXX -এর স্থলে বাংলাদেশ ব্যাংক কর্তৃক আপনাদের শাখার জন্য প্রদত্ত চার ডিজিট এর কোড দিতে হবে) </td></tr>";	
		$msg.="<tr><td>3. ISS -এর প্রথম পাঁচটি Item->OMIS->Reports->View Report->Reconciliation->CIBTA Statement(For ISS) -এ click করে Year এবং last submission month select করে প্রাপ্ত Report হতে Data নিতে হবে। </td></tr>";
		$msg.="<tr><td>4. Total Asset অবশ্যই Total Liability এর সমান হবে। </td></tr>";
		$msg.="<tr><td>5. Total Asset অবশ্যই Total Other asset এর চেয়ে বড় হবে।</td></tr>";
		$msg.="<tr><td>6. Total Asset অবশ্যই Total Loan Outstanding এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>7. Total Liability অবশ্যই Total Deposit এর চেয়ে বেশী হবে।</td></tr>";
		
		$msg.="<tr style='color:#ff4dd2;'><td>8. একই সাথে Head Office General Ledger Positive Balance (after netting off) এবং Head Office General Ledger Negative Balance (after netting off) তথ্য থাকতে পারে না। একটিতে তথ্য থাকলে অন্যটিতে অবশ্যই শ্যন্য (০) হবে।
				Netting off এর পরে অর্থাৎ  [(Asset Side এর H.O General A/C + H.O Central A/C + IBTA A/C+CIBTA A/C+IBFET A/C+OIBT A/C)-(Liability Side এর H.O General A/C+H.O Central A/C+IBTA A/C+CBTA A/C+IBFET A/C+OIBT A/C)] ফলাফল-</td></tr>
				<tr style='color:#ff4dd2;'><td>(a)	 বিয়োগফল ধনাত্বক হলে Absolute Value Head Office General Ledger Positive Balance (after netting off) এ বসবে এবং Head Office General Ledger Negative Balance (after netting off) এ শূন্য (০) বসবে।</td></tr>
				<tr style='color:#ff4dd2;'><td>(b)	বিয়োগফল ঋনাত্বক হলে Absolute Value অর্থাৎ ঋনাত্বক চিহ্ন বাদ দিয়ে শুধু সংখ্যাটি Head Office General Ledger Negative Balance (after netting off) এ বসবে এবং Head Office General Ledger Positive Balance (after netting off) এ শূন্য (০) বসবে।</td></tr>
			";
		
		$msg.="<tr><td>9. Total Loan Outstanding অবশ্যই  (Standard Amount +SMA Amount + SS Amount + DF Amount + BL Amount) এর সমান হবে। অন্যথায় Total loan outstanding এবং (Standard Amount + SMA Amount + SS Amount + DF Amount + BL  Amount) এর বিয়োগফল Standard Amount সাথে যোগ করে সমন্বয় করতে হবে।</td></tr>";
		$msg.="<tr><td>10. Total Loan Outstanding অবশ্যই  (Total Manufacturing and Industrial Loan Outstanding+ Total Service Loan Outstanding + Total Non-Manufacturing and Trade Loan Outstanding) এর যোগফলের সমান হবে।</td></tr>";
		$msg.="<tr><td>11. Total Loan Outstanding অবশ্যই  (Total Asset backed Loan Outstanding +Total Guarantee Backed(and Unsecured) Loan Outstanding) এর যোগফলের সমান হবে।</td></tr>";
		$msg.="<tr><td>12. Total Loan Outstanding অবশ্যই  Total Outstanding Amount of Top 50 Loans এর যোগফলের বেশী অথবা সমান হবে।</td></tr>";
		
		$msg.="<tr><td>13. Total Off Balance Sheet Exposure অবশ্যই (Acceptance and Endorsement + Letters of Guarantee + Irrevocable Letters of Credit + Bills for Collection + Other Contingent Liabilities + Other Commitments + Short Term Trade-related Transactions + Forward Assets Purchased) এর যোগফলের সমান হবে।</td></tr>";
		$msg.="<tr><td>14. Total NPL Amount অবশ্যই Overdue Loan Amount এর চেয়ে বেশি হবে না।</td></tr>";
		$msg.="<tr><td>15. Total NPL Amount অবশ্যই ( SS Amount +DF Amount +BL  Amount ) এর যোগফলের সমান হবে।</td></tr>";
		$msg.="<tr><td>16. Total Security Value Against Loan অবশ্যই Total Security Value Against Classified Loan এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>17. Total Rescheduled Loan Outstanding অবশ্যই  Total Rescheduled Loan Outstanding Presently UC  এবং  Total Rescheduled Loan Outstanding Presently NP এর যোগফলের সমান হবে।</td></tr>";
		$msg.="<tr><td>18. Total Income অবশ্যই  Total  Interest Income এবং Total Non-interest income এর যোগফলের সমান হবে।</td></tr>";
		$msg.="<tr><td>19. Total other expenditure , Total Expenditure এর 10% এর বেশি হওয়া বাঞ্ছনীয় নয়।</td></tr>";
		
		$msg.="<tr><td>20. Total Number of Deposit Account অবশ্যই Total Number of 10 Tk. Account এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>21. Total Number of 10 Tk. Account অবশ্যই Total Number of non-operative 10 Tk. Account এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>22. Total Security Value Against Loan অবশ্যই Total Asset backed Loan Outstanding এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>23. Total outstanding Balance of Issued Bank Guarantee অবশ্যই  (Total Performance Guarantee Local + Total Other Guarantee Local + Total Performance Guarantee Foreign + Total Other Guarantee Foreign) এর যোগফলের সমান হবে।</td></tr>";
		$msg.="<tr><td>24. (a) Total Income অবশ্যই  শূন্য (০) এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>24. (b) Total Interest Income অবশ্যই  শূন্য (০) এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>24. (c) Total Non-interest Income অবশ্যই  শূন্য (০) এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>24. (d) Cash-Vault Limit অবশ্যই  শূন্য (০) এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>24. (e) Cash in Vault অবশ্যই  শূন্য (০) এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>24. (f) Local Currency in Vault অবশ্যই  শূন্য (০) এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>24. (g) Cash Transit Limit অবশ্যই  শূন্য (০) এর চেয়ে বেশী হবে।</td></tr>";
		$msg.="<tr><td>24. (h) Total Number of Employee of the Branch অবশ্যই  শূন্য (০) এর চেয়ে বেশী হবে।</td></tr>";
		
		$msg.="<tr><td>25. Xls file কে csv হিসেবে save করার জন্য File Save as -> Save as type এর csv(Comma delimited) select করে save করতে হবে। csv ফাইল কোন অবস্থাতেই edit করা যাবে না।</td></tr>";
		$msg.="</table>";	
		$msg.="</fieldset>";	
		
		$msg.="<fieldset style='border:px solid #ccc;'>";
		$msg.="<table>";	
		$msg.="<legend style='color:Red;font-weight:700;font-size:20px;'>"."যোগাযোগ"."</legend>";
		$msg.="<tr style='color:green;font-weight:700;font-size:20px;'><td>OMIS এ আইএসএস রিপোর্ট ও প্রত্যয়ন সংক্রান্ত কোন সমস্যা হলে নিম্নের অফিসারদের সাথে যোগাযেগ করার জন্য অনুরোধ করা হলোঃ</td></tr>";
		$msg.="<tr style='color:red;font-weight:700;font-size:16px;'><td>১.  জনাব, বীরেন্দ্র চন্দ্র সরকার, এজিএম, মোবাইল ফোন-০১৫৫২৩৬০৫৫০</td></tr>";
		$msg.="<tr style='color:red;font-weight:700;font-size:16px;'><td>২.  জনাব, মোহাম্মদ বাহাউদ্দিন, এফএজিএম(কম্পিঃ), মোবাইল ফোন- ০১৭৩৩২৩৯৬৪৩</td></tr>";
		$msg.="<tr style='color:red;font-weight:700;font-size:16px;'><td>৩.  জনাব, বিভাঙ্কর চন্দ্র সরকার, এফএজিএম, মোবাইল ফোন- ০১৮১৭৬৩৪৬৭৯</td></tr>";
		$msg.="<tr style='color:red;font-weight:700;font-size:16px;'><td>৪.  জনাব, মোঃ বদিউজ্জামান মীর, এফএজিএম- ০১৭১৫৩১৫৩৪০</td></tr>";
		$msg.="<tr style='color:red;font-weight:700;font-size:16px;'><td>৫.  জনাব, আসমা আহম্মেদ, ইও- ০১৬৭০০৪৯১৬৮</td></tr>";
		$msg.="<tr style='color:red;font-weight:700;font-size:16px;'><td>৬.  জনাব, আসমা আহম্মেদ, ইও- ০১৬৭০০৪৯১৬৮</td></tr>";
		$msg.="<tr style='color:red;font-weight:700;font-size:16px;'><td>৭. জনাব,রিহাজুল ইসলাম, ইও (কম্পিঃ), মোবাইলঃ ০১৯১৮০৮৯৪৫৪</td></tr>";
		$msg.="<tr style='color:red;font-weight:700;font-size:16px;'><td>৮. জনাব, মীর মোঃ নাসের, ইও, মোবাইলঃ ০১৭১৬৩৫০২২৩</td></tr>";
		$msg.="<tr style='color:red;font-weight:700;font-size:16px;'><td>৯. জনাব, মোঃ ওয়াহেদ খান, ইও, মোবাইলঃ ০১৮১৯১৩৮২৯৪</td></tr>";
		$msg.="<tr style='color:red;font-weight:700;font-size:16px;'><td>১০. জনাব, মোঃ হুমায়ুন কবির, এইও, মোবাইলঃ ০১৭১৩১১৪১৪৭</td></tr>";
		$msg.="</table>";	
		$msg.="</fieldset>";
		echo $msg;
	?>
	
  </body>
</html>
