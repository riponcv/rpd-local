<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css" media="screen">
		label {display: block;}
		table.mytable
		{
		 padding:1px;border:1px solid #FFFFFF;
		 background-color:#2E78C2;color:#FFFFFF;
		 border-collapse:collapse;
		 border:1px solid green;

		}
		td.mytable
		{
			padding:10px;border:1px solid #FFFFFF;
			background-color:#8FCAED;
			border-collapse:collapse;
			border:1px solid green;
		}
		
		td.mytable1
		{
			padding:10px;border:1px solid #FFCCFF;
			background-color:#CCCCCC;
			border-collapse:collapse;
			border:1px solid green;
		}
		
		th.mytable
		{
			background-color:#2E78C2;color:#FFFFFF;
			border-collapse:collapse;
			border:1px solid green;
		}
		#main{margin:0 auto;}
		
		
		
	</style>
</head>

<body>
<div id="main">
<?php 
//$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">' );
$tmpl = array (
                     'table_open'          => '<table border="1" width="100%" cellspacing="0">',
 
                    'heading_row_start'   => '<tr>',
                     'heading_row_end'     => '</tr>',
                     'heading_cell_start'  => '<th class="mytable">',
                     'heading_cell_end'    => '</th>',
 
                    'row_start'           => '<tr>',
                     'row_end'             => '</tr>',
                     'cell_start'          => '<td class="mytable">',
                     'cell_end'            => '</td>',
 
                    'row_alt_start'       => '<tr>',
                     'row_alt_end'         => '</tr>',
                     'cell_alt_start'      => '<td class="mytable1">',
                     'cell_alt_end'        => '</td>',
 
                    'table_close'         => '</table>'
               );

 $this->table->set_template($tmpl); 

$this->table->set_template($tmpl); 
echo $this->table->generate($rw); 
?>
</div>
</body>
</html>
