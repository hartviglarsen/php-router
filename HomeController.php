<?php

class HomeController extends Controller{
    public function index() : string {
        return $this->response([
            'message' => 'Hello, World'
        ]);
    }
}
