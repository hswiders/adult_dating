<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MovieModel;
use App\Models\MovideVideoModel;
use App\Models\CastModel;
use App\Models\ApiKey;
use App\Models\ProductionCompanyModel;
use App\Models\CrewModel;
use DB;

class ImportCastForMovie extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportCastForMovie:cron';

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
			$myfile = fopen("importCastForMovie.txt", "w") or die("Unable to open file!");
			$txt = date('Y-m-d H:i:s');
			$txt .= '/Start';
			fwrite($myfile, $txt);
			fclose($myfile);
			
			$ApiKey = new ApiKey();
			
			$data = MovieModel::select('id','tmdb_id')
				->where("is_deleted",0)
				->where("is_meta_updated",0)
				->orderBy('id','desc')->limit(150)->get();
			//echo '<pre>';
			if(!empty($data)){
				foreach($data as $key => $row){
					//print_r($row);
					
					$endPoint = 'movie/'.$row->tmdb_id;
			
					$data1['append_to_response']	='credits,videos';
					
					$responce = $ApiKey->TmDbCurl($endPoint,$data1);
					
					if(!isset($responce->id)){
						if(isset($responce->status_code) && $responce->status_code==34){
							$row->is_meta_updated = 1;
							$row->is_deleted = 1;
							$row->save();
						}
						continue;
					}
					
					$checkCountPc = ProductionCompanyModel::where([
						'media_type'=>'movie',
						'media_id'=>$row->id
					])->count();
					
					if(isset($responce->production_companies) && !empty($responce->production_companies) && $checkCountPc==0){
						
						foreach($responce->production_companies as $key1 => $val1){
							
							//print_r($val1);
							
							ProductionCompanyModel::insert([
								'media_type'=>'movie',
								'media_id'=>$row->id,
								'tmdb_id'=>$val1->id,
								'logo_path'=>$val1->logo_path,
								'name'=>$val1->name,
								'origin_country'=>$val1->origin_country
							]);
						}
						
					}
					//echo ($responce);
					//continue;
					
					//echo '<pre>'; print_r($row->id); print_r($responce); die();
					
					if(isset($responce->credits) && $responce->credits){
						if(isset($responce->credits->cast) && !empty($responce->credits->cast)){
							
							foreach($responce->credits->cast as $key1 => $val1){
								
								$checkCount = CastModel::where([
									'media_type'=>'movie',
									'media_id'=>$row->id,
									'tmdb_id'=>$val1->id
								])->count();
								
								if($checkCount==0){
									CastModel::insert([
										'media_type'=>'movie',
										'media_id'=>$row->id,
										'tmdb_id'=>$val1->id,
										'adult'=>$val1->adult ? 1 : 0,
										'gender'=>$val1->gender,
										'known_for_department'=>$val1->known_for_department,
										'name'=>$val1->name,
										'original_name'=>$val1->original_name,
										'profile_path'=>$val1->profile_path,
										'cast_id'=>$val1->cast_id,
										'characters'=>$val1->character,
										'credit_id'=>$val1->credit_id,
										'orders'=>$val1->order,
									]);
								}
								
								
								//echo 'update Cast time '.date('Y-m-d H:i:s').'-'.$id.'<br>';
								
							}
							
						}
						
						$checkCount = CrewModel::where([
							'media_type'=>'movie',
							'media_id'=>$row->id,
						])->count();
						
						if($checkCount==0){
						
							if(isset($responce->credits->crew) && !empty($responce->credits->crew)){
								
								foreach($responce->credits->crew as $key1 => $val1){
									
									
									
									if($val1->department=='Directing' || $val1->known_for_department=='Directing'){	
									
										$checkCount = CrewModel::where([
											'media_type'=>'movie',
											'media_id'=>$row->id,
											'tmdb_id'=>$val1->id
										])->count();
										
										if($checkCount==0){
											
										
											CrewModel::insert([
												'media_type'=>'movie',
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
					
					$videos=$responce->videos->results;
					
					$videos2 = MovideVideoModel::where([
								'movie_id'=>$row->id,
								'media_type'=>'movie',
							])->count();
				
					if(count($videos) > 0 && $videos2 == 0)
					{
						
						foreach($videos as $key11 => $vid)
						{
							
							if($key11 >= 2) {
								continue;
							} else {
							
								MovideVideoModel::insert([
									'video_id'=>$vid->id,
									'movie_id'=>$row->id,
									'media_type'=>'movie',
									'name'=>$vid->name,
									'video_key'=>$vid->key,
									'site'=>$vid->site,
									'type'=>$vid->type,
									'official'=>$vid->official,
									'iso_639_1'=>$vid->iso_639_1,
									'iso_3166_1'=>$vid->iso_3166_1,
								]);
							}
							//echo 'update Video time '.date('Y-m-d H:i:s').'-'.$id.'<br>';
							
						}
					
						
						
						
					}
			
					
					$row->is_meta_updated = 1;
					$row->save();
				}
			}

			$myfile = fopen("importCastForMovie.txt", "w") or die("Unable to open file!");
			$txt .= date('Y-m-d H:i:s');
			$txt .= '/End';
			fwrite($myfile, $txt);
			fclose($myfile);
			
			\Log::info("Import sport episode cron is working fine!");
			return 0;
    }
}
