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

# compile c program
gcc conf_bin.c -o conf_bin 
gcc conf_rm_bin.c -o conf_rm_bin
mv conf_bin app/conf_bin
mv conf_rm_bin app/conf_rm_bin

# copy app to /var/www/server_ui
mkdir /var/www/server_ui
cp -rf app/* /var/www/server_ui
chown www-data.www-data /var/www/server_ui -R

# chmod conf_bin
chown root.www-data /var/www/server_ui/conf_bin  && chmod 6750 /var/www/server_ui/conf_bin
chown root.www-data /var/www/server_ui/conf_rm_bin  && chmod 6750 /var/www/server_ui/conf_rm_bin


# ssh key manager
#sudo -u www-data ssh-keygen -t rsa
#ssh-keyscan -p 2222 -t ecdsa,rsa 120.24.240.96 >> /var/www/.ssh/known_hosts
#chown www-data:www-data /var/www/.ssh -R
