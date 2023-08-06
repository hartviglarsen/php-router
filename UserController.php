<?php

class UserController extends Controller {
    public function show($username) {
        return $this->response([
            'username' => $username
        ]);
    }
    
    public function store() : string {
        $payload = file_get_contents('php://input');
        $data = json_decode($payload);

        return $this->response([
            'status'=> 'created',
            'data' => $data
        ], 201);
    }
}
