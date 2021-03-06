<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Laravel 5.6(7) easyduathlon

### Installation:
ER_PREFIX=skeleton
    ```
2. Install composer dependency, run: 
    ```bash
    sudo usermod -a -G docker $USER #Add permission
    make composer_dep
    ```
3. Set permissions on the project directory so that it is owned by your non-root user:
    ```bash
    sudo chown -R $USER:$USER $PWD
    ```

4.  Set the application key for the Laravel application
    ```bash
    make key
    ``` 
5. Optional* >> To cache these settings into a file, which will boost your application's load speed, run:   
    ```bash
    docker-compose exec app php artisan config:cache
    ```
    _Your configuration settings will be loaded into /var/www/bootstrap/cache/config.php on the container._
    
6.  Creating a User for MySQL
    * Inside the container:
    ```bash
    docker-compose exec db bash
    
    root@e42d3f4adfg:/# mysql -u root -p

    mysql> GRANT ALL ON laravel.* TO 'laraveluser'@'%' IDENTIFIED BY 'your_laravel_db_password';
    mysql> FLUSH PRIVILEGES;
    mysql> EXIT;

    ```
    
     [See more https://github.com/francescomalatesta/laravel-api-boilerplate-jwt](https://github.com/francescomalatesta/laravel-api-boilerplate-jwt).
    
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
