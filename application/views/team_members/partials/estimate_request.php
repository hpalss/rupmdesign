<style type="text/css">
    .buttons-print{
        display: none !important;
    }
</style>
<div id="page-content" class="p20 clearfix">
    <div class="panel panel-default">
        <div class="page-title clearfix">
            <h1> <?php echo lang('bidding_requests'); ?></h1>
        </div>
        <div class="table-responsive">
            <p class="bid_statistics">
                <?=lang('pending')."(".$biddingCounts['pending'].")";?>
                <?=lang('send')."(".$biddingCounts['send'].")";?>
                <?=lang('accepted')."(".$biddingCounts['accepted'].")";?>
                <?=lang('canceled')."(".$biddingCounts['canceled'].")";?>
                <?=lang('rejected')."(".$biddingCounts['rejected'].")";?>
                <?=lang('total_bids')."(".$biddingCounts['totalBid'].")";?>
                    
                </p>
            <table id="estimate-request-table" class="display" cellspacing="0" width="100%">            
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?php $categories = estimateCategories(true); ?>
    $(document).ready(function () {
        $("#estimate-request-table").appTable({
            source: '<?php echo_uri("bidding/bidding_request_list_data") ?>',
            order: [[4, 'desc']],
            filterDropdown: [{name: "status", class: "w200", options: <?php echo $statuses_dropdown; ?>},{name: "category", class: "w150", options: <?php echo $categories; ?>},{name: "bid", class: "w150", options: [{"id":"","text":"All bids"},{"id":"1","text":"With bids"},{"id":"no_bid","text":"No bids"}]}],
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
                {title: "<?php echo lang('id'); ?>"},
                {title: "<?php echo lang('title'); ?>"},
                {title: "<?php echo lang('category'); ?>"},
                {visible: false, searchable: false},
                {title: '<?php echo lang("created_date") ?>', "iDataSort": 3},
                {visible: false, searchable: false},
                {title: '<?php echo lang("deadline") ?>',"iDataSort": 5},
                {title: "<?php echo lang('status'); ?>"},
                {title: "<i class='fa fa-bars'></i>", "class": "text-center dropdown-option w50"}
            ],
            rowCallback: function (nRow, aData) {
                var status = aData[7].replace(/<(?:.|\n)*?>/gm, '');
                if(aData[10]<3 && status=="open"){
                    if (!$(nRow).children().eq(1).find('.tag-inactive').length) {
                        $(nRow).children().eq(1).append('<br><span class="label label-default large tag-inactive">Inactive</span>');
                    }
                }else{
                    if(aData[9]==0){
                        // if deadline today make text orange
                        $(nRow).children().eq(4).css('color', 'orange');
                    }else if(aData[9]<0){
                        $(nRow).children().eq(4).css('color', 'red');
                    }else if(aData[9]<4){
                        if (!$(nRow).children().eq(1).find('.tag-urgent').length) {
                            $(nRow).children().eq(1).append('<br><span class="label label-danger large tag-urgent">Urgent</span>');
                        }
                    }
                }
            },
            printColumns: [0, 1, 2, 4, 6,7,8]
        });
    });
</script>