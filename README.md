## Wordpress & [Nodejs](https://nodejs.org/de/docs/guides/nodejs-docker-webapp/) (docker)
#### How to start it ?
`docker-compose up`

#### Get the code from container
`docker cp wordpress-api_wordpress_1:/var/www/html .`

#### Api access
`http://localhost:8080/wp-json/wp/v3`

#### Admin
`http://localhost:8080/wp-login.php`
*credentials*: `root root`

#### Create new Docker Image
`docker build -t jcastelain/node-web-app .`

#### Debug Nodejs
`node --inspect server.js`
