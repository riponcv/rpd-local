<style>

#rotate {
  -moz-transform: rotate(-90.0deg);
  -o-transform: rotate(-90.0deg);  /* Opera 10.5 */
  -webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
    filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
    -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */

    /*! width: 204px; */
/*! height: 207px; */
/*! margin-top: 1px; */
display: block;
  position: absolute;
  margin-left: -90px;
}

</style>
<script>
    (document).ready(function(){ 
    function myFunction( param ){
        var valL = $("#idval903002V_3").val(); 
        console.log(valL);
    }
});
</script>

<table  align="right">
    <tr align="center"><th><a href="javascript:history.back();">Back</a></th></tr>
</table>
<br/><br/><br/>
<?php if(isset($drs_90300102_list) && !empty($drs_90300102_list)) { ?>
    <?php $present_year = date('Y'); ?>
    <table border="1">            
        <tr>
            <th colspan="2">31.12.<?php echo isset($present_year)?($present_year-1):''; ?> স্থিতিভিত্তিক
               
                <tr>
                <?php foreach($drs_90300102_list as $single_90300102) { 
                    if( $single_90300102->prodGroupCode == 903001 ){
                    ?>
                    <td><?php 
                        $replace_str = '';
                        $replace_str = str_replace("2018", $present_year, $single_90300102->prodNameEn);
                        $replace_str = str_replace("2017", ($present_year-1), $replace_str);
                        
                        echo isset($replace_str)?$replace_str:''; 
                    ?></td>
                <?php } } ?>
                </tr>
            </th>
        </tr>
        <tr  align="center">
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9=(5-8)</td>
        </tr>
        <tr>
        <?php 
            $row_count = count( $drs_90300102_list );
            $row_count = $row_count/2;
            $info_9030_count = 1;
            foreach($drs_90300102_list as $single_90300102) { 
                if( $single_90300102->prodGroupCode == 903001 && $info_9030_count != $row_count) {
            ?>
            <input type="hidden" name="groupCode_903001[]" value="<?php echo $single_90300102->prodCode; ?>" id="">
            <td><input type="text" name="amt_903001[]" value="<?php echo $single_90300102->prodCode; ?>" id="idval_<?php echo $info_9030_count; ?>"></td>
            <?php 
            $info_9030_count++; 
                }  
            } ?>
            <td><input type="text" name="amt_903001_9" value="<?php echo $single_90300102->prodCode; ?>" id="idval903001_<?php echo $info_9030_count; ?>"></td>
        </tr>
    </table>
    <br/><br/><br/>
    <table border="1">          
        <tr>
            <th colspan="2">31.12.<?php echo isset($present_year)?($present_year-1):''; ?> স্থিতিভিত্তিক
                <!--<tr>
                    <td>মোট ঋণের পরিমান</td>
                    <td>অবলোপনকৃত ঋণের পরিমান</td>
                    <td>2018 সালে নগদ আদায়ের লক্ষমাত্রা</td>
                    <td>জানুয়ারী/18 হতে রিপোটিং মাস পর্যন্ত আনুপাতিক লক্ষমাত্রা</td>
                    <td>জানুয়ারী/18 হতে রিপোটিং মাস পর্যন্ত নগদ আদায়</td>
                    <td>অর্জনের হার (আনুপাতিক লক্ষমাত্রার উপর)</td>
                    <td>শুধুমাত্র রিপোটিং মাসে নগদ আদায়</td>
                    <td>2017 সালের একই মাস পর্যন্ত নগদ আদায়</td>
                    <td>2017 সালের সংশ্লিষ্ট মাস পর্যন্ত আদায়ের তুলনায় 2018 সালের রিপোটিং মাস পর্যন্ত নগদ আদায় এর হ্রাস/বৃদ্ধি</td>
                </tr>-->
                
                <tr>
                <?php foreach($drs_90300102_list as $single_90300102) { 
                    if( $single_90300102->prodGroupCode == 903002 ){
                    ?>
                    <td><?php 
                        $replace_str = '';
                        $replace_str = str_replace("2018", $present_year, $single_90300102->prodNameEn);
                        $replace_str = str_replace("2017", ($present_year-1), $replace_str);
                        
                        echo isset($replace_str)?$replace_str:''; 
                    ?></td>
                <?php } } ?>
                </tr>

            </th>
        </tr>
        <tr  align="center">
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9=(5-8)</td>
        </tr>
        <tr>
        <?php 
            $row_count = count( $drs_90300102_list );
            $row_count = $row_count/2;
            $info_9030_count = 1;
            foreach($drs_90300102_list as $single_90300102) { 
                if( $single_90300102->prodGroupCode == 903002 && $info_9030_count != $row_count) {
            ?>
            <input type="hidden" name="groupCode_903002[]" value="<?php echo $single_90300102->prodCode; ?>" id="">
            <td><input type="text" name="amt_903002[]" value="<?php echo $single_90300102->prodCode; ?>" id="idval903002_<?php echo $info_9030_count; ?>"></td>
            <?php 
            $info_9030_count++; 
                }  
            } ?>
            <td><input type="text" name="amt_903002_9" value="<?php echo $single_90300102->prodCode; ?>" id="idval903002_<?php echo $info_9030_count; ?>"></td>
        </tr>
    </table>        

<?php } ?>

<h1>Verticle Align</h1>
<?php if(isset($drs_90300102_list) && !empty($drs_90300102_list)) { ?>
<table border="1">
    <?php 
    $row_count = count( $drs_90300102_list );
    $row_count = $row_count/2;
    $info_9030_count = 1;
    foreach($drs_90300102_list as $row_data) {
         if( $row_data->prodGroupCode == 903001) { ?>
        <tr>
            <?php if($info_9030_count ==1 ){ ?>
            <td rowspan="2">31.12.<?php echo isset($present_year)?($present_year-1):''; ?> স্থিতিভিত্তিক</td>
            <td><?php echo  isset($info_9030_count)?$info_9030_count:''; ?></td>
            <?php } else{?>
                <?php if($info_9030_count !=2 ){ ?>
                    <td></td>
                <?php }?>
                <td><?php  
                    echo  isset($info_9030_count)?$info_9030_count:''; 
                    if($info_9030_count == 9){ echo "=(5-8)"; }
                    ?></td>
            <?php }?>
            <td><?php 
            $replace_str = '';
            $replace_str = str_replace("2018", $present_year, $row_data->prodNameEn);
            $replace_str = str_replace("2017", ($present_year-1), $replace_str);
            echo isset($replace_str)?$replace_str:''; 
            ?></td>
            <td><input type="text" name="amt_903002[]" value="<?php echo "238451"; ?>" onfocus="myFunction(this)" id="idval903002V_<?php echo $info_9030_count; ?>"></td>
        </tr>
    <?php 
        } 
        $info_9030_count++;
    } ?>
</table>
<?php } ?>

<?php
//echo "<pre>";
//print_r($drs_90300102_list);
//die();
?>