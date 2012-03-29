<?php
interface IGreetingModel
{
    function getGreeting();
}

class GreetingModel implements IGreetingModel
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

interface IGreetingView
{
    public function issueGreeting(IGreetingModel $model);
}

class GreetingView implements IGreetingView
{
    public function issueGreeting(IGreetingModel $model)
    {
        echo $model->getGreeting() . "\n";
    }
}

class GreetingController
{
    private $_greetingModel;
    private $_greetingView;

    public function __construct(IGreetingModel $model, IGreetingView $view)
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