<?php

namespace app\Models;

use app\Core\DBModel;
use app\Core\Model;

class User extends DBModel
{
   private const STATUS_INACTIVE = 0;
   private const STATUS_ACTIVE  = 1;
   private const STATUS_DELETED = 2; 

    public   string $firstname = '';
    public   string $lastname = '';
    public   string $email = '';
    public  string $password = '';
    public   string $passwordConfirmation = '';
    public int $status = 0;

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_Email,[self::RULE_UNIQUE,'class'=>self::class,'attribute'=>'email']],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]]
        ];
    }

    public function register(){
        $this->status = 10;
        return $this->save();
    }

    public static function getTable(){
        return 'USERS';
    }
    public function tableName()
    {
        return 'USERS';
    }
    public function attributes()
    {
        return [
            'username',
            'name',
            'email',
            'password',
            'status'
        ];
    }
}
