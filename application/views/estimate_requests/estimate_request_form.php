<style type="text/css">.post-file-previews {border:none !important; }</style>

<div id="estimate-form-preview" class="panel panel-default  p15 no-border clearfix post-dropzone" style="max-width: 1000px; margin: auto;">

    <h3 id="estimate-form-title" class=" pl10 pr10"> <?php echo $model_info->title; ?></h3>

    <div class="pl10 pr10"><?php echo nl2br($model_info->description); ?></div>

    <?php if (isset($clients_dropdown) && $clients_dropdown) { ?>
        <div class="form-group mt15 mb15">
            <label for="client_id" class=" col-md-12"><?php echo lang('client'); ?></label>
            <div class="col-md-12">
                <?php
                echo form_dropdown("client_id", $clients_dropdown, array(), "class='select2 validate-hidden' id='client_id' data-rule-required='true', data-msg-required='" . lang('field_required') . "'");
                ?>
            </div>
        </div>
    <?php } ?>
    <div class="col-md-9">
    <div class="pt10 mt15">
        <div class="table-responsive-2 general-form ">
            <div class="form-group">
                <label for="title" class=" col-md-12"><?= lang('title'); ?></label>
                    <div class=" col-md-12">
                        <?= form_input(array(
                            "id" => "title",
                            "name" => "title",
                            "value" => "",
                            "class" => "form-control",
                            "placeholder" => lang('title_here'),
                            "autofocus" => true,
                            "data-rule-required" => true,
                            "data-msg-required" => lang("field_required"),
                        ));
                        ?>
                    </div>
                </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
            <label for="deadline" class=" col-md-12"><?= lang('deadline'); ?></label>
                <div class=" col-md-12">
                    <?= form_input(array(
                            "id" => "date-deadline",
                            "name" => "deadline",
                            "value" => "",
                            "autocomplete"=>"off",
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
                            "value" => "",
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
                            <option value="Greek">Greek</option>
                            <option value="English">English</option>
                        </select>
                    </div>
                </div>
              </div><!-- /.col-lg-6 -->
              <div class="col-lg-6">
                <div class="form-group">
                    <label for="category" class="col-md-12"><?php echo lang('category'); ?></label>
                    <div class=" col-md-12">
                        <?= form_dropdown("category", estimateCategories(), "", "class='select2'");?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type_of_service" class="col-md-12"><?php echo lang('type_of_service'); ?></label>
                    <div class=" col-md-12">
                        <select name="type_of_service" id="type_of_service" class="select2 form-control" required="required">
                            <option value=""><?=lang('type_of_service')?></option>
                            <option value="Semester work">Semester work</option>
                            <option value="Thesis">Thesis</option>
                            <option value="Bachelor's thesis">Bachelor's thesis</option>
                            <option value="Only Statistical Analysis">Only Statistical Analysis</option>
                            <option value="Work Corrections">Work Corrections</option>
                            <option value="Plagiarism">Plagiarism</option>
                            <option value="Scientific article">Scientific article</option>
                            <option value="Presentation (PowerPoint)">Presentation (PowerPoint)</option>
                            <option value="Translation">Translation</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="work_type" class="col-md-12"><?php echo lang('work_type'); ?></label>
                        <div class=" col-md-12">
                            <select name="work_type" id="work_type" multiple class="select2 form-control" required="required">
                                <option value=""><?=lang('work_type')?></option>
                                <option value="Theoretical - Bibliographical">Theoretical - Bibliographical</option>
                                <option value="Quantitative Survey - Statistical Analysis">Quantitative Survey - Statistical Analysis</option>
                                <option value="Quality Research - Interviews">Quality Research - Interviews</option>
                                <option value="Analysis of Financial Indicators">Analysis of Financial Indicators</option>
                                <option value="Experimental Part - Exercises">Experimental Part - Exercises</option>
                                <option value="Program - Web Application">Program - Web Application</option>
                                <option value="Web page">Web page</option>
                                <option value="Android app">Android app</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="course" class="col-md-12"><?php echo lang('course'); ?></label>
                    <div class=" col-md-12">
                        <?= form_input(array(
                            "id" => "course",
                            "name" => "course",
                            "value" => "",
                            "autocomplete"=>"off",
                            "class" => "form-control",
                            "placeholder" => lang('course'),
                            "data-rule-required" => true,
                            "data-msg-required" => lang("field_required")
                        ));
                        ?>
                    </div>
                    </div>
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="subject" class="col-md-12"><?php echo lang('subject_and_observation'); ?></label>
                    <div class=" col-md-12">
                        <?= form_input(array(
                            "id" => "subject",
                            "name" => "subject",
                            "value" => "",
                            "autocomplete"=>"off",
                            "class" => "form-control",
                            "placeholder" => lang('subject_and_observation'),
                            "data-rule-required" => true,
                            "data-msg-required" => lang("field_required")
                        ));
                        ?>
                    </div>
                </div>
                </div>
              <!-- <?php foreach ($customFields as $key => $field):
                $required = "";
                if ($field->required) {
                    $required = "*";
                }?>
                <?php if ($field->field_type=="textarea"): ?>
                    <div class="col-md-12">
                    <div class='form-group'>
                    <label data-id='$field->id' class='col-md-12'><?=$field->title .$required?></label>
                    <div class="col-md-12">
                        <?=$this->load->view("custom_fields/input_" . $field->field_type, array("field_info" => $field), true)?>
                    </div>
                    </div>
                </div>
                    <?php else: ?>
                       <div class="col-lg-6 clearfix">
                    <div class='form-group'>
                    <label data-id='$field->id' class='col-md-12'><?=$field->title .$required?></label>
                    <div class="col-md-12">
                        <?=$this->load->view("custom_fields/input_" . $field->field_type, array("field_info" => $field), true)?>
                    </div>
                    </div>
                </div> 
                <?php endif ?>
                
              <?php endforeach ?> -->
            </div><!--/.row-->

    <div class=" pt10 mt15">
        <div class="table-responsive general-form ">
            <table id="estimate-form-table" class="display b-t no-thead b-b-only no-hover" cellspacing="0" width="100%">            
            </table>
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
    <div class="p15"> 
        <label class="text-default"><?=lang("allow_file_formats").$file_formates;?></label><br>
        <small class="text-default"><?=lang("upload_more_tip");?></small>
    </div>
        </div>
</div>
</div>
</div>
<div class="col-md-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Usefull tips</h3>
        </div>
        <div class="panel-body" style="overflow: hidden;">
            <?= lang("new_estimate_submit_tips") ?>
        </div>
    </div>
    </div>
    </div>


    <script type="text/javascript">
    $(document).ready(function () {
        var enable_attachment="<?php echo $model_info->enable_attachment; ?>";
        var login_user_type="<?php echo $this->login_user->user_type; ?>";

        if (enable_attachment === "1" && login_user_type==="client") {

            var uploadUrl = "<?php echo get_uri("estimate_requests/upload_file"); ?>";
            var validationUrl = "<?php echo get_uri("estimate_requests/validate_file"); ?>";
            var dropzone = attachDropzoneWithForm("#estimate-form-preview", uploadUrl, validationUrl);
        }
        $(".select2").select2();
        setDatePicker("#date-deadline",{orientation:"bottom",widgetPositioning: {
            horizontal: 'right',
            vertical: 'bottom'
        }});
    });
</script>
