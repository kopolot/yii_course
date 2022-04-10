<?php 

use yii\base\Model;

class SingupForm extends Model{
    public $username;
    public $password;
    public $password_repeat;
    public $access_token;
    public $auth_key;
}