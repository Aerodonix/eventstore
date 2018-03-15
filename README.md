The Docker setup for PHP applications using PHP7.2 and Nginx 

## Get Startet
* Checkout the repository
* Run `make up` (docker commands use sudo)
* Navigate to localhost:8080

## Change Nginx config
* Nginx Config is mounted from ./nginx/site.conf into the container
* Change config and restart container with `make up`

## Network
* network for containers is called code-network
* to change network, edit the docker-compose.yml
* show networks with `sudo docker network list`
* to join other networks use `sudo docker connect code-network <container>`


