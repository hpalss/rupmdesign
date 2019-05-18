<?php

if ($notification->task_id && $notification->task_title) {
    echo "<div>" . lang("task") . ": #$notification->task_id - " . $notification->task_title . "</div>";
}

if ($notification->activity_log_changes !== "") {
    if (count($changes_array)) {
        echo "<ul>";
        foreach ($changes_array as $change) {
            //don't show the change log if there is any html tag
            if ($change == strip_tags($change)) {
                echo $change;
            }
        }
        echo "</ul>";
    }
}

if ($notification->payment_invoice_id) {
    echo "<div>" . to_currency($notification->payment_amount, $notification->client_currency_symbol) . "  -  " . get_invoice_id($notification->payment_invoice_id) . "</div>";
}

if ($notification->ticket_id && $notification->ticket_title) {
    echo "<div>" . get_ticket_id($notification->ticket_id) . " - " . $notification->ticket_title . "</div>";
}

if ($notification->leave_id && $notification->leave_start_date) {
    $leave_date = format_to_date($notification->leave_start_date, FALSE);
    if ($notification->leave_start_date != $notification->leave_end_date) {
        $leave_date = sprintf(lang('start_date_to_end_date_format'), format_to_date($notification->leave_start_date, FALSE), format_to_date($notification->leave_end_date, FALSE));
    }
    echo "<div>" . lang("date") . ": " . $leave_date . "</div>";
}

if ($notification->project_comment_id && $notification->project_comment_title && ($notification->project_comment_title == strip_tags($notification->project_comment_title))) {
    echo "<div>" . lang("comment") . ": " . convert_mentions($notification->project_comment_title, false) . "</div>";
}

if ($notification->project_file_id && $notification->project_file_title) {
    echo "<div>" . lang("file") . ": " . remove_file_prefix($notification->project_file_title) . "</div>";
}


if ($notification->project_id && $notification->project_title) {
    echo "<div>" . lang("project") . ": " . $notification->project_title . "</div>";
}
if ($notification->estimate_request_id && $notification->estimate_request_title) {
    echo "<div><span class='label label-warning'>" . lang($notification->estimate_request_category) . "</span><br> " . $notification->estimate_request_title . "</div>";
}

if ($notification->estimate_id) {
    echo "<div>" . get_estimate_id($notification->estimate_id) . "</div>";
}

if ($notification->event_title) {
    echo "<div>" . lang("event") . ": " . $notification->event_title . "</div>";
}

if ($notification->announcement_title) {
    echo "<div>" . lang("title") . ": " . $notification->announcement_title . "</div>";
}