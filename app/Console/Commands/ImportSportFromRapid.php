<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ApiKey;
use App\Models\AllSportModel;
use App\Models\SportGameModel;

class ImportSportFromRapid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportSportFromRapid:cron';

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
			$sports = AllSportModel::get();
			foreach($sports as $key => $sport){
				
				$endPoint = $sport->sport_key.'/scores'; //am not calling this because pas api also include upcoming data
				
				/*$responce = $ApiKey->LiveSportOdds($endPoint);
				if($responce && is_array($responce) && !empty($responce)){
					foreach($responce as $key1 => $game){
						
						
						$insert = [];
						$insert['sport_key'] = $game->sport_key;
						$insert['sport_title'] = $game->sport_title;
						$insert['commence_time'] = date('Y-m-d H:i:s',strtotime($game->commence_time));
						$insert['completed'] = ($game->completed) ? 1 : 0;
						$insert['home_team'] = $game->home_team;
						$insert['away_team'] = $game->away_team;
						$insert['sport_id'] = $sport->id;
						if($game->scores){
							$insert['scores'] = serialize($game->scores);
						}
						
						$insert['last_update'] = date('Y-m-d H:i:s',strtotime($game->last_update));;
						
						$check = SportGameModel::where('game_id',$game->id)->first(['id']);
						
						if($check){
							SportGameModel::where('id',$check->id)->update($insert);
						} else {
							$insert['game_id'] = $game->id;
							SportGameModel::insert($insert);
						}
						
					}
				}
				*/
				
				$endPoint2 = $sport->sport_key.'/scores';
				$endApiData = array(
					'daysFrom'=>3
				);
					
				$responce2 = $ApiKey->LiveSportOdds($endPoint2,$endApiData);
				if($responce2 && is_array($responce2) && !empty($responce2)){
					foreach($responce2 as $key1 => $game){
						
						
						$insert = [];
						$insert['sport_key'] = $game->sport_key;
						$insert['sport_title'] = $game->sport_title;
						$insert['commence_time'] = date('Y-m-d H:i:s',strtotime($game->commence_time));
						$insert['completed'] = ($game->completed) ? 1 : 0;
						$insert['home_team'] = $game->home_team;
						$insert['away_team'] = $game->away_team;
						$insert['sport_id'] = $sport->id;
						if($game->scores){
							$insert['scores'] = serialize($game->scores);
						}
						
						$insert['last_update'] = date('Y-m-d H:i:s',strtotime($game->last_update));;
						
						$check = SportGameModel::where('game_id',$game->id)->first(['id']);
						
						if($check){
							SportGameModel::where('id',$check->id)->update($insert);
						} else {
							$insert['game_id'] = $game->id;
							SportGameModel::insert($insert);
						}
						
					}
				}
				
			}
			return 0;
    }
}
