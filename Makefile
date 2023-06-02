.EXPORT_ALL_VARIABLES:

# Include .env if it exists
ifneq ("$(wildcard .env)","")
    include .env
else
    include .env.dist
endif

# Docker
FRONTEND_CONTAINER:=$(shell docker ps --filter="name=^${PROJECT_NAME}-frontend" -q)
BACKEND_CONTAINER:=$(shell docker ps --filter="name=^${PROJECT_NAME}-backend" -q)

# Permissions
USER_UID=$(shell id -u)

# Makefile config
.DEFAULT_GOAL:=help
.PHONY: start stop enter-frontend enter-backend rebuild copy-env-file help

## Docker stack
start: ## Build and start the Docker stack.
	@docker compose -f ./docker/docker-compose.development.yml -p ${PROJECT_NAME} up -d --build

stop: ## Stop the Docker stack.
	@docker compose -p ${PROJECT_NAME} down

enter-frontend: ## Enter the frontend container.
	@docker exec -it ${FRONTEND_CONTAINER} sh || true

enter-backend: ## Enter the backend container.
	@docker exec -it ${BACKEND_CONTAINER} /bin/bash || true

## Build
rebuild: ## Forces a rebuild of the custom Docker images.
	@docker compose -f ./docker/docker-compose.development.yml build --no-cache

## Setup
copy-env-file: ## Copy .env.dist to .env if it does not exist already.
	@cp -n .env.dist .env

## Help
help:
	@grep -E '(^[a-zA-Z0-9\./_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
