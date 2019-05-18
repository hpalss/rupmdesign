<div id="page-content" class="p20 clearfix">
    <div class="panel panel-default">
        <div class="page-title clearfix">
            <h1> <?php echo lang('estimate_requests'); ?></h1>
        </div>
        <div class="table-responsive">
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
            order: [[4, 'desc']],
            filterDropdown: [{name: "status", class: "w150", options: <?php echo $statuses_dropdown; ?>},{name: "category", class: "w150", options: <?php echo $categories; ?>},{name: "bid", class: "w150", options: [{"id":"","text":"All bids"},{"id":"1","text":"With bids"},{"id":"0","text":"No bids"}]}],
            columns: [
                {title: "<i class='fa fa-list'></i>"},
                {title: "<?php echo lang('id'); ?>"},
                {title: "<?php echo lang('title'); ?>"},
                {title: "<?php echo lang('category'); ?>"},
                {title: "<?php echo lang('client'); ?>"},
                {visible: false, searchable: false},
                {title: '<?php echo lang("created_date") ?>', "iDataSort": 4},
                {visible: false, searchable: false},
                {title: '<?php echo lang("deadline") ?>'},
                {title: "<?php echo lang('status'); ?>"},
                {title: "<?php echo lang('bids'); ?>","class": "text-center dropdown-option"},
                {title: "<i class='fa fa-bars'></i>", "class": "text-center dropdown-option w50"}
            ],
            rowCallback: function (nRow, aData) {
                console.log(aData[13],aData[12]);
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
                            $(nRow).children().eq(2).append('<br><span class="label label-grass large">Urgent</span>');
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