<?php

namespace app\Core;

class Form
{
    public static function begin(string $action, string $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public function field(Model $model, string $attribute)
    {
        echo new Field($attribute, $model);
    }
}
