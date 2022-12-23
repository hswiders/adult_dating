<?php

namespace App\Console\Commands;
ini_set('max_execution_time', 0);
use Illuminate\Console\Command;
use App\Models\ApiKey;
use App\Models\SportSeriesModel;
use App\Models\ProviderModel;
use App\Models\CastModel;
use App\Models\SeasonModel;

class ImportSportSeries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportSportSeries:cron';

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
			
			$startYear = date('Y')*1;
			$endYear = 2010;
			$years = [];
			for($i = $startYear; $i >= $endYear; $i--){
				array_push($years,$i);
			}
			
			$today = date('Y-m-d');
			$add10Day = date('Y-m-d',strtotime($today.' -10 days'));
			
			$providers_arr = [];
			
			$providers = ProviderModel::where('types','sport')->where('is_deleted',0)->get();
			foreach($providers as $provider){
				array_push($providers_arr,$provider->provider_id);
			}
			
			
			
			if(!empty($providers_arr)){
				
				$endPointK = 'series';
				$responceK = $ApiKey->TvDbCurl($endPointK);
				
				if(isset($responceK->message) && $responceK->message =='Unauthorized'){
					$responceK = $ApiKey->TvDbCurl($endPointK);
				}
				
				if(isset($responceK->links->total_items) && $responceK->links->total_items > $responceK->links->page_size){
					$pages = ceil($responceK->links->total_items/$responceK->links->page_size);
				} else {
					$pages = 1;
				}
						
				
				for($k = $pages; $k >= 1; $k--){
					
					$endPoint = 'series';
					$endApiData = array(
						'page'=>$k
					);
					//print_r($endApiData);
					
					$responce = $ApiKey->TvDbCurl($endPoint,$endApiData);
					
					//print_r($responce); die();
					
					if(isset($responce->status) && $responce->status=='success' && isset($responce->data) && !empty($responce->data)){
					
						
					
						foreach($responce->data as $key => $value){
							
							$lastUpdated = date('Y',strtotime($value->lastUpdated))*1;
					
							
							if(in_array($lastUpdated,$years)){
								
								
								
								echo $value->id.',';
								$check = SportSeriesModel::where('tvdb_id',$value->id)->where('lastUpdated','!=',$value->lastUpdated)->count();
								
								if($check==0){
									
									$endPoint2 = 'series/'.$value->id.'/extended';
									$responce2 = $ApiKey->TvDbCurl($endPoint2);
									
									if(isset($responce2->status) && $responce2->status=='success' && isset($responce2->data) && !empty($responce2->data)){
										$detail = $responce2->data;
										
										
										
										if($detail->originalLanguage=='eng' && $detail->originalCountry=='usa'){
											
											
											
											//print_r($detail->id);
											//echo '<br>';
											$checkNetworks = [];
									
											if(isset($detail->companies) && !empty($detail->companies)){
													
												foreach($detail->companies as $key2 => $network){
													
													if(in_array($network->id,$providers_arr)){
														array_push($checkNetworks,$network->id);
													}
												}
											}
											
											if(!empty($checkNetworks)){
												
												print_r($checkNetworks);
												
												
												//print_r($checkNetworks); die();
												
												$insert = [];
												$insert['tvdb_id'] = $detail->id;
												$insert['name'] = $detail->name; 
												$insert['slug'] = $detail->slug;
												$insert['image'] = $detail->image;
												$insert['score'] = isset($detail->score) ? $detail->score : 0;
												$insert['averageRuntime'] = isset($detail->averageRuntime) ? $detail->averageRuntime : 0;
												//$insert['homepage'] = $detail->;
												if(isset($detail->status->name)){
													$insert['status'] = $detail->status->name;
												}
												
												$insert['lastUpdated'] = $detail->lastUpdated;
												
												if(isset($detail->trailers) && !empty($detail->trailers)){
													
													if(count($detail->trailers) > 2){
														
														$trailers[0] = $detail->trailers[0];
														$trailers[1] = $detail->trailers[1];
														$insert['trailers'] = serialize($trailers);
													} else {
														$insert['trailers'] = serialize($detail->trailers);
													}
													
												}
												
												if(isset($detail->genres) && !empty($detail->genres)){
													$insert['genres'] = serialize($detail->genres);
												}
												if(isset($detail->releases) && !empty($detail->releases)){
													$insert['releases'] = serialize($detail->releases);
												}
												
												
												//$insert['budget'] = $detail->budget;
												//$insert['boxOffice'] = $detail->boxOffice;
												//$insert['boxOfficeUS'] = $detail->boxOfficeUS;
												$insert['originalCountry'] = $detail->originalCountry;
												$insert['originalLanguage'] = $detail->originalLanguage;
												//$insert['audioLanguages'] = $detail->audioLanguages;
												//$insert['subtitleLanguages'] = $detail->subtitleLanguages;
												$insert['firstAired'] = $detail->firstAired;
												$insert['nextAired'] = $detail->nextAired;
												$insert['lastAired'] = $detail->lastAired;
												$insert['airsTime'] = $detail->airsTime;
												$insert['tags'] = $detail->tags;
											
												
												if(isset($detail->tagOptions) && !empty($detail->tagOptions)){
													$insert['tagOptions'] = serialize($detail->tagOptions);
												}
												if(isset($detail->lists) && !empty($detail->lists)){
													$insert['lists'] = serialize($detail->lists);
												}
												if(isset($detail->airsDays) && !empty($detail->airsDays)){
													$insert['airsDays'] = serialize($detail->airsDays);
												}
												
													
														
												$insert['companies'] = implode(',',$checkNetworks);
												
												if(isset($detail->first_release->date)){
													$insert['first_release'] = $detail->first_release->date;
												}
												if(isset($detail->overview)){
													$insert['overview'] = $detail->overview;
												}
												
												$lastInsert = SportSeriesModel::updateOrCreate(['tvdb_id'=>$detail->id],$insert);
												
												
												
												if(isset($detail->characters) && !empty($detail->characters)){
													foreach($detail->characters as $key1 => $character){
														
														$checkCount = CastModel::where([
															'media_type'=>'sport-series-cast',
															'media_id'=>$lastInsert->id,
															'tmdb_id'=>$character->id
														])->count();
														
														if($checkCount==0){
															CastModel::insert([
																'media_type'=>'sport-series-cast',
																'media_id'=>$lastInsert->id,
																'tmdb_id'=>$character->id,
																'adult'=>0,
																//'gender'=>$character->gender,
																//'known_for_department'=>$character->known_for_department,
																'name'=>$character->name,
																'original_name'=>$character->personName,
																'profile_path'=>$character->image,
																'cast_id'=>$character->peopleId,
																//'characters'=>$character->character,
																//'credit_id'=>$character->credit_id,
																//'orders'=>$character->order,
															]);
														}
														
													}
												}
											
												if(isset($detail->seasons) && !empty($detail->seasons)){
													foreach($detail->seasons as $key1 => $season){
														
														$checkCount = SeasonModel::where([
															'tmdb_id'=>$season->id,
															'media_id'=>$lastInsert->id,
															'media_type'=>'sport-series',
														])->count();
														
														if($checkCount==0){
														
															SeasonModel::insert([
																'tmdb_id'=>$season->id,
																'media_id'=>$lastInsert->id,
																'media_type'=>'sport-series',
																//'air_date'=>$value->air_date ? $value->air_date : NULL,
																//'known_for_department'=>$value->known_for_department,
																//'episode_count'=>$value->episode_count,
																'name'=>isset($season->name) ? $season->name : '',
																//'overview'=>$value->overview,
																//'poster_path'=>$value->poster_path,
																'season_number'=>$season->number,
															]);
														}
				
														
													}
												}
											
											}
											
											
										}
										
									}
									
									
										
									
								
								}
								
							}
							
						}
					}	
					
				}
				
				
			}
		
			\Log::info("ImportSportSeries:cron Working fine");
			return 0;
    }
}
