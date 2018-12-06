<?php

class Vendor_model extends CI_Model {
	public function __construct() {
        parent::__construct();
        $this->load->database();
    }
		/**
		 * [vendor_new_technical_bid_list here is the list new technical bid]
		 * @param  string $value [description]
		 * @return [type]        [description]
		 */
    public function vendor_new_technical_bid_list($value=''){
			$data=array('vendor_id'=>$value,'status_active'=>1);
			$query=$this->db->get_where('master_bid_vendor',$data);
    	if($query->num_rows()==0){
				$data_return = array('no_new_tech' =>2 );
				return $data_return;
			}else{
				$result_data_new_tech=$query->result();
				$data_return = array('no_new_tech' => 1,'new_tech_list'=>$result_data_new_tech );
				return $data_return;
			}
    }
		public function vendor_new_query_tech_title($value='',$value2){
			$data=array('slno_vendor'=>$value,'status_active'=>1,'vendor_id'=>$value2);
			$query=$this->db->get_where('master_bid_vendor',$data);
    	if($query->num_rows()==0){
				$data_return = array('no_new_tech' =>2 );
				return $data_return;
			}else{
				$result_data_new_tech=$query->result();
				$data_return = array('no_new_tech' => 1,'new_tech_list'=>$result_data_new_tech );
				return $data_return;
			}
			// code...
		}
		public function vendor_new_query_list_view($value='',$value2){
			$data=array('bid_slno'=>$value,'Vendor_id'=>$value2);
			$query=$this->db->get_where('master_bid_query',$data);
    	if($query->num_rows()==0){
				$data_return = array('no_new_tech_query' =>2 );
				return $data_return;
			}else{
				$result_data_new_tech=$query->result();
				$data_return = array('no_new_tech_query' => 1,'new_tech_query_list'=>$result_data_new_tech );
				return $data_return;
			}
		}


}
