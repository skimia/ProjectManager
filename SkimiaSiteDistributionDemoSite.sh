#!/bin/bash
echo [[CleanUps]]

cp -f ./parameters.yml /home/skimia-agency/sites/skimia-agency/spm/app/config/
echo [[Welcome to Skimia SPM Autoinstall]]
cd /home/skimia-agency/sites/skimia-agency/spm/
git stash
git pull
cp -f /home/skimia-agency/scripts/parameters.yml /home/skimia-agency/sites/skimia-agency/spm/app/config/
echo [[Updating composer]]
php ./composer.phar self-update
echo [[Updating vendors]]
php ./composer.phar update
chmod 777 app/ --recursive
echo [[Database Install]]
php app/console doctrine:schema:update --force
echo [[Assets Install]]
php app/console assets:install web
php app/console assetic:dump --env=prod --no-debug
echo [[Cache Clear]]
php app/console cache:clear
php app/console cache:clear --env=prod
echo [[Users Create]]
echo [[Sucessfull install]]
echo [[Admin_User : admin password]]
echo [[Simple_User : user password]]
