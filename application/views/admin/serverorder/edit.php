<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Server Order Update</h3>
        </div>
		<?php echo form_open("admin/serverorder/update", ['class' => "form-horizontal", 'role' => "form"]); ?>
        <input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Server Box / Tool:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('ServerServiceID', $box_list, set_value('ServerServiceID', $data[0]['ServerServiceID']), 'id="ServerServiceID" class="form-control"'); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Email:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Email", 'id'=>"Email", 'type' => "email", 'class'=>"form-control", 'value'=>set_value('Email', $data[0]['Email']))); ?>
                    </div>
                </div>
                <?php
                $required_fields = $data[0]['RequiredFields'];
                if( !empty($required_fields) ):
                    $required_fields = json_decode($required_fields);
                ?>
                <?php foreach($required_fields as $k => $v): ?>
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo $k ?>:</label>
                    <div class="col-md-6 input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-font"></i>
                            </span>
                            <?php echo form_input(array('name'=>'RequiredFields['.$k.']', 'id'=>$k, 'class'=>"form-control", 'value'=>$v)); ?>
                        </span>    
                    </div>
                </div>
                <?php endforeach ?>
                <?php endif ?>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Code:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Code",'id'=>"Code", 'class'=>"form-control", 'value'=>set_value('Code', $data[0]['Code']))); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label">Notes:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_textarea(array('name'=>"Notes",'id'=>"Notes", 'class'=>"form-control", 'value'=>set_value('Notes', $data[0]['Notes']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Comments:</label>
                    <div class="input-group col-md-6">
                        <span class="input-group-addon">
                        <i class="fa fa-font"></i>
                        </span>
                        <?php echo form_textarea(array('name'=>"Comments",'id'=>"Comments", 'class'=>"form-control", 'value'=>set_value('Comments', $data[0]['Comments']))); ?>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Status:</label>
                    <div class="col-md-6">
                        <?php echo form_dropdown('Status', $status_list, set_value('Status', $data[0]['Status']), 'class="form-control"'); ?>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>