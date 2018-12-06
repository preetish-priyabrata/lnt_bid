<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buyeruser extends CI_Controller {
    public function __construct(){
            parent::__construct();
            // Loading my model which will use
            $this->load->model('user_model', 'user');
            $this->load->model('approver_model', 'approver_user');
            $this->load->model('design_model', 'design_user');
            $this->load->model('procurement_model', 'procurement_user');
            $this->load->model('buyer_model','buyer_user');
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
            $data=array('title' =>"Buyer User Dashboard",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('buyer_user/template/template_top_head');
            $this->load->view('buyer_user/template/template_side_bar',$data);
            $this->load->view('buyer_user/user_dashboard');
            $this->load->view('template/template_footer',$data);
        # code...
    }
   public function buyer_mr_received($value=''){ // will show mr in mr received
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';
            $data=array('title' =>"Buyer List Of Mr Received",'script_js'=>$scripts,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('buyer_user/template/template_top_head');
            $this->load->view('buyer_user/template/template_side_bar',$data);
            $this->load->view('buyer_user/received_mr/view_received_MR_list');
            $this->load->view('template/template_footer',$data);
       # code...
   }
   /**
    * [buyer_technical_commercial_assign description]=>here buyer will fix
    * @param  string $value  [description]=>type of form ie technical->005100 or commetrical->005200 or techno/commercerial->005110
    * @param  string $value1 [description]=>mr Id Serial no which is increment automatic
    * @param  string $value2 [description]=> Material type form
    * @param  string $value3 [description]=>mr Id Serial no which is increment automatic
    * @param  string $value4 [description]=>buyer table  serial id which will update status

    */
   public function buyer_technical_commercial_assign($value='',$value1='',$value2='',$value3='',$value4=''){

     $value_details=$value.'-'.$value2;
   // exit;
    switch ($value_details) {
        // sci
        case '005100-1': // here first technical is been send to buyer to set information is about technical
            $file_path="buyer_user/received_mr/received_new_tech/Create_bid_mr/create_new_technical_bid";
            break;
        case '005110-1': // here first technical  is been complted but commercial is pendin send to buyer to set information is about Commerical
            # code...
            break;
        case '005200-1': // here first technical  is been complted but commercial is pendin send to buyer to set information is about Commerical
            # code...
            break;
        //Moi
         case '005100-2': // here first technical is been send to buyer to set information is about technical
            $file_path="buyer_user/received_mr/received_new_tech/Create_bid_mr/create_new_technical_bid";// here bo standard and make to order item is ame because design is ame
            break;
        case '005110-2': // here first technical  is been complted but commercial is pendin send to buyer to set information is about Commerical
            # code...
            break;
        case '005200-2': // here first technical  is been complted but commercial is pendin send to buyer to set information is about Commerical
            # code...
            break;
        // Logistics
         case '005100-3': // here first technical is been send to buyer to set information is about technical

             $file_path="buyer_user/received_mr/received_new_tech/Create_bid_mr/create_new_technical_bid_logistic";
            break;
        case '005110-3': // here first technical  is been complted but commercial is pendin send to buyer to set information is about Commerical
            # code...
            break;
        case '005200-3': // here first technical  is been complted but commercial is pendin send to buyer to set information is about Commerical

            break;
        default:
            // $this->session->set_flashdata('error_msg', 'Some thing Went wrong');
            // redirect('user-buyer-home');
            break;
    }
            $scripts='<script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';
            $data=array('title' =>"Buyer List Of Mr Received",'script_js'=>$scripts,'menu_status'=>'1','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'' ,'value'=>$value,'value1'=>$value1,'value2'=>$value2,'value3'=>$value3,'value4'=>$value4);
            $this->load->view('template/template_header',$data);
            $this->load->view('buyer_user/template/template_top_head');
            $this->load->view('buyer_user/template/template_side_bar',$data);
            $this->load->view("$file_path",$data);
            $this->load->view('template/template_footer',$data);

   }

   public function buyer_get_buyer_bid_Check($value=''){
        // print_r($this->input->post());
        $field_id=$this->input->post('field_id');
        $job_codes=$this->input->post('job_codes');

        switch ($field_id) {
            case '1':
                $data_array = array('bid_ref' =>$job_codes);
                $query_exe=$this->db->get_where('master_bid',$data_array);
                if ($query_exe->num_rows()==0) {
                    echo 1;
                    exit;
                    # code...
                }else if ($query_exe->num_rows()!=0) {
                     echo 2;
                    exit;
                }
                break;
            case '2':
               $data_array = array('bid_id ' =>$job_codes);
                $query_exe=$this->db->get_where('master_bid',$data_array);
                if ($query_exe->num_rows()==0) {
                    echo 1;
                    exit;
                    # code...
                }else if ($query_exe->num_rows()!=0) {
                     echo 2;
                    exit;
                }
                break;

            default:
                # code...
                break;
        }

        // Array ( [field_id] => 1 [job_codes] => bid )
       # code...
   }

   public function buyer_file_upload_data($value=''){
        $email_id=$this->session->userdata('buy_email_id');
        if(empty($email_id)){

            redirect('buy-logout-by-pass');
        }
        $actions_file=$this->input->post('actions_file');
        $value4=$this->input->post('value4');
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
                                $data_array = array('bid_buyer_slno'=>$value4, 'bid_slno'=>$slno_Mr_no, 'file_code_name'=>$file_stored_name, 'file_name'=>$file_name,'status'=>'1','who_loaded_file'=>$email_id);
                                $query_files=$this->db->insert('master_bid_file_technical',$data_array);
                                echo '1' ;
                            }
                        }
                    }
                }
                break;
             case 'files_info':
                $result_file=$this->buyer_user->get_buyer_mr_file_list($slno_Mr_no,$value4);
                if($result_file['no_files']==2){
                    echo "<p class='text-center' style='color:red'><b>No File Attachment is found for this Bid Request no</b></p>";
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
                                    <td><strong><?=$key_files->file_name?></strong></td>
                                    <td><strong><a target="_blank" href="<?=base_url()?>upload_files/design_upload/<?=$key_files->file_code_name?>">Click View</a> </strong></td>
                                    <td><strong><span onclick="file_delete(<?=$key_files->Slno_bid_file?>)" class="btn btn-sm btn-danger">Delete File</span></strong></td>
                                </tr>


                            <?php }?>

                        </tbody>
                    </table>
                    <?php

                }

                break;
            case 'files_info_delete':
                $file_id=$this->input->post('file_id');
                $this->db->where('Slno_bid_file', $file_id);
                $query_result=$this->db->get('master_bid_file_technical');

                $data_result=$query_result->result();
                $data_details=$data_result[0];

                $path_to_file = 'upload_files/design_upload/'.$data_details->file_code_name;
                if(unlink($path_to_file)) {
                    $this->db->where('Slno_bid_file', $file_id);
                    $query=$this->db->delete('master_bid_file_technical');
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
                $result_file=$this->buyer_user->get_buyer_mr_file_list($slno_Mr_no,$value4);
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
                                    <td><strong><?=$key_files->file_name?></strong></td>
                                    <td><strong><a target="_blank" href="<?=base_url()?>upload_files/design_upload/<?=$key_files->file_code_name?>">Click View</a> </strong></td>

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
    public function buyer_bid_tech_entry($value=''){
        // Array ( [slno_Mr_no] => 3 [value4] => 1 [edit_id] => 1 [status_mr] => 1 [resubmit_count] => 0 [job_code_id] => 679034 [materials_id] => 3 [tech_evalution] => 1 [mr_no] => 2018-11-05-pUgws [category_name] => logistics [ logistics ] [date_required] => 2018-11-29 [from_key_from_loc] => bhu1 [from_key_to_loc] => sailahree vihar [date_create] => 2018-12-03 [bid_ref_no] => REF 2018 [bid_method] => Closed Bid [date_publish] => 2018-12-29 [bid_Id] => REF 2018 [date_closing] => 2018-12-15 [bid_title] => SUPPLY OF CLOTHING ARTICLES FOR NCC CADETS OF NCC DIRECTORATE DELHI [bid_period_work] => 6 month [bid_work_description] => INVITATION OF BIDS FOR SUPPLY OF CLOTHING ARTICLES FOR NCC CADETS OF NCC DIRECTORATE DELHI [bid_location_work] => Delhi [date_start_bid] => 2018-12-04 [date_clearfication_bid] => 2018-12-06 [date_closed_bid] => 2018-12-15 [bid_detail_description] => INVITATION OF BIDS FOR SUPPLY OF CLOTHING ARTICLES FOR NCC CADETS OF NCC DIRECTORATE DELHI [job_files] => vdbanner.jpg [Technical_ev] => 19 [vendor_array] => Array ( [0] => ven111@gmail.com [1] => ven121@gmail.com [2] => ven221@gmail.com [3] => ven310@yahoo.com [4] => ven97@gmail.com [5] => ven979@yahoo.com ) [for] => Send )
        // print_r($this->input->post());
        // exit;
        $slno_Mr_no=$this->input->post('slno_Mr_no');  // mr_information id
        $value4=$this->input->post('value4'); // buyer panel id
        $edit_id=$this->input->post('edit_id'); // mateial information
        $status_mr=$this->input->post('status_mr');
        $resubmit_count=$this->input->post('resubmit_count');
        $job_code_id=$this->input->post('job_code_id'); // job code of mr
        $materials_id=$this->input->post('materials_id'); // material id
        $tech_evalution=$this->input->post('tech_evalution');
        $mr_no=$this->input->post('mr_no'); //mr id no come from mr tABLE
        $category_name=$this->input->post('category_name'); // name of category
        $date_required=$this->input->post('date_required'); // when this mr is need
        $date_create=$this->input->post('date_create'); // when bid is created
        $bid_ref_no=$this->input->post('bid_ref_no'); // bid ref nao
        $bid_method=$this->input->post('bid_method'); // method of biding
        $date_publish=$this->input->post('date_publish'); // publishing date
        $bid_Id=$this->input->post('bid_Id');             // bid serial id
        $date_closing=$this->input->post('date_closing'); //bid colsed date
        $bid_title=$this->input->post('bid_title'); // bid title
        $bid_period_work=$this->input->post('bid_period_work'); // bid period work
        $bid_work_description=$this->input->post('bid_work_description'); //bid work description
        $bid_location_work=$this->input->post('bid_location_work'); //bid location work
        $date_start_bid=$this->input->post('date_start_bid');  // bid start date
        $date_clearfication_bid=$this->input->post('date_clearfication_bid'); // bid doubt clearfication date
        $date_closed_bid=$this->input->post('date_closed_bid'); // bid closed date
        $bid_detail_description=$this->input->post('bid_detail_description'); // detail information of description
        $job_files=$this->input->post('job_files');
        $Technical_ev=$this->input->post('Technical_ev');  // here is the technical evalutor  serial no only
        $vendor_array=$this->input->post('vendor_array'); // array of vendors with email ids
        $email_id=$this->session->userdata('buy_email_id');
        if(!empty($vendor_array)){
            $data_bid_master = array('buyer_slno'=>$value4, 'bid_date_entry'=>$date_create, 'bid_ref'=>$bid_ref_no, 'bid_id'=>$bid_Id, 'category'=>$materials_id, 'mode_bid'=>$bid_method, 'technical_bid_type'=>$tech_evalution, 'status_bid'=>'4', 'mr_slno'=>$slno_Mr_no, 'mr_no'=>$mr_no, 'job_code'=>$job_code_id, 'edit_id'=>$edit_id,'material_category_name'=>$category_name,'bid_title'=>$bid_title,'bid_description'=>$bid_work_description,'bid_creator_id'=>$email_id,'date_publish'=>$date_publish,'date_closing'=>$date_closing);

            $query_bid_master=$this->db->insert('master_bid',$data_bid_master);
            $insert_id = $this->db->insert_id();
            if($query_bid_master){
                $data_title = array('bid_slno'=>$slno_Mr_no, 'buyer_slno'=>$value4, 'Title_bid'=>$bid_title, 'work_detail_bid'=>$bid_work_description, 'period_work_detail'=>$bid_period_work, 'location_detail'=>$bid_location_work, 'master_bid_id'=>$insert_id);

                $query_title_master=$this->db->insert('master_bid_details',$data_title);

                $data_bid_date = array('bid_slno'=>$slno_Mr_no, 'buyer_slno'=>$value4, 'bid_start_date'=>$date_start_bid, 'bid_closed_date'=>$date_closed_bid, 'bid_query_closed_date'=>$date_clearfication_bid, 'status'=>'4', 'master_bid_id'=>$insert_id,'bid_detail_description'=>$bid_detail_description);
                $query_bid_date_master=$this->db->insert('master_bid_date_details',$data_bid_date);

                $bid_technical = array('bid_slno'=>$slno_Mr_no, 'buyer_slno'=>$value4, 'Technical_id_person'=>$Technical_ev, 'master_bid_id'=>$insert_id);
                $query_technical_master=$this->db->insert('master_bid_technicalevaluation',$bid_technical);
                foreach ($vendor_array as $key_vendor) {
                    $vendor_infom = array('bid_slno'=>$slno_Mr_no, 'buyer_slno'=>$value4, 'vendor_id'=>$key_vendor, 'status'=>4, 'title'=>$bid_title, 'description'=>$bid_work_description, 'date_start'=>$date_start_bid, 'date_end'=>$date_closed_bid,
                        'query_end_date'=>$date_clearfication_bid, 'master_bid_id'=>$insert_id,'bid_ref'=>$bid_ref_no, 'bid_id'=>$bid_Id, 'category'=>$materials_id, 'mode_bid'=>$bid_method, 'technical_bid_type'=>$tech_evalution, 'mr_slno'=>$slno_Mr_no, 'mr_no'=>$mr_no, 'job_code'=>$job_code_id, 'edit_id'=>$edit_id, 'material_category_name'=>$category_name );
                    $query_vendor_inform_master=$this->db->insert('master_bid_vendor',$vendor_infom);
                }
                $buyer_id = array('Slno_buyer' =>$value4 );
                $data_update_mr_buyer= array('Technical_process_status'=>2, 'Date_technical_status'=>date('Y-m-d'), 'Mode_tender'=>$bid_method);
                 $query_buyer_id_master=$this->db->update('master_buyer_MR',$data_update_mr_buyer,$buyer_id);
                $this->session->set_flashdata('success_message', 'successfully Bid is created is not send to technical approver or Vendor ');
                             // After that you need to used r
                redirect('user-buyer-home');
            }else{
                $this->session->set_flashdata('error_message',  'Some thing went worng Try Again!!!!');
                redirect('user-buyer-home');
            }
        }else{
             $this->session->set_flashdata('error_message',  'Novendor is Selletec');
                redirect('user-buyer-home');
        }


    }
    public function buyer_drafted_bid($value=''){
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';
            $data=array('title' =>"Save Bid Information ",'script_js'=>$scripts,'menu_status'=>'2','sub_menu'=>'2','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');

            $this->load->view('template/template_header',$data);
            $this->load->view('buyer_user/template/template_top_head');
            $this->load->view('buyer_user/template/template_side_bar',$data);
            $this->load->view('buyer_user/bid_saved/bid_save_drafted');
            $this->load->view('template/template_footer',$data);

        # code...
    }
    public function buyer_bid_sent($value='',$value1=''){
        switch ($value1) {
            case '1':
                $file_path="buyer_user/bid_saved/save_new_tech/view_bid_mr_send/view_new_technical_bid";
                # code...
                break;
            case '2':
                $file_path="buyer_user/bid_saved/save_new_tech/view_bid_mr_send/view_new_technical_bid";
                # code...
                break;
            case '3':
                $file_path="buyer_user/bid_saved/save_new_tech/view_bid_mr_send/view_new_technical_bid_logistic";
                # code...
                break;

            default:
                # code...
                break;
        }
        $scripts='<script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';
            $data=array('title' =>"Buyer List Of Mr Received",'script_js'=>$scripts,'menu_status'=>'2','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'' ,'value'=>$value,'value1'=>$value1);
            $this->load->view('template/template_header',$data);
            $this->load->view('buyer_user/template/template_top_head');
            $this->load->view('buyer_user/template/template_side_bar',$data);
            $this->load->view("$file_path",$data);
            $this->load->view('template/template_footer',$data);
        # code...
    }
    public function buyer_bid_conform_send($value=''){
      $master_bid_up = array('status_bid' =>1);
      $master_bid_date_up = array('status' =>1);
      $master_bid_vendor_up = array('status' =>1,'status_active'=>1);

      $id_master_bid = array('Slno_bid' => $value );
      $id_master_bid_common = array('master_bid_id' => $value );

      $query_bid_master=$this->db->update('master_bid',$master_bid_up,$$id_master_bid);// master bid update
      if($query_bid_master){
          $query_bid_master_date=$this->db->update('master_bid_date_details',$master_bid_date_up,$id_master_bid_common); // master bid date update status
          if($query_bid_master_date){
              $query_bid_master_vendor=$this->db->update('master_bid_vendor',$master_bid_vendor_up,$id_master_bid_common); // master bid vendor update stastus
              if($query_bid_master_vendor){
                $this->session->set_flashdata('success_message', 'Successfull Bid is send to vendor and Techinical community');
                redirect('user-buyer-home');
              }else{
                $this->session->set_flashdata('error_msg', 'Some Error occured Try Again !!!');
                redirect('user-buyer-home');
              }
          }else{
            $this->session->set_flashdata('error_msg', 'Some Error occured Try Again !!');
            redirect('user-buyer-home');
          }
      }else{
        $this->session->set_flashdata('error_msg', 'Some Error occured Try Again !');
        redirect('user-buyer-home');
      }
    }
    public function buyer_send_bid_tech($value=''){
      $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';
          $data=array('title' =>"Buyer List Of Bid Successfull send",'script_js'=>$scripts,'menu_status'=>'3','sub_menu'=>'3','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
          $this->load->view('template/template_header',$data);
          $this->load->view('buyer_user/template/template_top_head');
          $this->load->view('buyer_user/template/template_side_bar',$data);
          $this->load->view('buyer_user/bid_send_tech/bid_send_success_tech');
          $this->load->view('template/template_footer',$data);
      // code...
    }
    /**
     * [buyer_bid_query_tech description]
     * @param  string $value  [bid seril no of master bid table]
     * @param  [type] $value1 [materila category]
     * @return [type]         [description]
     */
    public function buyer_bid_query_tech($value='',$value1=''){
      $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';
          $data=array('title' =>"Buyer List Of Mr Received",'script_js'=>$scripts,'menu_status'=>'3','sub_menu'=>'3','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1);
          $this->load->view('template/template_header',$data);
          $this->load->view('buyer_user/template/template_top_head');
          $this->load->view('buyer_user/template/template_side_bar',$data);
          $this->load->view('buyer_user/bid_send_tech/tech_query/bid_tech_query',$data);
          $this->load->view('template/template_footer',$data);
    }
    public function buyer_bid_send_tech_view($value='',$value1=''){
      switch ($value1) {
          case '1':
              $file_path="buyer_user/bid_send_tech/send_new_tech/view_bid_mr_send/view_technical_bid_detail";
              # code...
              break;
          case '2':
              $file_path="buyer_user/bid_send_tech/send_new_tech/view_bid_mr_send/view_technical_bid_detail";
              # code...
              break;
          case '3':
              $file_path="buyer_user/bid_send_tech/send_new_tech/view_bid_mr_send/view_technical_bid_logistic_detail";
              # code...
              break;

          default:
              # code...
              break;
      }
      $scripts='<script src="'.base_url().'file_css_admin/own_js_date_picker.js"></script>';
          $data=array('title' =>"Detail Bid Information",'script_js'=>$scripts,'menu_status'=>'3','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'' ,'value'=>$value,'value1'=>$value1);
          $this->load->view('template/template_header',$data);
          $this->load->view('buyer_user/template/template_top_head');
          $this->load->view('buyer_user/template/template_side_bar',$data);
          $this->load->view("$file_path",$data);
          $this->load->view('template/template_footer',$data);
      # code...
    }
    public function buy_logout(){
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
                        $this->session->set_flashdata('success_message', 'Signout from Buyer User panel');
                        redirect('home');

                }else{

                        $user_data = array('logout_date'=>$date, 'logout_time'=>$time, 'status'=>'2');
                        $id=array('session_id'=>$session_id);
                        $user_hstory_table="master_session_history";
                        $result_history = $this->user->common_update($user_hstory_table,$user_data,$id);
                        session_destroy();
                        session_start();
                        $this->session->set_flashdata('success_message', 'Sign-out from Buyer User Panel');
                        redirect('home');
                }

    }

     public function buy_logout_bypass(){
        $this->session->set_flashdata('error_msg', 'Invalid entry to Buyer User panel');
        redirect('home');

    }

}
