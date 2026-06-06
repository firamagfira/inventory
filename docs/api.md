# Dokumentasi API - Inventory System v1

Dokumentasi ini berisi daftar lengkap endpoint API berversi `v1` untuk sistem Inventory. Semua request ke endpoint yang dilindungi (kecuali Register dan Login) harus menyertakan header `Authorization: Bearer {token}`.

---

## 1. Autentikasi (Authentication)

### A. Register User Baru
Mendaftarkan user baru ke dalam sistem.

* **URL:** `/api/v1/register`
* **Method:** `POST`
* **Headers:**
  ```http
  Accept: application/json
  Content-Type: application/json
