Code me an HR ! 
===============
[![Build Status](https://scrutinizer-ci.com/g/aRn0D/labs/badges/build.png?b=master)](https://scrutinizer-ci.com/g/aRn0D/labs/build-status/master)
[![Build Status](https://travis-ci.org/aRn0D/labs.svg?branch=master)](https://travis-ci.org/aRn0D/labs)

This is the code used for the talk **Code me an HR** at the **PHPTour 2017**.

**Slide:** [here](https://www.slideshare.net)
**Video:** [here but in french, sorry](https://www.youtube.com/watch?v=h0Upir7bg1o) 

This application is very simple example of a "DDD" project. Here, we have

* a single bounded Context named **Resource Management**
* s single aggregate named **Employee**

Technical requirements
----------------------

**Framework:** [Symfony 3.4](https://github.com/symfony/symfony)
**ORM:** [Doctrine 2.6](https://github.com/doctrine/doctrine2)
**Command Bus:** [SimpleBus 3.0](https://github.com/SimpleBus/SimpleBus)


Run the tests
-------------

[PhpSpec](https://github.com/phpspec/phpspec) is used to design the code and [Behat](https://github.com/Behat/Behat) to "test" the UI.

```
vendor/bin/behat
vendor/bin/phpspec run
```

You should have a look to [FriendOfBehat](https://github.com/FriendsOfBehat) organisation. There are lot of interesting Behat extensions.

Try it! 
-------

```
bin/console server:run
bin/console hautelook:fixtures:load
```

Go to [http://127.0.0.1:8080](http://127.0.0.1:8080) !

Next Step?
----------

Rewrite and organize tests 

* We need to introduce integration and acceptance tests.
* We must not use Behat to test the UI.