# CMS built with PHP and MySQL

This project is a CMS built with PHP, MySQL, HTML and CSS.<br>
Used frameworks/libraries: jQuery, BootStrap

# How it works:
The index.php file is a file which contains no content.<br>
To add content log in into the **admin dashboard**, just click the link in the footer.<br>
Or you can enter the **admin dashboard** by adding **/AddPages.php** to the URL.<br>

If the user is not registered you have to create an account and then login. If you have an account just login.<br>

Now you are at the **dashboard** where you can **add pages and delete pages**.<br>


# How to get started:

### 1. Create the database
Before you can start using it, you have to create the database.
So login into your phpMyAdmin or what else you are using.

Create a database with the name **cms_pages**

#### Create the folowing tables in **cms_pages**:

## pages
**ID** is the PRIMARY KEY, so keep in mind that you tick **AUTO_INCREMENT** and dont't let it be null, so tick **NOT NULL**. 

![pages](https://cloud.githubusercontent.com/assets/23216069/25011894/2816ea54-206f-11e7-8d46-8092789ecd3f.PNG)


## users
![users](https://cloud.githubusercontent.com/assets/23216069/25011893/28164428-206f-11e7-9ffb-3797c0af562b.PNG)
