<?php
require("phpus.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML DOM</title>
    <link rel="Stylesheet" href="style.css"/>
</head>
<body>
    <div>
        <a href="index.php" style="background-color: #555">Entries</a>
        <a href="preview.php">Preview</a>
        <a href="excelus.php">Excel</a>
    </div>
    <table>
        <thead>
            <th>Edit</th>
            <th>Name</th>
            <th>Thumbnail</th>
            <th>Author</th>
            <th>Magazine</th>
            <th>Delete</th>
            <th>Move</th>
        </thead>
        <tbody>
        <?php
            foreach($doc->getElementsByTagName("row") as $index=>$row) {
                if (isset($_POST["prepareEdit"]) && $_POST["prepareEdit"] == $index) {
                    ?>
                    <tr>
                        <form action="" method="POST">
                            <input type="hidden" name="index" value="<?php echo $index ?>"/>
                            <td></td>
                            <td><input name="i1" type="text" value="<?php echo htmlspecialchars(getValue($row, "name")) ?>"/></td>
                            <td><input name="i2" type="text" value="<?php echo htmlspecialchars(getValue($row, "src")) ?>"/></td>
                            <td><input name="i3" type="text" value="<?php echo htmlspecialchars(getValue($row, "author")) ?>"/></td>
                            <td><input name="i4" type="text" value="<?php echo getValue($row, "origin") ?>"/></td>
                            <td><button name="f" value="edit" type="submit">Save</button></td>
                        </form>    
                    </tr>
                    <?php
                }
                else {
                    ?>
                    <tr>
                        <form action="" method="POST">
                            <input type="hidden" name="index" value="<?php echo $index ?>"/>
                            <td><button name="prepareEdit" value="<?php echo $index ?>" type="submit">Edit</button></td>
                            <td><?php echo htmlspecialchars(getValue($row, "name")) ?></td>
                            <td><?php echo htmlspecialchars(getValue($row, "src")) ?></td>
                            <td><?php echo htmlspecialchars(getValue($row, "author")) ?></td>
                            <td><?php echo getValue($row, "origin") ?></td>
                            <td><button name="f" value="del" type="submit">Delete</button></td>
                            <td><?php
                                if ($index != 0) {
                                    ?><button name="f" value="up" type="submit">&#x1F805;</button><?php
                                }
                                if ($index != $doc->getElementsByTagName("row")->length - 1) {
                                    ?><button name="f" value="down" type="submit">&#x1F807;</button><?php
                                }
                            ?></td>
                        </form>    
                    </tr>
                    <?php
                }
            }
        ?>
        </tbody>
        <tr>
            <form action="" method="POST">
                <input type="hidden" name="f" value="add"/>
                <td></td>
                <td><input name="n" id="iName" type="text"/></td>
                <td><input name="s" id="iSrc" type="text"/></td>
                <td><input name="a" id="iAuthor" type="text"/></td>
                <td><input name="o" id="iOrigin" type="text"/></td>
                <td><button id="addGierka">Add</button></td>
            </form>
        </tr>
    </table>
</body>
</html>