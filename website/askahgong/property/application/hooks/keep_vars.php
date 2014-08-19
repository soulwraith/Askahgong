<?php

function keep_vars ($vars = array())
{
    if (empty($vars)) return;

    global $pre_filter;

    $pre_filter = array();

    foreach ($vars as $var) {
        $pre_filter = array_merge($pre_filter, $var);
    }
}

?>