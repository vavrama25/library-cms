@echo off
cd /d "%~dp0"
tailwindcss.exe -i .\src\input.css -o .\dist\output.css --watch
pause