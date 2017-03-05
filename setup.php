<?php

echo "Starting composer components installation: \r\n";
system('php composer.phar install');
echo "Starting database migrations: \r\n";
system('php artisan migrate'); 
echo "Starting database seeds: \r\n";
system('php artisan db:seed'); 