<?php
namespace app\Core;

class Field{
    public function __construct(private $attribute, private Model $model){

    }

    public function __toString()
    {
        return sprintf(
            "
            <input type='text' name='%s' value='%s' placeholder='%s'>
            <span style='color:red'>%s</span>
            ",
            $this->attribute,
            $this->model->{$this->attribute},
            $this->attribute,
            $this->model->hasError($this->attribute)? $this->model->getFirstError($this->attribute) : '' ,
    );
    }
}
