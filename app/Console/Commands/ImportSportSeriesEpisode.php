<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\SeasonModel;
use App\Models\ApiKey;
use App\Models\EpisodeModel;
use DB;

class ImportSportSeriesEpisode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportSportSeriesEpisode:cron';

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
			
			//echo '<pre>';
		
			$today = date('Y-m-d');
			$add10Day = date('Y-m-d',strtotime($today.' -10 days'));
			
			$providers_arr = [];
			
			$seasons = SeasonModel::where('media_type','sport-series')
				->where(DB::raw('DATE(last_updated)'),'<',$add10Day)
				->get();
			foreach($seasons as $season){
				
				$endPoint = 'seasons/'.$season->tmdb_id.'/extended';
				$responce = $ApiKey->TvDbCurl($endPoint);
				
				if(isset($responce->status) && $responce->status=='success' && isset($responce->data) && !empty($responce->data)){
					
					$data = $responce->data;
					
					//print_r($data);
					
					if(isset($data->episodes) && !empty(isset($data->episodes))){
						
						foreach($data->episodes as $episode){
							
							//print_r($episode);
							
						
							$checkCount = EpisodeModel::where([
								'season_number'=>$episode->seasonNumber,
								'tmdb_id'=>$episode->id,
								'media_id'=>$season->media_id,
								'media_type'=>'sport-series',
							])->count();
							
							if($checkCount==0){
							
								EpisodeModel::insert([
									'season_number'=>$episode->seasonNumber,
									'tmdb_id'=>$episode->id,
									'media_id'=>$season->media_id,
									'media_type'=>'sport-series',
									'air_date'=>$episode->aired ? $episode->aired : NULL,
									'episode_number'=>$episode->number,
									'name'=>$episode->name,
									//'overview'=>$episode->overview,
									//'production_code'=>$episode->production_code,
									'runtime'=>$episode->runtime,
									//'show_id'=>$episode->show_id,
									//'still_path'=>$episode->still_path,
									//'vote_average'=>$episode->vote_average,
									//'vote_count'=>$episode->vote_count,
								]);
							}
						}
					}
					
						
					if(isset($data->name)){
						$season->name = $data->name;
					}
					
					$season->last_updated = date('Y-m-d H:i:s');
					$season->save();
					//die();
				}
				//array_push($providers_arr,$provider->provider_id);
			}
			\Log::info("Import sport episode cron is working fine!");
			return 0;
    }
}
