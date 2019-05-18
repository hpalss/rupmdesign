<li class="quick-add-option">
    <?php echo js_anchor("<i class='fa fa-plus-circle'></i>", array("id" => "quick-add-icon", "class" => "dropdown-toggle", "data-toggle" => "dropdown")); ?>

    <ul class="dropdown-menu p0 w200">
        <li>
            <?php
            //get the array of hidden menu
            $hidden_menu = explode(",", get_setting("hidden_client_menus"));
            $permissions = $this->login_user->permissions;

            if (($this->login_user->user_type == "staff" && ($this->login_user->is_admin || get_array_value($permissions, "can_manage_all_projects") == "1" || get_array_value($permissions, "can_create_tasks") == "1")) || ($this->login_user->user_type == "client" && get_setting("client_can_create_tasks"))) {

                //add tasks 
                echo modal_anchor(get_uri("projects/task_modal_form"), lang('add_task'), array("class" => "clearfix", "title" => lang('add_task')));

                //add multiple tasks
                echo modal_anchor(get_uri("projects/task_modal_form"), lang('add_multiple_tasks'), array("class" => "clearfix", "title" => lang('add_multiple_tasks'), "data-post-add_type" => "multiple"));
            }

            //add project time
            if ($this->login_user->user_type == "staff") {
                echo modal_anchor(get_uri("projects/timelog_modal_form"), lang('add_project_time'), array("class" => "clearfix", "title" => lang('add_project_time')));
            }

            //add event
            if (get_setting("module_event") == "1" || ($this->login_user->user_type == "client" && !in_array("events", $hidden_menu))) {
                echo modal_anchor(get_uri("events/modal_form"), lang('add_event'), array("class" => "clearfix", "title" => lang('add_event'), "data-post-client_id" => $this->login_user->user_type == "client" ? $this->login_user->client_id : ""));
            }

            //add note
            if (get_setting("module_note") == "1" && $this->login_user->user_type == "staff") {
                echo modal_anchor(get_uri("notes/modal_form"), lang('add_note'), array("class" => "clearfix", "title" => lang('add_note')));
            }

            //add todo
            if (get_setting("module_todo") == "1") {
                echo modal_anchor(get_uri("todo/modal_form"), lang("add_to_do"), array("class" => "clearfix", "title" => lang('add_to_do')));
            }

            //add ticket
            if (get_setting("module_ticket") == "1" && ($this->login_user->is_admin || get_array_value($permissions, "ticket"))) {
                echo modal_anchor(get_uri("tickets/modal_form"), lang('add_ticket'), array("class" => "clearfix", "title" => lang('add_ticket')));
            }
            ?>
        </li>
    </ul>
</li>