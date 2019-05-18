<div class="modal-body clearfix">
        
        <?php $estimated_amount = "";
        $estimated_time = "";
        $proposal = "";
        $id = "";
        $bid_by = "";
        $status = "pending";
        ?>
        <?php if ($data): ?>
            <?php 
                $estimated_amount = $data['estimated_amount'];
                $proposal = $data['proposal'];
                $id = $data['id'];
                $estimate_id = $data['estimate_id'];
                $status = $data['status'];
                $bid_by = $data['bid_by'];
            ?>
        <?php endif ?>
        <?php echo form_open(get_uri("bidding/add"), array("id" => "estimate-request-bidding-form", "class" => "general-form", "role" => "form")); ?>
        <input type="hidden" name="estimate_id" value="<?php echo $estimate_id; ?>" />
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="bid_by" value="<?php echo $bid_by; ?>" />

        <div class="form-group">
            <label for="bid_amount" class=" col-md-3"><?php echo lang('bid_amount'); ?></label>
            <div class=" col-md-9">
                <?php
                echo form_input(array(
                    "id" => "bid_amount",
                    "name" => "bid_amount",
                    "value" => $estimated_amount,
                    "class" => "form-control",
                    "placeholder" => lang('bid_amount'),
                    "autofocus" => true,
                    "data-rule-required" => true,
                    "data-msg-required" => lang("field_required")
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <!-- <label for="proposal" class=" col-md-3"><?php echo lang('proposal_label'); ?></label> -->
            <div class=" col-md-12">
                    <?php
                    echo form_textarea(array(
                        "id" => "proposal",
                        "name" => "proposal",
                        "value" => $proposal,
                        "class" => "form-control",
                        "placeholder" => lang('proposal'),
                        "style" => "height:150px;"
                    ));
                    ?>
            </div>
        </div>
        <?php if ($status=="pending"): ?>
            <button type="submit" class="btn btn-primary"><span class="fa fa-check-circle"></span> <?php echo lang('save'); ?></button>
        <?php else: ?>
            <div class="form-group ml15">
                <?=lang('bid_update_warning')?>
            </div>
        <?php endif ?>

    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $("#estimate-request-bidding-form").appForm({
        onSuccess: function (result) {
            appAlert.success(result.message, {duration: 10000});
            setTimeout(function() {
                location.reload();
            }, 500);
        }
    });
    jQuery(document).ready(function($) {
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