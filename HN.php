<?php
class HN {

    public $attr = array();
    public $sub = array();
    public $tag = "div";

    public function __construct() {
        $a=func_get_args();
        $n=func_num_args();
        
        if ($n>0)
            $this->tag = $a[0]?:"div";
        if ($n>1)
            $this->sub=  array_merge($this->sub,array_slice ($a,1));
    }

    
    public static function __callStatic($name, $arguments) {
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
        $a=func_get_args();
        $n=func_num_args();
        switch ($n) {
            case 0:
                return $this->attr;
                break;
            case 1:
                if (is_array($a[0]))
                {
                    array_merge($this->attr,$a[0]);
                    return $this;
                }   
                return $this->attr[$a[0]];
                break;
            default :
                $this->attr[$a[0]] = $a[1];
                return $this;
                break;
        }
    }
    

    public function add($x) {
        array_push($this->sub, $x);
        return $this;
    }

    public function remove($x) {
        $ns = array();
        foreach ($this->sub as $s)
            if ($x != $s)
                array_push($ns, $s);
        $this->sub = $ns;
        return $this;
    }

    public function clear() {
        $this->sub = array();
        return $this;
    }

    public function __get($name)
    {
        
        if (!array_key_exists($name,$this->attr))
                return NULL;
        return $this->attr[$name];
    }
    
    public function __set($name, $value)
    {
        $this->attr[$name] = $value;
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
