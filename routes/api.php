<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [API\AuthController::class, 'register']);
Route::get('providers-list', [API\GenresController::class, 'providers_list']);
Route::get('genres-list', [API\GenresController::class, 'genres_preference_list']);
Route::get('content-list', [API\GenresController::class, 'content_preferences_list']);
Route::get('check-email', [API\AuthController::class, 'checkEmail']);
Route::get('check-username', [API\AuthController::class, 'checkUsername']);
Route::post('login', [API\AuthController::class, 'login']);
Route::get('forget-password', [API\AuthController::class, 'ForgetPassword']);
Route::get('terms', [API\GeneralController::class, 'terms']);
Route::get('privacy', [API\GeneralController::class, 'privacy']);
Route::get('faq-list', [API\GeneralController::class, 'faq_list']);
Route::post('help', [API\GeneralController::class, 'help']);
//Route::get('testing', [API\GeneralController::class, 'testing']);
Route::post('social-login', [API\AuthController::class, 'SocialLogin']);


Route::group(['middleware' => ['auth:api']], function() {
	Route::get('user-detail', [API\User::class, 'user_detail']);
	Route::post('change-password', [API\User::class, 'changePassword']);
	Route::post('edit-profile', [API\User::class, 'editProfile']);
	Route::post('resent-verification-link', [API\User::class, 'resent_verification_mail']);
	Route::post('rate-us', [API\User::class, 'give_rating']);
	
	//home page api
	Route::get('home-page-data', [API\HomeController::class, 'getHomeData']);
	Route::get('explore-tab-data', [API\HomeController::class, 'getExploreTab']);
	Route::get('movie-detail', [API\DetailController::class, 'MovieDetail']);
	Route::get('tv-detail', [API\DetailController::class, 'TvDetail']);
	Route::get('sport-detail', [API\DetailController::class, 'SportDetail']);
	Route::get('episode-detail', [API\DetailController::class, 'EpisodeDetail']);
	Route::get('get-media-others', [API\DetailController::class, 'GetCast']);
	
	//activity
	Route::get('like-media', [API\User::class, 'likeMedia']);
	Route::get('unlike-media', [API\User::class, 'unlikeMedia']);
	Route::get('seen-media', [API\User::class, 'seenMedia']);
	Route::get('keep-watching', [API\User::class, 'keepWatching']);
	Route::get('unseen-media', [API\User::class, 'unseenMedia']);
	Route::get('add-to-watchlist', [API\User::class, 'addToWatchlist']);
	Route::get('remove-from-watchlist', [API\User::class, 'removeFromWatchlist']);
	Route::get('my-watchlist', [API\HomeController::class, 'myWatchlist']);
	Route::get('my-liked', [API\HomeController::class, 'myLiked']);
	
	//category filter api
	Route::get('latest-category', [API\mediaCategoryFilter::class, 'latest']);
	Route::get('upcoming-category', [API\mediaCategoryFilter::class, 'upcoming']);
	Route::get('in-theater-category', [API\mediaCategoryFilter::class, 'InTheater']);
	Route::get('most-watch-netflix-category', [API\mediaCategoryFilter::class, 'mostWatchNetflix']);
	Route::get('most-watch-hulu-category', [API\mediaCategoryFilter::class, 'mostWatchHulu']);
	Route::get('most-watch-prime-category', [API\mediaCategoryFilter::class, 'mostWatchPrime']);
	Route::get('trending-category', [API\mediaCategoryFilter::class, 'trending']);
	Route::get('top-rated-category', [API\mediaCategoryFilter::class, 'top_rated']);
	Route::get('popular-category', [API\mediaCategoryFilter::class, 'popular']);
	Route::get('retiring-category', [API\mediaCategoryFilter::class, 'retiring']);
	Route::get('past-category', [API\mediaCategoryFilter::class, 'past']);
	Route::get('all-sport-category', [API\mediaCategoryFilter::class, 'allSport']);
	Route::get('see-all-category', [API\mediaCategoryFilter::class, 'seeAll']);
	
	//filter api
	Route::get('search', [API\mediaCategoryFilter::class, 'search']);
	
	//friend,notification Module
	Route::get('users-list', [API\ChatController::class, 'userList']);
	Route::get('send-invitation', [API\ChatController::class, 'sendRequest']);
	Route::get('accept-invitation', [API\ChatController::class, 'acceptRequest']);
	Route::get('reject-invitation', [API\ChatController::class, 'rejectRequest']);
	Route::get('my-friends', [API\ChatController::class, 'myFriends']);
	Route::get('unread-count', [API\ChatController::class, 'IntervalAPI']);
	Route::get('notifications', [API\ChatController::class, 'notifications']);
	
	//chat
	Route::post('send-message', [API\ChatController::class, 'SendMessage']);
	Route::get('chat-detail', [API\ChatController::class, 'ChatBetweenUsers']);
	Route::get('delete-chat-message', [API\ChatController::class, 'DeleteMessage']);
	Route::post('create-group', [API\ChatController::class, 'CreateGroup']);
	Route::post('edit-group', [API\ChatController::class, 'EditGroup']);
	Route::get('group-list', [API\ChatController::class, 'GroupList']);
	Route::get('group-detail', [API\ChatController::class, 'GroupDetail']);
	Route::get('testing-2', [API\ChatController::class, 'testing']); //not in use
	
	//feed api
	Route::get('share-to-feed', [API\FeedController::class, 'shareToFeed']);
	Route::get('feeds', [API\FeedController::class, 'feeds']);
	Route::get('like-feed', [API\FeedController::class, 'likeFeed']);
	Route::get('unlike-feed', [API\FeedController::class, 'unlikeFeed']);
	Route::get('add-feed-comment', [API\FeedController::class, 'addFeedComment']);
	Route::get('feed-like-users', [API\FeedController::class, 'feedLikeUsers']);
	Route::get('feed-comment-users', [API\FeedController::class, 'feedCommentUsers']);
	
	
	Route::get('my-recommendation', [API\RecommendationController::class, 'getRecommendation']);
	
	
	
});

