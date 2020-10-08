<?php
exec("php artisan migrate:fresh", $output);
echo "<pre> php artisan migrate:fresh";
print_r ($output);
echo "</pre>";
exec("php artisan db:seed --class=PermissionSeeder", $output);
echo "<pre> php artisan db:seed --class=PermissionSeeder";
print_r ($output);
echo "</pre>";
exec("php artisan db:seed --class=RoleSeeder", $output);
echo "<pre> php artisan db:seed --class=RoleSeeder";
print_r ($output);
echo "</pre>";
exec("php artisan db:seed --class=UserSeeder", $output);
echo "<pre> php artisan db:seed --class=UserSeeder";
print_r ($output);
echo "</pre>";