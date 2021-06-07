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
<<<<<<< HEAD
    static function returnResult($data) {
        echo '{"result":"' . $data . '"}';
=======

    static function gmdateToLocalDate($dateTime){
        /* $gmdate must be in YYYY-mm-dd H:i:s format*/
        $userTz = new \DateTimeZone(date_default_timezone_get());
        $dateTime->setTimeZone($userTz);
        return $dateTime->format('D, j M, Y \a\\t H:i');
>>>>>>> master
    }
}
