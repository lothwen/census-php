Census v2.0Beta
==============

Before describing this software, I must say that this my first "real"
application written in php (in fact, it's my first serious project I've 
work on). Maybe you will find bugs or errors in my code. Feel free to
mail me commenting what you want to improve this piece of code.

1.- Purpose
-----------

Census is a php application to make scout coordinator's life easier. 
It's a graphical web frontend to scout group census. With this, the
children data will be centralized and accesible everywhere and everywhen.

Sincerely, I write this to learn some php programming and for helping
to have my group's information more accesible to rest of monitors.

In the future, I hope to share this work with other scout groups of
my province.

2.- Features
------------

Right now it supports this features. To know whay will be implemented
, please see the TODO file.

* Add and delete childs to the database.
* Edit the data of some child.
* Make searches.
* Export the search results to pdf.
* Export "letter-ready" labels to send snail-mail without any effort ;-) .

3.- Downloading
---------------

If you are reading this README file, means that you have download 
census somehow. I'm using git control version software. You will
find much info in google, but if you are impacient with downloading
the latest code from upstream, you need to have installed git in 
your system and clone my repo. To do this, run this command in 
your terminal ::

	$ git clone git://github.com/lothwen/census-php.git

4.- Installation
----------------

To have census running you need a LAMP (Linux Apache Mysql PHP) 
installation ready. Copy all files to your apache document root, 
edit includes/config.php to setup your mysql and ome various
vars like debugging. The next step is to create the needed database 
and tables. I added a sql file in sql/ dir to only have to dump
this file into mysql. You can do this by typing in your terminal::
	
	$ mysql -u root -p < sql/data.sql

Now, you will need an user and a password to enter into the app.
Connect to mysql with the cli client or with phpMyadmin (or what
you use) and add a row to table "auth" with your wanted login
user, pass.

If you have made all fine, yo can access your web server and login
into the census. Now you can start adding children and using it :-P

5.- Contributing
----------------

For now you can contribute with census sending your opinions to me,
making bug reports, sending patches, and using census.
