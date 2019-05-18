<div class="modal-body clearfix">		
        <?php echo form_open(get_uri("bidding/ask_question"), array("id" => "estimate-ask-question-form", "class" => "general-form", "role" => "form")); ?>
        <input type="hidden" name="estimate_id" value="<?php echo $estimate_id; ?>" />
		<div class="form-group">
        <div class=" col-md-12">
            <?php
            echo form_textarea(array(
                "id" => "question",
                "name" => "question",
                "value" => "",
                "class" => "form-control",
                "placeholder" => lang('your_question_here'),
                "style" => "height:80px;",
            ));
            ?>
            <button type="submit" class="btn btn-primary" style="margin-top: 10px;"><span class="fa fa-check-circle"></span> <?php echo lang('btn_ask'); ?></button>
    </div>
        </div>

    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $("#estimate-ask-question-form").appForm({
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
            }
        });
</script>