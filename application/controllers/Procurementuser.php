<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurementuser extends CI_Controller {
	public function __construct(){
            parent::__construct();
            // Loading my model which will use
            $this->load->model('user_model', 'user'); 
            $this->load->model('approver_model', 'approver_user');
            $this->load->model('design_model', 'design_user');
            $this->load->model('procurement_model', 'procurement_user');
             
            // imedate database link
            $this->load->database();    
            
            //Load session library 
         $this->load->library('session');
         $this->load->library('user_agent');
         $this->load->library('encryption');
         $this->load->library('form_validation');
         $this->load->helper('string');
         $this->load->library('upload');
     }
      public function home(){
         $scripts='';
            $data=array('title' =>"Procurement User Dashboard",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('procurement_user/template/template_top_head');
            $this->load->view('procurement_user/template/template_side_bar',$data);
            $this->load->view('procurement_user/user_dashboard');
            $this->load->view('template/template_footer',$data);
        # code...
    }
    public function procurement_new_mr_receive($value=''){
    	$scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

        $data=array('title' =>"Material Requisition Receive list",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('procurement_user/template/template_top_head');
            $this->load->view('procurement_user/template/template_side_bar',$data);
            $this->load->view('procurement_user/receive_material_requisition/view_receive_mr_list');
            $this->load->view('template/template_footer',$data);
    }
    public function procurement_new_mr_order_receive_view($value,$value1,$value2){
    	
    	 switch ($value1) {
                case '1':
                    $title="View detail of standard catalogued item";
                    $view_page="view_mr_order_first";
                    break;
                case '2':
                    $title="View detail of make to order items";
                    $view_page="view_mr_order_second";
                    break;
                case '3':
                    $title="View detail of logistics";
                    $view_page="view_mr_order_third";
                    break;
                
                default:
                    # code...
                    break;
            }
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';
            $data=array('title' =>$title,'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);    

            $this->load->view('template/template_header',$data);
            $this->load->view('procurement_user/template/template_top_head');
            $this->load->view('procurement_user/template/template_side_bar',$data);
            $this->load->view('procurement_user/receive_material_requisition/view_detail_submitted_mr/'.$view_page,$data);
            $this->load->view('template/template_footer',$data);
    	# code...
    }
    public function procurement_assigned_buyer($value=''){
        // print_r($this->input->post());
        // exit();
        $email_id=$this->session->userdata('procurement_email_id');
        if(empty($email_id)){
            
            redirect('procurement-logout-by-pass');
        }
        $date=date('Y-m-d');
        $slno_Mr_no=$this->input->post('slno_Mr_no');
        $Slno_approver=$this->input->post('Slno_approver');
        $buyer_id=$this->input->post('buyer_id');
        $Mr_no=$this->input->post('Mr_no');
        $edit_id=$this->input->post('edit_id');
        $tech_evalution=$this->input->post('tech_evalution');
        $job_code_id=$this->input->post('job_code_id');
        $data_array_buyer=$this->procurement_user->get_procurement_buyer_list($buyer_id);
        // Array ( [no_user] => 1 [user_buyer_list] => Array ( [0] => stdClass Object ( [slno] => 15 [email_id] => buy1@ilab.com [Username] => buyer 1 [Password] => 1234567890Ab [password_hash] => c0d7659e35f9e7b793c4257d565e7390 [Status] => 1 [role_id] => 7 [user_mobile] => 8978564210 [user_degination] => buyser ) ) ) 
        if($data_array_buyer['no_user']==1){            
            $buyer_id =$data_array_buyer['user_buyer_list'][0]->email_id;
            $buyer_name=$data_array_buyer['user_buyer_list'][0]->Username;
            $data_insert = array('buyer_name' =>$buyer_name ,'buyer_id'=>$buyer_id ,'Forward_status'=>'1','Forward_date'=>$date);
            $data_update_id = array('Slno_mr_id' =>$slno_Mr_no);
            $query_table1=$this->db->update('master_procurement_MR',$data_insert,$data_update_id);
            if($query_table1){
                 $query_table2=$this->db->update('master_mr_approver_order',$data_insert,$data_update_id);
                   if($query_table2){
                        $data_buyer_insert = array('Mr_id'=>$Mr_no, 'Slno_mr_id'=>$slno_Mr_no, 'Job_code'=>$job_code_id, 'Slno_procurement_id'=>$Slno_approver, 'Buyer_id'=>$buyer_id, 'Status'=>1, 'Technical_type'=>$tech_evalution, 'Edit_id'=>$edit_id,'procurement_id'=>$email_id);
                        $query_table3=$this->db->insert('master_buyer_MR',$data_buyer_insert);
                        if($query_table3){
                             $this->session->set_flashdata('success_message', 'Information Has been successfully assigned');
                             // After that you need to used r
                            redirect('user-procurement-home');
                        }else{
                              $this->session->set_flashdata('error_message',  'Some thing went worng Try Again!!!!');
                             // After that you need to used r
                            redirect('user-procurement-home');
                        }
                   }else{
                        $this->session->set_flashdata('error_message',  'Some thing went worng Try Again!!!');
                             // After that you need to used r
                        redirect('user-procurement-home');
                   }
            }else{
                 $this->session->set_flashdata('error_message', 'Some thing went worng Try Again!!');
                    // After that you need to used r
            redirect('user-procurement-home');
            }        
        }else{
             $this->session->set_flashdata('error_message', 'Some thing went wrong Try Again!');
                    // After that you need to used r
            redirect('user-procurement-home');
        }

      
    }
    public function procurement_new_mr_conform($value=''){
       $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

        $data=array('title' =>"Histroy of Assign Buyer to Material Requisition",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'2','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('procurement_user/template/template_top_head');
            $this->load->view('procurement_user/template/template_side_bar',$data);
            $this->load->view('procurement_user/assign_material_requisition/view_assigned_mr_list');
            $this->load->view('template/template_footer',$data);
    }

    public function procurement_assign_mr_order_receive_view($value,$value1,$value2){
        
         switch ($value1) {
                case '1':
                    $title="View detail of standard catalogued item";
                    $view_page="view_mr_order_first";
                    break;
                case '2':
                    $title="View detail of make to order items";
                    $view_page="view_mr_order_second";
                    break;
                case '3':
                    $title="View detail of logistics";
                    $view_page="view_mr_order_third";
                    break;
                
                default:
                    # code...
                    break;
            }
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';
            $data=array('title' =>$title,'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);    

            $this->load->view('template/template_header',$data);
            $this->load->view('procurement_user/template/template_top_head');
            $this->load->view('procurement_user/template/template_side_bar',$data);
            $this->load->view('procurement_user/assign_material_requisition/view_detail_submitted_mr/'.$view_page,$data);
            $this->load->view('template/template_footer',$data);
        # code...
    }
    public function procurement_logout($value=''){
    	 $session_id=session_id();
                // print_r($this->session->userdata());
                $created_session_id=$this->session->userdata('session_id');
                $date=date('Y-m-d');
                $time=date('H:i:s');
                if($session_id==$created_session_id){
                        $user_data = array('logout_date'=>$date, 'logout_time'=>$time, 'status'=>'2');
                        $id=array('session_id'=>$session_id);
                        $user_hstory_table="master_session_history";
                        $result_history = $this->user->common_update($user_hstory_table,$user_data,$id);
                        session_destroy();
                        session_start();                        
                        $this->session->set_flashdata('success_message', 'Signout from Procurement User panel');
                        redirect('home');

                }else{

                        $user_data = array('logout_date'=>$date, 'logout_time'=>$time, 'status'=>'2');
                        $id=array('session_id'=>$session_id);
                        $user_hstory_table="master_session_history";
                        $result_history = $this->user->common_update($user_hstory_table,$user_data,$id); 
                        session_destroy();
                        session_start();                        
                        $this->session->set_flashdata('success_message', 'Sign-out from Procurement User Panel');
                }
    	# code...
    }
    public function procurement_logout_bypass(){
        $this->session->set_flashdata('error_msg', 'Invalid entry to Procurement User panel');
        redirect('home');     
                
    }

	
}
