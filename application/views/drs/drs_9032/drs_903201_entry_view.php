<?php
$natureOfLoans = array(
    "903201601" =>'Credit Card',
    "903201602" =>'SOD(FO)',
    "903201603" =>'SOD(RE)',
    "903201604" =>'CC(H)',
    "903201605" =>'CC(P)',
    "903201606" =>'ECC(H)',
    "903201607" =>'ECC(P)',
    "903201608" =>'CC(Weavers)',
    "903201609" =>'Others'
);
// $natureOfLoans = array(
//     "903201601" =>'ক্রডেটি র্কাড',
//     "903201602" =>'এসওডি (এফও)',
//     "903201603" =>'এসওডি (আরই)',
//     "903201604" =>'সসি(িহাঃ)',
//     "903201605" =>'সসি(িপ্লজে)',
//     "903201606" =>'ইসসি(িহাঃ)',
//     "903201607" =>'ইসসি(িপ্লজে)',
//     "903201608" =>'সসি(িওয়ভোর)',
//     "903201609" =>'অন্যান্য'
// );
/**
 * ঋণরে প্রকৃতি
 * ক্রডেটি র্কাড 
 * */
?>
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


<?php echo form_open('drs/drs_903201_data_save_ctrler', 'class="" id="drs_903201_entry_id"'); ?>
    <div class="drs_9030_css_0102">
        <ul>
        </ul>
    </div>
    <?php 
        if($login_office_status == 4) {
    ?>
    <table  align="right">
        <tr align="center"><th><a href="javascript:history.back();">Back</a></th></tr>
    </table>
    <p>Input Template</p>
<table id="recove_1">
    <tr>
        <td>১</td>
        <td><label for="drs903201_date">তথ্য প্রদানের তারিখ </label></td>
        <td>
            <input type="date" name="drs903201_date" id="drs903201_date" value="<?php echo date('Y-m-d'); ?>" class=""><span style="font-size:12px">(DD/MM/YYYY)</span>
        </td>
    </tr>            
    <tr>
        <td>২</td>
        <td><label for="drs_90320103">ঋণ হিসাবের নাম </label></td>
        <td><input type="text" name="drs_90320103" id="drs_90320103" class="" placeholder="ঋণ হিসাবের নাম"></td>
    </tr>
    <tr>  
        <td>৩</td>
        <td><label for="drs_90320104">প্রতিষ্ঠানের মালিকের নাম </label></td>
        <td><input type="text" name="drs_90320104" id="drs_90320104" class="" placeholder="প্রতিষ্ঠানের মালিকের নাম"></td>
    </tr>
    <tr>
        <td>৪</td>        
        <td><label for="drs_90320105">বর্তমান ঠিকানা </label></td>
        <td><textarea name="drs_90320105" id="drs_90320105" rows="2" placeholder="বর্তমান ঠিকানা"></textarea></td>
    </tr>
    <tr>
        <td>৫</td>        
        <td><label for="drs_90320106">স্থায়ী  ঠিকানা </label></td>
        <td><textarea name="drs_90320106" id="drs_90320106" rows="2" placeholder="স্থায়ী  ঠিকানা"></textarea></td>
    </tr>
    <tr>
        <td>৬</td>       
        <td><label for="drs_90320107">মোবাইল ফোন নম্বর </label></td>
        <td><input type="text" name="drs_90320107" id="drs_90320107" class="" placeholder="মোবাইল ফোন নম্বর"></td>
    </tr>
    <tr>
        <td><span>৭</span></td>
        <td><label for="drs_90320108">ঋণের প্রকৃতি </label></td>
        <td colspan="3">
            <!--<input type="text" name="drs_90320108" id="drs_90320108" class="" placeholder="ঋণের প্রকৃতি">-->
            <select name="drs_90320108" id="drs_90320108" style="height: 35px;width: 200px;border: 0;font-size: 20px;">
                <option value="0">Select nature of Loan </option>
                <?php
                 foreach($natureOfLoans as $key=>$natureOfLoan){
                    echo '<option value="'.$key.'">'.$natureOfLoan.'</option>';
                }
                ?>
            </select>
            </td>
    </tr>
    <tr>
        <td><span>৮</span></td>
        <td><label for="drs_90320109">সেক্টরের নাম(As per SBS-3) </label></td>
        <td colspan="3"><input type="text" name="drs_90320109" id="drs_90320109" class="" placeholder="সেক্টরের নাম(As per SBS-3)"></td>
    </tr>
    <tr>
        <td><span>৯</span></td>
        <td><label for="drs_90320110">ঋণ অনুমোদনের পরিমান(Sanctioned Amount) </label></td>
        <td colspan="3"><input type="text" name="drs_90320110" id="drs_90320110" class="" placeholder="ঋণ অনুমোদনের পরিমান(Sanctioned Amount)"></td>
    </tr>
    <tr>
        <td><span>১০</span></td>
        <td><label for="drs_90320111">অবলোপনকৃত ঋণের পরিমান </label></td>
        <td><input type="number" name="drs_90320111" id="drs_90320111" class="" step="0.01" placeholder="অবলোপনকৃত ঋণের পরিমান"></td>
    </tr>
    <tr>
        <td><span>১১</span></td>
        <td><label for="drs_90320112">অবলোপনকৃত ঋণের তারিখ</label></td>
        <td><input type="date" name="drs_90320112" id="drs_90320112" class=""><span style="font-size:12px">(DD/MM/YYYY)</span></td>
    </tr>
    <tr>
        <td><span>১২</span></td>
        <td><label for="drs_90320113">সুদ নিলম্বন খাতে রক্ষিত টাকা</label></td>
        <td><input type="number" name="drs_90320113" id="drs_90320113" class="" placeholder="সুদ নিলম্বন খাতে রক্ষিত টাকা"> </td>
    </tr>
    <tr>
        <td><span>১৩</span></td>
        <td><label for="drs_90320114">প্রবিশন খাত ডেবিটের পরিমান</label></td>
        <td><input type="number" name="drs_90320114" id="drs_90320114" class="" placeholder="প্রবিশন খাত ডেবিটের পরিমান"></td>
    </tr>
    <tr>
        <td><span>১৪</span></td>
        <td><label for="drs_90320115">অবলোপনের পর হতে পূর্ববর্তী বছর পর্যন্ত আদায়-নগদ</label></td>
        <td><input type="number" name="drs_90320115" id="drs_90320115" class="" step="0.01" onkeyup="drs_90320117_auto_sum_function()" onchange="drs_90320117_auto_sum_function()" placeholder="অবলোপনের পর হতে পূর্ববর্তী বছর পর্যন্ত আদায়-নগদ"></td>
    </tr>
    <tr>
        <td><span>১৫</span></td>
        <td><label for="drs_90320116">অবলোপনের পর হতে পূর্ববর্তী বছর পর্যন্ত আদায়-সমন্বয়</label></td>
        <td><input type="number" name="drs_90320116" id="drs_90320116" class="" onkeyup="drs_90320117_auto_sum_function()"  onchange="drs_90320117_auto_sum_function()" placeholder="অবলোপনের পর হতে পূর্ববর্তী বছর পর্যন্ত আদায়-সমন্বয়"></td>
    </tr>
    <tr>
        <td><span>১৬</span></td>
        <td><label for="drs_90320117">অবলোপনের পর হতে পূর্ববর্তী বছর পর্যন্ত আদায়-মোট</label></td>
        <td><input type="text" name="drs_90320117" id="drs_90320117" class="" style="text-align:right; background-color:#dddddd" step="0.01" readonly placeholder="অবলোপনের পর হতে পূর্ববর্তী বছর পর্যন্ত আদায়-মোট"></td>
    </tr>
    <tr>
        <td><span>১৭</span></td>
        <td><label for="drs_90320118">বর্তমান বছরে পূর্ববর্তী মাস পর্যন্ত আদায়-নগদ</label></td>
        <td><input type="number" name="drs_90320118" id="drs_90320118" class="" step="0.01" placeholder="বর্তমান বছরে পূর্ববর্তী মাস পর্যন্ত আদায়-নগদ"></td>
    </tr>
    <tr>
        <td><span>১৮</span></td>
        <td><label for="drs_90320119">অবলোপনের পর হতে পূর্ববর্তী বছর পর্যন্ত আদায়-সমন্বয়</label></td>
        <td><input type="number" name="drs_90320119" step="0.01" id="drs_90320119" class="" placeholder="অবলোপনের পর হতে পূর্ববর্তী বছর পর্যন্ত আদায়-সমন্বয়"></td>
    </tr>
    <tr>
        <td><span>১৯</span></td>
        <td><label for="drs_90320120">অবলোপনের পর হতে পূর্ববর্তী বছর পর্যন্ত আদায়-মোট</label></td>
        <td><input type="number" name="drs_90320120" id="drs_90320120" class="" step="0.01" placeholder="অবলোপনের পর হতে পূর্ববর্তী বছর পর্যন্ত আদায়-মোট"></td>
    </tr>
    <tr>
        <td><span>২০</span></td>
        <td><label for="drs_90320121">শুধু চলতি মাসে আদায়-নগদ</label></td>
        <td><input type="number" name="drs_90320121" id="drs_90320121"  onkeyup="drs_90320123_auto_sum_function()"  onchange="drs_90320123_auto_sum_function()" class="" step="0.01" placeholder="শুধু চলতি মাসে আদায়-নগদ"></td>
    </tr>
    <tr>
        <td><span>২১</span></td>
        <td><label for="drs_90320122">শুধু চলতি মাসে আদায়-সমন্বয়</label></td>
        <td><input type="number" name="drs_90320122" id="drs_90320122" onkeyup="drs_90320123_auto_sum_function()"  onchange="drs_90320123_auto_sum_function()" class="" step="0.01" placeholder="শুধু চলতি মাসে আদায়-সমন্বয়"></td>
    </tr>
    <tr>
        <td><span>২২</span></td>
        <td><label for="drs_90320123">শুধু চলতি মাসে আদায়-মোট</label></td>
        <td><input type="text" name="drs_90320123" id="drs_90320123" class="" style="text-align:right; background-color:#dddddd" step="0.01" readonly placeholder="শুধু চলতি মাসে আদায়-মোট"></td>
    </tr>
    <tr>
        <td><span>২৩</span></td>
        <td><label for="drs_90320124">সর্বমোট আদায়-নগদ</label></td>
        <td><input type="number" name="drs_90320124" id="drs_90320124" step="0.01" onkeyup="drs_90320126_auto_sum_function()"  onchange="drs_90320126_auto_sum_function()" class="" placeholder="সর্বমোট আদায়-নগদ"></td>
    </tr>
    <tr>
        <td><span>২৪</span></td>
        <td><label for="drs_90320125">সর্বমোট আদায়-সমন্বয়</label></td>
        <td><input type="number" name="drs_90320125" id="drs_90320125" class="" step="0.01" onkeyup="drs_90320126_auto_sum_function()"  onchange="drs_90320126_auto_sum_function()" placeholder="সর্বমোট আদায়-সমন্বয়"></td>
    </tr>
    <tr>
        <td><span>২৫</span></td>
        <td><label for="drs_90320126">সর্বমোট আদায়-মোট</label></td>
        <td><input type="text" readonly name="drs_90320126" id="drs_90320126" class="" style="text-align:right; background-color:#dddddd" step="0.01" placeholder="সর্বমোট আদায়-মোট"></td>
    </tr>
    <tr>
        <td><span>২৬</span></td>
        <td><label for="drs_90320127">আদায়ের পর স্থিতি</label></td>
        <td><input type="number" name="drs_90320127" id="drs_90320127" class="seventy_px" placeholder="আদায়ের পর স্থিতি"></td>
    </tr>
    <tr>
        <td><span>২৭</span></td>
        <td><label for="drs_90320128">লেজার দায়ের অতিরিক্ত আদায় হলে তার পরিমাণ </label></td>
        <td><input type="number" name="drs_90320128" id="drs_90320128" class="seventy_px" placeholder="লেজার দায়ের অতিরিক্ত আদায় হলে তার পরিমাণ "></td>
    </tr>
    <tr>
        <td><span>২৮</span></td>
        <td><label for="drs_90320129">লেজার দায়ের অতিরিক্ত আদায় হলে তার বিবরণ</label></td>
        <td><textarea name="drs_90320129" id="drs_90320129" class="seventy_px" placeholder="লেজার দায়ের অতিরিক্ত আদায় হলে তার বিবরণ"></textarea></td>
    </tr>
    <tr>
        <td><span>২৯</span></td>
        <td><label for="drs_90320130">প্রধান কার্যালয়ের প্রেরিত টাকার পরিমাণ</label></td>
        <td><input type="number" name="drs_90320130" class="" id="drs_90320130" placeholder="প্রধান কার্যালয়ের প্রেরিত টাকার পরিমাণ"></td>
    </tr>
    <tr>
        <td><span>৩০</span></td>
        <td><label for="drs_90320131">প্রধান কার্যালয়ের প্রেরিত এ্যাডভাইজিং নং</label></td>
        <td><input type="text" name="drs_90320131" id="drs_90320131" class="" placeholder="প্রধান কার্যালয়ের প্রেরিত এ্যাডভাইজিং নং"></td>
    </tr>
    <tr>
        <td><span>৩১</span></td>
        <td><label for="drs_90320132">প্রধান কার্যালয়ের প্রেরিত এ্যাডভাইজিং তারিখ</label></td>
        <td><input type="date"  name="drs_90320132" id="drs_90320132" class="seventy_px"><span style="font-size:12px">(DD/MM/YYYY)</span></td>
    </tr>
    <tr>
        <td><span>৩২</span></td>
        <td><label for="drs_90320133">শাখার আয় খাতে নীত টাকার পরিমাণ</label></td>
        <td><input type="number" name="drs_90320133" id="drs_90320133" class="" step="0.01" placeholder="শাখার আয় খাতে নীত টাকার পরিমাণ"></td>
    </tr>
    <tr>
        <td><span>৩৩</span></td>
        <td><label for="drs_90320134">অন্য কোন খাতে রক্ষিত  হলে তার বিবরণ</label></td>
        <td><input type="text" name="drs_90320134" id="drs_90320134" class="" step="0.01" placeholder="অন্য কোন খাতে রক্ষিত  হলে তার বিবরণ"></td>
    </tr>
    <tr>
        <td><span>৩৪</span></td>
        <td><label for="drs_90320135">ব্যবসা/কারখানার বর্তমান অবস্থা? হাঁ/না</label></td>
        <td>
            <span><input type="radio" name="drs_90320135" value="1">হাঁ</span>
            <span><input type="radio" name="drs_90320135" value="0"> না</span>
        </td>
    </tr>
    <tr>
        <td><span>৩৫</span></td>
        <td><label for="drs_90320136" style="">জামানতের বিবরণ</label></td>
        <td><textarea name="drs_90320136" id="drs_90320136" class="" placeholder="জামানতের বিবরণ"></textarea></td>
    </tr>
    <tr>
        <td><span>৩৬</span></td>
        <td><label for="drs_90320137">জামানতের মূল্য</label></td>
        <td><input type="number" name="drs_90320137" id="drs_90320137" class="" placeholder="জামানতের মূল্য"></td>
    </tr>
    <tr>
        <td><span>৩৭</span></td>
        <td><label for="drs_90320138">সহজামানতের বিবরণ</label></td>
        <td><textarea name="drs_90320138" id="drs_90320138" class="" placeholder="সহজামানতের বিবরণ"></textarea></td>
    </tr>
    <tr>
        <td><span>৩৮</span></td>
        <td><label for="drs_90320139">সহজামানতের মূল্য</label></td>
        <td><input type="number" name="drs_90320139" id="drs_90320139" class="" placeholder="সহজামানতের মূল্য"></td>
    </tr>
    <tr>
        <td><span>৩৯</span></td>
        <td><label for="drs_90320140">মামলার অবস্থা-মূল মামরার নম্বর</label></td>
        <td><input type="number" name="drs_90320140" id="drs_90320140" class="" placeholder="মূল মামরার নম্বর"></td>
    </tr>
    <tr>
        <td><span>৪০</span></td>
        <td><label for="drs_90320141">মামলার অবস্থা-মূল মামলা দায়েরের তারিখ</label></td>
        <td><input type="date" name="drs_90320141" id="drs_90320141" class=""><span style="font-size:12px">(DD/MM/YYYY)</span></td>
    </tr>
    <tr>
        <td><span>৪১</span></td>
        <td><label for="drs_90320142">মামলার অবস্থা-জড়িত টাকার পরিমাণ</label></td>
        <td><input type="number" name="drs_90320142" id="drs_90320142" class="" placeholder="জড়িত টাকার পরিমাণ"></td>
    </tr>
    <tr>
        <td><span>৪২</span></td>
        <td><label for="drs_90320143">মামলার অবস্থা-জারী মামলার নম্বর</label></td>
        <td><input type="text" name="drs_90320143" id="drs_90320143" class="" placeholder="জারী মামলার নম্বর"></td>
    </tr>
    <tr>
        <td><span>৪৩</span></td>
        <td><label for="drs_90320144">মামলার অবস্থা-জারী মামলা দায়েরের তারিখ</label></td>
        <td><input type="date" name="drs_90320144" id="drs_90320144" class=""><span style="font-size:12px">(DD/MM/YYYY)</span></td>
    </tr>
    
    <tr>
        <td><span>৪৪</span></td>
        <td><label for="drs_90320145">মামলার অবস্থা-জড়িত টাকার পরিমাণ</label></td>
        <td><input type="number" name="drs_90320145" id="drs_90320145" class="" placeholder="জড়িত টাকার পরিমাণ"></td>
    </tr>
    <tr>
        <td><span>৪৫</span></td>
        <td><label for="drs_90320146">রীট নং</label></td>
        <td><input type="text" name="drs_90320146" id="drs_90320146" class="" placeholder="রীট নং"></td>
    </tr>
    <tr>
        <td><span>৪৬</span></td>
        <td><label for="drs_90320147">রীট জড়িত টাকার পরিমাণ</label></td>
        <td><input type="number" name="drs_90320147" id="drs_90320147" class="" placeholder="রীট জড়িত টাকার পরিমাণ"></td>
    </tr>
    <tr>
        <td><span>৪৭</span></td>
        <td><label for="drs_90320148">মামলার সর্বশেষ অবস্থা সম্পর্কে সুনির্দিষ্ট সংক্ষিপ্ত তথ্য (রীট ইত্যাদি সহ)</label></td>
        <td><textarea name="drs_90320148" id="drs_90320148" class="" placeholder="মন্তব্য"></textarea></td>
    </tr>
    <tr>
        <td><span>৪৮</span></td>
        <td><label for="drs_90320149">মন্তব্য</label></td>
        <td><textarea name="drs_90320149" id="drs_90320149" class="" placeholder="মন্তব্য"></textarea></td>
    </tr>
    <tr>
    <td></td>
    <td></td>
        <td>
            <?php //echo form_submit('mysubmit', 'Submit'); ?>
            <input type="button" id="drs903201_submit_btn" value="Submit" onclick="control_drs903201_form_mode(this.value)">
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

function drs_90320117_auto_sum_function(){
        var drs_90320115_Val = 0;
        var drs_90320116_Val = 0;
        
        var drs90320117_Val = 0;
        drs_90320115_Val = document.getElementById("drs_90320115").value;
        drs_90320116_Val = document.getElementById("drs_90320116").value;
        if(IsNumeric(drs_90320115_Val) && drs_90320115_Val !=""){
            drs_90320115_Val = parseFloat(drs_90320115_Val);
            drs90320117_Val += drs_90320115_Val;
        }
        if(IsNumeric(drs_90320116_Val) && drs_90320116_Val !=""){
            drs_90320116_Val = parseFloat(drs_90320116_Val);
            drs90320117_Val += drs_90320116_Val;
        }
        
        jQuery("#drs_90320117").val(parseFloat(drs90320117_Val).toFixed(2));
    }
    function drs_90320123_auto_sum_function(){
        var drs_90320121_Val = 0;
        var drs_90320122_Val = 0;
        
        var drs_90320123_Val = 0;
        drs_90320121_Val = document.getElementById("drs_90320121").value;
        drs_90320122_Val = document.getElementById("drs_90320122").value;
        if(IsNumeric(drs_90320121_Val) && drs_90320121_Val !=""){
            drs_90320121_Val = parseFloat(drs_90320121_Val);
            drs_90320123_Val += drs_90320121_Val;
        }
        if(IsNumeric(drs_90320122_Val) && drs_90320122_Val !=""){
            drs_90320122_Val = parseFloat(drs_90320122_Val);
            drs_90320123_Val += drs_90320122_Val;
        }
        
        jQuery("#drs_90320123").val(parseFloat(drs_90320123_Val).toFixed(2));
    }
    function drs_90320126_auto_sum_function(){
        var drs_90320124_Val = 0;
        var drs_90320125_Val = 0;
        
        var drs_90320126_Val = 0;
        drs_90320124_Val = document.getElementById("drs_90320124").value;
        drs_90320125_Val = document.getElementById("drs_90320125").value;
        if(IsNumeric(drs_90320124_Val) && drs_90320124_Val !=""){
            drs_90320124_Val = parseFloat(drs_90320124_Val);
            drs_90320126_Val += drs_90320124_Val;
        }
        if(IsNumeric(drs_90320125_Val) && drs_90320125_Val !=""){
            drs_90320125_Val = parseFloat(drs_90320125_Val);
            drs_90320126_Val += drs_90320125_Val;
        }
        
        jQuery("#drs_90320126").val(parseFloat(drs_90320126_Val).toFixed(2));
    }
function control_drs903201_form_mode(params) {
    let date_val = document.getElementById("drs903201_date").value;
    let drs_90320108_val = document.getElementById("drs_90320108").value;
    let drs_90320112_val = document.getElementById("drs_90320112").value;
    let drs_90320132_val = document.getElementById("drs_90320132").value;
    let drs_90320135_val = document.querySelector('input[name = "drs_90320135"]:checked');
    
    if(date_val != ""){
        if(drs_90320108_val != 0){
            if(drs_90320112_val !="" ){
                if( drs_90320132_val !="" ){
                    if(drs_90320135_val != null){  
                        jQuery('#drs_903201_entry_id').submit();
                        // let drs_90320111_val = document.getElementById("drs_90320111").value;
                        // if(!isNaN(drs_90320111_val) && typeof drs_90320111_val === "number"){
                        //     jQuery('#drs_903201_entry_id').submit();
                        // }else{
                        //     alert('Please Checked Digit.'); 
                        //     document.getElementById("drs_90320111").focus();
                        // }
                        
                    } else {
                        alert('Please Checked present of Business.'); 
                        document.getElementById("drs_90320135").focus();
                    }
                }else{
                    alert("Please Fill Consent to HO date");
                    document.getElementById("drs_90320132").focus();
                }
            }else{
                alert("Please Fill writen-off date");
                document.getElementById("drs_90320112").focus();
            }
        }else{
            alert("Please Nature of Loan");
            document.getElementById("drs_90320108").focus();
        }
        
    }else{
        alert("Please Select A Date");
        document.getElementById("drs903201_date").focus();
        return false;
    }
} 

function check_digit_input_form(){
    let check_d = 0;
    let drs_90320111_val = document.getElementById("drs_90320111").value;
    if(isNaN(drs_90320111_val) && typeof drs_90320111_val === "number"){
        check_d = 1;
    }
    return check_d;
}

</script>



