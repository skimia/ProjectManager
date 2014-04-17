<?php
exec("git clone http://github.com/skimia/commands.git commands");
chdir("commands");
exec("php install_full");
?>