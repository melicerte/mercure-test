# Mercure example
This repo is showing how to use mercure in Symfony. It is NOT usable in production.

## Install
`composer install`

## Start mercure server

Start a mercure server locally on port 3080 (change at your convenience) :

`docker run -e JWT_KEY='!ChangeMe!' -e ALLOW_ANONYMOUS=1 -e CORS_ALLOWED_ORIGINS=* -e PUBLISH_ALLOWED_ORIGINS='http://localhost' -p 3080:80 dunglas/mercure`

## Public message

### Client : Subscribe to time request

Copy/paste this code in your browser console.

```javascript
const eventSource = new EventSource('http://localhost:3080/hub?topic=' + encodeURIComponent('http://localhost/time'));
eventSource.onmessage = event => {
    // Will be called every time an update is published by the server
    console.log(JSON.parse(event.data));
}
```

### Server : Send time to client

A command has been created to send time to Mercure server.

```shell script
bin/console app:send-time-message
```

=> You should see something like this in your browser's console :
`Object { time: 1572951883 }`