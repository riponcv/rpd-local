/** RBA report start */
//rba_0001 start
function control_rba_0001_report_form(ptr)
{

    jQuery('#search_text').val('');
    jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="6"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    if(ptr>0)
    {
        jQuery('#search_form_table').show('slow');
        if(ptr==1 || ptr==5 || ptr==7)
        {
          jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').hide('slow');
        }
        else
        {
            jQuery('#report_of_br_ao_do_div_box,#report_of_br_ao_do_div_msg').show('slow');

        }

    }
    else
    {
      jQuery('#search_form_table').hide('slow');
    }
}

function check_search_form_rba_0001(str)
{
    if(str !='')
    {
      var report_option_selector = jQuery('#report_option_selector').val();
      if(report_option_selector==1 || report_option_selector==5)
      {
        var report_year1 = jQuery('#report_of_year1').val();
        var report_month1 = jQuery('#report_of_month1').val();
		var report_year2 = jQuery('#report_of_year2').val();
        var report_month2 = jQuery('#report_of_month2').val();
        if(report_year1 !='' && report_year2 !='' && report_month1 !='' && report_month2 !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#rba_0001_search_form').submit();
        }
        else
        {
            if(report_year1 =='')
            {
                alert('Select Year Of Report.');
            }
            else
            {
              alert('Select Month Of Report.');
            }
        }
      }
      else
      {
        var br_ao_do=0;
        if(jQuery("input[name='report_report_office_id']:checked").val()>0)
        {
            br_ao_do = jQuery("input[name='report_report_office_id']:checked").val();
        }
        var report_year1 = jQuery('#report_of_year1').val();
        var report_month1 = jQuery('#report_of_month1').val();
		var report_year2 = jQuery('#report_of_year2').val();
        var report_month2 = jQuery('#report_of_month2').val();
        var br_ao_do_text=jQuery('#search_text').val();

        if(br_ao_do !='0' && report_year1 !='' && report_year2 !='' && br_ao_do_text !='' && report_month1 !='' && report_month2 !='')
        {
            var report_click_btn=0;
            if(str=='View Report'){report_click_btn=1;}
            if(str=='Save Report As PDF'){report_click_btn=2;}
            jQuery('#report_click_btn').val(report_click_btn);
            jQuery('#rba_0001_search_form').submit();
        }
        else
        {
            alert('First Fill The Search Form Properly.');
        }
      }
    }
 }

function fetch_br_ao_do_report_rba(str_val)
{
    if(str_val !='')
    {
       var br_ao_do = jQuery('#report_option_selector').val();
       var off_id = jQuery('#off_id').val();
       var office_status = jQuery('#login_office_status').val();
       var url =  "fetch_br_ao_do_rba_reportindex.php";
        jQuery.ajax({
              url: url,
              type: 'post',
              data: 'br_ao_do='+br_ao_do+'&br_ao_do_str='+str_val+'&off_id='+off_id+'&office_status='+office_status,
              success: function (response) {
                if(response !='')
                {
                    jQuery('#report_of_br_ao_do_div_msg').html(response);
                }
                else
                {
                   jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="4"><h6 style="color: red;">Not Found. Type proper letter </h6></td>');
                }
              }
        });
    }
    else
    {
        jQuery('#report_of_br_ao_do_div_msg').html('<td COLSPAN="6"><h6 style="color: red;">Type on search box to get desired office </h6></td>');
    }
 }
 //rba_0001 end
/** RBA report end */