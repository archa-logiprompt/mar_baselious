<style type="text/css">
    .nav-tabs-custom>.nav-tabs>li.active {
        border-top-color: #faa21c;
    }
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('human_resource'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo "Leave Report"?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" action="<?php echo site_url('admin/staff/leave_report') ?>" method="post" class="form-horizontal">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label><?php echo "Staff List" ?></label>
                                            <select name="staff_list" class="form-control">
                                                <option value="select"><?php
                                                    echo $this->lang->line(
                                                            'select')
                                                    ?></option>
                                                <?php foreach ($resultlist as $key => $stafflist) { ?>
                                                    <option <?php
                                                        if ($stafflist["name"] == $role_select) {
                                                            echo "selected";
                                                        }
                                                        ?> value="<?php echo $stafflist["id"] ?>"><?php echo $stafflist["name"]; ?></option>
<?php } ?>   
                                            </select>
                                            <span class="text-danger"><?php echo form_error('role'); ?></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label><?php echo "Leave Type List" ?></label>
                                            <select name="type" class="form-control">
                                                <option value=""><?php
                                                    echo $this->lang->line(
                                                            'select')
                                                    ?></option>
                                                <?php foreach ($leavetype as $key => $type) { ?>
                                                    <option <?php
                                                        if ($type["type"] == $role_select) {
                                                            echo "selected";
                                                        }
                                                        ?> value="<?php echo $type["id"] ?>"><?php echo $type["type"]; ?></option>
<?php } ?>   
                                            </select>
                                            <span class="text-danger"><?php echo form_error('role'); ?></span>
                                        </div>
                                       
                                     
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<?php if (isset($result)) {
    ?>
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo "Staff Leave Report" ?></h3>
                        </div>      
                        <div class="box-body table-responsive">     
                            <div class="tab-content">
                                <div class="tab-pane active table-responsive" id="tab_parent">
                                    <div class="download_label"><?php echo "Staff Leave Report" ?> <?php echo $month . " " . $year; ?></div>
                                    <table class="table table-striped table-bordered table-hover example table-fixed-header">
                                        <thead class="header">
                                            <tr>



                                                <th><?php echo $this->lang->line('name'); ?></th>
                                                <th><?php echo "Leave Type"?></th>
                                                <th><?php echo "Old Allocated Leave"?></th>
                                                <th><?php echo "New Allocated Leave"?></th>


                                                <th><?php echo "Total Allocated Leave"?></th>

                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    if (empty($result)) {
                                        ?>

                                        <?php
                                    } else {
                                        foreach ($result as $key => $value) {
                                            // print_r($value);
                                            ?>
                                            <tr>
                                                <td class="mailbox-name"><?php echo $value['name']; ?></td>
                                                <td class="mailbox-name"><?php echo $value['type']; ?></td>
                                                <td class="mailbox-name"><?php echo $value['old_alloted_leave']; ?></td>

                                                <td class="mailbox-name"><?php echo $value['new_alloted_leave']; ?></td>


                                                <td class="mailbox-name">
    <?php 
    if (empty($value['old_alloted_leave']) && empty($value['new_alloted_leave'])) {
        echo $value['alloted_leave'];
    } else {
        echo (int)$value['old_alloted_leave'] + (int)$value['new_alloted_leave'];
    }
    ?>
</td>
                                               


                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                                    </table>
                                </div>    


                            </div>

                        </div>
                    </div><!--./tabs--> 
    <?php
}
?>
            </div>  
        </div>

    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $(".date").datepicker({
            format: date_format,
            autoclose: true,
            todayHighlight: true
        });
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    })
    $(document).ready(function () {
        $('.table-fixed-header').fixedHeader();
    });

    (function ($) {

        $.fn.fixedHeader = function (options) {
            var config = {
                topOffset: 50

            };
            if (options) {
                $.extend(config, options);
            }

            return this.each(function () {
                var o = $(this);

                var $win = $(window);
                var $head = $('thead.header', o);
                var isFixed = 0;
                var headTop = $head.length && $head.offset().top - config.topOffset;

                function processScroll() {
                    if (!o.is(':visible')) {
                        return;
                    }
                    if ($('thead.header-copy').size()) {
                        $('thead.header-copy').width($('thead.header').width());
                    }
                    var i;
                    var scrollTop = $win.scrollTop();
                    var t = $head.length && $head.offset().top - config.topOffset;
                    if (!isFixed && headTop !== t) {
                        headTop = t;
                    }
                    if (scrollTop >= headTop && !isFixed) {
                        isFixed = 1;
                    } else if (scrollTop <= headTop && isFixed) {
                        isFixed = 0;
                    }
                    isFixed ? $('thead.header-copy', o).offset({
                        left: $head.offset().left
                    }).removeClass('hide') : $('thead.header-copy', o).addClass('hide');
                }
                $win.on('scroll', processScroll);

                // hack sad times - holdover until rewrite for 2.1
                $head.on('click', function () {
                    if (!isFixed) {
                        setTimeout(function () {
                            $win.scrollTop($win.scrollTop() - 47);
                        }, 10);
                    }
                });

                $head.clone().removeClass('header').addClass('header-copy header-fixed').appendTo(o);
                var header_width = $head.width();
                o.find('thead.header-copy').width(header_width);
                o.find('thead.header > tr:first > th').each(function (i, h) {
                    var w = $(h).width();
                    o.find('thead.header-copy> tr > th:eq(' + i + ')').width(w);
                });
                $head.css({
                    margin: '0 auto',
                    width: o.width(),
                    'background-color': config.bgColor
                });
                processScroll();
            });
        };

    })(jQuery);

</script>
