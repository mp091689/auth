start project:
got to the `docker` folder and run:
```
$ docker-compose up
```

to make queues work go into the container:
```
$ docker exec -it docker_php_1 su dev
```
and run:
```
$ ./bin/console rabbitmq:consumer analytics
```