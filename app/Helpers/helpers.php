<?php

if (!function_exists('format_date')) {
    /**
     * Reverse the order of items in a delimited string.
     *
     * @param  string  $string
     * @param  string  $delimiter
     * @return string
     */
    function format_date($string, $delimiter = '/') {
        $items = explode($delimiter, $string);
        //switch mounth with day
        $swap = $items[0];
        $items[0] = $items[1];
        $items[1] = $swap;
        $reversedItems = array_reverse($items);
        return str_replace($delimiter, '-', implode($delimiter, $reversedItems));
    }
}
