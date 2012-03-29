<?php
class GreetingModel
{
    private $_greeting;

    function __construct()
    {
        $this->_greeting = "Hello World!";
    }

    public function getGreeting()
    {
        return $this->_greeting;
    }
}

class GreetingView
{
    public function issueGreeting(GreetingModel $model)
    {
        echo $model->getGreeting() . "\n";
    }
}

class GreetingController
{
    public function takeAction()
    {
        $view = new GreetingView();
        $view->issueGreeting(new GreetingModel());
    }
}

$controller = new GreetingController();
$controller->takeAction();