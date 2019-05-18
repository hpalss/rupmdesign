
<div id="page-content" class="clearfix">
    <div style="max-width: 1000px; margin: auto;">
        <div class="page-title clearfix mt15">
        <h1><?php echo lang("estimate_request"); ?> # <?php echo $model_info->id; ?> <?php echo lang($model_info->category); ?></h1>

            <?php if ($show_actions) { ?>
                <div class="title-button-group p10">

                    <span class="dropdown inline-block">
                        <button class="btn btn-default dropdown-toggle  mt0 mb0" type="button" data-toggle="dropdown" aria-expanded="true">
                            <i class='fa fa-cogs'></i> <?php echo lang('actions'); ?>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <?php if ($this->login_user->user_type == "staff") { ?>
                                <li role="presentation">
                                    <?php echo modal_anchor(get_uri("estimate_requests/edit_estimate_request_modal_form"), "<i class='fa fa-pencil'></i> " . lang('edit'), array("title" => lang('estimate_request'), "data-post-view" => "details", "data-post-id" => $model_info->id)); ?>
                                </li>
                                <?php
                            }?>
                            <?php if ($this->login_user->is_admin): ?>
                                <?php $bidText = lang('send_bid'); ?>
                                <li>
                                    <?php echo modal_anchor(get_uri("bidding/open_question_modal"), "<i class='fa fa-question'></i> " . lang('ask_question'), array("title" => lang('ask_question'), "data-post-view" => "details", "data-post-id" => $model_info->id)); ?>
                                </li>
                                <li>
                                <?php echo modal_anchor(get_uri("bidding/open_bidding_modal"), "<i class='fa fa-plane'></i> " . $bidText, array("title" => lang('bidding'), "data-post-view" => "details", "data-post-id" => $model_info->id)); ?>
                                </li>
                                <?php endif ?>
                                
                            <?php
                            $this->load->view("estimate_requests/estimate_request_all_status_options");
                            ?>

                            <?php if ($this->login_user->user_type == "staff") { ?>
                                <li role="presentation">
                                    <?php echo modal_anchor(get_uri("estimates/modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_estimate'), array("title" => lang('add_estimate'), "data-post-estimate_request_id" => $model_info->id, "data-post-client_id" => $model_info->client_id)); ?>    
                                </li>
                            <?php } ?>
                        </ul>
                    </span>
                </div>
            <?php } ?>
        </div>
        <div class="panel panel-default  p15 no-border">
            <span class="text-off"><?php echo lang("status") . ": "; ?></span>
            <?php echo $status; ?>


            <?php if ($show_client_info && ($model_info->company_name || $model_info->lead_company_name)) { ?>

                <span class="text-off ml15"><?php echo lang("client") . ": "; ?></span>
                <?php
                if ($model_info->company_name) {
                    echo anchor(get_uri("clients/view/" . $model_info->client_id), $model_info->company_name);
                } else if ($model_info->lead_company_name) {
                    echo $model_info->lead_company_name;
                }
                ?>

            <?php } ?>

            <span class="text-off ml15"><?php echo lang("created") . ": "; ?></span>
            <?php echo format_to_datetime($model_info->created_at); ?>

            <span class="text-off ml15"><?php echo lang("deadline") . ": "; ?></span>
            <?php echo format_to_date($model_info->deadline); ?>
            
            <?php if ($this->login_user->user_type!="client"): ?>
                <span class="text-off ml15"><?php echo lang("proposals") . ": "; ?></span>
                <?php echo $model_info->total_bids>0?"<i class='text-success fa fa-check'></i>":lang("no_proposals"); ?>
            <?php endif ?>

            <?php
            if ($show_assignee && $model_info->assigned_to) {
                $image_url = get_avatar($model_info->assigned_to_avatar);
                $assigned_to_user = "<span class='avatar avatar-xs mr10'><img src='".$image_url."' alt='...'></span> $model_info->assigned_to_user";
                $assigned_to = get_team_member_profile_link($model_info->assigned_to, $assigned_to_user);
                ?>
                <span class="text-off ml15"><?php echo lang("assigned_to") . ":"; ?></span>
                <span class="ml10"><?php echo $assigned_to; ?> </span>
                <?php
            }
            ?>
    </div>
            <?php
            if ($this->login_user->user_type == "staff" && $estimates) {
                $estimate_lang = lang("estimate");
                if (count($estimates) > 1) {
                    $estimate_lang = lang("estimates");
                }
                ?>

                <span class="text-off ml15"><?php echo $estimate_lang . ": "; ?></span>

                <?php
                $last_estimate = end($estimates);
                foreach ($estimates as $estimate) {
                    $seperation = ($estimate == $last_estimate) ? "" : ", ";
                    echo anchor(get_uri("estimates/view/" . $estimate->id), get_estimate_id($estimate->id)) . $seperation;
                }
                ?>
            <?php } ?>  

        </div>
<div style ="max-width: 1000px; margin: auto;">
        <div class="panel panel-default">


            <div class="panel-body">
            <h3 class="pl15 pr15">  <?php echo $model_info->title; ?></h3>
                <div class="row">
                    <div class="col-sm-8">
                <div class="table-responsive mt20 general-form">
                        <table class="display no-thead b-t b-b-only no-hover" cellspacing="0" width="100%">    
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="estimate-request-table" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending">Title</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <tr role="row" class="odd"><td><p class="clearfix"><i class="fa fa-check-circle"></i><strong class=""> In which part do you study? </strong> </p><div class="pl15"><?=$model_info->course;?></div></td></tr>
                            <tr role="row" class="even"><td><p class="clearfix"><i class="fa fa-check-circle"></i><strong class=""> Type of Service </strong> </p><div class="pl15"><?=$model_info->type_of_service;?></div></td></tr>
                            <tr role="row" class="odd"><td><p class="clearfix"><i class="fa fa-check-circle"></i><strong class=""> Work Level </strong> </p><div class="pl15"><?=$model_info->work_level;?></div></td></tr>
                            <tr role="row" class="even"><td><p class="clearfix"><i class="fa fa-check-circle"></i><strong class=""> What kind of work is it? </strong> </p><div class="pl15"><?=$model_info->work_type;?></div></td></tr>
                            <tr role="row" class="odd"><td><p class="clearfix"><i class="fa fa-check-circle"></i><strong class=""> How many pages / words to work </strong> </p><div class="pl15"><?=$model_info->pages_words;?></div></td>
                            </tr><tr role="row" class="even"><td><p class="clearfix"><i class="fa fa-check-circle"></i><strong class=""> Language </strong> </p><div class="pl15"><?=$model_info->required_language;?></div></td></tr>
                            <tr role="row" class="odd"><td><p class="clearfix"><i class="fa fa-check-circle"></i><strong class=""> Subject - Observations </strong> </p><div class="pl15"><?=$model_info->subject;?></div></td></tr>
                        </tbody>
                    </table>
                    </div>
                    <?php if($this->login_user->user_type=="client" && !in_array($model_info->status, array("open","canceled","rejected"))): ?>
                        <?php $this->load->view("estimate_requests/partials/discussion", array("estimate_id"=>$model_info->id));?>
                        <?php endif ?>
                        <?php if($this->login_user->user_type=="staff" && in_array($model_info->status, array("discuss","admin_replied","client_question"))): ?>
                        <?php $this->load->view("estimate_requests/partials/discussion", array("estimate_id"=>$model_info->id));?>
                        <?php endif ?>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            
                        </div>
                                <?php 
                                    $estimateAmount = 0;
                                    if (isset($bidding) && $bidding):
                                        $pos = array_search(1, array_column($bidding, 'send_to_client'));
                                        $bidId = $bidding[$pos]['id'];
                                        $estimateId = $bidding[$pos]['estimate_id'];
                                        $proposalText = $bidding[$pos]['proposal'];
                                        $bidStatus = status_label($bidding[$pos]['status']);
                                        $estimateAmount = $bidding[$pos]['estimated_amount'];
                                        $estimateAmount = filter_var($estimateAmount, FILTER_SANITIZE_NUMBER_FLOAT);
                                        $percentage=0.3;
                                        $totalProjectAmount = $estimateAmount;
                                        if ($totalProjectAmount<100) {
                                            $percentage = 1;
                                        }else if ($totalProjectAmount>=100 && $totalProjectAmount<=400) {
                                            $percentage = 0.5;
                                        }
                                        $totalProjectAmount = $totalProjectAmount*$percentage;
                                ?>
                            <?php if ($bidding[$pos]['status']!="rejected" && $pos!==false): ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p><?=lang('new_proposal_no')?> <?=$bidId." ".$bidStatus;?></p>
                                <p><?=$proposalText ?></p>
                                <hr>
                                <div class="proposal-block">
                                    <p>
                                    <span class="price-label"><?=lang("price")?></span>
                                    <span class="price-value" id="total-project-amount">€ <?=$estimateAmount;?></span>
                                </p>
                                <p>
                                    <span class="price-label"><?=lang('deposit')?></span>
                                    <span class="price-value">€ <?=$totalProjectAmount; ?></span>
                                </p>
                                </div>
                                <div class="proposal-action">
                                <?php if ($this->login_user->user_type=="client" && !in_array($model_info->status, array("accepted","canceled","rejected","paid","noy_paid","won","confirm"))): ?>
                                    <?=js_anchor(lang('accept'), array('onClick'=>"sendBidResponse($bidId,$model_info->id,'accepted')","class" => "edit btn btn-warning btn-lg", "title" => lang('accept')));?>
                                    <?php echo modal_anchor(get_uri("estimate_requests/update_estimate_status/rejected/$bidId"),lang('reject'), array("title" => lang('bid_reject_confirmation'), "data-post-view" => "details","class"=>"delete btn btn-default btn-lg", "data-post-id" => $model_info->id)); ?>
                                <?php else: ?>
                                    <?php if ($model_info->status=="paid" && $this->login_user->user_type!="client"): ?>
                                        <?php echo modal_anchor(get_uri("estimate_requests/update_estimate_status/not_paid/$bidId"),lang('mark_as_unpaid'), array("title" => lang('upaid_estimate_model'), "data-post-view" => "details","class"=>"edit btn btn-warning", "data-post-id" => $model_info->id)); ?>
                                        <?php echo modal_anchor(get_uri("estimate_requests/update_estimate_status/confirm/$bidId"),lang('btn_confirm'), array("title" => lang('update_estimate_status'), "data-post-view" => "details","class"=>"edit btn btn-default", "data-post-id" => $model_info->id)); ?>
                                    <?php else: ?>
                                    <?php if ($this->login_user->user_type=="client" && in_array($model_info->status, array("accepted","not_paid"))): ?>
                                    <?php echo modal_anchor(get_uri("estimate_requests/update_estimate_status/paid/$bidId"),lang('mark_as_paid'), array("title" => lang('update_estimate_status'), "data-post-view" => "details","class"=>"edit btn btn-success btn-lg", "data-post-id" => $model_info->id)); ?>
                                    <?php endif ?>
                                    <?php endif ?>
                                <?php endif ?>
                                </div>
                            </div>
                </div>
                            <?php endif ?>
                <?php endif ?>
                        <?php if ($model_info->status=="open" && $noBidYet): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?=lang("actions")?></h3>
                            </div>
                            <div class="panel-body">
                                <?php echo modal_anchor(get_uri("estimate_requests/update_estimate"), "<i class='fa fa-pencil'></i> " . lang('update_estimate'), array("title" => lang('update_estimate'), "data-post-view" => "details","class"=>"btn btn-warning", "data-post-id" => $model_info->id)); ?>
                                <?php echo modal_anchor(get_uri("estimate_requests/update_estimate_status/canceled/$model_info->id"), "<i class='fa fa-times-circle-o'></i> " . lang('cancel'), array("class" => "btn btn-danger", "title" => lang('canceled_estimate_model'),"data-post-id" => $model_info->id)); ?>

                            </div>
                        </div>
                        <?php endif ?>
                        <?php if ($statuses && $this->login_user->user_type!="client"): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?=lang("status_change_timeline")?></h3>
                            </div>
                            <div class="panel-body">
                                <?php foreach ($statuses as $st): ?>
                                    <?php if ($st->status=='rejected' || $st->status=="canceled"): ?>
                                    <p><?=status_label($st->status)?> : <?=lang("$st->notes")?> <small class="text-danger"><?=format_to_datetime($st->created_at) ?></small></p>
                                        <?php else: ?>
                                    <p><?=status_label($st->status)?> : <?=$st->notes;?> <small class="text-danger"><?=format_to_datetime($st->created_at) ?></small></p>

                                    <?php endif ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <?php endif ?>

                        <?php if ($statuses && $this->login_user->user_type=="client"): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?=lang("status_change_timeline")?></h3>
                            </div>
                            <div class="panel-body">
                                <?php foreach ($statuses as $st): ?>
                                    <?php if ($st->status=='rejected' || $st->status=="canceled"): ?>
                                    <p><?=status_label($st->status)?> : <?=lang("$st->notes")?> <small class="text-danger"><?=format_to_datetime($st->created_at) ?></small></p>
                                        <?php else: ?>
                                    <p><?=status_label($st->status)?> : <?=$st->notes;?> <small class="text-danger"><?=format_to_datetime($st->created_at) ?></small></p>

                                    <?php endif ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <?php endif ?>
                        <?php if ($this->login_user->user_type=="client" ): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?=lang("usefull_tips")?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="p15">
                                <?php if ($model_info->status=="open"): ?>
                                    <p><?=lang("wait_status_open")?></p>
                                <?php endif ?>
                                <?php if ($model_info->status=="paid"): ?>
                                    <p><?=lang("waiting_payment_confirm")?></p>
                                <?php endif ?>

                                <?php if ($model_info->status=="not_paid"): ?>
                                    <p><?=lang("payment_not_confirm")?></p>
                                    <?php 
                                    $percentage=0.3;
                                    $totalProjectAmount = preg_replace('/\D/', '', $estimateAmount);
                                    if ($totalProjectAmount<100) {
                                        $percentage = 1;
                                    }else if ($totalProjectAmount>=100 && $totalProjectAmount<=400) {
                                        $percentage = 0.5;
                                    }
                                    $totalProjectAmount = $totalProjectAmount*$percentage;
                                     ?>
                                    <p><?=sprintf(lang("you_need_to_pay"),$totalProjectAmount)?></p>
                                    <p><?=lang("payment_notes")?></p>
                                    <?php echo ajax_anchor(get_uri("estimate_requests/estimate_request_status_update/$model_info->id/paid"), "<i class='fa fa-times-circle-o'></i> " . lang('mark_as_paid'), array("class" => "btn btn-success", "title" => lang('mark_as_paid'), "data-reload-on-success" => "1")); ?>
                                <?php endif ?>
                                <?php if ($model_info->status=="accepted"): ?>
                                    <?php 
                                    $percentage=0.3;
                                    $totalProjectAmount = preg_replace('/\D/', '', $estimateAmount);
                                    if ($totalProjectAmount<100) {
                                        $percentage = 1;
                                    }else if ($totalProjectAmount>=100 && $totalProjectAmount<=400) {
                                        $percentage = 0.5;
                                    }
                                    $totalProjectAmount = $totalProjectAmount*$percentage;
                                     ?>
                                    <p><?=sprintf(lang("you_need_to_pay"),$totalProjectAmount)?></p>
                                    <p><?=lang("payment_notes")?></p>
                                    <?php //echo ajax_anchor(get_uri("estimate_requests/estimate_request_status_update/$model_info->id/paid"), "<i class='fa fa-times-circle-o'></i> " . lang('mark_as_paid'), array("class" => "btn btn-success", "title" => lang('mark_as_paid'), "data-reload-on-success" => "1")); ?>
                                <?php endif ?>
                                <?php if ($model_info->status=="estimated"): ?>
                                    <p><?=lang("estimated_message")?></p>
                                <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <?php endif ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?=lang("attachments")?></h3>
                </div>
                <div class="panel-body">
                <div class="p15">
                    <?php
                    if ($model_info->files) {
                        $files = unserialize($model_info->files);
                        $total_files = count($files);
                        $this->load->view("includes/timeline_preview", array("files" => $files));
                        if ($total_files && $show_download_option) {
                            $download_caption = lang('download');
                            if ($total_files > 1) {
                                $download_caption = sprintf(lang('download_files'), $total_files);
                            }

                            echo "<i class='fa fa-paperclip pull-left font-16'></i>";


                            echo anchor(get_uri("estimate_requests/download_estimate_request_files/" . $model_info->id), $download_caption, array("class" => "pull-right", "title" => $download_caption));
                        }
                    }else{
                        echo lang("no_attachments");
                    }
                    ?>
                </div>
                </div>
                        </div>

                    </div>
                </div>

            </div>
            <?php if (isset($bidding) && $bidding && $this->login_user->user_type!="client"): ?>
                
            <div class="panel-body">
                <h3 class="page-title mt15">  <?php echo lang('bidding') ?></h3>
                <div class="table-responsive mt20 general-form">
                    <?php $this->load->view("estimate_requests/admin_bidding", array("data"=>$bidding,"estimate_id"=>$model_info->id));?>
                </div>
            </div>
            <?php endif ?>
            <?php if (isset($questions) && $questions): ?>
            <div class="panel-body">
                <h3 class="page-title mt15">  <?php echo lang('ask_question') ?></h3>
                <div class="table-responsive mt20 general-form">
                    <?php $this->load->view("estimate_requests/admin_questions", array("data"=>$questions,"estimate_id"=>$model_info->id));?>
                </div>
            </div>
            <?php endif ?>
        </div>      


        <?php if ($lead_info) { ?>
            <div class="panel panel-default">
                <div class="page-title ml15">
                    <h4><?php echo lang("client_info"); ?></h4>
                </div>
                <div class="panel-body">
                    <table class="display no-thead b-t b-b-only no-hover dataTable no-footer ">
                        <tbody>
                            <tr>
                                <td>
                                    <i class="fa fa-cube"></i><strong> <?php echo lang('company_name'); ?></strong>
                                    <div class="pl15"><?php echo $lead_info->company_name; ?></div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <i class="fa fa-cube"></i><strong> <?php echo lang('first_name'); ?></strong>
                                    <div class="pl15"><?php echo $lead_info->first_name; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-cube"></i><strong> <?php echo lang('last_name'); ?></strong>
                                    <div class="pl15"><?php echo $lead_info->last_name; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-cube"></i><strong> <?php echo lang('email'); ?></strong>
                                    <div class="pl15"><?php echo $lead_info->email; ?></div>
                                </td>
                            </tr>

                            <?php if ($lead_info->address) { ?>
                                <tr>
                                    <td>
                                        <i class="fa fa-cube"></i><strong> <?php echo lang('address'); ?></strong>
                                        <div class="pl15"><?php echo nl2br($lead_info->address); ?></div>
                                    </td>
                                </tr>
                            <?php } ?>

                            <?php if ($lead_info->city) { ?>    
                                <tr>
                                    <td>
                                        <i class="fa fa-cube"></i><strong> <?php echo lang('city'); ?></strong>
                                        <div class="pl15"><?php echo $lead_info->city; ?></div>
                                    </td>
                                </tr>
                            <?php } ?>

                            <?php if ($lead_info->state) { ?>      
                                <tr>
                                    <td>
                                        <i class="fa fa-cube"></i><strong> <?php echo lang('state'); ?></strong>
                                        <div class="pl15"><?php echo $lead_info->state; ?></div>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($lead_info->zip) { ?>    
                                <tr>
                                    <td>
                                        <i class="fa fa-cube"></i><strong> <?php echo lang('zip'); ?></strong>
                                        <div class="pl15"><?php echo $lead_info->zip; ?></div>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($lead_info->country) { ?>    
                                <tr>
                                    <td>
                                        <i class="fa fa-cube"></i><strong> <?php echo lang('country'); ?></strong>
                                        <div class="pl15"><?php echo $lead_info->country; ?></div>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if ($lead_info->phone) { ?>    
                                <tr>
                                    <td>
                                        <i class="fa fa-cube"></i><strong> <?php echo lang('phone'); ?></strong>
                                        <div class="pl15"><?php echo $lead_info->phone; ?></div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        <?php } ?>
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#estimate-request-table").appTable({
            source: '<?php echo_uri("estimate_requests/estimate_request_filed_list_data/" . $model_info->id) ?>',
            order: [[1, "asc"]],
            hideTools: true,
            displayLength: 100,
            columns: [
                {title: '<?php echo lang("title") ?>'},
                {visible: false}
            ],
            onInitComplete: function () {
                $(".dataTables_empty").hide();
            }
        });
    });
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
                if(status=="confirm"){
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
        
    }
    function createProject(estimateData) {
        // id: 
        // estimate_id: 
        // title: Project Req
        // client_id: 2
        // description: testing
        // start_date: 2019-03-19
        // deadline: 2019-03-28
        // price: 120
        // labels: test
        console.log(estimateData);
    }
    $(document).on('change', '#proposal-choice', function(event) {
        event.preventDefault();
        var bidId = $(this).attr('data-bid');
        var estimateId = $(this).attr('data-estimateId');
        var status = $(this).val();
        if (confirm('<?=lang("are_you_sure")?>')) {
            sendBidResponse(bidId,estimateId,status);
        }
    });
    </script>
