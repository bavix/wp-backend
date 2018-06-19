# laravel-docker
This project contains docker settings for quick start of laravel project.

### init

The folder `enviroment/mysql/sql` is used for quick recovery of databases. Just put the sql file in a folder and it will automatically apply to the database.
MySQL user needs to give access to the database. The access file must be applied last.
```sql
CREATE DATABASE IF NOT EXISTS `YouDatabase`;
GRANT ALL ON `YouDatabase`.* TO 'user'@'%';
FLUSH PRIVILEGES;
```

### install
```bash
docker-compose up -d
```

### docker start
```bash
docker-compose start
```

### docker stop
```bash
docker-compose start
```
