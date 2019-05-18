<?php echo form_open(get_uri("settings/add_notification_settings"), array("id" => "notification-settings-form", "class" => "general-form", "role" => "form")); ?>
<div class="modal-body clearfix">
    <div class="form-group">
        <label for="title" class=" col-md-3"><strong><?php echo lang('event'); ?></strong></label>
        <div class=" col-md-9">
            <div class="form-group">
                <input type="text" value="" name="title" class="form-control"  placeholder="<?php echo lang('title'); ?>"  />    
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="enable_email" class="col-md-3"><?php echo lang('enable_email'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_checkbox("enable_email", "1", false, "id='enable_email'");
            ?>                       
        </div>
    </div>
    <div class="form-group">
        <label for="enable_web" class="col-md-3"><?php echo lang('enable_web'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_checkbox("enable_web", "1", true, "id='enable_web'");
            ?>                       
        </div>
    </div>
    <div class="form-group">
        <label for="notify_to_team" class="col-md-3"><?php echo lang('notify_to_team'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_checkbox("notify_to_team", "1", true, "id='notify_to_team'");
            ?>                       
        </div>
    </div>
    <div class="form-group">
        <label for="notify_to_team_members" class="col-md-3"><?php echo lang('notify_to_team_members'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_checkbox("notify_to_team_members", "1", true, "id='notify_to_team_members'");
            ?>                       
        </div>
    </div>
    <div class="form-group">
        <label for="notify_to_terms" class="col-md-3"><?php echo lang('notify_to_terms'); ?></label>
        <div class="col-md-9">
            <?php
            echo form_checkbox("notify_to_terms", "1", true, "id='notify_to_terms'");
            ?>                       
        </div>
    </div>

    <div class="form-group">
        <label for="notify_to" class="col-md-3"><?php echo lang('notify_to'); ?></label>
        <div class="col-md-9">
            <div class="form-group">
                <input type="text" name="category" id="inputCategory" class="form-control" value="">
            </div>
            <div class="form-group">
                <input type="text" name="term" class="form-control" value="">
            </div>
            <div class="help-block">
                possible values : client_primary_contact,client_all_contacts,leave_applicant,project_members,comment_creator,task_assignee
            </div>
        </div>
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        

    });
</script>    