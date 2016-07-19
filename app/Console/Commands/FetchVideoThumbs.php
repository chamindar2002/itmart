<?php

namespace Allison\Console\Commands;

use Illuminate\Console\Command;

use Allison\Console\Commands\FbAd\FbAppInnitialize;

use FacebookAds\Object\AdVideo;

use FacebookAds\Object\VideoThumbnail;

class FetchVideoThumbs extends Command
{
    use FbAppInnitialize;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:video-thumbs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $access_token = null;
    private $ad_account_id = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->access_token = 'CAAPgIZBacbTMBAJRassZBb4XZA9FxvI5B5bZCXpTH9FrYjO2WZAt7RaaLkmAqJINYxqY0bWGLYbclqmdpOYfXnZB9dbNocz6rqSS2NCZANy4TZC7qxRknoN9FKkC2vYfw1CvEPagGXGsXEBZCes1rZBWnV6UKjYdFBG8evygDbXnjlego6gnsNii5W60qQ8QSStIwZD';
        $this->ad_account_id = 'act_231184597227956';
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->init($this->access_token);


        $video = new AdVideo('141719862891570');
        $thumbs = $video->getVideoThumbnails();
        if(sizeof($thumbs) > 0){
            //echo $thumbs->uri."\n";
            foreach($thumbs As $thumb){
                echo $thumb->uri."\n";
            }
        }
    }
}
