<?php

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

//##########################################################################
//############################### CLEAR LOG ################################
//##########################################################################
Artisan::command('log:clear', function () {
    exec('rm -f '.storage_path('logs/*.log'));
    exec('rm -f '.storage_path('logs/*.json'));
    exec('rm -f '.storage_path('app/logs/*'));
    exec('rm -f '.base_path('*.log'));
    $this->newLine();
    $this->info('logs has been cleared successfully');

    return Command::SUCCESS;
})->purpose('clear log files');
//##########################################################################
//##########################################################################
//##########################################################################

//##########################################################################
//############################### MOVE LOG #################################
//##########################################################################
Artisan::command('log:move', function () {
    // Create a new folder with the current timestamp
    $newFolder = storage_path('logs').'/'.now()->format('Y-m-d');
    exec('mkdir '.$newFolder);

    exec('mkdir '.$newFolder.'/laravel');
    exec('mkdir '.$newFolder.'/php-fpm');
    exec('mkdir '.$newFolder.'/nginx');
    exec('mkdir '.$newFolder.'/mongodb');
    exec('mkdir '.$newFolder.'/redis');
    exec('mkdir '.$newFolder.'/supervisor');

    // Function to handle moving files with renaming if file already exists
    function moveFile($source, $destination)
    {
        if (file_exists($destination)) {
            $info = pathinfo($destination);
            $base = $info['dirname'].DIRECTORY_SEPARATOR.$info['filename'];
            $ext = empty($info['extension']) ? '' : '.'.$info['extension'];
            $i = 1;
            while (file_exists($destination = $base.'_'.$i.$ext)) {
                $i++;
            }
        }

        return rename($source, $destination);
    }

    // Move laravel log files to the new folder
    foreach (glob(storage_path('logs').'/*.*') as $file) {
        moveFile($file, "{$newFolder}/laravel/".basename($file));
    }

    // Move php-fpm log files to the new folder
    foreach (glob('/var/log/php*fpm.log*') as $file) {
        moveFile($file, "{$newFolder}/php-fpm/".basename($file));
    }

    // Move nginx log files to the new folder
    foreach (glob('/var/log/nginx/*') as $file) {
        moveFile($file, "{$newFolder}/nginx/".basename($file));
    }

    // Move mongodb log files to the new folder
    foreach (glob('/var/log/mongodb/*') as $file) {
        moveFile($file, "{$newFolder}/mongodb/".basename($file));
    }

    // Move redis log files to the new folder
    foreach (glob('/var/log/redis/*') as $file) {
        moveFile($file, "{$newFolder}/redis/".basename($file));
    }

    // Move supervisor log files to the new folder
    foreach (glob('/var/log/supervisor/*') as $file) {
        moveFile($file, "{$newFolder}/supervisor/".basename($file));
    }

    $this->newLine();
    $this->info('Logs have been moved successfully');

    // Remove folders older than 7 days
    $oldFolders = File::directories(storage_path('logs'));
    $sevenDaysAgo = now()->subDays(30);

    foreach ($oldFolders as $folder) {
        $folderTimestamp = File::lastModified($folder);

        if ($folderTimestamp < $sevenDaysAgo->timestamp) {
            exec('rm -rf '.$folder);
            $this->info("Removed old log folder: $folder");
        }
    }

    // Create a new folder with the current timestamp for api calls
    $newFolder = storage_path('app/logs').'/'.now()->format('Y-m-d');
    exec('mkdir '.$newFolder);
    // Move api calls log files to the new folder
    exec('sudo mv '.storage_path('app/logs/*.*')." {$newFolder}");

    return Command::SUCCESS;
})->purpose('Move log files and remove old folders');
//##########################################################################
//##########################################################################
//##########################################################################

//##########################################################################
//########################## CLEAR ALL LOGS ################################
//##########################################################################
Artisan::command('all:clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('log:clear');
    // exec('sudo echo "" > '.storage_path('logs').'/worker.log ');
    // exec('sudo chmod 777 '.storage_path('logs').'/worker.log ');
    // exec('sudo chown $USER '.storage_path('logs').'/worker.log ');
    Artisan::call('redis:clear');
    exec('sudo rm '.storage_path('scripts/python/data/token').'/*.txt ');
    $this->newLine();
    $this->info('clear successful');

    return Command::SUCCESS;
})->purpose('clear all caches');
//##########################################################################
//##########################################################################
//##########################################################################
