<?php if ($data): ?>
<?php foreach ($data as $key => $story): ?>
	<?php 
		$message_by = "";
        $image_url = get_avatar($story->image);
        $avatarImg = "<span class='avatar avatar-xs mr10'><img src='$image_url' alt='...'></span> $story->first_name";
        $message_by = get_client_contact_profile_link($story->from_user_id, $story->first_name);
        if ($this->login_user->user_type == "staff" && $story->from_user_id==$this->login_user->id) {
	        $message_by = get_team_member_profile_link($story->from_user_id, $story->first_name);
        }
	 ?>
    <div id="prject-comment-container-customer_feedback-2" class="comment-container media b-b mb15 comment-customer_feedback">
        <div class="media-left comment-avatar">
            <span class="avatar  avatar-xs ">
                <img src='<?=$image_url?>' alt='...'>
            </span>
        </div>
        <div class="media-body">
            <div class="media-heading">
                <?=$message_by; ?>            
                <small>
                	<span class="text-off"><?=format_to_datetime($story->created_at)?></span>
                </small>
            </div>
            <p><?=$story->message?></p>
        </div>
    </div>
<?php endforeach ?>
<?php endif ?>