<?php

if (!function_exists('format_date')) {
    /**
     * Format date by reversing the order of items in a delimited string and replacing the delimiter '/' with '-'.
     *
     * @param  string  $string
     * @param  string  $delimiter (optional)
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
