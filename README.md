# Cloup-Asset-Management
A functional webpage handling the dummy database data of a fictional company named Cloup.

PHP, SQL, HTML/CSS/JS

Inspired by a student project i had assigned and taken a step further.
Written on PHP and using basic HTML/CSS and minimum JS.

This project focuses mainly in communicating with the database provided (Cloup) by executing various queries.

index.php            ->  a user provides his credentials and logs in

logged_in_page.php   ->  if the login is successfull the user has an overview of ALL Database Data relevant to him
                         if the user has admin rights he has the ability to see and handle ALL data in the DB using the next page
                        
asset_management.php ->  a brief overview of ALL employees and all relevant data of the DB (cars,projects,etc) [admin only]

add_or_change.php    ->  using the forms provided here data can be added/deleted/handled accordingly [admin only]

logout.php           ->  logs the user out by session_unset and redirects in the login page (index.php) for a new user to log
