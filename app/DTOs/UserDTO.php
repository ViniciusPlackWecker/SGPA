<?php

namespace App\DTOs;

class UserDTO
{
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $birthday;
    public $phone;
    public $institution;

    public function __construct($id, $first_name, $last_name, $email, $birthday, $phone, $institution)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->birthday = $birthday;
        $this->phone = $phone;
        $this->institution = $institution;
    }
}