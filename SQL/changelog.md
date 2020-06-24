# Database Schema Changelog 

The current schema version is `1.0`. Please be sure to update this file with any changes as you make them.

----

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
