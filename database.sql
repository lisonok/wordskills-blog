CREATE TABLE IF NOT EXISTS `posts` (
    `post_id` int(11) NOT NULL,
    `parent_post_id` int(11) NOT NULL,
    `post` varchar(200) NOT NULL,
    `post_title` varchar(40) NOT NULL,
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE
    `posts`
ADD
    PRIMARY KEY (`post_id`);

ALTER TABLE
    `posts`
MODIFY
    `post_id` int(11) NOT NULL AUTO_INCREMENT;