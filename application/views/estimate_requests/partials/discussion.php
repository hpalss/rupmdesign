<div class="jumbotron">
    <div class="container">
        <h5><?=lang("discussion")?></h5>
        <div id="cStory"></div>
<?php echo form_open(get_uri("estimate_requests/save_story"), array("class" => "general-form", "role" => "form")); ?>
    <input type="hidden" name="estimate_id" id="story-estimate_id" value="<?php echo $estimate_id; ?>" />

            <?php
            echo form_textarea(array(
                "id" => "story-message",
                "name" => "message",
                "value" => "",
                "class" => "form-control",
                "placeholder" => lang('discussion_here'),
                "style" => "height:100px;",
            ));
            ?>
            <button type="submit" class="btn btn-primary" id="story-submit" style="margin-top: 10px;"><span class="fa fa-check-circle"></span> <?php echo lang('send'); ?></button>
<?php echo form_close(); ?>
    </div>
</div>
<?php
// load_css(array(
//     "assets/js/summernote/summernote.css",
//     "assets/js/summernote/summernote-bs3.css"
// ));
// load_js(array(
//     "assets/js/summernote/summernote.min.js",
//     "assets/js/bootstrap-confirmation/bootstrap-confirmation.js",
// ));
?>
<script>
    jQuery(document).ready(function($) {
        loadStory();
        // initWYSIWYGEditor("#story-message", {height: 480});
    });
        $(document).on('click', '#story-submit', function(event) {
            event.preventDefault();
            appLoader.show();
            $.ajax({
                url: "<?=get_uri("estimate_requests/save_story/")?>",
                type: 'POST',
                dataType: 'json',
                data: {estimate_id:$("#story-estimate_id").val(),message:$("#story-message").val()},
            })
            .always(function(response) {
                appLoader.hide();
                if (response.success) {
                    loadStory();
                    appAlert.success(response.message, {duration: 10000});
                } else {
                    appAlert.error(response.message, {duration: 10000});
                }
            });
        });
    function loadStory() {
        appLoader.show();
        $.ajax({
            url: "<?=get_uri("estimate_requests/get_estimate_discussion/")?>",
            type: 'POST',
            dataType: 'json',
            data: {estimate_id:"<?php echo $estimate_id; ?>"},
        })
        .always(function(response) {
            appLoader.hide();
            // if (response.success) {
                $("#cStory").html(response.data);
            // }
        });
    }
</script>