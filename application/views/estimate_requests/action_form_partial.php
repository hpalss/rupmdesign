<div class="modal-body clearfix">
        <?php echo form_open(get_uri("estimate_requests/client_action_on_estimate"), array("id" => "add_bid", "class" => "general-form", "role" => "form")); ?>
        <input type="hidden" name="estimate_id" value="<?php echo $estimate_id; ?>" />
        <input type="hidden" name="id" value="<?php echo $data->id; ?>" />
        <ul class="list-group">
  <li class="list-group-item"><?=lang("bid_amount")?> <span class="badge"><?=$data->estimated_amount;?></span></li>
  <li class="list-group-item"><?=lang("status")?> <span class="badge"><?=$data->status;?></span></li>
  <li class="list-group-item"><?=lang("proposal_label")?> <span class="pull-right"><?=$data->proposal;?></span></li>
</ul>
        <div class="row">
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>