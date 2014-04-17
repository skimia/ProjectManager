<?php
chdir('..');

exec('git fetch --all');
exec('git reset --hard HEAD');
?>