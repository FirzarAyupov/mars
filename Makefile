CONTAINER_NAME=php

lint: csf-check deptrac php-stan psalm

migrate-diff:
	docker-compose exec $(CONTAINER_NAME) php bin/console make:migration

composer-install:
	docker-compose exec $(CONTAINER_NAME) composer install

composer-update:
	docker-compose exec $(CONTAINER_NAME) composer update

csf-check:
	docker-compose exec $(CONTAINER_NAME) vendor/bin/php-cs-fixer fix --dry-run --diff

csf-fix:
	docker-compose exec $(CONTAINER_NAME) vendor/bin/php-cs-fixer fix

deptrac:
	docker-compose exec $(CONTAINER_NAME) vendor/bin/deptrac analyse --config-file=deptrac.yaml --cache-file=var/.deptrac.cache

php-stan:
	docker-compose exec $(CONTAINER_NAME) vendor/bin/phpstan analyse src

psalm:
	docker-compose exec $(CONTAINER_NAME) vendor/bin/psalm