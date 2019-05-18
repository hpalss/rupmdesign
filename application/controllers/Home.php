<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $model_info = $this->Estimate_forms_model->get_one_where(array("id" => 2, "status" => "active", "deleted" => 0));

        $options = array("related_to" => "estimate_form-2");
        $view_data['customFields'] = $this->Custom_fields_model->get_details($options)->result();
        if (get_setting("module_estimate_request") && $model_info->id) {
            $view_data['model_info'] = $model_info;
        }
        $this->load->view('frontend/client',$view_data);
    }
    function estimate_form_filed_list_data($id = 0) {

        $options = array("related_to" => "estimate_form-" . $id);
        $list_data = $this->Custom_fields_model->get_details($options)->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_form_field_row($data);
        }
        echo json_encode(array("data" => $result));
    }
    function estimate_request(){
            $signup_key = $this->input->post("signup_key");
    
            validate_submitted_data(array(
                "first_name" => "required",
                "last_name" => "required",
                "password" => "required",
                "title" => "required",
                "deadline" => "required",
                "category" => "required",
                "type_of_service" => "required",
                "work_type" => "required",
                "course" => "required",
                "work_level" => "required",
                "pages_words" => "required",
                "email" => "required|valid_email",
                "company_name" => "required"
            ));
            $user_data = array(
                "first_name" => $this->input->post("first_name"),
                "last_name" => $this->input->post("last_name"),
                "job_title" => "Untitled",
                "gender" => $this->input->post("gender"),
                "created_at" => get_current_utc_time()
            );
    
            $user_data = clean_data($user_data);
            if($this->input->post("password")!==$this->input->post("retype_password")){
                $this->session->set_flashdata("error_message", lang("password_dont_matched"));
                redirect('/home');
            }
            // don't clean password since there might be special characters 
            $user_data["password"] = md5($this->input->post("password"));
                //create a client directly
                if (get_setting("disable_client_signup")) {
                    show_404();
                }
    
                $email = $this->input->post("email");
                $company_name = $this->input->post("company_name");
    
           
                if ($this->Users_model->is_email_exists($email)) {
                    // echo json_encode(array("success" => false, 'message' => lang("account_already_exists_for_your_mail") . " " . anchor("signin", lang("signin"))));
                    // return false;
                    $this->session->set_flashdata("error_message", lang("account_already_exists_for_your_mail") . " " . anchor("signin", lang("signin")));
                    redirect('/home');
                }
    
                $client_data = array("company_name" => $company_name);
    
                $client_data = clean_data($client_data);
    
                //check duplicate company name, if found then show an error message
                if (get_setting("disallow_duplicate_client_company_name") == "1" && $this->Clients_model->is_duplicate_company_name($company_name)) {
                    // echo json_encode(array("success" => false, 'message' => lang("account_already_exists_for_your_company_name") . " " . anchor("signin", lang("signin"))));
                    // return false;
                    $this->session->set_flashdata("error_message", lang("account_already_exists_for_your_company_name") . " " . anchor("signin", lang("signin")));
                    redirect('/home');
                }
    
                
                //create a client
                $client_id = $this->Clients_model->save($client_data);
                if ($client_id) {
                    //client created, now create the client contact
                    $user_data["user_type"] = "client";
                    $user_data["email"] = $email;
                    $user_data["client_id"] = $client_id;
                    $user_data["is_primary_contact"] = 1;
                    $user_id = $this->Users_model->save($user_data);

                    $target_path = get_setting("timeline_file_path");
                    $files_data = move_files_from_temp_dir_to_permanent_dir($target_path, "estimate");

                    $request_data = array(
                        "title" => $this->input->post('title'),
                        "category" => $this->input->post('category'),
                        "type_of_service" => $this->input->post('type_of_service'),
                        "work_type" => $this->input->post('work_type'),
                        "course" => $this->input->post('course'),
                        "work_level" => $this->input->post('work_level'),
                        "pages_words" => $this->input->post('pages_words'),
                        "subject" => $this->input->post('subject'),
                        "description" => json_encode($this->input->post()),
                        "estimate_form_id" => 2,
                        "created_by" => $client_id,
                        "created_at" => get_current_utc_time(),
                        "deadline" => $this->input->post('deadline'),
                        "client_id" => $client_id,
                        "assigned_to" => 0,
                        "status" => "open"
                    );

                    $request_data = clean_data($request_data);

                    $request_data["files"] = $files_data; //don't clean serilized data



                    $save_id = $this->Estimate_requests_model->save($request_data);
                    // log_notification("client_signup", array("client_id" => $client_id), $user_id);
                    $options = array(
                        "estimate_request_id" => $save_id
                    );
                    log_notification("estimate_request_received", $options);
                    $password = $this->input->post("password");
                    $this->session->set_flashdata("success_message", lang('account_created') . " " . anchor("signin", lang("signin")));
                    if (!$this->Users_model->authenticate($email, $password)) {
                        redirect('/home');
                    }
                    // show_notification("estimate_request_received", $options);
                    $statusData = array("status" => "admin_replied");
                    redirect('/estimate_requests/view_estimate_request/' . $save_id);
                } else {
                    $this->session->set_flashdata("success_message", lang("error_occurred"));
                    redirect('/home');
                    // echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
                    // return false;
                }
    
            if ($user_id) {
                $this->session->set_flashdata("success_message", lang('account_created') . " " . anchor("signin", lang("signin")));
                // echo json_encode(array("success" => true, 'message' => lang('account_created') . " " . anchor("signin", lang("signin"))));
                redirect('/home');
            } else {
                $this->session->set_flashdata("success_message", lang("error_occurred"));
                redirect('/home');
                // echo json_encode(array("success" => false, 'message' => lang('error_occurred')));
            }
    }
    private function _make_form_field_row($data) {

        $required = "";
        if ($data->required) {
            $required = "*";
        }

        $field = "<label data-id='$data->id' class='field-row'>$data->title $required</label>";
        $field.="<div class='form-group'>" . $this->load->view("custom_fields/input_" . $data->field_type, array("field_info" => $data), true) . "</div>";

        //extract estimate id from related_to field. 2nd index should be the id
        $estimate_form_id = get_array_value(explode("-", $data->related_to), 1);

        return array(
            $field,
            $data->sort,
            modal_anchor(get_uri("estimate_requests/estimate_form_field_modal_form/" . $estimate_form_id), "<i class='fa fa-pencil'></i>", array("class" => "edit", "title" => lang('edit_form'), "data-post-id" => $data->id))
            . js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => lang('delete'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("estimate_requests/estimate_form_field_delete"), "data-action" => "delete"))
        );
    }

}

/* End of file Home.php */
