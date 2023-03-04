<?php

namespace app\Core;

class Request{
    public function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }
    
    public function getPath(){
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        $position = strpos($path,'?');
        if($position){
            return substr($path,0,$position);
        }
        return $path;
    }
}