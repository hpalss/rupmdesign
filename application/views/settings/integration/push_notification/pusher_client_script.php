<?php if (get_setting("enable_push_notification") && $this->login_user->enable_web_notification && !get_setting('user_' . $this->login_user->id . '_disable_push_notification')) { ?>

    <script type="text/javascript">
        $(document).ready(function () {

            var pusherKey = "<?php echo get_setting("pusher_key"); ?>",
                    pusherCluster = "<?php echo get_setting("pusher_cluster"); ?>",
                    pusherChannel = "user_" + "<?php echo $this->login_user->id; ?>" + "_channel";

            if (pusherKey && pusherCluster && pusherChannel) {

                var pusher = new Pusher(pusherKey, {
                    cluster: pusherCluster,
                    forceTLS: true
                });

                var channel = pusher.subscribe(pusherChannel);

                channel.bind('rise-pusher-event', function (data) {

                    if (data) {
                        //show browser notification for http or https. otherwise show app notification

                        var https = false;

    <?php if (substr(base_url(), 0, 5) == "https") { ?>
                            https = true;
    <?php } ?>

                        if (https) {
                            //browser notification
                            showBrowserNotification(data);
                        } else {
                            //app notification
                            var appAlertText = "<a class='color-white' " + data.url_attributes + ">" + data.title + " " + data.message + "</a>";
                            appAlert.info(appAlertText, {duration: 10000});
                        }

                        //check web notifications
                        notificationOptions.showPushNotification = true;
                        checkNotifications(notificationOptions);

                    }

                });

                document.addEventListener('DOMContentLoaded', function () {
                    if (!Notification) {
                        return;
                    }

                    if (Notification.permission !== "granted") {
                        Notification.requestPermission();
                    }
                });

                function showBrowserNotification(data) {
                    if (Notification.permission !== "granted") {
                        Notification.requestPermission();
                    } else {
                        var notification = new Notification(data.title, {
                            icon: data.icon,
                            body: data.message,
                            tag: data.notification_id //to prevent multiple notifications for multiple tab
                        });

                        setTimeout(notification.close.bind(notification), 10000); //show notification for 10 seconds

                        notification.onclick = function () {
                            //create notification url
                            var link = "<a id='push-notification-link-" + data.notification_id + "' " + data.url_attributes + "></a>";
                            $("#default-navbar").append(link);

                            var $linkId = $("#push-notification-link-" + data.notification_id);

                            //mark the notification as read
                            $.ajax({
                                url: '<?php echo get_uri("notifications/set_notification_status_as_read") ?>/' + data.notification_id
                            });

                            if ($linkId.attr("data-act")) {
                                //if the link is modal
                                $linkId.trigger("click");
                            } else {
                                //if the link is not a modal
                                window.location.href = $linkId.attr("href");
                            }

                            //remove link
                            $linkId.remove();

                            //remove notification
                            notification.close();

                            //select the specific tab
                            window.focus();
                        };
                    }
                }

            }
        });

    </script>

<?php } ?>