###Requirements

Docker and docker-compose optionally GNU Make, tested on Mac OS 

###Makefile

For build this api, type on terminal `make dev`. And It's available to http::/localhost:8080.

Import data bases on file `MYSQL_THN.zip`, previously run this on mysql terminal `create database thn;
create database thn_test`;

You can read the make file for make tests (make test-unit, make test-acceptance). It

Thanks for your time!

###Call API examples

####HOTEL: 

http://localhost:8080/hotel/aa441e54-369e-4f8f-98bd-99eb91a57ea4

####BOOKING:

http://localhost:8080/booking

http://localhost:8080/booking/users

