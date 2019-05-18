<?php

/**
 * use this to print link location
 *
 * @param string $uri
 * @return print url
 */
if (!function_exists('echo_uri')) {

    function echo_uri($uri = "") {
        echo get_uri($uri);
    }

}

/**
 * prepare uri
 * 
 * @param string $uri
 * @return full url 
 */
if (!function_exists('get_uri')) {

    function get_uri($uri = "") {
        $ci = get_instance();
        $index_page = $ci->config->item('index_page');
        return base_url($index_page . '/' . $uri);
    }

}

/**
 * use this to print file path
 * 
 * @param string $uri
 * @return full url of the given file path
 */
if (!function_exists('get_file_uri')) {

    function get_file_uri($uri = "") {
        return base_url($uri);
    }

}

/**
 * get the url of user avatar
 * 
 * @param string $image_name
 * @return url of the avatar of given image reference
 */
if (!function_exists('get_avatar')) {

    function get_avatar($image = "") {
        if ($image === "system_bot") {
            return base_url("assets/images/avatar-bot.jpg");
        } else if ($image) {
            $file = @unserialize($image);
            if (is_array($file)) {
                return get_source_url_of_file($file, get_setting("profile_image_path") . "/", "thumbnail");
            } else {
                return base_url(get_setting("profile_image_path")) . "/" . $image;
            }
        } else {
            return base_url("assets/images/avatar.jpg");
        }
    }

}

/**
 * link the css files 
 * 
 * @param array $array
 * @return print css links
 */
if (!function_exists('load_css')) {

    function load_css(array $array) {
        $version = get_setting("app_version");

        foreach ($array as $uri) {
            echo "<link rel='stylesheet' type='text/css' href='" . base_url($uri) . "?v=$version' />";
        }
    }

}
/**
 * bidding statuses
 *
 * @param array $array
 * @return json statuses
 */
if (!function_exists('get_bid_statuses')) {

    function get_bid_statuses($json=FALSE) {
        if ($json) {
          $statuses_dropdown = array(
              array("id" => "", "text" => "- " . lang("status") . " -"),
              array("id" => "open", "text" => lang("open")),
              array("id" => "estimated", "text" => lang("estimated")),
              array("id" => "accepted", "text" => lang("accepted")),
              array("id" => "paid", "text" => lang("paid")),
              array("id" => "not_paid", "text" => lang("not_paid")),
              array("id" => "rejected", "text" => lang("rejected")),
              array("id" => "canceled", "text" => lang("canceled"))
          );
          return json_encode($statuses_dropdown);
        }else{
          $statuses_dropdown = array(
             "" => "- " . lang("status") . " -",
             "open" => lang("open"),
             "estimated" => lang("estimated"),
             "accepted" => lang("accepted"),
             "questionpaid" => lang("paid"),
             "commentnot_paid" => lang("not_paid"),
             "rejected" => lang("rejected"),
             "canceled" => lang("canceled")
          );
        return $statuses_dropdown;
        }
    }

}
if (!function_exists('get_estimate_statuses')) {

    function get_estimate_statuses($json=FALSE) {
        if ($json) {
          $statuses_dropdown = array(
              array("value" => "", "text" => "- " . lang("status") . " -"),
              array("value" => "open", "text" => lang("open")),
              array("value" => "estimated", "text" => lang("estimated")),
              array("value" => "accepted", "text" => lang("accepted")),
              array("value" => "paid", "text" => lang("paid")),
              array("value" => "not_paid", "text" => lang("not_paid")),
              array("value" => "rejected", "text" => lang("rejected")),
              array("value" => "admin_replied", "text" => lang("admin_replied")),
              array("value" => "client_question", "text" => lang("client_question")),
              array("value" => "confirm", "text" => lang("confirm")),
              array("value" => "canceled", "text" => lang("canceled"))
          );
          return json_encode($statuses_dropdown);
        }else{
          $statuses_dropdown = array(
             "" => "- " . lang("status") . " -",
             "open" => lang("open"),
             "estimated" => lang("estimated"),
             "accepted" => lang("accepted"),
             "questionpaid" => lang("paid"),
             "commentnot_paid" => lang("not_paid"),
             "rejected" => lang("rejected"),
             "canceled" => lang("canceled")
          );
        return $statuses_dropdown;
        }
    }

}

if(!function_exists("status_label")){
    function get_project_members_dropdown_list($value='')
    {
         $ci = get_instance();
         $assigned_to_dropdown = array(array("id" => "", "text" => "- " . lang("assigned_to") . " -"));
        $assigned_to_list = $ci->Users_model->get_dropdown_list(array("first_name", "last_name"), "id", array("deleted" => 0, "user_type" => "staff"));
        foreach ($assigned_to_list as $key => $value) {
            $assigned_to_dropdown[] = array("id" => $key, "text" => $value);
        }
        return json_encode($assigned_to_dropdown);
    }
}
if(!function_exists("status_label")){
    function status_label($status = "",$html=true) {
        $ci = get_instance();
        $status_class = "label-default";

        if ($status === "open") {
            $status_class = "label-open";
        } else if ($status === "canceled" || $status === "rejected") {
            $status_class = "label-disabled";
        } else if ($status === "accepted") {
            $status_class = "label-accepted";
        }else if ($status === "estimated") {
            $status_class = "label-estimated";
        }else if ($status === "discuss" || $status === "admin_replied" || $status === "client_question") {
            $status_class = "label-discuss";
        }else if ($status=="confirm") {
            $status_class = "label-info";
        }else if ($status=="send") {
            $status_class = "label-primary";
        }else if ($status === "not_paid") {
            $status_class = "label-accepted";
        }else if ($status === "paid") {
            $status_class = "label-paid";
        }else if ($status === "won") {
            $status_class = "label-won";
        }
        if($ci->login_user->is_admin && lang("admin_".$status)){
            $styledStatus = "<span class='label $status_class large'>" . lang("admin_".$status) . "</span>";
        }elseif($ci->login_user->user_type=='client'){
            $styledStatus = "<span class='label $status_class large'>" . lang("client_".$status) . "</span>";
        }else{
            $styledStatus = "<span class='label $status_class large'>" . lang($status) . "</span>";
        }
        if ($html) {
            return $styledStatus;
        } else {
            return $status;
        }
    }
}
if(!function_exists("getTaskStatusColor")){
    function getTaskStatusColor($status = "") {
        $status_color = "#000";
        if ($status == "to_do") {
            $status_color = "#F9A52D";
        } else if ($status == "done") {
            $status_color = "#00B393";
        } else if ($status == "in_progress") {
            $status_color = "#1672B9";
        }
        return $status_color;
    }
}
if (!function_exists('estimateCategories')) {

    function estimateCategories($json=FALSE) {
        if ($json) {
        $statuses_dropdown = array(
            array("id" => "","text"=>"-Categories-"),
            array("id" => "mba_marketing_category","text"=>"MBA MARKETING ΔΙΟΙΚΗΣΗ"),
            array("id" => "financial_category","text"=>"ΧΡΗΜΑΤΟΟΙΚΟΝΟΜΙΚΑ – ΛΟΓΙΣΤΙΚΑ"),
            array("id" => "information_technology_category","text"=>"ΠΛΗΡΟΦΟΡΙΚΗ"),
            array("id" => "statistics_category","text"=>"ΣΤΑΤΙΣΤΙΚΗ (SPSS, R, EVIEWS, STATA κ.α.)"),
            array("id" => "psychology_category","text"=>"ΨΥΧΟΛΟΓΙΑ"),
            array("id" => "special_treatment_category","text"=>"ΕΙΔΙΚΗ ΑΓΩΓΗ"),
            array("id" => "adult_education_category","text"=>"ΠΑΙΔΑΓΩΓΙΚΑ - ΕΚΠΑΙΔΕΥΣΗ ΕΝΗΛΙΚΩΝ"),
            array("id" => "medicine_category","text"=>"ΙΑΤΡΙΚΗ"),
            array("id" => "philology_category","text"=>"ΦΙΛΟΛΟΓΟΙ – ΦΙΛΟΣΟΦΙΑ - ΙΣΤΟΡΙΑ"),
            array("id" => "legal_category","text"=>"ΝΟΜΙΚΗ"),
            array("id" => "nursing_physiotherapy_category","text"=>"ΝΟΣΗΛΕΥΤΙΚΗ - ΦΥΣΙΚΟΘΕΡΑΠΕΙΑ"),
            array("id" => "shipping_category","text"=>"ΝΑΥΤΙΛΙΑΚΑ"),
            array("id" => "civil_engineers_category","text"=>"ΠΟΛΙΤΙΚΟΙ ΜΗΧΑΝΙΚΟΙ"),
            array("id" => "environment_geoponia_category","text"=>"ΠΕΡΙΒΑΛΛΟΝ – ΓΕΩΠΟΝΙΑ"),
            array("id" => "political_officials_category","text"=>"ΠΟΛΙΤΙΚΕΣ ΕΠΙΣΗΜΕΣ - ΚΟΙΝΩΝΙΟΛΟΓΙΑ"),
            array("id" => "biology_category","text"=>"ΒΙΟΛΟΓΙΑ"),
            array("id" => "math_phy_chem_category","text"=>"ΜΑΘΗΜΑΤΙΚΑ - ΦΥΣΙΚΗ – ΧΗΜΕΙΑ"),
            array("id" => "translations_category","text"=>"ΜΕΤΑΦΡΑΣΕΙΣ"),
            array("id" => "other_category","text"=>"ΛΟΙΠΕΣ ΕΡΓΑΣΙΕΣ")
        );
        return json_encode($statuses_dropdown);
        }else{
            $statuses_dropdown = array(
            ""=>"-Categories-",
            "mba_marketing_category"=>"MBA MARKETING ΔΙΟΙΚΗΣΗ",
            "financial_category"=>"ΧΡΗΜΑΤΟΟΙΚΟΝΟΜΙΚΑ – ΛΟΓΙΣΤΙΚΑ",
            "information_technology_category"=>"ΠΛΗΡΟΦΟΡΙΚΗ",
            "statistics_category"=>"ΣΤΑΤΙΣΤΙΚΗ (SPSS, R, EVIEWS, STATA κ.α.)",
            "psychology_category"=>"ΨΥΧΟΛΟΓΙΑ",
            "special_treatment_category"=>"ΕΙΔΙΚΗ ΑΓΩΓΗ",
            "adult_education_category"=>"ΠΑΙΔΑΓΩΓΙΚΑ - ΕΚΠΑΙΔΕΥΣΗ ΕΝΗΛΙΚΩΝ",
            "medicine_category"=>"ΙΑΤΡΙΚΗ",
            "philology_category"=>"ΦΙΛΟΛΟΓΟΙ – ΦΙΛΟΣΟΦΙΑ - ΙΣΤΟΡΙΑ",
            "legal_category"=>"ΝΟΜΙΚΗ",
            "nursing_physiotherapy_category"=>"ΝΟΣΗΛΕΥΤΙΚΗ - ΦΥΣΙΚΟΘΕΡΑΠΕΙΑ",
            "shipping_category"=>"ΝΑΥΤΙΛΙΑΚΑ",
            "civil_engineers_category"=>"ΠΟΛΙΤΙΚΟΙ ΜΗΧΑΝΙΚΟΙ",
            "environment_geoponia_category"=>"ΠΕΡΙΒΑΛΛΟΝ – ΓΕΩΠΟΝΙΑ",
            "political_officials_category"=>"ΠΟΛΙΤΙΚΕΣ ΕΠΙΣΗΜΕΣ - ΚΟΙΝΩΝΙΟΛΟΓΙΑ",
            "biology_category"=>"ΒΙΟΛΟΓΙΑ",
            "math_phy_chem_category"=>"ΜΑΘΗΜΑΤΙΚΑ - ΦΥΣΙΚΗ – ΧΗΜΕΙΑ",
            "translations_category"=>"ΜΕΤΑΦΡΑΣΕΙΣ",
            "other_category"=>"ΛΟΙΠΕΣ ΕΡΓΑΣΙΕΣ"
        );
        return $statuses_dropdown;
        }
    }

}


if (!function_exists('estimate_title')) {
    function estimate_title($data){
        $ci = get_instance();
        $title = $data->title ? $data->title : lang("estimate_request") . "-" . $data->id;
        if ($r = $ci->Estimate_requests_model->getUnAnsQuestion($data->id)) {
            $title = $title."  <i class='fa fa-envelope text-danger'></i>";
        }
        if ($ci->login_user->is_admin && $data->status=="client_question") {
            $title = $title."  <i class='fa fa-comments-o text-danger'></i>";
        }elseif($data->status=="admin_replied"){
            $title = $title."  <i class='fa fa-comments-o text-success'></i>";
        }
        return anchor(get_uri("estimate_requests/view_estimate_request/" . $data->id), $title);
    }
}
/**
 * link the javascript files 
 * 
 * @param array $array
 * @return print js links
 */
if (!function_exists('load_js')) {

    function load_js(array $array) {
        $version = get_setting("app_version");

        foreach ($array as $uri) {
            echo "<script type='text/javascript'  src='" . base_url($uri) . "?v=$version'></script>";
        }
    }

}

/**
 * check the array key and return the value 
 * 
 * @param array $array
 * @return extract array value safely
 */
if (!function_exists('get_array_value')) {

    function get_array_value(array $array, $key) {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
    }

}

/**
 * prepare a anchor tag for any js request
 * 
 * @param string $title
 * @param array $attributes
 * @return html link of anchor tag
 */
if (!function_exists('js_anchor')) {

    function js_anchor($title = '', $attributes = '') {
        $title = (string) $title;
        $html_attributes = "";

        if (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                $html_attributes .= ' ' . $key . '="' . $value . '"';
            }
        }

        return '<a href="#"' . $html_attributes . '>' . $title . '</a>';
    }

}


/**
 * prepare a anchor tag for modal 
 * 
 * @param string $url
 * @param string $title
 * @param array $attributes
 * @return html link of anchor tag
 */
if (!function_exists('modal_anchor')) {

    function modal_anchor($url, $title = '', $attributes = '') {
        $attributes["data-act"] = "ajax-modal";
        if (get_array_value($attributes, "data-modal-title")) {
            $attributes["data-title"] = get_array_value($attributes, "data-modal-title");
        } else {
            $attributes["data-title"] = get_array_value($attributes, "title");
        }
        $attributes["data-action-url"] = $url;

        return js_anchor($title, $attributes);
    }

}

/**
 * prepare a anchor tag for ajax request
 * 
 * @param string $url
 * @param string $title
 * @param array $attributes
 * @return html link of anchor tag
 */
if (!function_exists('ajax_anchor')) {

    function ajax_anchor($url, $title = '', $attributes = '') {
        $attributes["data-act"] = "ajax-request";
        $attributes["data-action-url"] = $url;
        return js_anchor($title, $attributes);
    }

}

/**
 * get the selected menu 
 * 
 * @param string $url
 * @param array $submenu
 * @return string "active" indecating the active page
 */
if (!function_exists('active_menu')) {

    function active_menu($menu = "", $submenu = array()) {
        $ci = & get_instance();
        $controller_name = strtolower(get_class($ci));

        //compare with controller name. if not found, check in submenu values
        if ($menu === $controller_name) {
            return "active";
        } else if ($submenu && count($submenu)) {
            foreach ($submenu as $sub_menu) {
                if (get_array_value($sub_menu, "name") === $controller_name) {
                    return "active";
                } else if (get_array_value($sub_menu, "category") === $controller_name) {
                    return "active";
                }
            }
        }
    }

}

/**
 * get the selected submenu
 * 
 * @param string $submenu
 * @param boolean $is_controller
 * @return string "active" indecating the active sub page
 */
if (!function_exists('active_submenu')) {

    function active_submenu($submenu = "", $is_controller = false) {
        $ci = & get_instance();
        //if submenu is a controller then compare with controller name, otherwise compare with method name
        if ($is_controller && $submenu === strtolower(get_class($ci))) {
            return "active";
        } else if ($submenu === strtolower($ci->router->method)) {
            return "active";
        }
    }

}

/**
 * get the defined config value by a key
 * @param string $key
 * @return config value
 */
if (!function_exists('get_setting')) {

    function get_setting($key = "") {
        $ci = get_instance();
        return $ci->config->item($key);
    }

}



/**
 * check if a string starts with a specified sting
 * 
 * @param string $string
 * @param string $needle
 * @return true/false
 */
if (!function_exists('starts_with')) {

    function starts_with($string, $needle) {
        $string = $string;
        return $needle === "" || strrpos($string, $needle, -strlen($string)) !== false;
    }

}

/**
 * check if a string ends with a specified sting
 * 
 * @param string $string
 * @param string $needle
 * @return true/false
 */
if (!function_exists('ends_with')) {

    function ends_with($string, $needle) {
        return $needle === "" || (($temp = strlen($string) - strlen($string)) >= 0 && strpos($string, $needle, $temp) !== false);
    }

}

/**
 * create a encoded id for sequrity pupose 
 * 
 * @param string $id
 * @param string $salt
 * @return endoded value
 */
if (!function_exists('encode_id')) {

    function encode_id($id, $salt) {
        $ci = get_instance();
        $id = $ci->encryption->encrypt($id . $salt);
        $id = str_replace("=", "~", $id);
        $id = str_replace("+", "_", $id);
        $id = str_replace("/", "-", $id);
        return $id;
    }

}


/**
 * decode the id which made by encode_id()
 * 
 * @param string $id
 * @param string $salt
 * @return decoded value
 */
if (!function_exists('decode_id')) {

    function decode_id($id, $salt) {
        $ci = get_instance();
        $id = str_replace("_", "+", $id);
        $id = str_replace("~", "=", $id);
        $id = str_replace("-", "/", $id);
        $id = $ci->encryption->decrypt($id);

        if ($id && strpos($id, $salt) != false) {
            return str_replace($salt, "", $id);
        } else {
            return "";
        }
    }

}

/**
 * decode html data which submited using a encode method of encodeAjaxPostData() function
 * 
 * @param string $html
 * @return htmle
 */
if (!function_exists('decode_ajax_post_data')) {

    function decode_ajax_post_data($html) {
        $html = str_replace("~", "=", $html);
        $html = str_replace("^", "&", $html);
        return $html;
    }

}

/**
 * check if fields has any value or not. and generate a error message for null value
 * 
 * @param array $fields
 * @return throw error for bad value
 */
if (!function_exists('check_required_hidden_fields')) {

    function check_required_hidden_fields($fields = array()) {
        $has_error = false;
        foreach ($fields as $field) {
            if (!$field) {
                $has_error = true;
            }
        }
        if ($has_error) {
            echo json_encode(array("success" => false, 'message' => lang('something_went_wrong')));
            exit();
        }
    }

}

/**
 * convert simple link text to clickable link
 * @param string $text
 * @return html link
 */
if (!function_exists('link_it')) {

    function link_it($text) {
        if ($text != strip_tags($text)) {
            //contains HTML, return the actual text
            return $text;
        } else {
            return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s]?[^\s]+)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
        }
    }

}

/**
 * convert mentions to link or link text
 * @param string $text containing text with mentioned brace
 * @param string $return_type indicates what to return (link or text)
 * @return text with link or link text
 */
if (!function_exists('convert_mentions')) {

    function convert_mentions($text, $convert_links = true) {

        preg_match_all('#\@\[(.*?)\]#', $text, $matches);

        $members = array();

        $mentions = get_array_value($matches, 1);
        if ($mentions && count($mentions)) {
            foreach ($mentions as $mention) {
                $user = explode(":", $mention);
                if ($convert_links) {
                    $user_id = get_array_value($user, 1);
                    $members[] = get_team_member_profile_link($user_id, trim($user[0]));
                } else {
                    $members[] = $user[0];
                }
            }
        }

        if ($convert_links) {
            $text = nl2br(link_it($text));
        } else {
            $text = nl2br($text);
        }

        $text = preg_replace_callback('/\[[^]]+\]/', function ($matches) use (&$members) {
            return array_shift($members);
        }, $text);

        return $text;
    }

}

/**
 * get all the use_ids from comment mentions
 * @param string $text
 * @return array of user_ids
 */
if (!function_exists('get_members_from_mention')) {

    function get_members_from_mention($text) {

        preg_match_all('#\@\[(.*?)\]#', $text, $matchs);

        //find the user ids.
        $user_ids = array();
        $mentions = get_array_value($matchs, 1);

        if ($mentions && count($mentions)) {
            foreach ($mentions as $mention) {
                $user = explode(":", $mention);
                $user_id = get_array_value($user, 1);
                if ($user_id) {
                    array_push($user_ids, $user_id);
                }
            }
        }

        return $user_ids;
    }

}

/**
 * send mail
 * 
 * @param string $to
 * @param string $subject
 * @param string $message
 * @param array $optoins
 * @return true/false
 */
if (!function_exists('send_app_mail')) {

    function send_app_mail($to, $subject, $message, $optoins = array()) {
        $email_config = Array(
            'charset' => 'utf-8',
            'mailtype' => 'html'
        );

        //check mail sending method from settings
        if (get_setting("email_protocol") === "smtp") {
            $email_config["protocol"] = "smtp";
            $email_config["smtp_host"] = get_setting("email_smtp_host");
            $email_config["smtp_port"] = get_setting("email_smtp_port");
            $email_config["smtp_user"] = get_setting("email_smtp_user");
            $email_config["smtp_pass"] = get_setting("email_smtp_pass");
            $email_config["smtp_crypto"] = get_setting("email_smtp_security_type");

            if (!$email_config["smtp_crypto"]) {
                $email_config["smtp_crypto"] = "tls"; //for old clients, we have to set this by defaultsssssssss
            }

            if ($email_config["smtp_crypto"] === "none") {
                $email_config["smtp_crypto"] = "";
            }
        }

        $ci = get_instance();
        $ci->load->library('email', $email_config);
        $ci->email->clear(true); //clear previous message and attachment
        $ci->email->set_newline("\r\n");
        $ci->email->from(get_setting("email_sent_from_address"), get_setting("email_sent_from_name"));
        $ci->email->to($to);
        $ci->email->subject($subject);
        $ci->email->message($message);

        //add attachment
        $attachments = get_array_value($optoins, "attachments");
        if (is_array($attachments)) {
            foreach ($attachments as $value) {
                $file_path = get_array_value($value, "file_path");
                $file_name = get_array_value($value, "file_name");
                $ci->email->attach(trim($file_path), "attachment", $file_name);
            }
        }

        //check reply-to
        $reply_to = get_array_value($optoins, "reply_to");
        if ($reply_to) {
            $ci->email->reply_to($reply_to);
        }

        //check cc
        $cc = get_array_value($optoins, "cc");
        if ($cc) {
            $ci->email->cc($cc);
        }

        //check bcc
        $bcc = get_array_value($optoins, "bcc");
        if ($bcc) {
            $ci->email->bcc($bcc);
        }

        //send email
        if ($ci->email->send()) {
            return true;
        } else {
            //show error message in none production version
            if (ENVIRONMENT !== 'production') {
                show_error($ci->email->print_debugger());
            }
            return false;
        }
    }

}


/**
 * get users ip address
 * 
 * @return ip
 */
if (!function_exists('get_real_ip')) {

    function get_real_ip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}

/**
 * check if it's localhost
 * 
 * @return boolean
 */
if (!function_exists('is_localhost')) {

    function is_localhost() {
        $known_localhost_ip = array(
            '127.0.0.1',
            '::1'
        );
        if (in_array(get_real_ip(), $known_localhost_ip)) {
            return true;
        }
    }

}


/**
 * convert string to url
 * 
 * @param string $address
 * @return url
 */
if (!function_exists('to_url')) {

    function to_url($address = "") {
        if (strpos($address, 'http://') === false && strpos($address, 'https://') === false) {
            $address = "http://" . $address;
        }
        return $address;
    }

}

/**
 * validate post data using the codeigniter's form validation method
 * 
 * @param string $address
 * @return throw error if foind any inconsistancy
 */
if (!function_exists('validate_submitted_data')) {

    function validate_submitted_data($fields = array()) {
        $ci = get_instance();
        foreach ($fields as $field_name => $requirement) {
            $ci->form_validation->set_rules($field_name, $field_name, $requirement);
        }

        if ($ci->form_validation->run() == FALSE) {
            if (ENVIRONMENT === 'production') {
                $message = lang('something_went_wrong');
            } else {
                $message = validation_errors();
            }
            echo json_encode(array("success" => false, 'message' => $message));
            exit();
        }
    }

}


/**
 * validate post data using the codeigniter's form validation method
 * 
 * @param string $address
 * @return throw error if foind any inconsistancy
 */
if (!function_exists('validate_numeric_value')) {

    function validate_numeric_value($value = 0) {
        if ($value && !is_numeric($value)) {
            die("Invalid value");
        }
    }

}

/**
 * team members profile anchor. only clickable to team members
 * client's will see a none clickable link
 * 
 * @param string $id
 * @param string $name
 * @param array $attributes
 * @return html link
 */
if (!function_exists('get_team_member_profile_link')) {

    function get_team_member_profile_link($id = 0, $name = "", $attributes = array()) {
        $ci = get_instance();
        if ($ci->login_user->user_type === "staff") {
            return anchor("team_members/view/" . $id, $name, $attributes);
        } else {
            return js_anchor($name, $attributes);
        }
    }

}


/**
 * team members profile anchor. only clickable to team members
 * client's will see a none clickable link
 * 
 * @param string $id
 * @param string $name
 * @param array $attributes
 * @return html link
 */
if (!function_exists('get_client_contact_profile_link')) {

    function get_client_contact_profile_link($id = 0, $name = "", $attributes = array()) {
        return anchor("clients/contact_profile/" . $id, $name, $attributes);
    }

}


/**
 * return a colorful label accroding to invoice status
 * 
 * @param Object $invoice_info
 * @return html
 */
if (!function_exists('get_invoice_status_label')) {

    function get_invoice_status_label($invoice_info, $return_html = true) {
        $invoice_status_class = "label-default";
        $status = "not_paid";
        $now = get_my_local_time("Y-m-d");

        //ignore the hidden value. check only 2 decimal place.
        $invoice_info->invoice_value = floor($invoice_info->invoice_value * 100) / 100;

        if ($invoice_info->status == "cancelled") {
            $invoice_status_class = "label-danger";
            $status = "cancelled";
        } else if ($invoice_info->status != "draft" && $invoice_info->due_date < $now && $invoice_info->payment_received < $invoice_info->invoice_value) {
            $invoice_status_class = "label-danger";
            $status = "overdue";
        } else if ($invoice_info->status !== "draft" && $invoice_info->payment_received <= 0) {
            $invoice_status_class = "label-warning";
            $status = "not_paid";
        } else if ($invoice_info->payment_received * 1 && $invoice_info->payment_received >= $invoice_info->invoice_value) {
            $invoice_status_class = "label-success";
            $status = "fully_paid";
        } else if ($invoice_info->payment_received > 0 && $invoice_info->payment_received < $invoice_info->invoice_value) {
            $invoice_status_class = "label-primary";
            $status = "partially_paid";
        } else if ($invoice_info->status === "draft") {
            $invoice_status_class = "label-default";
            $status = "draft";
        }

        $invoice_status = "<span class='mt0 label $invoice_status_class large'>" . lang($status) . "</span>";
        if ($return_html) {
            return $invoice_status;
        } else {
            return $status;
        }
    }

}



/**
 * get all data to make an invoice
 * 
 * @param Int $invoice_id
 * @return array
 */
if (!function_exists('get_invoice_making_data')) {

    function get_invoice_making_data($invoice_id) {
        $ci = get_instance();
        $invoice_info = $ci->Invoices_model->get_details(array("id" => $invoice_id))->row();
        if ($invoice_info) {
            $data['invoice_info'] = $invoice_info;
            $data['client_info'] = $ci->Clients_model->get_one($data['invoice_info']->client_id);
            $data['invoice_items'] = $ci->Invoice_items_model->get_details(array("invoice_id" => $invoice_id))->result();
            $data['invoice_status_label'] = get_invoice_status_label($invoice_info);
            $data["invoice_total_summary"] = $ci->Invoices_model->get_invoice_total_summary($invoice_id);

            $data['invoice_info']->custom_fields = $ci->Custom_field_values_model->get_details(array("related_to_type" => "invoices", "show_in_invoice" => true, "related_to_id" => $invoice_id))->result();
            $data['client_info']->custom_fields = $ci->Custom_field_values_model->get_details(array("related_to_type" => "clients", "show_in_invoice" => true, "related_to_id" => $data['invoice_info']->client_id))->result();
            return $data;
        }
    }

}

/**
 * get all data to make an invoice
 * 
 * @param Invoice making data $invoice_data
 * @return array
 */
if (!function_exists('prepare_invoice_pdf')) {

    function prepare_invoice_pdf($invoice_data, $mode = "download") {
        $ci = get_instance();
        $ci->load->library('pdf');
        $ci->pdf->setPrintHeader(false);
        $ci->pdf->setPrintFooter(false);
        $ci->pdf->SetCellPadding(1.5);
        $ci->pdf->setImageScale(1.42);
        $ci->pdf->AddPage();
        $ci->pdf->SetFontSize(10);

        if ($invoice_data) {

            $invoice_data["mode"] = $mode;

            $html = $ci->load->view("invoices/invoice_pdf", $invoice_data, true);

            if ($mode != "html") {
                $ci->pdf->writeHTML($html, true, false, true, false, '');
            }

            $invoice_info = get_array_value($invoice_data, "invoice_info");
            $pdf_file_name = lang("invoice") . "-" . $invoice_info->id . ".pdf";

            if ($mode === "download") {
                $ci->pdf->Output($pdf_file_name, "D");
            } else if ($mode === "send_email") {
                $temp_download_path = getcwd() . "/" . get_setting("temp_file_path") . $pdf_file_name;
                $ci->pdf->Output($temp_download_path, "F");
                return $temp_download_path;
            } else if ($mode === "view") {
                $ci->pdf->Output($pdf_file_name, "I");
            } else if ($mode === "html") {
                return $html;
            }
        }
    }

}

/**
 * get all data to make an estimate
 * 
 * @param emtimate making data $estimate_data
 * @return array
 */
if (!function_exists('prepare_estimate_pdf')) {

    function prepare_estimate_pdf($estimate_data, $mode = "download") {
        $ci = get_instance();
        $ci->load->library('pdf');
        $ci->pdf->setPrintHeader(false);
        $ci->pdf->setPrintFooter(false);
        $ci->pdf->SetCellPadding(1.5);
        $ci->pdf->setImageScale(1.42);
        $ci->pdf->AddPage();

        if ($estimate_data) {

            $estimate_data["mode"] = $mode;

            $html = $ci->load->view("estimates/estimate_pdf", $estimate_data, true);
            if ($mode != "html") {
                $ci->pdf->writeHTML($html, true, false, true, false, '');
            }

            $estimate_info = get_array_value($estimate_data, "estimate_info");
            $pdf_file_name = lang("estimate") . "-$estimate_info->id.pdf";

            if ($mode === "download") {
                $ci->pdf->Output($pdf_file_name, "D");
            } else if ($mode === "send_email") {
                $temp_download_path = getcwd() . "/" . get_setting("temp_file_path") . $pdf_file_name;
                $ci->pdf->Output($temp_download_path, "F");
                return $temp_download_path;
            } else if ($mode === "view") {
                $ci->pdf->Output($pdf_file_name, "I");
            } else if ($mode === "html") {
                return $html;
            }
        }
    }

}

/**
 * 
 * get invoice number
 * @param Int $invoice_id
 * @return string
 */
if (!function_exists('get_invoice_id')) {

    function get_invoice_id($invoice_id) {
        $prefix = get_setting("invoice_prefix");
        $prefix = $prefix ? $prefix : strtoupper(lang("invoice")) . " #";
        return $prefix . $invoice_id;
    }

}

/**
 * 
 * get estimate number
 * @param Int $estimate_id
 * @return string
 */
if (!function_exists('get_estimate_id')) {

    function get_estimate_id($estimate_id) {
        $prefix = get_setting("estimate_prefix");
        $prefix = $prefix ? $prefix : strtoupper(lang("estimate")) . " #";
        return $prefix . $estimate_id;
    }

}

/**
 * 
 * get ticket number
 * @param Int $ticket_id
 * @return string
 */
if (!function_exists('get_ticket_id')) {

    function get_ticket_id($ticket_id) {
        $prefix = get_setting("ticket_prefix");
        $prefix = $prefix ? $prefix : lang("ticket") . " #";
        return $prefix . $ticket_id;
    }

}


/**
 * get all data to make an estimate
 * 
 * @param Int $estimate_id
 * @return array
 */
if (!function_exists('get_estimate_making_data')) {

    function get_estimate_making_data($estimate_id) {
        $ci = get_instance();
        $estimate_info = $ci->Estimates_model->get_details(array("id" => $estimate_id))->row();
        if ($estimate_info) {
            $data['estimate_info'] = $estimate_info;
            $data['client_info'] = $ci->Clients_model->get_one($data['estimate_info']->client_id);
            $data['estimate_items'] = $ci->Estimate_items_model->get_details(array("estimate_id" => $estimate_id))->result();
            $data["estimate_total_summary"] = $ci->Estimates_model->get_estimate_total_summary($estimate_id);

            $data['estimate_info']->custom_fields = $ci->Custom_field_values_model->get_details(array("related_to_type" => "estimates", "show_in_estimate" => true, "related_to_id" => $estimate_id))->result();
            return $data;
        }
    }

}


/**
 * get team members and teams select2 dropdown data list
 * 
 * @return array
 */
if (!function_exists('get_team_members_and_teams_select2_data_list')) {

    function get_team_members_and_teams_select2_data_list() {
        $ci = get_instance();

        $team_members = $ci->Users_model->get_all_where(array("deleted" => 0, "user_type" => "staff"))->result();
        $members_and_teams_dropdown = array();

        foreach ($team_members as $team_member) {
            $members_and_teams_dropdown[] = array("type" => "member", "id" => "member:" . $team_member->id, "text" => $team_member->first_name . " " . $team_member->last_name);
        }

        $team = $ci->Team_model->get_all_where(array("deleted" => 0))->result();
        foreach ($team as $team) {
            $members_and_teams_dropdown[] = array("type" => "team", "id" => "team:" . $team->id, "text" => $team->title);
        }

        return $members_and_teams_dropdown;
    }

}



/**
 * submit data for notification
 * 
 * @return array
 */
if (!function_exists('log_notification')) {

    function log_notification($event, $options = array(), $user_id = 0) {

        $ci = get_instance();

        $url = get_uri("notification_processor/create_notification");

        $req = "event=" . encode_id($event, "notification");

        if ($user_id) {
            $req .= "&user_id=" . $user_id;
        } else if ($user_id === "0") {
            $req .= "&user_id=" . $user_id; //if user id is 0 (string) we'll assume that it's system bot 
        } else if (isset($ci->login_user)) {
            $req .= "&user_id=" . $ci->login_user->id;
        }


        foreach ($options as $key => $value) {
            $value = urlencode($value);
            $req .= "&$key=$value";
        }


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);


        if (get_setting("add_useragent_to_curl")) {
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:19.0) Gecko/20100101 Firefox/19.0");
        }

        curl_exec($ch);
        curl_close($ch);
    }

}


/**
 * save custom fields for any context
 * 
 * @param Int $estimate_id
 * @return array
 */
if (!function_exists('save_custom_fields')) {

    function save_custom_fields($related_to_type, $related_to_id, $is_admin = 0, $user_type = "", $activity_log_id = 0) {
        $ci = get_instance();

        $custom_fields = $ci->Custom_fields_model->get_combined_details($related_to_type, $related_to_id, $is_admin, $user_type)->result();

        // we have to update the activity logs table according to the changes of custom fields
        $changes = array();

        //save custom fields
        foreach ($custom_fields as $field) {
            $field_name = "custom_field_" . $field->id;
            //save only submitted fields
            if (array_key_exists($field_name, $_POST)) {
                $value = $ci->input->post($field_name);

                if ($value) {
                    $field_value_data = array(
                        "related_to_type" => $related_to_type,
                        "related_to_id" => $related_to_id,
                        "custom_field_id" => $field->id,
                        "value" => $value
                    );

                    $field_value_data = clean_data($field_value_data);

                    $save_data = $ci->Custom_field_values_model->upsert($field_value_data);

                    if ($save_data) {
                        $changed_values = get_array_value($save_data, "changes");
                        $field_title = get_array_value($changed_values, "title");
                        $field_type = get_array_value($changed_values, "field_type");
                        $visible_to_admins_only = get_array_value($changed_values, "visible_to_admins_only");
                        $hide_from_clients = get_array_value($changed_values, "hide_from_clients");

                        //add changes of custom fields
                        if (get_array_value($save_data, "operation") == "update") {
                            //update
                            $changes[$field_title . "[:" . $field->id . "," . $field_type . "," . $visible_to_admins_only . "," . $hide_from_clients . ":]"] = array("from" => get_array_value($changed_values, "from"), "to" => get_array_value($changed_values, "to"));
                        } else if (get_array_value($save_data, "operation") == "insert") {
                            //insert
                            $changes[$field_title . "[:" . $field->id . "," . $field_type . "," . $visible_to_admins_only . "," . $hide_from_clients . ":]"] = array("from" => "", "to" => $value);
                        }
                    }
                }
            }
        }

        //finally save the changes to activity logs table
        return update_custom_fields_changes($related_to_type, $related_to_id, $changes, $activity_log_id);
    }

}

/**
 * update custom fields changes to activity logs table
 */
if (!function_exists('update_custom_fields_changes')) {

    function update_custom_fields_changes($related_to_type, $related_to_id, $changes, $activity_log_id = 0) {
        if ($changes && count($changes)) {
            $ci = get_instance();

            $related_to_data = new stdClass();

            $log_type = "";
            $log_for = "";
            $log_type_title = "";
            $log_for_id = "";

            if ($related_to_type == "tasks") {
                $related_to_data = $ci->Tasks_model->get_one($related_to_id);
                $log_type = "task";
                $log_for = "project";
                $log_type_title = $related_to_data->title;
                $log_for_id = $related_to_data->project_id;
            }

            $log_data = array(
                "action" => "updated",
                "log_type" => $log_type,
                "log_type_title" => $log_type_title,
                "log_type_id" => $related_to_id,
                "log_for" => $log_for,
                "log_for_id" => $log_for_id
            );


            if ($activity_log_id) {
                $before_changes = array();

                //we have to combine with the existing changes of activity logs
                $activity_log = $ci->Activity_logs_model->get_one($activity_log_id);
                $activity_logs_changes = unserialize($activity_log->changes);
                if (is_array($activity_logs_changes)) {
                    foreach ($activity_logs_changes as $key => $value) {
                        $before_changes[$key] = array("from" => get_array_value($value, "from"), "to" => get_array_value($value, "to"));
                    }
                }

                $log_data["changes"] = serialize(array_merge($before_changes, $changes));

                if ($activity_log->action != "created") {
                    $ci->Activity_logs_model->update_where($log_data, array("id" => $activity_log_id));
                }
            } else {
                $log_data["changes"] = serialize($changes);
                return $ci->Activity_logs_model->save($log_data);
            }
        }
    }

}


/**
 * use this to clean xss and html elements
 * the best practice is to use this before rendering 
 * but you can use this before saving for suitable cases
 *
 * @param string or array $data
 * @return clean $data
 */
if (!function_exists("clean_data")) {

    function clean_data($data) {
        $ci = get_instance();

        $data = $ci->security->xss_clean($data);
        $disable_html_input = get_setting("disable_html_input");

        if ($disable_html_input == "1") {
            $data = html_escape($data);
        }

        return $data;
    }

}
if (!function_exists("dd")) {

    function dd($val) {
        $ci = get_instance();
        echo "<pre>";
        print_r($val);
        echo "\n";
        print_r($ci->db->last_query());
        die;
    }

}
if (!function_exists('show_notification')) {
    function show_notification($event,$options)
    {
        $ci = get_instance();
        $user_id = $ci->login_user->id;
        $ci->load->helper('notifications');
        $notification_data = get_notification_config($event);
        $ci->Notifications_model->create_notification($event, $user_id, $options);
    }
}
if (!function_exists('send_message')) {
    function send_message($message_data,$files_data=NULL)
    {
        $ci = get_instance();
        $message_data['from_user_id'] = $ci->login_user->id;
        $message_data['created_at'] = get_current_utc_time();
        $message_data = clean_data($message_data);
        if($files_data){
            $message_data["files"] = $files_data; //don't clean serilized data
        }

        $save_id = $ci->Messages_model->save($message_data);

        if ($save_id) {
            log_notification("new_message_sent", array("actual_message_id" => $save_id));
            return $save_id;
        }
        return false;
    }
}

//return site logo
if (!function_exists("get_logo_url")) {

    function get_logo_url() {
        return get_file_from_setting("site_logo");
    }

}

//get logo from setting
if (!function_exists("get_file_from_setting")) {

    function get_file_from_setting($setting_name = "") {
        if ($setting_name) {
            $setting_value = get_setting($setting_name);
            if ($setting_value) {
                $file = @unserialize($setting_value);
                if (is_array($file)) {
                    return get_source_url_of_file($file, get_setting("system_file_path"), "thumbnail");
                } else {
                    return get_file_uri(get_setting("system_file_path") . $setting_value);
                }
            }
        }
    }

}

//get site favicon
if (!function_exists("get_favicon_url")) {

    function get_favicon_url() {
        $favicon_from_setting = get_file_from_setting('favicon');
        return $favicon_from_setting ? $favicon_from_setting : get_file_uri("assets/images/favicon.png");
    }

}
//get site favicon
if (!function_exists("is_online")) {

    function is_online($dbTime) {
        // date from the database
        $dbLastActivity = date("d-m-Y h:i:s", strtotime($dbTime));
        // date now
        $now = get_current_utc_time("d-m-Y h:i:s");

        // calculate the difference
        $difference = strtotime($now) - strtotime($dbLastActivity);
        $difference_in_minutes = $difference / 60;

        // check if difference is greater than five minutes
        if($difference_in_minutes < 6){
            return '<i class="fa fa-circle is-online-tag tag-online"></i>';
        }elseif ($difference_in_minutes > 5 && $difference_in_minutes < 60) {
            return '<i class="fa fa-circle is-online-tag text-warning"></i>';
        }else {
            return '<i class="fa fa-circle is-online-tag text-danger"></i>';
        }
    }

}
if (!function_exists("time_elapsed_string")) {

       function time_elapsed_string($datetime, $full = false) {
            $now = new DateTime;
            $ago = new DateTime($datetime);
            $diff = $now->diff($ago);   

            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;

            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }

            if (!$full) $string = array_slice($string, 0, 1);
            return $string ? implode(', ', $string) . ' ago' : 'just now';
        }

}