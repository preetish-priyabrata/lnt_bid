<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
                parent::__construct();
                // Loading my model which will use
                $this->load->model('user_model', 'user');  
                // imedate database link
                $this->load->database();    
                
                //Load session library 
        	 $this->load->library('session');
        	 $this->load->library('user_agent');


        }
 /**
  * [check_login description] Here user login take proccess before enting to system
  * @return [type] [description]
  */
        public function check_login(){
        	print_r($this->input->post());
        	// exit;
        	if(!empty($this->input->post('login_id')) && !empty($this->input->post('user_password'))){
	        	$login_id=(trim($this->input->post('login_id')));
	        	$user_password=md5($this->input->post('user_password'));
	        	$data = array('email_id'=>$login_id,'Status'=>'1');
	        	$table='master_admin';
	        	
				$result = $this->user->check_present($table,$data);
				if($result==1){
					$data_password = array('email_id'=>$login_id,'password_hash'=>$user_password,'Status'=>'1');
					$result_password = $this->user->check_present($table,$data_password);
					
					if($result_password==1){
						 $query = $this->db->get_where($table, $data);
						 if ($query->num_rows() == 1) {
						 	$data_db=$query->result(); // here fetch information 
						 	$row = $data_db[0]; 
						 	$role_id=$row->role_id;

						 	$date=date('Y-m-d');
						 	$time=date('H:i:s');
						 	$data_brower['browser'] = $this->agent->browser();
							$data_brower['browserVersion'] = $this->agent->version();
							$data_brower['platform'] = $this->agent->platform();
							$data_brower['full_user_agent_string'] = $_SERVER['HTTP_USER_AGENT'];
							$ip = $this->input->ip_address();			
							session_regenerate_id();			
							$session_id=(session_id());
							$date_nrowser_json=json_encode($data_brower);
							
						 	switch ($role_id) {
						 		case '1': // admin user
						 				$newdata = array('Username'=>$row->Username,'email_id'=>$row->email_id,'role_id'=>$row->role_id,'logged_in' => TRUE,'session_id'=>$session_id);
						 				$user_data = array('user_id'=>$row->email_id, 'username'=>$row->Username, 'user_role'=>$row->role_id, 'browser_detail'=>$date_nrowser_json, 'ip'=>$ip, 'entry_date'=>$date, 'entry_time'=>$time, 'status'=>'1', 'session_id'=>$session_id);
						 				$user_hstory_table="master_session_history";
						 				$result_history = $this->user->common_insert($user_hstory_table,$user_data);

						 				// common_insert
						 				if($result_history==1){
						 					$this->session->set_flashdata('success_message', 'Welcome To Admin Panel');
							 				$this->session->set_userdata($newdata);
							 				redirect('user-admin');
							 				exit();
							 			}else{
							 				// Set flash data 
											$this->session->set_flashdata('error_msg', 'Unable find user Please Try Again');
											// After that you need to used redirect function instead of load view such as 
											redirect("home");
							 			}
						 			break;
						 		case '6': // bu user 
						 				$newdata = array('Username'=>$row->Username,'bu_email_id'=>$row->email_id,'role_id'=>$row->role_id,'logged_in' => TRUE,'session_id'=>$session_id);
						 				$user_data = array('user_id'=>$row->email_id, 'username'=>$row->Username, 'user_role'=>$row->role_id, 'browser_detail'=>$date_nrowser_json, 'ip'=>$ip, 'entry_date'=>$date, 'entry_time'=>$time, 'status'=>'1', 'session_id'=>$session_id);
						 				$user_hstory_table="master_session_history";
						 				$result_history = $this->user->common_insert($user_hstory_table,$user_data);

						 				// common_insert
						 				if($result_history==1){
						 					$this->session->set_flashdata('success_message', 'Welcome To BU User Panel');
							 				$this->session->set_userdata($newdata);
							 				redirect('user-bu-home');
							 				exit();
							 			}else{
							 				// Set flash data 
											$this->session->set_flashdata('error_msg', 'Unable find user Please Try Again');
											// After that you need to used redirect function instead of load view such as 
											redirect("home");
							 			}
						 			break;
						 		case '2':  //design user 
						 			// echo "string";
						 			// exit;
						 				$newdata = array('Username'=>$row->Username,'design_email_id'=>$row->email_id,'role_id'=>$row->role_id,'logged_in' => TRUE,'session_id'=>$session_id);
						 				$user_data = array('user_id'=>$row->email_id, 'username'=>$row->Username, 'user_role'=>$row->role_id, 'browser_detail'=>$date_nrowser_json, 'ip'=>$ip, 'entry_date'=>$date, 'entry_time'=>$time, 'status'=>'1', 'session_id'=>$session_id);
						 				$user_hstory_table="master_session_history";
						 				$result_history = $this->user->common_insert($user_hstory_table,$user_data);

						 				// common_insert
						 				if($result_history==1){
						 					$this->session->set_flashdata('success_message', 'Welcome To Design User Panel');
							 				$this->session->set_userdata($newdata);
							 				redirect('user-design-home');
							 				exit();
							 			}else{
							 				// Set flash data 
											$this->session->set_flashdata('error_msg', 'Unable find user Please Try Again');
											// After that you need to used redirect function instead of load view such as 
											redirect("home");
							 			}
						 			break;
						 		case '8':  //design user 
						 			// echo "string";
						 			// exit;
						 				$newdata = array('Username'=>$row->Username,'approver_email_id'=>$row->email_id,'role_id'=>$row->role_id,'logged_in' => TRUE,'session_id'=>$session_id);
						 				$user_data = array('user_id'=>$row->email_id, 'username'=>$row->Username, 'user_role'=>$row->role_id, 'browser_detail'=>$date_nrowser_json, 'ip'=>$ip, 'entry_date'=>$date, 'entry_time'=>$time, 'status'=>'1', 'session_id'=>$session_id);
						 				$user_hstory_table="master_session_history";
						 				$result_history = $this->user->common_insert($user_hstory_table,$user_data);

						 				// common_insert
						 				if($result_history==1){
						 					$this->session->set_flashdata('success_message', 'Welcome To Approver User Panel');
							 				$this->session->set_userdata($newdata);
							 				redirect('user-approver-home');
							 				exit();
							 			}else{
							 				// Set flash data 
											$this->session->set_flashdata('error_msg', 'Unable find user Please Try Again');
											// After that you need to used redirect function instead of load view such as 
											redirect("home");
							 			}
						 			break;
						 		case '4':  //design user 
						 			// echo "string";
						 			// exit;
						 				$newdata = array('Username'=>$row->Username,'procurement_email_id'=>$row->email_id,'role_id'=>$row->role_id,'logged_in' => TRUE,'session_id'=>$session_id);
						 				$user_data = array('user_id'=>$row->email_id, 'username'=>$row->Username, 'user_role'=>$row->role_id, 'browser_detail'=>$date_nrowser_json, 'ip'=>$ip, 'entry_date'=>$date, 'entry_time'=>$time, 'status'=>'1', 'session_id'=>$session_id);
						 				$user_hstory_table="master_session_history";
						 				$result_history = $this->user->common_insert($user_hstory_table,$user_data);

						 				// common_insert
						 				if($result_history==1){
						 					$this->session->set_flashdata('success_message', 'Welcome To Approver User Panel');
							 				$this->session->set_userdata($newdata);
							 				redirect('user-procurement-home');
							 				exit();
							 			}else{
							 				// Set flash data 
											$this->session->set_flashdata('error_msg', 'Unable find user Please Try Again');
											// After that you need to used redirect function instead of load view such as 
											redirect("home");
							 			}
						 			break;
						 		case '7':  //design user 
						 			// echo "string";
						 			// exit;
						 				$newdata = array('Username'=>$row->Username,'buy_email_id'=>$row->email_id,'role_id'=>$row->role_id,'logged_in' => TRUE,'session_id'=>$session_id);
						 				$user_data = array('user_id'=>$row->email_id, 'username'=>$row->Username, 'user_role'=>$row->role_id, 'browser_detail'=>$date_nrowser_json, 'ip'=>$ip, 'entry_date'=>$date, 'entry_time'=>$time, 'status'=>'1', 'session_id'=>$session_id);
						 				$user_hstory_table="master_session_history";
						 				$result_history = $this->user->common_insert($user_hstory_table,$user_data);

						 				// common_insert
						 				if($result_history==1){
						 					$this->session->set_flashdata('success_message', 'Welcome To Buyer User Panel');
							 				$this->session->set_userdata($newdata);
							 				redirect('user-buyer-home');
							 				exit();
							 			}else{
							 				// Set flash data 
											$this->session->set_flashdata('error_msg', 'Unable find user Please Try Again');
											// After that you need to used redirect function instead of load view such as 
											redirect("home");
							 			}
						 			break;
						 		default:
						 			# code...
						 			break;
						 	}
						 	
						 	
						 }else{
						 	// Set flash data 
							$this->session->set_flashdata('error_msg', 'Unable find user Please Try Again');
							// After that you need to used redirect function instead of load view such as 
							redirect("home");
						 }
						

					}else{
						// Set flash data 
						$this->session->set_flashdata('error_msg', 'Unable find user Please Try Again');
						// After that you need to used redirect function instead of load view such as 
						redirect("home");
					}
				}else{
					// Set flash data 
						$this->session->set_flashdata('error_msg', 'Invalid User Please Try Again');
					// After that you need to used redirect function instead of load view such as 
						redirect("home");
				}
			}else{
				// Set flash data 
					$this->session->set_flashdata('error_msg', 'Sone filed left blank');
					// After that you need to used redirect function instead of load view such as 
					redirect("home");
			}       	
        }

        public function user_dashboard(){
        	$this->load->view('template/index_user');
        }
        public function user_dashboard_final(){
        	$data=array('title' =>"Dashboard user");
        	$this->load->view('template/template_header',$data);
        	$this->load->view('template/template_top_head');
        	$this->load->view('template/template_side_bar');
        	$this->load->view('template/template_content');
        	$this->load->view('template/template_footer');
        }




}
