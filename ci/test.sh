#!/bin/bash
./vendor/bin/phpcs
./vendor/bin/phpunit --configuration ci/phpunit.ci.xml
