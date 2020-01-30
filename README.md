# ScienceShare - Laravel 6 & Vue.js Web Application
Share scientific articles where users can comment and vote on their own and other users’ posts.

## Features
Shows a list of items in a database. 

Bootstrap framework integrated.

AJAX is used to post comments and votes to items.

Multiple levels of authentication.

Users can only edit items and comments which they themselves posted.

Validation on input data.

Users can upload images which are displayed with their posts.

Furthemore, basic analytics available for posts, such as views, votes and comments.

## Seed & Build

### Seed
`` php artisan migrate:fresh --seed ``

### Build (Webpack)
`` npm run build ``

## Run
`` php artisan serve  ``
