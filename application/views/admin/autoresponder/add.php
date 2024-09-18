<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Payment Update</h3>
        </div>
      <?php echo form_open_multipart("admin/autoresponder/insert",array('id'=>"autoresponder-validate")); ?>
            <div class="form-body">
                <div class="form-group">
                    <label>Title:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Title",'id'=>"Title", 'class'=>"form-control", 'value'=>set_value('Title', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>From Name:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-text-width"></i>
                        </span>
                        <?php echo form_input(array('name'=>"FromName",'id'=>"FromName", 'class'=>"form-control", 'value'=>set_value('FromName', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>From Email:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-mail-reply"></i>
                        </span>
                        <?php echo form_input(array('name'=>"FromEmail",'id'=>"FromEmail", 'class'=>"form-control", 'value'=>set_value('FromEmail', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>To Email:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-mail-forward"></i>
                        </span>
                        <?php echo form_input(array('name'=>"ToEmail",'id'=>"ToEmail", 'class'=>"form-control", 'value'=>set_value('ToEmail', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Subject:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-bookmark"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Subject",'id'=>"Subject", 'class'=>"form-control", 'value'=>set_value('Subject', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo form_textarea(array('id'=>"Message",'name'=>"Message",  'style' =>"height: 500px;",'value'=>html_entity_decode(set_value('Message', ''))));?>
					<?php echo display_ckeditor($ckeditor); ?>	
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <?php echo form_dropdown('Status', ['Enabled'=>'Enabled', 'Disabled'=>'Disabled'], set_value('Status'), 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>