<div class="panel panel-default">
    <div class="panel-body">
        <?php if ($overdue): ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="toggle-overdue-task" value="">
                    <?=lang("toggle_overdue_tasks") ?>
                </label>
            </div>
        <div class="media b-b mb15 hide" id="w-overdue-task">
        <div class="dark strong text-warning"><?= lang("overdue_tasks") ?></div>
            <div class="media-body">
                <?php foreach ($overdue as $key => $task): ?>
                <div class="media-heading">
                    <p><span class="text-off"><?=format_to_date($task->deadline)?></span></p>
                </div>
                <p>
                        <?php $title = modal_anchor(get_uri("projects/task_view"), $task->title, array("title" => lang('task_info') . " #$task->id", "data-post-id" => $task->id));?>
                    <span>
                        <p><?php echo lang('task') ." : #".($key+1)." ".$title; ?></p>
                        <p><?php echo lang('project') ." : ".$task->project_title; ?></p>
                    </span>
                </p>
                <hr>
                <?php endforeach ?>
            </div>
        </div>
        <?php endif ?>
        <?php if ($upcomming): ?>
        <div class="media b-b mb15" id="w-upcomming-task">
        <div class="dark strong text-warning"><?= lang("next_tasks") ?></div>
            <div class="media-body">
                <?php foreach ($upcomming as $k => $val): ?>
                <div class="media-heading">
                    <p><span class="text-off"><?=format_to_date($val->deadline)?></span></p>
                </div>
                <p>
                        <?php $title = modal_anchor(get_uri("projects/task_view"), $val->title, array("title" => lang('task_info') . " #$val->id", "data-post-id" => $val->id));?>
                    <span>
                        <p><?php echo lang('task') ." : #".($k+1)." ".$title; ?></p>
                        <p><?php echo lang('project') ." : ".$val->project_title; ?></p>
                    </span>
                </p>
                <hr>
                <?php endforeach ?>
            </div>
        </div>
        <?php endif ?>
    </div>
</div>
<script>
    $('body').on('click', '#toggle-overdue-task', function(event) {
        $("#w-overdue-task").toggleClass('hide');
    });
</script>


       