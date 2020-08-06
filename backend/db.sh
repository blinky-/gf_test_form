#!/bin/bash

docker-compose exec -u postgres fg-test_pgsql psql postgres
