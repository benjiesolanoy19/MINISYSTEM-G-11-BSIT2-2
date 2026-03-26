@echo off
REM CLFMS - Material UI + GSAP + Alpine.js Installation Script
REM This script installs all required dependencies and builds the project

echo ================================
echo CLFMS Enhancement Installation
echo ================================
echo.

REM Check if Node.js is installed
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Node.js is not installed!
    echo Please download and install Node.js from https://nodejs.org/
    echo Then run this script again.
    pause
    exit /b 1
)

echo Node.js is installed:
node --version
echo.

REM Check npm
npm --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: npm is not found!
    echo Please reinstall Node.js or add npm to your PATH.
    pause
    exit /b 1
)

echo npm is ready:
npm --version
echo.

REM Navigate to project directory
cd /d "%~dp0"
echo Working directory: %cd%
echo.

REM Install dependencies
echo ================================
echo Installing dependencies...
echo ================================
call npm install
if %errorlevel% neq 0 (
    echo ERROR: Failed to install dependencies!
    pause
    exit /b 1
)

echo.
echo ================================
echo Building assets...
echo ================================
call npm run build
if %errorlevel% neq 0 (
    echo ERROR: Failed to build assets!
    pause
    exit /b 1
)

echo.
echo ================================
echo Installation Complete!
echo ================================
echo.
echo Your project has been successfully enhanced with:
echo   ✓ Material Design UI System
echo   ✓ GSAP Animations
echo   ✓ Alpine.js Interactivity
echo.
echo Next steps:
echo   1. Start your Laravel development server: php artisan serve
echo   2. Run "npm run dev" for development with hot reload
echo   3. Run "npm run build" before deploying to production
echo.
echo For development, open two terminal windows:
echo   Terminal 1: npm run dev
echo   Terminal 2: php artisan serve
echo.
pause
