<?php
class Product_model extends CI_Model{

	function product_list(){
		//$hasil=$this->db->get('product');
		$legacy_db = $this->load->database('dbcomm', true);
		$hasil = $legacy_db->query("select * from product");
		return $hasil->result();
	}

/*	function save_product(){
		$data = array(
				'product_code' 	=> $this->input->post('product_code'),
				'product_name' 	=> $this->input->post('product_name'),
				'product_price' => $this->input->post('price'),
			);
		$legacy_db = $this->load->database('dbcomm', true);

		$result=$this->legacy_db->insert('product',$data);
		return $result;
	}

	function update_product(){
		$product_code=$this->input->post('product_code');
		$product_name=$this->input->post('product_name');
		$product_price=$this->input->post('price');

$legacy_db = $this->load->database('dbcomm', true);

		$this->legacy_db->set('product_name', $product_name);
		$this->legacy_db->set('product_price', $product_price);
		$this->legacy_db->where('product_code', $product_code);
		$result=$this->legacy_db->update('product');
		return $result;
	}

	function delete_product(){
		$product_code=$this->input->post('product_code');
		$legacy_db = $this->load->database('dbcomm', true);

		$this->legacy_db->where('product_code', $product_code);
		$result=$this->legacy_db->delete('product');
		return $result;
	}
*/
}