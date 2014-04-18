#!/bin/bash
echo [[CleanUps]]

cp -f ./parameters.yml /home/skimia-agency/sites/skimia-agency/spm/app/config/
echo [[Welcome to Skimia SPM Autoinstall]]
cd /home/skimia-agency/sites/skimia-agency/spm/
git stash
git pull
echo [[Updating composer]]
php ./composer.phar self-update
echo [[Updating vendors]]
php ./composer.phar update
chmod 777 app/ --recursive
echo [[Database Install]]
php app/console doctrine:schema:update --force
echo [[Database Load Fixtures]]
php app/console fos:user:create client client@example.com password
php app/console doctrine:fixtures:load --append
echo [[Assets Install]]
php app/console assets:install web
php app/console assetic:dump --env=prod --no-debug
echo [[Cache Clear]]
php app/console cache:clear
echo [[Users Create]]
php app/console fos:user:create admin admin@example.com password --super-admin
php app/console fos:user:create user user@example.com password
echo [[Sucessfull install]]
echo [[Admin_User : admin password]]
echo [[Simple_User : user password]]
