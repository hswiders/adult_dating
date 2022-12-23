<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ApiKey;
use App\Models\MostWatchModel;
use App\Models\MovieModel;
use App\Models\StreamAvailableModel;
use App\Models\TvModel;
use DB;

class ImportMostWatchTvShows extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportMostWatchTvShows:cron';

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
					'type'=>'series',
					'output_language'=>'en',
				);
				
				//print_r($endApiData); continue;
					
				$responce = $ApiKey->StreamingAvailability($endPoint,$endApiData);
				
				//die();
				
				if(isset($responce->results) && !empty($responce->results)){
					
					
					
					MostWatchModel::where('media_type','tv')->where('provider',$provider)->delete();
					
					foreach($responce->results as $key => $value){
						$tmdbID = $value->tmdbID;
						
						$check = TvModel::where('tmdb_id',$tmdbID)->first(['id']);
						
						/*if(!$check){
							$last_id=$this->add_tv($tmdbID,2);
							$check = TvModel::where('tmdb_id',$tmdbID)->first(['id']);
						}*/
						
						if($check){
							
							$MostWatchModel = new MostWatchModel;
							
							$MostWatchModel->media_id = $check->id;
							$MostWatchModel->media_type = 'tv';
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
		
		private function add_tv($id,$type=2){
			
			$ApiKey = new ApiKey();
			
			$endPoint = 'tv/'.$id;
			
			$responce = $ApiKey->TmDbCurl($endPoint);
			
			if(!isset($responce->id)){
				return false;
			}
			
			$where = [];
			$insert = [];
			
			$where['tmdb_id'] = $responce->id;

			
			//echo '<pre>'; print_r($responce);
			
			
			$insert['runtime'] = ($responce->episode_run_time && !empty($responce->episode_run_time)) ? $responce->episode_run_time[0] : 0;
			$insert['first_air_date'] = $responce->first_air_date;
			$insert['in_production'] = ($responce->in_production) ? 1 : 0;
			$insert['original_title'] = $responce->original_name;
			$insert['title'] = $responce->original_name;
			$insert['imdb_id'] = 0;
			
			
			
			$insert['status'] = $responce->status;
			$insert['tagline'] = $responce->tagline;
			
			$insert['original_language'] = $responce->original_language;
			$insert['overview'] = $responce->overview;
			$insert['popularity'] = $responce->popularity;
			$insert['poster_path'] = (isset($responce->poster_path) && $responce->poster_path) ? $responce->poster_path : $responce->backdrop_path;
			$insert['video'] = (isset($responce->video) && $responce->video) ? $responce->video : '';
			$insert['budget'] = (isset($responce->budget) && $responce->budget) ? $responce->budget : 0;
			$insert['vote_average'] = $responce->vote_average;
			$insert['vote_count'] = $responce->vote_count;
			$insert['homepage'] = $responce->homepage;
			$insert['last_update'] = date('Y-m-d');
			
			
			
			$genres = [];
			
			if(isset($responce->genres) && is_array($responce->genres) && !empty($responce->genres)){
				foreach($responce->genres as $key1 => $value1){
					array_push($genres,$value1->id);
				}
			}
			
			$insert['genres'] = implode(',',$genres);
			
			
			$last_id = TvModel::updateOrCreate($where,$insert);
			
			
				
			return $last_id->id;
			
		}

}
