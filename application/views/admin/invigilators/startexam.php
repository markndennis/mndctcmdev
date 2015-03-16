

<div class="row-fluid">
    <div class="span2">

    </div>
    <div class="span9">

        <div class="well">
            You can start the exam by clicking on the following button.  The exam candidate will have an opportunity to review the exam instructions prior to starting the exam:<br><br>

            <button style="margin-left: 20%;" class="btn-danger" onclick="redir()" >Click Here To Start The Exam For <?php echo $ename ?></button></div>
    </div>

    <script>
        function redir() {
            eurl = "<?php echo site_url('exam/myexam/buildexam') . "/" . $eid; ?>";
            window.open(eurl, '_blank');
        }
        ;
    </script>




