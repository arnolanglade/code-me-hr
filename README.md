Code me an HR ! 
===============
[![Build Status](https://scrutinizer-ci.com/g/aRn0D/labs/badges/build.png?b=master)](https://scrutinizer-ci.com/g/aRn0D/labs/build-status/master)
[![Build Status](https://travis-ci.org/aRn0D/labs.svg?branch=master)](https://travis-ci.org/aRn0D/labs)

This is the code used for the presentation to make the talk "Code moi un RH" at the PHP Tour 2017

**Slide:** https://www.slideshare.net/
**Video:** https://www.youtube.com/watch?v=h0Upir7bg1o (in french, sorry)

In this example is very simple example of "DDD" project. Here, we have

* a single bounded Context named Resource Management
* s single aggregate named Employee

Technical requirements
----------------------

Symfony 3.4
Doctrine 2.5

Architecture
------------
We have 3 layer:

**Application:**
**Domain:**
**Infrastruce:**

Try it! 
-------

```
bin/console server:run
bin/console hautelook:fixtures:load
```

Go to http://127.0.0.1:8080 !