DOCKER_COMPOSE  ?=  docker compose

start: ## Start the project
	$(DOCKER_COMPOSE) up -d --remove-orphans 

stop: ## Stop the project
	$(DOCKER_COMPOSE) down --remove-orphans

restart: stop start ## Restart the project