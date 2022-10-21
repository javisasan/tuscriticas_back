VERSION = $(shell git describe --tags --always --dirty)
BRANCH = $(shell git rev-parse --abbrev-ref HEAD)
CONTAINER = tc_apache

.PHONY: help shell test cover

all: help

help:
	@echo
	@echo "VERSION: $(VERSION)"
	@echo "BRANCH: $(BRANCH)"
	@echo
	@echo "usage: make <command>"
	@echo
	@echo "commands:"
	@echo "    shell            - create docker container and enter the container"
	@echo "    test             - run tests"
	@echo "    cover            - run tests and creates code coverage report"
	@echo

shell:
	@docker exec -ti $(CONTAINER) bash

test:
	@docker exec $(CONTAINER) php bin/phpunit --stop-on-failure
