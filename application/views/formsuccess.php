<html>
<head>
<title>My Form</title>
</head>
<body>

<h3>Your form was successfully submitted!</h3>


<?php 

$this->load->model('mymodel','',TRUE);
$query = $this->mymodel->get_Data("DMS_UserInfo");

//$this->load->library('table'); 
//echo $this->table->generate($query); 

$CI = &get_instance();
$tmpl = array (
                     'table_open'          => '<table border="0" cellpadding="4" cellspacing="0">',
 
                    'heading_row_start'   => '<tr>',
                     'heading_row_end'     => '</tr>',
                     'heading_cell_start'  => '<th>',
                     'heading_cell_end'    => '</th>',
 
                    'row_start'           => '<tr>',
                     'row_end'             => '</tr>',
                     'cell_start'          => '<td>',
                     'cell_end'            => '</td>',
 
                    'row_alt_start'       => '<tr>',
                     'row_alt_end'         => '</tr>',
                     'cell_alt_start'      => '<td>',
                     'cell_alt_end'        => '</td>',
 
                    'table_close'         => '</table>'
               );

 $this->table->set_template($tmpl); 
echo $CI->table->generate($query); 
?>

</body>
</html>
