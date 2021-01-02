<?php
/**
 * Basic Response Model for Every API at the moment
 */
class BasicResponseModel {
    public $message;
    public $code;
    public $data;

    /**
     * Construct the response
     * @param $code the response code
     * @param $message the response message
     * @param $data optional data, if any
     */
    function __construct($code, $message, $data = null) {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    function responde() {
        $res = new stdClass;
        $res->code = $this->code;
        $res->message = $this->message;
        $res->data = $this->data;
        
        echo json_encode($res);
    }
}
?>