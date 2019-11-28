<?php
class Product_model extends CI_Model{

	function product_list(){
		$legacy_db = $this->load->database('dbcomm', true);
		$hasil = $legacy_db->query("select * from product");
		return $hasil->result();
	}

	function save_product(){
		$data = array(
				'product_code' 	=> $this->input->post('product_code'),
				'product_name' 	=> $this->input->post('product_name'),
				'product_price' => $this->input->post('price'),
			);
		$legacy_db = $this->load->database('dbcomm', true);
		$result = $legacy_db->insert('product', $data);
		return $result;
	}


	function update_product(){

		$product_code=$this->input->post('product_code');
		$product_name=$this->input->post('product_name');
		$product_price=$this->input->post('price');

		$legacy_db = $this->load->database('dbcomm', true);

		$legacy_db->set('product_name', $product_name);
		$legacy_db->set('product_price', $product_price);
		$legacy_db->where('product_code', $product_code);
		$result = $legacy_db->update('product');

		return $result;
	}

	function delete_product(){
		$product_code=$this->input->post('product_code');
		$legacy_db = $this->load->database('dbcomm', true);

		$legacy_db->where('product_code', $product_code);
		$result = $legacy_db->delete('product');
		return $result;
	}


	/*ISS date start*/
	function issdate_list(){
		$legacy_db = $this->load->database('dbcomm', true);
		$hasil = $legacy_db->query("select * from ISSEntryDate ORDER BY id ASC");
		return $hasil->result();
	}

	function save_issdate(){
		$data = array(
				'id' 	=> $this->input->post('issdate_id_val'),
				'ISSEntryDate' 	=> $this->input->post('issdate_entry_val'),
				'stDate' => $this->input->post('issdate_sdate_val'),
				'endDate' => $this->input->post('issdate_endate_val'),
				'CerendDate' => $this->input->post('issdate_cerendate_val'),
			);
		$legacy_db = $this->load->database('dbcomm', true);
		$result = $legacy_db->insert('[db_mis_ISS].[dbo].[ISSEntryDate]', $data);
		return $result;
	}


	function update_issdate(){

		$issdate_id_edit_val = $this->input->post('issdate_id_edit_Val');
		$issdate_entry_edit_val = $this->input->post('issdate_entry_edit_Val');
		$issdate_sdate_edit_val = $this->input->post('issdate_sdate_edit_Val');
		$issdate_endate_edit_val = $this->input->post('issdate_endate_edit_Val');
		$issdate_cerendate_edit_val = $this->input->post('issdate_cerendate_edit_Val');

		$legacy_db = $this->load->database('dbcomm', true);

		$legacy_db->set('ISSEntryDate', $issdate_entry_edit_val);
		$legacy_db->set('stDate', $issdate_sdate_edit_val);
		$legacy_db->set('endDate', $issdate_endate_edit_val);
		$legacy_db->set('CerendDate', $issdate_cerendate_edit_val);

		$legacy_db->where('id', $issdate_id_edit_val);

		$result = $legacy_db->update('[db_mis_ISS].[dbo].[ISSEntryDate]');

		return $result;
	}

	function delete_issdate(){
		$issdate_id_delete_val=$this->input->post('issdate_id_delete_val');
		$legacy_db = $this->load->database('dbcomm', true);

		$legacy_db->where('id', $issdate_id_delete_val);
		$result = $legacy_db->delete('[db_mis_ISS].[dbo].[ISSEntryDate]');
		return $result;
	}
	/*ISS date end*/


	/*User Section*/
	function user_list(){
		//$legacy_db = $this->load->database('dbcomm', true);
		//$this->db->get($qstr);
		//$hasil = $this->db->query("select * from [Db_DP_Collection_mgr].[dbo].[DMS_UserInfo]");
		//$hasil = $this->db->get('[Db_DP_Collection_mgr].[dbo].[DMS_UserInfo]');
		//$hasil = $this->db->query("select * from [Db_DP_Collection_mgr].[dbo].[DMS_UserInfo] ORDER by ui_code asc");
		$hasil = $this->db->query("select ui_code, ui_Desig_Code,ui_PFile_No,ui_Full_Name,ui_Mobile_No,ui_Posting_Office_Code,ui_Pwd,ui_Email,
					CONVERT(varchar, ui_dob, 110) as 'ui_dob', ui_isPermit
					from [Db_DP_Collection_mgr].[dbo].[DMS_UserInfo]
					ORDER by ui_code asc");
		return $hasil->result();
	}

	function save_user(){
		$data = array(
				'id' 	=> $this->input->post('issdate_id_val'),
				'ISSEntryDate' 	=> $this->input->post('issdate_entry_val'),
				'stDate' => $this->input->post('issdate_sdate_val'),
				'endDate' => $this->input->post('issdate_endate_val'),
				'CerendDate' => $this->input->post('issdate_cerendate_val'),
			);
		$legacy_db = $this->load->database('dbcomm', true);
		$result = $legacy_db->insert('[db_mis_ISS].[dbo].[ISSEntryDate]', $data);
		return $result;
	}


	function update_user(){

		$ui_code_edit_val = $this->input->post('ui_code_edit_val');
		$ui_desig_code_edit_val = $this->input->post('ui_desig_code_edit_val');
		$ui_pfile_no_edit_val = $this->input->post('ui_pfile_no_edit_val');
		$ui_full_name_edit_val = $this->input->post('ui_full_name_edit_val');
		$ui_mobile_no_edit_val = $this->input->post('ui_mobile_no_edit_val');
		$ui_office_code_edit_val = $this->input->post('ui_office_code_edit_val');
		$ui_email_edit_val = $this->input->post('ui_email_edit_val');
		$ui_dob_edit_val = $this->input->post('ui_dob_edit_val');
		$ui_ispermit_edit_val = $this->input->post('ui_ispermit_edit_val');


		$this->db->set('ui_Desig_Code', $ui_desig_code_edit_val);
		$this->db->set('ui_PFile_No', $ui_pfile_no_edit_val);
		$this->db->set('ui_Full_Name', $ui_full_name_edit_val);
		$this->db->set('ui_Mobile_No', $ui_mobile_no_edit_val);
		$this->db->set('ui_Posting_Office_Code', $ui_office_code_edit_val);
		$this->db->set('ui_Email', $ui_email_edit_val);
		$this->db->set('ui_dob', $ui_dob_edit_val);
		$this->db->set('ui_isPermit', $ui_ispermit_edit_val);

		$this->db->where('ui_code', $ui_code_edit_val);

		$result = $this->db->update('[Db_DP_Collection_mgr].[dbo].[DMS_UserInfo]');

		return $result;
	}

	function delete_user(){
		$user_id_delete_val=$this->input->post('user_id_delete_val');

		$this->db->where('ui_code', $user_id_delete_val);
		$result =  $this->db->delete('[Db_DP_Collection_mgr].[dbo].[DMS_UserInfo]');
		return $result;
	}
	/*END User Section*/

}