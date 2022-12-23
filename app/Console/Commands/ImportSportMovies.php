<?php

namespace App\Console\Commands;
ini_set('max_execution_time', 0);
use Illuminate\Console\Command;
use App\Models\SportMovieModel;
use App\Models\ApiKey;
use App\Models\ProviderModel;
use App\Models\CastModel;

class ImportSportMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportSportMovies:cron';

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
				
				$endPointK = 'movies';
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
					
					$endPoint = 'movies';
					$endApiData = array(
						'page'=>$k
					);
					$responce = $ApiKey->TvDbCurl($endPoint,$endApiData);
					
					//print_r($responce); die();
					
					if(isset($responce->status) && $responce->status=='success' && isset($responce->data) && !empty($responce->data)){
					
						
					
						foreach($responce->data as $key => $value){
							
							$lastUpdated = date('Y',strtotime($value->lastUpdated))*1;
				
						
							if(in_array($lastUpdated,$years)){
								
								
								
								echo $value->id.',';
								$check = SportMovieModel::where('tvdb_id',$value->id)->where('lastUpdated','!=',$value->lastUpdated)->count();
								
								
								if($check==0){
									$endPoint2 = 'movies/'.$value->id.'/extended';
									$responce2 = $ApiKey->TvDbCurl($endPoint2);
									if(isset($responce2->status) && $responce2->status=='success' && isset($responce2->data) && !empty($responce2->data)){
										$detail = $responce2->data;
										if($detail->originalLanguage=='eng' && $detail->originalCountry=='usa'){
											
											//print_r($detail->id);
											//echo '<br>';
											$checkNetworks = [];
									
											if(isset($detail->companies->network) && !empty($detail->companies->network)){
													
												foreach($detail->companies->network as $key2 => $network){
													
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
												$insert['score'] = isset($detail->score) ? $detail->score : 0;;
												$insert['runtime'] = isset($detail->score) ? $detail->score : 0;;
												//$insert['homepage'] = $detail->;
												if(isset($detail->status->name)){
													$insert['status'] = $detail->status->name;
												}
												
												$insert['lastUpdated'] = $detail->lastUpdated;
												$insert['year'] = isset($detail->year) ? $detail->year : 0;
												
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
												
												
												$insert['budget'] = $detail->budget;
												$insert['boxOffice'] = $detail->boxOffice;
												$insert['boxOfficeUS'] = $detail->boxOfficeUS;
												$insert['originalCountry'] = $detail->originalCountry;
												$insert['originalLanguage'] = $detail->originalLanguage;
												$insert['audioLanguages'] = $detail->audioLanguages;
												$insert['subtitleLanguages'] = $detail->subtitleLanguages;
												
												if(isset($detail->studios) && !empty($detail->studios)){
													$insert['studios'] = serialize($detail->studios);
												}
												
												if(isset($detail->awards) && !empty($detail->awards)){
													$insert['awards'] = serialize($detail->awards);
												}
												
												if(isset($detail->tagOptions) && !empty($detail->tagOptions)){
													$insert['tagOptions'] = serialize($detail->tagOptions);
												}
												if(isset($detail->lists) && !empty($detail->lists)){
													$insert['lists'] = serialize($detail->lists);
												}
												
													
														
												$insert['companies'] = implode(',',$checkNetworks);
												
												if(isset($detail->first_release->date)){
													$insert['first_release'] = $detail->first_release->date;
												}
												if(isset($detail->overview)){
													$insert['overview'] = $detail->overview;
												}
												
												$lastInsert = SportMovieModel::updateOrCreate(['tvdb_id'=>$detail->id],$insert);
												
												
												
												if(isset($detail->characters) && !empty($detail->characters)){
													foreach($detail->characters as $key1 => $character){
														
														$checkCount = CastModel::where([
															'media_type'=>'sport-movie-cast',
															'media_id'=>$lastInsert->id,
															'tmdb_id'=>$character->id
														])->count();
														
														if($checkCount==0){
															CastModel::insert([
																'media_type'=>'sport-movie-cast',
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
											}
											
											
										}
										
									}
									
									
										
									
								
								}
								
							}
							
						}
					}	
					
				}
				
				
			}
			\Log::info("Cron is working fine!");
			return 0;
    }
}
