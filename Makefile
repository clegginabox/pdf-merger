DOCKER_RUN = docker-compose run --rm php
DOCKER_RUN_XDEBUG = docker-compose run -e PHP_XDEBUG_ENABLED=1 --rm php

vendor:
	$(DOCKER_RUN) composer install

.PHONY: tests
tests:
	$(DOCKER_RUN) ./vendor/bin/php-cs-fixer fix --diff --config=.php_cs.dist
	$(DOCKER_RUN) ./vendor/bin/phpunit tests

.PHONY: coverage
coverage:
	$(DOCKER_RUN_XDEBUG) vendor/bin/phpunit --coverage-html var/coverage
