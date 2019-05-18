<style type="text/css">.post-file-previews {border:none !important; }</style>
<div id="page-content" class="p20 clearfix">
    <div id="estimate-form-container">
        <?php
        echo form_open(get_uri("estimate_requests/update_estimate_request_data"), array("id" => "estimate-request-form", "class" => "general-form", "role" => "form"));
        echo "<input type='hidden' name='form_id' value='$model_info->id' />";
        echo "<input type='hidden' name='estimate_id' value='$estimate_data->id' />";?>

<div id="estimate-form-preview" class="panel panel-default  p15 no-border clearfix post-dropzone" style="max-width: 1000px; margin: auto;">

    <h3 id="estimate-form-title" class=" pl10 pr10"> <?php echo $model_info->title; ?></h3>

    <div class="pl10 pr10">
        <?php echo nl2br($model_info->description); ?>
    </div>
    <div class=" pt10 mt15">

        <div class="table-responsive general-form ">
            <div class="form-group">
            <label for="title" class=" col-md-3"><?php echo lang('title'); ?></label>
        <div class=" col-md-12">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "title",
                "value" => $estimate_data->title,
                "class" => "form-control",
                "placeholder" => lang('title_here'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
            <label for="category" class=" col-md-3"><?php echo lang('category'); ?></label>
            <div class=" col-md-12">
                <?= form_dropdown("category", estimateCategories(), $estimate_data->category, "id='category' class='select2'");?>
            </div>
        </div>
<div class="form-group">
            <label for="deadline" class=" col-md-3"><?php echo lang('deadline'); ?></label>
        <div class=" col-md-12">
        <?php
echo form_input(array(
    "id" => "deadline",
    "name" => "deadline",
    "value" => "",
    "class" => "form-control",
    "placeholder" => lang('deadline'),
    "data-rule-required" => true,
    "data-msg-required" => lang("field_required")
));
?>
</div>

</div>
<div class="form-group">
                    <label for="work_level" class="col-md-12"><?php echo lang('work_level'); ?></label>
                    <div class=" col-md-12">
                        <select name="work_level" id="work_level" class="form-control select2" required="required">
                            <option value=""><?=lang('work_level')?></option>
                            <option value="IEK">IEK</option>
                            <option value="College">College</option>
                            <option value="TEI">TEI</option>
                            <option value="AEI">AEI</option>
                            <option value="Postgraduate">Postgraduate</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="pages_words" class="col-md-12"><?php echo lang('pages_words'); ?></label>
                    <div class=" col-md-12">
                        <?= form_input(array(
                            "id" => "pages_words",
                            "name" => "pages_words",
                            "value" => $estimate_data->pages_words,
                            "autocomplete"=>"off",
                            "class" => "form-control",
                            "placeholder" => lang('pages_words'),
                            "data-rule-required" => true,
                            "data-msg-required" => lang("field_required")
                        ));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="required_language" class="col-md-12"><?php echo lang('required_language'); ?></label>
                    <div class=" col-md-12">
                        <select name="required_language" id="required_language" class="select2 form-control">
                            <option <?=$estimate_data->required_language=="Greek"?"selected=selected":""?> value="Greek">Greek</option>
                            <option <?=$estimate_data->required_language=="English"?"selected=selected":""?> value="English">English</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type_of_service" class="col-md-12"><?php echo lang('type_of_service'); ?></label>
                    <div class=" col-md-12">
                        <select name="type_of_service" id="type_of_service" class="select2 form-control" required="required">
                            <option value=""><?=lang('type_of_service')?></option>
                            <option <?=$estimate_data->type_of_service=="Semester work"?"selected=selected":""?> value="Semester work">Semester work</option>
                            <option <?=$estimate_data->type_of_service=="Thesis"?"selected=selected":""?> value="Thesis">Thesis</option>
                            <option <?=$estimate_data->type_of_service=="Bachelor's thesis"?"selected=selected":""?> value="Bachelor's thesis">Bachelor's thesis</option>
                            <option <?=$estimate_data->type_of_service=="Only Statistical Analysis"?"selected=selected":""?> value="Only Statistical Analysis">Only Statistical Analysis</option>
                            <option <?=$estimate_data->type_of_service=="Work Corrections"?"selected=selected":""?> value="Work Corrections">Work Corrections</option>
                            <option <?=$estimate_data->type_of_service=="Plagiarism"?"selected=selected":""?> value="Plagiarism">Plagiarism</option>
                            <option <?=$estimate_data->type_of_service=="Scientific article"?"selected=selected":""?> value="Scientific article">Scientific article</option>
                            <option <?=$estimate_data->type_of_service=="Presentation"?"selected=selected":""?> value="Presentation (PowerPoint)">Presentation (PowerPoint)</option>
                            <option <?=$estimate_data->type_of_service=="Translation"?"selected=selected":""?> value="Translation">Translation</option>
                            <option <?=$estimate_data->type_of_service=="Other"?"selected=selected":""?> value="Other">Other</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="work_type" class="col-md-12"><?php echo lang('work_type'); ?></label>
                        <div class=" col-md-12">
                            <select name="work_type" id="work_type" multiple class="select2 form-control" required="required">
                                <option value=""><?=lang('work_type')?></option>
                                <option <?=$estimate_data->work_type=="Theoretical - Bibliographical"?"selected=selected":""?> value="Theoretical - Bibliographical">Theoretical - Bibliographical</option>
                                <option <?=$estimate_data->work_type=="Quantitative - Statistical Analysis"?"selected=selected":""?> value="Quantitative Survey - Statistical Analysis">Quantitative Survey - Statistical Analysis</option>
                                <option <?=$estimate_data->work_type=="Quality Research - Interviews"?"selected=selected":""?> value="Quality Research - Interviews">Quality Research - Interviews</option>
                                <option <?=$estimate_data->work_type=="Analysis of Financial Indicators"?"selected=selected":""?> value="Analysis of Financial Indicators">Analysis of Financial Indicators</option>
                                <option <?=$estimate_data->work_type=="Experimental Part - Exercises"?"selected=selected":""?> value="Experimental Part - Exercises">Experimental Part - Exercises</option>
                                <option <?=$estimate_data->work_type=="Program - Web Application"?"selected=selected":""?> value="Program - Web Application">Program - Web Application</option>
                                <option <?=$estimate_data->work_type=="Web page"?"selected=selected":""?> value="Web page">Web page</option>
                                <option <?=$estimate_data->work_type=="Android app"?"selected=selected":""?> value="Android app">Android app</option>
                                <option <?=$estimate_data->work_type=="Other"?"selected=selected":""?> value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="course" class="col-md-12"><?php echo lang('course'); ?></label>
                    <div class=" col-md-12">
                        <?= form_input(array(
                            "id" => "course",
                            "name" => "course",
                            "value" => $estimate_data->course,
                            "autocomplete"=>"off",
                            "class" => "form-control",
                            "placeholder" => lang('course'),
                            "data-rule-required" => true,
                            "data-msg-required" => lang("field_required")
                        ));
                        ?>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="col-md-12"><?php echo lang('subject_and_observation'); ?></label>
                    <div class=" col-md-12">
                        <?= form_input(array(
                            "id" => "subject",
                            "name" => "subject",
                            "value" => $estimate_data->subject,
                            "autocomplete"=>"off",
                            "class" => "form-control",
                            "placeholder" => lang('subject_and_observation'),
                            "data-rule-required" => true,
                            "data-msg-required" => lang("field_required")
                        ));
                        ?>
                    </div>
                </div>

            <!-- <table id="estimate-form-table" class="display b-t no-thead b-b-only no-hover" cellspacing="0" width="100%">            
            </table> -->
        </div>

    </div>
    <?php if ($model_info->enable_attachment) { ?>
        <div class="clearfix pl10 pr10 b-b">
            <?php $this->load->view("includes/dropzone_preview"); ?>    
        </div>
    <?php } ?>
    <div class="p15"> 
        <?php if ($model_info->enable_attachment) { ?>
            <button class="btn btn-default upload-file-button mr15 round" type="button" style="color:#7988a2"><i class='fa fa-camera'></i> <?php echo lang("upload_file"); ?></button>
        <?php } ?>
        <button type="submit" class="btn btn-primary"><span class="fa fa-send"></span> <?php echo lang('request_an_estimate'); ?></button>
    </div>
    <?php 
        $file_formates = get_setting("accepted_file_formats");
     ?>
     <?php if ($model_info->enable_attachment) { ?>
    <div class="p15"> 
        <label class="text-default"><?=lang("allow_file_formats").$file_formates;?></label>
        <label class="text-default"><?=lang("upload_more_tip");?></label>
    </div>
    <?php } ?>
</div>

        <?=form_close();?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        // $("#estimate-request-form").appForm({
        //     isModal: false,
        //     onSubmit: function () {
        //         appLoader.show();
        //         $("#estimate-request-form").find('[type="submit"]').attr('disabled', 'disabled');
        //     },
        //     onSuccess: function (result) {
        //         appLoader.hide();
        //         window.location = "<?php echo get_uri('estimate_requests/view_estimate_request') ?>/" + result.estimate_id;
        //     }
        // });

    });
    $(document).ready(function () {
        $("#estimate-form-table").appTable({
            source: '<?php echo_uri("estimate_requests/estimate_form_filed_list_data/" . $model_info->id) ?>',
            order: [[1, "asc"]],
            hideTools: true,
            displayLength: 100,
            columns: [
                {title: "<?php echo lang("title") ?>"},
                {visible: false},
                {visible: false}
            ],
            onInitComplete: function () {
                var formData = <?=$estimate_data->description?>;
                var keys = $.map(formData, function(item, key) {
                    if($("#"+key).length){
                        if(moment(item, "YYYY-MM-DD",true).isValid()){
                            $("#"+key).val(moment(item).format("DD-MM-YYYY")).trigger('change');
                        }else{
                            $("#"+key).val(item).trigger('change');
                        }
                    }
                    return key;
                });
                $(".dataTables_empty").hide();
            }
        });
        var enable_attachment="<?php echo $model_info->enable_attachment; ?>";
        var login_user_type="<?php echo $this->login_user->user_type; ?>";

        if (enable_attachment === "1" && login_user_type==="client") {

            var uploadUrl = "<?php echo get_uri("estimate_requests/upload_file"); ?>";
            var validationUrl = "<?php echo get_uri("estimate_requests/validate_file"); ?>";
            var dropzone = attachDropzoneWithForm("#estimate-form-preview", uploadUrl, validationUrl);
        }
        $(".select2").select2();
        setDatePicker("input[name='deadline']");
        $("#deadline").val(moment("<?=$estimate_data->deadline?>").format("DD-MM-YYYY")).trigger('change');
    });
</script>