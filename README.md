# Symfony Base Repository

This repository contains the basic configuration to run Symfony applications with MySQL database

## Content
- PHP container running version 8.1.1
- MySQL container running version 8.0.26 (not necessary for this project really)

## Instructions
1. `make build` to build the containers

2. `make start` to start the containers

3. `make prepare` to install dependencies with composer (once the project has been created)

4. Go to the browser and type: http://localhost:200

`make stop` to stop the containers

`make restart` to restart the containers

`make run` to start a web server listening on port 1000 (8000 in the container)

`make logs` to see application logs

`make ssh-be` to SSH into the application container
