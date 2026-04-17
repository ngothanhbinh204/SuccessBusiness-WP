# 🏗️ KIẾN TRÚC HỆ THỐNG WEBSITE KHÓA HỌC (WORDPRESS + LEARNPRESS)

---

## I. Tổng quan hệ thống

Hệ thống được chia thành 3 layer chính:

### 1. Presentation Layer (Front-end)

* Custom Theme (PHP)
* Hiển thị:

  * Danh sách khóa học
  * Trang chi tiết
  * Form liên hệ
* Chỉ đọc dữ liệu (không xử lý logic phức tạp)

---

### 2. Application Layer (Business Logic)

* Custom code (plugin hoặc functions.php)
* LearnPress (quản lý học tập)
* WooCommerce (tùy chọn)

Chức năng:

* Mapping dữ liệu CPT ↔ LearnPress
* Xử lý đăng ký thủ công
* Enroll user

---

### 3. Data Layer (Database)

* WordPress DB
* Các bảng chính:

  * wp_posts (CPT + Course)
  * wp_postmeta (metadata)
  * wp_learnpress_* (LP tables)
  * wp_users

---

## II. Data Model

### 1. Custom Post Type: `khoa_hoc`

#### Fields:

* loai: `online | offline`
* lp_course_id: (ID LearnPress)
* trang_thai:

  * cho_duyet
  * da_duyet
  * da_enroll

#### Field riêng cho Offline:

* dia_diem
* lich_khai_giang
* giang_vien

👉 Đây là nguồn dữ liệu chính cho front-end

---

### 2. LearnPress Course

* Lưu:

  * bài học
  * quiz
  * tiến độ
  * danh sách user

---

### 3. Enrollment

* user_id
* course_id
* status: enrolled / finished

---

### 4. WooCommerce (optional)

* order
* customer
* course_id

👉 Chỉ dùng để tracking, không phải core

---

## III. Quan hệ dữ liệu

### Mapping chính:

* 1 CPT `khoa_hoc` ↔ 1 LearnPress Course
* Thông qua: `lp_course_id`

---

### User:

* 1 user → nhiều course (LearnPress enrollment)

---

## IV. Flow nghiệp vụ

### 1. Xem khóa học

User → Trang danh sách → Click → Trang chi tiết

---

### 2. Trang chi tiết

#### Khóa Online:

* Hiển thị nội dung
* Không có nút mua

#### Khóa Offline:

* Có button "Liên hệ"
* Mở popup form

---

### 3. Đăng ký (Manual flow)

#### Bước 1: User gửi yêu cầu

* Form / Zalo / Phone

---

#### Bước 2: Admin xử lý

* Tạo user (nếu chưa có)
* (Optional) tạo order
* Update trạng thái: `da_duyet`

---

#### Bước 3: Enroll

* Khi `trang_thai = da_duyet`
  → enroll user vào LearnPress
  → update `da_enroll`

---

#### Bước 4: User học

* Login
* Redirect → Dashboard LearnPress
* Học / quiz / tiến độ

---

## V. Trigger hệ thống

### Khi update trạng thái:

```php
update_post_meta($post_id, 'trang_thai', 'da_duyet');
```

→ Trigger:

* Enroll user

---

### Khi user login:

```php
login_redirect → trang khóa học của tôi
```

---

## VI. Quyết định kiến trúc

### ❌ Không dùng trực tiếp LearnPress Course

* Không linh hoạt field
* UI bị giới hạn
* Khó customize

---

### ✅ Dùng CPT trung gian

* Tách:

  * UI (CPT)
  * Logic học (LearnPress)
* Dễ mở rộng
* Dễ maintain

---

## VII. Thiết kế Online / Offline

* Dùng **1 CPT duy nhất**
* Phân biệt bằng:

```text
loai = online | offline
```

---

## VIII. Routing

* /khoa-hoc → danh sách
* /khoa-hoc/{slug} → chi tiết

Filter:

* ?loai=online
* ?loai=offline

---

## IX. Security

* Không cho user tự enroll
* Chỉ Admin thao tác
* Validate form (email, phone)
* reCAPTCHA chống spam

---

## X. Khả năng mở rộng

### 1. Thanh toán tự động

* WooCommerce → auto enroll

---

### 2. CRM

* Sync lead từ form

---

### 3. Notification

* Email khi:

  * duyệt
  * enroll

---

## XI. Tóm tắt

* CPT = dữ liệu hiển thị
* LearnPress = hệ thống học
* WooCommerce = tùy chọn
* Admin kiểm soát toàn bộ flow
* User không tự checkout

---

# ❓ Câu hỏi: Có thể tạo Post Type bằng ACF không?

## ✅ CÓ – và KHÔNG cần đụng PHPMyAdmin

### Cách đúng:

### 1. Dùng ACF PRO

* ACF có module:

  * **Post Types**
  * **Taxonomies**

👉 Bạn có thể:

* Tạo CPT `khoa_hoc`
* Tạo field group (meta)
* Gán field vào CPT

---

### 2. Không cần PHPMyAdmin vì:

* WordPress tự:

  * tạo record trong `wp_posts`
  * lưu meta trong `wp_postmeta`

👉 Bạn chỉ thao tác qua UI

---

### 3. Khi nào cần code?

* Khi cần:

  * custom rewrite nâng cao
  * performance optimization
  * register CPT dynamic

---

## ⚠️ Lưu ý thực tế (quan trọng)

* ACF tạo CPT = OK cho dự án vừa & nhỏ
* Nhưng production lớn:
  👉 Nên export sang code (ACF JSON hoặc PHP)

---
## Lưu ý tính năng: 
SOW tính năng 
+ Quản lý khóa học online / offline 
+ Tính năng đăng nhập bằng tài khoản Quản trị viên cung cấp 
+ Học viên có thể quản lý khóa học online, tình trạng khóa học, làm bài kiểm tra dạng Quiz 
+ Xử lý mua khóa học nằm bên ngoài website, sau đó admin sẽ tạo đơn hàng dành cho Khóa học và add tài khoản vào đơn hàng => Khóa học hiển thị trong phần quản lý khóa học của Học viên 
Lưu ý: Bộ quy trình Học online dùng để học nội bộ:
Admin tạo khóa học và cấp quyền cho thí sinh sử dụng
Không bao gồm quy trình Bán - Thanh toán Online


## 👉 Kết luận

* Bạn **không cần PHPMyAdmin**
* Có thể build toàn bộ:

  * CPT
  * Field
  * Logic
    → bằng:
  * ACF + LearnPress + Custom code nhẹ

---

Nếu bạn muốn, mình có thể:

* Viết luôn ACF field structure chuẩn cho case này
* Hoặc code auto enroll khi đổi trạng thái (rất quan trọng phần này)
