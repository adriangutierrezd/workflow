<?php


if (!function_exists('isJsonRequest')) {
    function isJsonRequest()
    {
        return isset(getallheaders()['Accept']) && getallheaders()['Accept'] == 'application/json';
    }
}
