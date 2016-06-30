<html>
    <body>
        <form action="news_report.php" method="get">
        <div>
            <div>filters:</div>
            start date: <input type="text" name="article_start_date_filter" /><br>
            end date: <input type="text" name="article_end_date_filter" /><br>
            author: <input type="text" name="article_author"/><br>
            <input type="submit" name="btnSubmit" value="Submit"/>
        </div>

        </form> 

        <?php 
        if (isset($reportData)) {
        ?>
            <table>
                <thead>
                    <tr>
                        <?php
                            foreach ($columnsToDisplay as $key => $value)
                            {
                        ?>
                                <th><?php echo $value; ?></th>
                        <?php
                            }
                        ?>
                        <th>Edit</th>
                        <th>View</th>
                    </tr>
                </thead>
                <?php
                    while ( $row = $newsResults->fetch(PDO::FETCH_ASSOC) )
                    {
                ?>
                        <tr>
                            <?php
                                foreach ($columnsToDisplay as $key => $value)
                                {
                            ?>
                                    <td><?php echo $row[$key]; ?></td>
                            <?php
                                }
                            ?>
                            <td><a href="news_edit.php?article_id=<?php echo $row['article_id']; ?>">Edit</a></td>
                            <td><a href="news_view.php?article_id=<?php echo $row['article_id']; ?>">View</a></td>
                        </tr>
                <?php
                    }

                ?>
            </table>
        <?php
        }


        ?>

    </body>
</html>
