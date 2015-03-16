</div>

<div class="span9">
    <div class="well">I certify that I have confirmed the identity of exam candidate <strong><u><?php echo $examinee[0]['fname'] . " " . $examinee[0]['lname']; ?></u></strong> and will supervise the <strong><u><?php echo $examinee[0]['examprofile']; ?></u></strong> exam for <strong><u><?php echo $examinee[0]['fname'] . " " . $examinee[0]['lname']; ?></u></strong> registration number <strong><u><?php echo $examinee[0]['regnum']; ?></u></strong> according to the invigilation rules of the College of Traditional Chinese Medicine Practitioners and Acupuncturists of British Columbia.<br/><br/>
        <button class="btn btn-danger" id="agree">I, <?php echo $invigilator[0]['fname'] . " " . $invigilator[0]['lname']; ?> agree to the above</button>
    </div>
    <div id="dialog" title="Exam Start" > Please pass control of the computer to the examinee and press start</div>
</div>

<script>
	
		
	$("#agree").click(function(){						 
        $("#dialog").dialog("open");
    });
	
	$("#dialog").dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            "Start": function() {
                // logout invigilator 
                $.get("<?php echo site_url('main/logout'); ?>");
                // refresh page
				//window.location = './';
                // start exam
                window.open('<?php echo site_url('exam/myexam/buildexam') . "/" . $examinee[0]['id']; ?>');

            },
            "Cancel": function() {
                $(this).dialog("close");
            }
        }
    });
</script>