<?php

function convertToHtml($orig) {
    $res = str_replace("\n", "<br/>", $orig);
    return $res;
}

?>