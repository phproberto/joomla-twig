## Contributing to joomla-twig. 

So you want to contribute to joomla-twig? THANK YOU!!  

This project uses a set of tools (mainly Node.js & Composer) and a special development environment that may scare you if you aren't familiar with it but will definitely improve your skills as web developer and your development speed. Any time spent configuring joomla-twig development environment will make you a better developer.  

Remember that I'm here to help you because I'm the most interested in making contributing as easy as possible. If you get blocked setting things up create an issue. If I missed some information here or there is something you find confusing create an issue.  

### Index.

1. [Glossary](#glossary).
2. [Workflow](#workflow).
2. [Setting up required tools](#tools)
2. [Setting up repositories](#repositories).
    * [Setting up local joomla-cms clone](#joomla-clone).
    * [Setting up local joomla-twig clone](#twig-clone).
3. [Setting up development environment](#setting-up-environment).
    * [Installing Node.js dependencies and setting up Gulp](#setting-up-npm).
    * [Installing joomla-twig library composer dependencies](#setting-up-composer).
    * [Installing testing composer dependencies and setting up phpunit](#setting-up-tests).
4. [Setting up joomla testing site](#setting-up-site).
5. [Running Gulp](#running-gulp)

### 1. Glossary. <a id="glossary"></a>

We will use two concepts in this document that you need to understand:  

* **Joomla testing site**: A local clone of joomla-cms repository pointing to staging branch. We will use it to test your code in a real site and to run tests that inherit Joomla classes.  
* **joomla-twig folder**: A local clone of your fork of the joomla-twig repository. Our main development folder and where we will change files to contribute.  

### 2. Workflow. <a id="workflow"></a>

Nothing better than an image to describe the joomla-twig development workflow. The idea is to have a 100% isolated folder with joomla-twig code and a joomla testing site that get's automatically updated when a change happens in joomla-twig code.

<img src="https://phproberto.github.io/joomla-twig/images/workflow.jpg" alt="Development workflow schema" class="responsive"/>

### 2. Setting up required tools. <a id="tools"></a>

First of all we need two tools installed in your system:  

* [Node.js](https://nodejs.org). Used to automatically update the joomla testing site whenever files change in your joomla-twig folder. If you haven't used browserSync you will love to save a file and see the page reloaded without even being able to switch to the browser window.  
* [Composer](https://getcomposer.org/download/). Used to install PHP dependencies required for joomla-twig library and testing.

I found that trying to guide people to get those installed in different environments is worse than asking you to follow the guides that already exist in those web pages / google.  

### Setting up repositories. <a id="repositories"></a>

As you saw in the glossary we need to setup two github clones of github repositories.

#### Setting up local joomla-cms clone. <a id="joomla-clone"></a>

If you already contribute to Joomla! you probably have a local clone. If not you can follow this steps:

1. Login into Github.
2. Go to [joomla-cms repository](https://github.com/joomla/joomla-cms) and click the `Fork` button to create a fork inside your github account
3. Then clone that repository into your local machine `www` folder. It will be something like:  
    * `cd /var/www` < update this to your www folder
    * `git clone git@github.com:{YOUR_GITHUB_USER}/joomla-cms.git`

Than will create a joomla-cms testing site in `/var/www/joomla-cms` (where `/var/www` is your www folder).

#### Setting up local joomla-twig clone. <a id="twig-clone"></a>

Next step is to fork joomla-twig repository (as we did with joomla-cms repo) and clone it in a local folder. 

joomla-twig doesn't need to be in your `www` folder because Gulp will take care of copying/updating files in your Joomla testing site when they change. I usually have a `projects` folder in my user folder with all my code. That allows me to delete any website without having to worry about losing things.   

For now ensure that you clone your fork locally with something like:
   * `cd ~/projects` < update this with the folder you want to store joomla-twig code
   * `git clone git@github.com:{YOUR_GITHUB_USER}/joomla-twig.git`


### Setting up development environment. <a id="setting-up-environment"></a>

Now that we have both repositories cloned and tools installed we need to create some configuration files and install dependencies.  

#### Installing Node.js dependencies and setting up Gulp. <a id="setting-up-npm"></a>

1. Go to your cloned joomla-twig folder.
1. Duplicate `/build/gulp-config.dist.json` file to `/build/gulp-config.json`
3. Edit `gulp-config.json` file and set:
    * `wwwDir` so it points to your local joomla site for testing.
    * `proxy` so it points to the url you use to access yout local joomla site. 
3. Inside `build` folder run `npm install` to install required npm packages.

#### Installing joomla-twig library composer dependencies. <a id="setting-up-composer"></a>

1. Go to your cloned joomla-twig folder.
4. Inside `/extensions/libraries/twig` execute `composer install` to install library's composer dependencies.

#### Installing testing composer dependencies and setting up phpunit. <a id="setting-up-tests"></a>

To run tests we also need to run composer in the root folder of yout cloned joomla-twig folder. 

1. `cd ~/projects/joomla-twig` < update with your joomla-twig folder
2. Run `composer install`.
6. Duplicate `phpunit.dist.xml` to `phpunit.xml`
7. Edit `phpunit.xml` and set `JPATH_BASE` to point to your joomla testing site folder.


### Setting up joomla testing site. <a id="setting-up-site"></a>

1. To run test we need to also execute `composer install` in the root folder of your joomla testing site.
2. You can now install joomla-twig in your Joomla testing site go to `Extensions` > `Manage` > `Install from Folder` and specify the folder where you cloned joomla-twig. 

### Running Gulp. <a id="running-gulp"></a>

We are ready to go! You can now execute gulp inside your joomla-twig `build` folder to get browserSync launched and gulp watching for changes.

To execute gulp simply execute: `gulp` 

When you execute gulp it will:  

* Clean any file previously in the testing site.
* Copy joomla-twig code to the testing site.
* Watch for changes.
* Launch a browser with your testing site loaded and connected to browserSync.

To stop gulp cancel the process in that terminal window where you executed it (`Ctrl+C` in linux).  

You can also run commands independently:  

* `gulp clean`: Will clean all the files from the testing site.  
* `gulp copy`: Will copy all the files to the testing site.  

