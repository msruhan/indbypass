<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">IMEI Order Update</h3>
        </div>
		<?php echo form_open("admin/member/filemembermethod", ['class' => "form-horizontal", 'role' => "form"]); ?>
        <input type="hidden" name="ID" value="<?php echo $MemberID ?>" />
            <div class="form-body">
            <?php foreach($file_methods as $val): ?>
				<div class="form-group">
                    <label class="col-md-3 control-label"><?php echo $val['Title']; ?>:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-tag"></i>
                        </span>
                        <?php echo form_input(array('name' => "Title[]", 'class'=>"form-control", 'value' => set_value('FirstName', $val['Price']))); ?>
                       <input type="hidden" value="<?php echo $val['FileServiceID'] ?>" name="FileServiceID[]" />
                    </div>
                </div>
            <?php endforeach ?>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>