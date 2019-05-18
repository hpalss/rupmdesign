<?php if ($data): ?>
<?php foreach ($data as $key => $question): ?>
    <?php $by = ($this->login_user->user_type!="client")?"? <p class='pull-right'>By :". $question['first_name']." ".$question['last_name'] ."</p>":""?>
	<h5><?=$question['question'].$by;?></h5>
	<?php if ($question['answer']): ?>
		<p class="ans-bubble"><?=$question['answer']?></p>
	<?php else: ?>
        <?php if ($question['forward_to_client']==0): ?>
            
        <?php echo form_open(get_uri("estimate_requests/ans_question"), array("class" => "general-form", "role" => "form")); ?>
            <input type="hidden" name="estimate_id" value="<?php echo $estimate_id; ?>" />
            <input type="hidden" name="id" value="<?= $question['id']; ?>" />

            <div class="form-group">
                <div class=" col-md-12">
                    <?php
                    echo form_textarea(array(
                        "name" => "answer",
                        "value" => "",
                        "class" => "form-control",
                        "placeholder" => lang('your_answer_here'),
                        "style" => "height:80px;",
                    ));
                    ?>
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;"><span class="fa fa-check-circle"></span> <?php echo lang('btn_ans'); ?></button>
                    <input type="submit" name="ftoClient" value="<?php echo lang('btn_forward_to_client'); ?>" class="btn btn-success" style="margin-top: 10px;">
                </div>
            </div>
        <?php echo form_close(); ?>
        <?php elseif($this->login_user->user_type=="client"): ?>
        <?php echo form_open(get_uri("estimate_requests/ans_question"), array("class" => "general-form", "role" => "form")); ?>
            <input type="hidden" name="estimate_id" value="<?php echo $estimate_id; ?>" />
            <input type="hidden" name="id" value="<?= $question['id']; ?>" />

            <div class="form-group">
                <div class=" col-md-12">
                    <?php
                    echo form_textarea(array(
                        "name" => "answer",
                        "value" => "",
                        "class" => "form-control",
                        "placeholder" => lang('your_answer_here'),
                        "style" => "height:80px;",
                    ));
                    ?>
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;"><span class="fa fa-check-circle"></span> <?php echo lang('btn_ans'); ?></button>
                </div>
            </div>
        <?php echo form_close(); ?>
        <?php else: ?>
            <p class="ans-bubble"><?=lang('question_forward_to_client')?></p>
        <?php endif ?>
	<?php endif ?>
<?php endforeach ?>
<?php endif ?>