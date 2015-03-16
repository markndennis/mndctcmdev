</div>

<div class="span6">
    <?php
    $attributes = $attributes = array('class' => 'form-horizontal', 'id' => 'editexaminee');
    echo form_open('admin/examinees/editexaminee/' . $result[0]['id'], $attributes);
    ?>
    <!--    <form method="post" class="form-horizontal">-->
    <div class="control-group">
        <label class="control-label" for="pin">Pin</label>
        <div class="controls">
            <input type="text" name="pin" id="pin" value="<?php echo $result[0]['pin']; ?>" disabled>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="fname">First Name</label>
        <div class="controls">
            <input type="text" name="fname" id="fname" value="<?php echo $result[0]['fname']; ?>" disabled>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="lname">Last Name</label>
        <div class="controls">
            <input type="text" name="lname" id="lname"  value="<?php echo $result[0]['lname']; ?>"disabled>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="lname">Date of Birth</label>
        <div class="controls">
            <input type="text" name="dob" id="dob"  value="<?php echo $result[0]['dob']; ?>" disabled>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="regnum">Registration #</label>
        <div class="controls">
            <input type="text" name="regnum" id="regnum"  value="<?php echo $result[0]['regnum']; ?>"disabled>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="email">Email</label>
        <div class="controls">
            <input type="text" name="email" id="email" value="<?php echo $result[0]['email']; ?>"disabled> 
        </div> 
    </div>
    <div class="control-group">
        <label class="control-label" for="exam">Exam</label>
        <div class="controls">
            <input type="text" name="examprofile" id="examprofile" value="<?php echo $result[0]['examprofile']; ?>" disabled> 
        </div> 
    </div>



    <div class="control-group">
        <label class="control-label" for="status">Approval Status</label>
        <div class="controls">
            <input type="text" name="examprofile" id="examprofile" value="<?php echo $result[0]['astatus']; ?>" disabled> 

        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="invigid">Invigilator</label>
        <div class="controls">
            <?php
            foreach ($invig as $row) {
                if ($result[0]['invigilatorID'] === $row['id']) {
                    echo '<input type="text" name="invigilator" id="invigilator" value="' . $row['fname'] . " " . $row['lname'] . " - " . $row['city'] . '" disabled>';
                }
            }
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="created">Exam Date</label>
        <div class="controls">
            <input type="text" name="examdate" id="examdate" value="<?php echo $result[0]['examdate']; ?>" disabled> 
        </div> 
    </div>
    <div class="control-group">
        <label class="control-label" for="estatus">EStatus</label>
        <div class="controls">
            <input type="text" name="estatus" id="estatus" value="<?php echo $result[0]['estatus']; ?>" disabled> 
        </div> 
    </div>
    <div class="control-group">
        <label class="control-label" for="comments">Comments</label>
        <div class="controls">
            <textarea name="comments" id="comments" disabled><?php echo $result[0]['comments']; ?></textarea>
        </div> 
    </div>
    <div class="control-group">
        <label class="control-label" for="created">Created</label>
        <div class="controls">
            <input type="text" name="create" id="created" value="<?php echo $result[0]['created']; ?>" disabled> 
        </div> 
    </div>


    <div class="control-group">
        <div class="controls">
            <button type="button" class="btn btn-danger" onclick="window.location.href = '<?php echo site_url('/admin/examinees/listexaminees'); ?>'" style="width: 225px;">Back</button>
        </div>
    </div>
</form>

</div>
<div class="span4">
    <a href="<?php echo site_url('admin/examinees/sendexamineeapprovalemail/' . $result[0]['id']); ?>">Send Approval Email</a><br>
    <a href="<?php echo site_url('exam/myexam/getresults/' . $result[0]['id']); ?>">View Exam Results</a><br>
    <a href="<?php echo site_url('/admin/examinees/editexaminee/' . $result[0]['id']); ?>">Edit Examinee</a>

</div>