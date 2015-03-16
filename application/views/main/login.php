</div>
<div class="span6">
    <?php
    $attributes = $attributes = array('class' => 'form-horizontal', 'id' => 'login', 'autocomplete'=>'off');
    echo form_open('main/login', $attributes);
    ?>
    <!--    <form method="post" id="login" class="form-horizontal">-->
    <div class="control-group">
        <label class="control-label" for="username">Username</label>
        <div class="controls">
            <input type="text" name="username" id="username" placeholder="Username"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
            <input type="password" name="password" id="password" placeholder="Password"/>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn">Sign in</button>
<?php echo "<span style='color:red'>" . validation_errors(); ?>
        </div>
    </div>
</form>
</div>
<!--<div class="span3"> 
    <a href="">Change Password</a> 
</div>-->

<script>
    $("#login").validate({
        rules: {
            username: "required",
            password: "required"}
    });
</script>


