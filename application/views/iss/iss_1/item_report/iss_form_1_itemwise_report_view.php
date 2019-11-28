    <script type="text/javascript">
    jQuery(document).ready(function() {
        var report_option_selector = jQuery('#report_option_selector').val();
        if(report_option_selector>0)
        {
            control_iss_2_form(report_option_selector);
        }
    });

    function addRow(tableID) {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var colCount = table.rows[2].cells.length;

            for(var i=0; i<colCount; i++) {

                var newcell = row.insertCell(i);

                newcell.innerHTML = table.rows[2].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            }
        }

        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];

                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }

            }
            }catch(e) {
                alert(e);
            }
        }
    </script>
    <style>
        table#search_form_table_iss2_1 {margin-left: -188px;}
        table#search_form_table_iss2_1 td {
            width: 170px;
        }
        table#search_form_table_iss2_1 select {
            width:  170px;
            border: none;
        }
        table#search_form_table_iss2_2 {
            margin-left: -188px;
            width: 707px;
        }
    </style>
    <?php
    echo "<table align =center id=\"tbldesgTarget\"><tr><th>Integrated Supervision System Comparision Report</th></tr></table>";
    echo "</table>";

    echo form_open('iss/iss_form_1_itemwise_report_details','id="iss_item_search_form"');
    ?>

    <table border="1" style="margin-top: 50px;" id="search_form_table_n">
        <tr>
            <th COLSPAN="4">
             <h3 style="color: green;">FILL FORM FOR ISS FORM-1 ITEM WISE REPORT</h3>
        </th>
        <td>
            <INPUT type="button" style="font-size:12px; background-color:#1DBFAF; color: #fff; height:35px; border:none" value="Add New Item" onclick="addRow('search_form_table_n')" /></td>
            <td><INPUT type="button" style="font-size:12px; background-color:#DC143C; color: #fff; height:35px; border:none" value="Delete Item" onclick="deleteRow('search_form_table_n')" /></td>
        </tr>
        <tr>
            <td></td>
            <td>ISS Form-1 Item Of</td>
            <td COLSPAN="">
                <?php
                    echo '<select name="report_of_iss1_item[]" id="report_of_iss1_item" style="width:555px;height:35px;font-size:18px">';
                    echo '<option value="">Select ISS Form-1 Item</option>';
                    foreach($form1_iss_item as $row_iss1item)
                    {
                        $select='';
                        if(isset($_POST['report_of_iss1_item']) && $_POST['report_of_iss1_item']==$row_iss1item->SUPERVISION_COA_ID)
                        {
                            $select="selected='selected'";
                        }
                      echo '<option value="'.$row_iss1item->SUPERVISION_COA_ID.'" '.$select.'>'.'('.$row_iss1item->SL.') '.$row_iss1item->COA_DESCRIPTION.'</option>';

                    }
                    echo '</select>';
                ?>
            </td>
        </tr>
        <tr>
            <td><INPUT type="checkbox" name="chk"/></td>
            <td>ISS Form-1 Item Of </span></td>
            <td COLSPAN="">
                <?php
                    echo '<select name="report_of_iss1_item[]" id="report_of_iss1_item" style="width:555px;height:35px;font-size:18px">';
                    echo '<option value=" ">Select ISS Form-2 Item</option>';
                    foreach($form1_iss_item as $row_iss1item)
                    {
                        $select='';
                        if(isset($_POST['report_of_iss1_item']) && $_POST['report_of_iss1_item']==$row_iss1item->SUPERVISION_COA_ID)
                        {
                            $select="selected='selected'";
                        }
                      echo '<option value="'.$row_iss1item->SUPERVISION_COA_ID.'" '.$select.'>'.'('.$row_iss1item->SL.') '.$row_iss1item->COA_DESCRIPTION.'</option>';

                    }
                    echo '</select>';
                ?>
            </td>
        </tr>
    </table>
    <table border="1" style="" id="search_form_table_iss2_1">
        <tr id="report_of_year_div">
            <td>Report Of Date</td>
            <td>
            <?php
                echo '<select name="report_of_date1" id="report_of_date1" style="height:35px;font-size:18px">';
                echo '<option value="">Select Date</option>';
                foreach($records3 as $row)
                {
                    $select='';
                    if(isset($_POST['report_of_date1']) && $_POST['report_of_date1']==$row->ISSEntryDate)
                    {
                        $select="selected='selected'";
                    }
                  echo '<option value="'.$row->ISSEntryDate.'" '.$select.'>'.$row->ISSEntryDate.'</option>';

                }
                echo '</select>';
                ?>
            </td>
            <td>and/to</td>
            <td>
            <?php
                echo '<select name="report_of_date2" id="report_of_date2" style="height:35px;font-size:18px">';
                echo '<option value="">Select Date</option>';
                foreach($records3 as $row)
                {
                    $select='';
                    if(isset($_POST['report_of_date2']) && $_POST['report_of_date2']==$row->ISSEntryDate)
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
     <table border="1" style="" id="search_form_table_iss2_2">
        <tr id="report_of_br_ao_do_div">
            <td COLSPAN="6">
            <input type="button" name="view_report" id="view_report" value="View Report" style="background-color: #FF9900;" onclick="check_search_form_iss_1_item(this.value)"/>
            <input type="button" name="comparion_graph" id="comparion_graph" value="Graph" style="background-color: #FF9900;" onclick="check_search_form_iss_1_item(this.value)"/>
            </td>
        </tr>

    </table>
    <input type="hidden" name="login_office_status" id="login_office_status" value="<?php echo $login_office_status; ?>" />
    <input type="hidden" name="report_click_btn" id="report_click_btn" value="0" />
    <input type="hidden" name="amt_ind_hid" id="amt_ind_hid" value=" "/>
    <!--<input type="hidden" name="report_of_iss2_item[]" id="report_of_iss2_item" value="0" />-->
    <?php echo '</form>'; ?>