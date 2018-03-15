The Docker setup for PHP applications using PHP7.2 and Nginx 

## Get Startet
* Checkout the repository
* Run `make up` (docker commands use sudo)
* Navigate to localhost:8080

## Change Nginx config
* Nginx Config is mounted from ./nginx/site.conf into the container
* Change config and restart container with `make up`

## Network
* Network for containers is called code-network
* To change network, edit the docker-compose.yml
* Show networks with `sudo docker network list`
* To join other container like a database use `sudo docker connect code-network <container>`


