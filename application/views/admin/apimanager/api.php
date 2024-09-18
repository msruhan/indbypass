			<div class="workplace">
                <div class="row-fluid">

                    <div class="span12">   
                	
                	<?php
                        	echo form_open('admin/apimanager/insertapi',array('method' => 'post','id'=>'form'));
                        	echo form_hidden('apiid',$api_id);
						 	echo form_hidden('library_id',$library_id);
					?>
						<div class="head clearfix">
	                            <div class="isw-grid"></div>
	                            <h1>API Manager</h1> 
	                            <h2> ( Colored means already present ) </h2>     
	                            <ul class="buttons">
	                                <li><a href="#" class="isw-download"></a></li>
	                                <li>
	                                    <a href="#" class="isw-settings"></a>
	                                    <ul class="dd-list">
	                                        <li><a href="<?php echo site_url('admin/apimanager/add'); ?>"><span class="isw-plus"></span> New API</a></li>
	                                    </ul>
	                                </li>
	                            </ul>                        
	                       </div>
                        <div class="block-fluid table-sorting clearfix">
                            <table cellpadding="0" cellspacing="0" width="100%" class="table" id="">
                                <thead>
                                    <tr>                           
                                    	<th width="5%" ><input type="checkbox" name="checkall"/></th>             
                                        <th width="12%">Service Name</th>
                                        <th width="5%">Price</th>
                                        <th width="24%">Info</th>
                                        <th width="12%">Time</th>
                                         <th width="5%">Network</th>
                                        <th width="5%">Set Price</th>                                                                      
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$count = 0;
                                	foreach($apidata as $val)
									{
										foreach($val as $value )
										{
											$a = in_array($value['SERVICEID'], $toolid)?'1':false;
											?>
											<tr <?php echo $a == '1'?'style="background-color:#E6FFF7"':''; ?> >
										<td <?php echo $a == '1'?'style="background-color:#E6FFF7"':''; ?> ><input type="checkbox" value="<?php echo $value['SERVICEID']; ?>"
											 name="checkbox[<?php echo $count; ?>]"/></td>		
                                        <td <?php echo $a == '1'?'style="background-color:#E6FFF7"':''; ?> ><input type="text" name="ServiceName[<?php echo $count; ?>]" value="<?php echo $value['SERVICENAME']; ?>"  /></td>
                                        <td <?php echo $a == '1'?'style="background-color:#E6FFF7"':''; ?> ><input type="text" name="Credit[<?php echo $count; ?>]" value="<?php echo $value['CREDIT']; ?>"  /></td>
                                        <td <?php echo $a == '1'?'style="background-color:#E6FFF7"':''; ?> ><?php echo $value['INFO']; ?></td>
                                        <td <?php echo $a == '1'?'style="background-color:#E6FFF7"':''; ?> ><input type="text" name="Time[<?php echo $count; ?>]" value="<?php echo $value['TIME']; ?>"  /></td>
                                        <td <?php echo $a == '1'?'style="background-color:#E6FFF7"':''; ?> >
                                        <select name="network[<?php echo $count; ?>]" >
                                        <?php
                                        foreach($network as $val)
										{
											?>
											<option value="<?php echo $val['ID']; ?>" ><?php echo $val['Title']; ?></option>
											<?
										}
                                        ?>	
                                        </select>
                                        </td> 
                                           
                                        <td <?php echo $a == '1'?'style="background-color:#E6FFF7"':''; ?> ><input type="text" name="SetCredit[]" value="<?php echo $value['CREDIT']; ?>"  /></td>                                   
                                    </tr>
											<?
											echo form_hidden("networkreq[$count]",$value['Requires.Network']);
											echo form_hidden("ToolID[$count]",$value['SERVICEID']);
											echo form_hidden("mobilereq[$count]",$value['Requires.Mobile']);
											echo form_hidden("providerreq[$count]",$value['Requires.Provider']);
											echo form_hidden("pinreq[$count]",$value['Requires.PIN']);
											echo form_hidden("kbhreq[$count]",$value['Requires.KBH']);
											echo form_hidden("mepreq[$count]",$value['Requires.MEP']);
											echo form_hidden("prdreq[$count]",$value['Requires.PRD']);
											echo form_hidden("typereq[$count]",$value['Requires.Type']);
											echo form_hidden("locksreq[$count]",$value['Requires.Locks']);
											echo form_hidden("refrencereq[$count]",$value['Requires.Reference']);
											$count++;
										}
									}
                                	?>
                                </tbody>                                
                            </table>
                        </div>
                        <?php
                        	
						 	
                          	echo form_submit(array('value'=> 'Add Selected Services','class'=>'btn'));
						  	echo form_close();
                        ?>
         
                    </div>                                

                </div>            

                <div class="dr"><span></span></div>            

            </div>
<script type="text/javascript" charset="utf-8">

$(document).ready(function()
  {
	    $('#tSortable').dataTable();		
			
</script>            