
CRAWLER is web crawler for Telugu language sites.
It crawls the URLs supplied by the users, and gathers the Telugu words.
It can also parse user supplied text.
All the words are stored in a database.
Users can search those words in many way.
* contains substring (no length constraints)
* contains in specific order (no length constraints)
* contains in any order (no length constraints)
* contains substring 
* contains in specific order 
* contains in any order 
* start with
* end with



======================================================================
Step for deployment.

1. Fork the repo and clone it to your C:\xampp\htdocs
3. Create a database called "crawler" with utf8mb4_unicode_ci encoding.
4. Import crawler.sql (located in sql folder)
5. Launch your application http://localhost/crawler

5. Use these credentials to login:

	ADMIN  
	username: admin@silcmn.com
	password: 99999

	USER
	username: user1@silcmn.com
	password: 99999

	USER
	username: user2@silcmn.com
	password: 99999

======================================================================
                                                                                                    