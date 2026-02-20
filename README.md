[Project Data - ChatGPT Conversation](project.pdf)

## CREATE APACHE2 FILE E EDIT IT
```bash
sudo nano /etc/apache2/sites-available/tareservado.conf
```

```bash
<VirtualHost *:80>
    ServerName tareservado.pt
    ServerAlias www.tareservado.pt tareservado.com www.tareservado.com 
    DocumentRoot /var/www/tareservado/public

    <Directory /var/www/tareservado>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/tareservado.log
    CustomLog ${APACHE_LOG_DIR}/tareservado.log combined
RewriteEngine on
RewriteCond %{SERVER_NAME} =tareservado.pt [OR]
RewriteCond %{SERVER_NAME} =www.tareservado.pt
RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
</VirtualHost>
```

## ACTIVATE THE CONFIG, TEST IT AND RELOAD APACHE2
```bash
sudo a2ensite tareservado.conf
sudo apache2ctl configtest
sudo systemctl reload apache2
```

## GIT CLONE WITH FIX PERMISSIONS AND CREATE THE SYMBOLIC LINK
```bash
cd /home/jpbgomes/Deskop
sudo git clone https://github.com/jpbgomes/tareservado.git

cd /home/jpbgomes/Desktop/tareservado

sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

sudo ln -s /home/jpbgomes/Desktop/tareservado /var/www/tareservado
```

## RUN AND ACTIVATE THE SSL CERTIFICATES
```bash
sudo certbot --apache -d tareservado.com -d www.tareservado.com -d tareservado.pt -d www.tareservado.pt
```

## CREATE THE AUTOMATIONS FOR THE PROJECT DATABASE BACKUPS
```
sudo crontab -e
```

```bash
0 4 * * * php /var/www/tareservado/artisan backup:database >> /dev/null 2>&1
```

```bash
sudo mysql -u root -p
```

```bash
CREATE DATABASE tareservado;
CREATE USER 'tareservado'@'localhost' IDENTIFIED BY '<dO>-O20]2P0';
GRANT ALL PRIVILEGES ON tareservado.* TO 'tareservado'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```
