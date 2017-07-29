--
--
-- Title:         KikOrNot schema database
--
-- Copyright:     (c) 2016-2017, Pierre-Henry Soria. All Rights Reserved.
-- License:       GNU General Public License <https://www.gnu.org/licenses/gpl-3.0.en.html>
--
--

CREATE TABLE users (
  user_id int(11) NOT NULL AUTO_INCREMENT,
  user_email varchar(175) NOT NULL,
  user_name varchar(175) NOT NULL,
  user_firstname varchar(175) NOT NULL,
  user_lastname varchar(75) NOT NULL,
  user_password varchar(175) NOT NULL,
  user_description varchar(500) NOT NULL,
  user_avatar varchar(175) NOT NULL,
  user_gender tinyint(1) unsigned NOT NULL,
  user_fake tinyint(1) unsigned NOT NULL DEFAULT 0,
  user_uid varchar(75) NOT NULL, -- Unique ID (used for generating reset password token, ..)
  PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE swipe (
  swipe_id int(11) NOT NULL AUTO_INCREMENT,
  swipe_user int(11) NOT NULL,
  swipe_time varchar(18) NOT NULL,
  PRIMARY KEY (swipe_id),
  FOREIGN KEY (swipe_user) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
