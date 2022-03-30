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
        <a href="index.php">Entries</a>
        <a href="preview.php" style="background-color: #555">Preview</a>
        <a href="excelus.php">Excel</a>
    </div>
    <table>
        <thead>
            <th>Name</th>
            <th>Thumbnail</th>
            <th>Author</th>
            <th>Magazine</th>
        </thead>
        <tbody>
            <?php
            $doc = new DOMDocument();
            $doc->load("xmlus.xml");
            function getValue($row, $tagName) {
                return $row->getElementsByTagName($tagName)->item(0)->nodeValue;
            }
            foreach($doc->getElementsByTagName("row") as $row) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars(getValue($row, "name")) ?></td>
                    <td><img src="./imgs/<?php echo htmlspecialchars(getValue($row, "src")) ?>"/></td>
                    <td><?php echo htmlspecialchars(getValue($row, "author")) ?></td>
                    <td><?php echo getValue($row, "origin") ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>