</div>

<div class="span9">
	<?php
    $attributes = array('class' => 'form-horizontal', 'id' => 'understood');
    echo form_open('admin/invigilators/listinvigilators', $attributes);
    ?>
    <div class="well"><strong><?php echo $message; ?></strong><br/><br/>
    <input type='submit' class="btn btn-danger" id="understood" value="Understood" /> 
    </div> 
	
	</form>
</div>

<!-- <script>
		
	$('#understood').click(function(){						 
		window.location.replace(<?php echo site_url('admin/invigilators/listinvigilators'); ?>);
    });
	
</script> -->