#!/bin/bash

# Clone current joomla & install composer there
git clone https://github.com/joomla/joomla-cms.git /tmp/joomla-cms
composer install -d /tmp/joomla-cms

# Install joomla-twig testing composer dependencies
composer install --prefer-dist --no-interaction --no-progress

# Install joomla-twig library composer dependencies
composer install -d ./extensions/libraries/twig

# Copy CI gulp config (with cloned joomla path) to the build folder
cp ./ci/gulp-config.ci.json ./build/gulp-config.json

# Install npm packages in the build folder
cd ./build
npm install -g gulp 
npm install

# Copy joomla extensions to the cloned joomla site
gulp copy 
cd ..
