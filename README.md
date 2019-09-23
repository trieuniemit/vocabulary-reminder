# Yêu cầu hệ thống
- Cài đặt composer
- Cài đặt git
- Cài đặt php, mysql, apache/nginx

# Cài đặt
- Khởi tạo git:
    Mở terminal ở folder bất kỳ. và chạy lệnh: 
    - `git init`
    - `git remote remote add origin https://<username>:<password>@github.com/trieuniemit/vocabulary-reminder.git`
    - `git pull`
    - `git pull origin master`
    - `git branch --set-upstream-to=origin/master master`
        
- Cài đặt các libs cần thiết cho laravel: 
    - `composer install`
    - `composer dump-autoload`
- Config database: 
    - Sử dụng phpmyadmin tạo database mới với collation `utf-8-unicode-ci`
    - Quay lại folder project, tạo file `.env` và copy paste nội dung của file `.env.example`.
    - Mở file `.env` mới tạo. và tiến hành config databse:
        - `DB_HOST=localhost`
        - `DB_DATABASE=<databasename mới tạo>`
        - `DB_USERNAME=<username>` (thường là root với xampp)
        - `DB_PASSWORD=<password>` (bỏ trống với xampp)
        
- Tạo bảng và insert data mẫu: 
    Vẫn mở terminal tại folder project, chạy lệnh sau:
        `php artisan migrate --seed`

have fun :))
    
    
