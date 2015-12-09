#!/bin/bash
cp -rf app/* /var/www/server_ui
chown www-data.www-data /var/www/server_ui -R

chown root.root /var/www/server_ui/conf_bin  && chmod 6755 /var/www/server_ui/conf_bin
chown root.root /var/www/server_ui/conf_rm_bin  && chmod 6755 /var/www/server_ui/conf_rm_bin

