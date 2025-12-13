<?php
class UserController
{
    public $id;
    public $name;
    public $email;
    public $role;
    public $status;
    public function __construct($data = [])

    {
        if (is_array($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? '';
            $this->email = $data['email'] ?? '';
            $this->role = $data['role'] ?? 'huong_dan_vien';
            $this->status = $data['status'] ?? 1;
        } else {
            $this->name = $data;
        }

    }
    public function getName():mixed
    {
        return $this->name;
    }
    public function isAdmin():bool
    {
        return $this->role === 'admin';
    }
    public function isGuide():bool
    {
        return $this->role === 'huong_dan_vien';
    }
    
    
}