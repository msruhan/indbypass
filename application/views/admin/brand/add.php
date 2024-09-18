<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Brand Add</h3>
        </div>
       	<?php echo form_open_multipart("admin/brand/insert",array('id'=>"brand-validate")); ?>
            <div class="form-body">
                <div class="form-group">
                    <label>Title:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-text-width"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Title",'id'=>"Title", 'class'=>"form-control", 'value'=>set_value('Title',''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Api Brand ID:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-eye"></i>
                        </span>
                        <?php echo form_input(array('name'=>"ApiBrandID",'id'=>"ApiBrandID", 'class'=>"form-control", 'value'=>set_value('Host',''))); ?>
                    </div>
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