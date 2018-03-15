# units-api
A simple web-service to perform unit conversion to SI unit

This project is developed using lumen micro framework.
https://github.com/laravel/lumen

### Demo ###
https://sukruth-units-api.herokuapp.com/units/si?units=(degree/minute)

### Installation ###

* `git clone https://github.com/sukruthmk/cast.git projectname`
* `cd projectname`
* `composer install`
* Create a database and inform *.env* (remove *.example*)

### Api ###
```
METHOD: GET
PATH: /units/si
PARAMS: units - A unit string*
RETURNS: conversion - A conversion object**
```

### Example Request ###
##### Request #####
```
GET /units/si?units=(degree/minute)
```
##### Reponse #####
```
{
 "unit_name": "(rad/s)",
 "multiplication_factor": .00029088820867
}
```
##### Example parameters #####
`degree , degree/minute , (degree/(minute*hectare)) , ha*°`
