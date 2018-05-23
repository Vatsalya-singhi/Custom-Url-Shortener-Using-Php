# Custom-Url-Shortener-Using-Php
Development of custom URL Shortener service using php.
Goal is to make shorter urls that can be easier to memorize.
The repository contains the following files:
 1)index.php - for getting GET request with parameters: 1) longUrl (the actual url), 2) shortName (custom name)
 and store the details after checking for existing values and duplicates.
 This generates a JSON array with result and message encoded.
 2) redirect.php - checks for the actual url from the database and redirects using .htaccess file. The .htaccess file requires some      additional permissions.
 3) dbconfig.php - to estabish connection with the database.
 4) .htaccess - configuration file used by Apache-based web servers that controls the directory and used for redirecting purposes.
 
 
 # Usuage
 Download the files and places it in xampp/htdocs directory under the "shorturl" folder. Grant "777" permission to .htaccess file.
 Open dbconfig.php and set the username,password,tablename and port number values. Open index.php and make changes to $newurl variable which holds the value of the shortened custom generated url.Run Xampp and sending GET request will print a json array with the new url. Your custom url is generated !
