#!/usr/bin/env bash

#install wp-cli
sudo wget -q https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -O /usr/bin/wp
sudo chown user /usr/bin/wp
sudo chmod 755 /usr/bin/wp

#array of plugin to install
#Nr: 1 2 (3 is in 1) (4 in 1 or use script) (5? I do not wanna share my passwords) 6 7 (8 a automated Lets encrypt is possible but too much) 9 (10 in 1) 11 12 15 (18 in 1) 21
WPPLUGINS=( better-wp-security miniorange-2-factor-authentication bulletproof-security askapache-password-protect force-strong-passwords wordfence wp-dbmanager wp-security-audit-log all-in-one-wp-security-and-firewall )
#path to WordPress installation
WPPATH=/var/www/wp
#loop install and activate plugins
for WPPLUGIN in "${WPPLUGINS[@]}"; do
#check if plugin is installed
    wp plugin is-installed $WPPLUGIN --path=$WPPATH --allow-root
#install plugin
    if [ $? -eq 1 ]; then
        wp plugin install $WPPLUGIN --activate --path=$WPPATH --allow-root
    fi
done
#if root
sudo chown -R www-data:www-data $WPPATH
sudo find $WPPATH -type f -exec chmod 644 {} +
sudo find $WPPATH -type d -exec chmod 755 {} +
#if 4 should be auto
mv $WPPATH/wp-login.php $WPPATH/my_secure_login.php
mv $WPPATH/wp-admin $WPPATH/my_secure_admin
#add cron daily backup Nr 13
chmod +X $WPPATH/backup.sh
echo "0 3 * * * root" + $WPPATH + "/backup.sh" >> /etc/crontab
echo "" >> /etc/crontab
#move wp-config.php Nr 16
mv $WPPATH/wp-config.php $WPPATH/../wp-config.php
#Nr 17
echo "define('DISALLOW_FILE_EDIT', true);" >> $WPPATH/../wp-config.php
#Nr 20
echo "Options All -Indexes" >> .htaccess
#Nr 23 wp has autoupdate function
#Nr 24
echo "function wpbeginner_remove_version() {" >> $WPPATH/functions.php
echo "return '';" >> $WPPATH/functions.php
echo "}" >> $WPPATH/functions.php
echo "add_filter('the_generator', 'wpbeginner_remove_version');" >> $WPPATH/functions.php