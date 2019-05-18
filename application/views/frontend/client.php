<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Request Estimate</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<!-- Main Style Css -->
	<?php
	load_css(array(
		"assets/frontend/client/css/montserrat-font.css",
		"assets/frontend/client/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css",
		"assets/frontend/client/css/style.css"
	));

    // load_js(array(
    //     "assets/js/jquery-1.11.3.min.js",
    //     // "assets/js/app.all.js"
    // ));
	?>
</head>
<body class="form-v10">
	
	<div class="page-content">
		<div class="form-v10-content">
			<?php 
	if ($message = $this->session->flashdata('error_message')) {
		echo '<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Error</strong>'. $message .'
		</div>';
	}
	if ($message = $this->session->flashdata('success_message')) {
		echo '<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Message </strong>'. $message .'
		</div>';
	}
	 ?>
			<form class="form-detail" action="<?=base_url('index.php/home/estimate_request')?>" method="post" id="myform">
				<div class="form-left">
					<h2>Registration Information</h2>
					<div class="form-group">
						<div class="form-row form-row-1">
							<input type="text" name="first_name" id="first_name" class="input-text" placeholder="First Name" required>
						</div>
						<div class="form-row form-row-2">
							<input type="text" name="last_name" id="last_name" class="input-text" placeholder="Last Name" required>
						</div>
					</div>
					<div class="form-row">
						<input type="text" name="company_name" class="company" id="company" placeholder="Company" required>
					</div>
					<div class="form-row">
						<input type="email" name="email" class="email" id="email" placeholder="Email" required>
					</div>
					<div class="form-row">
						<input type="password" name="password" class="password" id="password" placeholder="Password" required>
					</div>
					<div class="form-row">
						<input type="password" name="retype_password" class="password" id="retype_password" placeholder="Retype Password" required>
					</div>
					<div class="form-row">
						<select name="gender">
							<option value="gender">Gender</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
						<span class="select-btn">
							<i class="zmdi zmdi-chevron-down"></i>
						</span>
					</div>
					<div class="form-row">
						<label class="container"><p>Already member? <a href="<?=base_url()?>/index.php" class="text">Sign in</a></p>
							<span class="checkmark"></span>
						</label>
					</div>
				</div>
				<div class="form-right">
					<h2>Request Estimate</h2>
					<div class="form-row">
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
					<div class="form-row">
                        <select name="required_language" id="required_language" class="select2 form-control">
                            <option value="Greek">Greek</option>
                            <option value="English">English</option>
                        </select>
                    </div>
					<div class="form-row">
						<input type="date" data-date-format="DD-MMMM-YYYY" placeholder="<?=lang('deadline')?>" name="deadline" id="date-deadline" class="form-control" value="" required="required">
					</div>
					<div class="form-row">
						<div class="form-group">
							<?= form_dropdown("category", estimateCategories(), "", "class='select2'");?>
						</div>
					</div>
					<div class="form-row">
						<select name="type_of_service" id="type_of_service" class="form-control" required="required">
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
					<div class="form-row">
						<select name="work_type" id="work_type" class="form-control" required="required">
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
					<div class="form-row">
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
					<div class="form-row">
						<select name="work_level" id="work_level" class="form-control" required="required">
							<option value=""><?=lang('work_level')?></option>
						    <option value="IEK">IEK</option>
						    <option value="College">College</option>
						    <option value="TEI">TEI</option>
						    <option value="AEI">AEI</option>
						    <option value="Postgraduate">Postgraduate</option>
						    <option value="Other">Other</option>
						</select>
					</div>
					<div class="form-row">
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
					<div class="form-row">
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
						<div class="form-row-last">
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
    </div>
    <?php 
        $file_formates = get_setting("accepted_file_formats");
     ?>
    <div class="p15"> 
        <label class="text-default"><?=lang("allow_file_formats").$file_formates;?></label><br>
        <small class="text-default"><?=lang("upload_more_tip");?></small>
    </div>
        </div>
        <button type="submit" class="register"><span class="fa fa-send"></span> <?php echo lang('request_an_estimate'); ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
	<script type="text/javascript">
	</script>
	</html>
