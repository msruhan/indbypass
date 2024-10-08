<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">API Update</h3>
        </div>
       	<?php echo form_open_multipart("admin/apimanager/update",array('id'=>"apimanager-validate")); ?>
        <input type="hidden" name="ID" value="<?php echo $data[0]['ID'] ?>" />
            <div class="form-body">
                <div class="form-group">
                    <label>Title:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-text-width"></i>
                        </span>
                      <?php echo form_input(array('name'=>"Title",'id'=>"Title", 'class'=>"form-control", 'value'=>set_value('Title',$data[0]['Title']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Host:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-hospital-o"></i>
                        </span>
                       <?php echo form_input(array('name'=>"Host",'id'=>"Host", 'class'=>"form-control", 'value'=>set_value('Host',$data[0]['Host']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Username:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </span>
                        <?php echo form_input(array('name'=>"Username",'id'=>"Username", 'class'=>"form-control", 'value'=>set_value('Username',$data[0]['Username']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Api Key:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </span>
                        <?php echo form_input(array('name'=>"ApiKey",'id'=>"ApiKey", 'class'=>"form-control", 'value'=>set_value('ApiKey',$data[0]['ApiKey']))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Api Type:</label>
                   <?php echo form_dropdown('ApiType', array('' => 'Select Type', 'Imei' => 'IMEI Service', 'File' => 'File Service', 'Server' => 'Server Service'), set_value('ApiType', $data[0]['ApiType']), 'class="form-control"', 'id="ApiType"'); ?>
                </div>
                <div class="form-group">
                    <label>Api Library:</label>
                    <select name="LibraryID" id="LibraryID" class="form-control">
                        <option value="">Select Api</option>
						<?php
							foreach($library as $key => $val)
							{
								?>
								<option value="<?php echo $val["ID"] ?>" 
								<?php echo $val["ID"]==$data[0]['LibraryID']?
								'selected="selected"':'' ?>	 >
									<?php echo $val["Title"]; ?></option>
								<?Php
							}
						?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <?php echo form_dropdown('Status', ['Enabled'=>'Enabled', 'Disabled'=>'Disabled'], set_value('Status', $data[0]['Status']), 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
