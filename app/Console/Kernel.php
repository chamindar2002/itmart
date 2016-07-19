<?php

namespace Allison\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Allison\Console\Commands\Inspire::class,
        \Allison\Console\Commands\FBGetUserId::class,
        \Allison\Console\Commands\FetchPixel::class,
       // \Allison\Console\Commands\FetchAdsetsCommand::class,
        \Allison\Console\Commands\FetchAdImagesCommand::class,
        \Allison\Console\Commands\GuzzleTestingCommand::class,
        \Allison\Console\Commands\FbAd\SyncCampaignsCommand::class,
        \Allison\Console\Commands\FetchFbInsightAnalyticsCommand::class,
        \Allison\Console\Commands\FBCreateAddSetCommand::class,
        \Allison\Console\Commands\FetchVideoThumbs::class,
        \Allison\Console\Commands\GrantAppAccess::class,
        \Allison\Console\Commands\FbAdminTokenExpireryCommand::class,
        \Allison\Console\Commands\FetchFbAppUsersCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();
        
        #https://laravel.com/docs/master/scheduling
        
        /*
         * Data synchronization with local data and remote data. this is applied
         * becuase if a user modifies data in the facebook ad manager it should
         * reflect the changes in th local data
         */
        $schedule->command('sync:ad-campaigns')
                    ->everyTenMinutes()
                    ->sendOutputTo('storage/logs/SyncCampaignsCommand.log');

        $schedule->command('fetch:admin-token-data')
            ->daily()
            ->sendOutputTo('storage/logs/AdminTokenValidationCommand.log');
          
//        $schedule->command('sync:ad-campaigns')
//            ->everyMinute()
//            ->sendOutputTo('storage/logs/SyncCampaignsCommand.log');
        
        //$schedule->command('synccampaignscommand')->hourly(); 
    }
}
