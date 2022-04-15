
init: up composer install-oro

composer:
	composer install -n

install-oro:
	symfony console oro:install -vvv --sample-data=y --application-url=http://127.0.0.1:8000 --user-name=admin --user-email=admin@example.com --user-firstname=John --user-lastname=Doe --user-password=admin --organization-name=Oro --timeout=0 --symlink --env=prod -n

up:
	docker-compose up -d && symfony server:start -d

start-server:
	symfony server:start -d

down:
	 symfony server:stop && docker-compose down -v --remove-orphans

stop-server:
	symfony server:start -d

assets-install:
	symfony console oro:assets:install --symlink

cc:
	symfony console cache:clear

cc-p:
	symfony console cache:clear --env=prod