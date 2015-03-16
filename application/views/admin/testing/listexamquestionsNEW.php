</div>
<div class="span9">

    <div id='table_div'></div>

    <?php //echo var_dump($listexamquestions); ?>

    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
        google.load('visualization', '1', {packages: ['table']});
        google.setOnLoadCallback(drawTable);
        function drawTable() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'ID');
            data.addColumn('string', 'SubTest');
            data.addColumn('string', 'Ques Num');
            data.addColumn('string', 'Ques Text');
            data.addRows([
<?php
foreach ($listexamquestions as $row) {
    echo "['<a href= " . $row['id'] . ">" . $row['id'] . "</a>','" . $row['subtest'] . "','" . $row['qnum'] . "','" . $row['qtext'] . "'],";
}
?>]);

            var table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(data, {showRowNumber: false, allowHtml: true, pageSize: 5, page: 'enable'});


        }


    </script>

</div>
<!--</div>     -->