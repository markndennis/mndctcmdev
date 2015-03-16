</div>
<div class="span9">

    <table class="table">
        <col style="width:20%">
        <col style="width:5%">
        <col style="width:30%">
        <col style="width:15%">
        <col style="width:15%">
        <col style="width:15%">

        <thead>
            <tr>
                <th>Exam Name</th>
                <th>Q#</th>
                <th>Question</th>
                <th>Difficulty</th>
                <th>Created</th>
                <th>Active</th>
            </tr>
        </thead>
    </table>
    <div style="height:300px; overflow:auto; ">
        <table class="table table-striped">
            <col style="width:20%">
            <col style="width:5%">
            <col style="width:30%">
            <col style="width:15%">
            <col style="width:15%">
            <col style="width:15%">   
            <tbody> 
                <?php
                //var_dump($listexamquestions);
                foreach ($listexamquestions as $row) {
                    //echo var_dump($row);
                    echo "<tr>";
                    echo "<td>" . $row['subtest'] . "</td>";
                    echo "<td><a href='../testing/quesdetail/".$row['subtest']."/".$row['qnum']."'>" . $row['qnum'] . "</a></td>";
                    echo "<td>" . $row['qtext'] . "</td>";
                    echo "<td>" . $row['difficulty'] . "</td>";
                    echo "<td>" . $row['created'] . "</td>";
                    echo "<td>" . $row['active'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
    </div>

</table>
</div>