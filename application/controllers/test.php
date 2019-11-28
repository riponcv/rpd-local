<?php
class Test extends CI_Controller {

function emailchk()
{

}

function check_email_availablity()
{
	$this->load->model('My_model');
	$get_result = $this->My_model->check_email_availablity();
 
	if(!$get_result )
	echo '<span style="color:#f00">Email already in use. </span>';
	else
	echo '<span style="color:#0c0">Email Available</span>';
}


function check_email_availablity()
{
        $email = trim($this->input->post('email'));
	$email = strtolower($email);	
 
	$query = $this->db->query('SELECT * FROM tbl_members where email="'.$email.'"');
 
	if($query->num_rows() > 0)
	return false;
	else
	return true;
}
//for testing of array
	function index()
	{
	$grid_fields = array(
			0	=> array('name' => 'username', 'header' => 'Username', 'type' => 2, 'order' => 'username'),
			1	=> array('name' => 'firstname', 'header' => 'First Name', 'type' => 2, 'order' => 'firstname'),
			2	=> array('name' => 'lastname', 'header' => 'Last Name', 'type' => 2, 'order' => 'lastname'),
			3	=> array('name' => 'age', 'header' => 'Age', 'type' => 1, 'order' => 'age'),
			4	=> array('name' => 'active', 'header' => 'Active', 'type' => 3, 'order' => 'active')
		);

		$grid_data = array(
			0 => array('username' => 'sample0', 'firstname' => 'John', 'lastname' => 'Smith', 'age' => 17, 'active' => 1),
			1 => array('username' => 'sample1', 'firstname' => 'John', 'lastname' => 'Smith', 'age' => 17, 'active' => 1),
			2 => array('username' => 'sample2', 'firstname' => 'James', 'lastname' => 'Smith', 'age' => 18, 'active' => 1),
			3 => array('username' => 'sample3', 'firstname' => 'Steve', 'lastname' => 'Smith', 'age' => 19, 'active' => 0),
			4 => array('username' => 'sample4', 'firstname' => 'Mary', 'lastname' => 'Smith', 'age' => 20, 'active' => 1),
			5 => array('username' => 'sample5', 'firstname' => 'John', 'lastname' => 'Smith', 'age' => 17, 'active' => 1),
			6 => array('username' => 'sample6', 'firstname' => 'James', 'lastname' => 'Smith', 'age' => 18, 'active' => 1),
			7 => array('username' => 'sample7', 'firstname' => 'Steve', 'lastname' => 'Smith', 'age' => 19, 'active' => 0),
			8 => array('username' => 'sample8', 'firstname' => 'Mary', 'lastname' => 'Smith', 'age' => 20, 'active' => 1),
			9 => array('username' => 'sample9', 'firstname' => 'John', 'lastname' => 'Smith', 'age' => 17, 'active' => 1),
			10 => array('username' => 'sample10', 'firstname' => 'James', 'lastname' => 'Smith', 'age' => 18, 'active' => 1),
			11 => array('username' => 'sample11', 'firstname' => 'Steve', 'lastname' => 'Smith', 'age' => 19, 'active' => 0),
			12 => array('username' => 'sample12', 'firstname' => 'Mary', 'lastname' => 'Smith', 'age' => 20, 'active' => 1),
			13 => array('username' => 'sample13', 'firstname' => 'John', 'lastname' => 'Smith', 'age' => 17, 'active' => 1),
			14 => array('username' => 'sample14', 'firstname' => 'James', 'lastname' => 'Smith', 'age' => 18, 'active' => 1),
			15 => array('username' => 'sample15', 'firstname' => 'Steve', 'lastname' => 'Smith', 'age' => 19, 'active' => 0),
			16 => array('username' => 'sample16', 'firstname' => 'Mary', 'lastname' => 'Smith', 'age' => 20, 'active' => 1),
			17 => array('username' => 'sample17', 'firstname' => 'John', 'lastname' => 'Smith', 'age' => 17, 'active' => 1),
			18 => array('username' => 'sample18', 'firstname' => 'James', 'lastname' => 'Smith', 'age' => 18, 'active' => 1),
			19 => array('username' => 'sample19', 'firstname' => 'Steve', 'lastname' => 'Smith', 'age' => 19, 'active' => 0),
			20 => array('username' => 'sample20', 'firstname' => 'Mary', 'lastname' => 'Smith', 'age' => 20, 'active' => 1)
		);

/*
		$params = array(
			'id' 				=> 'sample',
			'url' 				=> 'sample/index',
			'add' 				=> 'sample/add',
			'edit' 				=> 'sample/edit',
			'delete'			=> 'sample/delete',
			'limit' 			=> $limit,
			'offset' 			=> $offset,
			'order_string' 		=> $order,
			'filter_string' 	=> $filter_string,
			'column_string'		=> $cols,
			'fields' 			=> $grid_fields,
		);
*/
		//$this->load->library('carbogrid', $params);

		//$this->carbogrid->total = count($grid_data);

		// Perform sort
		$sort_data = array();
		
		foreach ($grid_data as $key => $row)
		{
			foreach ($grid_fields as $field)
			{
				$sort_data[$field['name']][$key] = $row[$field['name']];
				//echo $row[$field['name']].": key=>".$key."<br>";
			}
			
			//echo '<br>------------';
			
		}
		
		$test=array("fname"=>array("ff"=>"aa","gg"=>
		"aa"),"lname"=>array("bb","bb"));
		//print_r($test);
		
		foreach($test as $k=>$r){
		 echo "<br/>k=$k <br/>";
		 
		 foreach($r as $k=>$e){
		 echo "<br/>k=$k e=$e <br/>";
		 }
		}
		
		//print_r($sort_data);
		
		/*
		foreach ($this->carbogrid->order as $field => $dir)
		{
			array_multisort($sort_data[$field], ($dir == 'DESC') ? SORT_DESC : SORT_ASC, SORT_STRING);
		}
		$grid_data = array();
		foreach ($sort_data as $field => $column)
		{
			foreach ($column as $key => $value)
			{
				$grid_data[$key][$field] = $value;
			}
		}
		*/
	}

}