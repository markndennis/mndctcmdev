<p class="well">Thank you <strong><?php echo $examineename; ?></strong>.  Your exam is now complete.  It will be scored and you will receive your results directly from CTCMABC.<br>Your invigilator will now sign you out.</p>

<?php
    $attributes = $attributes = array('class' => 'form-horizontal', 'id' => 'invigcomments', 'autocomplete'=>'off');
    echo form_open('exam/myexam/invigilatorcomments/' . $eid, $attributes);
    ?>
    <fieldset>
        <legend>Invigilator Sign Out</legend>
        <div class="control-group">
            <label class="control-label" for="username">Invigilator Username</label>
            <div class="controls">
                <input type="text" name="username" id="username" placeholder="Invigilator Username" required/>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input type="password" name="password" id="password" placeholder="Password" required/>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="comments">Comments</label>
            <div class="controls">
                <textarea name="comments" id="comments" placeholder="Please Enter Any Comments Here"></textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-danger">Signout Exam Session for<br> <?php echo $examineename; ?></button>
                    
            </div>
        </div>
    </fieldset>
</form>
<div>
    
 <script>
$("#invigsignout").validate();
</script>
