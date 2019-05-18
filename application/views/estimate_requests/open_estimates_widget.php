 <div class="col-md-4 col-sm-6  widget-container">
<div class="panel panel-warning">
    <a href="<?php echo get_uri('estimate_requests'); ?>" class="white-link" >
        <div class="panel-body ">
            <div class="widget-icon">
                <i class="fa fa-life-ring"></i>
            </div>
            <div class="widget-details">
              <p><?php echo lang("open_estimates"); ?></p>
              <h1><?php echo $count["total_open"]; ?></h1>
            </div>
        </div>
    </a>
</div>
</div>
 <div class="col-md-4 col-sm-6  widget-container">
<div class="panel panel-success">
    <a href="<?php echo get_uri('estimate_requests'); ?>" class="white-link" >
        <div class="panel-body ">
            <div class="widget-icon">
                <i class="fa fa-trophy"></i>
            </div>
            <div class="widget-details">
              <p><?php echo lang("won_estimates"); ?></p>
              <h1><?php echo $count["confirm"]; ?></h1>
            </div>
        </div>
    </a>
</div>
</div>
