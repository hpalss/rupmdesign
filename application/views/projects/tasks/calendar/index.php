<?php
load_css(array(
    "assets/js/fullcalendar/fullcalendar.min.css"
));

load_js(array(
    "assets/js/fullcalendar/fullcalendar.min.js",
    "assets/js/fullcalendar/lang-all.js",
    "assets/js/bootstrap-confirmation/bootstrap-confirmation.js"
));

$client = "";
if (isset($client_id)) {
    $client = $client_id;
}
?>

<div id="page-content" class="p20 pb0 clearfix">

    <ul class="nav nav-tabs bg-white title" role="tablist">
        <li class="title-tab"><h4 class="pl15 pt10 pr15"><?php echo lang("tasks"); ?></h4></li>

        <?php $this->load->view("projects/tasks/tabs", array("active_tab" => "calendar")); ?>  
        <div class="page-title clearfix">
            <div class="title-button-group">
                <?php echo modal_anchor(get_uri("projects/task_view"), "", array("class" => "hide", "id" => "show_event_hidden", "data-post-id" => $id, "data-post-cycle" => "0", "data-post-editable" => "1", "title" => lang('event_details'))); ?>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
            <div class="col-sm-3">
            <div class="form-group">
                <select name="status" id="inputStatus" multiple class="select2 form-control">
                    <option value="">Status</option>
                    <option value="1"><?=lang('to_do')?></option>
                    <option value="2"><?=lang('inprogress')?></option>
                    <option value="3"><?=lang('done')?></option>
                </select>
            </div>
            </div>
            <?php if ($this->login_user->is_admin): ?>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div id="assignTo" class="form-control"></div>
                    </div>
                </div>
                <?php else: ?>
                    <input type="hidden" name="assignTo" value="<?=$this->login_user->id?>">
            <?php endif ?>
        </div>
            <div id="event-calendar"></div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#assignTo").select2({data:<?=$assigned_to_dropdown; ?>});
        $(".select2").select2();
        $("#event-calendar").fullCalendar({
            lang: AppLanugage.locale,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: {
            url: "<?php echo_uri("projects/task_data/" . $id); ?>",
            data: function () { // a function that returns an object
                return {
                    status: $("#inputStatus").val(),
                    assign: $("#assignTo").val(),
                };

                }
            },
            dayClick: function (date, jsEvent, view) {
                $("#add_event_hidden").attr("data-post-start_date", date.format("YYYY-MM-DD"));
                var startTime = date.format("HH:mm:ss");
                if (startTime === "00:00:00") {
                    startTime = "";
                }
                $("#add_event_hidden").attr("data-post-start_time", startTime);
                var endDate = date.add(1, 'hours');

                $("#add_event_hidden").attr("data-post-end_date", endDate.format("YYYY-MM-DD"));
                var endTime = "";
                if (startTime != "") {
                    endTime = endDate.format("HH:mm:ss");
                }

                $("#add_event_hidden").attr("data-post-end_time", endTime);
                $("#add_event_hidden").trigger("click");
            },
            eventClick: function (calEvent, jsEvent, view) {
                console.log(calEvent);
                $("#show_event_hidden").attr("data-post-id", calEvent.id);
                $("#show_event_hidden").attr("data-post-cycle", calEvent.cycle);
                $("#show_leave_hidden").attr("data-post-id", calEvent.id);

                if (calEvent.event_type === "event") {
                    $("#show_event_hidden").trigger("click");
                } else {
                    $("#show_leave_hidden").trigger("click");
                }
            },
            eventRender: function (event, element) {
                if (event.icon) {
                    element.find(".fc-title").prepend("<i class='fa " + event.icon + "'></i> ");
                }
            },
            firstDay: AppHelper.settings.firstDayOfWeek

        });

        var client = "<?php echo $client; ?>";
        if (client) {
            setTimeout(function () {
                $('#event-calendar').fullCalendar('today');
            });
        }


        //autoload the event popover
        var encrypted_event_id = "<?php echo isset($encrypted_event_id) ? $encrypted_event_id : ''; ?>";

        if (encrypted_event_id) {
            $("#show_event_hidden").attr("data-post-id", encrypted_event_id);
            $("#show_event_hidden").trigger("click");
        }
        $(document).on('change', '#inputStatus', function(event) {
            $('#event-calendar').fullCalendar( 'refetchEvents' );
        });
        $(document).on('change', '#assignTo', function(event) {
            $('#event-calendar').fullCalendar( 'refetchEvents' );
        });

    });
</script>