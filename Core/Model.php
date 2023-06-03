<?php

namespace app\Core;

abstract class Model
{
    protected const RULE_REQUIRED = 'required';
    protected const RULE_Email = 'email';
    protected const RULE_MAX = 'max';
    protected const RULE_MIN = 'min';
    protected const RULE_MATCH = 'match';
    protected const RULE_UNIQUE = 'unique';

    private $errors = [];


    public function loadData(array $datas)
    {
        foreach ($datas as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public abstract function rules(): array;

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                if (!is_string($rule)) {
                    $rulename = $rule[0];
                } else {
                    $rulename = $rule;
                }

                if ($rulename === self::RULE_REQUIRED && !$value) {
                    $this->addErrors($attribute, self::RULE_REQUIRED);
                }

                if ($rulename === self::RULE_MIN && $value < $rule['min']) {
                    $this->addErrors($attribute, self::RULE_MIN, $rule);
                }

                if ($rulename === self::RULE_MATCH && $value != $this->{$rule['match']}) {
                    $this->addErrors($attribute, self::RULE_MATCH);
                }

                if($rulename === self::RULE_UNIQUE){
                    $classname = $rule['class'];
                    $uniqueAttr = $rule['attribute']??$attribute;

                    $tableName = $classname::getTable();
                    
                    $statement = Application::$app->database->prepare("SELECT * FROM $tableName where $uniqueAttr = :attr");

                    $statement->bindValue(":attr",$value);

                    $statement->execute();
                    $record = $statement->fetchObject();

                    if($record){
                        $this->addErrors($attribute,self::RULE_UNIQUE,['field'=>$attribute]);
                    }
                }
            }
        }
     
        return (count($this->errors) > 0) ? false : true;
    }

    public function addErrors($attribute, $rule, $params = [])
    {
        $message = $this->errorMessage()[$rule];
        $message = str_replace('{attribute}',$attribute, $message);

        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function errorMessage()
    {
        return [
            self::RULE_REQUIRED => '{attribute}  is required',
            self::RULE_MIN => '{attribute}  should be {min}',
            self::RULE_MATCH => 'Match error',
            self::RULE_UNIQUE => 'Record with this {field} already exists'
        ];
    }


    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute){
        return $this->errors[$attribute][0] ?? false;
    }
    
}
