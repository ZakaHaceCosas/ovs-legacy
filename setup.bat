@echo off

REM Step b: Create shortcut on the desktop to open the application
REM Skipping this step to remove the shortcut creation.

REM Step c: Create batch file to restart OVS
echo @echo off > "%userprofile%\Desktop\Restart_OVS.bat"
echo php -S localhost:8080 -t "C:\OVS\app" >> "%userprofile%\Desktop\Restart_OVS.bat"
echo Restart script for OVS created.

REM Step d: Create shortcut with custom name and icon for "Startup Apps" menu
echo [InternetShortcut] > "%userprofile%\Desktop\OVS_Server.url"
echo URL=http://localhost:8080 >> "%userprofile%\Desktop\OVS_Server.url"
echo IconFile=C:\OVS\dist-info\i\fav.ico >> "%userprofile%\Desktop\OVS_Server.url"
echo IconIndex=0 >> "%userprofile%\Desktop\OVS_Server.url"
echo IDList= >> "%userprofile%\Desktop\OVS_Server.url"
echo HotKey=0 >> "%userprofile%\Desktop\OVS_Server.url"
echo Shortcut for Startup Apps menu created.

echo Setup completed successfully.
