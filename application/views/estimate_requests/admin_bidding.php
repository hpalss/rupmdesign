
<?php if ($data && $this->login_user->user_type!="client"): ?>
    <table class="table table-bordored display dataTable no-footer">
        <thead style="display: table-header-group;">
            <tr>
                <th><?=lang("created")?></th>
                <th><?=lang("bid_amount")?></th>
                <th><?=lang("by")?></th>
                <th><?=lang("status")?></th>
                <th><?=lang("proposal_label")?></th>
                <th><?=lang("action")?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value): ?>
            <tr>
                <td><?=format_to_datetime($value['created_at'])?></td>
                <td><?=$value['estimated_amount'];?></td>
                <?php 
                    $dev = $value['first_name']." ".$value['last_name'];
                    if ($value['bid_by']) {
                        $dev = get_team_member_profile_link($value['bid_by'],$dev);
                    }
                ?>
                <td><?=$dev?></td>
                <td><?=$value['status'];?></td>
                <td><?=$value['proposal'];?></td>
                <?php if ($value['status']=="send"): ?>
                    <?php if ($this->login_user->user_type=="client"): ?>
                        <td><?=js_anchor(lang('accept'), array('onClick'=>"sendBidResponse($value[id],$value[estimate_id],'accepted')","class" => "edit btn btn-success btn-xs", "title" => lang('accept')));?>
                         <?=modal_anchor(get_uri("estimate_requests/update_estimate_status/rejected/$value[id]"),lang('reject'), array("title" => lang('bid_reject_confirmation'), "data-post-view" => "details","class"=>"delete btn btn-default btn-xs", "data-post-id" => $value['estimate_id']));?></td>
                    <?php else: ?>
                        <td><?=lang("offer_send");?></td>
                    <?php endif ?>
                <?php elseif($value['status']=="rejected"): ?>
                        <td class="text-danger"><i class="fa fa-close"></i><?=lang("rejected");?></td>
                <?php elseif($value['status']=="accepted"): ?>
                        <td class="text-success"><i class="fa fa-check"></i><?=lang("accepted");?></td>
                <?php else: ?>
                    <?php if ($this->login_user->user_type=="client"): ?>
                        <td><?=anchor(get_uri("estimate_requests/action_form/".$value['id']), lang('response'), array("class" => "edit", "title" => lang('response_bid'), "data-post-id" => $value['estimate_id']));?></td>
                    <?php else: ?>
                        <td><?=modal_anchor(get_uri("estimate_requests/get_bid/".$value['id']), "<i class='fa fa-paper-plane'></i> ".lang("btn_send"), array("class" => "edit", "title" => lang('send_to_client'), "data-post-id" => $value['estimate_id']));?></td>
                    <?php endif ?>
                <?php endif ?>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>
<script>
    function sendBidResponse(id,estimateId,status) {
        appLoader.show();
        $.ajax({
            url: "<?=get_uri("estimate_requests/client_action_on_estimate/")?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id,estimate_id:estimateId,status:"accepted"},
        })
        .always(function(response) {
            appLoader.hide();
            if (response.success) {
                appAlert.success(response.message, {duration: 10000});
            } else {
                appAlert.error(response.message, {duration: 10000});
            }
        });
        
    }
</script>