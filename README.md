# Hide WP Admin Bar via URL Parameter

**With this plugin you can hide the WordPress admin bar using a URL parameter — ideal for developers that need a quick solution to take clean screenshots without the top toolbar when developing.**

---

## 📦 Description

This plugin allows logged-in users to hide the WordPress admin bar by adding a simple `?hide` parameter to the URL. The bar is hidden for a specified duration (in minutes) using a secure cookie.

---

## 🚀 Features

- Hide the admin bar using the `?hide` URL parameter
- Customizable duration in minutes: `?hide=5` hides it for 5 minutes
- Sets a secure cookie (`HttpOnly`, `SameSite=Strict`)
- Compatible with PHP 7.3+ and modern WordPress versions
- No additional configuration required
- Clean and functional code
- Fully WPCS-compliant (WordPress Coding Standards)

---

## 🔧 Usage

Simply add `?hide` to any page URL while logged in:

| URL                                      | Behavior                                   |
|-----------------------------------------|--------------------------------------------|
| `https://yoursite.com/?hide`            | Hides the admin bar for 1 minute (default) |
| `https://yoursite.com/?hide=10`         | Hides the bar for 10 minutes               |
| `https://yoursite.com/?hide=`           | Defaults to 1 minute                       |
| `https://yoursite.com/?hide=0`          | Does not hide or set a cookie              |
| `https://yoursite.com/`                 | Keeps hidden if the cookie is still valid  |

---

## ⚙️ Advanced Options

| Parameter     | Type      | Description                                      |
|---------------|-----------|--------------------------------------------------|
| `hide`        | int/bool  | Number of minutes to hide the bar. Defaults to 1 |
| `hide=0`      | int       | Disables the feature and avoids setting a cookie |

---

## 🛡 Security

- Uses `sanitize_text_field()` and `wp_unslash()` for safe input handling
- Sets secure cookie attributes:
  - `HttpOnly`
  - `SameSite=Strict`

---

## 🧪 Compatibility

- PHP 7.3 or higher
- WordPress 6.7.2 or higher
- Works with both classic and block-based themes
- Tracking links compatible

---

## 📁 Installation

1. Upload the plugin folder to `wp-content/plugins`
2. Activate the plugin from the WordPress dashboard
3. Use `?hide` in any URL while logged in to hide the admin bar

---

## 📄 Example

```url
https://yoursite.com/product-page/?hide=15
```

This will hide the admin bar for 15 minutes.

---

## 🧼 Clean Code

- Follows WordPress Coding Standards (WPCS)
- No critical warnings in PHPCS
- Secure, functional, and dependency-free

---

## 📚 Additional Notes

- This plugin does **not** affect users who are not logged in.
- Ideal for client demos, screenshots, or distraction-free sharing.

---

## 🛠 Author

Developed by [Ricardo Ambriz](https://ricardoambriz.com)

Contributions and suggestions are always welcome!