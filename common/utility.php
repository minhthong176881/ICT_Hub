<?php
namespace Common;

class Utility {
    function __construct() {

    }

    static function debug($data) {
        ob_start();
        var_dump($data);
        $result = ob_get_clean();
    
        file_put_contents('.debug', "Debug Objects: '" . $result . "'\n", FILE_APPEND);
    }
}
