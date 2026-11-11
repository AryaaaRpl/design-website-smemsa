# SMKS Muhammadiyah 1 Genteng Official Website

[Versi Bahasa Indonesia](README.id.md)

An integrated web platform for SMKS Muhammadiyah 1 Genteng (SMEMSA), serving as the school's official digital profile, public information center, online student admissions system (SPMB), business service catalog (BLUD), and job placement portal (BKK).

---

## Problems It Solves

- **Fragmented Information**: Replaces scattered announcements across social media with a centralized and verified source for school profile, academic concentrations, extracurricular activities, faculty directory, and campus facilities.
- **Manual Student Admissions**: Eliminates paper-based registration bottlenecks through a self-service admissions workflow with multi-phase form completion, document uploads, and application status tracking.
- **Visibility for School Production Units**: Provides a dedicated showcase for Teaching Factory products and BLUD services with direct WhatsApp order links.
- **Alumni Career Bridge**: Connects graduates and job seekers directly with hiring partners through the integrated BKK vacancy board.

---

## User Roles and Usage

### 1. General Public and Prospective Students
- **Explore Academic Programs**: Navigate to `/jurusan` to view vocational concentrations, industry partners, and career competencies.
- **Online Admissions (SPMB)**:
  - Visit `/spmb` for admission guidelines, timeline, fee schemes, and scholarship details.
  - Register an account via `/rpl-smemsa-2026/pendaftar/daftar`.
  - Log in at `/rpl-smemsa-2026/pendaftar/masuk` to fill out biodata, upload requirement files, submit applications, and monitor verification results.
- **Inquire via Virtual Assistant**: Use the floating chat widget on public pages for instant FAQ answers and school guidance with WhatsApp fallback.
- **Campus Units & Vacancies**: View BLUD products at `/blud` and job postings at `/bkk`.

### 2. School Administrators
- **Access Panel**: Log in via the protected administration portal (`/rpl-smemsa-space/admin/login/...`).
- **Data Management**:
  - Review, verify, reset, and export student admissions data.
  - Manage news articles, achievements, vacancies, products, majors, faculty members, and SPMB scholarship configurations.
  - Update institutional settings (contact numbers, accreditation metadata, statistics, tuition structures) from the settings module.

---

## Technical Stack

- **Backend**: Laravel 13, PHP 8.5
- **Frontend**: Blade Templates, Tailwind CSS / Vanilla CSS, Modern JavaScript
- **Database**: SQLite / MySQL
- **Assets Optimization**: WebP image delivery and local self-hosted web fonts

---

## Local Development Setup

1. **Clone and Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

2. **Environment Configuration**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Migration and Seeding**:
   ```bash
   php artisan migrate --seed
   ```

4. **Build Assets & Start Servers**:
   ```bash
   npm run build
   php artisan serve
   ```

5. **Run Test Suite**:
   ```bash
   php artisan test
   ```
