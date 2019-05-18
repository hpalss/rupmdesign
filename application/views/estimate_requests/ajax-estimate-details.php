<tr class="tr-details">
<td colspan="8" style="background-color: #fff">
    <div class="detail-bubble">
    <?php if ($bidding): ?>
    <h4><?=lang("biddings")?></h4>
<?php if ($this->login_user->is_admin): ?>
    <?php $bidText = lang('send_bid'); ?>
        <?php echo modal_anchor(get_uri("bidding/open_question_modal"), "<i class='fa fa-question'></i> " . lang('ask_question'), array("title" => lang('ask_question'), "data-post-view" => "details","class"=>"btn btn-warning pull-right", "data-post-id" => $estimate_id)); ?>
        <?php echo modal_anchor(get_uri("bidding/open_bidding_modal"), "<i class='fa fa-plane'></i> " . $bidText, array("title" => lang('bidding'), "data-post-view" => "details","class"=>"btn btn-success pull-right", "data-post-id" => $estimate_id)); ?>
<?php endif ?>
    <table class="table display dataTable no-footer">
        <thead style="display: table-header-group;">
            <tr>
                <th><?=lang("created")?></th>
                <th><?=lang("bid_amount")?></th>
                <?php if ($this->login_user->is_admin): ?>
                <th><?=lang("by")?></th>
                <?php endif ?>
                <th><?=lang("status")?></th>
                <th><?=lang("proposal_label")?></th>
                <th><?=lang("action")?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bidding as $key => $value): ?>
            <tr>
                <td><?=format_to_datetime($value['created_at']);?></td>
                <td><?=$value['estimated_amount'];?></td>
                <?php if ($this->login_user->is_admin): ?>
                    <?php 
                        $dev = $value['first_name']." ".$value['last_name'];
                        if ($value['bid_by']) {
                            $dev = get_team_member_profile_link($value['bid_by'],$dev);
                        }
                     ?>
                    <td><?=$dev;?></td>
                <?php endif ?>
                <td><?=$value['status'];?></td>
                <td><?=$value['proposal'];?></td>
                <?php if ($value['status']=="send"): ?>
                    <?php if ($this->login_user->user_type=="client" && !in_array($value['status'], array("Accepted","Canceled","Rejected","Hold","Estimated"))): ?>
                    <td><?=js_anchor("<i class='fa fa-thumbs-up'></i> ".lang('accept'), array('onClick'=>"sendBidResponse($value[id],$value[estimate_id],'accepted')","class" => "edit btn btn-success btn-xs", "title" => lang('accept')));?>
                         <?=modal_anchor(get_uri("estimate_requests/update_estimate_status/rejected/$value[id]"),lang('reject'), array("title" => lang('bid_reject_confirmation'), "data-post-view" => "details","class"=>"delete btn btn-danger btn-xs", "data-post-id" => $value['estimate_id']));?>
                     </td>
                    <?php else: ?>
                        <td><?=lang("offer_send");?></td>
                    <?php endif ?>
                <?php elseif($value['status']=="rejected"): ?>
                        <td class="text-danger"><i class="fa fa-close"></i><?=lang("rejected");?></td>
                <?php elseif($value['status']=="accepted"): ?>
                        <td class="text-success"><i class="fa fa-check"></i><?=lang("accepted");?></td>
                <?php else: ?>
                    <?php if ($this->login_user->user_type=="client"): ?>
                        <td><?=modal_anchor(get_uri("estimate_requests/action_form/".$value['id']), lang('response'), array("class" => "edit", "title" => lang('response_bid'), "data-post-id" => $value['estimate_id']));?></td>
                    <?php else: ?>
                        <td><?=modal_anchor(get_uri("estimate_requests/get_bid/".$value['id']), "<i class='fa fa-paper-plane'></i>", array("class" => "edit", "title" => lang('send_to_client'), "data-post-id" => $value['estimate_id']));?></td>
                    <?php endif ?>
                <?php endif ?>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php endif ?>
    <?php if ($questions): ?>
        <h4>  <?php echo lang('questions') ?></h4>
        <div class="table-responsive mt20 general-form">
            <?php $this->load->view("estimate_requests/admin_questions", array("data"=>$questions,"estimate_id"=>$estimate_id));?>
        </div>
    <?php endif ?>
    <?php if(!$bidding && ! $questions)
        echo lang("no_details");
    ?>
    </div>
    </td>
</tr>
<script type="text/javascript">
    function sendBidResponse(id,estimateId,status) {
        appLoader.show();
        $.ajax({
            url: "<?=get_uri("estimate_requests/client_action_on_estimate/")?>",
            type: 'POST',
            dataType: 'json',
            data: {id: id,estimate_id:estimateId,status:status},
        })
        .always(function(response) {
            appLoader.hide();
            if (response.success) {
                appAlert.success(response.message, {duration: 10000});
                setTimeout(function() {
                    location.reload();
                }, 500);
            } else {
                appAlert.error(response.message, {duration: 10000});
            }
        });
        
    }
</script>