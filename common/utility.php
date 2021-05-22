<?php
namespace Common;

class Utility {
    function __construct() {

    }

    static function debug($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        file_put_contents('.debug', "Debug Objects: '" . $output . "'\n", FILE_APPEND);
    }
}
