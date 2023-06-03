<?php

namespace app\Core;

abstract class DBModel extends Model
{

    public abstract function tableName();
    public abstract function attributes();

    public function save()
    {
        $tableName =  $this->tableName();
        $attribues = $this->attributes();

        $params = array_map(fn ($attr) => ":$attr", $attribues);

        var_dump($params);

        $sql = "INSERT INTO $tableName(" . implode(',', $attribues) . ") Values (" . implode(',', $params) . ")";

        $statement = self::prepare($sql);
        
        foreach($attribues as $attribute){
            var_dump($this->{$attribute});
            $statement->bindValue(":$attribute",$this->{$attribute});
        }

        var_dump($statement);
        $statement->execute();
    }

    public static function prepare($sql)
    {
        return Application::$app->database->pdo->prepare($sql);
    }
}
