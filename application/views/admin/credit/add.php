<?php $status_options = ['Pending' => 'Pending', 'Issued' => 'Issued', 'Canceled' => 'Canceled', 'Verified' => 'Verified']; ?>
<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Credit Add</h3>
        </div>
		<?php echo form_open("admin/credit/insert", ['class' => "form-horizontal", 'role' => "form"]); ?>
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Member:</label>
                    <div class="col-md-6">
                        <select name="MemberID" class="form-control select2me">
                            <option value="">Select Member</option>
                            <?php foreach($member as $val): ?>
                                <option value="<?php echo $val['ID'] ?>" <?php echo set_select('MemberID', $val['ID']); ?>>
                                    <?php echo $val['FirstName'] ." ". $val["LastName"] ." (". $val["Email"] .")"; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Amount:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Amount", 'class'=>"form-control", 'value'=>set_value('Amount', ''))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Description:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_textarea(array('name'=>"Description", 'class'=>"form-control", 'value'=>set_value('Description', ''))); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>