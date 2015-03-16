
<div class="span12">
    <br><br>
    <form style="margin: 0 auto; width:500px;" method="post" action="http://markndennis.com/CTCMBC/index.php?/admin/logger/savelog">
        <div class="well">
            <strong>Are you sure you want to archive the log files?</strong>&nbsp;
            <input type="button" class="btn-danger" onclick="processresp('Yes')" value="Yes">
            <input type="button" class="btn-success" onclick="processresp('No')" value="No">
        </div>

    </form>


<script>
    function processresp(val) {
        //var val = $("input[type=button][clicked=true]").val();

        if (val === "Yes") {
            //alert("val is yes");
            purl = "<?php echo site_url('admin/logger/loggit'); ?>";
            //alert(purl);
            window.location = purl;
        } else {
            //alert("val is no");
            purl = "<?php echo site_url('admin/logger/listlog'); ?>";
            //alert(purl);
            window.location = purl;
        }
    }
</script>


