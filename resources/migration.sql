ALTER TABLE `cast` CHANGE `characters` `characters` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

ALTER TABLE `movies` CHANGE `cast` `cast` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `tv_shows` CHANGE `cast` `cast` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;


TRUNCATE TABLE movie_videos;
TRUNCATE TABLE movies;
TRUNCATE TABLE stream_available;
TRUNCATE TABLE tv_shows;
TRUNCATE TABLE `cast`;
TRUNCATE TABLE `crew`;
TRUNCATE TABLE `episode`;
TRUNCATE TABLE `guest_stars`;
TRUNCATE TABLE `movie_videos`;
TRUNCATE TABLE `seasons`;
TRUNCATE TABLE `stream_available`;
TRUNCATE TABLE `tv_shows`;


ALTER TABLE `movies` ADD `crew` TEXT NULL DEFAULT NULL;
ALTER TABLE `tv_shows` ADD `crew` TEXT NULL DEFAULT NULL;

ALTER TABLE `cast` ADD `media_type` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `cast` ADD `media_id` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `crew` ADD `media_type` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `crew` ADD `media_id` VARCHAR(255) NULL DEFAULT NULL;

ALTER TABLE `guest_stars` ADD `season` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `crew` ADD `season` VARCHAR(255) NULL DEFAULT NULL;


ALTER TABLE movies DROP COLUMN crew;
ALTER TABLE movies DROP COLUMN cast;
ALTER TABLE tv_shows DROP COLUMN crew;
ALTER TABLE tv_shows DROP COLUMN cast;

CREATE INDEX search_cast ON `cast` (media_id, media_type, tmdb_id);
CREATE INDEX search_crew ON `crew` (media_id, media_type, tmdb_id);
CREATE INDEX search_guest_stars ON `guest_stars` (media_id, media_type, tmdb_id);
CREATE INDEX search_seasons ON `seasons` (media_id, media_type, tmdb_id);
CREATE INDEX search_episode ON `episode` (media_id, media_type, tmdb_id);

CREATE INDEX search_movies ON `movies` (id, tmdb_id, release_date, title, status,is_deleted,is_trending);
CREATE INDEX search_tv ON `tv_shows` (id, tmdb_id, release_date, title, status,is_deleted,is_trending);
CREATE INDEX search_trending ON `trending` (id, tmdb_id,media_type,media_id);

DROP INDEX search_movies ON `movies`;
DROP INDEX search_tv ON `tv_shows`;

DROP INDEX search_cast ON `cast`;
DROP INDEX search_crew ON `crew`;
DROP INDEX search_guest_stars ON `guest_stars`;


ALTER TABLE tv_shows DROP COLUMN `type`;
ALTER TABLE movies DROP COLUMN `type`;


ALTER TABLE `movies` ADD `is_trending` tinyint(1) NULL DEFAULT 0;
ALTER TABLE `movies` ADD `in_theater` tinyint(1) NULL DEFAULT 0;
ALTER TABLE `movies` ADD `is_meta_updated` tinyint(1) NULL DEFAULT 0;
ALTER TABLE `tv_shows` ADD `is_meta_updated` tinyint(1) NULL DEFAULT 0;
ALTER TABLE `tv_shows` ADD `is_trending` tinyint(1) NULL DEFAULT 0;


ALTER TABLE `tv_shows` ADD `is_popular` tinyint(1) NULL DEFAULT 0;
ALTER TABLE `tv_shows` ADD `is_top_rated` tinyint(1) NULL DEFAULT 0;
ALTER TABLE `movies` ADD `is_popular` tinyint(1) NULL DEFAULT 0;
ALTER TABLE `movies` ADD `is_top_rated` tinyint(1) NULL DEFAULT 0;

ALTER TABLE `movies` CHANGE `popularity` `popularity` FLOAT NOT NULL DEFAULT 0;
ALTER TABLE `tv_shows` CHANGE `popularity` `popularity` FLOAT NOT NULL DEFAULT 0;

ALTER TABLE `movies` ADD `last_update` DATE NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `tv_shows` ADD `last_update` DATE NULL DEFAULT CURRENT_TIMESTAMP
;
ALTER TABLE `movie_videos` ADD `rapid` int NULL DEFAULT NULL;


CREATE INDEX search_video ON `movie_videos` (id,media_type,movie_id);
CREATE INDEX search_stream ON `stream_available` (id,media_type,movie_id);

TRUNCATE TABLE guest_stars;
update tv_shows set is_meta_updated = 0;

ALTER TABLE `providers` ADD `types`, network_id VARCHAR(255) NULL DEFAULT 'movie-tv';

php artisan make:migration add_multiple_column_to_providers

Insert into `providers` (provider_id,provider_name,logo_path,display_priority,types,network_id) VALUES 
(1509,'ESPN+','public/images/providers/ESPN+.png',0,'sport',49),
(48103,'DAZN','public/images/providers/dazn.png',0,'sport',8),
(929,'Twitch','public/images/providers/Twitch.png',0,'sport',191),
(1474,'UFC Fight Pass','public/images/providers/UFCFightPass.png',0,'sport',10),
(1052,'WWE Network','public/images/providers/WWENetwork.png',0,'sport',295),
(1252,'MLB Network','public/images/providers/MLBNetwork.png',0,'sport',4),
(1542,'NHL Network','public/images/providers/NHLNetwork.jpg',0,'sport',4),
(47664,'F1TV','public/images/providers/F1TV.png',0,'sport',11),
(1367,'MotorTrend','public/images/providers/MotorTrend.png',0,'sport',65);



php artisan make:command ImportSportMovies --command=ImportSportMovies:cron
php artisan make:command ImportSportSeries --command=ImportSportSeries:cron


defaultSeasonType

php artisan make:migration add_multiple_column_to_sport_movies
php artisan make:migration add_multiple_column_to_sport_series



CREATE INDEX `search` ON `sport_movies` (id, tvdb_id,name,is_deleted,lastUpdated);
CREATE INDEX `search` ON `sport_series` (id, tvdb_id,name,is_deleted,lastUpdated);


ALTER TABLE `seasons` ADD `last_updated` DATE NULL DEFAULT CURRENT_TIMESTAMP;

php artisan make:migration add_multiple_column_to_seasons