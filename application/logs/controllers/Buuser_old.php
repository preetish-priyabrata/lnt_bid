<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buuser extends CI_Controller {
    public function __construct(){
            parent::__construct();
            // Loading my model which will use
            $this->load->model('user_model', 'user');  
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
    public function bu_view_order_book(){
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

        $data=array('title' =>"View New Order Book List",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('bu_user/template/template_top_head');
            $this->load->view('bu_user/template/template_side_bar',$data);
            $this->load->view('bu_user/new_order_book/view_new_order_list');
            $this->load->view('template/template_footer',$data);
    }
    public function bu_add_new_order_book(){
        // '<script src="'.base_url().'file_css_admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        $scripts='<script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';

        $data=array('title' =>"Create New Order Book List",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('bu_user/template/template_top_head');
            $this->load->view('bu_user/template/template_side_bar',$data);
            $this->load->view('bu_user/new_order_book/create_new_order_book');
            $this->load->view('template/template_footer',$data);

        # code...
    }
    public function bu_add_new_order_book_save(){
       
        $data_brower['browser'] = $this->agent->browser();
        $data_brower['browserVersion'] = $this->agent->version();
        $data_brower['platform'] = $this->agent->platform();
        $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
        $ip = $this->input->ip_address();       
        $date_nrowser_json=json_encode($data_brower);
        $date_entry=date('Y-m-d');
        $time_entry=date('H:i:s');

        $Project_Slno=$this->input->post('job_code');
        $LOI_date_contract=$this->input->post('LOI_date_contract');
        $Contract_value=$this->input->post('Contract_value');
        $Contract_start_date=$this->input->post('Contract_start_date');
        $Contract_duration=$this->input->post('Contract_duration');
        $Project_desc=$this->input->post('Project_desc');
        $Contract_sign_date=$this->input->post('Contract_sign_date');
        $Supply_order_value=$this->input->post('Supply_order_value');
        $Contratual_completion=$this->input->post('Contratual_completion');
        $Remarks=$this->input->post('Remarks'); 
        $data_array = array('Project_Slno' => $Project_Slno,'bu_status'=>0,'status'=>1);
        $table="master_project";
        $query=$this->db->get_where($table,$data_array);
        if ($query->num_rows() != 0) {
            $result=$query->result();
            $data_result=$result[0];
            // print_r($data_result);
            $Project_Name=$data_result->Project_Name;
            $job_Code=$data_result->job_Code;

            $data_insert_new_order_booked = array('Slno_project'=>$Project_Slno, 'Job_code'=>$job_Code, 'Job_description'=>$Project_desc, 'Project_name'=>$Project_Name, 'LOI_date_contract'=>$LOI_date_contract, 'Contract_sign_date'=>$Contract_sign_date, 'Contract_value'=>$LOI_date_contract, 'Supply_order_value'=>$Supply_order_value, 'Contract_start_date'=>$Contract_start_date, 'Contractual_completion'=>$Contratual_completion, 'Contract_duration'=>$Contract_duration, 'Remark'=>$Remarks, 'Status'=>'1', 'Date_entry'=>$date_entry, 'Time_entry'=>$time_entry);
            $table_new_order="master_new_order_book";
            $query_insert_new_order=$this->user->common_insert($table_new_order,$data_insert_new_order_booked);

            $date_insert_json=json_encode($data_insert_new_order_booked);
            $table_log='pms_log_entries';
            $log_entry= array('Form_name'=>"Bu User New Order Book Entry", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
            $result_log_entry = $this->user->common_insert($table_log,$log_entry);

            $data_change = array('bu_status' => 1 );
            $query_update=$this->user->common_update($table,$data_change,$data_array);

            $this->session->set_flashdata('success_message', 'successfully New Order Book is stored');
                     // After that you need to used redirect function instead of load view such as                 
            redirect('bu-view-order-book');
        }else{
            $this->session->set_flashdata('error_message', 'some thing went worng ');
                // After that you need to used redirect function instead of load view such as                 
            redirect('user-bu');
        }
       
    }
    public function bu_view_order_booked_info($value1,$value2){
         $keys_id="preetishwebneworder";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                 $scripts='';
                $data=array('title' =>"View Detail Information Of Order Booked",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','Slno_n_order'=>$value1,'token_id'=>$value2);
                $this->load->view('template/template_header',$data);
                $this->load->view('bu_user/template/template_top_head');
                $this->load->view('bu_user/template/template_side_bar',$data);
                $this->load->view('bu_user/new_order_book/view_order_book_details',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-bu');
            }
    }
    public function bu_edit_order_book($value1,$value2){
            $keys_id="preetishwebneworder";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $scripts='';
                $data=array('title' =>"View Detail Information Of Order Booked",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','Slno_n_order'=>$value1,'token_id'=>$value2);
                $this->load->view('template/template_header',$data);
                $this->load->view('bu_user/template/template_top_head');
                $this->load->view('bu_user/template/template_side_bar',$data);
                $this->load->view('bu_user/new_order_book/edit_order_book',$data);
                $this->load->view('template/template_footer',$data);

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-bu');  
            }
        
    }
    public function bu_edit_new_order_book_save(){
        
        $value1=$this->input->post('value1');
        $value2=$this->input->post('value2');
        $keys_id="preetishwebneworder";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){

                $data_brower['browser'] = $this->agent->browser();
                $data_brower['browserVersion'] = $this->agent->version();
                $data_brower['platform'] = $this->agent->platform();
                $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
                $ip = $this->input->ip_address();       
                $date_nrowser_json=json_encode($data_brower);
                $date_entry=date('Y-m-d');
                $time_entry=date('H:i:s');

                $LOI_date_contract=$this->input->post('LOI_date_contract');
                $Contract_value=$this->input->post('Contract_value');
                $Contract_start_date=$this->input->post('Contract_start_date');
                $Contract_duration=$this->input->post('Contract_duration');
                $Remarks=$this->input->post('Remarks');
                $Project_desc=$this->input->post('Project_desc');
                $Contract_sign_date=$this->input->post('Contract_sign_date');
                $Supply_order_value=$this->input->post('Supply_order_value');
                $Contratual_completion=$this->input->post('Contratual_completion');



                $data_insert_new_order_booked = array('Job_description'=>$Project_desc,  'LOI_date_contract'=>$LOI_date_contract, 'Contract_sign_date'=>$Contract_sign_date, 'Contract_value'=>$LOI_date_contract, 'Supply_order_value'=>$Supply_order_value, 'Contract_start_date'=>$Contract_start_date, 'Contractual_completion'=>$Contratual_completion, 'Contract_duration'=>$Contract_duration, 'Remark'=>$Remarks, 'Status'=>'1', 'Date_entry'=>$date_entry, 'Time_entry'=>$time_entry);
                    $table_new_order="master_new_order_book";
                    $data_update_id = array('Slno_n_order' => $value1_convered_id );
                    $query_insert_new_order=$this->user->common_update($table_new_order,$data_insert_new_order_booked,$data_update_id);
                    $data_update = array('update_date' =>$data_insert_new_order_booked ,'data_id'=> $data_update_id);
                    $date_insert_json=json_encode($data_update);
                    $table_log='pms_log_entries';
                    $log_entry= array('Form_name'=>"Bu User Update Order Book edit", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
                    $result_log_entry = $this->user->common_insert($table_log,$log_entry);

                    

                    $this->session->set_flashdata('success_message', 'successfully Order Book is Updated ');
                             // After that you need to used redirect function instead of load view such as                 
                    redirect('bu-view-order-booked-info/'.$value1.'/'.$value2);
                // print_r($this->input->post());
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-bu');  
            }
        # code...
    }
    public function bu_job_code_desc(){
        
        $field_id=$this->input->post('field_id');
        $job_codes=$this->input->post('job_codes');
        $data_array = array('Project_Slno' => $job_codes);
        $table="master_project";
        $query=$this->db->get_where($table,$data_array);
        $result=$query->result();
        $data_result=$result[0];
        $project_Description=$data_result->project_Description;
        $data_result_array = array('id_desc' =>$project_Description);
        echo json_encode($data_result_array);
        exit;
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