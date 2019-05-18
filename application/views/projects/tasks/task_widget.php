<div class="panel panel-default dbCardStyle">
    <div class="panel-heading no-border">
        <i class="fa fa-tasks"></i>&nbsp; <?php echo lang('my_tasks'); ?>
    </div>
    <div class="task-container">
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            url: '<?php echo_uri('projects/get_tasks_states'); ?>',
            type: 'GET',
            dataType: 'html',
            // data: {param1: 'value1'},
        })
        .always(function(view) {
            $(".task-container").html(view);
           // if (data.overdue) {
           // }
           // if (data.upcomming) {
           //      $(".next-tasks").html(data.upcomming);
           // }
        });

    });
</script>
