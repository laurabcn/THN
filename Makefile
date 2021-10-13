### SERVER-RUN ###
.PHONY: server
server:
	 docker-compose up -d --no-build --remove-orphans

### COMPOSER-INSTALL ###
.PHONY: composer
composer:
	docker run --rm -it -v $$PWD/app:/app -u $(id -u):$(id -g) composer install --ignore-platform-reqs

### TEST ACCEPTANCE ###
.PHONY: test-acceptance
test-acceptance:
	docker-compose exec php /bin/bash -c "vendor/bin/behat"

## TEST ACCEPTANCE ###
.PHONY: test-unit
test-unit:
	docker-compose exec php /bin/bash -c "vendor/bin/phpunit"


## dev: Boot dev environment
.PHONY: dev
dev:
	docker-compose up -d
	docker-compose exec php /bin/bash -c "composer install --ignore-platform-reqs"
	docker-compose exec php /bin/bash -c "bin/console doctrine:database:create --if-not-exists"
	docker-compose exec php /bin/bash -c "bin/console doctrine:schema:update --force"
	echo "####################################################################"
	echo ""
	echo "Done, now open http://localhost:8080 in your browser"
	echo ""
	echo "####################################################################"