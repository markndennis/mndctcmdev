</div>

<div class="span5">

    <?php
    $attributes = array('class' => 'form-horizontal', 'id' => 'addinvigilator');
    echo form_open('admin/invigilators/postinvigilator', $attributes);
    ?>

    <div class="control-group">
        <label class="control-label" for="fname">First Name</label>
        <div class="controls">
            <input type="text" name="fname" id="fname" placeholder="First Name" value="<?php echo set_value('fname'); ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="lname">Last Name</label>
        <div class="controls">
            <input type="text" name="lname" id="lname" placeholder="Last Name" value="<?php echo set_value('lname'); ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="email">Email</label>
        <div class="controls">
            <input type="text" name="email" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>"> 
        </div> 
    </div>
    <div class="control-group">
        <label class="control-label" for="city">City</label>
        <div class="controls">
            <input type="text" name="city" id="city" placeholder="City" value="<?php echo set_value('city'); ?>"> 
        </div> 
    </div>
    <div class="control-group">
        <label class="control-label" for="province">Province</label>
        <div class="controls">
            <input type="text" name="province" id="province" placeholder="Province" value="<?php echo set_value('province'); ?>"> 
        </div> 
    </div>
    <div class="control-group">
        <label class="control-label" for="country">Country</label>
        <div class="controls">
            <input type="text" name="country" id="country" placeholder="Country" value="<?php echo set_value('country'); ?>"> 
        </div> 
    </div>
    <div class="control-group">
        <label class="control-label" for="institution">Institution</label>
        <div class="controls">
            <input type="text" name="institution" id="institution" placeholder="location" value="<?php echo set_value('institution'); ?>"> 
        </div> 
    </div>
    <div class="control-group">
        <label class="control-label" for="username">Username</label>
        <div class="controls">
            <input type="text" name="username" id="username" placeholder="username" value="<?php echo set_value('username'); ?>"> 
        </div> 
    </div>

    <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
            <input type="text" name="password" id="password" placeholder="password" value="<?php echo set_value('password'); ?>" > 
        </div> 
    </div>

    <div class="control-group">
        <label class="control-label" for="contact">Published Contact Info</label>
        <div class="controls">
            <textarea  name="contact" id="contact" placeholder="Published Contact Info"><?php echo set_value('contact'); ?></textarea>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn">Add</button>
        </div>
    </div>
</form>

<script>		
 	$("#addinvigilator").validate({
		errorClass: "errors",
		rules: {
			fname: "required",
			lname: "required",
			// email: {
			// 	required: true,
			// 	email: true,
			// },
			city: "required",
  			username: "required",
								  
		messages: {
			fname: "please enter a first name",
			lname: "please enter a last name",
			// email: {
			// 	required: "Please enter an email",
			// 	email: "Please ensure email is valid",
			// },
			city: "please enter a city",
 			username: "please enter a username"
		}	  
	});
	

</script>

<style>
	.errors {
	color: red;
	}
</style>