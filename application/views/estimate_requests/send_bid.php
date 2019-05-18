<div class="modal-body clearfix">
    <?php echo form_open(get_uri("estimate_requests/send_bid"), array("id" => "add_bid", "class" => "general-form", "role" => "form")); ?>
    <input type="hidden" name="estimate_id" value="<?php echo $estimate_id; ?>" />
    <input type="hidden" name="id" value="<?php echo $data->id; ?>" />

    <div class="form-group">
        <label for="bid_amount" class=" col-md-3"><?php echo lang('bid_amount'); ?></label>
        <div class=" col-md-9">
            <?php
            echo form_input(array(
                "id" => "bid_amount",
                "name" => "bid_amount",
                "value" => $data->estimated_amount,
                "class" => "form-control",
                "placeholder" => lang('bid_amount'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>

    <div class="form-group">
        <div class=" col-md-12">
            <?php
            echo form_textarea(array(
                "id" => "proposal",
                "name" => "proposal",
                "value" => $data->proposal,
                "class" => "form-control",
                "placeholder" => lang('proposal'),
                "style" => "height:150px;",
            ));
            ?>
        </div>
    </div>


    <div class="row">
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $("#add_bid").appForm({
            onSuccess: function (result) {
                appAlert.success(result.message, {duration: 10000});
                location.reload();
            }
        });
        initWYSIWYGEditor("#proposal", {
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['hr']],
            ],
            "placeholder":"<?=lang('proposal_label')?>"
        });
        $('#proposal').summernote('code');
    });

</script>