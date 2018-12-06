<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designuser extends CI_Controller {
    public function __construct(){
            parent::__construct();
            // Loading my model which will use
            $this->load->model('user_model', 'user'); 
            $this->load->model('design_model', 'design_user');
             
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
            $data=array('title' =>"Design User Dashboard",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/user_dashboard');
            $this->load->view('template/template_footer',$data);
        # code...
    }
    public function design_view_design_plan(){
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

        $data=array('title' =>"View Design Details",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/design/view_job_code');
            $this->load->view('template/template_footer',$data);
    }
    public function design_add_new_design_plan(){
         $scripts='<script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';

        $data=array('title' =>"View Design Details",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/design/create_design_plan');
            $this->load->view('template/template_footer',$data);
        # code...
    }
    public function design_add_new_design_plan_save(){

        print_r($this->input->post());
        # code...
    }
    public function design_new_mr_order(){
        $scripts='<script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';

        $data=array('title' =>"Create New Material Requisition",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/material_requisition/Create_material_requisition_form');
            $this->load->view('template/template_footer',$data);

        # code...
    }
    public function design_add_new_mr_save(){
        // print_r($this->input->post());
        // Array ( [Mr_no] => 2018-10-03-utBS7 [job_code] => 1 [tech_evalution] => 1 [required_date] => 2019-03-31 [approver_id] => 18 [materials_id] => 1 [mr_date_of_creation] => 2018-10-03 ) 
        $email_id=$this->session->userdata('design_email_id');
        if($email_id!=""){
            $date_entry=date('Y-m-d');
            $time_entry=date('H:i:s');

            $materials_id=$this->input->post('materials_id');                               // mateial category
            $materials_id_detail=$this->design_user->get_design_material_category_single($materials_id);   // mateial category details
            if($materials_id_detail['no_materials']==1){
                $job_code=$this->input->post('job_code');                                             // job code id information
                $job_code_detail=$this->design_user->get_design_job_single($job_code,$email_id);    // Job code details
                if($job_code_detail['no_job_code']==1){
                    $approver_id=$this->input->post('approver_id');                                   // approved id 
                    $approver_id_detail=$this->design_user->get_design_approver_single($approver_id);// Approver details
                    if($approver_id_detail['no_user']==1){
                        $Mr_no=$this->input->post('Mr_no');                                          // Mr Code Information
                        
                        $job_code_id_slno=$job_code_detail['job_code_list'][0]->Project_Slno;
                        $job_Code_nos=$job_code_detail['job_code_list'][0]->job_Code;                        
                        $tech_evalution=$this->input->post('tech_evalution');                      // technical evalution 1->yes 2->no      
                        $required_date=$this->input->post('required_date');                      // when material is been required 
                        
                        $approver_name=$approver_id_detail['user_approver'][0]->Username;
                        $approver_email_id=$approver_id_detail['user_approver'][0]->email_id;                       
                        
                        $material_category_name=$materials_id_detail['materials_list'][0]->category_name;
                        
                        $mr_date_of_creation=$this->input->post('mr_date_of_creation');
                        $get_check_mr=$this->design_user->get_design_mr_no_check($Mr_no);
                        if($get_check_mr==1){
                            $data_inserted = array('mr_no'=>$Mr_no, 'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name, 'job_code_id_slno'=>$job_code_id_slno, 'job_code_id'=>$job_Code_nos, 'materilal_category_id_slno'=>$materials_id, 'material_category_name'=>$material_category_name, 'techinal_evalution'=>$tech_evalution, 'status'=>'4', 'date_creation'=>$date_entry, 'time_creation'=>$time_entry,  'date_required'=>$required_date, 'creators_id'=>$email_id);
                            $table_mr_create="master_mr_job_details";
                            $query_id=$this->user->common_insert_id($table_mr_create,$data_inserted);
                            $last_id=$query_id;



                            switch ($materials_id) {
                                case '1':
                                     $this->session->set_flashdata('success_message', 'Sucessfully MR is Created ');
                                    redirect('design-new-mr-order-first/'.$last_id.'/'.'1/'.$last_id);
                                    // design-new-mr-order-first/
                                    break;
                                case '2':
                                     $this->session->set_flashdata('success_message', ' Sucessfully MR is Created  ');
                                    redirect('design-new-mr-order-second/'.$last_id.'/'.'2/'.$last_id);
                                    // design-new-mr-order-second
                                    break;
                                case '3':
                                    $this->session->set_flashdata('success_message', ' Sucessfully MR is Created  ');
                                    redirect('design-new-mr-order-third/'.$last_id.'/'.'3/'.$last_id);
                                   // design-new-mr-order-third
                                    break;
                                
                                default:
                                    $this->session->set_flashdata('error_message', ' Something went wrong ');
                                    redirect('user-design-home');
                                    break;
                            }

                            redirect('user-design-home');


                        }else{
                            $this->session->set_flashdata('error_message', ' No Such MR no Is already Created . Please Fill Material Requisition Form ');
                             // After that you need to used redirect function instead of load view such as                 
                            redirect('user-design-home');
                        }

                    }else{
                        $this->session->set_flashdata('error_message', ' No Such Approver  is active Please Fill Material Requisition Form ');
                        // After that you need to used redirect function instead of load view such as                 
                         redirect('user-design-home');
                    }
                }else{
                    $this->session->set_flashdata('error_message', ' No Such Job Code is active Please Fill Material Requisition Form ');
                    // After that you need to used redirect function instead of load view such as                 
                    redirect('user-design-home');
                }
            }else{
                $this->session->set_flashdata('error_message', ' No Such material is active Please Fill Material Requisition Form');
                // After that you need to used redirect function instead of load view such as                 
                redirect('user-design-home');
            }

        }else{
            $this->session->set_flashdata('error_msg', 'Invalid entry to Design User panel');
            redirect('design-logout-by-pass'); 
        }
    }
    public function design_new_mr_order_first($value,$value1,$value2){ //SCI
         $_SESSION["cart_item"]="";
         $_SESSION['cart_item_tech']="";
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script> <script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script> <script src="'.base_url().'file_css_admin/upload.js"></script>';
// upload
        $data=array('title' =>"Material Requisition form II",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/material_requisition/create_mr_order_first',$data);
            $this->load->view('template/template_footer',$data);
        # code...create_mr_order_first.php
        
    }
    public function design_new_mr_order_second($value,$value1,$value2){ //MOI
         $_SESSION["cart_item"]="";
         $_SESSION['cart_item_tech']="";
         $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script><script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';

        $data=array('title' =>"Material Requisition form II",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/material_requisition/create_mr_order_second',$data);
            $this->load->view('template/template_footer',$data);
        # code...create_mr_order_second.php
    }
    public function design_new_mr_order_third($value,$value1,$value2){ //logistic
        $_SESSION["cart_item"]="";
        $_SESSION['cart_item_tech'] = array();;
          $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script><script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';

        $data=array('title' =>"Material Requisition form II",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/material_requisition/create_mr_order_third',$data);
            $this->load->view('template/template_footer',$data);
        # code...create_mr_order_third.php
    }
    public function design_new_mr_order_first_edit($value,$value1,$value2){ //SCI
         $_SESSION["cart_item"]="";
         $_SESSION['cart_item_tech']="";
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script> <script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script> <script src="'.base_url().'file_css_admin/upload.js"></script>';
// upload
        $data=array('title' =>"Material Requisition form II",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/material_requisition/create_mr_order_first_edit',$data);
            $this->load->view('template/template_footer',$data);
        # code...create_mr_order_first.php
        
    }
    public function design_new_mr_order_second_edit($value,$value1,$value2){ //MOI
         $_SESSION["cart_item"]="";
         $_SESSION['cart_item_tech']="";
         $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script><script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';

        $data=array('title' =>"Material Requisition form II",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/material_requisition/create_mr_order_second_edit',$data);
            $this->load->view('template/template_footer',$data);
        # code...create_mr_order_second.php
    }
    public function design_new_mr_order_third_edit($value,$value1,$value2){ //logistic
        $_SESSION["cart_item"]="";
        $_SESSION['cart_item_tech'] = array();;
          $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script><script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';

        $data=array('title' =>"Create New Material Requisition",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/material_requisition/create_mr_order_third_edit',$data);
            $this->load->view('template/template_footer',$data);
        # code...create_mr_order_third.php
    }
    public function design_vehicle_required_session(){ 
        
        $code=$this->input->post('code');
        if(!empty($this->input->post('action'))) {
            switch ($this->input->post('action')) {
                case 'add': //normal add to cart systen
                    if(!empty($this->input->post('quantity'))) {
                        if(!empty($this->input->post('from_location'))) {
                            $get_location_from=$this->design_user->get_design_master_loaction_list($this->input->post('from_location')); // from location information will come out
                            if(!empty($this->input->post('to_location'))) {
                                 $get_location_to=$this->design_user->get_design_master_loaction_list($this->input->post('to_location')); // to location information will come out
                                if(!empty($this->input->post('purpose'))) {
                                    $query_item_details=$this->design_user->get_design_master_vehcile_list($code);
                                    // print_r($query_item_details);
                                    $itemArray = array($code=>array('vehicle_type'=>$query_item_details['item_vehcile'][0]->vehicle_type, 'vehicle_capacity'=>$query_item_details['item_vehcile'][0]->vehicle_capacity, 'quantity'=>$this->input->post('quantity'), 'code'=>$code,'vehicle_desc'=>$query_item_details['item_vehcile'][0]->vehicle_desc,'purpose'=>$this->input->post('purpose'),'location_from'=>$get_location_from['item_location'][0]->location_name,'location_from_id'=>$get_location_from['item_location'][0]->slno_loc,'location_to'=>$get_location_to['item_location'][0]->location_name,'location_to_id'=>$get_location_to['item_location'][0]->slno_loc));
                                    if(!empty($this->session->userdata('cart_item'))) {
                                        $_SESSION["cart_item"] = array_merge($this->session->userdata('cart_item'),$itemArray);
                                    } else {
                                        $_SESSION["cart_item"] = $itemArray;
                                    }
                                }
                            }
                        }
                    }   
                    if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            // vehicle_type

                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                       <th>Vehicle Type</th>
                                        <th>Capacity</th>
                                        <th>Details</th>                                        
                                        <th>No</th>
                                        <th>From Location</th>
                                        <th>To Location</th>
                                        <th>Purpose</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="vehicle_type[<?=$id?>]" value="<?=$item['vehicle_type']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['vehicle_type']?></strong></td>
                                        <td><strong><input type="hidden" name="vehicle_capacity[<?=$id?>]" value="<?=$item['vehicle_capacity']?>"><?=$item['vehicle_capacity']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                         <td><strong><input type="hidden" name="vehicle_desc[<?=$id?>]" value="<?=$item['vehicle_desc']?>"><?=$item['vehicle_desc']?></strong></td>
                                        <td>
                                            <strong>
                                                <input type="hidden" name="location_from[<?=$id?>]" value="<?=$item['location_from']?>">
                                                <input type="hidden" name="location_from_id[<?=$id?>]" value="<?=$item['location_from_id']?>">
                                                <?=$item['location_from']?>
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                <input type="hidden" name="location_to[<?=$id?>]" value="<?=$item['location_to']?>">
                                                <input type="hidden" name="location_to_id[<?=$id?>]" value="<?=$item['location_to_id']?>">
                                                <?=$item['location_to']?>
                                            </strong>
                                        </td>
                                        <td><strong><input type="hidden" name="purpose[<?=$id?>]" value="<?=$item['purpose']?>"><?=$item['purpose']?></strong></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }                   
                    break;
                 case 'remove':  // normal romoval of cart system vechile
                    // $codes_value=$this->input->post('codes_value');                
                    // if(!empty($_SESSION["cart_item"])) {
                    //     foreach($_SESSION["cart_item"] as $k =>$value) {
                        
                    //         if(in_array($code,$_SESSION["cart_item"][$k])) {
                    //             unset($_SESSION["cart_item"][$k]);
                    //         }   
                        
                    //     }
                    // } 
                      if(!empty($_SESSION["cart_item"])) {   
                    $cart_item_tech =$_SESSION["cart_item"];
                        $pos = array_search($code, $cart_item_tech);
                        // echo $cart_item_tech[$pos];
                        unset($cart_item_tech[$pos]);
                        $cart_item_tech_new=array_values($cart_item_tech);
                        $cart_item_tech_sess=$_SESSION["cart_item"]  =$cart_item_tech_new;
                    }
                    if(!empty($_SESSION["cart_item"])){
                        $sess_cart_item=$_SESSION["cart_item"];
                        // $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                        // print_r($cart_item_tech_sess);
                        // vehicle_type

                        $item_total = 0;
                        $id=0;
                    ?>
                        <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                            <thead>
                                <tr>
                                   <th>Vehicle Type</th>
                                    <th>Capacity</th>
                                    <th>Details</th>                                        
                                    <th>No</th>
                                    <th>From Location</th>
                                    <th>To Location</th>
                                    <th>Purpose</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($sess_cart_item as $item){ ?>
                                <tr>
                                    <td><strong><input type="hidden" name="vehicle_type[<?=$id?>]" value="<?=$item['vehicle_type']?>">
                                        <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['vehicle_type']?></strong></td>
                                    <td><strong><input type="hidden" name="vehicle_capacity[<?=$id?>]" value="<?=$item['vehicle_capacity']?>"><?=$item['vehicle_capacity']?></strong></td>
                                    <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                     <td><strong><input type="hidden" name="vehicle_desc[<?=$id?>]" value="<?=$item['vehicle_desc']?>"><?=$item['vehicle_desc']?></strong></td>
                                    <td>
                                        <strong>
                                            <input type="hidden" name="location_from[<?=$id?>]" value="<?=$item['location_from']?>">
                                            <input type="hidden" name="location_from_id[<?=$id?>]" value="<?=$item['location_from_id']?>">
                                            <?=$item['location_from']?>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <input type="hidden" name="location_to[<?=$id?>]" value="<?=$item['location_to']?>">
                                            <input type="hidden" name="location_to_id[<?=$id?>]" value="<?=$item['location_to_id']?>">
                                            <?=$item['location_to']?>
                                        </strong>
                                    </td>
                                    <td><strong><input type="hidden" name="purpose[<?=$id?>]" value="<?=$item['purpose']?>"><?=$item['purpose']?></strong></td>
                                    <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                </tr>
                            <?php 
                            $id++;
                        }
                            ?>
                                               
                            </tbody>  
                        </table>
                        <?php
                    }               
                    break;          
                case 'add_re_vehcile': // resubmition of add to cart system
                    if(!empty($this->input->post('quantity'))) {
                        if(!empty($this->input->post('from_location'))) {
                            $get_location_from=$this->design_user->get_design_master_loaction_list($this->input->post('from_location')); // from location information will come out
                            if(!empty($this->input->post('to_location'))) {
                                 $get_location_to=$this->design_user->get_design_master_loaction_list($this->input->post('to_location')); // to location information will come out
                                if(!empty($this->input->post('purpose'))) {
                                    $query_item_details=$this->design_user->get_design_master_vehcile_list($code);
                                    // print_r($query_item_details);
                                    $itemArray = array($code=>array('vehicle_type'=>$query_item_details['item_vehcile'][0]->vehicle_type, 'vehicle_capacity'=>$query_item_details['item_vehcile'][0]->vehicle_capacity, 'quantity'=>$this->input->post('quantity'), 'code'=>$code,'vehicle_desc'=>$query_item_details['item_vehcile'][0]->vehicle_desc,'purpose'=>$this->input->post('purpose'),'location_from'=>$get_location_from['item_location'][0]->location_name,'location_from_id'=>$get_location_from['item_location'][0]->slno_loc,'location_to'=>$get_location_to['item_location'][0]->location_name,'location_to_id'=>$get_location_to['item_location'][0]->slno_loc,'comment_details_vechile'=>'new item insert'));
                                    if(!empty($this->session->userdata('cart_item'))) {
                                        $_SESSION["cart_item"] = array_merge($this->session->userdata('cart_item'),$itemArray);
                                    } else {
                                        $_SESSION["cart_item"] = $itemArray;
                                    }
                                }
                            }
                        }
                    }   
                    if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                           // $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            // vehicle_type

                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                       <th>Vehicle Type</th>
                                        <th>Capacity</th>
                                        <th>Details</th>                                        
                                        <th>No</th>
                                        <th>From Location</th>
                                        <th>To Location</th>
                                        <th>Purpose</th>
                                        <th>Comment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="vehicle_type[<?=$id?>]" value="<?=$item['vehicle_type']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['vehicle_type']?></strong></td>
                                        <td><strong><input type="hidden" name="vehicle_capacity[<?=$id?>]" value="<?=$item['vehicle_capacity']?>"><?=$item['vehicle_capacity']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                         <td><strong><input type="hidden" name="vehicle_desc[<?=$id?>]" value="<?=$item['vehicle_desc']?>"><?=$item['vehicle_desc']?></strong></td>
                                        <td>
                                            <strong>
                                                <input type="hidden" name="location_from[<?=$id?>]" value="<?=$item['location_from']?>">
                                                <input type="hidden" name="location_from_id[<?=$id?>]" value="<?=$item['location_from_id']?>">
                                                <?=$item['location_from']?>
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                <input type="hidden" name="location_to[<?=$id?>]" value="<?=$item['location_to']?>">
                                                <input type="hidden" name="location_to_id[<?=$id?>]" value="<?=$item['location_to_id']?>">
                                                <?=$item['location_to']?>
                                            </strong>
                                        </td>
                                        <td><strong><input type="hidden" name="purpose[<?=$id?>]" value="<?=$item['purpose']?>"><?=$item['purpose']?></strong></td>
                                          <td><?=$item['comment_details_vechile']?></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }                   
                    break;
                 case 'remove_re_vechile':  // resubmition of remove cart system
                    // $codes_value=$this->input->post('codes_value');                
                    // if(!empty($_SESSION["cart_item"])) {
                    //     foreach($_SESSION["cart_item"] as $k =>$value) {
                        
                    //         if(in_array($code,$_SESSION["cart_item"][$k])) {
                    //             unset($_SESSION["cart_item"][$k]);
                    //         }   
                        
                    //     }
                    // }    
                     if(!empty($_SESSION["cart_item"])) {   
                    $cart_item_tech =$_SESSION["cart_item"];
                        $pos = array_search($code, $cart_item_tech);
                        // echo $cart_item_tech[$pos];
                        unset($cart_item_tech[$pos]);
                        $cart_item_tech_new=array_values($cart_item_tech);
                        $cart_item_tech_sess=$_SESSION["cart_item"]  =$cart_item_tech_new;
                    }
                    if(!empty($_SESSION["cart_item"])){
                        $sess_cart_item=$_SESSION["cart_item"];
                        $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                        // print_r($cart_item_tech_sess);
                        // vehicle_type

                        $item_total = 0;
                        $id=0;
                    ?>
                        <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                            <thead>
                                <tr>
                                   <th>Vehicle Type</th>
                                    <th>Capacity</th>
                                    <th>Details</th>                                        
                                    <th>No</th>
                                    <th>From Location</th>
                                    <th>To Location</th>
                                    <th>Purpose</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($sess_cart_item as $item){ ?>
                                <tr>
                                    <td><strong><input type="hidden" name="vehicle_type[<?=$id?>]" value="<?=$item['vehicle_type']?>">
                                        <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['vehicle_type']?></strong></td>
                                    <td><strong><input type="hidden" name="vehicle_capacity[<?=$id?>]" value="<?=$item['vehicle_capacity']?>"><?=$item['vehicle_capacity']?></strong></td>
                                    <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                     <td><strong><input type="hidden" name="vehicle_desc[<?=$id?>]" value="<?=$item['vehicle_desc']?>"><?=$item['vehicle_desc']?></strong></td>
                                    <td>
                                        <strong>
                                            <input type="hidden" name="location_from[<?=$id?>]" value="<?=$item['location_from']?>">
                                            <input type="hidden" name="location_from_id[<?=$id?>]" value="<?=$item['location_from_id']?>">
                                            <?=$item['location_from']?>
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <input type="hidden" name="location_to[<?=$id?>]" value="<?=$item['location_to']?>">
                                            <input type="hidden" name="location_to_id[<?=$id?>]" value="<?=$item['location_to_id']?>">
                                            <?=$item['location_to']?>
                                        </strong>
                                    </td>
                                    <td><strong><input type="hidden" name="purpose[<?=$id?>]" value="<?=$item['purpose']?>"><?=$item['purpose']?></strong></td>
                                    <td><?=$item['comment_details_vechile']?></td>
                                    <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                </tr>
                            <?php 
                            $id++;
                        }
                            ?>
                                               
                            </tbody>  
                        </table>
                        <?php
                    }               
                    break;  
                default:

                    break;
            }
        }
       
           
       
    }
    public function design_item_required_session_ids(){
         
        $actions_file=$this->input->post('actions_file');
        $Mr_no=$this->input->post('Mr_no');
        $slno_Mr_no=$this->input->post('slno_Mr_no');

        if(!empty($this->input->post('action'))) {
            switch ($this->input->post('action')) {
                case 'add':
                         $query_item_details_list=$this->design_user->get_design_master_mr_items_material_single($actions_file,$Mr_no,$slno_Mr_no);
                         // print_r($query_item_details_list);
                         if($query_item_details_list['no_item']==1){
                            foreach ($query_item_details_list['item_list'] as $key_item => $value_item) {
                                $code=$value_item->material_item_id;
                                $material_quantity=$value_item->material_quantity;
                                $query_item_details=$this->design_user->get_design_master_items_material_single($code);
                        // print_r($query_item_details);
                                $itemArray = array($code=>array('name'=>$query_item_details['materials_list'][0]->item_name, 'item_id'=>$query_item_details['materials_list'][0]->item_id, 'quantity'=>$material_quantity, 'item_uom'=>$query_item_details['materials_list'][0]->item_uom ,'code'=>$code));
                                if(!empty($this->session->userdata('cart_item'))) {
                                    $_SESSION["cart_item"] = array_merge($this->session->userdata('cart_item'),$itemArray);
                                } else {
                                    $_SESSION["cart_item"] = $itemArray;
                                }
                            }

                         }
                          $query_item_details_list_tech=$this->design_user->get_design_master_mr_technical_items_material_single($actions_file,$Mr_no,$slno_Mr_no);
                          if($query_item_details_list_tech['no_item_tech']==1){
                                foreach ($query_item_details_list_tech['item_list_tech'] as $key_tech => $value_tech) {
                                    $code_tech=$value_tech->tech_slno_id;
                                    if($code_tech!=0){
                               
                                        if(!empty($this->session->userdata('cart_item_tech'))) {

                                            $cart_item_tech_sess=$_SESSION["cart_item_tech"] = array_merge($this->session->userdata('cart_item_tech'),array('0' => $code_tech ));
                                            // print_r($cart_item_tech_sess);
                                        } else {
                                            $cart_item_tech_sess=$_SESSION["cart_item_tech"]  = array('0' => $code_tech );
                                             // print_r($cart_item_tech_sess);
                                        }
                                    }
                                }
                          }

                        if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>id</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>UOM</strong></th>
                                        <th><strong>Technical Parameter</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="material_name[<?=$id?>]" value="<?=$item['name']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['name']?></strong></td>
                                        <td><strong><input type="hidden" name="item_id[<?=$id?>]" value="<?=$item['item_id']?>"><?=$item['item_id']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                        <td><strong><input type="hidden" name="item_uom[<?=$id?>]" value="<?=$item['item_uom']?>"><?=$item['item_uom']?></strong></td>
                                        <td><?php $slno=$item['code'];
                                            $result_technical=$this->design_user->get_design_master_items_material_single_technical($slno);
                                            
                                            if($result_technical['no_technical']==2){
                                               echo '<label class="checkbox-inline"><input type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                            // Array ( [no_technical] => 2 ) nos
                                            // Array ( [no_technical] => 1 [technical_list] => Array ( [0] => stdClass Object ( [Slno_technical] => 2 [technical_name] => tec10 [technical_desc] => xxx [technical_id] => 101 [category_slno] => 1 [material_slno] => 6 [status] => 1 [date_entry] => 2018-09-26 [time_entry] => 15:16:54 ) ) ) 21
                                        ?></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }
                          
                   
                    break;
                case 'add_re_item':
                    $_SESSION["cart_item_tech"]=$_SESSION["cart_item"]=array();
                         $query_item_details_list=$this->design_user->get_design_master_mr_items_material_single($actions_file,$Mr_no,$slno_Mr_no);
                         // print_r($query_item_details_list);
                         if($query_item_details_list['no_item']==1){
                            foreach ($query_item_details_list['item_list'] as $key_item => $value_item) {
                                $code=$value_item->material_item_id;
                                $material_quantity=$value_item->material_quantity;
                                 $comment_details_item=$value_item->comment_details_item;
                                $query_item_details=$this->design_user->get_design_master_items_material_single($code);
                        // print_r($query_item_details);
                                $itemArray = array($code=>array('name'=>$query_item_details['materials_list'][0]->item_name, 'item_id'=>$query_item_details['materials_list'][0]->item_id, 'quantity'=>$material_quantity, 'item_uom'=>$query_item_details['materials_list'][0]->item_uom ,'code'=>$code,'comment_details_item'=>$comment_details_item));
                                if(!empty($this->session->userdata('cart_item'))) {
                                    $_SESSION["cart_item"] = array_merge($this->session->userdata('cart_item'),$itemArray);
                                } else {
                                    $_SESSION["cart_item"] = $itemArray;
                                }
                            }

                         }
                          $query_item_details_list_tech=$this->design_user->get_design_master_mr_technical_items_material_single($actions_file,$Mr_no,$slno_Mr_no);
                          if($query_item_details_list_tech['no_item_tech']==1){
                                foreach ($query_item_details_list_tech['item_list_tech'] as $key_tech => $value_tech) {
                                    $code_tech=$value_tech->tech_slno_id;
                                    if($code_tech!=0){
                               
                                        if(!empty($this->session->userdata('cart_item_tech'))) {

                                            $cart_item_tech_sess=$_SESSION["cart_item_tech"] = array_merge($this->session->userdata('cart_item_tech'),array('0' => $code_tech ));
                                            // print_r($cart_item_tech_sess);
                                        } else {
                                            $cart_item_tech_sess=$_SESSION["cart_item_tech"]  = array('0' => $code_tech );
                                             // print_r($cart_item_tech_sess);
                                        }
                                    }
                                }
                          }

                        if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($sess_cart_item);
                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>id</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>UOM</strong></th>
                                        <th><strong>Technical Parameter</strong></th>
                                        <th><strong>Comment</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="material_name[<?=$id?>]" value="<?=$item['name']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['name']?></strong></td>
                                        <td><strong><input type="hidden" name="item_id[<?=$id?>]" value="<?=$item['item_id']?>"><?=$item['item_id']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                        <td><strong><input type="hidden" name="item_uom[<?=$id?>]" value="<?=$item['item_uom']?>"><?=$item['item_uom']?></strong></td>
                                        <td><?php $slno=$item['code'];
                                            $result_technical=$this->design_user->get_design_master_items_material_single_technical($slno);
                                            
                                            if($result_technical['no_technical']==2){
                                               echo '<label class="checkbox-inline"><input type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                            // Array ( [no_technical] => 2 ) nos
                                            // Array ( [no_technical] => 1 [technical_list] => Array ( [0] => stdClass Object ( [Slno_technical] => 2 [technical_name] => tec10 [technical_desc] => xxx [technical_id] => 101 [category_slno] => 1 [material_slno] => 6 [status] => 1 [date_entry] => 2018-09-26 [time_entry] => 15:16:54 ) ) ) 21
                                        ?></td>
                                        <td><p style="color: red"><?=$item['comment_details_item']?></p></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }
                          
                   
                    break;
                 case 'add_vechile':
                 $_SESSION["cart_item"] = array();
                 // print_r($this->input->post());
                 // Array ( [actions_file] => 1 [Mr_no] => 2018-10-20-4GOhM [slno_Mr_no] => 11 [action] => add_vechile ) 
                 
                    $result_vechile=$this->design_user->get_design_master_mr_vechile_single($actions_file,$Mr_no,$slno_Mr_no);
                    // print_r($result_vechile);
                    if($result_vechile['no_vechile']==1){
                        foreach ($result_vechile['item_vechile_list'] as $key_value_vechile) {
                           $code=$vehicle_slno_id_single=$key_value_vechile->vehicle_slno_id;
                            $from_location_slno_single=$key_value_vechile->from_location_slno;
                            $to_location_slno_single=$key_value_vechile->to_location_slno;
                            $purpose_info_single=($key_value_vechile->purpose_info);
                            $no_vehcile_single=$key_value_vechile->no_vehcile;
                            $get_location_from=$this->design_user->get_design_master_loaction_list($from_location_slno_single); // from location information will come out

                            $get_location_to=$this->design_user->get_design_master_loaction_list($to_location_slno_single); // to location information will come out
                            $query_item_details=$this->design_user->get_design_master_vehcile_list($code);
                              $itemArray = array($code=>array('vehicle_type'=>$query_item_details['item_vehcile'][0]->vehicle_type, 'vehicle_capacity'=>$query_item_details['item_vehcile'][0]->vehicle_capacity, 'quantity'=>$no_vehcile_single, 'code'=>$code,'vehicle_desc'=>$query_item_details['item_vehcile'][0]->vehicle_desc,'purpose'=>$purpose_info_single,'location_from'=>$get_location_from['item_location'][0]->location_name,'location_from_id'=>$get_location_from['item_location'][0]->slno_loc,'location_to'=>$get_location_to['item_location'][0]->location_name,'location_to_id'=>$get_location_to['item_location'][0]->slno_loc));
                                    if(!empty($this->session->userdata('cart_item'))) {
                                        $_SESSION["cart_item"] = array_merge($this->session->userdata('cart_item'),$itemArray);
                                    } else {
                                        $_SESSION["cart_item"] = $itemArray;
                                    }
                           
                        }

                        

                    }
                    if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            // $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            // vehicle_type

                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                       <th>Vehicle Type</th>
                                        <th>Capacity</th>
                                        <th>Details</th>                                        
                                        <th>No</th>
                                        <th>From Location</th>
                                        <th>To Location</th>
                                        <th>Purpose</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="vehicle_type[<?=$id?>]" value="<?=$item['vehicle_type']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['vehicle_type']?></strong></td>
                                        <td><strong><input type="hidden" name="vehicle_capacity[<?=$id?>]" value="<?=$item['vehicle_capacity']?>"><?=$item['vehicle_capacity']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                         <td><strong><input type="hidden" name="vehicle_desc[<?=$id?>]" value="<?=$item['vehicle_desc']?>"><?=$item['vehicle_desc']?></strong></td>
                                        <td>
                                            <strong>
                                                <input type="hidden" name="location_from[<?=$id?>]" value="<?=$item['location_from']?>">
                                                <input type="hidden" name="location_from_id[<?=$id?>]" value="<?=$item['location_from_id']?>">
                                                <?=$item['location_from']?>
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                <input type="hidden" name="location_to[<?=$id?>]" value="<?=$item['location_to']?>">
                                                <input type="hidden" name="location_to_id[<?=$id?>]" value="<?=$item['location_to_id']?>">
                                                <?=$item['location_to']?>
                                            </strong>
                                        </td>
                                        <td><strong><input type="hidden" name="purpose[<?=$id?>]" value="<?=$item['purpose']?>"><?=$item['purpose']?></strong></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }
                    break;
                case 'add_view':
                         $query_item_details_list=$this->design_user->get_design_master_mr_items_material_single($actions_file,$Mr_no,$slno_Mr_no);
                         // print_r($query_item_details_list);
                         if($query_item_details_list['no_item']==1){
                            foreach ($query_item_details_list['item_list'] as $key_item => $value_item) {
                                $code=$value_item->material_item_id;
                                $material_quantity=$value_item->material_quantity;
                                $query_item_details=$this->design_user->get_design_master_items_material_single($code);
                        // print_r($query_item_details);
                                $itemArray = array($code=>array('name'=>$query_item_details['materials_list'][0]->item_name, 'item_id'=>$query_item_details['materials_list'][0]->item_id, 'quantity'=>$material_quantity, 'item_uom'=>$query_item_details['materials_list'][0]->item_uom ,'code'=>$code));
                                if(!empty($this->session->userdata('cart_item'))) {
                                    $_SESSION["cart_item"] = array_merge($this->session->userdata('cart_item'),$itemArray);
                                } else {
                                    $_SESSION["cart_item"] = $itemArray;
                                }
                            }

                         }
                          $query_item_details_list_tech=$this->design_user->get_design_master_mr_technical_items_material_single($actions_file,$Mr_no,$slno_Mr_no);
                          if($query_item_details_list_tech['no_item_tech']==1){
                                foreach ($query_item_details_list_tech['item_list_tech'] as $key_tech => $value_tech) {
                                    $code_tech=$value_tech->tech_slno_id;
                                    if($code_tech!=0){
                               
                                        if(!empty($this->session->userdata('cart_item_tech'))) {

                                            $cart_item_tech_sess=$_SESSION["cart_item_tech"] = array_merge($this->session->userdata('cart_item_tech'),array('0' => $code_tech ));
                                            // print_r($cart_item_tech_sess);
                                        } else {
                                            $cart_item_tech_sess=$_SESSION["cart_item_tech"]  = array('0' => $code_tech );
                                             // print_r($cart_item_tech_sess);
                                        }
                                    }
                                }
                          }

                        if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>id</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>UOM</strong></th>
                                        <th><strong>Technical Parameter</strong></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="material_name[<?=$id?>]" value="<?=$item['name']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['name']?></strong></td>
                                        <td><strong><input type="hidden" name="item_id[<?=$id?>]" value="<?=$item['item_id']?>"><?=$item['item_id']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                        <td><strong><input type="hidden" name="item_uom[<?=$id?>]" value="<?=$item['item_uom']?>"><?=$item['item_uom']?></strong></td>
                                        <td><?php $slno=$item['code'];
                                            $result_technical=$this->design_user->get_design_master_items_material_single_technical($slno);
                                            
                                            if($result_technical['no_technical']==2){
                                               echo '<label class="checkbox-inline"><input type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                            // Array ( [no_technical] => 2 ) nos
                                            // Array ( [no_technical] => 1 [technical_list] => Array ( [0] => stdClass Object ( [Slno_technical] => 2 [technical_name] => tec10 [technical_desc] => xxx [technical_id] => 101 [category_slno] => 1 [material_slno] => 6 [status] => 1 [date_entry] => 2018-09-26 [time_entry] => 15:16:54 ) ) ) 21
                                        ?></td>
                                      
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }
                          
                   
                    break;
                 case 'add_vechile_view':
                 // print_r($this->input->post());
                 // Array ( [actions_file] => 1 [Mr_no] => 2018-10-20-4GOhM [slno_Mr_no] => 11 [action] => add_vechile ) 
                 
                    $result_vechile=$this->design_user->get_design_master_mr_vechile_single($actions_file,$Mr_no,$slno_Mr_no);
                    // print_r($result_vechile);
                    if($result_vechile['no_vechile']==1){
                        foreach ($result_vechile['item_vechile_list'] as $key_value_vechile) {
                           $code=$vehicle_slno_id_single=$key_value_vechile->vehicle_slno_id;
                            $from_location_slno_single=$key_value_vechile->from_location_slno;
                            $to_location_slno_single=$key_value_vechile->to_location_slno;
                            $purpose_info_single=($key_value_vechile->purpose_info);
                            $no_vehcile_single=$key_value_vechile->no_vehcile;
                            $get_location_from=$this->design_user->get_design_master_loaction_list($from_location_slno_single); // from location information will come out

                            $get_location_to=$this->design_user->get_design_master_loaction_list($to_location_slno_single); // to location information will come out
                            $query_item_details=$this->design_user->get_design_master_vehcile_list($code);
                              $itemArray = array($code=>array('vehicle_type'=>$query_item_details['item_vehcile'][0]->vehicle_type, 'vehicle_capacity'=>$query_item_details['item_vehcile'][0]->vehicle_capacity, 'quantity'=>$no_vehcile_single, 'code'=>$code,'vehicle_desc'=>$query_item_details['item_vehcile'][0]->vehicle_desc,'purpose'=>$purpose_info_single,'location_from'=>$get_location_from['item_location'][0]->location_name,'location_from_id'=>$get_location_from['item_location'][0]->slno_loc,'location_to'=>$get_location_to['item_location'][0]->location_name,'location_to_id'=>$get_location_to['item_location'][0]->slno_loc));
                                    if(!empty($this->session->userdata('cart_item'))) {
                                        $_SESSION["cart_item"] = array_merge($this->session->userdata('cart_item'),$itemArray);
                                    } else {
                                        $_SESSION["cart_item"] = $itemArray;
                                    }
                           
                        }

                        

                    }
                    if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            // vehicle_type

                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                       <th>Vehicle Type</th>
                                        <th>Capacity</th>
                                        <th>Details</th>                                        
                                        <th>No</th>
                                        <th>From Location</th>
                                        <th>To Location</th>
                                        <th>Purpose</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="vehicle_type[<?=$id?>]" value="<?=$item['vehicle_type']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['vehicle_type']?></strong></td>
                                        <td><strong><input type="hidden" name="vehicle_capacity[<?=$id?>]" value="<?=$item['vehicle_capacity']?>"><?=$item['vehicle_capacity']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                         <td><strong><input type="hidden" name="vehicle_desc[<?=$id?>]" value="<?=$item['vehicle_desc']?>"><?=$item['vehicle_desc']?></strong></td>
                                        <td>
                                            <strong>
                                                <input type="hidden" name="location_from[<?=$id?>]" value="<?=$item['location_from']?>">
                                                <input type="hidden" name="location_from_id[<?=$id?>]" value="<?=$item['location_from_id']?>">
                                                <?=$item['location_from']?>
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                <input type="hidden" name="location_to[<?=$id?>]" value="<?=$item['location_to']?>">
                                                <input type="hidden" name="location_to_id[<?=$id?>]" value="<?=$item['location_to_id']?>">
                                                <?=$item['location_to']?>
                                            </strong>
                                        </td>
                                        <td><strong><input type="hidden" name="purpose[<?=$id?>]" value="<?=$item['purpose']?>"><?=$item['purpose']?></strong></td>
                                      
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }
                    break;
                 case 'add_vechile_re_vechile':
                 $_SESSION["cart_item"] = array();
                 // print_r($this->input->post());
                 // Array ( [actions_file] => 1 [Mr_no] => 2018-10-20-4GOhM [slno_Mr_no] => 11 [action] => add_vechile ) 
                 
                    $result_vechile=$this->design_user->get_design_master_mr_vechile_single($actions_file,$Mr_no,$slno_Mr_no);
                    // print_r($result_vechile);
                    if($result_vechile['no_vechile']==1){
                        foreach ($result_vechile['item_vechile_list'] as $key_value_vechile) {
                           $code=$vehicle_slno_id_single=$key_value_vechile->vehicle_slno_id;
                            $from_location_slno_single=$key_value_vechile->from_location_slno;
                            $to_location_slno_single=$key_value_vechile->to_location_slno;
                            $comment_details_vechile=$key_value_vechile->comment_details_vechile;
                            $purpose_info_single=($key_value_vechile->purpose_info);
                            $no_vehcile_single=$key_value_vechile->no_vehcile;
                            $get_location_from=$this->design_user->get_design_master_loaction_list($from_location_slno_single); // from location information will come out

                            $get_location_to=$this->design_user->get_design_master_loaction_list($to_location_slno_single); // to location information will come out
                            $query_item_details=$this->design_user->get_design_master_vehcile_list($code);
                              $itemArray = array($code=>array('vehicle_type'=>$query_item_details['item_vehcile'][0]->vehicle_type, 'vehicle_capacity'=>$query_item_details['item_vehcile'][0]->vehicle_capacity, 'quantity'=>$no_vehcile_single, 'code'=>$code,'vehicle_desc'=>$query_item_details['item_vehcile'][0]->vehicle_desc,'purpose'=>$purpose_info_single,'location_from'=>$get_location_from['item_location'][0]->location_name,'location_from_id'=>$get_location_from['item_location'][0]->slno_loc,'location_to'=>$get_location_to['item_location'][0]->location_name,'location_to_id'=>$get_location_to['item_location'][0]->slno_loc,'comment_details_vechile'=>$comment_details_vechile));
                                    if(!empty($this->session->userdata('cart_item'))) {
                                        $_SESSION["cart_item"] = array_merge($this->session->userdata('cart_item'),$itemArray);
                                    } else {
                                        $_SESSION["cart_item"] = $itemArray;
                                    }
                           
                        }

                        

                    }
                    if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            // $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            // vehicle_type

                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                       <th>Vehicle Type</th>
                                        <th>Capacity</th>
                                        <th>Details</th>                                        
                                        <th>No</th>
                                        <th>From Location</th>
                                        <th>To Location</th>
                                        <th>Purpose</th>
                                         <th>Comment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="vehicle_type[<?=$id?>]" value="<?=$item['vehicle_type']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['vehicle_type']?></strong></td>
                                        <td><strong><input type="hidden" name="vehicle_capacity[<?=$id?>]" value="<?=$item['vehicle_capacity']?>"><?=$item['vehicle_capacity']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                         <td><strong><input type="hidden" name="vehicle_desc[<?=$id?>]" value="<?=$item['vehicle_desc']?>"><?=$item['vehicle_desc']?></strong></td>
                                        <td>
                                            <strong>
                                                <input type="hidden" name="location_from[<?=$id?>]" value="<?=$item['location_from']?>">
                                                <input type="hidden" name="location_from_id[<?=$id?>]" value="<?=$item['location_from_id']?>">
                                                <?=$item['location_from']?>
                                            </strong>
                                        </td>
                                        <td>
                                            <strong>
                                                <input type="hidden" name="location_to[<?=$id?>]" value="<?=$item['location_to']?>">
                                                <input type="hidden" name="location_to_id[<?=$id?>]" value="<?=$item['location_to_id']?>">
                                                <?=$item['location_to']?>
                                            </strong>
                                        </td>
                                        <td><strong><input type="hidden" name="purpose[<?=$id?>]" value="<?=$item['purpose']?>"><?=$item['purpose']?></strong></td>
                                        <td><p style='color:red'><?=$item['comment_details_vechile']?></p></td>
                                        <!-- comment_details_vechile -->
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }
                    break;

                default:

                    break;
            }
        }
       
        # code...
    }
    public function design_item_required_session(){
        // print_r($this->input->post());
        // exit();
        // Array ( [action] => add [code] => 2 ) 
        $code=$this->input->post('code');
        if(!empty($this->input->post('action'))) {
            switch ($this->input->post('action')) {
                case 'add':
                    if(!empty($this->input->post('quantity'))) {
                        $query_item_details=$this->design_user->get_design_master_items_material_single($code);
                        // print_r($query_item_details);
                        $itemArray = array($code=>array('name'=>$query_item_details['materials_list'][0]->item_name, 'item_id'=>$query_item_details['materials_list'][0]->item_id, 'quantity'=>$this->input->post('quantity'), 'item_uom'=>$query_item_details['materials_list'][0]->item_uom ,'code'=>$code));
                        if(!empty($this->session->userdata('cart_item'))) {
                            $_SESSION["cart_item"] = array_merge($this->session->userdata('cart_item'),$itemArray);
                        } else {
                            $_SESSION["cart_item"] = $itemArray;
                        }
                    }   
                    if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>id</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>UOM</strong></th>
                                        <th><strong>Technical Parameter</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="material_name[<?=$id?>]" value="<?=$item['name']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['name']?></strong></td>
                                        <td><strong><input type="hidden" name="item_id[<?=$id?>]" value="<?=$item['item_id']?>"><?=$item['item_id']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                        <td><strong><input type="hidden" name="item_uom[<?=$id?>]" value="<?=$item['item_uom']?>"><?=$item['item_uom']?></strong></td>
                                        <td><?php $slno=$item['code'];
                                            $result_technical=$this->design_user->get_design_master_items_material_single_technical($slno);
                                            
                                            if($result_technical['no_technical']==2){
                                               echo '<label class="checkbox-inline"><input type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                            // Array ( [no_technical] => 2 ) nos
                                            // Array ( [no_technical] => 1 [technical_list] => Array ( [0] => stdClass Object ( [Slno_technical] => 2 [technical_name] => tec10 [technical_desc] => xxx [technical_id] => 101 [category_slno] => 1 [material_slno] => 6 [status] => 1 [date_entry] => 2018-09-26 [time_entry] => 15:16:54 ) ) ) 21
                                        ?></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }
                    break;
                case 'add_re_item_new':
                    if(!empty($this->input->post('quantity'))) {
                        $query_item_details=$this->design_user->get_design_master_items_material_single($code);
                        // print_r($query_item_details);
                        $itemArray = array($code=>array('name'=>$query_item_details['materials_list'][0]->item_name, 'item_id'=>$query_item_details['materials_list'][0]->item_id, 'quantity'=>$this->input->post('quantity'), 'item_uom'=>$query_item_details['materials_list'][0]->item_uom ,'code'=>$code,'comment_details_item'=>'Newly Add Item'));
                        if(!empty($this->session->userdata('cart_item'))) {
                            $_SESSION["cart_item"] = array_merge($this->session->userdata('cart_item'),$itemArray);
                        } else {
                            $_SESSION["cart_item"] = $itemArray;
                        }
                    }   
                    if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($sess_cart_item);
                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>id</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>UOM</strong></th>
                                        <th><strong>Technical Parameter</strong></th>
                                        <th><strong>Comment</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="material_name[<?=$id?>]" value="<?=$item['name']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['name']?></strong></td>
                                        <td><strong><input type="hidden" name="item_id[<?=$id?>]" value="<?=$item['item_id']?>"><?=$item['item_id']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                        <td><strong><input type="hidden" name="item_uom[<?=$id?>]" value="<?=$item['item_uom']?>"><?=$item['item_uom']?></strong></td>
                                        <td><?php $slno=$item['code'];
                                            $result_technical=$this->design_user->get_design_master_items_material_single_technical($slno);
                                            
                                            if($result_technical['no_technical']==2){
                                               echo '<label class="checkbox-inline"><input type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                          
                                        ?></td>
                                        <td><?=$item['comment_details_item']?></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }
                    break;
                 case 'remove_re_item':
                     $codes_value=$this->input->post('codes_value');               
                        if(!empty($_SESSION["cart_item"])) {
                            foreach($_SESSION["cart_item"] as $k =>$value) {
                            
                                if(in_array($code,$_SESSION["cart_item"][$k])) {
                                    unset($_SESSION["cart_item"][$k]);
                                }   
                            
                            }
                            
                        } 
                        if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>id</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>UOM</strong></th>
                                        <th><strong>Technical Parameter</strong></th>
                                        <th><strong>Comment</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="material_name[<?=$id?>]" value="<?=$item['name']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['name']?></strong></td>
                                        <td><strong><input type="hidden" name="item_id[<?=$id?>]" value="<?=$item['item_id']?>"><?=$item['item_id']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                        <td><strong><input type="hidden" name="item_uom[<?=$id?>]" value="<?=$item['item_uom']?>"><?=$item['item_uom']?></strong></td>
                                        <td><?php $slno=$item['code'];
                                            $result_technical=$this->design_user->get_design_master_items_material_single_technical($slno);
                                            
                                            if($result_technical['no_technical']==2){
                                               echo '<label class="checkbox-inline"><input type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                    ?></td>
                                     <td><?=$item['comment_details_item']?></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }  

                    break;
                case 'remove':
                     $codes_value=$this->input->post('codes_value');               
                        if(!empty($_SESSION["cart_item"])) {
                            foreach($_SESSION["cart_item"] as $k =>$value) {
                            
                                if(in_array($code,$_SESSION["cart_item"][$k])) {
                                    unset($_SESSION["cart_item"][$k]);
                                }   
                            
                            }
                            
                        } 
                        if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>id</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>UOM</strong></th>
                                        <th><strong>Technical Parameter</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="material_name[<?=$id?>]" value="<?=$item['name']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['name']?></strong></td>
                                        <td><strong><input type="hidden" name="item_id[<?=$id?>]" value="<?=$item['item_id']?>"><?=$item['item_id']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                        <td><strong><input type="hidden" name="item_uom[<?=$id?>]" value="<?=$item['item_uom']?>"><?=$item['item_uom']?></strong></td>
                                        <td><?php $slno=$item['code'];
                                            $result_technical=$this->design_user->get_design_master_items_material_single_technical($slno);
                                            
                                            if($result_technical['no_technical']==2){
                                               echo '<label class="checkbox-inline"><input type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                    ?></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        }  

                    break;
                case 'checked':
                    if(!empty($this->session->userdata('cart_item_tech'))) {
                        $cart_item_tech_sess=$_SESSION["cart_item_tech"] = array_merge($this->session->userdata('cart_item_tech'),array('0' => $code ));
                        // print_r($cart_item_tech_sess);
                    } else {
                        $cart_item_tech_sess=$_SESSION["cart_item_tech"]  = array('0' => $code );
                         // print_r($cart_item_tech_sess);
                    }
                     if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>id</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>UOM</strong></th>
                                        <th><strong>Technical Parameter</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="material_name[<?=$id?>]" value="<?=$item['name']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['name']?></strong></td>
                                        <td><strong><input type="hidden" name="item_id[<?=$id?>]" value="<?=$item['item_id']?>"><?=$item['item_id']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                        <td><strong><input type="hidden" name="item_uom[<?=$id?>]" value="<?=$item['item_uom']?>"><?=$item['item_uom']?></strong></td>
                                        <td><?php $slno=$item['code'];
                                            $result_technical=$this->design_user->get_design_master_items_material_single_technical($slno);
                                            
                                            if($result_technical['no_technical']==2){
                                               echo '<label class="checkbox-inline"><input type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                    ?></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        } 
                    break;
                case 'checked_re_item':
                    if(!empty($this->session->userdata('cart_item_tech'))) {
                        $cart_item_tech_sess=$_SESSION["cart_item_tech"] = array_merge($this->session->userdata('cart_item_tech'),array('0' => $code ));
                        // print_r($cart_item_tech_sess);
                    } else {
                        $cart_item_tech_sess=$_SESSION["cart_item_tech"]  = array('0' => $code );
                         // print_r($cart_item_tech_sess);
                    }
                     if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>id</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>UOM</strong></th>
                                        <th><strong>Technical Parameter</strong></th>
                                        <th><strong>Comment</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="material_name[<?=$id?>]" value="<?=$item['name']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['name']?></strong></td>
                                        <td><strong><input type="hidden" name="item_id[<?=$id?>]" value="<?=$item['item_id']?>"><?=$item['item_id']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                        <td><strong><input type="hidden" name="item_uom[<?=$id?>]" value="<?=$item['item_uom']?>"><?=$item['item_uom']?></strong></td>
                                        <td><?php $slno=$item['code'];
                                            $result_technical=$this->design_user->get_design_master_items_material_single_technical($slno);
                                            
                                            if($result_technical['no_technical']==2){
                                               echo '<label class="checkbox-inline"><input type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                    ?></td>
                                     <td><?=$item['comment_details_item']?></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        } 
                    break;
                 case 'unchecked':
                    if(!empty($_SESSION["cart_item_tech"])) {
                        //  if(in_array($code,$_SESSION["cart_item"][$k])) {
                        //     echo $_SESSION["cart_item"][$k];
                        // // unset($_SESSION["cart_item"][$k]);
                        // }
                        $cart_item_tech =$_SESSION["cart_item_tech"];
                        $pos = array_search($code, $cart_item_tech);
                        // echo $cart_item_tech[$pos];
                        unset($cart_item_tech[$pos]);
                        $cart_item_tech_new=array_values($cart_item_tech);
                        $cart_item_tech_sess=$_SESSION["cart_item_tech"]  =$cart_item_tech_new;
                        // print_r($cart_item_tech_sess);

                    }
                     if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>id</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>UOM</strong></th>
                                        <th><strong>Technical Parameter</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="material_name[<?=$id?>]" value="<?=$item['name']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['name']?></strong></td>
                                        <td><strong><input type="hidden" name="item_id[<?=$id?>]" value="<?=$item['item_id']?>"><?=$item['item_id']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                        <td><strong><input type="hidden" name="item_uom[<?=$id?>]" value="<?=$item['item_uom']?>"><?=$item['item_uom']?></strong></td>
                                        <td><?php $slno=$item['code'];
                                            $result_technical=$this->design_user->get_design_master_items_material_single_technical($slno);
                                            
                                            if($result_technical['no_technical']==2){
                                               echo '<label class="checkbox-inline"><input type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                    ?></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        } 
                    break;
                case 'unchecked_re_item':
                    if(!empty($_SESSION["cart_item_tech"])) {
                        //  if(in_array($code,$_SESSION["cart_item"][$k])) {
                        //     echo $_SESSION["cart_item"][$k];
                        // // unset($_SESSION["cart_item"][$k]);
                        // }
                        $cart_item_tech =$_SESSION["cart_item_tech"];
                        $pos = array_search($code, $cart_item_tech);
                        // echo $cart_item_tech[$pos];
                        unset($cart_item_tech[$pos]);
                        $cart_item_tech_new=array_values($cart_item_tech);
                        $cart_item_tech_sess=$_SESSION["cart_item_tech"]  =$cart_item_tech_new;
                        // print_r($cart_item_tech_sess);

                    }
                     if(!empty($_SESSION["cart_item"])){
                            $sess_cart_item=$_SESSION["cart_item"];
                            $cart_item_tech_sess=$_SESSION["cart_item_tech"];
                            // print_r($cart_item_tech_sess);
                            $item_total = 0;
                            $id=0;
                        ?>
                            <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>Name</strong></th>
                                        <th><strong>id</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>UOM</strong></th>
                                        <th><strong>Technical Parameter</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sess_cart_item as $item){ ?>
                                    <tr>
                                        <td><strong><input type="hidden" name="material_name[<?=$id?>]" value="<?=$item['name']?>">
                                            <input type="hidden" name="codes[<?=$id?>]" value="<?=$item['code']?>"><?=$item['name']?></strong></td>
                                        <td><strong><input type="hidden" name="item_id[<?=$id?>]" value="<?=$item['item_id']?>"><?=$item['item_id']?></strong></td>
                                        <td><strong><input type="hidden" name="quantitys[<?=$id?>]" value="<?=$item['quantity']?>"><?=$item['quantity']?></strong></td>
                                        <td><strong><input type="hidden" name="item_uom[<?=$id?>]" value="<?=$item['item_uom']?>"><?=$item['item_uom']?></strong></td>
                                        <td><?php $slno=$item['code'];
                                            $result_technical=$this->design_user->get_design_master_items_material_single_technical($slno);
                                            
                                            if($result_technical['no_technical']==2){
                                               echo '<label class="checkbox-inline"><input type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                    ?></td>
                                        <td><strong><a onClick="cartAction('remove',<?=$item['code']?>,'<?=$id?>')" class=" btn btnRemoveAction cart-action">Remove Item</a></strong></td>
                                    </tr>
                                <?php 
                                $id++;
                            }
                                ?>
                                                   
                                </tbody>  
                            </table>
                            <?php
                        } 
                    break;
                
                default:

                    break;
            }
        }
       
                           
       

        # code...
    }
   



    public function design_user_mr_drafted_list(){
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

        $data=array('title' =>"Material Requisition form II",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'2','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/material_requisition/view_mr_list_drafted');
            $this->load->view('template/template_footer',$data);
    }
    public function design_submitted_mr_order($value=''){
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

        $data=array('title' =>"Material Requisition successfully Submitted",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'4','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/submit_mr_list/view_submited_mr_list');
            $this->load->view('template/template_footer',$data);
    }
    public function design_file_upload_data($value=''){
        $actions_file=$this->input->post('actions_file');
        $Mr_no=$this->input->post('Mr_no');
        $slno_Mr_no=$this->input->post('slno_Mr_no');
        switch ($actions_file) {
            case 'files_uploaded_details':
                if (isset($_FILES['file']) && !empty($_FILES['file'])) {
                    // $no_files = count($_FILES["file"]['name']);
                    $file_name=$_FILES["file"]["name"];
                    $file_stored_name=date('Y-m-d')."-".$_FILES["file"]["name"];
                    // for ($i = 0; $i < $no_files; $i++) {
                    if ($_FILES["file"]["error"] > 0) {
                        echo "3";
                    } else {
                        if (file_exists('upload_files/design_upload/' . $_FILES["file"]["name"])) {
                            echo '2';
                        } else {
                            if(move_uploaded_file($_FILES["file"]["tmp_name"], 'upload_files/design_upload/' . $file_stored_name)){
                                $data_array = array('mr_no_id'=>$Mr_no, 'slno_mr_id'=>$slno_Mr_no, 'attach_name'=>$file_stored_name, 'file_name_actucal'=>$file_name);
                                $query_files=$this->db->insert('master_mr_file_upload',$data_array);
                                echo '1' ;  
                            }
                        }                
                    }            
                } 
                break;
             case 'files_info':
                $result_file=$this->design_user->get_design_mr_file_list($slno_Mr_no,$Mr_no);
                if($result_file['no_files']==2){
                    echo "<p class='text-center' style='color:red'><b>No File Attachment is found for this MR Request no</b></p>";
                }else if($result_file['no_files']==1){
                    ?>
                      <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                        <thead>
                            <tr>
                                <th><strong>File Name</strong></th>
                                <th><strong>Click View</strong></th>                                
                                <th><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result_file['files_list'] as $key_files){ ?>
                                <tr>
                                    <td><strong><?=$key_files->file_name_actucal?></strong></td>
                                    <td><strong><a target="_blank" href="<?=base_url()?>upload_files/design_upload/<?=$key_files->attach_name?>">Click View</a> </strong></td>                                
                                    <td><strong><span onclick="file_delete(<?=$key_files->slno_file?>)" class="btn btn-sm btn-danger">Delete File</span></strong></td>
                                </tr> 


                            <?php }?>

                        </tbody>
                    </table>
                    <?php

                }

                break;
            case 'files_info_delete':
                $file_id=$this->input->post('file_id');
                $this->db->where('slno_file', $file_id);
                $query_result=$this->db->get('master_mr_file_upload');

                $data_result=$query_result->result();
                $data_details=$data_result[0];

                $path_to_file = 'upload_files/design_upload/'.$data_details->attach_name;
                if(unlink($path_to_file)) {
                    $this->db->where('slno_file', $file_id);
                    $query=$this->db->delete('master_mr_file_upload');
                    if($query){
                        echo "1";
                    }else{
                        echo "2";
                    }
                     // echo 'deleted successfully';
                }
                else {
                     echo '2';
                }                

                break;
             case 'files_info_view':
                $result_file=$this->design_user->get_design_mr_file_list($slno_Mr_no,$Mr_no);
                if($result_file['no_files']==2){
                    echo "<p class='text-center' style='color:red'><b>No File Attachment is found for this MR Request no</b></p>";
                }else if($result_file['no_files']==1){
                    ?>
                      <table class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
                        <thead>
                            <tr>
                                <th><strong>File Name</strong></th>
                                <th><strong>Click View</strong></th>                                
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result_file['files_list'] as $key_files){ ?>
                                <tr>
                                    <td><strong><?=$key_files->file_name_actucal?></strong></td>
                                    <td><strong><a target="_blank" href="<?=base_url()?>upload_files/design_upload/<?=$key_files->attach_name?>">Click View</a> </strong></td>                                
                                   
                                </tr> 


                            <?php }?>

                        </tbody>
                    </table>
                    <?php

                }
            default:
                # code...
                break;
        }        
       
    }
    public function design_add_new_mr_save_formII(){

       
        
        $send_button=$this->input->post('send_button'); // this important to find whether tosend or save inforamtion to edit
        $Mr_no=$this->input->post('Mr_no');
        $last_id=$slno_Mr_no=$this->input->post('slno_Mr_no');
        $value1=$this->input->post('value1');
        $materials_id=$this->input->post('materials_id');
        $resut=$this->design_user->get_design_mr_file_list_check($slno_Mr_no,$Mr_no);
        $tech_evalution=$this->input->post('tech_evalution');
        $required_date=$this->input->post('required_date');
        $status_mr=$this->input->post('status_mr');
        $email_id_mr=$this->session->userdata('design_email_id');
        $edit_id=$this->input->post('edit_id');
          $codes=$this->input->post('codes');
      
        $approver_id=$this->input->post('approver_id');                                   // approved id 
        $approver_id_detail=$this->design_user->get_design_approver_single($approver_id);
        if(is_array($codes)){
            if($resut['no_files']==2){

                    switch ($materials_id) {
                        case '1':
                             $this->session->set_flashdata('error_message', 'No file has been uploaded. Kindly upload at least one file to proceed further ');
                            redirect('design-new-mr-order-first/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                            // design-new-mr-order-first/
                            break;
                        case '2':
                             $this->session->set_flashdata('error_message', ' No file has been uploaded. Kindly upload at least one file to proceed furtherd  ');
                            redirect('design-new-mr-order-second/'.$slno_Mr_no.'/'.'2/'.$slno_Mr_no);
                            // design-new-mr-order-second
                            break;
                        case '3':
                            $this->session->set_flashdata('error_message', ' No file has been uploaded. Kindly upload at least one file to proceed further  ');
                            redirect('design-new-mr-order-third/'.$slno_Mr_no.'/'.'3/'.$slno_Mr_no);
                           // design-new-mr-order-third
                            break;
                        
                        default:
                            $this->session->set_flashdata('error_message', ' Something went wrong ');
                            redirect('user-design-home');
                            break;
                    }

                    redirect('user-design-home');

            }else{
                 $edits_id=$edit_id+1;
                // exit;
                switch ($materials_id) {
                    case '1':

                        $quantitys=$this->input->post('quantitys');
                        $material_name=$this->input->post('material_name');
                        $codes=$this->input->post('codes');
                        $item_id=$this->input->post('item_id');
                        $item_uom=$this->input->post('item_uom');
                        $technical_mr=$this->input->post('technical_mr');
                    // echo "<pre>";
                    foreach ($codes as $key_value => $ids) {
                        // echo [$key_value][$ids];
                        $query_item_details=$this->design_user->get_design_master_items_material_single($ids);
                        $quantity_single=$quantitys[$key_value];
                        $data_material = array('mr_no_item'=>$Mr_no, 'slno_mr_id'=>$slno_Mr_no, 'material_item_id'=>$query_item_details['materials_list'][0]->Slno_item, 'material_name'=>$query_item_details['materials_list'][0]->item_name, 'material_quantity'=>$quantity_single, 'material_unit'=>$query_item_details['materials_list'][0]->item_uom, 'material_id'=>$query_item_details['materials_list'][0]->item_id, 'edit_id'=>$edits_id);
                        // print_r($data_material);
                            $last_id=$this->design_user->design_common_insert_id($data_material);

                         
                         $technical_mrSingle=$technical_mr[$key_value][$ids];
                         // print_r($technical_mrSingle);
                            foreach ($technical_mrSingle as $key_value_tech => $value_tech) {
                                // echo $technical_mr=$key_value_tech;
                                $technical_mr_id_single=$value_tech;
                                $get_technical=$this->design_user->get_design_master_single_technical($technical_mr_id_single); 
                                      // print_r($get_technical);
                                if($get_technical['no_technical']==2){
                                    $data_technical_parameter = array('mr_no_tech'=>$Mr_no, 'slno_mr_id_tech'=>$slno_Mr_no, 'tech_slno_id'=>'0', 'tech_name'=>'No Parameter Found', 'tech_details'=>'No details Found', 'slno_item_mr_tech'=>$last_id, 'edit_id'=>$edits_id);

                                }else{
                                     

                                       $data_technical_parameter = array('mr_no_tech'=>$Mr_no, 'slno_mr_id_tech'=>$slno_Mr_no, 'tech_slno_id'=>$get_technical['technical_list'][0]->Slno_technical, 'tech_name'=>$get_technical['technical_list'][0]->technical_name, 'tech_details'=>$get_technical['technical_list'][0]->technical_desc, 'slno_item_mr_tech'=>$last_id, 'edit_id'=>$edits_id);
                                }
                               
                                $query_technical_parmeter=$this->design_user->design_Mr_technical_insert_id($data_technical_parameter);
                            }

                        # code...
                    }
                    $date_submition=date('Y-m-d');
                    $time_submition=date('H:i:s');
                    $id = array('slno_mr' =>$slno_Mr_no );
                    $approver_name=$approver_id_detail['user_approver'][0]->Username;
                    $approver_email_id=$approver_id_detail['user_approver'][0]->email_id;  

                    if($send_button=='send'){
                        // `status`,`edit_id`,`date_submition`, `time_submition`
                        $data_send = array('status'=>'1','edit_id'=>$edits_id,'date_submition'=>$date_submition, 'time_submition'=>$time_submition,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name);
                        $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                        $this->session->set_flashdata('success_message', ' successfully MR Is Created And submited to approver ');
                        redirect('user-design-home');
                        break;

                    }else if($send_button=='save'){
                        $data_send = array('status'=>'5','edit_id'=>$edits_id,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name);
                        $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                        $this->session->set_flashdata('success_message', ' Ssuccessfully MR Is Created  Saved ');
                        redirect('user-design-home');
                        break;
                    }
                        
                        // design-new-mr-order-first/
                        break;
                    case '2':

                            $quantitys=$this->input->post('quantitys');
                            $material_name=$this->input->post('material_name');
                            $codes=$this->input->post('codes');
                            $item_id=$this->input->post('item_id');
                            $item_uom=$this->input->post('item_uom');
                            $technical_mr=$this->input->post('technical_mr');
                        // echo "<pre>";
                            foreach ($codes as $key_value => $ids) {
                                // echo [$key_value][$ids];
                                $query_item_details=$this->design_user->get_design_master_items_material_single($ids);
                                $quantity_single=$quantitys[$key_value];
                                
                               $data_material = array('mr_no_item'=>$Mr_no, 'slno_mr_id'=>$slno_Mr_no, 'material_item_id'=>$query_item_details['materials_list'][0]->Slno_item, 'material_name'=>$query_item_details['materials_list'][0]->item_name, 'material_quantity'=>$quantity_single, 'material_unit'=>$query_item_details['materials_list'][0]->item_uom, 'material_id'=>$query_item_details['materials_list'][0]->item_id, 'edit_id'=>$edits_id);
                                // print_r($data_material);
                                    $last_id=$this->design_user->design_common_insert_id($data_material);

                                 
                                 $technical_mrSingle=$technical_mr[$key_value][$ids];
                                 // print_r($technical_mrSingle);
                                    foreach ($technical_mrSingle as $key_value_tech => $value_tech) {
                                        // echo $technical_mr=$key_value_tech;
                                        $technical_mr_id_single=$value_tech;
                                        $get_technical=$this->design_user->get_design_master_single_technical($technical_mr_id_single); 
                                              // print_r($get_technical);
                                        if($get_technical['no_technical']==2){
                                            $data_technical_parameter = array('mr_no_tech'=>$Mr_no, 'slno_mr_id_tech'=>$slno_Mr_no, 'tech_slno_id'=>'0', 'tech_name'=>'No Parameter Found', 'tech_details'=>'No details Found', 'slno_item_mr_tech'=>$last_id, 'edit_id'=>$edits_id);

                                        }else{
                                             

                                               $data_technical_parameter = array('mr_no_tech'=>$Mr_no, 'slno_mr_id_tech'=>$slno_Mr_no, 'tech_slno_id'=>$get_technical['technical_list'][0]->Slno_technical, 'tech_name'=>$get_technical['technical_list'][0]->technical_name, 'tech_details'=>$get_technical['technical_list'][0]->technical_desc, 'slno_item_mr_tech'=>$last_id, 'edit_id'=>$edits_id);
                                        }
                                       
                                        $query_technical_parmeter=$this->design_user->design_Mr_technical_insert_id($data_technical_parameter);
                                    }

                                # code...
                            }
                            $date_submition=date('Y-m-d');
                            $time_submition=date('H:i:s');
                            $id = array('slno_mr' =>$slno_Mr_no );
                            $approver_name=$approver_id_detail['user_approver'][0]->Username;
                            $approver_email_id=$approver_id_detail['user_approver'][0]->email_id;  

                            if($send_button=='send'){
                                // `status`,`edit_id`,`date_submition`, `time_submition`
                                $data_send = array('status'=>'1','edit_id'=>$edits_id,'date_submition'=>$date_submition, 'time_submition'=>$time_submition,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name);
                                $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                                $this->session->set_flashdata('success_message', ' successfully MR Is Created And submited to approver ');
                                redirect('user-design-home');
                                break;

                            }else if($send_button=='save'){
                                $data_send = array('status'=>'5','edit_id'=>$edits_id,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name);
                                $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                                $this->session->set_flashdata('success_message', ' Ssuccessfully MR Is Created  Saved ');
                                redirect('user-design-home');
                                break;
                            }
                        break;
                    case '3':
                        $From_location=$this->input->post('From_location');
                        $to_location=$this->input->post('to_location');
                        $quantity=$this->input->post('quantity');
                        $purpose=$this->input->post('purpose');
                        $vehicle_type=$this->input->post('vehicle_type');
                        $codes=$this->input->post('codes');
                        $vehicle_capacity=$this->input->post('vehicle_capacity');
                        $quantitys=$this->input->post('quantitys');
                        $vehicle_desc=$this->input->post('vehicle_desc');
                        $location_from=$this->input->post('location_from');
                        $location_from_id=$this->input->post('location_from_id');
                        $location_to=$this->input->post('location_to');
                        $location_to_id=$this->input->post('location_to_id');
                        foreach ($codes as $key_value => $ids) {
                            // echo "<pre>";
                            // echo $key_value;
                             $quantity_single=$quantitys[$key_value];
                             $location_from_id_single=$location_from_id[$key_value];
                             $location_to_id_single=$location_to_id[$key_value];
                             $purpose_single=$purpose[$key_value];
                             $codes_single=$codes[$key_value];

                             $get_location_from=$this->design_user->get_design_master_loaction_list($location_from_id_single); // from location

                            $get_location_to=$this->design_user->get_design_master_loaction_list($location_to_id_single); // to location
                            $query_item_details=$this->design_user->get_design_master_vehcile_list($codes_single); //               
                            if($get_location_from['no_location']==1){
                                if($get_location_to['no_location']==1){
                                     if($query_item_details['no_vehcile']==1){
                                    
                                        $data_array []= array('mr_no_vehicle'=>$Mr_no, 'slno_mr_id_vehicle'=>$slno_Mr_no, 'vehicle_slno_id'=>$query_item_details['item_vehcile'][0]->Slno_vehicle, 'vehicle_type'=>$query_item_details['item_vehcile'][0]->vehicle_type, 'vehicle_capcity'=>$query_item_details['item_vehcile'][0]->vehicle_capacity, 'from_location_name'=>$get_location_from['item_location'][0]->location_name, 'from_location_slno'=>$get_location_from['item_location'][0]->slno_loc, 'to_location_name'=>$get_location_to['item_location'][0]->location_name, 'to_location_slno'=>$get_location_to['item_location'][0]->slno_loc, 'purpose_info'=>($purpose_single), 'edit_it'=>$edits_id,  'mr_creater'=>$email_id_mr,'no_vehcile'=>$quantity_single);
                                    }
                                }
                            }
                            
                        }
                        $query_vehicle= $this->db->insert_batch('master_mr_vehicle_mr_detail', $data_array); 
                        // print_r($query_vehicle);
                        // 

                        if($query_vehicle){
                            $data_extra = array('mr_id_location'=>$Mr_no, 'mr_slno_id'=>$slno_Mr_no, 'location_from'=>$From_location, 'location_to'=>$to_location, 'edit_id'=>$edits_id);
                            $query_details_extra=$this->db->insert('master_mr_location',$data_extra);

                            $date_submition=date('Y-m-d');
                            $time_submition=date('H:i:s');
                            $id = array('slno_mr' =>$slno_Mr_no );
                            $approver_name=$approver_id_detail['user_approver'][0]->Username;
                            $approver_email_id=$approver_id_detail['user_approver'][0]->email_id;  

                            if($send_button=='send'){
                                // `status`,`edit_id`,`date_submition`, `time_submition`
                                $data_send = array('status'=>'1','edit_id'=>$edits_id,'date_submition'=>$date_submition, 'time_submition'=>$time_submition,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name);
                                $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                                $this->session->set_flashdata('success_message', ' successfully MR Is Created And submited to approver ');
                                redirect('user-design-home');
                                break;

                            }else if($send_button=='save'){
                                $data_send = array('status'=>'5','edit_id'=>$edits_id,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name);
                                $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                                $this->session->set_flashdata('success_message', ' Ssuccessfully MR Is Created  Saved ');
                                redirect('user-design-home');
                                break;
                            }

                        }
                       // design-new-mr-order-third
                        break;
                    
                    default:
                        $this->session->set_flashdata('error_message', ' Something went wrong ');
                        redirect('user-design-home');
                        break;
                }
            }


        }else{
            switch ($materials_id) {
                case '1':
                     $this->session->set_flashdata('error_message', 'At Least one item should be added to the cart to proceed further ');
                     if($status_mr==4){
                        redirect('design-new-mr-order-first/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }else if($status_mr==5){
                        redirect('design-new-mr-order-first-edit/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }
                    // design-new-mr-order-first/
                    break;
                case '2':
                     $this->session->set_flashdata('error_message', ' At Least one item should be added to the cart to proceed further ');
                    if($status_mr==4){
                        redirect('design-new-mr-order-second/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }else if($status_mr==5){
                        redirect('design-new-mr-order-second-edit/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }
                    // redirect('design-new-mr-order-second/'.$last_id.'/'.'2/'.$last_id);
                    // design-new-mr-order-second
                    break;
                case '3':
                    $this->session->set_flashdata('error_message', 'At Least one item should be added to the cart to proceed further ');
                    if($status_mr==4){
                        redirect('design-new-mr-order-third/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }else if($status_mr==5){
                        redirect('design-new-mr-order-third-edit/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }
                    // redirect('design-new-mr-order-third/'.$last_id.'/'.'3/'.$last_id);
                   // design-new-mr-order-third
                    break;
                
                default:
                    $this->session->set_flashdata('error_message', ' Something went wrong ');
                    redirect('user-design-home');
                    break;
            }

                    redirect('user-design-home');
        }
        // print_r($this->input->post());
        # code...
    }


    // mr-history fom job code
    public function design_submitted_mr_order_detail($value,$type){
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

        $data=array('title' =>"Material Requisition form II",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','job_Code_id'=>$value); 
        $this->load->view('template/template_header',$data);
        $this->load->view('design_user/template/template_top_head');
        $this->load->view('design_user/template/template_side_bar',$data);     
           
        if($type==2){
             $this->load->view('design_user/submit_mr_list/view_submited_mr_list_details',$data);
        }else if($type==3){
             $this->load->view('design_user/submit_mr_list/view_mr_list_drafted',$data);
        }else{
             $this->session->set_flashdata('error_message', ' Something went wrong ');
             redirect('user-design-home');
        }
        $this->load->view('template/template_footer',$data);
        
    }

    public function design_new_mr_order_first_view($value,$value1,$value2){ //SCI
         $_SESSION["cart_item"]="";
         $_SESSION['cart_item_tech']="";
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script> <script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script> <script src="'.base_url().'file_css_admin/upload.js"></script>';
// upload
        $data=array('title' =>"Material Requisition form II",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/submit_mr_list/view_detail_submitted_mr/create_mr_order_first_view',$data);
            $this->load->view('template/template_footer',$data);
        # code...create_mr_order_first.php
        
    }
    public function design_new_mr_order_second_view($value,$value1,$value2){ //MOI
         $_SESSION["cart_item"]="";
         $_SESSION['cart_item_tech']="";
         $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script><script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';

        $data=array('title' =>"Material Requisition form II",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/submit_mr_list/view_detail_submitted_mr/create_mr_order_second_view',$data);
            $this->load->view('template/template_footer',$data);
        # code...create_mr_order_second.php
    }
    public function design_new_mr_order_third_view($value,$value1,$value2){ //logistic
        $_SESSION["cart_item"]="";
        $_SESSION['cart_item_tech'] = array();;
          $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script><script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';

        $data=array('title' =>"Create New Material Requisition",'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/submit_mr_list/view_detail_submitted_mr/create_mr_order_third_view',$data);
            $this->load->view('template/template_footer',$data);
        # code...create_mr_order_third.php
    }

//
//resubmission
    public function design_resubmission_mr_order(){
          $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

        $data=array('title' =>"View Resubmission Of MR List",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'3','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/re_submit/viewresubmitlist');
            $this->load->view('template/template_footer',$data);
    }


    public function design_resubmit_mr_order_edit($value,$value1,$value2){
        switch ($value1) {
                case '1':
                    $title="Resubmission detail of standard catalogued item";
                    $view_page="create_mr_order_first_resubmit";
                    break;
                case '2':
                    $title="Resubmission detail of make to order items";
                    $view_page="create_mr_order_second_resubmit";
                    break;
                case '3':
                    $title="Resubmission detail of logistics";
                    $view_page="create_mr_order_third_resubmit";
                    break;
                
                default:
                    # code...
                    break;
            }
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';
            $data=array('title' =>$title,'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);    

            $this->load->view('template/template_header',$data);
            $this->load->view('design_user/template/template_top_head');
            $this->load->view('design_user/template/template_side_bar',$data);
            $this->load->view('design_user/re_submit/resubmit_detail_submitted_mr/'.$view_page,$data);
            $this->load->view('template/template_footer',$data);
        # code...
    }
    public function design_resubmit_new_mr_save_formII($value=''){
        $send_button=$this->input->post('send_button'); // this important to find whether tosend or save inforamtion to edit
        $Mr_no=$this->input->post('Mr_no');
        $last_id=$slno_Mr_no=$this->input->post('slno_Mr_no');
        $value1=$this->input->post('value1');
        $materials_id=$this->input->post('materials_id');
        $resut=$this->design_user->get_design_mr_file_list_check($slno_Mr_no,$Mr_no);
        $tech_evalution=$this->input->post('tech_evalution');
        $required_date=$this->input->post('required_date');
        $status_mr=$this->input->post('status_mr');
        $email_id_mr=$this->session->userdata('design_email_id');
        $edit_id=$this->input->post('edit_id');
          $codes=$this->input->post('codes');
      
        $approver_id=$this->input->post('approver_id');                                   // approved id 
        $approver_id_detail=$this->design_user->get_design_approver_single($approver_id);
        if(is_array($codes)){
            if($resut['no_files']==2){
                switch ($materials_id) {
                    case '1':
                         $this->session->set_flashdata('error_message', 'No file has been uploaded. Kindly upload at least one file to proceed further ');
                        redirect('ddesign-resubmit-mr-order-edit/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                        // design-new-mr-order-first/
                        break;
                    case '2':
                         $this->session->set_flashdata('error_message', ' No file has been uploaded. Kindly upload at least one file to proceed furtherd  ');
                        redirect('design-resubmit-mr-order-edit/'.$slno_Mr_no.'/'.'2/'.$slno_Mr_no);
                        // design-new-mr-order-second
                        break;
                    case '3':
                        $this->session->set_flashdata('error_message', ' No file has been uploaded. Kindly upload at least one file to proceed further  ');
                        redirect('design-resubmit-mr-order-edit/'.$slno_Mr_no.'/'.'3/'.$slno_Mr_no);
                       // design-new-mr-order-third
                        break;
                    
                    default:
                        $this->session->set_flashdata('error_message', ' Something went wrong ');
                        redirect('user-design-home');
                        break;
                }

                redirect('user-design-home');

            }else{
                 $edits_id=$edit_id+1;
                // exit;
                switch ($materials_id) {
                    case '1':

                        $quantitys=$this->input->post('quantitys');
                        $material_name=$this->input->post('material_name');
                        $codes=$this->input->post('codes');
                        $item_id=$this->input->post('item_id');
                        $item_uom=$this->input->post('item_uom');
                        $technical_mr=$this->input->post('technical_mr');
                    // echo "<pre>";
                    foreach ($codes as $key_value => $ids) {
                        // echo [$key_value][$ids];
                        $query_item_details=$this->design_user->get_design_master_items_material_single($ids);
                        $quantity_single=$quantitys[$key_value];
                        $data_material = array('mr_no_item'=>$Mr_no, 'slno_mr_id'=>$slno_Mr_no, 'material_item_id'=>$query_item_details['materials_list'][0]->Slno_item, 'material_name'=>$query_item_details['materials_list'][0]->item_name, 'material_quantity'=>$quantity_single, 'material_unit'=>$query_item_details['materials_list'][0]->item_name, 'material_id'=>$query_item_details['materials_list'][0]->item_name, 'edit_id'=>$edits_id);
                        // print_r($data_material);
                            $last_id=$this->design_user->design_common_insert_id($data_material);

                         
                         $technical_mrSingle=$technical_mr[$key_value][$ids];
                         // print_r($technical_mrSingle);
                            foreach ($technical_mrSingle as $key_value_tech => $value_tech) {
                                // echo $technical_mr=$key_value_tech;
                                $technical_mr_id_single=$value_tech;
                                $get_technical=$this->design_user->get_design_master_single_technical($technical_mr_id_single); 
                                      // print_r($get_technical);
                                if($get_technical['no_technical']==2){
                                    $data_technical_parameter = array('mr_no_tech'=>$Mr_no, 'slno_mr_id_tech'=>$slno_Mr_no, 'tech_slno_id'=>'0', 'tech_name'=>'No Parameter Found', 'tech_details'=>'No details Found', 'slno_item_mr_tech'=>$last_id, 'edit_id'=>$edits_id);

                                }else{
                                     

                                       $data_technical_parameter = array('mr_no_tech'=>$Mr_no, 'slno_mr_id_tech'=>$slno_Mr_no, 'tech_slno_id'=>$get_technical['technical_list'][0]->Slno_technical, 'tech_name'=>$get_technical['technical_list'][0]->technical_name, 'tech_details'=>$get_technical['technical_list'][0]->technical_desc, 'slno_item_mr_tech'=>$last_id, 'edit_id'=>$edits_id);
                                }
                               
                                $query_technical_parmeter=$this->design_user->design_Mr_technical_insert_id($data_technical_parameter);
                            }

                        # code...
                    }
                    $date_submition=date('Y-m-d');
                    $time_submition=date('H:i:s');
                    $id = array('slno_mr' =>$slno_Mr_no );
                    $approver_name=$approver_id_detail['user_approver'][0]->Username;
                    $approver_email_id=$approver_id_detail['user_approver'][0]->email_id;  

                    if($send_button=='send'){
                        // `status`,`edit_id`,`date_submition`, `time_submition`
                        $data_send = array('status'=>'1','edit_id'=>$edits_id,'date_submition'=>$date_submition, 'time_submition'=>$time_submition,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name,'status_resubmit'=>0);
                        $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                        $this->session->set_flashdata('success_message', ' successfully MR Is Resubmited And submited to approver ');
                        redirect('user-design-home');
                        break;

                    }else if($send_button=='save'){
                        $data_send = array('status'=>'5','edit_id'=>$edits_id,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name);
                        $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                        $this->session->set_flashdata('success_message', ' Ssuccessfully MR Is Created  Saved ');
                        redirect('user-design-home');
                        break;
                    }
                        
                        // design-new-mr-order-first/
                        break;
                    case '2':

                            $quantitys=$this->input->post('quantitys');
                            $material_name=$this->input->post('material_name');
                            $codes=$this->input->post('codes');
                            $item_id=$this->input->post('item_id');
                            $item_uom=$this->input->post('item_uom');
                            $technical_mr=$this->input->post('technical_mr');
                        // echo "<pre>";
                            foreach ($codes as $key_value => $ids) {
                                // echo [$key_value][$ids];
                                $query_item_details=$this->design_user->get_design_master_items_material_single($ids);
                                $quantity_single=$quantitys[$key_value];
                                $data_material = array('mr_no_item'=>$Mr_no, 'slno_mr_id'=>$slno_Mr_no, 'material_item_id'=>$query_item_details['materials_list'][0]->Slno_item, 'material_name'=>$query_item_details['materials_list'][0]->item_name, 'material_quantity'=>$quantity_single, 'material_unit'=>$query_item_details['materials_list'][0]->item_name, 'material_id'=>$query_item_details['materials_list'][0]->item_name, 'edit_id'=>$edits_id);
                                // print_r($data_material);
                                    $last_id=$this->design_user->design_common_insert_id($data_material);

                                 
                                 $technical_mrSingle=$technical_mr[$key_value][$ids];
                                 // print_r($technical_mrSingle);
                                    foreach ($technical_mrSingle as $key_value_tech => $value_tech) {
                                        // echo $technical_mr=$key_value_tech;
                                        $technical_mr_id_single=$value_tech;
                                        $get_technical=$this->design_user->get_design_master_single_technical($technical_mr_id_single); 
                                              // print_r($get_technical);
                                        if($get_technical['no_technical']==2){
                                            $data_technical_parameter = array('mr_no_tech'=>$Mr_no, 'slno_mr_id_tech'=>$slno_Mr_no, 'tech_slno_id'=>'0', 'tech_name'=>'No Parameter Found', 'tech_details'=>'No details Found', 'slno_item_mr_tech'=>$last_id, 'edit_id'=>$edits_id);

                                        }else{
                                             

                                               $data_technical_parameter = array('mr_no_tech'=>$Mr_no, 'slno_mr_id_tech'=>$slno_Mr_no, 'tech_slno_id'=>$get_technical['technical_list'][0]->Slno_technical, 'tech_name'=>$get_technical['technical_list'][0]->technical_name, 'tech_details'=>$get_technical['technical_list'][0]->technical_desc, 'slno_item_mr_tech'=>$last_id, 'edit_id'=>$edits_id);
                                        }
                                       
                                        $query_technical_parmeter=$this->design_user->design_Mr_technical_insert_id($data_technical_parameter);
                                    }

                                # code...
                            }
                            $date_submition=date('Y-m-d');
                            $time_submition=date('H:i:s');
                            $id = array('slno_mr' =>$slno_Mr_no );
                            $approver_name=$approver_id_detail['user_approver'][0]->Username;
                            $approver_email_id=$approver_id_detail['user_approver'][0]->email_id;  

                            if($send_button=='send'){
                                // `status`,`edit_id`,`date_submition`, `time_submition`
                                $data_send = array('status'=>'1','edit_id'=>$edits_id,'date_submition'=>$date_submition, 'time_submition'=>$time_submition,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name,'status_resubmit'=>0);
                                $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                                $this->session->set_flashdata('success_message', ' successfully MR Is Resubmited And submited to approver ');
                                redirect('user-design-home');
                                break;

                            }else if($send_button=='save'){
                                $data_send = array('status'=>'5','edit_id'=>$edits_id,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name);
                                $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                                $this->session->set_flashdata('success_message', ' Ssuccessfully MR Is Created  Saved ');
                                redirect('user-design-home');
                                break;
                            }
                        break;
                    case '3':
                        $From_location=$this->input->post('From_location');
                        $to_location=$this->input->post('to_location');
                        $quantity=$this->input->post('quantity');
                        $purpose=$this->input->post('purpose');
                        $vehicle_type=$this->input->post('vehicle_type');
                        $codes=$this->input->post('codes');
                        $vehicle_capacity=$this->input->post('vehicle_capacity');
                        $quantitys=$this->input->post('quantitys');
                        $vehicle_desc=$this->input->post('vehicle_desc');
                        $location_from=$this->input->post('location_from');
                        $location_from_id=$this->input->post('location_from_id');
                        $location_to=$this->input->post('location_to');
                        $location_to_id=$this->input->post('location_to_id');
                        foreach ($codes as $key_value => $ids) {
                            // echo "<pre>";
                            // echo $key_value;
                             $quantity_single=$quantitys[$key_value];
                             $location_from_id_single=$location_from_id[$key_value];
                             $location_to_id_single=$location_to_id[$key_value];
                             $purpose_single=$purpose[$key_value];
                             $codes_single=$codes[$key_value];

                             $get_location_from=$this->design_user->get_design_master_loaction_list($location_from_id_single); // from location

                            $get_location_to=$this->design_user->get_design_master_loaction_list($location_to_id_single); // to location
                            $query_item_details=$this->design_user->get_design_master_vehcile_list($codes_single); //               
                            if($get_location_from['no_location']==1){
                                if($get_location_to['no_location']==1){
                                     if($query_item_details['no_vehcile']==1){
                                    
                                        $data_array []= array('mr_no_vehicle'=>$Mr_no, 'slno_mr_id_vehicle'=>$slno_Mr_no, 'vehicle_slno_id'=>$query_item_details['item_vehcile'][0]->Slno_vehicle, 'vehicle_type'=>$query_item_details['item_vehcile'][0]->vehicle_type, 'vehicle_capcity'=>$query_item_details['item_vehcile'][0]->vehicle_capacity, 'from_location_name'=>$get_location_from['item_location'][0]->location_name, 'from_location_slno'=>$get_location_from['item_location'][0]->slno_loc, 'to_location_name'=>$get_location_to['item_location'][0]->location_name, 'to_location_slno'=>$get_location_to['item_location'][0]->slno_loc, 'purpose_info'=>($purpose_single), 'edit_it'=>$edits_id,  'mr_creater'=>$email_id_mr,'no_vehcile'=>$quantity_single);
                                    }
                                }
                            }
                            
                        }
                        $query_vehicle= $this->db->insert_batch('master_mr_vehicle_mr_detail', $data_array); 
                        // print_r($query_vehicle);
                        // 

                        if($query_vehicle){
                            $data_extra = array('mr_id_location'=>$Mr_no, 'mr_slno_id'=>$slno_Mr_no, 'location_from'=>$From_location, 'location_to'=>$to_location, 'edit_id'=>$edits_id);
                            $query_details_extra=$this->db->insert('master_mr_location',$data_extra);

                            $date_submition=date('Y-m-d');
                            $time_submition=date('H:i:s');
                            $id = array('slno_mr' =>$slno_Mr_no );
                            $approver_name=$approver_id_detail['user_approver'][0]->Username;
                            $approver_email_id=$approver_id_detail['user_approver'][0]->email_id;  

                            if($send_button=='send'){
                                // `status`,`edit_id`,`date_submition`, `time_submition`
                                $data_send = array('status'=>'1','edit_id'=>$edits_id,'date_submition'=>$date_submition, 'time_submition'=>$time_submition,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name,'status_resubmit'=>0);
                                $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                                $this->session->set_flashdata('success_message', ' successfully MR Is Resubmited And submited to approver ');
                                redirect('user-design-home');
                                break;

                            }else if($send_button=='save'){
                                $data_send = array('status'=>'5','edit_id'=>$edits_id,'date_required'=>$required_date,'approver_id_slno'=>$approver_id, 'approver_id'=>$approver_email_id, 'approver_name'=>$approver_name);
                                $query_details=$this->design_user->master_mr_job_details_value($data_send,$id);
                                $this->session->set_flashdata('success_message', ' Ssuccessfully MR Is Created  Saved ');
                                redirect('user-design-home');
                                break;
                            }

                        }
                       // design-new-mr-order-third
                        break;
                    
                    default:
                        $this->session->set_flashdata('error_message', ' Something went wrong ');
                        redirect('user-design-home');
                        break;
                }
            }


        }else{
            switch ($materials_id) {
                case '1':
                     $this->session->set_flashdata('error_message', 'At Least one item should be added to the cart to proceed further ');
                     if($status_mr==6){
                        redirect('design-resubmit-mr-order-edit/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }else{
                        redirect('design-resubmit-mr-order-edit/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }
                    // design-new-mr-order-first/
                    break;
                case '2':
                     $this->session->set_flashdata('error_message', ' At Least one item should be added to the cart to proceed further ');
                    if($status_mr==6){
                        redirect('design-resubmit-mr-order-edit/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }else{
                        redirect('design-resubmit-mr-order-edit/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }
                    // redirect('design-new-mr-order-second/'.$last_id.'/'.'2/'.$last_id);
                    // design-new-mr-order-second
                    break;
                case '3':
                    $this->session->set_flashdata('error_message', 'At Least one item should be added to the cart to proceed further ');
                    if($status_mr==6){
                        redirect('design-resubmit-mr-order-edit/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }else{
                        redirect('design-resubmit-mr-order-edit/'.$slno_Mr_no.'/'.'1/'.$slno_Mr_no);
                    }
                    // redirect('design-new-mr-order-third/'.$last_id.'/'.'3/'.$last_id);
                   // design-new-mr-order-third
                    break;
                
                default:
                    $this->session->set_flashdata('error_message', ' Something went wrong ');
                    redirect('user-design-home');
                    break;
            }

                    redirect('user-design-home');
        }
    }
######################################################################################################################################
#
# Logout sction
#
######################################################################################################################################
    public function design_logout(){
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
                        $this->session->set_flashdata('success_message', 'Signout from Design User panel');
                        redirect('home');

                }else{

                        $user_data = array('logout_date'=>$date, 'logout_time'=>$time, 'status'=>'2');
                        $id=array('session_id'=>$session_id);
                        $user_hstory_table="master_session_history";
                        $result_history = $this->user->common_update($user_hstory_table,$user_data,$id); 
                        session_destroy();
                        session_start();                        
                        $this->session->set_flashdata('success_message', 'Sign-out from Design User Panel');
                        redirect('home');     
                }

    }

     public function design_logout_bypass(){
        $this->session->set_flashdata('error_msg', 'Invalid entry to Design User panel');
        redirect('home');     
                
    }

}