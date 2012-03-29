<?php
class GreetingModel
{
    private $_greeting;

    function __construct($greeting)
    {
        $this->_greeting = $greeting;
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
    private $_greetingModel;
    private $_greetingView;

    public function __construct(GreetingModel $model, GreetingView $view)
    {
        $this->_greetingModel = $model;
        $this->_greetingView = $view;
    }

    public function takeAction()
    {
        $this->_greetingView->issueGreeting($this->_greetingModel);
    }
}

$model = new GreetingModel("Hello World!");
$view = new GreetingView();
$controller = new GreetingController($model, $view);
$controller->takeAction();