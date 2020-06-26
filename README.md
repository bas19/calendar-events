
Install all the dependencies

    composer install
    npm install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000