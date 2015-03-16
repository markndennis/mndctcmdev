<div class="span10">

    <button id='back' class="btn btn-success">back</button>&nbsp;<button id='forward' class="btn btn-success" >forward</button>
</div>
<div class="span5" style="height:450px;">

    <hr>
    <div id='ques' class="help-block" style="height: 175px; padding-left: 30px ;
    text-indent: -30px ;"></div>
    <hr>
    <div style="padding-left: 50px;">
        <div id='r1'></div>
        <div id='r2'></div>
        <div id='r3'></div>
        <div id='r4'></div>
    </div>


    <?php //echo $ques[0]['qtext']; ?>



</div>
<div class="span5" style="height:450px;">
    <hr>
    <div id='ques_c' class="help-block" style="height: 175px; padding-left: 30px ;
    text-indent: -30px"></div>
    <hr>
    <div style="padding-left: 50px;">
        <div id='r1_c'></div>
        <div id='r2_c'></div>
        <div id='r3_c'></div>
        <div id='r4_c'></div>
    </div>
</div>

<script>

    //convert PHP to Array
    var $quesarray = <?php echo json_encode($ques); ?>;
    var $maxqnum = $quesarray.length;
    //alert($maxqnum);
    var $qnum = 0;
    displayques($qnum);



    $('#back').click(function() {
        if ($qnum === 0) {
            $qnum = $maxqnum - 1;
        } else {
            $qnum--;
        }
        displayques($qnum);
    });

    $('#forward').click(function() {
        if ($qnum === $maxqnum - 1) {
            $qnum = 0;
        } else {
            $qnum++;
        }
        displayques($qnum);
    });

    function displayques($qnum) {
        //alert("called with " + $qnum);
        $('#ques').html("<strong>" + ($qnum + 1) + ".)&nbsp;&nbsp;" + $quesarray[$qnum]['qtext'] + "</strong>");
        $('#r1').html('<label class="radio"><input type="radio" name="response" id="A" value="A">' + $quesarray[$qnum]['r1'] + '</label>');
        $('#r2').html('<label class="radio"><input type="radio" name="response" id="B" value="B">' + $quesarray[$qnum]['r2'] + '</label>');
        $('#r3').html('<label class="radio"><input type="radio" name="response" id="C" value="C">' + $quesarray[$qnum]['r3'] + '</label>');
        $('#r4').html('<label class="radio"><input type="radio" name="response" id="D" value="D">' + $quesarray[$qnum]['r4'] + '</label>');

        $('#ques_c').html("<strong>" + ($qnum + 1) + ".)&nbsp;&nbsp;" + $quesarray[$qnum]['qtext_c'] + "</strong>");
        $('#r1_c').html('<label class="radio"><input type="radio" name="response" id="A" value="A">' + $quesarray[$qnum]['r1_c'] + '</label>');
        $('#r2_c').html('<label class="radio"><input type="radio" name="response" id="B" value="B">' + $quesarray[$qnum]['r2_c'] + '</label>');
        $('#r3_c').html('<label class="radio"><input type="radio" name="response" id="C" value="C">' + $quesarray[$qnum]['r3_c'] + '</label>');
        $('#r4_c').html('<label class="radio"><input type="radio" name="response" id="D" value="D">' + $quesarray[$qnum]['r4_c'] + '</label>');
    }
    ;


//$ques=$temp[0]['qtext'];
//$('#ques').html($ques);

</script>
