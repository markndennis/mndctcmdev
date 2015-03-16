</div>
<div class="span9">
    <div id="table_div"></div>
    
<!--    <form method="post">
        <input type="submit" class="btn btn-danger" name="submit" value="save and clear log" />
    </form>-->
    
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
        google.load('visualization', '1', {packages: ['table']});
        google.setOnLoadCallback(drawTable);
        function drawTable() {
            var data = new google.visualization.DataTable();

            data.addColumn('string', 'User');
            data.addColumn('string', 'Message');
            data.addColumn('string', 'Date');
            data.addRows([
<?php
foreach ($log as $row) {
    echo "['" . $row['user'] . "','" . $row['message'] . "','" . $row['date'] . "'],";
}
?>]);

            var table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(data, {showRowNumber: false, allowHtml: true, pageSize: 5, page: 'enable', sortColumn: 2, sortAscending: false});


        }


    </script>    

</div>


