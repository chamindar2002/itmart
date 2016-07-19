<?php

namespace Allison\Console\Commands;

use Illuminate\Console\Command;


use Allison\Console\Commands\FbAd\FbAppInnitialize;

use Auth;

use FacebookAds\Object\AdAccount;

use FacebookAds\Object\Fields\AdImageFields;

class FetchAdImagesCommand extends Command
{
    use FbAppInnitialize;
    
    private $ad_images = null;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->access_token = 'CAAPgIZBacbTMBANydczgnJnSSODAebiIPnQdE4eAWURAw8gDD6xNv07pqCnorZBq9YxO92T1FrJ2bUMCWlRVLiCHXSQiTHWVKCzu9HYsn2R3ZA4iZAlkfs4hVWN74wfJQ44tduZBvlIRdJCpdSkKyVnA9TILTduvbV4E8jovRHkRWy34oAwQZBwjSS8iCqlFBdFAiJ1OZCMBwZDZD';
        $this->ad_account_id = 'act_1637309866543107';
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
        $ad_account = new AdAccount($this->ad_account_id);
        
        $this->ad_images = $ad_account->getAdImages(array(  
                            AdImageFields::ID,
                            AdImageFields::HASH,
                            AdImageFields::URL,
                            AdImageFields::NAME,
                            AdImageFields::STATUS,
                            AdImageFields::URL_128,
                            
                        ));
        
        foreach($this->ad_images As $ai){
                echo $ai->{AdImageFields::ID}.PHP_EOL;
                echo $ai->{AdImageFields::HASH}.PHP_EOL;
                echo $ai->{AdImageFields::URL}.PHP_EOL;
                echo $ai->{AdImageFields::NAME}.PHP_EOL;
                echo $ai->{AdImageFields::STATUS}.PHP_EOL;
                echo $ai->{AdImageFields::URL_128}.PHP_EOL;
               
                echo '----------------------------------------------------'.PHP_EOL;
                
        }
    }
}

  /*const ID = 'id';
  const HASH = 'hash';
  const URL = 'url';
  const CREATIVES = 'creatives';
  const FILENAME = 'filename';
  const WIDTH = 'width';
  const HEIGHT = 'height';
  const ORIGINAL_WIDTH = 'original_width';
  const ORIGINAL_HEIGHT = 'original_height';
  const NAME = 'name';
  const STATUS = 'status';
  const CREATED_TIME = 'created_time';
  const UPDATED_TIME = 'updated_time';
  const PERMALINK_URL = 'permalink_url';
  const URL_128 = 'url_128';*/