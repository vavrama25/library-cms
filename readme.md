# 📚 Knihovní CMS & Výpůjční Systém

Webový redakční a výpůjční systém pro správu knižního fondu a čtenářských výpůjček. Aplikace je napsána v čistém PHP s relační databází MariaDB, využívá responzivní rozhraní postavené na šabloně SB Admin 2 a je optimalizována pro nasazení za reverzní proxy Nginx.

---

## 🚀 Hlavní Funkcionality

### Čtenářské rozhraní
- **Katalog publikací:** Procházení a vyhledávání knih podle názvu a autora s dynamickým náhledem obálek.
- **Detail knihy:** Informace o vydání, anotace, stav dostupnosti a možnost rezervace / vytvoření výpůjčky.
- **Klientský účet:** Přehled aktivních i historických výpůjček, sledování lhůt pro vrácení a upozornění na překročené termíny.
- **Autentizace:** Registrace nových čtenářů, bezpečné přihlašování se session managementem a obnova hesla.

### Administrační rozhraní (Knihovna Admin)
- **Dashboard:** Přehledová statistika o celkovém stavu knižního fondu, počtu registrovaných čtenářů a aktivních výpůjčkách.
- **Správa výpůjček (`/admin/borrowed`):**
  - Filtrace aktivních výpůjček a výpůjček po termínu vrácení.
  - Akce jedním kliknutím: **Vrátit** nebo **Ztraceno**.
  - Identifikace čtenáře a termínu přímo na kartě výpůjčky.
- **Správa katalogu (`/admin/books`):** Evidence knižních titulů, přidávání nových položek, úprava metadat a vyřazování knih.
- **Správa čtenářů (`/admin/readers`):** Přehled uživatelských profilů a historie výpůjček jednotlivých čtenářů.
- **Nastavení systému (`/admin/settings`):** Správa globálních systémových hodnot a parametrů routování.

---

## 🛠 Technologický Stack

- **Backend:** PHP 8.x (Vanilla PHP s vlastním routovacím systémem)
- **Databáze:** MariaDB / MySQL
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap (SB Admin 2), FontAwesome
- **Webový server:** Nginx (s PHP-FPM)
- **Zabezpečení:** HTTPS (SSL/TLS certifikace, Cloudflare proxy)

---

## 📁 Struktura Projektu

```text
CMS/
├── admin-folder/           # Kontrolery a šablony administračního modulu
│   ├── borrowed.php        # Správa výpůjček, stavů a termínů
│   ├── books.php           # Správa katalogu knih
│   └── readers.php         # Správa uživatelských účtů čtenářů
├── lib/                    # Jádro aplikace a sdílené knihovny
│   ├── db.php              # Ovladač připojení k MariaDB
│   ├── routing.php         # Pomocné funkce pro směrování (url())
│   └── auth.php            # Autentizace, autorizace a správa session
├── pages/                  # Veřejně přístupné pohledy
│   ├── login.php           # Přihlašovací formulář
│   ├── register.php        # Registrační formulář
│   └── detail.php          # Detail knihy
├── startbootstrap-.../     # Statické assety (CSS, JS šablony SB Admin 2)
├── index.php               # Front Controller aplikace
└── README.md
```

---

## ⚙️ Instalace a Konfigurace

### 1. Klonování repozitáře
```bash
cd /var/www/html
git clone <URL_REPOZITARE> CMS
cd CMS
```

### 2. Konfigurace databáze
Vytvořte databázi v MariaDB a importujte výchozí schéma:
```sql
CREATE DATABASE `cms-martin` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- mysql -u root -p cms-martin < schema.sql
```

Zkontrolujte nastavení `base_url` v tabulce nastavení:
```sql
UPDATE `cms-settings` SET `setting_value` = '/' WHERE `setting_key` = 'base_url';
```

Nastavte přihlašovací údaje k databázi v souboru konfigurace (`lib/db.php`):
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'cms_user');
define('DB_PASS', 'bezpecne_heslo');
define('DB_NAME', 'cms-martin');
```

### 3. Konfigurace routování (`lib/routing.php`)
Pokud aplikace běží na samostatné subdoméně:
```php
define('BASE_URL', '/');
```
Pokud běží v podsložce webového serveru:
```php
define('BASE_URL', '/projects/CMS/');
```

### 4. Konfigurace webového serveru Nginx
Vytvořte virtuální host (`/etc/nginx/sites-available/cms.martinvavra.space`):

```nginx
server {
    listen 80;
    server_name cms.martinvavra.space;
    root /var/www/html/projects/CMS;
    index index.php index.html;

    # Ošetření přepisování URL na front controller
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Zpracování PHP skriptů přes PHP-FPM
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Blokování přístupu k citlivým souborům
    location ~ /\.ht {
        deny all;
    }
}
```

Aktivujte konfiguraci a restartujte Nginx:
```bash
sudo ln -s /etc/nginx/sites-available/cms.martinvavra.space /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

---

## 🔒 Bezpečnostní mechanismy

- **Prepared Statements:** SQL dotazy jsou parametrizovány pro zamezení SQL injection zranitelnostem.
- **XSS Filtrace:** Výstupy proměnných vkládaných do HTML jsou ošetřeny funkcí `htmlspecialchars()`.
- **Role-Based Access Control (RBAC):** Chráněné sekce administrace vyžadují ověření session a oprávnění administrátora.
- **Zabezpečený přenos:** Web komunikuje šifrovaně přes HTTPS s platnými certifikáty.

---

## 👤 Autor

- **Martin Vávra** ([vavrama25@sps-prosek.cz](mailto:vavrama25@sps-prosek.cz))
- **Web:** [martinvavra.space](https://martinvavra.space)
- **Projekt:** [cms.martinvavra.space](https://cms.martinvavra.space)