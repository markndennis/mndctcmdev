<style>
    .right{
        text-align: right !important;
    }
</style>

<div class="span2" style="height:300px; ">
    <?php 
    $total = $score['correct'] + $score['incorrect'] + $score['na'];
    echo '
    <table class="table">
	    <tr><td><strong>' . $examprofile . '</strong></td><td></tr></tr>
        <tr><td>Correct</td><td class="right">' . $score['correct'] . '</td></tr>
        <tr><td>Incorrect</td><td class="right">' . $score['incorrect'] .'</td></tr>
        <tr><td>Not Answered</td><td class="right">'. $score['na'] .'</td></tr>
        <tr><td><strong>Total</strong></td><td class="right"><strong>'.$total .'</strong></td></tr>  
            <tr><td><strong>Pass Status</strong></td><td class="right"><strong>'.$score['passfail'] .'</strong></td></tr>   
    </table>'; 
    ?>
	<a id="email" href="">Re-send Result Email</a>
	<div id="mess" style="color: red;"></div>
</div>
<div class="span9">
    <div style="height:300px; overflow:auto; ">
        <div id='table_div'></div>
        <div id="sel"></div>
    </div>




    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
        google.load('visualization', '1', {packages: ['table']});
        google.setOnLoadCallback(drawTable);
        function drawTable() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', "Ques #");
            data.addColumn('number', 'QID');
            data.addColumn('string', 'Answer');
            data.addColumn('string', 'Solution');
            data.addColumn('string', 'Comment');
            data.addRows([
<?php

foreach ($results as $row) {
    if($row['answer'] === $row['soln']){
        $comment='<div style="color:green">Correct</div>';
    }else{
        $comment='<div style="color:red">Incorrect</div>';
    }
    
    echo "[{v:" . $row['qnum'] . "},{v:" . $row['qid'] . "},'" . $row['answer'] . "','" . $row['soln'] ."','".$comment."'],";
}
?>]);

            var table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(data, {showRowNumber: false, allowHtml: true, pageSize: 7, page: 'enable'});


        }


    </script>
	<script>
		$('#email').click(function(){					   				   
			$.get( "<?php echo site_url('exam/myexam/sendexamineecompleteemail/' . $id); ?>");	
			$('#mess').html('... email sent');
		});
	</script>


<!--</div>     -->
