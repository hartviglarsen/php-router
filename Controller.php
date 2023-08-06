<?php

abstract class Controller {
    protected function response(array $data, int $code = 200) : string {
        http_response_code($code);
        header("Content-Type: application/json");
        
        return json_encode($data);
    }
}
