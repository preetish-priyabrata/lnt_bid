<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buuser extends CI_Controller {
    public function __construct(){
            parent::__construct();
            // Loading my model which will use
            $this->load->model('user_model', 'user'); 
             $this->load->model('approver_model', 'approver_user'); 
            // imedate database link
            $this->load->database();    
            
            //Load session library 
         $this->load->library('session');
         $this->load->library('user_agent');
         $this->load->library('encryption');
         $this->load->library('form_validation');


    }

    public function home(){
         $scripts='';
            $data=array('title' =>"Bu User Dashboard",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('bu_user/template/template_top_head');
            $this->load->view('bu_user/template/template_side_bar',$data);
            $this->load->view('bu_user/user_dashboard');
            $this->load->view('template/template_footer',$data);
        # code...
    }
   public function bu_create_tracking_new($value=''){ // CREATING mR
          $scripts='</script> <script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';
            $data=array('title' =>"Bu User Dashboard",'script_js'=>$scripts,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('bu_user/template/template_top_head');
            $this->load->view('bu_user/template/template_side_bar',$data);
            $this->load->view('bu_user/create_bu/create_bu_tool');
            $this->load->view('template/template_footer',$data);
       # code...
   }
   public function bu_create_tracking_new_save($value=''){
     $email_id=$this->session->userdata('bu_email_id');
        if(empty($email_id)){
            
            redirect('bu-logout-by-pass');
        }
        $Date_creation=$this->input->post('Date_creation');
        $Po_no=$this->input->post('Po_no');
        $Bg_submission_date=$this->input->post('Bg_submission_date');
        $Mfg_clear_date=$this->input->post('Mfg_clear_date');
        $Job_code=$this->input->post('Job_code');
        $Po_date=$this->input->post('Po_date');
        $Advance_payment_date=$this->input->post('Advance_payment_date');
        $Inspection_call_date=$this->input->post('Inspection_call_date');
        $Inspection_clearance_date=$this->input->post('Inspection_clearance_date');
        $Dispatch_clearance_date=$this->input->post('Dispatch_clearance_date');
        $Inspection_call_remark=$this->input->post('Inspection_call_remark');
        $Inspection_clearance_remark=$this->input->post('Inspection_clearance_remark');
        $Dispatch_clearance_remark=$this->input->post('Dispatch_clearance_remark');
        $Qty_receipt_at_site=$this->input->post('Qty_receipt_at_site');
        $Supply_completion=$this->input->post('Supply_completion');
        $Qty_pending=$this->input->post('Qty_pending');
        $Remark_process=$this->input->post('Remark_process');
        $ACE_Basic=$this->input->post('ACE_Basic');
        $Order_value=$this->input->post('Order_value');
        $Invoice_value=$this->input->post('Invoice_value');
        $Cost_saving=$this->input->post('Cost_saving');
        $send_button=$this->input->post('send_button');
        $Drg_approval_date=$this->input->post('Drg_approval_date');
        if($send_button=='send'){
            $insert_data = array('Job_code'=>$Job_code, 'Po_no'=>$Po_no, 'Po_date'=>$Po_date, 'Date_creation'=>$Date_creation, 'Bg_submission_date'=>$Bg_submission_date, 'Drg_submission_date'=>$Drg_submission_date, 'Advance_payment_date'=>$Advance_payment_date, 'Drg_approval_date'=>$Drg_approval_date, 'Inspection_call_date'=>$Inspection_call_date, 'Inspection_call_remark'=>$Inspection_call_remark, 'Inspection_clearance_date'=>$Inspection_clearance_date, 'Inspection_clearance_remark'=>$Inspection_clearance_remark, 'Dispatch_clearance_date'=>$Dispatch_clearance_date, 'Dispatch_clearance_remark'=>$Dispatch_clearance_remark, 'Qty_receipt_at_site'=>$Qty_receipt_at_site, 'Qty_pending'=>$Qty_pending, 'Supply_completion'=>$Supply_completion, 'Remark_process'=>$Remark_process, 'ACE_Basic'=>$ACE_Basic, 'Invoice_value'=>$Invoice_value, 'Order_value'=>$Order_value, 'Cost_saving'=>$Cost_saving, 'Mfg_clear_date'=>$Mfg_clear_date, 'Status'=>'1','submitted_by'=>$email_id);
                $this->db->insert('master_tracking_tools',$insert_data);                   
                $this->session->set_flashdata('success_message', ' Ssuccessfully Tracking Tool Is Created  Saved ');
                redirect('user-bu-home');
                                
        }else{
             $insert_data = array('Job_code'=>$Job_code, 'Po_no'=>$Po_no, 'Po_date'=>$Po_date, 'Date_creation'=>$Date_creation, 'Bg_submission_date'=>$Bg_submission_date, 'Drg_submission_date'=>$Drg_submission_date, 'Advance_payment_date'=>$Advance_payment_date, 'Drg_approval_date'=>$Drg_approval_date, 'Inspection_call_date'=>$Inspection_call_date, 'Inspection_call_remark'=>$Inspection_call_remark, 'Inspection_clearance_date'=>$Inspection_clearance_date, 'Inspection_clearance_remark'=>$Inspection_clearance_remark, 'Dispatch_clearance_date'=>$Dispatch_clearance_date, 'Dispatch_clearance_remark'=>$Dispatch_clearance_remark, 'Qty_receipt_at_site'=>$Qty_receipt_at_site, 'Qty_pending'=>$Qty_pending, 'Supply_completion'=>$Supply_completion, 'Remark_process'=>$Remark_process, 'ACE_Basic'=>$ACE_Basic, 'Invoice_value'=>$Invoice_value, 'Order_value'=>$Order_value, 'Cost_saving'=>$Cost_saving, 'Mfg_clear_date'=>$Mfg_clear_date, 'Status'=>'2','submitted_by'=>$email_id);
                $this->db->insert('master_tracking_tools',$insert_data);   
                 $this->session->set_flashdata('success_message', ' Ssuccessfully Tracking Tool Is Created  Saved ');
                redirect('user-bu-home');
                

        }
   }
   public function bu_edit_tracking_tool($value=''){
    if(!empty($value)){
        $scripts='</script> <script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';
            $data=array('title' =>"Bu User Dashboard",'script_js'=>$scripts,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value);
            $this->load->view('template/template_header',$data);
            $this->load->view('bu_user/template/template_top_head');
            $this->load->view('bu_user/template/template_side_bar',$data);
            $this->load->view('bu_user/drafted_bu/create_bu_tool',$data);
            $this->load->view('template/template_footer',$data);
       
    }else{
       $this->session->set_flashdata('error_message', 'Some thing went worng ');
                redirect('user-bu-home');  
    }
   }
    public function bu_view_tracking_tool($value=''){
    if(!empty($value)){
        $scripts='</script> <script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';
            $data=array('title' =>"Bu User Dashboard",'script_js'=>$scripts,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value);
            $this->load->view('template/template_header',$data);
            $this->load->view('bu_user/template/template_top_head');
            $this->load->view('bu_user/template/template_side_bar',$data);
            $this->load->view('bu_user/submited_bu/create_bu_tool',$data);
            $this->load->view('template/template_footer',$data);
       
    }else{
       $this->session->set_flashdata('error_message', 'Some thing went worng ');
                redirect('user-bu-home');  
    }
   }
   public function bu_drafted_tracking_new(){
   
          $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';
            $data=array('title' =>"Bu User Dashboard",'script_js'=>$scripts,'menu_status'=>'1','sub_menu'=>'2','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('bu_user/template/template_top_head');
            $this->load->view('bu_user/template/template_side_bar',$data);
            $this->load->view('bu_user/drafted_bu/view_drafted_tracking_tool');
            $this->load->view('template/template_footer',$data);
   }
    public function bu_update_tracking_new_save($value=''){
     $email_id=$this->session->userdata('bu_email_id');
        if(empty($email_id)){
            
            redirect('bu-logout-by-pass');
        }
        $Date_creation=$this->input->post('Date_creation');
        $Po_no=$this->input->post('Po_no');
        $Bg_submission_date=$this->input->post('Bg_submission_date');
        $Mfg_clear_date=$this->input->post('Mfg_clear_date');
        $Job_code=$this->input->post('Job_code');
        $Po_date=$this->input->post('Po_date');
        $Advance_payment_date=$this->input->post('Advance_payment_date');
        $Inspection_call_date=$this->input->post('Inspection_call_date');
        $Inspection_clearance_date=$this->input->post('Inspection_clearance_date');
        $Dispatch_clearance_date=$this->input->post('Dispatch_clearance_date');
        $Inspection_call_remark=$this->input->post('Inspection_call_remark');
        $Inspection_clearance_remark=$this->input->post('Inspection_clearance_remark');
        $Dispatch_clearance_remark=$this->input->post('Dispatch_clearance_remark');
        $Qty_receipt_at_site=$this->input->post('Qty_receipt_at_site');
        $Supply_completion=$this->input->post('Supply_completion');
        $Qty_pending=$this->input->post('Qty_pending');
        $Remark_process=$this->input->post('Remark_process');
        $ACE_Basic=$this->input->post('ACE_Basic');
        $Order_value=$this->input->post('Order_value');
        $Invoice_value=$this->input->post('Invoice_value');
        $Cost_saving=$this->input->post('Cost_saving');
        $send_button=$this->input->post('send_button');
        $Slno_tracking=$this->input->post('Slno_tracking');
        $data_id = array('Slno_tracking' => $Slno_tracking );
        $Drg_approval_date=$this->input->post('Drg_approval_date');
        if($send_button=='send'){
            $insert_data = array('Job_code'=>$Job_code, 'Po_no'=>$Po_no, 'Po_date'=>$Po_date, 'Date_creation'=>$Date_creation, 'Bg_submission_date'=>$Bg_submission_date, 'Drg_submission_date'=>$Drg_submission_date, 'Advance_payment_date'=>$Advance_payment_date, 'Drg_approval_date'=>$Drg_approval_date, 'Inspection_call_date'=>$Inspection_call_date, 'Inspection_call_remark'=>$Inspection_call_remark, 'Inspection_clearance_date'=>$Inspection_clearance_date, 'Inspection_clearance_remark'=>$Inspection_clearance_remark, 'Dispatch_clearance_date'=>$Dispatch_clearance_date, 'Dispatch_clearance_remark'=>$Dispatch_clearance_remark, 'Qty_receipt_at_site'=>$Qty_receipt_at_site, 'Qty_pending'=>$Qty_pending, 'Supply_completion'=>$Supply_completion, 'Remark_process'=>$Remark_process, 'ACE_Basic'=>$ACE_Basic, 'Invoice_value'=>$Invoice_value, 'Order_value'=>$Order_value, 'Cost_saving'=>$Cost_saving, 'Mfg_clear_date'=>$Mfg_clear_date, 'Status'=>'1','submitted_by'=>$email_id);
                $this->db->update('master_tracking_tools',$insert_data,$data_id);                   
                $this->session->set_flashdata('success_message', ' Ssuccessfully Tracking Tool Is Update  Saved ');
                redirect('user-bu-home');
                                
        }else{
             $insert_data = array('Job_code'=>$Job_code, 'Po_no'=>$Po_no, 'Po_date'=>$Po_date, 'Date_creation'=>$Date_creation, 'Bg_submission_date'=>$Bg_submission_date, 'Drg_submission_date'=>$Drg_submission_date, 'Advance_payment_date'=>$Advance_payment_date, 'Drg_approval_date'=>$Drg_approval_date, 'Inspection_call_date'=>$Inspection_call_date, 'Inspection_call_remark'=>$Inspection_call_remark, 'Inspection_clearance_date'=>$Inspection_clearance_date, 'Inspection_clearance_remark'=>$Inspection_clearance_remark, 'Dispatch_clearance_date'=>$Dispatch_clearance_date, 'Dispatch_clearance_remark'=>$Dispatch_clearance_remark, 'Qty_receipt_at_site'=>$Qty_receipt_at_site, 'Qty_pending'=>$Qty_pending, 'Supply_completion'=>$Supply_completion, 'Remark_process'=>$Remark_process, 'ACE_Basic'=>$ACE_Basic, 'Invoice_value'=>$Invoice_value, 'Order_value'=>$Order_value, 'Cost_saving'=>$Cost_saving, 'Mfg_clear_date'=>$Mfg_clear_date, 'Status'=>'2','submitted_by'=>$email_id);
                $this->db->update('master_tracking_tools',$insert_data,$data_id);     
                 $this->session->set_flashdata('success_message', ' Ssuccessfully Tracking Tool Is Update  Saved ');
                redirect('user-bu-home');
                

        }
   }
   public function bu_view_edit_tracking_tool($value=''){
        if(!empty($value)){
            $scripts='</script> <script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';
                $data=array('title' =>"Bu User Dashboard",'script_js'=>$scripts,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value);
                $this->load->view('template/template_header',$data);
                $this->load->view('bu_user/template/template_top_head');
                $this->load->view('bu_user/template/template_side_bar',$data);
                $this->load->view('bu_user/submited_bu/edit_bu_tool',$data);
                $this->load->view('template/template_footer',$data);
           
        }else{
           $this->session->set_flashdata('error_message', 'Some thing went worng ');
                    redirect('user-bu-home');  
        }
   }
   public function bu_submited_tracking_new($value=''){
     $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';
            $data=array('title' =>"Bu User Dashboard",'script_js'=>$scripts,'menu_status'=>'1','sub_menu'=>'3','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('bu_user/template/template_top_head');
            $this->load->view('bu_user/template/template_side_bar',$data);
            $this->load->view('bu_user/submited_bu/view_submitted_tracking_tool');
            $this->load->view('template/template_footer',$data);
       # code...
   }
    public function bu_logout(){
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
                        $this->session->set_flashdata('success_message', 'Signout from BU User panel');
                        redirect('home');

                }else{

                        $user_data = array('logout_date'=>$date, 'logout_time'=>$time, 'status'=>'2');
                        $id=array('session_id'=>$session_id);
                        $user_hstory_table="master_session_history";
                        $result_history = $this->user->common_update($user_hstory_table,$user_data,$id); 
                        session_destroy();
                        session_start();                        
                        $this->session->set_flashdata('success_message', 'Sign-out from BU User Panel');
                        redirect('home');     
                }

    }

     public function bu_logout_bypass(){
        $this->session->set_flashdata('error_msg', 'Invalid entry to Bu User panel');
        redirect('home');     
                
    }

}