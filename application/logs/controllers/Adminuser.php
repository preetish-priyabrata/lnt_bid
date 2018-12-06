<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminuser extends CI_Controller {
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
        public function user_admin(){
            $scripts='';
            $data=array('title' =>"Admin Dashboard",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/user_dashboard');
            $this->load->view('template/template_footer',$data);
        }
        public function user_admin_home(){
             $scripts='';
            $data=array('title' =>"Admin Dashboard",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            
            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/user_dashboard');
            $this->load->view('template/template_footer',$data);
        }
######################################################################################################################################
#                                                                                                                                   #
#                                   User Creation view Updater password update status                                               #
#                                                                                                                                   #
######################################################################################################################################
        public function viewusers(){
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View System User",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/user_creation/view_users_list');
            $this->load->view('template/template_footer',$data);
        }
        
        public function admin_add_users(){
               $scripts='<script src="https://cdnjs.cloudflare.com/ajax/libs/hideshowpassword/2.0.8/hideShowPassword.min.js"></script>';
            $data=array('title' =>"Admin Add New Users",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/user_creation/create_admin_user');
            $this->load->view('template/template_footer',$data);
          
        }
        public function admin_add_users_save(){
            // print_r($this->input->post());
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
            $user_name=trim($this->input->post('user_name'));
            $user_mobile=trim($this->input->post('user_mobile'));
            $password=trim($this->input->post('password'));
            $user_email=trim($this->input->post('user_email'));
            $user_degination=trim($this->input->post('user_degination'));
            $user_role=trim($this->input->post('user_role'));

            if(!empty($user_mobile) && !empty($user_email) && !empty($user_name) && !empty($password) && !empty($user_degination) && !empty($user_role)){

                $data_email= array('email_id'=>$user_email);
                $table='master_admin';                
                $result_email= $this->user->check_present($table,$data_email);
                if($result_email==0){
                    $data_moblie= array('user_mobile '=>$user_mobile);                                 
                    $result_mobile= $this->user->check_present($table,$data_moblie);
                    if($result_mobile==0){
                        $data_insert = array('email_id'=>$user_email, 'Username'=>$user_name, 'Password'=>$password, 'password_hash'=>md5($password), 'Status'=>1, 'role_id'=>$user_role, 'user_mobile'=>$user_mobile, 'user_degination'=>$user_degination );
                       
                        $result_insert = $this->user->common_insert($table,$data_insert);
                        $date_insert_json=json_encode($data_insert);
                        $table_log='pms_log_entries';
                        $log_entry= array('Form_name'=>"User_Entry_Form", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
                        $result_log_entry = $this->user->common_insert($table_log,$log_entry);
                        $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
                        // After that you need to used r
                        redirect('user-admin-home');
                    }else{
                         $this->session->set_flashdata('error_message', 'Moblie no already exists');
                        // After that you need to used r
                        redirect('user-admin-home');
                    }
                }else{
                    $this->session->set_flashdata('error_message', 'Email id already exists');
                    // After that you need to used r
                    redirect('user-admin-home');
                }

            }else{
                    $this->session->set_flashdata('error_message', 'Please Fill all Detail information of User ');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');
            }

            // Array ( [user_name] => sam [user_mobile] => 5678789433 [password] => Address@92 [user_email] => sam@ilab.com [user_degination] => user [user_role] => 2 ) 
        }
        public function admin_user_change_password($value1,$value2){
            // echo $value2;
            // echo "<br>";
            // echo $value1;
            $keys_id="preetishweb";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $scripts='<script src="https://cdnjs.cloudflare.com/ajax/libs/hideshowpassword/2.0.8/hideShowPassword.min.js"></script>';
            
                $data=array('title' =>"Admin Change Password for Users",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','user_id'=>$value1,'token'=>$value2);
                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/user_creation/change_user_password',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                 $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');
            }
            # code...
        }
        public function admin_add_users_save_password(){
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
            $user_id_slno=$this->input->post('user_id_slno');
            $token_id=$this->input->post('token_id');
            $password=$this->input->post('password');
            $keys_id="preetishweb";
            $value1_convered = strtr($user_id_slno,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$token_id){
                $table='master_admin';
                $data_insert = array('Password'=>$password, 'password_hash'=>md5($password));
                $id=array('slno'=>$value1_convered_id);      
                $result_insert = $this->user->common_update($table,$data_insert,$id);

                $data_json=json_encode($data_insert);
                $data_id_json=json_encode($id);
                $date_insert_array = array('data_insert' => $data_json,'update_id'=>$data_id_json );
                $date_insert_json=json_encode($date_insert_array);

                $table_log='pms_log_entries';

                $log_entry= array('Form_name'=>"update users password", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);

                $result_log_entry = $this->user->common_insert($table_log,$log_entry);
                $this->session->set_flashdata('success_message', 'Password successfully Change');
                // After that you need to used r
                redirect('user-admin-home');

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');    
            }
            // Array ( [user_id_slno] => EBq6D9dEDSNHWJwsfBpyxu~Tv.jXe0EAizvq1LuUHVwc58gP.wknHjWDLrJllQ8ndtLCoeV6HFl.dn9hqLQ8xg-- [token_id] => 6 [password] => abcd!2345aA ) 
            # code...
        }
######################################################################################################################################
#
#                                                           Project Section 
#
######################################################################################################################################

        public function viewproject(){
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View System User",'script_js'=>$scripts ,'menu_status'=>'2','sub_menu'=>'2','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/project/view_project_list');
            $this->load->view('template/template_footer',$data);
          
        }
        public function viewproject_closed(){
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View System User",'script_js'=>$scripts ,'menu_status'=>'2','sub_menu'=>'2','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/project/view_project_list_closed');
            $this->load->view('template/template_footer',$data);
          
        }
        public function admin_add_projects(){
             $scripts='<script src="'.base_url().'file_css_admin/own_js.js"></script>';
            $data=array('title' =>"Admin Add New Users",'script_js'=>$scripts,'menu_status'=>'2','sub_menu'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/project/create_admin_project');
            $this->load->view('template/template_footer',$data);
        }
        public function ajax_job_code(){
            // print_r($this->input->post());
            // exit;
            $field_id=$this->input->post('field_id');
            switch ($field_id) {
                //  check job codes
                case '1':
                    $job_codes=$this->input->post('job_codes');
                    $data_check= array('job_Code' => $job_codes);
                    $table='master_project';
                    $query=$this->db->get_where($table,$data_check);
                    if ($query->num_rows() == 0) {
                        $data_respose = array('status' =>1 ,'msg'=>'job code not presernt' );
                       
                    }else{
                         $data_respose = array('status' =>2 ,'msg'=>'job code is presernt' );
                    }
                     echo json_encode($data_respose);
                    # code...
                    break;
                
                default:
                    # code...
                    break;
            }             
        }
        public function admin_add_project_save(){
           // print_r($this->input->post());
           // Array ( [Project_name] => ttt [job_code] => 55 [datepicker] => 2018-09-25 [Customer_name] => ffff [Customer_Mobile_No] => 1234565767 [Project_Description] => 5555 [bu_user] => Array ( [0] => 7 [1] => 8 ) [design_user] => Array ( [0] => 6 [1] => 9 [2] => 10 ) [project_user] => Array ( [0] => 11 [1] => 12 ) [procurement_user] => Array ( [0] => 13 [1] => 14 ) [buyers_user] => Array ( [0] => 13 [1] => 14 ) ) 
          
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);

            $Project_name=trim($this->input->post('Project_name'));
            $job_code=trim($this->input->post('job_code'));
            $datepicker=trim($this->input->post('datepicker'));
            $Customer_name=trim($this->input->post('Customer_name'));
            $Customer_Mobile_No=trim($this->input->post('Customer_Mobile_No'));
            $Project_Description=trim($this->input->post('Project_Description'));
            $bu_user=($this->input->post('bu_user'));
            $design_user=($this->input->post('design_user'));
            $project_user=($this->input->post('project_user'));
            $procurement_user=($this->input->post('procurement_user'));
            $buyers_user=($this->input->post('buyers_user'));
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
            if(!empty($Project_name) && !empty($job_code) &&  !empty($datepicker) && !empty($Customer_name) && !empty($Customer_Mobile_No) && !empty($Project_Description)){
                // `Project_Name`, `job_Code`, `Date_Start`, `Customer_Name`, `Customer_Mobile_No`, `project_Description`, `status`, `Date_Entry`, `Time_Entry`
                // 
                    $data_check= array('job_Code' => $job_code);
                    $table='master_project';
                    $query=$this->db->get_where($table,$data_check);
                    if ($query->num_rows() == 0) {
                        $data_project = array('Project_Name'=>$Project_name, 'job_Code'=>$job_code, 'Date_Start'=>$datepicker, 'Customer_Name'=>$Customer_name, 'Customer_Mobile_No'=>$Customer_Mobile_No, 'project_Description'=>$Project_Description, 'status'=>'1', 'Date_Entry'=>$date_entry, 'Time_Entry'=>$time_entry);
                        $entry_project = $this->user->common_insert_id($table,$data_project);

                        if($entry_project!=0){
                            $date_insert_json=json_encode($data_project);
                            $table_log='pms_log_entries';
                            $log_entry= array('Form_name'=>"Project Entry Form", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
                            $result_log_entry = $this->user->common_insert($table_log,$log_entry);
                            $last_id=$entry_project;
                            $table_admin="master_admin";
                                // bu user 
                                // 
                                if(!empty($bu_user)){
                                    foreach ($bu_user as $key_bu) {
                                        $data_bu_get = array('slno' => $key_bu );
                                        $query_bu=$this->db->get_where($table_admin,$data_bu_get);
                                        $data_db=$query_bu->result();
                                        $row = $data_db[0]; 
                                        $email_id=$row->email_id;
                                        $role_id=$row->role_id;
                                        $table_assign="assign_project_user";
                                        $data_assign= array('user_slno'=>$key_bu, 'email_id'=>$email_id, 'project_slno'=>$last_id, 'job_code'=>$job_code, 'status'=>'1', 'role_id'=>$role_id, 'date_create'=>$date_entry, 'time_create'=>$time_entry);
                                         $this->user->common_insert_id($table_assign,$data_assign);

                                        
                                    }
                                }
                                // project user 
                                // 
                                if(!empty($project_user)){
                                    foreach ($project_user as $key_bu) {
                                        $data_bu_get = array('slno' => $key_bu );
                                        $query_bu=$this->db->get_where($table_admin,$data_bu_get);
                                        $data_db=$query_bu->result();
                                        $row = $data_db[0]; 
                                        $email_id=$row->email_id;
                                        $role_id=$row->role_id;
                                        $table_assign="assign_project_user";
                                        $data_assign= array('user_slno'=>$key_bu, 'email_id'=>$email_id, 'project_slno'=>$last_id, 'job_code'=>$job_code, 'status'=>'1', 'role_id'=>$role_id, 'date_create'=>$date_entry, 'time_create'=>$time_entry);
                                         $this->user->common_insert_id($table_assign,$data_assign);

                                        
                                    }
                                }
                                // procurement user
                                // 
                                if(!empty($procurement_user)){
                                    foreach ($procurement_user as $key_bu) {
                                        $data_bu_get = array('slno' => $key_bu );
                                        $query_bu=$this->db->get_where($table_admin,$data_bu_get);
                                        $data_db=$query_bu->result();
                                        $row = $data_db[0]; 
                                        $email_id=$row->email_id;
                                        $role_id=$row->role_id;
                                        $table_assign="assign_project_user";
                                        $data_assign= array('user_slno'=>$key_bu, 'email_id'=>$email_id, 'project_slno'=>$last_id, 'job_code'=>$job_code, 'status'=>'1', 'role_id'=>$role_id, 'date_create'=>$date_entry, 'time_create'=>$time_entry);
                                         $this->user->common_insert_id($table_assign,$data_assign);

                                        
                                    }
                                }
                                // design user
                                // 
                                 if(!empty($design_user)){
                                    foreach ($design_user as $key_bu) {
                                        $data_bu_get = array('slno' => $key_bu );
                                        $query_bu=$this->db->get_where($table_admin,$data_bu_get);
                                        $data_db=$query_bu->result();
                                        $row = $data_db[0]; 
                                        $email_id=$row->email_id;
                                        $role_id=$row->role_id;
                                        $table_assign="assign_project_user";
                                        $data_assign= array('user_slno'=>$key_bu, 'email_id'=>$email_id, 'project_slno'=>$last_id, 'job_code'=>$job_code, 'status'=>'1', 'role_id'=>$role_id, 'date_create'=>$date_entry, 'time_create'=>$time_entry);
                                         $this->user->common_insert_id($table_assign,$data_assign);

                                        
                                    }
                                }

                                // buyer user 
                                // 
                                if(!empty($buyers_user)){
                                    foreach ($buyers_user as $key_bu) {
                                        $data_bu_get = array('slno' => $key_bu );
                                        $query_bu=$this->db->get_where($table_admin,$data_bu_get);
                                        $data_db=$query_bu->result();
                                        $row = $data_db[0]; 
                                        $email_id=$row->email_id;
                                        $role_id=$row->role_id;
                                        $table_assign="assign_project_user";
                                        $data_assign= array('user_slno'=>$key_bu, 'email_id'=>$email_id, 'project_slno'=>$last_id, 'job_code'=>$job_code, 'status'=>'1', 'role_id'=>$role_id, 'date_create'=>$date_entry, 'time_create'=>$time_entry);
                                         $this->user->common_insert_id($table_assign,$data_assign);

                                        
                                    }
                                }

                                $this->session->set_flashdata('success_message', 'successfully Project add  to our records');
                                // After that you need to used redirect function instead of load view such as               
                                redirect('user-admin-home');  

                        }else{
                            $this->session->set_flashdata('error_message', 'Something went worng , Unable save project information Try again');
                            // After that you need to used redirect function instead of load view such as                 
                            redirect('user-admin-home');  
                        }

                    }else{
                        $this->session->set_flashdata('error_message', 'Job code already exists');
                         // After that you need to used redirect function instead of load view such as                 
                        redirect('user-admin-home');  
                    }

            }else{
                $this->form_validation->set_rules('Project_name', 'Project Name', 'required');
                $this->form_validation->set_rules('job_code', 'Job Code', 'required');
                $this->form_validation->set_rules('datepicker', 'Date Starting', 'required');
                $this->form_validation->set_rules('Customer_name', 'Customer Name', 'required');
                $this->form_validation->set_rules('Customer_Mobile_No', 'Customer Mobile No', 'required');
                $this->form_validation->set_rules('Project_Description', 'Project Description', 'required');

                $this->session->set_flashdata('error_message', 'Some Field Left blank');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');    
            }

        }
        public function admin_view_project_details($value1,$value2){
             $keys_id="preetishwebproject";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $scripts='<script src="https://cdnjs.cloudflare.com/ajax/libs/hideshowpassword/2.0.8/hideShowPassword.min.js"></script>';
            
                $data=array('title' =>"Admin Project Information view",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','project_slno'=>$value1,'token'=>$value2);
                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/project/view_details_project',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                 $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');
            }
            # code...
            # code...
        }
        public function admin_view_project_details_comp($value1,$value2){
             $keys_id="preetishwebproject";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $scripts='<script src="https://cdnjs.cloudflare.com/ajax/libs/hideshowpassword/2.0.8/hideShowPassword.min.js"></script>';
            
                $data=array('title' =>"Admin Project Information view",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','project_slno'=>$value1,'token'=>$value2);
                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/project/view_details_project_complete',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                 $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');
            }
            # code...
            # code...
        }

        public function admin_remove_users_delete_project($value1,$value2,$value3,$value){

            // echo $value1;
            // echo "<br>";
            // echo $value2;
            //  echo "<br>";
            // echo $value3;
            $keys_id="preetishwebproject";
            $value1_convered = strtr($value2,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value3){
                switch ($value) {                 
                    case '2':
                        $user ="Design";
                        break;
                    case '3':
                         $user ="Project";
                        break;
                    case '4':
                         $user ="Procurement";
                        break;
                    case '5':
                         $user ="Report";
                        break;
                    case '6':
                        $user="Bu";
                        break;
                    case '7':
                        $user="Buyer";
                        break;
                    default:
                        $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                        // After that you need to used redirect function instead of load view such as                 
                        redirect('user-admin-home');
                        break;
                }
                $table="assign_project_user";

                $data_array = array('slno_assign_project' => $value1);
                $delete=$this->db->delete($table,$data_array);
                 // echo  $this->db->last_query();
                if($delete){
                    $this->session->set_flashdata('success_message', 'successfully Deleted '.$user.' user from the project');
                     // After that you need to used redirect function instead of load view such as                 
                    redirect('admin-project-view-details/'.$value2.'/'.$value3);
                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home');
                }
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');
            }
        }
        public function admin_add_assign_user_project($value,$value1,$value2,$value3){
           
            
            $keys_id="preetishwebproject";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $scripts='';
            
                $data=array('title' =>"Admin Assign User to Project",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','project_slno'=>$value1,'token'=>$value2,'user_type'=>$value,'job_Code'=>$value3);
                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/project/add_assign_user_to_project',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                 $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');
            }
           
        }
        public function admin_add_assign_userto_project(){
            

            // Array ( [value1] => 7GSr3NkaQ0YW0W6VcdpRxpXCKpkxiP6Pi4xkSb0b5fhUjCT0~NCJUnPCKvoyqVcVI8542AlO6YJq6w1cmG.Yfw-- [value2] => 4 [user_type] => 7 [job_Code] => 07744 [design_user] => Array ( [0] => 15 [1] => 16 ) ) 
           $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
            $value1=$this->input->post('value1');
            $value2=$this->input->post('value2');
            $user_type=$this->input->post('user_type');
            $job_Code=$this->input->post('job_Code');
            $design_user=$this->input->post('design_user');

             switch ($user_type) {                 
                    case '2':
                        $userids ="Design";
                        break;
                    case '3':
                         $userids ="Project";
                        break;
                    case '4':
                         $userids ="Procurement";
                        break;
                    case '5':
                         $userids ="Report";
                        break;
                    case '6':
                        $userids="Bu";
                        break;
                    case '7':
                        $userids="Buyer";
                        break;
                    case '8':
                        $userids="Approver";
                        break;
                    case '9':
                        $userids="Technical";
                        break;
                    default:
                        $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                        // After that you need to used redirect function instead of load view such as                 
                        redirect('user-admin-home');
                        break;
                }

            $keys_id="preetishwebproject";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                if(!empty($design_user)){
                     $table_admin="master_admin";
                   
                     foreach ($design_user as $key_bu) {
                        $data_bu_get = array('slno' => $key_bu );
                        $query_bu=$this->db->get_where($table_admin,$data_bu_get);
                        $data_db=$query_bu->result();
                        $row = $data_db[0]; 
                        $email_id=$row->email_id;
                        $role_id=$row->role_id;
                        $table_assign="assign_project_user";
                        $data_assign= array('user_slno'=>$key_bu, 'email_id'=>$email_id, 'project_slno'=>$value1_convered_id, 'job_code'=>$job_Code, 'status'=>'1', 'role_id'=>$role_id, 'date_create'=>$date_entry, 'time_create'=>$time_entry);
                         $this->user->common_insert_id($table_assign,$data_assign);

                        
                    }
                    $this->session->set_flashdata('success_message', 'successfully  assign of '.$userids.' users from the project');
                  
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('admin-project-view-details/'.$value1.'/'.$value2);  

                }else{
                     $this->session->set_flashdata('error_message', 'No '.$userids.' user is been selected to assign');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('admin-project-view-details/'.$value1.'/'.$value2);
                }


           }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');
           }
        }
        public function admin_edit_user_project($value1,$value2,$value){ /// incompltete
           $keys_id="preetishwebproject";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
            $scripts='';
            
                $data=array('title' =>"Admin Assign User to Project",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','project_slno'=>$value1,'token'=>$value2,'job_Code'=>$value);
                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/project/add_assign_user_to_project',$data);
                $this->load->view('template/template_footer',$data);

            }else{
                   $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }

######################################################################################################################################
#
#                                                           Section starting
#
######################################################################################################################################
        public function admin_view_section(){

            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View Section List",'script_js'=>$scripts ,'menu_status'=>'3','sub_menu'=>'3','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/section/view_section_list');
            $this->load->view('template/template_footer',$data);     
           
        }

        public function admin_add_section(){
           $scripts='';

           $data=array('title' =>"Create  New Section ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/section/create_section_list');
            $this->load->view('template/template_footer',$data);
        }
        public function admin_add_section_save(){
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
            $table='section';
            // print_r($this->input->post());
            // Array ( [Section_name] => xyz ) 
            $Section_name=trim($this->input->post('Section_name'));
            $data_section = array('section_Name'=>$Section_name, 'Status'=>'1', 'Date_Entry'=>$date_entry, 'Time_Entry'=>$time_entry);

            $result_insert = $this->user->common_insert($table,$data_section);
            $date_insert_json=json_encode($data_section);
            $table_log='pms_log_entries';
            $log_entry= array('Form_name'=>"section entry", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
            $result_log_entry = $this->user->common_insert($table_log,$log_entry);
            $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
            // After that you need to used redirect home
             redirect('user-admin-home');

        }
        public function admin_change_status_section($value1,$value2,$value){
            $keys_id="preetishwebsection";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $data = array('Section_Slno' =>$value1_convered_id);
                $table='section';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                if($value==1){

                    $data_id = array('Section_Slno' =>$value1_convered_id);
                    $date_change= array('Status' =>'2' );
                    $table="section";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->section_Name.' successfully Inactivated ');
                    // After that you need to used redirect home
                     redirect('admin-view-section');

                }else if($value==2){
                    $data_id = array('Section_Slno' =>$value1_convered_id);
                    $date_change= array('Status' =>'1' );
                    $table="section";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->section_Name.' successfully Activated ');
                    // After that you need to used redirect home
                      redirect('admin-view-section');

                 }else if($value==3){
                    $data_id = array('Section_Slno' =>$value1_convered_id);
                    $date_change= array('Status' =>'3' );
                    $table="section";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->section_Name.' successfully Deleted ');
                    // After that you need to used redirect home
                      redirect('admin-view-section');

                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home'); 
                }

           }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
           }

        }

        public function admin_edit_section_info($value1,$value2){
            $keys_id="preetishwebsection";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $scripts='';

               $data=array('title' =>"Edit Section Information ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','section_slno'=>$value1,'token'=>$value2);  

                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/section/edit_section_information',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
          
        }
        public function admin_edit_section_save(){
            // print_r($this->input->post());
            // Array ( [value1] => Ux~3K3WzWIvRyLAuOq64MvafGrO3OyhCQRxz8C9a42yGItugOnzHoJp5P0AQkG~XaHk8G7.VDD0kZCQQvQJGDg-- [value2] => 2 [Section_name] => section 1 ) 
            $value1=trim($this->input->post('value1'));
            $value2=trim($this->input->post('value2'));
            $Section_name=trim($this->input->post('Section_name'));
            $keys_id="preetishwebsection";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
                $data = array('Section_Slno' =>$value1_convered_id);
                $table='section';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                $data_section=$row->section_Name;
           if($value1_convered_id==$value2){
                $data_id = array('Section_Slno' =>$value1_convered_id);
                $date_change= array('section_Name' =>$Section_name );
                $table="section";
                $result_history = $this->user->common_update($table,$date_change,$data_id);
                // $this->session->set_flashdata('success_message',$data_section .' change to  '.$Section_name);
                $this->session->set_flashdata('success_message',' successfully Section information '.$data_section .' change to  '.$Section_name);
                // After that you need to used redirect home
                redirect('admin-view-section');

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }


        }
######################################################################################################################################
#
#                                               Admin Activity module is started
#
######################################################################################################################################
        public function admin_view_activity(){
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View Activity List",'script_js'=>$scripts ,'menu_status'=>'4','sub_menu'=>'4','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/activity/view_activity_list');
            $this->load->view('template/template_footer',$data);   
        }
        public function admin_add_activity(){
           $scripts='';

           $data=array('title' =>"Create  New Section ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/activity/create_new_activity');
            $this->load->view('template/template_footer',$data);

        }
        public function admin_add_activity_save(){
            // print_r($this->input->post());
            // Array ( [activity_name] => activity [activity_desc] => Director : Bhaskar Producer : Nagendra Babu Music Director : Harris Jayaraj Lyricst : Surendra Krishna, Kedarnath, Vanamali, Ramajogaya Sastry Cast : Ram Charan Teja, Genelia D'Souza, Shazahn Padamsee, Sanchita Shetty ) 
            $activity_name=trim($this->input->post('activity_name'));
            $activity_desc=trim($this->input->post('activity_desc'));

            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
            $table='activity';
            // print_r($this->input->post());
            // Array ( [Section_name] => xyz ) 
            $Section_name=trim($this->input->post('Section_name'));
            $data_activity = array('Activity_Name'=>$activity_name, 'Activity_Description'=>$activity_desc, 'Status'=>'1', 'Date_Entry'=>$date_entry, 'Time_Entry'=>$time_entry);

            $result_insert = $this->user->common_insert($table,$data_activity);
            $date_insert_json=json_encode($data_activity);
            $table_log='pms_log_entries';
            $log_entry= array('Form_name'=>"activity entry", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
            $result_log_entry = $this->user->common_insert($table_log,$log_entry);
            if($result_insert){
                  $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
                // After that you need to used redirect home
                redirect('admin-view-activity');
                # code...  
                // 
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
                // After that you need to used redirect home
                redirect('user-admin-home');
                # code...  
            }
            
        }
        public function admin_change_status_activity($value1,$value2,$value){
            $keys_id="preetishwebactivity";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $data = array('Activity_Slno' =>$value1_convered_id);
                $table='activity';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                if($value==1){

                    $data_id = array('Activity_Slno' =>$value1_convered_id);
                    $date_change= array('Status' =>'2' );
                    $table="activity";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->Activity_Name.' successfully Inactivated ');
                    // After that you need to used redirect home
                     redirect('admin-view-activity');

                }else if($value==2){
                    $data_id = array('Activity_Slno' =>$value1_convered_id);
                    $date_change= array('Status' =>'1' );
                    $table="activity";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->Activity_Name.' successfully Activated ');
                    // After that you need to used redirect home
                      redirect('admin-view-activity');

                 }else if($value==3){
                    $data_id = array('Activity_Slno' =>$value1_convered_id);
                    $date_change= array('Status' =>'3' );
                    $table="activity";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->Activity_Name.' successfully Deleted ');
                    // After that you need to used redirect home
                      redirect('admin-view-activity');

                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home'); 
                }

           }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
           }
            # code...
        }
        public function admin_edit_activity_info($value1,$value2){
            $keys_id="preetishwebactivity";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $scripts='';

               $data=array('title' =>"Edit Section Information ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','Activity_Slno'=>$value1,'token'=>$value2);  

                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/activity/edit_activity_information',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
          
        }
        public function admin_edit_activity_save(){
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');

            $value1=trim($this->input->post('value1'));
            $value2=trim($this->input->post('value2'));
            $activity_name=trim($this->input->post('activity_name'));
            $activity_desc=trim($this->input->post('activity_desc'));

            $keys_id="preetishwebactivity";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $data_id = array('Activity_Slno' =>$value1_convered_id);               
                $date_change = array('Activity_Name'=>$activity_name, 'Activity_Description'=>$activity_desc);

                $table="activity";
                $result_history = $this->user->common_update($table,$date_change,$data_id);

                $date_insert_json = array('date_change' =>$date_change,'$data_id' =>$data_id);
                $date_insert_json=json_encode($date_insert_json);
                $table_log='pms_log_entries';
                $log_entry= array('Form_name'=>"activity edit", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
                $result_log_entry = $this->user->common_insert($table_log,$log_entry);

                $this->session->set_flashdata('success_message', 'Information Has been updated successfully');
                // After that you need to used redirect home
                redirect('admin-view-activity');

           }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
           }
           
          
        }
####################################################################################################################################
#
#                                           Admin Category create delete update status
#
####################################################################################################################################
    public function admin_view_category(){
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View category List",'script_js'=>$scripts ,'menu_status'=>'5','sub_menu'=>'5','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/category/view_category_list');
            $this->load->view('template/template_footer',$data);   
        }
        public function admin_add_category(){
             $scripts='';

            $data=array('title' =>"Create  New Category ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/category/create_category_list');
            $this->load->view('template/template_footer',$data);
        }
        public function admin_add_category_save(){
            
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');

            $category_name=trim($this->input->post('category_name'));
            $category_id=trim($this->input->post('category_id'));
            $category_short=trim($this->input->post('category_short'));
            $category_Description=trim($this->input->post('category_Description'));
            
            $data_insert_category = array('category_name'=>$category_name, 'category_id'=>$category_id, 'category_desc'=>$category_Description, 'short_code'=>$category_short, 'status'=>'1', 'date_entry'=>$date_entry, 'time_entry'=>$time_entry);
            $table="master_category";
            $entry_project = $this->user->common_insert_id($table,$data_insert_category);
            $date_insert_json=json_encode($data_insert_category);
            $table_log='pms_log_entries';
            $log_entry= array('Form_name'=>"Category entry", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
            $result_log_entry = $this->user->common_insert($table_log,$log_entry);
            if($result_log_entry){
                  $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
                // After that you need to used redirect home
                redirect('admin-view-category');
                # code...  
                // 
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
                // After that you need to used redirect home
                redirect('user-admin-home');
                # code...  
            }
        }

        public function admin_change_status_category($value1,$value2,$value){

            $keys_id="preetishwebcategory";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $data = array('Slno_cat' =>$value1_convered_id);
                $table='master_category';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                if($value==1){

                    $data_id = array('Slno_cat' =>$value1_convered_id);
                    $date_change= array('status' =>'2' );
                    $table="master_category";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->category_name.' successfully Inactivated ');
                    // After that you need to used redirect home
                     redirect('admin-view-category');

                }else if($value==2){
                    $data_id = array('Slno_cat' =>$value1_convered_id);
                    $date_change= array('status' =>'1' );
                    $table="master_category";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->category_name.' successfully Activated ');
                    // After that you need to used redirect home
                      redirect('admin-view-category');

                 }else if($value==3){
                    $data_id = array('Slno_cat' =>$value1_convered_id);
                    $date_change= array('status' =>'3' );
                    $table="master_category";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->category_name.' successfully Deleted ');
                    // After that you need to used redirect home
                      redirect('admin-view-category');

                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home'); 
                }

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
           
        }
        public function admin_edit_category_info($value1,$value2){
             $keys_id="preetishwebcategory";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $scripts='';

               $data=array('title' =>"Edit Category Information ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','category_Slno'=>$value1,'token'=>$value2);  

                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/category/edit_category_information',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }

        }
        public function admin_edit_category_save(){
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
            // Array ( [value1] => AfvXk6KN46UmM4HFEQyk.jrAUJ0M1ibWltyooI58L51JNb8n5oozhXsYeZRo6F3qzc3rQPwqqJZXPs~2mlCULQ-- [value2] => 1 [Category_name] => standard catalogued item [category_id] => cat001 [category_short] => sci [category_Description] => A cataloger is an individual responsible for the processes of description, subject analysis, classification, and authority control of library materials. Catalogers serve as the "foundation of all library service, as they are the ones who organize information in such a way as to make it easily accessible" ) 
           // print_r($this->input->post());
            $value1=trim($this->input->post('value1'));
            $value2=trim($this->input->post('value2'));
            $Category_name=trim($this->input->post('Category_name'));
            $category_id=trim($this->input->post('category_id'));
            $category_short=trim($this->input->post('category_short'));
            $category_Description=trim($this->input->post('category_Description'));
             $keys_id="preetishwebcategory";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $data_id = array('Slno_cat' =>$value1_convered_id);
                $date_change= array('category_name'=>$Category_name, 'category_id'=>$category_id, 'category_desc'=>$category_Description, 'short_code'=>$category_short );
                $table="master_category";
                $result_history = $this->user->common_update($table,$date_change,$data_id);
                $total_change = array('data_change' =>$date_change ,'data_id'=>$data_id );
                $date_insert_json=json_encode($total_change);
                $table_log='pms_log_entries';
                $log_entry= array('Form_name'=>"Category update", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
                $result_log_entry = $this->user->common_insert($table_log,$log_entry);
                if($result_log_entry){
                      $this->session->set_flashdata('success_message', 'information update successfully');
                    // After that you need to used redirect home
                    redirect('admin-view-category');
                    # code...  
                    // 
                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
                    // After that you need to used redirect home
                    redirect('user-admin-home');
                    # code...  
                }
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }

#####################################################################################################################################
#
#                       Admin other charges create view delete update ,change status
#
#####################################################################################################################################
        public function admin_view_other_charges(){
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View other charge List",'script_js'=>$scripts ,'menu_status'=>'6','sub_menu'=>'6','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/other_charge/view_other_charges_list');
            $this->load->view('template/template_footer',$data);
        }
        public function admin_add_Other_charges(){
            $scripts='';

            $data=array('title' =>"Create  New Category ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/other_charge/create_add_other_charge');
            $this->load->view('template/template_footer',$data);
        }
        public function admin_add_Other_charges_save(){
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
           
           // Array ( [Other_charges_name] => freight Charges ) 
           $Other_charges_name=$this->input->post('Other_charges_name');


            $data_insert_other_charges = array('Charges_name'=>$Other_charges_name, 'description_charge'=>'', 'charge_value'=>'', 'status'=>'1', 'date_entry'=>$date_entry, 'time_entry'=>$time_entry);
            $table="master_charges_other";
            $entry_project = $this->user->common_insert_id($table,$data_insert_other_charges);
            $date_insert_json=json_encode($data_insert_other_charges);
            $table_log='pms_log_entries';
            $log_entry= array('Form_name'=>"other charges entry", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
            $result_log_entry = $this->user->common_insert($table_log,$log_entry);
            if($result_log_entry){
                $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
                // After that you need to used redirect home
                redirect('admin-view-other-charges');
                exit();
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
                // After that you need to used redirect home
                redirect('user-admin-home');
                # code...  
            }
        }
        public function admin_change_status_Other_charges($value1,$value2,$value){

            $keys_id="preetishwebOthercharges";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $data = array('Slno_other' =>$value1_convered_id);
                $table='master_charges_other';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                if($value==1){

                    $data_id = array('Slno_other' =>$value1_convered_id);
                    $date_change= array('status' =>'2' );
                    $table="master_charges_other";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->Charges_name.' successfully Inactivated ');
                    // After that you need to used redirect home
                     redirect('admin-view-other-charges');

                }else if($value==2){
                    $data_id = array('Slno_other' =>$value1_convered_id);
                    $date_change= array('status' =>'1' );
                    $table="master_charges_other";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->Charges_name.' successfully Activated ');
                    // After that you need to used redirect home
                      redirect('admin-view-other-charges');

                 }else if($value==3){
                    $data_id = array('Slno_other' =>$value1_convered_id);
                    $date_change= array('status' =>'3' );
                    $table="master_charges_other";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->Charges_name.' successfully Deleted ');
                    // After that you need to used redirect home
                      redirect('admin-view-other-charges');

                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home'); 
                }

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }
        public function admin_edit_Other_charges_info($value1,$value2){
             $keys_id="preetishwebOthercharges";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $scripts='';

               $data=array('title' =>"Edit Category Information ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','Slno_other'=>$value1,'token'=>$value2);  

                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/other_charge/edit_other_charges_information',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }

        }
        public function admin_edit_Other_charges_save(){
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
            
            $value1=trim($this->input->post('value1'));
            $value2=trim($this->input->post('value2'));
            $Charges_name=trim($this->input->post('Charges_name'));
           
             $keys_id="preetishwebOthercharges";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $data_id = array('Slno_other' =>$value1_convered_id);
                $date_change= array('Charges_name'=>$Charges_name );
                $table="master_charges_other";
                $result_history = $this->user->common_update($table,$date_change,$data_id);
                $total_change = array('data_change' =>$date_change ,'data_id'=>$data_id );
                $date_insert_json=json_encode($total_change);
                $table_log='pms_log_entries';
                $log_entry= array('Form_name'=>"other charge update", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
                $result_log_entry = $this->user->common_insert($table_log,$log_entry);
                if($result_log_entry){
                      $this->session->set_flashdata('success_message', 'information update successfully');
                    // After that you need to used redirect home
                    redirect('admin-view-other-charges');
                    # code...  
                    // 
                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
                    // After that you need to used redirect home
                    redirect('user-admin-home');
                    # code...  
                }
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }


#####################################################################################################################################
#
#                                              material item create delete update status change
#
#####################################################################################################################################
        public function admin_view_Material_Item(){
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View Material Item List",'script_js'=>$scripts ,'menu_status'=>'7','sub_menu'=>'7','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/material_item/view_material_item_list');
            $this->load->view('template/template_footer',$data);
        }
        public function admin_add_Material_Item(){
            $scripts='';

            $data=array('title' =>"Create New Material Item ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/material_item/create_material_item');
            $this->load->view('template/template_footer',$data);   
        }
        public function admin_add_Material_Item_save(){
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
          //Array ( [Item_Name] => xyz [item_id] => 11 [category_Description] => abc [item_uom] => 20 [category_name] => cat001 [category_id] => cat001 )
            $Item_Name=trim($this->input->post('Item_Name'));
            $item_id=trim($this->input->post('item_id'));
            $category_Description=trim($this->input->post('category_Description'));
            $item_uom=trim($this->input->post('item_uom'));
            $category_name=trim($this->input->post('category_name'));
            $category_id=trim($this->input->post('category_id'));

            $table='master_category';
            $data_array = array('status' => 1,'category_id'=>$category_id);
            $query=$this->db->get_where($table,$data_array);
            $data_db=$query->result(); // here fetch information 
            $row = $data_db[0]; 

            $data_insert_other_charges = array('Category_slno'=>$row->Slno_cat, 'item_name'=>$Item_Name, 'item_id'=>$item_id, 'item_detail'=>$category_Description, 'item_uom'=>$item_uom, 'category_id'=>$category_id, 'category_name'=>$row->category_name, 'status'=>'1', 'date_entry'=>$date_entry, 'time_entry'=>$time_entry);
            $table="master_items_material";
            $entry_project = $this->user->common_insert_id($table,$data_insert_other_charges);


            $date_insert_json=json_encode($data_insert_other_charges);
            $table_log='pms_log_entries';
            $log_entry= array('Form_name'=>"material item entry", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
            $result_log_entry = $this->user->common_insert($table_log,$log_entry);
            if($result_log_entry){
                $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
                // After that you need to used redirect home
                redirect('admin-view-Material-Item');
                exit();
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // $this->session->set_flashdata('success_message', 'Information Has been saved successfully');
                // After that you need to used redirect home
                redirect('user-admin-home');
                # code...  
            }
        }
        public function admin_change_Material_Item_status($value1,$value2,$value){

            $keys_id="preetishwebitem";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $data = array('Slno_item' =>$value1_convered_id);
                $table='master_items_material';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                if($value==1){

                    $data_id = array('Slno_item' =>$value1_convered_id);
                    $date_change= array('status' =>'2' );
                    $table="master_items_material";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->item_name.' successfully Inactivated ');
                    // After that you need to used redirect home
                     redirect('admin-view-Material-Item');

                }else if($value==2){
                    $data_id = array('Slno_item' =>$value1_convered_id);
                    $date_change= array('status' =>'1' );
                    $table="master_items_material";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->item_name.' successfully Activated ');
                    // After that you need to used redirect home
                      redirect('admin-view-Material-Item');

                 }else if($value==3){
                    $data_id = array('Slno_item' =>$value1_convered_id);
                    $date_change= array('status' =>'3' );
                    $table="master_items_material";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->item_name.' successfully Deleted ');
                    // After that you need to used redirect home
                      redirect('admin-view-Material-Item');

                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home'); 
                }

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }
        public function admin_view_Material_Item_info($value1,$value2){
           $keys_id="preetishwebitem";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $scripts='';

               $data=array('title' =>"View Material item Information ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','Slno_item'=>$value1,'token'=>$value2);  

                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/material_item/view_detail_of_mateials_item',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }
        public function admin_edit_Material_Item_info($value1,$value2){
           $keys_id="preetishwebitem";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $scripts='';

               $data=array('title' =>"View Material item Information ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','Slno_item'=>$value1,'token'=>$value2);  

                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/material_item/edit_material_info_detail',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
            # code...
        }

        public function admin_edit_Material_Item_save(){
            
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
            
            $value1=trim($this->input->post('value1'));
            $value2=trim($this->input->post('value2'));
             $keys_id="preetishwebitem";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
           $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
           if($value1_convered_id==$value2){
                $Item_Name=trim($this->input->post('Item_Name'));
                $item_id=trim($this->input->post('item_id'));
                $category_Description=trim($this->input->post('category_Description'));
                $item_uom=trim($this->input->post('item_uom'));
                $category_name=trim($this->input->post('category_name'));
                $category_id=trim($this->input->post('category_id'));


                $table='master_category';
                $data_array = array('status' => 1,'category_id'=>$category_name);
                $query=$this->db->get_where($table,$data_array);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 

                $data_update_item_material = array('Category_slno'=>$row->Slno_cat, 'item_name'=>$Item_Name, 'item_id'=>$item_id, 'item_detail'=>$category_Description, 'item_uom'=>$item_uom, 'category_id'=>$category_id, 'category_name'=>$row->category_name, 'status'=>'1', 'date_entry'=>$date_entry, 'time_entry'=>$time_entry);
                $tables="master_items_material";
               

                $data_id = array('Slno_item' =>$value1_convered_id);
                    
                    $tables="master_items_material";
                    $result_history = $this->user->common_update($tables,$data_update_item_material,$data_id);
                    $data_insert_item_material_array = array('data_update_item_material' =>$data_update_item_material , 'data_id'=>$data_id);
                $date_insert_json=json_encode($data_insert_item_material_array);
                $table_log='pms_log_entries';
                $log_entry= array('Form_name'=>"material item update", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
                $result_log_entry = $this->user->common_insert($table_log,$log_entry);
                if($result_log_entry){
                    $this->session->set_flashdata('success_message', 'Information Has been updated successfully');
                    // After that you need to used redirect home
                    redirect('admin-view-Material-Item');
                    exit();
                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    
                    redirect('user-admin-home');
                    # code...  
                }
            }else{
                  $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    
                    redirect('user-admin-home');
                    # code...  
            }
        }
#####################################################################################################################################
#
# vendors section  create update delete status
#
#####################################################################################################################################
        public function admin_view_vendors(){
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View Vendors List",'script_js'=>$scripts ,'menu_status'=>'8','sub_menu'=>'8','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/vendor/view_vendor_list');
            $this->load->view('template/template_footer',$data);

        }
        public function admin_new_vendors(){
            $scripts='';

            $data=array('title' =>"Create New Vendors ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/vendor/create_new_vendor');
            $this->load->view('template/template_footer',$data); 
            # code...
        }
        public function admin_new_vendors_save(){
            print_r($this->input->post());
            // Array ( [Vendor_name] => vendor 1 [Vendor_email_id] => vender@ilab.com [Organisation_name] => vendor pvt ltd [Organisation_address] => tesr [Mobile_no] => 99330 [Password] => 2203 [Vendor_desc] => tesrt [vendor_operational] => Array ( [0] => 3 ) ) 
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');

            $Vendor_name=trim($this->input->post('Vendor_name'));
            $Vendor_email_id=trim($this->input->post('Vendor_email_id'));
            $Organisation_address=trim($this->input->post('Organisation_address'));
            $Mobile_no=trim($this->input->post('Mobile_no'));
            $Password=trim($this->input->post('Password'));
            $Vendor_desc=trim($this->input->post('Vendor_desc'));
            $vendor_operational=($this->input->post('vendor_operational'));
            $Organisation_name=trim($this->input->post('Organisation_name'));
            $hash=md5($Password);
            $date_insert = array('Vendor_name'=>$Vendor_name, 'Vendor_email_id'=>$Vendor_email_id, 'Mobile_no'=>$Mobile_no, 'Organisation_name'=>$Organisation_name, 'Password'=>$Password, 'Password_hash'=>$hash, 'Status'=>1, 'Date_entry'=>$date_entry, 'Time_entry'=>$time_entry, 'Vendor_desc'=>$Vendor_desc, 'Organisation_address'=>$Organisation_address);
            
            $table_insert="master_vendor_detail";
            $entry_project = $this->user->common_insert_id($table_insert,$date_insert);
            $last_id=$entry_project;

            $date_insert_json=json_encode($date_insert);
            $table_log='pms_log_entries';
            $log_entry= array('Form_name'=>"Vendors Entery Form", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
            $result_log_entry = $this->user->common_insert($table_log,$log_entry);

            if(!empty($vendor_operational)){
                $table_operation="master_category";
                foreach ($vendor_operational as $key_cata) {
                    $data_bu_get = array('Slno_cat' => $key_cata );
                    $query_bu=$this->db->get_where($table_operation,$data_bu_get);
                    $data_db=$query_bu->result();
                    $row = $data_db[0]; 
                    $Operation_id=$row->category_id;
                    $Operation_slno=$row->Slno_cat;
                  
                    $Operation_name=$row->category_name;
                    $Operation_short=$row->short_code;

                    $table_assign="Vendor_operation_detail";
                    $data_assign= array('Slno_id_Vendor_slno'=>$last_id, 'Operation_name'=>$Operation_name, 'Operation_slno'=>$Operation_slno, 'Status'=>1, 'Operation_short'=>$Operation_short, 'Operation_id'=>$Operation_id, 'Date_entry'=>$date_entry, 'Time_entry'=>$time_entry);
                    
                     $this->user->common_insert_id($table_assign,$data_assign);

                    
                }
            }
            
            $this->session->set_flashdata('success_message', 'Information Has been updated successfully');
            // After that you need to used redirect home
            redirect('admin-view-vendors');
            
        }
        public function admin_view_vendors_info($value1,$value2){
            $keys_id="preetishwebvendors";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $scripts='';

               $data=array('title' =>"View Vendor details Information ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','Slno_vendor'=>$value1,'token'=>$value2);  

                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/vendor/view_vendor_deatils',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
         
         
        }
        public function admin_change_vendor_status($value1,$value2,$value){

            $keys_id="preetishwebvendors";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $data = array('Slno_vendor' =>$value1_convered_id);
                $table='master_vendor_detail';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                if($value==1){

                    $data_id = array('Slno_vendor' =>$value1_convered_id);
                    $date_change= array('status' =>'2' );
                    $table="master_vendor_detail";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->Vendor_name.' successfully Inactivated ');
                    // After that you need to used redirect home
                    redirect('admin-view-vendors');

                }else if($value==2){
                    $data_id = array('Slno_vendor' =>$value1_convered_id);
                    $date_change= array('status' =>'1' );
                    $table="master_vendor_detail";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->Vendor_name.' successfully Activated ');
                    // After that you need to used redirect home
                      redirect('admin-view-vendors');

                 }else if($value==3){
                    $data_id = array('Slno_vendor' =>$value1_convered_id);
                    $date_change= array('status' =>'3' );
                    $table="master_vendor_detail";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->Vendor_name.' successfully Deleted ');
                    // After that you need to used redirect home
                       redirect('admin-view-vendors');

                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home'); 
                }

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }           
        }
        public function admin_admin_edit_vendor_details($value1,$value2){
            $keys_id="preetishwebvendors";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                  $scripts='';

               $data=array('title' =>"View Vendor details Information ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','Slno_vendor'=>$value1,'token'=>$value2);  
                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/vendor/edit_vendor_details',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }

        public function admin_assign_vendor_operation($value1,$value2){
            $keys_id="preetishwebvendors";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                  $scripts='';

               $data=array('title' =>"View Vendor details Information ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','Slno_vendor'=>$value1,'token'=>$value2);  
                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/vendor/edit_vendor_operation_details',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }
        public function admin_vendor_new_operation(){
            
            // Array ( [value1] => rBSWV1SHEuiTE1FDtFqYh.93OS.Z6Tq8ASu0aJh447gZ.5PVSXguLOm9.zF1kNb0A61jfC94bytUfnSjcdPebg-- [value2] => 2 [vendor_operational] => Array ( [0] => 2 ) ) 
            // ());

            $value1=$this->input->post('value1');
            $value2=$this->input->post('value2');
            $vendor_operational=$this->input->post('vendor_operational');
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');
            $keys_id="preetishwebvendors";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $last_id=$value1_convered_id;
                if(!empty($vendor_operational)){
                    $table_operation="master_category";
                    foreach ($vendor_operational as $key_cata) {
                        $data_bu_get = array('Slno_cat' => $key_cata );
                        $query_bu=$this->db->get_where($table_operation,$data_bu_get);
                        $data_db=$query_bu->result();
                        $row = $data_db[0]; 
                        $Operation_id=$row->category_id;
                        $Operation_slno=$row->Slno_cat;
                      
                        $Operation_name=$row->category_name;
                        $Operation_short=$row->short_code;

                        $table_assign="Vendor_operation_detail";
                        $data_assign= array('Slno_id_Vendor_slno'=>$last_id, 'Operation_name'=>$Operation_name, 'Operation_slno'=>$Operation_slno, 'Status'=>1, 'Operation_short'=>$Operation_short, 'Operation_id'=>$Operation_id, 'Date_entry'=>$date_entry, 'Time_entry'=>$time_entry);
                        
                         $this->user->common_insert_id($table_assign,$data_assign);
                        
                    }
                }
                
                $this->session->set_flashdata('success_message', 'Information Has been updated successfully');
                // After that you need to used redirect home
                redirect('admin-view-vendors');
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');  
            }
          
        }
        public function admin_edit_vendor_save(){
            
            $value1=$this->input->post('value1');
            $value2=$this->input->post('value2');
            $vendor_operational=$this->input->post('vendor_operational');
            
            $keys_id="preetishwebvendors";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                

                $Vendor_name=$this->input->post('Vendor_name');
                $Vendor_email_id=$this->input->post('Vendor_email_id');
                $Organisation_name=$this->input->post('Organisation_name');
                $Organisation_address=$this->input->post('Organisation_address');
                $Mobile_no=$this->input->post('Mobile_no');
                $Vendor_desc=$this->input->post('Vendor_desc');
                
                $data_brower['browser'] = $this->agent->browser();
                $data_brower['browserVersion'] = $this->agent->version();
                $data_brower['platform'] = $this->agent->platform();
                $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
                $ip = $this->input->ip_address();       
                $date_nrowser_json=json_encode($data_brower);
                $date_entry=date('Y-m-d');
                $time_entry=date('H:i:s');

                
                $date_insert = array('Vendor_name'=>$Vendor_name, 'Vendor_email_id'=>$Vendor_email_id, 'Mobile_no'=>$Mobile_no, 'Organisation_name'=>$Organisation_name, 'Status'=>1, 'Date_entry'=>$date_entry, 'Time_entry'=>$time_entry, 'Vendor_desc'=>$Vendor_desc, 'Organisation_address'=>$Organisation_address);
                
                $table_insert="master_vendor_detail";
                $dataid = array('Slno_vendor' => $value1_convered_id );
                $entry_project = $this->user->common_update($table_insert,$date_insert,$dataid);
                $last_id=$entry_project;
                $data_update = array('update_data' =>$date_insert ,'id'=>$dataid );
                $date_insert_json=json_encode($data_update);
                $table_log='pms_log_entries';
                $log_entry= array('Form_name'=>"Vendors update Form", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
                $result_log_entry = $this->user->common_insert($table_log,$log_entry);

                $this->session->set_flashdata('success_message', 'Information Has been updated successfully');
                // After that you need to used redirect home
                redirect('admin-view-vendors');

            }else{
                 $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');  
            }
        }
        

#####################################################################################################################################
#
#                           Technical sectioon create view update delete status
#
#####################################################################################################################################
        public function admin_view_technical_details(){
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View Technical List",'script_js'=>$scripts ,'menu_status'=>'9','sub_menu'=>'9','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/technical/view_technical_details');
            $this->load->view('template/template_footer',$data);
        }
        public function admin_add_Technical(){
            $scripts='';

            $data=array('title' =>"Create New Technical ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/technical/create_technical_information');
            $this->load->view('template/template_footer',$data); 

        }
        public function admin_add_Technical_save(){
            // print_r($this->input->post());
            // exit;
            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');


            $Technical_name=trim($this->input->post('Technical_name'));
            $category_name=trim($this->input->post('category_name'));
            $technical_id=trim($this->input->post('technical_id'));
            $technical_Description=trim($this->input->post('technical_Description'));
            $material_name=trim($this->input->post('material_name'));

            $data_insert = array('technical_name'=>$Technical_name, 'technical_desc'=>$technical_Description, 'technical_id'=>$technical_id, 'category_slno'=>$category_name, 'status'=>1, 'date_entry'=>$date_entry, 'time_entry'=>$time_entry,'material_slno'=>$material_name);
            $table_insert="master_technical_detail";
            $entry_project = $this->user->common_insert_id($table_insert,$data_insert);
           

            $date_insert_json=json_encode($data_insert);
            $table_log='pms_log_entries';
            $log_entry= array('Form_name'=>"Technical Entery Form", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
            $result_log_entry = $this->user->common_insert($table_log,$log_entry);
            $this->session->set_flashdata('success_message', 'Information Has been updated successfully');
            // After that you need to used redirect home
            redirect('admin-view-technical-details');
        }
        public function admin_change_Technical_status($value1,$value2,$value){

            $keys_id="preetishwebtechnical";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $data = array('Slno_technical' =>$value1_convered_id);
                $table='master_technical_detail';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                if($value==1){

                    $data_id = array('Slno_technical' =>$value1_convered_id);
                    $date_change= array('status' =>'2' );
                    $table="master_technical_detail";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->technical_name.' successfully Inactivated ');
                    // After that you need to used redirect home
                      redirect('admin-view-technical-details');
                    

                }else if($value==2){
                    $data_id = array('Slno_technical' =>$value1_convered_id);
                    $date_change= array('status' =>'1' );
                    $table="master_technical_detail";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->technical_name.' successfully Activated ');
                    // After that you need to used redirect home
                      redirect('admin-view-technical-details');

                 }else if($value==3){
                    $data_id = array('Slno_technical' =>$value1_convered_id);
                    $date_change= array('status' =>'3' );
                    $table="master_technical_detail";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->technical_name.' successfully Deleted ');
                    // After that you need to used redirect home
                      redirect('admin-view-technical-details');
                      

                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home'); 
                }

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }
        public function admin_get_category_technical_material(){
            // print_r($this->input->post());
            // Array ( [field] => 1 ) 
            $field=$this->input->post('field');
            $table="master_items_material";
            $data_category = array('Category_slno' => $field );

            $query=$this->db->get_where($table,$data_category);
            if($query->num_rows()==0){
                echo '<option value="">--Select Material--</option>';
            }else{
                echo json_encode($query->result());               
                exit;
            }
            
        }



        public function admin_edit_Technical_info($value1,$value2){
            $keys_id="preetishwebtechnical";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $scripts='';

                $data=array('title' =>"Create New Technical ",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','Slno_technical'=>$value1,'token'=>$value2);  

                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/technical/edit_technical_information',$data);
                $this->load->view('template/template_footer',$data); 
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }
        public function admin_edit_technical_save(){
            // print_r($this->input->post());

            $value1=$this->input->post('value1');
            $value2=$this->input->post('value2');
              $keys_id="preetishwebtechnical";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $Technical_name=$this->input->post('Technical_name');
                $category_name=$this->input->post('category_name');
                $material_name=$this->input->post('material_name');
                $technical_id=$this->input->post('technical_id');
                $technical_Description=$this->input->post('technical_Description');


                $data_brower['browser'] = $this->agent->browser();
                $data_brower['browserVersion'] = $this->agent->version();
                $data_brower['platform'] = $this->agent->platform();
                $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
                $ip = $this->input->ip_address();       
                $date_nrowser_json=json_encode($data_brower);
                $date_entry=date('Y-m-d');
                $time_entry=date('H:i:s');


               

                $data_insert = array('technical_name'=>$Technical_name, 'technical_desc'=>$technical_Description, 'technical_id'=>$technical_id, 'category_slno'=>$category_name, 'status'=>1, 'date_entry'=>$date_entry, 'time_entry'=>$time_entry,'material_slno'=>$material_name);
                $table_insert="master_technical_detail";
                $data_id = array('Slno_technical' =>$value1_convered_id);
                $entry_project = $this->user->common_update($table_insert,$data_insert,$data_id);
               
                $data_update = array('updated_data' =>$data_insert ,'updated_id'=>$data_id );
                $date_insert_json=json_encode($data_update);
                $table_log='pms_log_entries';
                $log_entry= array('Form_name'=>"Technical Update Form", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
                $result_log_entry = $this->user->common_insert($table_log,$log_entry);
                $this->session->set_flashdata('success_message', 'Information Has been updated successfully');
                // After that you need to used redirect home
                redirect('admin-view-technical-details');
            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');  
            }

            // Array ( [value1] => I7e8ohjDQrRYJRpWE~hyIRaaPXKz3Vb51PLjpduHJgNtoYt7xMpnrBG0YDmwmxFwWR.rnIXeVEUMQ~v~8iFk8A-- [value2] => 1 [Technical_name] => 316Ls [category_name] => 2 [material_name] => 3 [technical_id] => Tech001 [technical_Description] => 316L stainless steel head and casing ) 
            # code...
        }
#####################################################################################################################################
#
#                                                 Vehicle section create view edit status delete
#
#####################################################################################################################################

        public function admin_view_Vehicle_details(){
           $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View vehicle List",'script_js'=>$scripts ,'menu_status'=>'10','sub_menu'=>'10','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/vehicle/view_vehicle_list');
            $this->load->view('template/template_footer',$data);
        }
        public function admin_add_vehicle(){
             $scripts='';

           $data=array('title' =>"Create Vehicle information",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/vehicle/create_vehicle_infromation');
            $this->load->view('template/template_footer',$data);
            # code...
        }
        public function admin_add_vehicle_save(){
            // print_r($this->input->post());
            # code...
           // Array ( [type_of_name] => vehicle1 [Vehicle_capacity] => 5000ponds [Vehicle_desc] => xxx )
            $type_of_name=$this->input->post('type_of_name');
            $Vehicle_capacity=$this->input->post('Vehicle_capacity');
            $Vehicle_desc=$this->input->post('Vehicle_desc');

            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');


           

            $data_insert = array('vehicle_type'=>$type_of_name, 'vehicle_capacity'=>$Vehicle_capacity, 'vehicle_desc'=>$Vehicle_desc, 'category_slno'=>3, 'status'=>1, 'date_entry'=>$date_entry, 'time_entry'=>$time_entry);
            $table_insert="master_vehicle";
            $entry_project = $this->user->common_insert_id($table_insert,$data_insert);
           

            $date_insert_json=json_encode($data_insert);
            $table_log='pms_log_entries';
            $log_entry= array('Form_name'=>"Vehicle Entery Form", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
            $result_log_entry = $this->user->common_insert($table_log,$log_entry);
            $this->session->set_flashdata('success_message', 'Information Has been updated successfully');
            // After that you need to used redirect home
            redirect('admin-view-Vehicle-details');
            
        }
        public function admin_edit_vehicle_info($value1,$value2){
            
            $keys_id="preetishwebvechile";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $scripts='';

                $data=array('title' =>"Edit Vehicle information",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','Slno_vehicle'=>$value1,'token'=>$value2); 

                $this->load->view('template/template_header',$data);
                $this->load->view('admin/template/template_top_head');
                $this->load->view('admin/template/template_side_bar',$data);
                $this->load->view('admin/vehicle/edit_vehicle_information',$data);
                $this->load->view('template/template_footer',$data);
            }else{
                 $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');  
            }
            # code...
        }
        public function admin_edit_vehicle_save(){
           print_r($this->input->post());
           //Array ( [value1] => jlQwGuLC2Z7~osRezM6ZO9hZQ~Ow7ZdBt3pbHTbVAWtafdoYMSl77uLqVOGPyhQw5dlz6FBqA83J9UNjBk6eeQ-- [value2] => 1 [vehicle_type] => vehicle2 [vehicle_capacity] => 5000ponds [vehicle_desc] => xxx )
           $value1=$this->input->post('value1');
           $value2=$this->input->post('value2');
           $keys_id="preetishwebvechile";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){

               $vehicle_type=$this->input->post('vehicle_type');
               $vehicle_capacity=$this->input->post('vehicle_capacity');
               $vehicle_desc=$this->input->post('vehicle_desc');
               $data_insert = array('vehicle_type'=>$vehicle_type, 'vehicle_capacity'=>$vehicle_capacity, 'vehicle_desc'=>$vehicle_desc);
                $table_insert="master_vehicle";
                $data_id = array('Slno_vehicle' => $value1_convered_id );
                $entry_project = $this->user->common_update($table_insert,$data_insert,$data_id);

                $this->session->set_flashdata('success_message', 'Information Has been updated successfully');
            // After that you need to used redirect home
            redirect('admin-view-Vehicle-details');

           }else{
                 $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home');
           }
           
        }
        public function admin_change_vehicle_status($value1,$value2,$value){

            $keys_id="preetishwebvechile";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $data = array('Slno_vehicle' =>$value1_convered_id);
                $table='master_vehicle';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                if($value==1){

                    $data_id = array('Slno_vehicle' =>$value1_convered_id);
                    $date_change= array('status' =>'2' );
                    $table="master_vehicle";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->vehicle_desc.' successfully Inactivated ');
                    // After that you need to used redirect home
                      redirect('admin-view-Vehicle-details');
                    

                }else if($value==2){
                    $data_id = array('Slno_vehicle' =>$value1_convered_id);
                    $date_change= array('status' =>'1' );
                    $table="master_vehicle";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->vehicle_desc.' successfully Activated ');
                    // After that you need to used redirect home
                      redirect('admin-view-Vehicle-details');

                 }else if($value==3){
                    $data_id = array('Slno_vehicle' =>$value1_convered_id);
                    $date_change= array('status' =>'3' );
                    $table="master_vehicle";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->vehicle_desc.' successfully Deleted ');
                    // After that you need to used redirect home
                      redirect('admin-view-Vehicle-details');
                      

                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home'); 
                }

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }

        // admin_change_vehicle_status
// admin_change_vehicle_type_status
//
//vechile Type
//
//
 public function admin_view_Vehicle_type_details(){
           $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View vehicle Type List",'script_js'=>$scripts ,'menu_status'=>'10','sub_menu'=>'11','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/vehicle/view_vehicle_type_list');
            $this->load->view('template/template_footer',$data);
        }
        public function admin_add_vehicle_type(){
             $scripts='';

           $data=array('title' =>"Create Vehicle Type information",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/vehicle/create_vehicle_type_infromation');
            $this->load->view('template/template_footer',$data);
           
        }
        public function admin_change_vehicle_type_status($value1,$value2,$value){

            $keys_id="preetishwebvechiletype";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $data = array('Slno_vehicle' =>$value1_convered_id);
                $table='master_vehicle_type';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                if($value==1){

                    $data_id = array('Slno_vehicle' =>$value1_convered_id);
                    $date_change= array('status' =>'2' );
                    $table="master_vehicle_type";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->vehicle_type.' successfully Inactivated ');
                    // After that you need to used redirect home
                      redirect('admin-view-Vehicle-type-details');
                    

                }else if($value==2){
                    $data_id = array('Slno_vehicle' =>$value1_convered_id);
                    $date_change= array('status' =>'1' );
                    $table="master_vehicle_type";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->vehicle_type.' successfully Activated ');
                    // After that you need to used redirect home
                      redirect('admin-view-Vehicle-type-details');
                 }else if($value==3){
                    $data_id = array('Slno_vehicle' =>$value1_convered_id);
                    $date_change= array('status' =>'3' );
                    $table="master_vehicle_type";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->vehicle_type.' successfully Deleted ');
                    // After that you need to used redirect home
                      redirect('admin-view-Vehicle-type-details');
                      

                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home'); 
                }

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }

        public function admin_add_vehicle_type_save(){
            print_r($this->input->post());
             $type_of_name=$this->input->post('type_of_name');
          

            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');


           

            $data_insert = array('vehicle_type'=>$type_of_name, 'status'=>1, 'date_entry'=>$date_entry, 'time_entry'=>$time_entry);
            $table_insert="master_vehicle_type";
            $entry_project = $this->user->common_insert_id($table_insert,$data_insert);
           

            $date_insert_json=json_encode($data_insert);
            $table_log='pms_log_entries';
            $log_entry= array('Form_name'=>"Vehicle Type Entery Form", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
            $result_log_entry = $this->user->common_insert($table_log,$log_entry);
            $this->session->set_flashdata('success_message', 'Information Has been updated successfully');
            // After that you need to used redirect home
            redirect('admin-view-Vehicle-type-details');
            // Array ( [type_of_name] => vehech ) 
            # code...
        }

        public function admin_edit_vehicle_type_save(){
            print_r($this->input->post());
            $type_slno=$this->input->post('type_slno');
            $type_of_name=$this->input->post('type_of_name');
            $table="master_vehicle_type";
            $data = array('vehicle_type' =>$type_of_name);
            $result=$this->user->admin_get_vechile_type_capacity($table,$data);
            if($result==1){
                $data_id = array('Slno_vehicle' =>$type_slno);
                $date_change= array('vehicle_type' =>$type_of_name);
                $table="master_vehicle_type";
                $result_history = $this->user->common_update($table,$date_change,$data_id);
                $this->session->set_flashdata('success_message', $row->vehicle_type.' successfully Update ');
                // After that you need to used redirect home
                redirect('admin-view-Vehicle-type-details');
            }else if($result==2){
                $query=$this->db->get_where('master_vehicle_type',$data);
                $data_results=$query->result();
                $resuts=$data_results[0];
                if($resuts->Slno_vehicle==$type_slno){
                    $data_id = array('Slno_vehicle' =>$type_slno);
                    $date_change= array('vehicle_type' =>$type_of_name);
                    $table="master_vehicle_type";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->vehicle_type.' successfully Update ');
                    // After that you need to used redirect home
                    redirect('admin-view-Vehicle-type-details');

                }else{
                    $this->session->set_flashdata('error_message', ' Something Went Wrong');
                    // After that you need to used redirect home
                    redirect('user-admin-home'); 
                }

            }else{
                $this->session->set_flashdata('error_message', '  Something Went Wrong ');
                // After that you need to used redirect home
               redirect('user-admin-home'); 
            }
            
        }
        public function check_vehicle_type_status(){
            $action=$this->input->post('action');
            $code=$this->input->post('code');
            switch ($action) {
                case 'vechile_type_info':
                    $table="master_vehicle_type";
                    $data = array('vehicle_type' =>$code);
                    $result=$this->user->admin_get_vechile_type_capacity($table,$data);
                    if($result==1){
                        echo "1";
                    }else if($result==2){
                        echo "2";
                    }else{
                        echo "3";
                    }
                    break;

                case 'vechile_capacity_info':
                    $table="master_vehicle_capacity";
                    $data = array('vehicle_capacity' =>$code);
                    $result=$this->user->admin_get_vechile_type_capacity($table,$data);
                    if($result==1){
                        echo "1";
                    }else if($result==2){
                        echo "2";
                    }else{
                        echo "3";
                    }
                    break;

                case 'location_info':
                    $table="master_loaction_details";
                    $data = array('location_name' =>$code);
                    $result=$this->user->admin_get_vechile_type_capacity($table,$data);
                    if($result==1){
                        echo "1";
                    }else if($result==2){
                        echo "2";
                    }else{
                        echo "3";
                    }
                    break;
                
                default:
                   echo "3";
                    break;
            }
        }
        // capacity
        public function admin_view_Vehicle_capacity_details(){
             $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View vehicle Capcity List",'script_js'=>$scripts ,'menu_status'=>'10','sub_menu'=>'11','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/vehicle/view_vehicle_capacity_list');
            $this->load->view('template/template_footer',$data);
        }
         public function admin_add_vehicle_capacity(){
             $scripts='';

           $data=array('title' =>"Create Vehicle Capacity information",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/vehicle/create_vehicle_capcity_infromation');
            $this->load->view('template/template_footer',$data);
           
        }
        public function admin_change_vehicle_capacity_status($value1,$value2,$value){

            $keys_id="preetishwebvechilecapacity";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $data = array('Slno_vehicle' =>$value1_convered_id);
                $table='master_vehicle_capacity';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                if($value==1){

                    $data_id = array('Slno_vehicle' =>$value1_convered_id);
                    $date_change= array('status' =>'2' );
                    $table="master_vehicle_capacity";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->vehicle_capacity.' successfully Inactivated ');
                    // After that you need to used redirect home
                      redirect('admin-view-Vehicle-capacity-details');
                    

                }else if($value==2){
                    $data_id = array('Slno_vehicle' =>$value1_convered_id);
                    $date_change= array('status' =>'1' );
                    $table="master_vehicle_capacity";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->vehicle_capacity.' successfully Activated ');
                    // After that you need to used redirect home
                      redirect('admin-view-Vehicle-capacity-details');
                 }else if($value==3){
                    $data_id = array('Slno_vehicle' =>$value1_convered_id);
                    $date_change= array('status' =>'3' );
                    $table="master_vehicle_capacity";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->vehicle_capacity.' successfully Deleted ');
                    // After that you need to used redirect home
                      redirect('admin-view-Vehicle-capacity-details');
                      

                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home'); 
                }

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }

        public function admin_add_vehicle_capacity_save(){
            print_r($this->input->post());
             $type_of_name=$this->input->post('type_of_name');
          

            $data_brower['browser'] = $this->agent->browser();
            $data_brower['browserVersion'] = $this->agent->version();
            $data_brower['platform'] = $this->agent->platform();
            $data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
            $ip = $this->input->ip_address();       
            $date_nrowser_json=json_encode($data_brower);
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');


           

            $data_insert = array('vehicle_capacity'=>$type_of_name, 'status'=>1, 'date_entry'=>$date_entry, 'time_entry'=>$time_entry);
            $table_insert="master_vehicle_capacity";
            $entry_project = $this->user->common_insert_id($table_insert,$data_insert);
           

            $date_insert_json=json_encode($data_insert);
            $table_log='pms_log_entries';
            $log_entry= array('Form_name'=>"Vehicle Capacity Entery Form", 'Data_entry'=>$date_insert_json, 'status'=>1, 'Date'=>$date_entry, 'Time'=>$time_entry, 'Location_Id'=>$ip, 'browser_information'=>$date_nrowser_json);
            $result_log_entry = $this->user->common_insert($table_log,$log_entry);
            $this->session->set_flashdata('success_message', 'Information Has been updated successfully');
            // After that you need to used redirect home
            redirect('admin-view-Vehicle-capacity-details');
            // Array ( [type_of_name] => vehech ) 
            # code...
        }

        public function admin_edit_vehicle_capacity_save(){
            print_r($this->input->post());
            $type_slno=$this->input->post('type_slno');
            $type_of_name=$this->input->post('type_of_name');
            $table="master_vehicle_capacity";
            $data = array('vehicle_capacity' =>$type_of_name);
            $result=$this->user->admin_get_vechile_type_capacity($table,$data);
            if($result==1){
                $data_id = array('Slno_vehicle' =>$type_slno);
                $date_change= array('vehicle_capacity' =>$type_of_name);
                $table="master_vehicle_capacity";
                $result_history = $this->user->common_update($table,$date_change,$data_id);
                $this->session->set_flashdata('success_message', $row->vehicle_capacity.' successfully Update ');
                // After that you need to used redirect home
                redirect('admin-view-Vehicle-capacity-details');
            }else if($result==2){
                $query=$this->db->get_where('master_vehicle_capacity',$data);
                $data_results=$query->result();
                $resuts=$data_results[0];
                if($resuts->Slno_vehicle==$type_slno){
                    $data_id = array('Slno_vehicle' =>$type_slno);
                    $date_change= array('vehicle_capacity' =>$type_of_name);
                    $table="master_vehicle_capacity";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->vehicle_capacity.' successfully Update ');
                    // After that you need to used redirect home
                    redirect('admin-view-Vehicle-capacity-details');

                }else{
                    $this->session->set_flashdata('error_message', ' Something Went Wrong');
                    // After that you need to used redirect home
                    redirect('user-admin-home'); 
                }

            }else{
                $this->session->set_flashdata('error_message', '  Something Went Wrong ');
                // After that you need to used redirect home
               redirect('user-admin-home'); 
            }
            
        }
#####################################################################################################################################
#
#
#
#####################################################################################################################################

        public function admin_view_location_details(){
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

           $data=array('title' =>"View Location List",'script_js'=>$scripts ,'menu_status'=>'11','sub_menu'=>'111','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  
            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/location/view_location_list');
            $this->load->view('template/template_footer',$data);
        }
        public function admin_add_location(){
             $scripts='';

           $data=array('title' =>"Entry Location Information",'script_js'=>$scripts ,'menu_status'=>'11','sub_menu'=>'111','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  
            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/location/create_location_list');
            $this->load->view('template/template_footer',$data);
            
        }
        public function admin_add_Location_save(){    
            // print_r($this->input->post());
            // exit;
           $Location_name_form=$this->input->post('Location_name_form');
           if($Location_name_form=="Create_new_location"){       
                $Location_name=$this->input->post('Location_name');
                $table="master_loaction_details";
                $data = array('location_name' =>$Location_name);
                $result=$this->user->admin_get_vechile_type_capacity($table,$data);
                if($result==1){
                    $query=$this->db->insert($table,$data);
                    if($query){
                        $this->session->set_flashdata('success_message', '  Suucessfully Location is stored');
                        // After that you need to used redirect home
                       redirect('user-admin-home'); 
                    }else{
                        $this->session->set_flashdata('error_message', '  Something Went Wrong ');
                        // After that you need to used redirect home
                       redirect('user-admin-home'); 
                    }
                }else{
                    $this->session->set_flashdata('error_message', '  Location Name Already present on our record   ');
                    // After that you need to used redirect home
                   redirect('user-admin-home');   
                }
            }else  if($Location_name_form=="Edit_loaction"){  // here edit information is kept
                 $Location_name=$this->input->post('Location_name');
                 $location_slno=$this->input->post('location_slno');
                
                $table="master_loaction_details";
                $data = array('location_name' =>$Location_name);
                $result=$this->user->admin_get_vechile_type_capacity($table,$data);
                if($result==1){
                    $data_id = array('slno_loc' =>$location_slno);
                    $query=$this->db->update($table,$data,$data_id);
                    if($query){
                        $this->session->set_flashdata('success_message', '  Suucessfully Location is update');
                        // After that you need to used redirect home
                        redirect('user-admin-home'); 
                    }else{
                        $this->session->set_flashdata('error_message', '  Something Went Wrong ');
                        // After that you need to used redirect home
                        redirect('user-admin-home'); 
                    }
                }else{
                   $data_id_check = array('slno_loc' =>$location_slno,'location_name' =>$Location_name);
                     $result_id=$this->user->admin_get_vechile_type_capacity($table,$data_id_check);
                     if($result_id==1){
                        $this->session->set_flashdata('error_message', '  Location Name Already present on our record   ');
                        // After that you need to used redirect home
                        redirect('user-admin-home');   
                    }else{
                        $this->session->set_flashdata('success_message', 'Same Location Name Used To Store   ');
                        // After that you need to used redirect home
                        redirect('user-admin-home');   
                    }
                }
                // Array ( [Location_name_form] => Edit_loaction [Location_name] => bhu1 [location_slno] => 1 ) 

            }

        }
        public function admin_change_Location_status($value1,$value2,$value){

            $keys_id="preetishweblocation";
            $value1_convered = strtr($value1,array('.' => '+', '-' => '=', '~' => '/'));
            
            $value1_convered_id=$this->encrypt->decode($value1_convered,$keys_id);
            if($value1_convered_id==$value2){
                $data = array('slno_loc' =>$value1_convered_id);
                $table='master_loaction_details';
                $query=$this->db->get_where($table,$data);
                $data_db=$query->result(); // here fetch information 
                $row = $data_db[0]; 
                if($value==1){

                    $data_id = array('slno_loc' =>$value1_convered_id);
                    $date_change= array('status' =>'2' );
                    $table="master_loaction_details";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->location_name.' successfully Inactivated ');
                    // After that you need to used redirect home
                      redirect('admin-view-location-details');
                    

                }else if($value==2){
                    $data_id = array('slno_loc' =>$value1_convered_id);
                    $date_change= array('status' =>'1' );
                    $table="master_loaction_details";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->location_name.' successfully Activated ');
                    // After that you need to used redirect home
                      redirect('admin-view-location-details');
                 }else if($value==3){
                    $data_id = array('slno_loc' =>$value1_convered_id);
                    $date_change= array('status' =>'3' );
                    $table="master_loaction_details";
                    $result_history = $this->user->common_update($table,$date_change,$data_id);
                    $this->session->set_flashdata('success_message', $row->location_name.' successfully Deleted ');
                    // After that you need to used redirect home
                      redirect('admin-view-location-details');
                      

                }else{
                    $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-admin-home'); 
                }

            }else{
                $this->session->set_flashdata('error_message', 'Some thing went Wrong');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-admin-home'); 
            }
        }

// create_vehicle_capcity_infromation
#####################################################################################################################################
/**
 * [adminlogout description] Here is lout out section of admin users
 * @return [type] [description]
 */
        public function adminlogout(){
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
                        $this->session->set_flashdata('success_message', 'Signout from Admin panel');
                        redirect('home');

                }else{

                        $user_data = array('logout_date'=>$date, 'logout_time'=>$time, 'status'=>'2');
                        $id=array('session_id'=>$session_id);
                        $user_hstory_table="master_session_history";
                        $result_history = $this->user->common_update($user_hstory_table,$user_data,$id); 
                        session_destroy();
                        session_start();                        
                        $this->session->set_flashdata('success_message', 'Sign-out from Admin Panel');
                        redirect('home');     
                }
                
        }
        public function adminlogout_bypass(){
                $this->session->set_flashdata('error_msg', 'Invalid entry to admin panel');
                redirect('home');     
                
        }

        public function admin_change_password($value=''){
            $scripts='';

           $data=array('title' =>"Change Password",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  
            $this->load->view('template/template_header',$data);
            $this->load->view('admin/template/template_top_head');
            $this->load->view('admin/template/template_side_bar',$data);
            $this->load->view('admin/change_password');
            $this->load->view('template/template_footer',$data);
        }




}
