<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MovieModel;
use App\Models\TvModel;
use App\Models\ApiKey;

class ImportImdbID extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportImdbID:cron';

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
			$today = date('Y-m-d');
			$checkDate = date('Y-m-d',strtotime($today.' -10 days'));
			$shows = TvModel::where(function($query) use ($checkDate){
				$query->whereDate('last_imdb_search_date','<',$checkDate);
				$query->orWhereNull('last_imdb_search_date');
			})
			->where(function($query) use ($checkDate){
				$query->where('imdb_id',0);
				$query->orWhereNull('imdb_id');
			})
			->where('is_deleted',0)
			->orderBy('id','desc')
			->limit(300)
			->get(['id','title','last_imdb_search_date','imdb_id','poster_path']);
			foreach($shows as $show){
			
				
				$endPoint = 'search';
				$param = [
					'query'=>$show->title,
					'limit'=>1,
					'type'=>'series'
				];
				$response = $ApiKey->TvDbCurl($endPoint,$param);
				
				//print_r($response->data[0]->); die();
				
				if(isset($response->data[0]->name) && strtolower($response->data[0]->name) == strtolower($show->title)){
					$data = $response->data[0];
					if(isset($data->remote_ids) && !empty($data->remote_ids)){
						foreach($data->remote_ids as $remote_id){
							if($remote_id->sourceName=='IMDB'){
								$show->imdb_id = $remote_id->id;
							}
						}
					}
					
					if(!$show->poster_path && isset($data->image_url) && !empty($data->image_url)){
						$show->poster_path = $data->image_url;
					}
				}
				
				$show->last_imdb_search_date = $today;
				$show->save();
				
				
			}
			
			
			$movies = MovieModel::where(function($query) use ($checkDate){
				$query->whereDate('last_imdb_search_date','<',$checkDate);
				$query->orWhereNull('last_imdb_search_date');
			})
			->where(function($query) use ($checkDate){
				$query->where('imdb_id',0);
				$query->orWhereNull('imdb_id');
			})
			->where('is_deleted',0)
			->orderBy('id','desc')
			->limit(300)
			->get(['id','title','last_imdb_search_date','imdb_id','poster_path']);
			foreach($movies as $movie){
			
				
				$endPoint = 'search';
				$param = [
					'query'=>$movie->title,
					'limit'=>1,
					'type'=>'movie'
				];
				$response = $ApiKey->TvDbCurl($endPoint,$param);
				
				//print_r($response->data[0]->); die();
				
				if(isset($response->data[0]->name) && strtolower($response->data[0]->name) == strtolower($movie->title)){
					$data = $response->data[0];
					if(isset($data->remote_ids) && !empty($data->remote_ids)){
						foreach($data->remote_ids as $remote_id){
							if($remote_id->sourceName=='IMDB'){
								$movie->imdb_id = $remote_id->id;
							}
						}
					}
					
					if(!$movie->poster_path && isset($data->image_url) && !empty($data->image_url)){
						$movie->poster_path = $data->image_url;
					}
				}
				
				$movie->last_imdb_search_date = $today;
				$movie->save();
				
				
			}
			
			\Log::info("Import sport episode cron is working fine!");
			return 0;
    }
}
