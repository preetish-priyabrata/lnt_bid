<?php

class Approver_model extends CI_Model {
	  public function __construct() {
        parent::__construct();
        	$this->load->database();

    }
    /**
     * [approver_mr_receive_list description] here this section of work which approved need to be done or comment
     * @param  string $value [description]
     * @return [type]        [description]
     */
     public function approver_mr_receive_list($value='',$type=''){
      if(!empty($value)){
        $this->db->where('approver_id ',$value);
      }
      if(!empty($type)){
        if($type==1){
           $this->db->where('status ', 1); 
          $this->db->where('mr_forword_status ', 1);
        }else if($type==2){
           $this->db->where('status ', 6); 
           $this->db->where('mr_forword_status ', 0);
        }
      }else{
         $this->db->where('status ', 1); 
        $this->db->where('mr_forword_status ', 0);
      }
     
              
      $query = $this->db->get('master_mr_job_details');
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
    public function approver_get_creator_mr($value){
      $this->db->where('email_id ', $value);           
      $query = $this->db->get('master_admin');
        if($query->num_rows() == 0){
        $data_send = array('no_user' =>2 );
        return $data_send;
        exit;
      }else{
        $results=$query->result();
        $data_send = array('no_user' =>1, 'list_user'=>$results);
        return $data_send;
        exit;
      }  
    }
     /**
   * [get_approver_mr_no_deatils description]
   * @param  [type] $value [Here Mr No or serail number is been  user get information for sci moi or logistics]
   * @return [type]        [no_mr=>2 ] if serail no dont matched with id inside tavle will make redirect to logout
   *                       [no_mr=>1 ]  if it 1 then information will be send back to it is scuucess and get parameter will is incude to populated the tables      
   */
    public function get_approver_mr_no_deatils($value){
        $data_array_mr = array('slno_mr' => $value );
        $query_mr=$this->db->get_where('master_mr_job_details',$data_array_mr);
        if($query_mr->num_rows() == 0){
        $data_send = array('no_mr' =>2 );
        return $data_send;
        exit;
      }else{
        $results=$query_mr->result();
        $data_send = array('no_mr' =>1, 'mr_details'=>$results);
        return $data_send;
        exit;
      } 
    }
    /**
     * [get_design_approver_list description]
     * @return [type] [description]  here approver user list is send for mr creation  only selected approver
     */
    public function get_approver_approver_list(){
      $data_array_approver = array('Status' => 1,'role_id'=>8 );
      $query_approver=$this->db->get_where('master_admin',$data_array_approver);
      if($query_approver->num_rows() == 0){
        $data_send = array('no_user' =>2 );
        return $data_send;
        exit;
      }else{
        $results=$query_approver->result();
        $data_send = array('no_user' =>1, 'user_approver'=>$results);
        return $data_send;
        exit;
      }     
    }

    public function get_approver_procurement_list($value=''){
      if(!empty($value)){
        $data_array_approver = array('Status' => 1,'role_id'=>4,'slno'=>$value);
        $query_approver=$this->db->get_where('master_admin',$data_array_approver);
        if($query_approver->num_rows() == 0){
          $data_send = array('no_user' =>2 );
          return $data_send;
          exit;
        }else{
          $results=$query_approver->result();
          $data_send = array('no_user' =>1, 'user_approver'=>$results);
          return $data_send;
          exit;
        }  
      }else{
        $data_array_approver = array('Status' => 1,'role_id'=>4);
        $query_approver=$this->db->get_where('master_admin',$data_array_approver);
        if($query_approver->num_rows() == 0){
          $data_send = array('no_user' =>2 );
          return $data_send;
          exit;
        }else{
          $results=$query_approver->result();
          $data_send = array('no_user' =>1, 'user_approver'=>$results);
          return $data_send;
          exit;
        }  
      }
         
    }
     /**
     * [get_design_material_category_list description]  HERE LIS TO F MATERIAL CATEGORY IS BEEB which apporoced or status actioe will send to list 
     * @return [type] [description]
     */
    public function get_approver_material_category_list(){ 

      $data_array_materials_category = array('status' => 1);
      $query_material_category=$this->db->get_where('master_category',$data_array_materials_category);
      if($query_material_category->num_rows() == 0){
        $data_send = array('no_materials' =>2 );
        return $data_send;
        exit;
      }else{
        $results=$query_material_category->result();
        $data_send = array('no_materials' =>1, 'materials_list'=>$results);
        return $data_send;
        exit;
      }     
    }
    /**
     * [get_approver_mr_job_detail description] this function will provide details of mr which need to fill it
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function get_approver_mr_job_detail($value=''){
      if(!empty($value)){
        $data_array_mr = array('slno_mr' => $value ,'mr_forword_status'=>0 );
        $query_mr=$this->db->get_where('master_mr_job_details',$data_array_mr);
        if($query_mr->num_rows() == 0){
          $data_send = array('no_mr_deatils' =>2 );
          return $data_send;
          exit;
        }else{
          $results=$query_mr->result();
          $data_send = array('no_mr_deatils' =>1, 'mr_details'=>$results);
          return $data_send;
          exit;
        }
      }else{
        $data_send = array('no_mr_deatils' =>2 );
        return $data_send;
        exit;
      }
      # code...
    }
    public function get_approver_conform_mr_job_detail($value=''){
      if(!empty($value)){
        $data_array_mr = array('Slno_mr_id' => $value ,'Forward_status'=>2);
        $query_mr=$this->db->get_where('master_mr_approver_order',$data_array_mr);
        if($query_mr->num_rows() == 0){
          $data_send = array('no_mr_deatils' =>2 );
          return $data_send;
          exit;
        }else{
          $results=$query_mr->result();
          $data_send = array('no_mr_deatils' =>1, 'mr_details'=>$results);
          return $data_send;
          exit;
        }
      }else{
        $data_send = array('no_mr_deatils' =>2 );
        return $data_send;
        exit;
      }
      # code...
    }
    public function get_approver_comment_mr_job_detail($value='',$value1=''){
      if(!empty($value) && !empty($value1)){
        $data_array_mr = array('Slno_mr_id' => $value ,'Edit'=>$value1);
        $query_mr=$this->db->get_where('master_mr_job_comments',$data_array_mr);
        if($query_mr->num_rows() == 0){
          $data_send = array('no_mr_detils' =>2 );
          return $data_send;
          exit;
        }else{
          $results=$query_mr->result();
          $data_send = array('no_mr_detils' =>1, 'mr_details'=>$results);
          return $data_send;
          exit;
        }
      }else{
        $data_send = array('no_mr_deatils' =>2 );
        return $data_send;
        exit;
      }
      # code...
    }

}