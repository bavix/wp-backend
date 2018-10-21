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

Для работы необходимо сгенерировать ключи passport
```
./artisan passport:keys
./artisan passport:client --password
./artisan passport:client --personal
```

```
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZlMmMzODU1OGE2OWI2MzYzY2ZmNDg4MzQ2NGUyZGNjMzRiYmEwNjIyZjIxYzNiOTA1ZGRlOTQxZWVlY2EyZTU5NDM5MTNhZDVhNDg5NWVjIn0.eyJhdWQiOiIxIiwianRpIjoiNmUyYzM4NTU4YTY5YjYzNjNjZmY0ODgzNDY0ZTJkY2MzNGJiYTA2MjJmMjFjM2I5MDVkZGU5NDFlZWVjYTJlNTk0MzkxM2FkNWE0ODk1ZWMiLCJpYXQiOjE1Mjg1NzA5ODgsIm5iZiI6MTUyODU3MDk4OCwiZXhwIjoxNTMzNzU0OTg4LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.t__ER1fYzRwcH4mop2VBKGgj-8Kj1GKY9LHrWpyHNvzlWKdbR4ff0n4nSfilq40TpVHZo00fDrF2vKIiPpoyR4blc4tACNCrzKqT2w3cLMjEgXSipGTZEoVfy7nlELxnNvbvaOxmGoI2ZowNBFD6Xei7Lw8O05lGYaXe3xxFHNEaUqt3nlaZUb7C0HaVKHZ6gYzYaY7D_82xlBe6uKSTJwNkog3qKhL4aEuYkHOUHvgnZvhogSUhRmardAVKMKu52ga9kmeP5rmYMFWrfUpdcQTb0RQxxtnlmIyp5pQeDPx44Qs7JQqQqOzRtkacUY3JXuOZdxf0wode4VxH2s1W-dUVYbN4cI19WZuYsv1brZY6QOc6-0Sh-kuq6tGSzy3e9K2ibxo34wRp084ddBxoZID-jRTy_pSfJMw9-9GLoRDzXkCzN-yMhHseO6Y7SnCnlnbGVoKN0usXdH4tlFyTqCKhGXB41D2PK1BuFG0wjJu_HXlinfs3tM0ZLmxKuNfJQZPjXW-UxMDqjZrYKk05BOEooI1IyW2AISh9HTwQH_O3huzG6sc6Fa5ni2qwP_KApaVTFKZBMygPLFt3AKAz4IJuH8AQ4CbbnZP_lv-VjXaQgBD678tkm5mUNJ7GtRMM65hp22Hv6zvCXOHpL4VlpXjTmNXJGyiiIVu-v3NVcxw
```

## RabbitMQ

Management RabbitMQ доступен по адресу [http://172.16.239.7:15672](http://172.16.239.7:15672)
