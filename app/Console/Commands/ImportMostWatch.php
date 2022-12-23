<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ApiKey;
use App\Models\MostWatchModel;
use App\Models\MovieModel;
use App\Models\StreamAvailableModel;
use DB;

class ImportMostWatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportMostWatch:cron';

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
		
			$providers = ['prime','hulu','netflix'];
			
			foreach($providers as $provider){
				
				
			
				$endPoint = 'changes';
				$endApiData = array(
					'service'=>$provider,
					'country'=>'us',
					'change_type'=>'new',
					'type'=>'movie',
					'output_language'=>'en',
				);
				
				//print_r($endApiData); continue;
					
				$responce = $ApiKey->StreamingAvailability($endPoint,$endApiData);
				//print_r($responce);
				//die();
				
				if(isset($responce->results) && !empty($responce->results)){
					
					
					
					MostWatchModel::where('media_type','movie')->where('provider',$provider)->delete();
					
					foreach($responce->results as $key => $value){
						$tmdbID = $value->tmdbID;
						
						$check = MovieModel::where('tmdb_id',$tmdbID)->first(['id']);
						
						if($check){
							
							$MostWatchModel = new MostWatchModel;
							
							$MostWatchModel->media_id = $check->id;
							$MostWatchModel->media_type = 'movie';
							$MostWatchModel->imdbID = $value->imdbID;
							$MostWatchModel->tmdbID = $value->tmdbID;
							$MostWatchModel->provider = $provider;
							$MostWatchModel->link = $value->streamingInfo->$provider->us->link;
							$MostWatchModel->country = 'us';
							$MostWatchModel->added_time = $value->streamingInfo->$provider->us->added;
							$MostWatchModel->leaving_time = $value->streamingInfo->$provider->us->leaving;
							$MostWatchModel->originalTitle = $value->originalTitle;
							$MostWatchModel->save();
							
							$provider1 = $provider;
							if($provider1=='prime'){
								$provider1 = 'amazonprime';
							}
							
							$check2 = StreamAvailableModel::where('movie_id',$check->id)
								->where('media_type','movie')
								->where('platform',$provider1)
								->first();
								
							if($check2){
								$check2->link = $value->streamingInfo->$provider->us->link;
								$check2->added_time = $value->streamingInfo->$provider->us->added;
								$check2->leaving_time = $value->streamingInfo->$provider->us->leaving;
								$check2->save();
							} else {
								$insert2 = new StreamAvailableModel;
								
								$insert2->movie_id = $check->id;
								$insert2->media_type = 'movie';
								$insert2->platform = $provider1;
								$insert2->link = $value->streamingInfo->$provider->us->link;
								$insert2->added_time = $value->streamingInfo->$provider->us->added;
								$insert2->leaving_time = $value->streamingInfo->$provider->us->leaving;
								$insert2->save();
							}
							
							$check->imdbRating = $value->imdbRating;
							$check->save();
							
									
						}
						
						
					}
				} else {
					\Log::info("Error!");
				}
			
				//echo '<pre>';
				//print_r($responce); die();
			}
		
			
			\Log::info("Import sport episode cron is working fine!");
			return 0;
    }
}
