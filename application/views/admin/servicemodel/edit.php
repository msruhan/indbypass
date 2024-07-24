<div class="portlet">
    <div class="portlet-body form">
    	
        <div class="head clearfix">
            <div class="isw-documents"></div>
            <h3 style="padding:10px;">Brand Model Add</h3>
        </div>
       	<?php echo form_open_multipart("admin/servicemodel/update",array('id'=>"servicemodel-validate")); ?> 
        <input type="hidden" name="ModelID" value="<?php echo $data[0]['ModelID'] ?>" />
            <div class="form-body">
                <div class="form-group">
                    <label>Brand:</label>
                    <select name="BrandID" id="BrandID" class="form-control">
                            <option>Select Brand</option>
                            <?php
							foreach($brand as $key => $val)
								{
									?>
									<option value="<?php echo $val["BrandID"] ?>" 
									<?php echo $val["BrandID"]==$data[0]['BrandID']?
									'selected="selected"':'' ?>	 >
										<?php echo $val["Title"]; ?></option>
									<?Php
								}
							?>

                    </select>
                </div>
                <div class="form-group">
                    <label>Api Model ID:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-eye"></i>
                        </span>
                       <?php echo form_input(array('name'=>"ApiModelID",'id'=>"ApiModelID", 'class'=>"form-control", 'value'=>set_value('ApiModelID',$data[0]['ApiModelID']))); ?>
                    </div>
                </div>
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
