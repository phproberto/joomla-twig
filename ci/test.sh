#!/bin/bash
./vendor/bin/phpcs --standard="ruleset.xml"
./vendor/bin/phpunit --configuration ci/phpunit.ci.xml
