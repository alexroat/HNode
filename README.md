HNode
=====

A PHP class to build HTML/XML snipets with chain syntax (like JQuery) in order to modularize and simplify the code.




it better works with PHP>=5.3

constructor syntax is: 

```php
new HNode([tagname:string], [attributes:kv-array], [child], [child], [child],...)
```

create a div with a text
```php
new HNode();//default tag is a div
echo $div->add("hello");//add() allows you to add other children nodes or text
//<div>hello</div>
```

alternatively:
```php
$div=new HNode(null,null,"hello");
echo $div;
//<div>hello</div>
```

create a span with attributes 
```php
$div=new HNode("span",array("id"=>"test","class"=>"testclass"),"hey");
echo $div;
//<span id="test" class="testclass">hey</span>
```

create a div with attributes with two children span
```php
$div=new HNode("div",array("id"=>"test","class"=>"testclass"),new HNode("span",null,"hello"),new HNode("span",null,"world"));
echo $div;
//<div id="test" class="testclass">
//<span>hello</span>
//<span>world</span>
//</div>
```

equivalent with fast syntax with ::create static function
```php
echo HNode::create("div",array("id"=>"test","class"=>"testclass"), HNode::create("span",null,"hello"),HNode::create("span",null,"world"));
//<div id="test" class="testclass">
//<span>hello</span>
//<span>world</span>
//</div>
```

//you can print directly with go()
```php
HNode::create("div",array("id"=>"test","class"=>"testclass"), HNode::create("span",null,"hello"),HNode::create("span",null,"world"))->go();
//<div id="test" class="testclass">
//<span>hello</span>
//<span>world</span>
//</div>
```

OOP with HNODE: you can extend it in order to create your components
```php
class MyBox extends HNode
{
    public function __construct($name,$surname) {
        parent::__construct("div");
        $this->add(HNode::create("span",null,"Name : ".$name));
        $this->add(HNode::create("span",null,"Surname : ".$surname));
    }
}
```

then let's use it
```php
$box=new MyBox("John","Doe");
echo $box;
//<div>
//<span>Name : John</span>
//<span>Surname : Doe</span>
//</div>
```

or in this way (PHP 5.3 required)
```php
MyBox::create("John","Doe")->go();
//<div>
//<span>Name : John</span>
//<span>Surname : Doe</span>
//</div>
```


you can directly create any kind of element calling like a static method (PHP 5.3 required)
```php
echo HNode::span(null,"hello");
//<span>hello</span>
```
