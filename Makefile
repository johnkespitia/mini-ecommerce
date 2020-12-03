PROJECT_ROOT_DIR := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

migrate-up: 
	php ${PROJECT_ROOT_DIR}database/migrate.php
