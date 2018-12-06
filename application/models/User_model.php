<?php

class User_model extends CI_Model {
	  public function __construct() {
        parent::__construct();
        	$this->load->database();

    }
// here user ind\formation is store or not
    public function check_present($table,$data){   	 
    	$query = $this->db->get_where($table, $data);
    	// $sql = $this->db->last_query();
  		if ($query->num_rows() == 0) {
  			return 0;
  		} else {
  			return 1;
  		}
    }
    // here common insert to data base
    public function common_insert($table,$data){        
      $query=$this->db->insert($table, $data);
      if($query){
        return 1;
      }else{
        return 0;
      }

    }
    // here common insert to data base
    public function common_insert_id($table,$data){        
      $query=$this->db->insert($table, $data);
      $this->db->last_query();
      if($query){
        return $this->db->insert_id();
      }else{
        return 0;
      }

    }
    public function common_update($table, $data ,$id){
      $query=$this->db->update($table, $data,$id);
      if($query){
        return 1;
      }else{
        return 0;
      }
    }
    public function admin_get_vechile_type_capacity($table,$data){
       $query = $this->db->get_where($table, $data);
        // echo $sql = $this->db->last_query();
        if ($query->num_rows() == 0) {
          return 1;
        } else {
          return 2;
        }
    }
    public function admin_get_vechile_type(){
      $data = array('status ' => 1);
       $query = $this->db->get_where('master_vehicle_type', $data);
        // echo $sql = $this->db->last_query();
        if ($query->num_rows() == 0) {
          $data_result = array('vehicle_type' =>2);
          return $data_result;
        } else {
           $data_result = array('vehicle_type' =>1,'vehicle_type_list'=>$query->result());
            return $data_result;
        }
    }
     public function admin_get_vechile_capacity(){
      $data = array('status ' => 1);
       $query = $this->db->get_where('master_vehicle_capacity', $data);
        // echo $sql = $this->db->last_query();
        if ($query->num_rows() == 0) {
          $data_result = array('vehicle_capacity' =>2);
          return $data_result;
        } else {
           $data_result = array('vehicle_capacity' =>1,'vehicle_capacity_list'=>$query->result());
            return $data_result;
        }
    }
    public function admin_get_location(){
      $data = array('status ' => 1);
        $query = $this->db->get_where('master_loaction_details', $data);
        // echo $sql = $this->db->last_query();
        if ($query->num_rows() == 0) {
          $data_result = array('location_no' =>2);
          return $data_result;
        } else {
           $data_result = array('location_no' =>1,'location_no_list'=>$query->result());
            return $data_result;
        }
    }
      public function get_bu_trackinh($value2,$slno){
      // echo $value2;
      
        if(!empty($slno)){
          $this->db->where('Slno_tracking', $slno); 
        }
      if(!empty($value2)){
        if($value2==1){
           $this->db->where('Status', 1); 
          
        }else if($value2==2){
           $this->db->where('Status', 2); 
           
        }
      }else{
         $this->db->where('Status', 2); 
        
      }
     
     
              
      $query = $this->db->get('master_tracking_tools');
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



}