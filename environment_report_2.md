# Phase 0: Development Environment Report (XAMPP Update)

## 1. Current Environment Status

| Component | Required Version | Current Version | Status |
| :--- | :--- | :--- | :--- |
| **Laravel target** | 10 LTS | N/A | Pending setup |
| **Project Path** | `C:\xampp\htdocs\VoteTune` | Not Found | Will be created |
| **PHP** | 8.2+ | 7.4.12 | ❌ FAILED |
| **PHP Location**| - | `C:\xampp\php\php.exe` | - |
| **Composer** | Latest | 2.9.2 | ✅ PASSED |
| **Node.js** | LTS | v22.14.0 | ✅ PASSED |
| **npm** | Latest | 10.9.2 | ✅ PASSED |
| **Git** | Latest | 2.48.1.windows.1| ✅ PASSED |
| **Database** | MySQL (XAMPP) | MariaDB 10.4.16 | ✅ Acceptable for Laravel 10 |

## 2. Upgrade Requirement: XAMPP PHP 8.2+

Per your updated requirements, we will **strictly use XAMPP** and target **Laravel 10 LTS**. 

Laravel 10 requires a minimum of **PHP 8.1**, and your requirement specifies **PHP 8.2+**. Your current XAMPP installation is running **PHP 7.4.12**.

> [!WARNING]  
> Because upgrading the core PHP engine inside an existing XAMPP installation involves swapping out Apache module DLLs (`php7apache2_4.dll` to `php8apache2_4.dll`), editing Apache config files, and replacing the `C:\xampp\php` directory while services are stopped, doing this autonomously via terminal scripts is highly risky and could permanently break your XAMPP server.

### Recommended Action: Upgrade XAMPP Manually
To safely satisfy the PHP 8.2+ requirement, please perform **one** of the following:

**Option A (Safest & Easiest): Reinstall XAMPP**
1. Backup your `C:\xampp\htdocs` and export your databases from phpMyAdmin.
2. Uninstall your current XAMPP.
3. Download and install the latest [XAMPP for Windows with PHP 8.2](https://www.apachefriends.org/download.html).

**Option B (Manual Core Upgrade):**
1. Stop Apache from the XAMPP Control Panel.
2. Rename `C:\xampp\php` to `C:\xampp\php_old`.
3. Download the **PHP 8.2 (Thread Safe) Zip** from [windows.php.net](https://windows.php.net/download/).
4. Extract it to `C:\xampp\php`.
5. Rename `php.ini-development` to `php.ini` and enable necessary extensions (curl, mbstring, pdo_mysql, fileinfo, zip, openssl).
6. Edit `C:\xampp\apache\conf\extra\httpd-xampp.conf` to replace all references of `php7` with `php` or `php8` (e.g., `LoadModule php_module "/xampp/php/php8apache2_4.dll"`).
7. Start Apache.

## 3. Next Steps

Once you have updated XAMPP and `php -v` inside your terminal outputs **8.2 or higher**, please let me know. I will then immediately execute Phase 1.1 to initialize the Laravel 10 project inside `C:\xampp\htdocs\VoteTune`.
