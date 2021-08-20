# Requirements

- PHP >= 7.1


# Installation

1. Copy .env.example to .env. and fill the datatbase infomation.

   ``` sh
   cp .env.example .env
   ```

2. Run the Composer command to install the required  package.
   ``` sh
   php composer install
   ```

3. Generator datatbase.

   ```sh
   php artisan migrate
   ```

4. Insert the crontab rule to set schedule.

   ```sh
   * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
   ```


