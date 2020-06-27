# Database Schema Changelog 

The current schema version is `1.1`. Please be sure to update this file with any changes as you make them.

----

## [1.1] - 2020-06-27 nfreader \<nick@nfreader.net>
Added `ssim_permissions`, with foreign relations to `ssim_users.id`.

```
CREATE TABLE `ssim_permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `flag` int(11) unsigned NOT NULL DEFAULT 0,
  `last_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  CONSTRAINT `ssim_permissions_ibfk_1` FOREIGN KEY (`user`) REFERENCES `ssim_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

```
UPDATE `ssim_sql_version` SET `version_minor` = '1' WHERE `version_major` = '1' AND `version_minor` = '0' AND `date` = '2020-06-24 01:07:08' LIMIT 1;
```

## [1.0] - 2020-06-23 nfreader \<nick@nfreader.net\>

Initial commit of the SQL schema. 

Execute the following SQL queries in the order they appear: 

```
CREATE TABLE `ssim_sql_version` (
  `version_major` int(3) unsigned NOT NULL,
  `version_minor` int(3) unsigned NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

```
CREATE TABLE `ssim_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_ip` int(11) unsigned NOT NULL,
  `activation_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
```

```
INSERT INTO `ssim_sql_version` (`version_major`, `version_minor`, `date`) VALUES ('1', '0', NOW());
```
