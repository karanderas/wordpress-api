#Wordpress docker
###How to start it ?
`docker-compose -f stack.yml up`

###Get the code from container
`docker cp wordpress-api_wordpress_1:/var/www/html .`

###Access it
`http://localhost:8080/wp-json/wp/v2`

###Admin
`http://localhost:8080/wp-login.php` root root
