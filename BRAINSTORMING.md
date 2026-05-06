# 📋 BRAINSTORMING SISTEM PENERIMAAN SISWA

## 🎯 FASE 1: PEMAHAMAN KONSEP & IDEASI

### 1.1 Latar Belakang Masalah
- **Masalah Existing:** Proses penerimaan siswa yang manual, lambat, dan tidak terorganisir
- **Pain Points:**
  - Data tersebar di berbagai dokumen
  - Kesulitan tracking status calon siswa
  - Tidak ada sistem verifikasi otomatis
  - Kesulitan dalam reporting & analisis
  - Transparansi rendah untuk orang tua/calon siswa

### 1.2 Tujuan Sistem
✅ Otomatisasi seluruh proses penerimaan siswa
✅ Mempercepat pengolahan data aplikasi
✅ Meningkatkan transparansi & komunikasi
✅ Menghasilkan laporan real-time
✅ Mengurangi beban administratif

### 1.3 Target User
1. **Admin/Staff Sekolah** - Manage aplikasi, verifikasi data
2. **Calon Siswa & Orang Tua** - Submit aplikasi, tracking status
3. **Panitia Penerimaan** - Review, scoring, seleksi
4. **Kepala Sekolah** - Melihat dashboard & report

---

## 🏗️ FASE 2: RANCANGAN SISTEM

### 2.1 Arsitektur Umum

```
┌─────────────────────────────────────────────────┐
│          PENERIMAAN SISWA SYSTEM                │
├─────────────────────────────────────────────────┤
│                                                   │
│  ┌──────────────┐    ┌──────────────┐           │
│  │   Frontend   │───▶│   Backend    │           │
│  │  (Web/App)   │    │  (Laravel)   │           │
│  └──────────────┘    └──────────────┘           │
│         △                    │                    │
│         │                    ▼                    │
│  ┌──────────────────────────────────┐           │
│  │     Database (MySQL/PostgreSQL)   │           │
│  └──────────────────────────────────┘           │
│                                                   │
└─────────────────────────────────────────────────┘
```

### 2.2 Stack Teknologi
- **Backend:** Laravel 11 (PHP) ✅
- **Frontend:** Blade Templates / Vue.js
- **Database:** MySQL/PostgreSQL
- **Authentication:** Laravel Auth / JWT
- **File Storage:** Local/Cloud (AWS S3)
- **Queue:** Redis/Database untuk proses background
- **Reporting:** Laravel Excel / PDF Generator

### 2.3 Fitur-Fitur Utama

#### 📝 **Modul 1: Pendaftaran & Aplikasi**
- Form registrasi calon siswa
- Upload dokumen (KTP, Akta, Raport, dll)
- Validasi dokumen otomatis
- Preview aplikasi sebelum submit
- Notification email konfirmasi

#### 📊 **Modul 2: Dashboard Calon Siswa**
- Status aplikasi real-time
- History timeline aplikasi
- Download dokumen yang sudah diupload
- Notifikasi hasil seleksi
- Chat/Ticket support

#### 🔍 **Modul 3: Admin Panel**
- Daftar semua aplikasi
- Filter & sorting (nama, tanggal, status)
- Edit data aplikasi
- Verifikasi dokumen
- Batch import data
- Manage templates dokumen

#### ⭐ **Modul 4: Scoring & Penilaian**
- Input nilai test (TPA, TIU, TKP, dll)
- Scoring otomatis berdasarkan rumus
- Weighted scoring system
- Ranking otomatis
- Kuota per jalur penerimaan

#### 📈 **Modul 5: Dashboard & Reporting**
- Total aplikasi masuk
- Statistik per jalur penerimaan
- Distribution chart gender, asal sekolah
- Export laporan Excel/PDF
- KPI monitoring

#### 🔐 **Modul 6: Manajemen User & Akses**
- Role-based access control (Admin, Panitia, Staff)
- Management user account
- Audit log semua aktivitas
- Permission management

---

## 📐 FASE 3: RANCANGAN DATABASE

### 3.1 Entity Relationship Diagram (ERD)

```
┌──────────────────┐
│      Users       │
├──────────────────┤
│ id (PK)          │
│ email            │
│ password         │
│ role             │
│ created_at       │
└────────┬─────────┘
         │
         ├─────────────────────────┐
         │                         │
┌────────▼──────────────┐  ┌──────▼──────────────┐
│  CalonSiswa           │  │  Panitia           │
├───────────────────────┤  ├────────────────────┤
│ id (PK)               │  │ id (PK)            │
│ user_id (FK)          │  │ user_id (FK)       │
│ no_pendaftar          │  │ departemen         │
│ nama_lengkap          │  │ no_telepon         │
│ email                 │  │ created_at         │
│ no_telepon            │  └────────────────────┘
│ tanggal_lahir         │
│ alamat                │
│ status                │
│ jalur_penerimaan      │
│ created_at            │
└────────┬──────────────┘
         │
         │
┌────────▼──────────────────┐
│  Aplikasi                 │
├───────────────────────────┤
│ id (PK)                   │
│ calon_siswa_id (FK)       │
│ status                    │
│ tanggal_submit            │
│ tanggal_verifikasi        │
│ catatan                   │
└────────┬──────────────────┘
         │
    ┌────┴────┬──────────────┐
    │          │              │
┌───▼──────┐ ┌▼──────────┐ ┌─▼─────────────┐
│Dokumen   │ │Penilaian  │ │HistoryStatus  │
├──────────┤ ├───────────┤ ├────────────────┤
│id (PK)   │ │id (PK)    │ │id (PK)        │
│aplikasi… │ │aplikasi…  │ │aplikasi_id(FK)│
│tipe_dok  │ │panitia_id │ │status_lama     │
│file_path │ │nilai_TPA  │ │status_baru     │
│status    │ │nilai_TIU  │ │tanggal_ubah    │
│upload_at │ │nilai_TKP  │ │keterangan      │
└──────────┘ │score      │ └────────────────┘
             │created_at │
             └───────────┘
```

### 3.2 Tabel-Tabel Utama

| Tabel | Deskripsi |
|-------|-----------|
| `users` | User login (Admin, Panitia, Staff) |
| `calon_siswa` | Data calon siswa |
| `aplikasi` | Data aplikasi penerimaan |
| `dokumen` | File dokumen yang diupload |
| `penilaian` | Nilai dan scoring calon siswa |
| `jalur_penerimaan` | Master jalur (Reguler, Prestasi, dll) |
| `history_status` | Audit trail status aplikasi |
| `settings` | Konfigurasi sistem |

### 3.3 Detail Struktur Tabel

#### Tabel: `users`
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'panitia', 'staff', 'calon_siswa') NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Tabel: `calon_siswa`
```sql
CREATE TABLE calon_siswa (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    no_pendaftar VARCHAR(50) UNIQUE NOT NULL,
    nama_lengkap VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    no_telepon VARCHAR(20) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    alamat TEXT NOT NULL,
    asal_sekolah VARCHAR(255) NOT NULL,
    tahun_lulus INT NOT NULL,
    jalur_penerimaan_id BIGINT NOT NULL,
    status ENUM('draft', 'submitted', 'verified', 'ditolak', 'diterima', 'cadangan') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (jalur_penerimaan_id) REFERENCES jalur_penerimaan(id)
);
```

#### Tabel: `aplikasi`
```sql
CREATE TABLE aplikasi (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    calon_siswa_id BIGINT NOT NULL,
    status ENUM('draft', 'submitted', 'verified', 'ditolak', 'diterima', 'cadangan') DEFAULT 'draft',
    tanggal_submit DATETIME,
    tanggal_verifikasi DATETIME,
    catatan TEXT,
    verified_by BIGINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (calon_siswa_id) REFERENCES calon_siswa(id) ON DELETE CASCADE,
    FOREIGN KEY (verified_by) REFERENCES users(id)
);
```

#### Tabel: `dokumen`
```sql
CREATE TABLE dokumen (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    aplikasi_id BIGINT NOT NULL,
    tipe_dokumen VARCHAR(100) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_size INT,
    status ENUM('uploaded', 'verified', 'rejected') DEFAULT 'uploaded',
    catatan TEXT,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    verified_at DATETIME,
    verified_by BIGINT,
    FOREIGN KEY (aplikasi_id) REFERENCES aplikasi(id) ON DELETE CASCADE,
    FOREIGN KEY (verified_by) REFERENCES users(id)
);
```

#### Tabel: `penilaian`
```sql
CREATE TABLE penilaian (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    aplikasi_id BIGINT NOT NULL,
    panitia_id BIGINT NOT NULL,
    nilai_tpa DECIMAL(5,2),
    nilai_tiu DECIMAL(5,2),
    nilai_tkp DECIMAL(5,2),
    nilai_akademik DECIMAL(5,2),
    nilai_wawancara DECIMAL(5,2),
    total_score DECIMAL(10,2),
    ranking INT,
    status_akhir ENUM('diterima', 'cadangan', 'ditolak') DEFAULT 'ditolak',
    catatan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (aplikasi_id) REFERENCES aplikasi(id) ON DELETE CASCADE,
    FOREIGN KEY (panitia_id) REFERENCES users(id)
);
```

#### Tabel: `jalur_penerimaan`
```sql
CREATE TABLE jalur_penerimaan (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    nama_jalur VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    kuota_total INT NOT NULL,
    kuota_terisi INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### Tabel: `history_status`
```sql
CREATE TABLE history_status (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    aplikasi_id BIGINT NOT NULL,
    status_lama VARCHAR(50),
    status_baru VARCHAR(50) NOT NULL,
    tanggal_ubah DATETIME NOT NULL,
    diubah_oleh BIGINT,
    keterangan TEXT,
    FOREIGN KEY (aplikasi_id) REFERENCES aplikasi(id) ON DELETE CASCADE,
    FOREIGN KEY (diubah_oleh) REFERENCES users(id)
);
```

#### Tabel: `settings`
```sql
CREATE TABLE settings (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    kunci VARCHAR(100) UNIQUE NOT NULL,
    nilai TEXT NOT NULL,
    tipe ENUM('string', 'number', 'boolean', 'json') DEFAULT 'string',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

---

## 🎨 FASE 4: RANCANGAN UI/UX

### 4.1 User Interface - Calon Siswa
```
HOME
├── Register / Login
├── Dashboard
│   ├── Status Aplikasi (Progress bar)
│   ├── Timeline aplikasi
│   └── Notifikasi terbaru
├── Buat Aplikasi Baru
│   ├── Pilih jalur penerimaan
│   ├── Form biodata
│   ├── Upload dokumen
│   └── Preview & Submit
└── Riwayat Aplikasi
```

### 4.2 User Interface - Admin/Panitia
```
ADMIN DASHBOARD
├── Overview (Stats, Charts)
├── Manajemen Aplikasi
│   ├── List aplikasi
│   ├── Filter & Search
│   ├── Verifikasi dokumen
│   └── Update status
├── Penilaian & Scoring
│   ├── Input nilai
│   ├── Auto ranking
│   └── Publish hasil
├── Laporan & Export
│   ├── Generate laporan
│   ├── Download Excel/PDF
│   └── Analytics
└── Settings
    ├── User management
    ├── Jalur penerimaan
    └── Dokumen templates
```

---

## 🔄 FASE 5: ALUR PROSES BISNIS

### 5.1 Flow Penerimaan Siswa

```
START
  │
  ▼
┌─────────────────────────┐
│ Calon Siswa Registrasi  │
│ (Buat akun)             │
└────────┬────────────────┘
         │
         ▼
┌─────────────────────────┐
│ Submit Aplikasi         │
│ (Biodata + Dokumen)     │
└────────┬────────────────┘
         │
         ▼
┌─────────────────────────┐
│ Admin Verifikasi        │
│ (Check dokumen)         │
└────────┬────────────────┘
         │
    ┌────┴─────────────────────┐
    │                          │
    ▼                          ▼
┌──────────┐          ┌─────────────┐
│ DITOLAK  │          │ DIVERIFIKASI│
└──────────┘          └────┬────────┘
    │                      │
    │                      ▼
    │              ┌─────────────────┐
    │              │ Panitia Input   │
    │              │ Nilai & Scoring │
    │              └────┬────────────┘
    │                   │
    │                   ▼
    │              ┌──────────────────┐
    │              │ Auto Ranking &   │
    │              │ Publish Hasil    │
    │              └────┬─────────────┘
    │                   │
    └───┬────────┬──────┘
        │        │
        ▼        ▼
    ┌──────┐ ┌───────┐
    │DITERIMA
    │        │CADANGAN│
    └──────┘ └───────┘
        │        │
        ▼        ▼
      SELESAI
```

### 5.2 Skenario Pengguna

#### Skenario 1: Calon Siswa Mendaftar
1. Calon siswa membuka halaman home
2. Klik tombol "Daftar Sekarang"
3. Isi form registrasi (nama, email, password, no telepon)
4. Verifikasi email
5. Login ke akun
6. Mulai membuat aplikasi

#### Skenario 2: Admin Verifikasi Dokumen
1. Admin login ke dashboard
2. Buka menu "Manajemen Aplikasi"
3. Pilih aplikasi yang akan diverifikasi
4. Review dokumen yang diupload
5. Terima atau tolak dokumen
6. Update status aplikasi
7. Kirim notifikasi ke calon siswa

#### Skenario 3: Panitia Input Nilai & Ranking
1. Panitia login ke dashboard
2. Buka menu "Penilaian & Scoring"
3. Pilih aplikasi yang sudah diverifikasi
4. Input nilai test (TPA, TIU, TKP, Akademik, Wawancara)
5. Sistem otomatis menghitung total score
6. Publish hasil untuk dilihat calon siswa

---

## 🛠️ FASE 6: TEKNOLOGI & TOOLS

### Frontend
- **Blade Templating** (Laravel)
- **Bootstrap 5** / **Tailwind CSS** untuk styling
- **Alpine.js** / **Vue.js** untuk interaktivitas
- **Chart.js** untuk visualisasi data

### Backend
- **Laravel 11**
- **Eloquent ORM** untuk database query
- **Laravel Validation** untuk input validation
- **Laravel Queue** untuk background jobs
- **Laravel Mail** untuk notifikasi email

### Database & Storage
- **MySQL 8.0** atau **PostgreSQL 13+**
- **Local Storage** atau **AWS S3** untuk file dokumen

### Third-Party Libraries
- **Laravel Excel** untuk export Excel
- **DomPDF** atau **TCPDF** untuk generate PDF
- **Mailtrap** atau **SendGrid** untuk email service
- **JWT** untuk API authentication

---

## 📅 FASE 7: ROADMAP PENGEMBANGAN

### Phase 1: MVP (Minggu 1-2)
- ✅ Setup Laravel project & struktur folder
- ✅ Database design & migration
- ✅ Authentication sistem (login, register)
- ✅ Form pendaftaran dasar calon siswa
- ✅ Admin list aplikasi (CRUD basic)

**Deliverable:** Sistem dapat menerima aplikasi baru

### Phase 2: Core Features (Minggu 3-4)
- ✅ Upload dokumen dengan validasi
- ✅ Admin verifikasi dokumen
- ✅ Status tracking real-time
- ✅ Scoring system & auto ranking
- ✅ Email notification otomatis
- ✅ Role-based access control

**Deliverable:** Admin bisa mengelola aplikasi secara menyeluruh

### Phase 3: Dashboard & Reporting (Minggu 5)
- ✅ Admin dashboard dengan statistics
- ✅ Export laporan ke Excel/PDF
- ✅ Analytics & charts
- ✅ Calon siswa dashboard
- ✅ Role management

**Deliverable:** Laporan lengkap tersedia untuk stakeholder

### Phase 4: Enhancement & Optimization (Minggu 6+)
- ✅ Mobile responsif & PWA
- ✅ Payment integration (jika ada registrasi berbayar)
- ✅ API documentation (RESTful API)
- ✅ Unit testing & integration testing
- ✅ Performance optimization & caching
- ✅ Security audit & penetration testing

**Deliverable:** Sistem siap production

---

## ⚠️ FASE 8: RISK MANAGEMENT & MITIGATION

| Risk | Dampak | Probabilitas | Mitigasi |
|------|--------|--------------|----------|
| Data loss/corruption | Kritis | Medium | Regular backup daily, Cloud redundancy, Database replication |
| Security breach/hacking | Kritis | Medium | HTTPS/SSL, Password encryption (bcrypt), Input validation, Firewall, Regular security updates |
| Performance lambat | Tinggi | Medium | Database indexing, Query optimization, Caching (Redis), CDN, Load balancing |
| User error/salah input | Medium | Tinggi | Client-side validation, Server-side validation, Confirmation dialog, Undo feature |
| Scalability terbatas | Medium | Medium | Microservices architecture, Database sharding, Horizontal scaling, Monitoring |
| Integrasi pihak ketiga gagal | Medium | Low | API fallback, Error handling, Documentation lengkap |
| Server downtime | Tinggi | Low | High availability setup, Redundant servers, Monitoring 24/7 |

---

## 🔐 FASE 9: KEAMANAN & COMPLIANCE

### Authentication & Authorization
- ✅ Password hashing dengan bcrypt
- ✅ Two-factor authentication (2FA) optional
- ✅ Session management yang aman
- ✅ Role-based access control (RBAC)
- ✅ API key management

### Data Protection
- ✅ Encryption untuk data sensitif (KTP, Akta)
- ✅ HTTPS/SSL untuk semua komunikasi
- ✅ CORS configuration yang ketat
- ✅ SQL injection prevention
- ✅ XSS & CSRF protection

### Audit & Logging
- ✅ Log semua aktivitas user
- ✅ Audit trail untuk perubahan data
- ✅ Monitoring file upload
- ✅ Alert untuk aktivitas mencurigakan

### Compliance
- ✅ GDPR compliance (jika ada user EU)
- ✅ Data privacy policy yang jelas
- ✅ Terms of service
- ✅ Cookie consent

---

## 📊 FASE 10: MONITORING & MAINTENANCE

### Monitoring Tools
- **New Relic** / **DataDog** untuk performance monitoring
- **Sentry** untuk error tracking
- **Uptime Robot** untuk server monitoring
- **Google Analytics** untuk user behavior

### Maintenance Schedule
- **Daily:** Database backup, Log review
- **Weekly:** Security patch check, Performance review
- **Monthly:** Full system audit, Capacity planning
- **Quarterly:** Security penetration testing, Feature review

### KPI Tracking
- Application submission rate
- Document verification time
- Admin processing time
- User satisfaction score
- System uptime percentage

---

## 💡 FASE 11: FITUR LANJUTAN (Future)

### Feature Enhancements
- SMS notification untuk calon siswa
- WhatsApp bot untuk inquiries
- Video call interview integration
- AI-based document verification
- Mobile app native (iOS/Android)
- SSO dengan Google/Facebook
- Advanced analytics & ML predictions
- Offline mode untuk admin

### Integration Options
- LMS (Learning Management System)
- ERP (Enterprise Resource Planning)
- HRIS (Human Resources Information System)
- Payment gateway (Midtrans, Xendit)
- SMS gateway (Nexmo, Twilio)

---

## 📞 FASE 12: SUPPORT & DOCUMENTATION

### User Documentation
- User manual untuk calon siswa
- Admin guide lengkap
- Video tutorial
- FAQ & troubleshooting

### Technical Documentation
- API documentation
- Database schema documentation
- Architecture overview
- Deployment guide
- Development setup guide

### Support Channels
- Email support: support@sekolah.com
- Live chat di website
- Ticket system
- Knowledge base

---

## ✨ KESIMPULAN

Sistem Penerimaan Siswa ini dirancang untuk:
1. **Meningkatkan Efisiensi** - Otomasi proses manual
2. **Meningkatkan Transparansi** - Calon siswa dapat tracking real-time
3. **Meningkatkan Akurasi** - Eliminasi human error
4. **Meningkatkan Scalability** - Sistem dapat menangani ribuan aplikasi
5. **Meningkatkan Security** - Proteksi data sensitif calon siswa

**Next Steps:**
1. Review dan approve brainstorming ini
2. Buat detailed requirements document
3. Design database & create migrations
4. Start development dengan prioritas fitur MVP
5. Setup testing environment
6. Deploy ke production

---

**Document Version:** 1.0  
**Last Updated:** 2026-05-06  
**Author:** Development Team  
**Status:** Draft - Pending Approval
