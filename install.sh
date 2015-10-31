#!/bin/bash

# www dir
if [ ! -d "/www"]; then  
  mkdir /www
  mkdir /www/git
  mkdir /www/app
  chown www-data:www-data /www -R
fi

# generate apache ssh-key
#sudo -u www-data ssh-keygen -t rsa

# config apache2 vhost config file
cp -rf init/server_ui.conf /etc/apache2/sites-available/server_ui.conf
a2ensite server_ui
service apache2 reload

# copy app to /var/www/server_ui
mkdir /var/www/server_ui
cp -rf app/* /var/www/server_ui
chown www-data.www-data /var/www/server_ui -R


chown root.root /var/www/server_ui/confi_bin  && chmod 6755 /var/www/server_ui/conf_bin


# ssh key manager
#sudo -u www-data ssh-keygen -t rsa
#ssh-keyscan -p 2222 -t ecdsa,rsa 120.24.240.96 >> /var/www/.ssh/known_hosts
#chown www-data:www-data /var/www/.ssh -R
