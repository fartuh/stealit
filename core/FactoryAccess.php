<?php

namespace core;

class FactoryAccess
{
    public static function getParams($class){
        $class = "\core\access\\$class";
        if(class_exists($class)){
            $obj = new $class;
            return $obj->params;
        } 
        else{
            $obj = new \core\access\User;
            return $obj->params;
        }
    }
}
