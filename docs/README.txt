README
======
Hoi Bert, je zal mijn instal sql moeten runnen.
Die dropt een database zf_cms_jor als je die al heb. Dus kijk uit
En installeert daarna de database voor je.
Je kan dan inloggen met:
Username: BBetgen
Password: JorVerdientEen10

This directory should be used to place project specfic documentation including
but not limited to project notes, generated API/phpdoc documentation, or
manual files generated or hand written.  Ideally, this directory would remain
in your development environment only and should not be deployed with your
application to it's final production location.


Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.

<VirtualHost *:80>
   DocumentRoot "C:/xampp/htdocs/zf_cms/public"
   ServerName .local

   # This should be omitted in the production environment
   SetEnv APPLICATION_ENV development

   <Directory "C:/xampp/htdocs/zf_cms/public">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
   </Directory>

</VirtualHost>

