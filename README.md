# Mercure example
This repo is showing how to use mercure in Symfony. It is NOT usable in production.

## Install
`composer install`

## Start Symfony server
```shell script
bin/console server:start
```

=> Default port is 8000. This port is used for the rest of the README.
If server starts on another port, modify port in commands below accordingly

## Start mercure server

Start a mercure server locally on port 3080 (change at your convenience) :

```shell script
docker run -e JWT_KEY='!ChangeMe!' -e ALLOW_ANONYMOUS=1 -e CORS_ALLOWED_ORIGINS='http://localhost:8000' -e PUBLISH_ALLOWED_ORIGINS='http://localhost' -p 3080:80 dunglas/mercure
```

## Send and receive messages

### Client : Subscribe to time request

Go to http://localhost:8000/front/melicerte and http://localhost:8000/front/someguy

### Server : Send date and time to all clients

A command has been created to send date adn time to all targets

```shell script
bin/console app:send-time-message
```

=> Current date and time should appear in messages div on http://localhost:8000/front/melicerte and http://localhost:8000/front/someguy

### Server Send private message

```shell script
bin/console app:send-targeted-message "This is a message to target melicerte" "http://localhost/user/melicerte"
```

=> Message should appear only on http://localhost:8000/front/melicerte

```shell script
bin/console app:send-targeted-message "This is a message to target someguy" "http://localhost/user/someguy"
```

=> Message should appear only on http://localhost:8000/front/someguy
