<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable tabbable-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_0" data-toggle="tab">General</a>
                </li>
                <li>
                    <a href="#tab_1" data-toggle="tab">Mail</a>
                </li>
                <li>
                    <a href="#tab_2" data-toggle="tab">Live chat</a>
                </li>
                <li>
                    <a href="#tab_3" data-toggle="tab">Crypto Currency</a>
                </li>
                <li>
                    <a href="#tab_4" data-toggle="tab">Notification</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_0">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i>General Application Settings
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <?php echo form_open("admin/setting/update", array('class' => "form-horizontal")); ?>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Application Name</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter App Name" name="app_name" value="<?php echo set_value('app_name', $data['app_name']) ?>">
                                            <span class="help-block"> This name will be visible in entire app.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email Address</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                                <input type="email" class="form-control" placeholder="Email Address" name="app_email" value="<?php echo set_value('app_email', $data['app_email']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Default Currency</label>
                                        <div class="col-md-4">
                                            <?php echo form_dropdown('app_currency', $currency_list, set_value('app_currency', $data['app_currency']), 'class="form-control"'); ?>
                                            <span class="help-block"> This name will be default currency. </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Footer Text</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter Footer Text" name="app_footer" value="<?php echo set_value('app_footer', $data['app_footer']) ?>">
                                            <span class="help-block"> This name will be visible in footer. </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contact Us</label>
                                        <div class="col-md-4">
                                            <textarea class="form-control" rows="3" name="app_contactus" maxlength="255"><?php echo set_value('app_contactus', $data['app_contactus']) ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Referral Commission %</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter App Name" name="app_referral_commission" value="<?php echo set_value('app_referral_commission', $data['app_referral_commission']) ?>">
                                        <span class="help-block"> Commission will be given on first recharged only.</span>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>  
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_1">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i>SMTP Mail Settings
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <?php echo form_open("admin/setting/update", array('class' => "form-horizontal")); ?>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Host</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter SMTP Host" name="smtp_host" value="<?php echo set_value('smtp_host', $data['smtp_host']) ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Username</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter SMTP Username" name="smtp_username" value="<?php echo set_value('smtp_username', $data['smtp_username']) ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Password</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter SMTP Password" name="smtp_password" value="<?php echo set_value('smtp_password', $data['smtp_password']) ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Port</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Enter SMTP Port" name="smtp_port" value="<?php echo set_value('smtp_port', $data['smtp_port']) ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>  
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
                <div class="tab-pane " id="tab_2">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i>Live Chat Support Settings
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <?php echo form_open("admin/setting/update", array('class' => "form-horizontal", 'id' => "chat_form")); ?>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Integration Code</label>
                                        <div class="col-md-4">
                                            <textarea class="form-control" rows="3" id="chat_code"><?php echo set_value('chat_code', $data['chat_code']) ?></textarea>
                                            <input type="hidden" name="chat_code" id="chat_base64" value="<?php echo base64_encode(set_value('chat_code', $data['chat_code'])) ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="button" class="btn btn-info" id="btn_chat_submit">Submit</button>
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>  
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_3">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i>Crypto Currency Details
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <?php echo form_open("admin/setting/update", array('class' => "form-horizontal")); ?>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Details</label>
                                        <div class="col-md-4">
                                            <textarea class="form-control" rows="5" cols="10" name="app_cryptocurrency"><?php echo set_value('app_cryptocurrency', $data['app_cryptocurrency']) ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>  
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_4">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i>Push Notification
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <?php echo form_open("admin/setting/update", array('class' => "form-horizontal")); ?>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Text</label>
                                        <div class="col-md-4">
                                            <textarea class="form-control" rows="5" cols="10" name="push_notification"><?php echo set_value('push_notification', $data['push_notification']) ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>  
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
<script>
$( "#btn_chat_submit" ).click(function() {
    // Encode the String
    var chat_code = $('#chat_code').val();
    var encodedString = btoa(chat_code);
    $('#chat_base64').val(encodedString);
    $( "#chat_form" ).submit();
});
</script>