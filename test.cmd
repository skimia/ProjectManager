@echo off
echo [[ Skimia Preinstall Repo ]]
echo Bienvenue dans la creation de projet Skimia
echo.
echo [Etape1] Verification des dependances
git >nul 2>&1
if errorlevel 9009 if not errorlevel 9010 (
    echo [Erreur] GIT n'est pas installé ou n'est pas disponible dans l'invite de commandes
    pause
    exit
)

php --help >nul 2>&1
if errorlevel 9009 if not errorlevel 9010 (
    echo [Erreur] PHP n'est pas installé ou n'est pas disponible dans l'invite de commandes
    pause
    exit
)
php -r "echo extension_loaded('zip');">PHPZIP
set /p PHPZIP=<PHPZIP
erase PHPZIP

if "%PHPZIP%" == "0" (
	echo [Erreur] PHP n'est pas installe ou n'est pas disponible dans l'invite de commandes
	pause
    exit
)

echo [Etape1] Terminee
ping 127.0.0.1 -n 3 > NUL 


cls
echo [[ Skimia Preinstall Repo ]]
echo Bienvenue dans la creation de projet Skimia
echo.
echo [Etape2] Chargement des commandes
git clone http://github.com/skimia/commands.git commands
echo [Etape2] Terminee
ping 127.0.0.1 -n 3 > NUL 

cls
echo [[ Skimia Preinstall Repo ]]
echo Bienvenue dans la creation de projet Skimia
echo.
echo [Sucess] Finit ! Pret pour l'installation?
ping 127.0.0.1 -n 3 > NUL 

cd commands

php install_full