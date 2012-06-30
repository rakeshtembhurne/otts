ALTER TABLE `questions` CHANGE `answer` `answer` TEXT NOT NULL;

ALTER TABLE `courses` ADD `board_id` INT NULL AFTER `id` ;

ALTER TABLE `tutorials` CHANGE `text` `content` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ;


ALTER TABLE `users` ADD `tnt` BOOLEAN NOT NULL DEFAULT '0' AFTER `pincode` ,
ADD `quiz` BOOLEAN NOT NULL DEFAULT '0' AFTER `tnt`;