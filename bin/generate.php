<?php

require_once __DIR__.'/../vendor/autoload.php';

$jane = \Joli\Jane\Jane::build();
$jane->generate(__DIR__ . '/../swagger-spec.json', 'Swagger', 'Joli\\Jane\\Swagger', __DIR__ . '/../generated');
