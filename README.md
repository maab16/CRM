# CRM
Customer relationship management with Blab Famework

Add all files inside CRM folder to your main directory (htdocs).

If you want to run CRM project under a subfoler look like " htdocs\crm " then open" \xampp\apache\conf\extra\httpd-vhosts.conf " file
copy the below code and pase it into " httpd-vhosts.conf "
```
<VirtualHost *:80>
        ServerName devcodeskill.com
        DocumentRoot H:\xampp\htdocs\devcodeskill
     
        SetEnv APPLICATION_ENV "development"
     
        <Directory H:\xampp\htdocs\devcodeskill>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>
```

## DocumentRoot \path must be your document root with sub folder


# Database Settings

got to ``` App\Config\database.ini ``` 
