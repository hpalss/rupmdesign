<div class="modal-body clearfix">	
<?php echo form_open(get_uri("estimate_requests/client_action_on_estimate"), array("class" => "general-form", "role" => "form")); ?>
            <input type="hidden" name="estimate_id" value="<?php echo $estimate_id; ?>" />
            <input type="hidden" name="status" value="<?php echo $status; ?>" />
            <input type="hidden" name="bidId" value="<?php echo $bidId; ?>" />
            <?php 
                $prefix = $this->login_user->user_type=="client" ? "client_":"admin_";
             ?>
            <?php if ($status=='canceled'): ?>
                <div class="radio status-notes">
                    <label>
                        <input type="radio" value="canceled_opt_1" name="notes">
                        <?=lang($prefix."canceled_opt_1"); ?>
                    </label>
                </div>
                <div class="radio status-notes">
                    <label>
                        <input type="radio" value="canceled_opt_2" name="notes">
                        <?=lang($prefix."canceled_opt_2"); ?>
                    </label>
                </div>
                <div class="radio status-notes">
                    <label>
                        <input type="radio" value="canceled_opt_3" name="notes">
                        <?=lang($prefix."canceled_opt_3"); ?>
                    </label>
                </div>
            <?php elseif($status=='rejected'): ?>
                <div class="radio status-notes">
                    <label>
                        <input type="radio" value="reject_opt_1" name="notes">
                        <?=lang("reject_opt_1"); ?>
                    </label>
                </div>
                <div class="radio status-notes">
                    <label>
                        <input type="radio" value="reject_opt_2" name="notes">
                        <?=lang("reject_opt_2"); ?>
                    </label>
                </div>
                <div class="radio status-notes">
                    <label>
                        <input type="radio" value="reject_opt_3" name="notes">
                        <?=lang("reject_opt_3"); ?>
                    </label>
                </div>
                <div class="radio status-notes">
                    <label>
                        <input type="radio" value="reject_opt_4" name="notes">
                        <?=lang("reject_opt_4"); ?>
                    </label>
                </div>
                <div class="radio status-notes">
                    <label>
                        <input type="radio" value="reject_opt_5" name="notes">
                        <?=lang("reject_opt_5"); ?>
                    </label>
                </div>
                <div class="radio status-notes">
                    <label>
                        <input type="radio" value="reject_opt_6" name="notes">
                        <?=lang("reject_opt_6"); ?>
                    </label>
                </div>
            <?php else: ?>
            <div class="form-group">
                <div class=" col-md-12">
                    <?php
                    echo form_textarea(array(
                        "id" => "notesOnStatus",
                        "name" => "notes",
                        "value" => "",
                        "class" => "form-control status-notes",
                        "placeholder" => lang('notes'),
                        "style" => "height:80px;",
                    ));
                    ?>
                </div>
            </div>
            <?php endif ?>
                    <button type="submit" disabled="true" id="status-submit" class="btn btn-primary" style="margin-top: 10px;"><span class="fa fa-check-circle"></span> <?php echo lang('btn_submit'); ?></button>
        <?php echo form_close(); ?>
 </div>
 <script>
    $(document).on('click', '.status-notes', function(event) {
        $('#status-submit').attr('disabled', false);
    });
 	$(document).on('click', '#status-submit', function(event) {
 		event.preventDefault();
	        appLoader.show();
            var statusChosen = "<?= $status; ?>";
            var notes = $("#notesOnStatus").val();
            if (statusChosen=="rejected" || statusChosen=="canceled") {
                notes = $("input[name='notes']:checked").val();
            }
	        $.ajax({
	            url: "<?=get_uri("estimate_requests/client_action_on_estimate/")?>",
	            type: 'POST',
	            dataType: 'json',
	            data: {notes:notes,id: "<?php echo $bidId; ?>",estimate_id:"<?php echo $estimate_id; ?>",status:statusChosen},
	        })
	        .always(function(response) {
	            appLoader.hide();
	            if (response.success) {
	                appAlert.success(response.message, {duration: 10000});
	                if(statusChosen=="confirm"){
                        createProject(response.estimate);
                    }else{
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    }
	            } else {
	                appAlert.error(response.message, {duration: 10000});
	            }
	        });
 	});
    function createProject(estimateData) {
        var price = $("#total-project-amount").text();
        var desc = $.parseJSON(estimateData.description);
        var custom_field_3 = desc.work_type !=undefined?desc.work_type:"";
        var custom_field_4 = desc.work_level !=undefined?desc.work_level:"";
        var custom_field_5 = desc.type_of_service !=undefined?desc.type_of_service:"";
        var custom_field_6 = desc.required_language !=undefined?desc.required_language:"";
        var custom_field_11 = desc.course !=undefined?desc.course:"";
        var custom_field_8 = desc.pages_words !=undefined?desc.pages_words:"";
        var custom_field_9 = desc.subject !=undefined?desc.subject:"";
        var postData = {
            id:"",
            estimate_id: estimateData.id,
            title: estimateData.title,
            client_id: estimateData.client_id,
            description: custom_field_6+"<br>"+custom_field_8+"<br>"+custom_field_3+"<br>"+custom_field_4+"<br>"+custom_field_5+"<br>"+custom_field_11+"<br>"+custom_field_9+"<br>"+estimateData.category,
            start_date: moment().format("YYYY-MM-DD HH:mm:ss"),
            deadline: estimateData.deadline,
            price: price,
            labels: estimateData.status
        };
        $.ajax({
            url: "<?=get_uri("projects/save")?>",
            type: 'POST',
            dataType: 'json',
            data: postData,
        })
        .always(function(result) {
            if (result.id>0) {
                window.location = "<?php echo site_url('projects/view'); ?>/" + result.id;
            }else{
                appAlert.error(response.message, {duration: 10000});
            }
        });
    }

 </script>