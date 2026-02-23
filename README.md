# 🍕 Foodpanda App — SSO with Keycloak

A Laravel 12.x application integrated with **Keycloak Single Sign-On (SSO)**. Users authenticate via Keycloak — no local username/password login exists. If a user is already logged in to `ecommerce-app`, they are automatically authenticated here without re-entering credentials.

---

## 📐 How SSO Works

```
[User already logged in to ecommerce-app]
      │
      └──► visits foodpanda-app
                  │
                  └──► redirected to Keycloak
                              │
                   (Keycloak sees active session)
                   (NO password prompt)
                              │
                  ◄───────────┘
           (redirected back logged in automatically)
                  │
           ──► /dashboard ✅
```

- **Protocol:** OpenID Connect (OIDC) — Authorization Code Flow
- **Token validation:** Local JWT validation (no Keycloak call per request)
- **Single Logout:** Logging out here notifies all other apps via Keycloak backchannel

---

## 🛠 Prerequisites

- PHP `>= 8.3`
- Composer `>= 2.x`
- MySQL `>= 8.0`
- [Keycloak SSO](https://github.com/funkyd3v/keycloak-sso) running on `http://localhost:8080`

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/funkyd3v/foodpanda-app.git
cd foodpanda-app
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Create Environment File

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Configure `.env`

Open `.env` and update the following:

```env
APP_NAME="Foodpanda App"
APP_URL=http://localhost:8002

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=foodpanda_app
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

SESSION_DRIVER=database

KEYCLOAK_CLIENT_ID=foodpanda-client
KEYCLOAK_CLIENT_SECRET=your_client_secret_from_keycloak
KEYCLOAK_REDIRECT_URI=http://localhost:8002/auth/callback
KEYCLOAK_BASE_URL=http://localhost:8080
KEYCLOAK_REALM=sso-realm
```

> 💡 Get `KEYCLOAK_CLIENT_SECRET` from Keycloak Admin Console → `sso-realm` → Clients → `foodpanda-client` → Credentials tab.

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Start the Server

```bash
php artisan serve --port=8002
```

---

## 🌐 Access

| Page | URL |
|---|---|
| Welcome | http://localhost:8002 |
| Login (redirects to Keycloak) | http://localhost:8002/login |
| Dashboard (protected) | http://localhost:8002/dashboard |
| Logout | POST http://localhost:8002/logout |

---

## 🔑 Authentication Flow

This app uses **Keycloak as the only authentication method**. There is no local username/password login.

1. Visit any protected route (e.g. `/dashboard`)
2. Automatically redirected to `/login`
3. `/login` immediately redirects to Keycloak login page
4. If already logged in to another app → **auto-authenticated, no password needed** ✅
5. If not logged in → enter credentials on Keycloak
6. Keycloak redirects back to `/auth/callback`
7. App creates or updates local user record
8. Local session created — you're in ✅

### User Provisioning

On first login, a local user record is automatically created from Keycloak token claims:

| Keycloak Claim | Local Field |
|---|---|
| `sub` | `keycloak_id` (primary SSO identifier) |
| `email` | `email` |
| `name` | `name` |
| `email_verified` | `email_verified_at` |

> The `sub` claim is the permanent, stable identifier. Email alone is never used as the primary SSO key.

---

## 🚪 Single Logout (SLO)

When a user logs out:

1. Local Laravel session is invalidated
2. User is redirected to Keycloak's logout endpoint
3. Keycloak destroys the central SSO session
4. Keycloak sends a **backchannel logout POST** to all other connected apps
5. All app sessions for this user are invalidated everywhere

The backchannel logout endpoint is available at:
```
POST /auth/logout/backchannel
```

This endpoint is called **server-to-server by Keycloak** — not by the user's browser.

---

## 📁 Project Structure

```
app/
├── Http/
│   └── Controllers/
│       └── Auth/
│           └── KeycloakController.php   # Handles redirect, callback, logout
├── Services/
│   └── KeycloakUserService.php          # User provisioning logic
├── Models/
│   └── User.php
config/
├── services.php                          # Keycloak client config
routes/
├── web.php                               # Main routes
├── auth.php                              # Auth-specific routes
```

---

## ⚙️ Key Configuration

**`config/services.php`**

```php
'keycloak' => [
    'client_id'     => env('KEYCLOAK_CLIENT_ID'),
    'client_secret' => env('KEYCLOAK_CLIENT_SECRET'),
    'redirect'      => env('KEYCLOAK_REDIRECT_URI'),
    'base_url'      => env('KEYCLOAK_BASE_URL'),
    'realm'         => env('KEYCLOAK_REALM'),
],
```

---

## 🔄 Useful Commands

```bash
# Clear all caches
php artisan optimize:clear

# Run migrations fresh
php artisan migrate:fresh

# Start server
php artisan serve --port=8002
```

---

## 🧪 Testing SSO

To verify SSO is working correctly:

1. Start Keycloak → `http://localhost:8080`
2. Start ecommerce-app → `http://localhost:8001`
3. Start foodpanda-app → `http://localhost:8002`
4. Login to ecommerce-app via `http://localhost:8001/auth/redirect`
5. Open `http://localhost:8002/auth/redirect` in the **same browser**
6. You should be logged in automatically — no password prompt ✅

To test Single Logout:

1. While logged in to both apps, logout from ecommerce-app
2. Try accessing `http://localhost:8002/dashboard`
3. You should be redirected to login — session invalidated ✅

---

## 🔗 Related Repositories

- [keycloak-sso](https://github.com/funkyd3v/keycloak-sso) — Keycloak Identity Provider (start this first)
- [ecommerce-app](https://github.com/funkyd3v/ecommerce-app) — Sister app demonstrating SSO

---

## ⚠️ Important Notes

- **Start Keycloak first** before running this app
- **Session driver must be `database`** — file sessions don't survive in cloud deployments
- This app has **no registration page** — all users are managed in Keycloak
- Each app maintains its **own independent database and session** — nothing is shared
- **Never share** `KEYCLOAK_CLIENT_SECRET` — keep it in `.env` only
