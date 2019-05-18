<div class="panel">

    <?php if ($this->login_user->user_type == "staff") { ?>
        <div class="tab-title clearfix">
            <h4><?php echo lang('estimate_requests'); ?></h4>
        </div>
    <?php } ?>

    <div class="table-responsive">
        <table id="estimate-request-table" class="display" cellspacing="0" width="100%">
        </table>
    </div>
</div>
<script type="text/javascript">
  <?php $categories = estimateCategories(true); ?>
  <?php $statuses_dropdown = get_estimate_statuses(true); ?>
  var status = [{'id':"status",'text':'Status'},{'id':"accepted",'text':'Accepted'},{'id':"question",'text':'question'},{'id':"comment",'text':'comment'}];
    $(document).ready(function () {
        $("#estimate-request-table").appTable({
            source: '<?php echo_uri("estimate_requests/estimate_requests_list_data_of_client/" . $client_id) ?>',
            order: [[0, 'desc']],
            multiSelect: [
                {
                    name: "status",
                    text: "<?php echo lang('status'); ?>",
                    options: <?php echo $statuses_dropdown; ?>
                }
            ],
            filterDropdown: [{name: "category", class: "w150", options: <?php echo $categories; ?>},{name: "bid", class: "w150", options: [{"id":"","text":"All bids"},{"id":"1","text":"With bids"},{"id":"0","text":"No bids"}]}],
            columns: [
                {title: "<i class='fa fa-list'></i>"},
                {title: "<?php echo lang('id'); ?>"},
                {title: "<?php echo lang('title'); ?>"},
                {title: "<?php echo lang('category'); ?>"},
                {visible: false, searchable: false},
                {visible: false, searchable: false},
                {title: '<?php echo lang("created_date") ?>', "iDataSort": 4},
                {visible: false, searchable: false},
                {title: '<?php echo lang("deadline") ?>'},
                {title: "<?php echo lang('status'); ?>"},
            ],
            rowCallback: function (nRow, aData) {
                var status = aData[9].replace(/<(?:.|\n)*?>/gm, '');
                if(aData[13]>3 && status=="Open"){
                    if (!$(nRow).children().eq(2).find('.tag-inactive').length) {
                        $(nRow).children().eq(2).append('<br><span class="label label-default large tag-inactive">Inactive</span>');
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
            printColumns: [0,1, 2, 3, 4,8,9]
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
    $(document).on('dblclick', '.collapsed,.expend', function(event) {
        event.preventDefault();
    });
    $(document).on('click', '.collapsed', function(event) {
        event.preventDefault();
        var self = $(this);
        self.removeClass('collapsed').addClass('expend');
        self.children(':first').addClass('fa-arrow-right').removeClass('fa-arrow-down');
        self.parents("tr").next('tr.tr-details').remove();
    });
</script>
