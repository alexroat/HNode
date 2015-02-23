<?php

include './HN.php';

//it better works with PHP>=5.3
//constructor syntax is: new HN([tagname:string], [child], [child], [child],...)

//create a div with a text
$div=new HN();//default tag is a div
echo $div->add("hello");//add() allows you to add other children nodes or text
//<div>hello</div>

//alternatively, using the default:
$div=new HN(null,"hello");
echo $div;
//<div>hello</div>

//or adding child later:
$div=new HN();
echo $div->add("hello");
//<div>hello</div>

//create a span with attributes 
$div=new HN("span","hey");
$div->attr(array("id"=>"test","class"=>"testclass"));
echo $div;
//<span id="test" class="testclass">hey</span>


//create a div with attributes with two children span
$div=new HN("div",new HN("span","hello"),new HN("span","world"));
$div->attr(array("id"=>"test","class"=>"testclass"));
echo $div;
//<div id="test" class="testclass">
//<span>hello</span>
//<span>world</span>
//</div>

//equivalent with fast syntax with ::create static function
echo HN::create("div", HN::create("span","hello"),HN::create("span","world"))->attr(array("id"=>"test","class"=>"testclass"));
//<div id="test" class="testclass">
//<span>hello</span>
//<span>world</span>
//</div>

//you can print directly with go()
HN::create("div",HN::create("span","hello"),HN::create("span","world"))->attr(array("id"=>"test","class"=>"testclass"))->go();
//<div id="test" class="testclass">
//<span>hello</span>
//<span>world</span>
//</div>



//OOP with HNODE: you can extend it in order to create your components
class MyBox extends HN
{
    public function __construct($name,$surname) {
        parent::__construct("div");
        $this->add(HN::create("span","Name : ".$name));
        $this->add(HN::create("span","Surname : ".$surname));
    }
}

//then let's use it
$box=new MyBox("John","Doe");
echo $box;
//<div>
//<span>Name : John</span>
//<span>Surname : Doe</span>
//</div>

//or in this way (PHP 5.3 required)
MyBox::create("John","Doe")->go();
//<div>
//<span>Name : John</span>
//<span>Surname : Doe</span>
//</div>

//you can directly create any kind of element calling like a static method (PHP 5.3 required)
HN::div(HN::span("hello"),HN::span("world"))->attr(array("id"=>"test","class"=>"testclass"))->go();
//<div id="test" class="testclass">
//<span>hello</span>
//<span>world</span>
//</div>


//you can set also attributes directly using reflection (PHP 5.3 required)
$div=HN::div(HN::span("hello"),HN::span("world"));
$div->id="test";
$div->class="testclass";
$div->go();
//<div id="test" class="testclass">
//<span>hello</span>
//<span>world</span>
//</div>