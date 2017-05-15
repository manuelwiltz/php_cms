# CMS built with PHP and MySQL

This project is a CMS built with PHP, MySQL, HTML and CSS.<br>
Used frameworks/libraries: jQuery, BootStrap

# How to get started:
**NOTE** : If you do not have **root as username** and an **empty string as password** in your XAMPP installation, 
change the password and username in the file **admin/root/.$DB_info$**

Then launch index.php the first time.

## How it works:
The index.php file is a file which contains no content.<br>
To add content log in into the **admin dashboard**, just click the link in the footer.<br>
You have to login to see the admin panel.<br>

If the user is not registered you have to create an account and then login. If you have an account just login.<br>

# Databases: 

#### The following tables are going to be installed:
Keep in mind that you fill in the install form correct after you enter the index.php the first time.<br>
Write down your username and password to login later into the dashboard.

### pages
**ID** is the PRIMARY KEY, so keep in mind that you tick **AUTO_INCREMENT** and dont't let it be null, so tick **NOT NULL**. 

![pages](https://cloud.githubusercontent.com/assets/23216069/25011894/2816ea54-206f-11e7-8d46-8092789ecd3f.PNG)


### users
![users](https://cloud.githubusercontent.com/assets/23216069/25011893/28164428-206f-11e7-9ffb-3797c0af562b.PNG)

### site_info
![grafik](https://cloud.githubusercontent.com/assets/23216069/25172243/a9947814-24f0-11e7-87dd-f053e965c329.png)


### views
![grafik](https://cloud.githubusercontent.com/assets/23216069/25172159/737bd380-24f0-11e7-8704-5b672d8a4f36.png)
