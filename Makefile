.EXPORT_ALL_VARIABLES:

# Include .env if it exists
ifneq ("$(wildcard .env)","")
    include .env
else
    include .env.dist
endif

# Makefile config
.DEFAULT_GOAL:=help
.PHONY: start stop rebuild copy-enf-file help

test:
	echo ${PROJECT_NAME}

## Docker stack
start: ## Build and start the Docker stack.
	@docker compose -f ./docker/development.yml -p ${PROJECT_NAME} up -d --build

stop: ## Stop the Docker stack.
	@docker compose -p ${PROJECT_NAME} down

## Build
rebuild: ## Forces a rebuild of the custom Docker images.
	@docker compose -f ./docker/development.yml build --no-cache

## Setup
copy-env-file: ## Copy .env.dist to .env if it does not exist already.
	@cp -n .env.dist .env

## Help
help:
	@grep -E '(^[a-zA-Z0-9\./_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
