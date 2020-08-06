default:
	@docker-compose exec fg-test_php-fpm bash -c "composer install && php artisan migrate && php artisan db:seed --class=TariffSeeder"
