run:
	docker-compose up -d

stop:
	docker-compose stop

restart:
	docker-compose stop
	#docker-compose build
	docker-compose up -d

exec:
	docker-compose exec php bash

benchmark:
	docker-compose exec php ab -n 10000 -q http://localhost/ | tee tmp.txt
	docker-compose exec php diff results.txt tmp.txt
	docker-compose exec php rm tmp.txt

benchmark-update:
	docker-compose exec php ab -n 10000 -q http://localhost/ | tee results.txt
