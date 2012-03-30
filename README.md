# Hello World Done Right #
*This project is intended to demonstrate why I only apply SOLID principals after I detect a code smell which calls for that particular principal.  If we thought that we should always apply the SOLID principals then this is how we might implement Hello World.  **What follows is tongue in cheek.***

##The Legacy Code##
I read some blog posts about this really cool thing called SOLID that will make all of my code awesome.  I found this old app I wrote, and I'm going to apply as many of these principals as I can to it so people will know how smart I am when they read the source.  Here's how it looks now:

```php
<?php
echo "Hello World!\n";
```

Pretty embarrassing, right?  Oh well, don't worry - we're going to fix it up.

##SRP: The Single Responsibility Principal##
My classes should only have one responsibility.  I don't have any classes, but I should use OOP if I want to be known as a PHP Ninja.  There's this thing everybody at my PHP meetup group talks about called MVC which is supposed to separate responsibilities.  I think that if I make this MVC I'll totally nail the SRP.  Here's my new awesomified version:

```php
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
```

Now I'm really coding like a boss.

##OCP: The Open / Closed Principal##
It turns out that I have a long way to go if I want to be a total PHP rockstar (and I do)!  If I want to change the greeting, or I want to use my wicked-ass view class with a different model I'll have to edit those classes, and if I have to edit those classes I might introduce a bug, and then I'd look like some kind of newb.  My new version of Hello World solves these problems by passing in those things that might change so that my classes are open to extension, but closed to modification.  Check it out:

```php
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
```

Seriously - can Hello World get any more kick ass than this?

##LSP: The Liskov Substitution Principal##
This says that my classes should do what they're parents are expected to do so that they can stand in for them when needed.  I'm not using inheritance yet so I don't think I can use LSP.  Maybe I can find a way to add inheritance somewhere.  That'd really show off my massive intellect.  Maybe there's no way I can improve this.

##DIP: The Dependency Inversion Principal##
I know you're thinking I can't spell SOLID, but legit - the D comes before the I in the book!  I think it makes sense, because the DIP makes you add all kinds of interfaces to your code, and the ISP (the I in SOLID: Interface Segregation Principal) lets you split them to get even more interfaces.  

It turns out that my version of Hello World sucks because my controller depends on my view and my controller.  On top of that my view depends on my model.  I can hear you thinking: "Well duh, what else can you do?"  Well duh yourself, because unless you're a dope you make interfaces for all of your class dependencies and then you depend on those instead of the classes.  My buddies are going to phear my skilz when they see these interfaces.

```php
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
```

I really like that I don't have to worry any more about brittle code in my Hello World app.  I feel like I could make it say "Hello PHP!" or "Goodbye Joe!" or all kinds of crazy shit.

##ISP: The Interface Segregation Principal##
This one says that I should break down my interfaces to be tailored to whatever is using my class, so different clients get different interfaces which match that client's needs.  My interfaces only have one method each, so I'm gonna think about how I can add methods and segregate my interfaces.

##Conclusion##
My Hello World app has come a long way since that stupid two line script I started with.  I can't believe I ever wrote that!  The new fifty-five line version is so much easier to read and maintain.  This new version is gonna ball so hard, mother forkers gotta fork my repo.