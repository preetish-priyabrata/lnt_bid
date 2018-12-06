<?php

class Procurement_model extends CI_Model {
	  public function __construct() {
        parent::__construct();
        	$this->load->database();

    }
    public function procurement_mr_receive_list($value,$value2,$slno){
      // echo $value2;
      if(!empty($value)){
        $this->db->where('Procurement_id',$value);
      }

      if(!empty($value2)){
        if($value2==1){
           $this->db->where('Status', 1); 
          $this->db->where('Forward_status', 1);
        }else if($value2==2){
           $this->db->where('Status', 1); 
           $this->db->where('Forward_status', 2);
        }
      }else{
         $this->db->where('Status', 1); 
        $this->db->where('Forward_status', 2);
      }
      if(!empty($slno)){
         $this->db->where('Slno_mr_id', $slno);
        
      }
     
              
      $query = $this->db->get('master_mr_approver_order');
      // echo $this->db->last_query();
      
        if($query->num_rows() == 0){
        $data_send = array('no_received' =>2 );
        return $data_send;
        exit;
      }else{
        $results=$query->result();
        $data_send = array('no_received' =>1, 'received_list'=>$results);
        return $data_send;
        exit;
      }  
    }
    public function procurement_mr_receive_single($value=''){
      	if(!empty($value)){
        	$this->db->where('slno_mr ',$value);
         	$query = $this->db->get('master_mr_job_details');
	        if($query->num_rows() == 0){
		        $data_send = array('no_received' =>2 );
		        return $data_send;
		        exit;
		     }else{
		        $results=$query->result();
		        $data_send = array('no_received' =>1, 'received_list_single'=>$results);
		        return $data_send;
		        exit;
		    }  
      	}else{
      		$data_send = array('no_received' =>2 );
	        return $data_send;
	        exit;
      	}    
    }
    public function procurement_mr_item_tech_single($value=''){
      	if(!empty($value)){
        	$this->db->where('slno_item_mr_tech ',$value);
         	$query = $this->db->get('master_mr_technical_parameter_info');
	        if($query->num_rows() == 0){
		        $data_send = array('no_received' =>2 );
		        return $data_send;
		        exit;
		     }else{
		        $results=$query->result();
		        $data_send = array('no_received' =>1, 'procuremenr_list_single'=>$results);
		        return $data_send;
		        exit;
		    }  
      	}else{
      		$data_send = array('no_received' =>2 );
	        return $data_send;
	        exit;
      	}    
    }

    public function get_procurement_buyer_list($value=''){
      if(!empty($value)){
      $data_array_approver = array('Status' => 1,'role_id'=>7,'slno'=>$value);
        $query_approver=$this->db->get_where('master_admin',$data_array_approver);
        if($query_approver->num_rows() == 0){
          $data_send = array('no_user' =>2 );
          return $data_send;
          exit;
        }else{
          $results=$query_approver->result();
          $data_send = array('no_user' =>1, 'user_buyer_list'=>$results);
          return $data_send;
          exit;
        } 
      }else{
        $data_array_approver = array('Status' => 1,'role_id'=>7 );
        $query_approver=$this->db->get_where('master_admin',$data_array_approver);
        if($query_approver->num_rows() == 0){
          $data_send = array('no_user' =>2 );
          return $data_send;
          exit;
        }else{
          $results=$query_approver->result();
          $data_send = array('no_user' =>1, 'user_buyer_list'=>$results);
          return $data_send;
          exit;
        } 
      }    
    }
    /**
     * [get_design_approver_single description] here detail information of approver is send while storing information 
     * @param  [type] $data_id [description]
     * @return [type]          [description]
     */


}