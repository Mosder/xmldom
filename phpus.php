<?php
$doc = new DOMDocument();
$doc->load('xmlus.xml');

if (isset($_POST['f'])) {
    if ($_POST['f'] == "get") {
        echo getGierki($doc);
    }
    else if ($_POST['f'] == "add") {
        echo addGierka($doc, $_POST['n'], $_POST['s'], $_POST['a'], $_POST['o']);
    }
    else if ($_POST['f'] == "del") {
        echo delGierka($doc, $_POST['index']);
    }
    else if ($_POST['f'] == "edit") {
        echo editGierka($doc, $_POST['index'], $_POST['i1'], $_POST['i2'], $_POST['i3'], $_POST['i4']);
    }
    else if ($_POST['f'] == "up") {
        echo swap($doc, $_POST['index'], $_POST["index"] - 1);
    }
    else if ($_POST['f'] == "down") {
        echo swap($doc, $_POST['index'], $_POST["index"] + 1);
    }
}

function getValue($row, $tagName) {
    return $row->getElementsByTagName($tagName)->item(0)->nodeValue;
}
function addGierka($doc, $n, $s, $a, $o) {
    $newRow = $doc->createElement("row");
    $name = $doc->createElement("name", $n);
    $newRow->appendChild($name);
    $src = $doc->createElement("src", $s);
    $newRow->appendChild($src);
    $author = $doc->createElement("author", $a);
    $newRow->appendChild($author);
    $origin = $doc->createElement("origin", $o);
    $newRow->appendChild($origin);
    $doc->getElementsByTagName("gierki")->item(0)->appendChild($newRow);
    $doc->save("xmlus.xml");
}
function delGierka($doc, $index) {
    $row = $doc->getElementsByTagName("row")->item($index);
    $doc->getElementsByTagName("gierki")->item(0)->removeChild($row);
    $doc->save("xmlus.xml");
}
function editGierka($doc, $index, $i1, $i2, $i3, $i4) {
    $newRow = $doc->createElement("row");
    $name = $doc->createElement("name", $i1);
    $newRow->appendChild($name);
    $src = $doc->createElement("src", $i2);
    $newRow->appendChild($src);
    $author = $doc->createElement("author", $i3);
    $newRow->appendChild($author);
    $origin = $doc->createElement("origin", $i4);
    $newRow->appendChild($origin);

    $oldRow = $doc->getElementsByTagName("row")->item($index);
    $oldRow->parentNode->replaceChild($newRow, $oldRow);
    $doc->save("xmlus.xml");
}
function swap($doc, $index1, $index2) {
    $row1 = $doc->getElementsByTagName("row")->item($index1);
    $row2 = $doc->getElementsByTagName("row")->item($index2);
    $cl1 = $row1->cloneNode(true);
    $cl2 = $row2->cloneNode(true);
    $row1->parentNode->replaceChild($cl2, $row1);
    $row2->parentNode->replaceChild($cl1, $row2);
    $doc->save("xmlus.xml");
}