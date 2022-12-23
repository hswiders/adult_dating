<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProviderModel;
use App\Models\ApiKey;

class TestCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
			
			$ApiKey = new ApiKey();
		
			$startYear = date('Y')*1;
			$endYear = 2020;
			$providers_arr = [1,2];
		
			/*$providers = ProviderModel::where('types','sport')->where('is_deleted',0)->get();
			foreach($providers as $provider){
				array_push($providers_arr,$provider->provider_id);
			}
		
			if(!empty($providers_arr)){
				
			}*/
			echo 1;
			
			
			$myfile = fopen("newfile2.txt", "w") or die("Unable to open file!");
			$txt = implode(',',$providers_arr);
		
			fwrite($myfile, $txt);
			fclose($myfile);
			\Log::info($txt);
			return 0;
				
    }
}
