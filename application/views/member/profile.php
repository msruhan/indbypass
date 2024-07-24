<div class="page-header">
    <div class="d-flex justify-content-between">
        <h3 class="fw-bold">Profile</h3>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Profile</a>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
        <?= $this->session->flashdata('message') ?>
        <?= form_error('FirstName', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <?= form_error('LastName', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <?= form_error('Email', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <?= form_error('CurrentPassword', '<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
        <div class="card">
            <div class="card-header">
                <div class="card-title">My Profile</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php echo form_open('member/dashboard/editprofile', array('role' => 'form', 'method' => 'post','id' => 'imeireq' ,'name' => 'form2', 'class' => 'form-horizontal', 'onsubmit' => 'openLoading()')); ?>
                    <?php echo form_hidden("ID", $data[0]['ID']); ?>
                    <div class="form-group">
                        <label class="control-label"><?php echo $this->lang->line('my_account_lb_first_name') ?></label>
                        <div class="col-8">
                            <input type="text" name="FirstName"
                                placeholder="<?php echo $this->lang->line('my_account_lb_first_name') ?>"
                                value="<?php echo $data[0]['FirstName']; ?>" required class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo $this->lang->line('my_account_lb_last_name') ?></label>
                        <div class="col-8">
                            <input type="text" name="LastName"
                                placeholder="<?php echo $this->lang->line('my_account_lb_last_name') ?>"
                                value="<?php echo $data[0]['LastName']; ?>" required class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo $this->lang->line('my_account_lb_email') ?></label>
                        <div class="col-8">
                            <input type="email" name="Email" readonly="readonly"
                                placeholder="<?php echo $this->lang->line('my_account_lb_email') ?>"
                                value="<?php echo $data[0]['Email']; ?>" required class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label
                            class="control-label"><?php echo $this->lang->line('my_account_lb_current_password') ?></label>
                        <div class="col-8">
                            <input type="password" name="CurrentPassword"
                                placeholder="<?php echo $this->lang->line('my_account_lb_current_password') ?>" required
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label
                            class="control-label"><?php echo $this->lang->line('my_account_lb_new_password') ?></label>
                        <div class="col-8">
                            <input type="password" name="NewPassword"
                                placeholder="<?php echo $this->lang->line('my_account_lb_new_password') ?>"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label
                            class="control-label"><?php echo $this->lang->line('my_account_lb_confirm_new_password') ?></label>
                        <div class="col-8">
                            <input type="password" name="ConfirmPassword"
                                placeholder="<?php echo $this->lang->line('my_account_lb_confirm_new_password') ?>"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label"><?php echo $this->lang->line('my_account_api_key') ?></label>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <input type="text" placeholder="<?php echo $this->lang->line('my_account_api_key') ?>"
                                value="<?php echo set_value('ApiKey', $data[0]['ApiKey']); ?>" class="form-control"
                                disabled="disabled">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 pt-xl-2 pt-lg-2 pt-md-0 pt-sm-0">
                            <div class="d-flex">
                                <input type="checkbox" name="ResetApiKey" value="reset">
                                <div>&nbsp;Reset API Key</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label"><?php echo $this->lang->line('my_account_server_ip') ?></label>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <input type="text" placeholder="<?php echo $this->lang->line('my_account_server_ip') ?>"
                                value="<?php echo set_value('ServerIP', $data[0]['ServerIP']); ?>" class="form-control"
                                disabled="disabled">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 pt-xl-2 pt-lg-2 pt-md-0 pt-sm-0">
                            <div class="d-flex">
                                <input type="checkbox" name="ResetServerIP" value="reset">
                                <div>&nbsp;Reset IP Bindings</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo $this->lang->line('my_account_api_status') ?></label>
                        <div class="col-8">
                            <?php echo form_dropdown('ApiStatus', ['Enabled'=>'Enabled', 'Disabled'=>'Disabled'], set_value('ApiStatus', $data[0]['ApiStatus']), 'class="form-control"'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-12 text-center">
                            <button type="submit"
                                class="btn btn-primary btn-sm"><?php echo $this->lang->line('my_account_btn_update') ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Select2 -->
<script type="text/javascript">
var base_url = "<?= base_url() ?>";
$(document).ready(function() {

    loading_processing();
    openLoading = function() {
        loadingPannel.show();
    }

});
</script>