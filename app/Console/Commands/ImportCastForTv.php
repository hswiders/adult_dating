<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MovideVideoModel;
use App\Models\CastModel;
use App\Models\ApiKey;
use App\Models\TvModel;
use App\Models\EpisodeModel;
use App\Models\SeasonModel;
use App\Models\GuestStarModel;
use App\Models\ProductionCompanyModel;
use App\Models\CrewModel;
use DB;

class ImportCastForTv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportCastForTv:cron';

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
			
			$myfile = fopen("importCastForTv.txt", "w") or die("Unable to open file!");
			$txt = date('Y-m-d H:i:s');
			$txt .= '/Start';
			fwrite($myfile, $txt);
			fclose($myfile);
			
			$ApiKey = new ApiKey();
			
			$data = TvModel::select('id','tmdb_id')
				->where("is_deleted",0)
				->where("is_meta_updated",0)
				->orderBy('id','desc')->limit(50)->get();
			//echo '<pre>';
			if(!empty($data)){
				foreach($data as $key => $row){
					
					
					$endPoint = 'tv/'.$row->tmdb_id;
			
					$data1['append_to_response']	='credits,videos';
					
					$responce = $ApiKey->TmDbCurl($endPoint,$data1);
					//print_r($responce);
					
					if(!isset($responce->id)){
						
						if(isset($responce->status_code) && $responce->status_code==34){
							$row->is_meta_updated = 1;
							$row->is_deleted = 1;
							$row->save();
						}
						
						continue;
					}
					//echo ($responce);
					//continue;
					
					//echo '<pre>'; print_r($responce);
					
					$checkCountPc = ProductionCompanyModel::where([
						'media_type'=>'tv',
						'media_id'=>$row->id
					])->count();
					
					if(isset($responce->production_companies) && !empty($responce->production_companies) && $checkCountPc==0){
						
						foreach($responce->production_companies as $key1 => $val1){
							
							//print_r($val1);
							
							ProductionCompanyModel::insert([
								'media_type'=>'tv',
								'media_id'=>$row->id,
								'tmdb_id'=>$val1->id,
								'logo_path'=>$val1->logo_path,
								'name'=>$val1->name,
								'origin_country'=>$val1->origin_country
							]);
						}
						
					}
					
					if(isset($responce->credits) && $responce->credits){
						if(isset($responce->credits->cast) && !empty($responce->credits->cast)){
							
							foreach($responce->credits->cast as $key1 => $val1){
								
								$checkCount = CastModel::where([
									'media_type'=>'tv',
									'media_id'=>$row->id,
									'tmdb_id'=>$val1->id
								])->count();
								
								if($checkCount==0){
								
									CastModel::insert([
										'media_type'=>'tv',
										'media_id'=>$row->id,
										'tmdb_id'=>$val1->id,
										'adult'=>$val1->adult ? 1 : 0,
										'gender'=>$val1->gender,
										'known_for_department'=>$val1->known_for_department,
										'name'=>$val1->name,
										'original_name'=>$val1->original_name,
										'profile_path'=>$val1->profile_path,
										//'cast_id'=>$val1->cast_id,
										'characters'=>$val1->character,
										'credit_id'=>$val1->credit_id,
										'orders'=>$val1->order,
									]);
								}
								
							}
							
						}
						
						$checkCount = CrewModel::where([
							'media_type'=>'tv',
							'media_id'=>$row->id,
						])->count();
						
						if($checkCount==0){
						
							if(isset($responce->credits->crew) && !empty($responce->credits->crew)){
								
								foreach($responce->credits->crew as $key1 => $val1){
									if($val1->department=='Directing' || $val1->known_for_department=='Directing'){	
										
										$checkCount = CrewModel::where([
											'media_type'=>'tv',
											'media_id'=>$row->id,
											'tmdb_id'=>$val1->id
										])->count();
										
										if($checkCount==0){
											CrewModel::insert([
												'media_type'=>'tv',
												'media_id'=>$row->id,
												'tmdb_id'=>$val1->id,
												'adult'=>$val1->adult ? 1 : 0,
												'gender'=>$val1->gender,
												'known_for_department'=>$val1->known_for_department,
												'name'=>$val1->name,
												'original_name'=>$val1->original_name,
												'profile_path'=>$val1->profile_path,
												'department'=>$val1->department,
												'credit_id'=>$val1->credit_id,
											]);
										}
									}
								}
									
							}
								
						}
						
					}
					
					if(isset($responce->seasons) && is_array($responce->seasons) && !empty($responce->seasons)){
						$this->add_season($responce->seasons,$row->id,$responce->id,'tv');
					}
					
					$videos=$responce->videos->results;
					//print_r($videos);
					
					$videos2 = MovideVideoModel::where([
								'movie_id'=>$row->id,
								'media_type'=>'tv',
							])->count();
				
					if(count($videos) > 0 && $videos2 == 0)
					{
						foreach($videos as $key11 => $vid)
						{
							if($key11 >= 2) {
								continue;
							} else {
							
								$dd = MovideVideoModel::insert([
									'video_id'=>$vid->id,
									'movie_id'=>$row->id,
									'media_type'=>'tv',
									'name'=>$vid->name,
									'video_key'=>$vid->key,
									'site'=>$vid->site,
									'type'=>$vid->type,
									'official'=>$vid->official,
									'iso_639_1'=>$vid->iso_639_1,
									'iso_3166_1'=>$vid->iso_3166_1,
								]);
							}
							//print_r($dd);
							
							
						
						}
						
					}
			
					
					
					
					$row->is_meta_updated = 1;
					$row->save();
				}
			}

			$myfile = fopen("importCastForTv.txt", "w") or die("Unable to open file!");
			$txt .= date('Y-m-d H:i:s');
			$txt .= '/End';
			fwrite($myfile, $txt);
			fclose($myfile);
			\Log::info("Import sport episode cron is working fine!");
			return 0;
    }
		
		private function add_season($seasons,$id,$tmdb_id,$type) {
			$ApiKey = new ApiKey();
			
			foreach($seasons as $key => $value){
				
				$checkCount = SeasonModel::where([
					'tmdb_id'=>$value->id,
					'media_id'=>$id,
					'media_type'=>'tv',
				])->count();
				
				if($checkCount==0){
				
					SeasonModel::insert([
						'tmdb_id'=>$value->id,
						'media_id'=>$id,
						'media_type'=>'tv',
						'air_date'=>$value->air_date ? $value->air_date : NULL,
						//'known_for_department'=>$value->known_for_department,
						'episode_count'=>$value->episode_count,
						'name'=>$value->name,
						'overview'=>$value->overview,
						'poster_path'=>$value->poster_path,
						'season_number'=>$value->season_number,
					]);
				}
				
				$endPoint = 'tv/'.$tmdb_id.'/season/'.$value->season_number;
				
				$responce = $ApiKey->TmDbCurl($endPoint);
				
				if(isset($responce->episodes) && is_array($responce->episodes) && !empty($responce->episodes)){
					
					foreach($responce->episodes as $key1 => $value1){
						
						$checkCount = EpisodeModel::where([
							'season_number'=>$value1->season_number,
							'tmdb_id'=>$value1->id,
							'media_id'=>$id,
							'media_type'=>'tv',
						])->count();
						
						if($checkCount==0){
						
							EpisodeModel::insert([
								'season_number'=>$value1->season_number,
								'tmdb_id'=>$value1->id,
								'media_id'=>$id,
								'media_type'=>'tv',
								'air_date'=>$value1->air_date ? $value1->air_date : NULL,
								'episode_number'=>$value1->episode_number,
								'name'=>$value1->name,
								'overview'=>$value1->overview,
								'production_code'=>$value1->production_code,
								'runtime'=>$value1->runtime,
								'show_id'=>isset($value1->show_id) ? $value1->show_id : 0,
								'still_path'=>$value1->still_path,
								'vote_average'=>$value1->vote_average,
								'vote_count'=>$value1->vote_count,
							]);
						}
						
						if(isset($value1->guest_stars) && !empty($value1->guest_stars)){
							
							/*$guestCount = GuestStarModel::where([
								'media_type'=>'tv',
								'season'=>$value1->season_number,
								'media_id'=>$id,
								//'tmdb_id'=>$val1->id
								//'tmdb_id'=>$val1->id
							])->count();
							
							if($guestCount==0){*/
							
							foreach($value1->guest_stars as $key1 => $val1){
								
								if(isset($val1->id)){
									
								
									$checkCount = GuestStarModel::where([
										'media_type'=>'tv',
										'season'=>$value1->season_number,
										'media_id'=>$id,
										'tmdb_id'=>$val1->id
									])->count();
									
									if($checkCount==0){
									
										GuestStarModel::insert([
											'media_type'=>'tv',
											'season'=>$value1->season_number,
											'media_id'=>$id,
											'tmdb_id'=>$val1->id,
											'character_name'=>$val1->character,
											'adult'=>0,
											//'gender'=>$val1->gender,
											//'known_for_department'=>$val1->known_for_department,
											'name'=>$val1->name,
											'original_name'=>isset($val1->original_name) ? $val1->original_name : $val1->name,
											'popularity'=>0,
											'profile_path'=>$val1->profile_path,
											'credit_id'=>$val1->credit_id,
											'order'=>$val1->order,
										]);
										
									}
								}
							}
								
							//}
						}
						
					}
					
				}
				
			}
			//die();
			
		}

}
