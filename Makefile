up:
	@docker-compose --file ./docker/docker-compose.dev.yml up --build -d --remove-orphans

down:
	@docker-compose --file docker/docker-compose.dev.yml down --remove-orphans

backend:
	@docker-compose --file ./docker/docker-compose.dev.yml exec php composer install
	@docker-compose --file ./docker/docker-compose.dev.yml exec php bin/console doctrine:migrations:migrate --no-interaction

fixtures:
	@docker-compose --file ./docker/docker-compose.dev.yml exec php bin/console doctrine:fixtures:load