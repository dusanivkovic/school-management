<?php
namespace app\models;

class Format extends Model
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validation($postData)
    {
        $data = trim($postData);
        $data = stripcslashes($postData);
        $data = htmlspecialchars($postData);
        return $data;
    }

    protected function validateFullname() {
        $fullName = $this->validation($this->data['fullname']);
        empty($fullName) ? $this->addError('fullname', self::FULL_NAME) : '';
    }
}