MVP интернет-магазина на Laravel с CRUD функционалом для пользователей, товаров, категорий, заказов и профилей

## 🛠️ Установка проекта

1. git clone git@github.com:Mk-avtandil/shop_test.git
2. cd shop_test
3. cp .env.example .env
4. composer install
5. ./vendor/bin/sail up -d --build 
6. ./vendor/bin/sail artisan key:generate
7. ./vendor/bin/sail artisan migrate --seed
