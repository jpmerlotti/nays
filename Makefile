default: env prepare up key-generate populate
	@echo "--> Your environment is ready to use! Access http://localhost and enjoy it!"

.PHONY: env
env:
	@echo "--> Copying .env.example to .env file"
	@cp .env.example .env

.PHONY: prepare
prepare:
	@echo "--> Installing composer dependencies..."
	@sh ./bin/prepare.sh

.PHONY: up
up:
	@echo "--> Starting all docker containers..."
	@./vendor/bin/sail up --force-recreate -d
	@./vendor/bin/sail art storage:link

.PHONY: key-generate
key-generate:
	@echo "--> Generating new laravel key..."
	@./vendor/bin/sail art key:generate

.PHONY: populate
populate:
	@echo "--> Populating all table and data of project..."
	@./vendor/bin/sail art migrate:fresh --seed

.PHONY:	down
down:
	@echo "--> Stopping all docker containers..."
	@./vendor/bin/sail down

.PHONY:	ql
ql:
	@echo "--> Initializing queue..."
	@./vendor/bin/sail art queue:listen

.PHONY:	qr
qr:
	@echo "--> Finishin queue..."
	@./vendor/bin/sail art queue:restart

.PHONY:	restart
restart:	down up

.PHONY:	build
build:
	@echo "--> Building all docker containers..."
	@./vendor/bin/sail build --no-cache

.PHONY:	stan
stan:
	@echo "--> Analysing error in code..."
	@./vendor/bin/sail bin phpstan analyse --memory-limit=2G

.PHONY:	pint
pint:
	@echo "--> Styling code..."
	@./vendor/bin/sail bin pint -v


.PHONY:	commit
commit: stan pint




