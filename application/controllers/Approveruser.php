<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approveruser extends CI_Controller {
    public function __construct(){
            parent::__construct();
            // Loading my model which will use
            $this->load->model('user_model', 'user'); 
            $this->load->model('approver_model', 'approver_user');
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
            $data=array('title' =>"Approver User Dashboard",'script_js'=>$scripts,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');
            $this->load->view('template/template_header',$data);
            $this->load->view('approver_user/template/template_top_head');
            $this->load->view('approver_user/template/template_side_bar',$data);
            $this->load->view('approver_user/user_dashboard');
            $this->load->view('template/template_footer',$data);
        # code...
    }
    public function approver_new_mr_receive($value=''){
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

        $data=array('title' =>"Material Requisition Receive list",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'1','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('approver_user/template/template_top_head');
            $this->load->view('approver_user/template/template_side_bar',$data);
            $this->load->view('approver_user/receive_material_requisition/view_receive_mr_list');
            $this->load->view('template/template_footer',$data);
    }
    public function design_new_mr_order_receive_view($value,$value1,$value2){
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
            $this->load->view('approver_user/template/template_top_head');
            $this->load->view('approver_user/template/template_side_bar',$data);
            $this->load->view('approver_user/receive_material_requisition/view_detail_submitted_mr/'.$view_page,$data);
            $this->load->view('template/template_footer',$data);
    }

     public function approver_file_upload_data($value=''){
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
    public function approve_item_required_session_ids(){
         
        $actions_file=$this->input->post('actions_file');
        $Mr_no=$this->input->post('Mr_no');
        $slno_Mr_no=$this->input->post('slno_Mr_no');

        if(!empty($this->input->post('action'))) {
            switch ($this->input->post('action')) {
                case 'add':
                $_SESSION["cart_item_tech"]= $_SESSION["cart_item"]= array();
                           
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
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input disabled class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input disabled checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                           
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
                case 'add_comment': 
                         $_SESSION["cart_item_tech"]= $_SESSION["cart_item"]= array();
                           
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
                                        <th><strong>Comments</strong></th>
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
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input disabled class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input disabled checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                           
                                        ?></td>
                                       <td><strong style="color: red"><?=$item['comment_details_item']?></strong></td>
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
                       $_SESSION["cart_item_tech"]=$_SESSION["cart_item"]= array();

                         $query_item_details_list=$this->design_user->get_design_master_mr_items_material_single($actions_file,$Mr_no,$slno_Mr_no);
                         // print_r($query_item_details_list);
                         if($query_item_details_list['no_item']==1){
                            foreach ($query_item_details_list['item_list'] as $key_item => $value_item) {
                                $code=$value_item->material_item_id;
                                $material_quantity=$value_item->material_quantity;
                                $slno_item_mr=$value_item->slno_item_mr;

                                $query_item_details=$this->design_user->get_design_master_items_material_single($code);
                        // print_r($query_item_details);
                                $itemArray = array($code=>array('name'=>$query_item_details['materials_list'][0]->item_name, 'item_id'=>$query_item_details['materials_list'][0]->item_id, 'quantity'=>$material_quantity, 'item_uom'=>$query_item_details['materials_list'][0]->item_uom ,'code'=>$code,'slno_item_mr'=>$slno_item_mr));
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
                                        <th><strong>Comments</strong></th>
                                        
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
                                               echo '<label class="checkbox-inline"><input disabled type="checkbox" name="technical_mr['.$id.']['.$item['code'].'][]" value="a"  checked>No Technical is added To this material</label>';
                                            }else{
                                                foreach ( $result_technical['technical_list'] as $value_technical) {
                                                    if(empty($cart_item_tech_sess)){
                                                        
                                                       
                                                            echo '<label class="checkbox-inline"><input disabled class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                      
                                                    }else{
                                                         $pos = array_search($value_technical->Slno_technical, $cart_item_tech_sess);
                                                        // foreach ($cart_item_tech_sess as $value) {
                                                            if( $cart_item_tech_sess[$pos]==$value_technical->Slno_technical){
                                                               echo '<label class="checkbox-inline"><input disabled checked class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }else{
                                                                echo '<label class="checkbox-inline"><input disabled class="attribute" type="checkbox" id="technical_mr_'.$id.$value_technical->Slno_technical.'" name="technical_mr['.$id.']['.$item['code'].'][]" value="'.$value_technical->Slno_technical.'" onclick="get_value_check(this.id)" >'.$value_technical->technical_name.'</label>';
                                                           }
                                                        
                                                    }

                                            }
                                        }
                                           
                                        ?></td>
                                        <td><textarea  name="comment[<?=$id?>]" class='text_areas' id='comment<?=$id?>'></textarea>
                                            <input type="hidden" name="slno_item_mr[<?=$id?>]" value="<?=$item['slno_item_mr']?>">
                                        </td>
                                      
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
                            $slno_mr_logistic=$key_value_vechile->slno_mr_logistic;
                            $get_location_from=$this->design_user->get_design_master_loaction_list($from_location_slno_single); // from location information will come out

                            $get_location_to=$this->design_user->get_design_master_loaction_list($to_location_slno_single); // to location information will come out
                            $query_item_details=$this->design_user->get_design_master_vehcile_list($code);
                              $itemArray = array($code=>array('vehicle_type'=>$query_item_details['item_vehcile'][0]->vehicle_type, 'vehicle_capacity'=>$query_item_details['item_vehcile'][0]->vehicle_capacity, 'quantity'=>$no_vehcile_single, 'code'=>$code,'vehicle_desc'=>$query_item_details['item_vehcile'][0]->vehicle_desc,'purpose'=>$purpose_info_single,'location_from'=>$get_location_from['item_location'][0]->location_name,'location_from_id'=>$get_location_from['item_location'][0]->slno_loc,'location_to'=>$get_location_to['item_location'][0]->location_name,'location_to_id'=>$get_location_to['item_location'][0]->slno_loc,'slno_mr_logistic'=>$slno_mr_logistic) );
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
                                        <td><textarea  name="comment[<?=$id?>]" class='text_areas' id='comment<?=$id?>'></textarea>
                                            <input type="hidden" name="slno_mr_logistic[<?=$id?>]" value="<?=$item['slno_mr_logistic']?>">
                                        </td>
                                      
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
                case 'add_vechile_view_approve': // only approved
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
                            $slno_mr_logistic=$key_value_vechile->slno_mr_logistic;
                            $get_location_from=$this->design_user->get_design_master_loaction_list($from_location_slno_single); // from location information will come out

                            $get_location_to=$this->design_user->get_design_master_loaction_list($to_location_slno_single); // to location information will come out
                            $query_item_details=$this->design_user->get_design_master_vehcile_list($code);
                              $itemArray = array($code=>array('vehicle_type'=>$query_item_details['item_vehcile'][0]->vehicle_type, 'vehicle_capacity'=>$query_item_details['item_vehcile'][0]->vehicle_capacity, 'quantity'=>$no_vehcile_single, 'code'=>$code,'vehicle_desc'=>$query_item_details['item_vehcile'][0]->vehicle_desc,'purpose'=>$purpose_info_single,'location_from'=>$get_location_from['item_location'][0]->location_name,'location_from_id'=>$get_location_from['item_location'][0]->slno_loc,'location_to'=>$get_location_to['item_location'][0]->location_name,'location_to_id'=>$get_location_to['item_location'][0]->slno_loc,'slno_mr_logistic'=>$slno_mr_logistic) );
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
                case 'add_vechile_view_comment': // only approved
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
                            $comment_details_vechile=$key_value_vechile->comment_details_vechile;
                            $slno_mr_logistic=$key_value_vechile->slno_mr_logistic;
                            $get_location_from=$this->design_user->get_design_master_loaction_list($from_location_slno_single); // from location information will come out

                            $get_location_to=$this->design_user->get_design_master_loaction_list($to_location_slno_single); // to location information will come out
                            $query_item_details=$this->design_user->get_design_master_vehcile_list($code);
                              $itemArray = array($code=>array('vehicle_type'=>$query_item_details['item_vehcile'][0]->vehicle_type, 'vehicle_capacity'=>$query_item_details['item_vehcile'][0]->vehicle_capacity, 'quantity'=>$no_vehcile_single, 'code'=>$code,'vehicle_desc'=>$query_item_details['item_vehcile'][0]->vehicle_desc,'purpose'=>$purpose_info_single,'location_from'=>$get_location_from['item_location'][0]->location_name,'location_from_id'=>$get_location_from['item_location'][0]->slno_loc,'location_to'=>$get_location_to['item_location'][0]->location_name,'location_to_id'=>$get_location_to['item_location'][0]->slno_loc,'slno_mr_logistic'=>$slno_mr_logistic,'comment_details_vechile'=>$comment_details_vechile) );
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
                                        <td><strong style="color: red"><?=$item['comment_details_vechile']?></strong></td>
                                        
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
    public function approver_add_new_mr_save_formII(){
        // print_r($this->input->post());
        // exit();
        $materials_id=$this->input->post('materials_id');
        $Mr_no=$this->input->post('Mr_no');
        $slno_Mr_no=$this->input->post('slno_Mr_no');
        $edit_id=$this->input->post('edit_id');
        $resubmit_count=$this->input->post('resubmit_count');
        $status_mr=$this->input->post('status_mr');
        $type_action=$this->input->post('type_action');
        $value1=$this->input->post('value1');
        $result_mr=$this->approver_user->get_approver_mr_job_detail($slno_Mr_no);
        $date=date('Y-m-d');
        if($result_mr['no_mr_deatils']==1){
            if($value1==$materials_id){
                $mr_details=$result_mr['mr_details'][0];
                $creators_id=$mr_details->creators_id;
              
                $Mr_id=$mr_details->mr_no;
                $Slno_mr_id=$slno_Mr_no;
                $Edit=$mr_details->edit_id;
                $Creator_id_sender=$mr_details->approver_id;
                $Approve_id=$this->session->userdata('approver_email_id');
                $job_code_id=$mr_details->job_code_id;
                $techinal_evalution=$mr_details->techinal_evalution;
                $approver_id_slno=$mr_details->approver_id_slno;

                switch ($materials_id) {
                    case '1': //Sci



                        if($type_action==1){ // Send information to Procurement officer
                            $Procurement=$this->input->post('Procurement');
                            $result_procuremnet=$this->approver_user->get_approver_procurement_list($Procurement);
                            $proc_details=$result_procuremnet['user_approver'][0];
                            $Procurement_id=$proc_details->email_id;
                            $Procurement_name=$proc_details->Username;
                            $mr_forword_status=1;
                            $data_apporved = array('Mr_id'=>$Mr_id, 'Slno_MR_id'=>$Slno_mr_id, 'Job_code'=>$job_code_id, 'Slno_approver_id'=>$approver_id_slno, 'Procurement_id'=>$Procurement_id,'Procurement_name'=>$Procurement_name, 'Date_process'=>$date, 'Status'=>1, 'Forward_status'=>2, 'Material_id'=>$materials_id, 'Edit_id'=>$Edit, 'Technical_type'=>$techinal_evalution);
                             $query_approved= $this->db->insert('master_procurement_MR',$data_apporved);
                            if($query_approved){
                                $data_apporved_info = array('Mr_id'=>$Mr_id, 'Slno_mr_id'=>$Slno_mr_id, 'Job_code'=>$job_code_id, 'Approver_id'=>$Approve_id, 'Procurement_id'=>$Procurement_id, 'Date_approver'=>$date, 'Status'=>1, 'Forward_status'=>2, 'Material_id'=>$materials_id, 'Edit_id'=>$Edit);
                                 $query_approved_info= $this->db->insert('master_mr_approver_order',$data_apporved_info);
                                $id_array_mr=array('slno_mr' =>$slno_Mr_no); // mr slno which will able to update
                                $data_mr = array('mr_forword_status' =>1 , 'mr_forword_date'=>$date); // mr data to be update
                                $this->db->update('master_mr_job_details',$data_mr,$id_array_mr);
                                
                                $this->session->set_flashdata('success_message', ' Successfully Send To Procuremnet User ');
                                redirect('user-approver-home');
                                exit();
                            }else{
                                 $this->session->set_flashdata('error_message', ' Something went wrong ');
                                redirect('user-approver-home');
                                exit();
                            }

                        }else if($type_action==2){ // send comment information to design user
                            $comment=$this->input->post('comment');
                            $slno_item_mr=$this->input->post('slno_item_mr');
                            foreach ($comment as $key_comment => $value_comment) { // forloop start her about comment id
                                
                                if(!empty(trim($value_comment))){
                                   $slno_item_mr_single=$slno_item_mr[$key_comment];
                                   $comment_array = array('comment_details_item' =>$value_comment);
                                   $id_array = array('slno_item_mr' =>$slno_item_mr_single);
                                   $this->db->update('master_mr_material_item',$comment_array,$id_array);
                                  echo  $str = $this->db->last_query();
                               } // here check where there is white spaces in side it
                            } // forloop end here
                            $mr_details=$result_mr['mr_details'][0];
                            $status=6;
                            $status_resubmit=1;
                            $resubmit_count=$mr_details->resubmit_count+1; // it will help user to count  how many time this mr is be 
                            $id_array_mr=array('slno_mr' =>$slno_Mr_no); // mr slno which will able to update
                            $data_mr = array('status' =>$status , 'status_resubmit'=>$status_resubmit,'resubmit_count'=>$resubmit_count); // mr data to be update
                            $this->db->update('master_mr_job_details',$data_mr,$id_array_mr);

                            $data_comment=  array('Mr_id'=>$Mr_id, 'Slno_mr_id'=>$Slno_mr_id, 'Edit'=>$Edit, 'Resubmitted_id'=>$resubmit_count, 'Date_resubmit'=>$date, 'Creator_id_sender'=>$creators_id, 'Approve_id'=>$Approve_id);
                            $query_comment= $this->db->insert('master_mr_job_comments',$data_comment);
                            if($query_comment){
                                $this->session->set_flashdata('success_message', ' Successfully Comment ');
                                redirect('user-approver-home');
                                exit();
                            }else{
                                 $this->session->set_flashdata('error_message', ' Something went wrong ');
                                redirect('user-approver-home');
                                exit();
                            }

                        }else{ //not go to anywhere it will redirect to dashboard
                            $this->session->set_flashdata('error_message', ' Something went wrong ');
                            redirect('user-approver-home');
                            exit();
                        }
                        break;
                    case '2': //Moi
                        if($type_action==1){ // Send information to Procurement officer
                            $Procurement=$this->input->post('Procurement');
                            $result_procuremnet=$this->approver_user->get_approver_procurement_list($Procurement);
                            $proc_details=$result_procuremnet['user_approver'][0];
                            $Procurement_id=$proc_details->email_id;
                            $Procurement_name=$proc_details->Username;
                            $mr_forword_status=1;
                            $data_apporved = array('Mr_id'=>$Mr_id, 'Slno_MR_id'=>$Slno_mr_id, 'Job_code'=>$job_code_id, 'Slno_approver_id'=>$approver_id_slno, 'Procurement_id'=>$Procurement_id,'Procurement_name'=>$Procurement_name, 'Date_process'=>$date, 'Status'=>1, 'Forward_status'=>2, 'Material_id'=>$materials_id, 'Edit_id'=>$Edit, 'Technical_type'=>$techinal_evalution);
                             $query_approved= $this->db->insert('master_procurement_MR',$data_apporved);
                            if($query_approved){
                                $data_apporved_info = array('Mr_id'=>$Mr_id, 'Slno_mr_id'=>$Slno_mr_id, 'Job_code'=>$job_code_id, 'Approver_id'=>$Approve_id, 'Procurement_id'=>$Procurement_id, 'Date_approver'=>$date, 'Status'=>1, 'Forward_status'=>2, 'Material_id'=>$materials_id, 'Edit_id'=>$Edit);
                                 $query_approved_info= $this->db->insert('master_mr_approver_order',$data_apporved_info);

                                $id_array_mr=array('slno_mr' =>$slno_Mr_no); // mr slno which will able to update
                                $data_mr = array('mr_forword_status' =>1 , 'mr_forword_date'=>$date); // mr data to be update
                                 $this->db->update('master_mr_job_details',$data_mr,$id_array_mr);

                                $this->session->set_flashdata('success_message', ' Successfully Send To Procuremnet User ');
                                redirect('user-approver-home');
                                exit();
                            }else{
                                 $this->session->set_flashdata('error_message', ' Something went wrong ');
                                redirect('user-approver-home');
                                exit();
                            }


                        }else if($type_action==2){ // send comment information to design user
                            $comment=$this->input->post('comment');
                            $slno_item_mr=$this->input->post('slno_item_mr');
                            foreach ($comment as $key_comment => $value_comment) {
                                
                                if(!empty(trim($value_comment))){
                                   $slno_item_mr_single=$slno_item_mr[$key_comment];
                                   $comment_array = array('comment_details_item' =>$value_comment);
                                   $id_array = array('slno_item_mr' =>$slno_item_mr_single);
                                    $this->db->update('master_mr_material_item',$comment_array,$id_array);
                                 
                               }
                            }
                            $mr_details=$result_mr['mr_details'][0];
                            $status=6;
                            $status_resubmit=1;
                            $resubmit_count=$mr_details->resubmit_count+1; // it will help user to count  how many time this mr is be 
                            $id_array_mr=array('slno_mr' =>$slno_Mr_no); // mr slno which will able to update
                            $data_mr = array('status' =>$status , 'status_resubmit'=>$status_resubmit,'resubmit_count'=>$resubmit_count); // mr data to be update
                            $this->db->update('master_mr_job_details',$data_mr,$id_array_mr);

                            $data_comment=  array('Mr_id'=>$Mr_id, 'Slno_mr_id'=>$Slno_mr_id, 'Edit'=>$Edit, 'Resubmitted_id'=>$resubmit_count, 'Date_resubmit'=>$date, 'Creator_id_sender'=>$creators_id, 'Approve_id'=>$Approve_id);
                            $query_comment= $this->db->insert('master_mr_job_comments',$data_comment);
                            if($query_comment){
                                $this->session->set_flashdata('success_message', ' Successfully Comment ');
                                redirect('user-approver-home');
                                exit();
                            }else{
                                 $this->session->set_flashdata('error_message', ' Something went wrong ');
                                redirect('user-approver-home');
                                exit();
                            }

                            
                        }else{ //not go to anywhere it will redirect to dashboard
                           $this->session->set_flashdata('error_message', ' Something went wrong ');
                            redirect('user-approver-home'); 
                            exit();
                        }
                        break;
                    case '3': //Logistics
                        if($type_action==1){ // Send information to Procurement officer
                             $Procurement=$this->input->post('Procurement');
                            $result_procuremnet=$this->approver_user->get_approver_procurement_list($Procurement);
                            $proc_details=$result_procuremnet['user_approver'][0];
                            $Procurement_id=$proc_details->email_id;
                            $Procurement_name=$proc_details->Username;
                            $mr_forword_status=1;
                            $data_apporved = array('Mr_id'=>$Mr_id, 'Slno_MR_id'=>$Slno_mr_id, 'Job_code'=>$job_code_id, 'Slno_approver_id'=>$approver_id_slno, 'Procurement_id'=>$Procurement_id,'Procurement_name'=>$Procurement_name, 'Date_process'=>$date, 'Status'=>1, 'Forward_status'=>2, 'Material_id'=>$materials_id, 'Edit_id'=>$Edit, 'Technical_type'=>$techinal_evalution);
                             $query_approved= $this->db->insert('master_procurement_MR',$data_apporved);
                            if($query_approved){
                                $data_apporved_info = array('Mr_id'=>$Mr_id, 'Slno_mr_id'=>$Slno_mr_id, 'Job_code'=>$job_code_id, 'Approver_id'=>$Approve_id, 'Procurement_id'=>$Procurement_id, 'Date_approver'=>$date, 'Status'=>1, 'Forward_status'=>2, 'Material_id'=>$materials_id, 'Edit_id'=>$Edit);
                                 $query_approved_info= $this->db->insert('master_mr_approver_order',$data_apporved_info);

                                $id_array_mr=array('slno_mr' =>$slno_Mr_no); // mr slno which will able to update
                                $data_mr = array('mr_forword_status' =>1 , 'mr_forword_date'=>$date); // mr data to be update
                                 $this->db->update('master_mr_job_details',$data_mr,$id_array_mr);

                                $this->session->set_flashdata('success_message', ' Successfully Send To Procuremnet User ');
                                redirect('user-approver-home');
                                exit();
                            }else{
                                 $this->session->set_flashdata('error_message', ' Something went wrong ');
                                redirect('user-approver-home');
                                exit();
                            }


                        }else if($type_action==2){ // send comment information to design user
                            $comment=$this->input->post('comment');
                            $slno_mr_logistic=$this->input->post('slno_mr_logistic');
                            foreach ($comment as $key_comment => $value_comment) {
                                
                                if(!empty(trim($value_comment))){
                                   $slno_item_mr_single=$slno_mr_logistic[$key_comment];
                                   $comment_array = array('comment_details_vechile' =>$value_comment);
                                   $id_array = array('slno_mr_logistic' =>$slno_item_mr_single);
                                    $this->db->update('master_mr_vehicle_mr_detail',$comment_array,$id_array);
                                 
                               }
                            }
                            $mr_details=$result_mr['mr_details'][0];
                            $status=6;
                            $status_resubmit=1;
                            $resubmit_count=$mr_details->resubmit_count+1; // it will help user to count  how many time this mr is be 
                            $id_array_mr=array('slno_mr' =>$slno_Mr_no); // mr slno which will able to update
                            $data_mr = array('status' =>$status , 'status_resubmit'=>$status_resubmit,'resubmit_count'=>$resubmit_count); // mr data to be update
                            $this->db->update('master_mr_job_details',$data_mr,$id_array_mr);

                            $data_comment=  array('Mr_id'=>$Mr_id, 'Slno_mr_id'=>$Slno_mr_id, 'Edit'=>$Edit, 'Resubmitted_id'=>$resubmit_count, 'Date_resubmit'=>$date, 'Creator_id_sender'=>$creators_id, 'Approve_id'=>$Approve_id);
                            $query_comment= $this->db->insert('master_mr_job_comments',$data_comment);
                            if($query_comment){
                                $this->session->set_flashdata('success_message', ' Successfully Comment ');
                                redirect('user-approver-home');
                                exit();
                            }else{
                                 $this->session->set_flashdata('error_message', ' Something went wrong ');
                                redirect('user-approver-home');
                                exit();
                            }

                            
                        }else{ //not go to anywhere it will redirect to dashboard
                           $this->session->set_flashdata('error_message', ' Something went wrong ');
                            redirect('user-approver-home');
                            exit(); 
                        }
                        break;
                    
                    default:
                        $this->session->set_flashdata('error_message', ' Something went wrong ');
                        redirect('user-approver-home');
                           
                        break;
                }
            }else{
                $this->session->set_flashdata('error_message', ' Something went wrong ');
                redirect('user-approver-home');
            }
        }else{
            $this->session->set_flashdata('error_message', ' Something went wrong ');
            redirect('user-approver-home');
        }       
    }
    public function approver_new_mr_conform($value=''){
         $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

        $data=array('title' =>"Material Requisition Approved list",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'2','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('approver_user/template/template_top_head');
            $this->load->view('approver_user/template/template_side_bar',$data);
            $this->load->view('approver_user/approved_material_requisition/view_approved_mr_list');
            $this->load->view('template/template_footer',$data);
    }
    public function design_new_mr_order_approved_view($value,$value1,$value2){
            switch ($value1) {
                case '1':
                    $title="View Approved detail of standard catalogued item";
                    $view_page="view_mr_order_first";
                    break;
                case '2':
                    $title="View Approved detail of make to order items";
                    $view_page="view_mr_order_second";
                    break;
                case '3':
                    $title="View Approved detail of logistics";
                    $view_page="view_mr_order_third";
                    break;
                
                default:
                    # code...
                    break;
            }
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';
            $data=array('title' =>$title,'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);    

            $this->load->view('template/template_header',$data);
            $this->load->view('approver_user/template/template_top_head');
            $this->load->view('approver_user/template/template_side_bar',$data);
            $this->load->view('approver_user/approved_material_requisition/view_detail_submitted_mr/'.$view_page,$data);
            $this->load->view('template/template_footer',$data);
    }
    public function approver_resubmission_mr_order(){
        $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';

        $data=array('title' =>"Material Requisition Commented list",'script_js'=>$scripts ,'menu_status'=>'1','sub_menu'=>'3','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'');  

            $this->load->view('template/template_header',$data);
            $this->load->view('approver_user/template/template_top_head');
            $this->load->view('approver_user/template/template_side_bar',$data);
            $this->load->view('approver_user/resubmission_material_request/view_comment_mr_list');
            $this->load->view('template/template_footer',$data);# code...
    }
    public function design_new_mr_order_Comment_view($value,$value1,$value2){
            switch ($value1) {
                case '1':
                    $title="View Comment detail of standard catalogued item";
                    $view_page="view_mr_order_first";
                    break;
                case '2':
                    $title="View Comment detail of make to order items";
                    $view_page="view_mr_order_second";
                    break;
                case '3':
                    $title="View Comment detail of logistics";
                    $view_page="view_mr_order_third";
                    break;
                
                default:
                    # code...
                    break;
            }
            $scripts='<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script><script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script><script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> <script src="'.base_url().'file_css_admin/own_js.js"></script>';
            $data=array('title' =>$title,'script_js'=>$scripts ,'menu_status'=>'','sub_menu'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','sub_menu_1'=>'','sub_menu_2'=>'','sub_menu_3'=>'','value'=>$value,'value1'=>$value1,'value2'=>$value2);    

            $this->load->view('template/template_header',$data);
            $this->load->view('approver_user/template/template_top_head');
            $this->load->view('approver_user/template/template_side_bar',$data);
            $this->load->view('approver_user/resubmission_material_request/view_detail_comment_mr/'.$view_page,$data);
            $this->load->view('template/template_footer',$data);
    }
#####################################################################################################################################
#
# Logout sction
#
######################################################################################################################################
    public function approver_logout(){
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
                        $this->session->set_flashdata('success_message', 'Signout from Approver User panel');
                        redirect('home');

                }else{

                        $user_data = array('logout_date'=>$date, 'logout_time'=>$time, 'status'=>'2');
                        $id=array('session_id'=>$session_id);
                        $user_hstory_table="master_session_history";
                        $result_history = $this->user->common_update($user_hstory_table,$user_data,$id); 
                        session_destroy();
                        session_start();                        
                        $this->session->set_flashdata('success_message', 'Sign-out from Approver User Panel');
                        redirect('home');     
                }

    }

     public function approver_logout_bypass(){
        $this->session->set_flashdata('error_msg', 'Invalid entry to Approver User panel');
        redirect('home');     
                
    }

}