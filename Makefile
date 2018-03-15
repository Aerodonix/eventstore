# Start dockercontainer
up:
	sudo docker-compose up -d

# End dockercontainer
down:
	sudo docker kill basicdocker_web_1
	sudo docker kill basicdocker_php_1
