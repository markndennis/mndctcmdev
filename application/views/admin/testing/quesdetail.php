</div>
<div class="span9">
    <table class="table">
        <?php
        //var_dump($listexamquestions);
        foreach ($examques as $row) {
            //echo var_dump($row);
            echo "<tr><td>Subtest:</td>";
            echo "<td>".$row['subtest']."</td></tr>";
            echo "<tr><td>Ques #:</td>";
            echo "<td>".$row['qnum']."</td></tr>";
            echo "<tr><td>Question Text:</td>";
            echo "<td>" . $row['qtext'] . "</td></tr>";
            echo "<tr><td>A:</td>";
            echo "<td>" . $row['r1'] . "</td></tr>";
            echo "<tr><td>B:</td>";
            echo "<td>" . $row['r2'] . "</td></tr>";
            echo "<tr><td>C:</td>";
            echo "<td>" . $row['r3'] . "</td></tr>";
            echo "<tr><td>D:</td>";
            echo "<td>" . $row['r4'] . "</td></tr>";
          
          
        }
        ?>
    </table>      
</div>

