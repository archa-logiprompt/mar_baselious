<div class="content-wrapper" style="min-height: 348px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-ioxhost"></i> <?php echo "Add Staff Leave" ?></h1>
    </section>
    <section class="content">
        <div class="row">
            <?php if ($this->rbac->hasPrivilege('add_staff_leave', 'can_add')) { ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                           
                        </div><!-- /.box-header -->
                        <?php //echo $this->session->flashdata('msg')  ?>
                        <form id="form1" action="<?php echo site_url('admin/staff/staff_leave') ?>"   method="post" accept-charset="utf-8" enctype="multipart/form-data" >
                            <div class="box-body">

                                <?php echo $this->session->flashdata('msg') ?>


                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo "Staff list" ?> </label><small class="req"> *</small>

                                    <select name="staff" class="form-control"> 
                                        <option value="">Select</option>  
                                        <?php foreach ($resultlist as $key => $value) { ?>

                                            <option value="<?php print_r($value['id']); ?>"<?php if (set_value('purpose') == $value['name']) { ?>selected=""<?php } ?>><?php print_r($value['name']); ?></option>
                                        <?php } ?>

                                    </select>
                                    <span class="text-danger"><?php echo form_error('staff'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo "Leave Type" ?> </label><small class="req"> *</small>

                                    <select name="leave_type_id" class="form-control"> 
                                        <option value="">Select</option>  
                                        <?php foreach ($leavetype as $key => $value) { ?>

                                            <option value="<?php print_r($value['id']); ?>"<?php if (set_value('purpose') == $value['type']) { ?>selected=""<?php } ?>><?php print_r($value['type']); ?></option>
                                        <?php } ?>

                                    </select>
                                    <span class="text-danger"><?php echo form_error('leave_type_id'); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="pwd"><?php echo "Number of Leaves" ?> </label>  <small class="req"> *</small>
                                    <input type="text" class="form-control" value="<?php echo set_value('leave_no'); ?>" name="alloted_leave">
                                    <span class="text-danger"><?php echo form_error('leave_no'); ?></span>
                                </div>

                               
                                
                                <div class="form-group">
                                    <label for="pwd"><?php echo "Description" ?> </label>
                                    <textarea class="form-control" id="description" name="description" name="description" rows="3"><?php echo set_value('description'); ?></textarea>
                                    <span class="text-danger"><?php echo form_error('description'); ?></span>
                                </div>

                             

                            </div><!-- /.box-body -->


                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>

            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('visitor_book', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo "Staff List" ?> </h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->Setting_model->getCurrentSchoolName();?></br>
						<?php echo $this->lang->line('visitor'); ?> <?php echo $this->lang->line('list'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo "Staff Name" ?>
                                        </th>
                                        <th><?php echo "Added By" ?>
                                        </th>
                                        <th><?php echo "Leave Type"?>
                                        </th>
                                        <th><?php echo "Number of Old Leaves" ?>
                                        </th>
                                        <th><?php echo "Number of New Leaves" ?>
                                        </th>
                                        <th><?php echo "Description"?></th>
                                       
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($leave_list)) {
                                        ?>

                                        <?php
                                    } else {
                                        foreach ($leave_list as $key => $value) {
                                            // print_r($value);
                                            ?>
                                            <tr>
                                                <td class="mailbox-name"><?php echo $value['name']; ?></td>
                                                <td class="mailbox-name"><?php echo $value['user_id']; ?></td>

                                                <td class="mailbox-name"><?php echo $value['type']; ?></td>
                                                <td class="mailbox-name"><?php echo $value['old_alloted_leave']; ?> </td>
                                                <td class="mailbox-name"><?php echo $value['new_alloted_leave']; ?> </td>

                                                <td class="mailbox-name"> <?php echo $value['description '] ?></td>
                                               
                                                <td class="mailbox-date pull-right" "="">
                                                    <a  onclick="getRecord(<?php echo $value['id']; ?>)" class="btn btn-default btn-xs" data-target="#visitordetails" data-toggle="modal" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing" data-original-title="View"><i class="fa fa-reorder"></i></a> 
        <?php if ($value['image'] !== "") { ?>
                                                        <?php } ?> 
        <?php if ($this->rbac->hasPrivilege('visitor_book', 'can_edit')) { ?>
                                                        <a href="<?php echo base_url(); ?>admin/staff/leave_edit/<?php echo $value['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    <?php }
                                                    ?>

        <?php if ($this->rbac->hasPrivilege('visitor_book', 'can_delete')) { ?>
                                                        <?php if ($value['image'] !== "") { ?><a href="<?php echo base_url(); ?>admin/visitors/imagedelete/<?php echo $value['id']; ?>/<?php echo $value['image']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');" data-original-title="<?php echo $this->lang->line('delete'); ?>">
                                                                <i class="fa fa-remove"></i>
                                                            </a>
            <?php } else { ?>
                                                            <a href="<?php echo base_url(); ?>admin/visitors/delete/<?php echo $value['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');" data-original-title="Delete">
                                                                <i class="fa fa-remove"></i>
                                                            </a>
            <?php }
        }
        ?>
                                                </td>


                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) col-8 end-->
            <!-- right column -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- new END -->
<div id="visitordetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog2 modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('details'); ?></h4>
            </div>
            <div class="modal-body" id="getdetails">


            </div>
        </div>
    </div>
</div>
</div><!-- /.content-wrapper -->
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script type="text/javascript">





                                                $(function () {

                                                    $(".timepicker").timepicker({
                                                        // showInputs: false,
                                                        // defaultTime: false,
                                                        // explicitMode: false,
                                                        // minuteStep: 1
                                                    });
                                                });

                                                $(document).ready(function () {
                                                    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

                                                    $('#date').datepicker({
                                                        //  format: "dd-mm-yyyy",
                                                        format: date_format,
                                                        autoclose: true
                                                    });



                                                });

                                                function getRecord(id) {
                                                    //alert(id);
                                                    $.ajax({
                                                        url: '<?php echo base_url(); ?>admin/visitors/details/' + id,
                                                        success: function (result) {
                                                            //alert(result);
                                                            $('#getdetails').html(result);
                                                        }


                                                    });

                                                }

</script>
