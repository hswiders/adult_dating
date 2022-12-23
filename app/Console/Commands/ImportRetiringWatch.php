<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ApiKey;
use App\Models\RetiringModel;
use App\Models\MovieModel;
use App\Models\StreamAvailableModel;
use DB;

class ImportRetiringWatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportRetiringWatch:cron';

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
			
				$endPoint = 'leaving';
				$endApiData = array(
					'service'=>$provider,
					'country'=>'us',
					'change_type'=>'new',
					'type'=>'movie',
					'output_language'=>'en',
				);
					
				$responce = $ApiKey->StreamingAvailability($endPoint,$endApiData);
				
				//die();
				
				if(isset($responce->results) && !empty($responce->results)){
					
					
					
					RetiringModel::where('media_type','movie')->where('provider',$provider)->delete();
					
					
					foreach($responce->results as $key => $value){
						$tmdbID = $value->tmdbID;
						
						$check = MovieModel::where('tmdb_id',$tmdbID)->first(['id']);
						
						if($check){
							
							$RetiringModel = new RetiringModel;
							$RetiringModel->media_id = $check->id;
							$RetiringModel->media_type = 'movie';
							$RetiringModel->imdbID = $value->imdbID;
							$RetiringModel->tmdbID = $value->tmdbID;
							$RetiringModel->provider = $provider;
							$RetiringModel->link = $value->streamingInfo->$provider->us->link;
							$RetiringModel->country = 'us';
							$RetiringModel->added_time = $value->streamingInfo->$provider->us->added;
							$RetiringModel->leaving_time = $value->streamingInfo->$provider->us->leaving;
							$RetiringModel->originalTitle = $value->originalTitle;
							$RetiringModel->save();
							
							$provider1 = $provider;
							if($provider1=='prime'){
								$provider1 = 'amazonprime';
							}
							
							$check2 = StreamAvailableModel::where('movie_id',$check->id)
								->where('media_type','tv')
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
								$insert2->media_type = 'tv';
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
