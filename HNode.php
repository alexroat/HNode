<?php

class HNode {

    public $attr = array();
    public $sub = array();
    public $tag = "div";

    public function __construct() {
        $a=func_get_args();
        $n=func_num_args();
        
        if ($n>0)
            $this->tag = $a[0]?:"div";
        if ($n>1)
            $this->attr = $a[1]?:array();
        if ($n>2)
            $this->sub=  array_slice($a, 2);
    }

    
    public function __callStatic($name, $arguments) {
        $reflect  = new ReflectionClass(get_called_class());
        array_unshift($arguments,$name);
        return $reflect->newInstanceArgs($arguments);
    }
    

    public function __toString() {
        $r = "<" . $this->tag;
        foreach ($this->attr as $k => $v)
            $r.=" " . $k . "=\"" . addslashes($v) . "\"";
        $r.=">";
        foreach ($this->sub as $s)
            $r.=$s;
        $r.="</" . $this->tag . ">\n";
        return $r;
    }

    public function attr() {
        switch (func_num_args()) {
            case 0:
                return $this->attr;
                break;
            case 1:
                return $this->attr->{$k};
                break;
            default :
                $this->attr->{$k} = $v;
                return $this;
                break;
        }
    }

    public function add($x) {
        array_push($this->sub, $x);
        return $this;
    }

    public function del($x) {
        $ns = array();
        foreach ($this->sub as $s)
            if ($x != $s)
                array_push($ns, $s);
        $this->sub = $ns;
        return $this;
    }

    public function delall() {
        $this->sub = array();
        return $this;
    }
    
    public function go()
    {
        echo $this;
        return $this;
    }
    
    
    
    public static function create() 
    {
        $reflect  = new ReflectionClass(get_called_class());
        return $reflect->newInstanceArgs(func_get_args());
    }
    
    
    

}
