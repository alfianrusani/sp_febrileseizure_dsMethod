# Menggunakan image PHP 8.2
FROM php:8.2-cli

# Menginstal dependensi sistem yang dibutuhkan Laravel & SQLite
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev

# Membersihkan cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Menginstal ekstensi PHP yang dibutuhkan
RUN docker-php-ext-install pdo_sqlite mbstring exif pcntl bcmath gd

# Menginstal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Menentukan folder kerja di dalam server
WORKDIR /var/www

# Menyalin semua file project ke dalam server
COPY . .

# Menginstal paket vendor (tanpa paket testing)
RUN composer install --optimize-autoloader --no-dev

# Memastikan file SQLite ada dan menjalankan migrasi saat server menyala
CMD touch database/database.sqlite && \
    php artisan migrate:fresh --seed --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}