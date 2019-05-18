<?php if ($model_info->status === "new" || $model_info->status === "open") { ?>
    <li role="presentation"><?php echo ajax_anchor(get_uri("estimate_requests/change_estimate_request_status/$model_info->id/estimated"), "<i class='fa fa-check-circle'></i> " . lang('mark_as_estimated'), array("class" => "", "title" => lang('mark_as_estimated'), "data-reload-on-success" => "1")); ?> </li>
    <li role="presentation"><?php echo ajax_anchor(get_uri("estimate_requests/change_estimate_request_status/$model_info->id/canceled"), "<i class='fa fa-times-circle-o'></i> " . lang('mark_as_canceled'), array("class" => "", "title" => lang('mark_as_canceled'), "data-reload-on-success" => "1")); ?> </li>
<?php } else if ($model_info->status === "estimated") { ?>
    <li role="presentation"><?php echo ajax_anchor(get_uri("estimate_requests/change_estimate_request_status/$model_info->id/paid"), "<i class='fa fa-check-circle'></i> " . lang('mark_as_paid'), array("class" => "", "title" => lang('mark_as_paid'), "data-reload-on-success" => "1")); ?> </li>
    <li role="presentation"><?php echo ajax_anchor(get_uri("estimate_requests/change_estimate_request_status/$model_info->id/not_paid"), "<i class='fa fa-check-circle'></i> " . lang('mark_as_unpaid'), array("class" => "", "title" => lang('mark_as_unpaid'), "data-reload-on-success" => "1")); ?> </li>
    <li role="presentation"><?php echo ajax_anchor(get_uri("estimate_requests/change_estimate_request_status/$model_info->id/discuss"), "<i class='fa fa-check-circle'></i> " . lang('mark_as_discuss'), array("class" => "", "title" => lang('mark_as_discuss'), "data-reload-on-success" => "1")); ?> </li>
    <li role="presentation"><?php echo ajax_anchor(get_uri("estimate_requests/change_estimate_request_status/$model_info->id/canceled"), "<i class='fa fa-times-circle-o'></i> " . lang('mark_as_canceled'), array("class" => "", "title" => lang('mark_as_canceled'), "data-reload-on-success" => "1")); ?> </li>
<?php } else if ($model_info->status === "discuss") { ?>
    <li role="presentation"><?php echo ajax_anchor(get_uri("estimate_requests/change_estimate_request_status/$model_info->id/paid"), "<i class='fa fa-check-circle'></i> " . lang('mark_as_paid'), array("class" => "", "title" => lang('mark_as_paid'), "data-reload-on-success" => "1")); ?> </li>
    <li role="presentation"><?php echo ajax_anchor(get_uri("estimate_requests/change_estimate_request_status/$model_info->id/not_paid"), "<i class='fa fa-check-circle'></i> " . lang('mark_as_unpaid'), array("class" => "", "title" => lang('mark_as_unpaid'), "data-reload-on-success" => "1")); ?> </li>
    <li role="presentation"><?php echo ajax_anchor(get_uri("estimate_requests/change_estimate_request_status/$model_info->id/canceled"), "<i class='fa fa-times-circle-o'></i> " . lang('mark_as_canceled'), array("class" => "", "title" => lang('mark_as_canceled'), "data-reload-on-success" => "1")); ?> </li>
<?php } else if ($model_info->status === "canceled") { ?>
    <li role="presentation"><?php echo ajax_anchor(get_uri("estimate_requests/change_estimate_request_status/$model_info->id/not_paid"), "<i class='fa fa-check-circle'></i> " . lang('mark_as_unpaid'), array("class" => "", "title" => lang('mark_as_unpaid'), "data-reload-on-success" => "1")); ?> </li>
    <li role="presentation"><?php echo ajax_anchor(get_uri("estimate_requests/change_estimate_request_status/$model_info->id/estimated"), "<i class='fa fa-pause-circle-o'></i> " . lang('mark_as_estimated'), array("class" => "", "title" => lang('mark_as_estimated'), "data-reload-on-success" => "1")); ?> </li>
<?php } ?>