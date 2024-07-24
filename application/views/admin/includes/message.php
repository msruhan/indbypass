<?php	if($this->session->flashdata('warning') != ""){ ?>
                <div class="alert alert-warning">                
                    <strong>Warning!</strong>&nbsp;
                    <?php echo $this->session->flashdata('warning'); ?>
                </div>            
<?php	}	?>
<?php	if($this->session->flashdata('error') != ""){ ?>
                <div class="alert alert-danger">                
                    <strong>Error!</strong>&nbsp;
                    <?php echo $this->session->flashdata('error'); ?> 
                </div>            
<?php	}	?>
<?php	if($this->session->flashdata('success') != ""){ ?>
                <div class="alert alert-success">                
                    <strong>Success!</strong>&nbsp;
                    <?php echo $this->session->flashdata('success'); ?>
                </div>            
<?php	}	?>
<?php	if($this->session->flashdata('info') != ""){ ?>
                <div class="alert alert-info">&nbsp;           
                    <strong>Info!</strong>
                    <?php echo $this->session->flashdata('info'); ?>
                </div>
<?php	}	?> 
<?php echo validation_errors('<div class="alert alert-warning"><strong>Warning!</strong>&nbsp;','</div>'); ?>             