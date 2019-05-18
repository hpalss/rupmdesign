<div id="page-content" class="p20 clearfix">
    <div class="panel panel-default">
        <div class="page-title clearfix">
            <h1> <?php echo lang('estimate_requests'); ?></h1>

            <div class="tab-title clearfix no-border">
                <div class="title-button-group">
                    <?php echo modal_anchor(get_uri("estimate_requests/request_an_estimate_modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('create_estimate_request'), array("class" => "btn btn-default", "title" => lang('create_estimate_request'))); ?>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <div class="box">
                <div class="box-content widget-container b-r">
                    <div class="panel-body ">
                        <h1 class=""><?php echo $biddingCounts['estimated']; ?></h1>
                        <span class="text-off uppercase label-status"><?php echo status_label("estimated"); ?></span>
                    </div>
                </div>
                <div class="box-content widget-container b-r">
                    <div class="panel-body ">
                        <h1 class=""><?php echo $biddingCounts['open']; ?></h1>
                        <span class="text-off uppercase label-status"><?php echo status_label("open"); ?></span>
                    </div>
                </div>
                <div class="box-content widget-container b-r">
                    <div class="panel-body ">
                        <h1 class=""><?php echo $biddingCounts['confirm']; ?></h1>
                        <span class="text-off uppercase label-status"><?php echo status_label("confirm"); ?></span>
                    </div>
                </div>
                <div class="box-content widget-container ">
                    <div class="panel-body ">
                        <h1><?php echo  $biddingCounts['accepted'] ?></h1>
                        <span class="text-off uppercase label-status"><?php echo status_label("accepted"); ?></span>
                    </div>
                </div>
                <div class="box-content widget-container ">
                    <div class="panel-body ">
                        <h1><?php echo  $biddingCounts['canceled'] ?></h1>
                        <span class="text-off uppercase label-status"><?php echo status_label("canceled"); ?></span>
                    </div>
                </div>
                <div class="box-content widget-container ">
                    <div class="panel-body ">
                        <h1><?php echo  $biddingCounts['rejected'] ?></h1>
                        <span class="text-off uppercase label-status"><?php echo status_label("rejected"); ?></span>
                    </div>
                </div>
                <div class="box-content widget-container ">
                    <div class="panel-body ">
                        <h1><?php echo  $biddingCounts['totalBid'] ?></h1>
                        <span class="text-off uppercase label-status"><span class="label label-disabled large"><?=lang("total")?></span></span>
                    </div>
                </div>
            </div>
            <table id="estimate-request-table" class="display" cellspacing="0" width="100%">            
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?php $categories = estimateCategories(true); ?>
    $(document).ready(function () {
        $("#estimate-request-table").appTable({
            source: '<?php echo_uri("estimate_requests/estimate_request_list_data") ?>',
            order: [[5, 'desc']],
            multiSelect: [
                {
                    name: "status",
                    text: "<?php echo lang('status'); ?>",
                    options: <?php echo $statuses_dropdown; ?>
                }
            ],
            filterDropdown: [{name: "category", class: "w150", options: <?php echo $categories; ?>},{name: "bid", class: "w100", options: [{"id":"","text":"All bids"},{"id":"1","text":"With bids"},{"id":"no_bid","text":"No bids"}]}],
            singleDatepicker: [{name: "deadline", defaultText: "<?php echo lang('deadline') ?>",
                    options: [
                        {value: "expired", text: "<?php echo lang('expired') ?>"},
                        {value: moment().format("YYYY-MM-DD"), text: "<?php echo lang('today') ?>"},
                        {value: moment().add(1, 'days').format("YYYY-MM-DD"), text: "<?php echo lang('tomorrow') ?>"},
                        {value: moment().add(7, 'days').format("YYYY-MM-DD"), text: "<?php echo sprintf(lang('in_number_of_days'), 7); ?>"},
                        {value: moment().add(15, 'days').format("YYYY-MM-DD"), text: "<?php echo sprintf(lang('in_number_of_days'), 15); ?>"}
                    ]},{name: "created_at", defaultText: "<?php echo lang('created') ?>",
                    options: [
                        {value: moment().format("YYYY-MM-DD"), text: "<?php echo lang('today') ?>"},
                        {value: moment().subtract(3, 'days').format("YYYY-MM-DD"), text: "<?php echo sprintf(lang('days_ago'), 3); ?>"},
                        {value: moment().subtract(7, 'days').format("YYYY-MM-DD"), text: "<?php echo sprintf(lang('days_ago'), 7); ?>"},
                        {value: moment().subtract(15, 'days').format("YYYY-MM-DD"), text: "<?php echo sprintf(lang('days_ago'), 15); ?>"}
                    ]}],
            columns: [
                {title: "<i class='fa fa-list'></i>"},
                {title: "<?php echo lang('id'); ?>"},
                {title: "<?php echo lang('title'); ?>"},
                {title: "<?php echo lang('category'); ?>"},
                {title: "<?php echo lang('client'); ?>"},
                {visible: false, searchable: false},
                {title: '<?php echo lang("created_date") ?>', "iDataSort": 5},
                {visible: false, searchable: false},
                {title: '<?php echo lang("deadline") ?>', "iDataSort": 7},
                {title: "<?php echo lang('status'); ?>"},
                {title: "<?php echo lang('bids'); ?>","class": "text-center dropdown-option"},
                {title: "<i class='fa fa-bars'></i>", "class": "text-center dropdown-option w50"}
            ],
            rowCallback: function (nRow, aData) {
                var status = aData[9].replace(/<(?:.|\n)*?>/gm, '');
                if(aData[13]>3 && status=="Open"){
                    if (!$(nRow).children().eq(2).find('.tag-inactive').length) {
                        $(nRow).children().eq(2).append('<br><span class="label label-default large tag-inactive">Inactive</span>');
                        // $(nRow).children().eq(5).css('color', 'red');
                    }
                }else{
                    if(aData[12]==0){
                        $(nRow).children().eq(6).css('color', 'orange');
                    }else if(aData[12]<0){
                        $(nRow).children().eq(6).css('color', 'red');
                    }else if(aData[12]<4){
                        if (!$(nRow).children().eq(2).find('.tag-urgent').length) {
                            $(nRow).children().eq(2).append('<br><span class="label label-danger large tag-urgent">Urgent</span>');
                        }
                    }
                }
            },
            printColumns: [0, 1, 2, 3, 4,6,8,9,11]
        });

    });
    $(document).on('click', '.expend', function(event) {
        event.preventDefault();
        var self = $(this);
        var url = self.attr('data-action-url');
        var estimateId = self.attr('data-id');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            data: {estimateId: estimateId},
        })
        .always(function(html) {
            self.parents("tr").after(html);
            self.addClass('collapsed').removeClass('expend');
            self.children(':first').addClass('fa-arrow-down').removeClass('fa-arrow-right');
        });
        
    });
    $(document).on('click', '.collapsed', function(event) {
        event.preventDefault();
        var self = $(this);
        self.removeClass('collapsed').addClass('expend');
        self.children(':first').addClass('fa-arrow-right').removeClass('fa-arrow-down');
        self.parents("tr").next('tr.tr-details').remove();
    });
    $(document).on('dblclick', '.collapsed,.expend', function(event) {
        event.preventDefault();
    });
</script>
