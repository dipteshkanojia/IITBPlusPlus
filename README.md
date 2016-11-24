# IITBPlusPlus

IF YOU USE THIS CODE, PLEASE DO ACKNOWLEDGE. THANKS! :)

Project Title: Social Network for Faculty-Student Interaction
Name of Our Social Network: IITBPlus+ Community

Students:

154054002 Diptesh Kanojia
154050011 Manasi Kulkarni

========================================================================
FILE-INDEX:
-----------------------------------------------------------------------
Sr No		File-Name				Purpose
-----------------------------------------------------------------------
 1.			index.php				For User login: If registered user (checks by calling login() from class.user.php), will take him(her) to home.php that is home page for user
									If not registered user then, Sign-up: which will take to signup.php for entering new user details
									The link Lost user will take to fpass.php to specify and change as user has forgotten the password

-------------------------------------------------------------------------------------------------------------------------------
2.			home.php				Shows list of all courses that user has registered for. It will redirect user to showCourse.php on cliking on one of the courses

--------------------------------------------------------------------------------------------------------------------------------
3.			signup.php				Aceepts details from user like name,rollno, username, institue, password, emailId and checks if exists,
									if not then will send email to given emailid for verification and confirm on user clicking given link to verify.php
									we have used md5() to encode password to acieve security.

--------------------------------------------------------------------------------------------------------------------------------------
4.			verify.php				It checks for id, code and status received on user-confirmation, if matching then will register user with said status(1:students, 8:instructor)
									and will take to signin page. If already registered or not authentic access then shows error message.

--------------------------------------------------------------------------------------------------------------------------------------------
5.			fpass.php				Accepts emailId from user and crosschecks it with database, sends email to the said emailId for resetting password and messgae is shown accordingly.

-----------------------------------------------------------------------------------------------------------------------------------------------
6.			resetpass.php			Checks with id and code sent from reset-link, if valid user then shows form to change to new password. On changeing password takes user to login page (index.php)

------------------------------------------------------------------------------------------------------------------------------------------------
7.			showCourse.php			To show the homepage of selected course. Displays leftsidebar for communication threads. Facilitates creation of threads and posts,
									and viewing discussion of selected course for any of the thraeds that is all posts of that thread. Allows to reply to specific posts.
									Asynchronous Java Script queries are used to send data across other php files and receive response for the same.
									On clicking 'Drop course', user will be out of that course and wont be able to participate for that course.  

--------------------------------------------------------------------------------------------------------------------------------------------------
8.			getPostData.php			Gets the thread-Id sent from showCourse.php and finds all the posts recursively which belong to this communication thread. It responds to showCourse.php
									with message-reply hierarchy display.

--------------------------------------------------------------------------------------------------------------------------------------------------
9.			newPost.php				Accepts Course-ID sent from showCourse.php. It creates a form for entering details for the new post. Once details enetered it sends data to createPOst.php for further processing.

---------------------------------------------------------------------------------------------------------------------------------------------------
10.			createPost.php			It receives data from newPost.php, it chacks whether it is new post or reply to any post. If new post, it will create new thread of communication, new post
									and will set to replyTo attribute as 0 to identify root post of that thread. If it is reply, it will add entry only in tbl_post with replyTo = postId to which it is a reply.
									It allows to add attachment, checks for attachment constraints and renames it as <postId+filename> and stores in uploads folder. On succes, shows post created
									and takes to discussion forum. It makes entries in post table and thread Table(if needed).

---------------------------------------------------------------------------------------------------------------------------------------------------									
11.			dropCourse.php			To remove course from courselist of the user.

---------------------------------------------------------------------------------------------------------------------------------------------------
12.			runningCourse.php		To enroll for new course. It allows student to select one of the courses from courselist. Shows details of selected course using courseInfo.php.
									Enroll student on click by calling courseEnroll.php. Once enrolled user can course in his courselist. It uses AJAX queries to do the same.
---------------------------------------------------------------------------------------------------------------------------------------------------
13.			courseInfo.php			It accepts courseId from runningCourse.php and finds information like CourseId, name, slot, Intsructor's name, Description and semester
									from The course table and show to the user.

----------------------------------------------------------------------------------------------------------------------------------------------------
14.			courseEnroll.php		It collects courseId, userId and userstatus from runningCourse.php and makes new entry in class_allocation table.

----------------------------------------------------------------------------------------------------------------------------------------------------
15.			addCourse.php			It allows user who is instructor, to add new course in the system. It accepts new course details and sends it to runAddCourse.php for further processing.

----------------------------------------------------------------------------------------------------------------------------------------------------
16.			runAddCourse.php		It adds entry into the course table and will enroll instroctor by default for this course, that is entry is made in class allocation table.

-----------------------------------------------------------------------------------------------------------------------------------------------------
17.			scheduleMeet.php		It displays form for accepting data for meeting request by student/instructor to Instructor. It performs AJAX call for meetRequest.php for further processing.
									It also deisplays list of all approved and pedning reuests by user.

------------------------------------------------------------------------------------------------------------------------------------------------------
18.			meetRequest.php			It collects data from scheduleMeet.php and make an entry in schedule_meeting table with the same and intimates user accordingly.

------------------------------------------------------------------------------------------------------------------------------------------------------
19. 		meetResult.php			It recieves faculty decisions about meeting requetsts and updates the schedule_meeting table rows accordingly (1: approved, -1: reject, 2: postponed)

------------------------------------------------------------------------------------------------------------------------------------------------------
20.			userSettings.php		It allows user to change certain details of himself(herself)

------------------------------------------------------------------------------------------------------------------------------------------------------
21.			logout.php				It logs out current user (by calling logout() defined in class.user.php) and displays the index.php with login window.

------------------------------------------------------------------------------------------------------------------------------------------------------
22.			dbcongig.php			Important file as it creates object for databse connection

------------------------------------------------------------------------------------------------------------------------------------------------------
23.			class.user.php			class USER is defined with following functinalities to be used by every php file for every user logged in.
									register(): To register new user on signup
									login():	To check login credentials of user and allow to start the user session.
									is_logged_in(): To check whether user already logged in or not.
									redirect(): to redirect user to mentioned url.
									logout(): To log out from session.
									runQuery(): To prepare query and check against sql injection.
									lasdID(): To find ID of last user created.


------------------------------------------------------------------------------------------------------------------------------------------------------
24.			leftSidebar.php			To display registered courses vertically on left of the page to user everytime until he logs out.

------------------------------------------------------------------------------------------------------------------------------------------------------
25.			navbar.php				Navigation bar for moving across variou pages of the system. Based on file name function from php, it highlights the navbar option which is the current displayed page.

------------------------------------------------------------------------------------------------------------------------------------------------------
26.			assets					Folder conatining background images and custom written javascripts

------------------------------------------------------------------------------------------------------------------------------------------------------
27.			bootstrap				Contains all the libraries even other than bootstrap in the respective css and js folders

------------------------------------------------------------------------------------------------------------------------------------------------------
28.			includes				contains phpmailer libraries for sending mails through php and apache mail server stack

------------------------------------------------------------------------------------------------------------------------------------------------------
29.			mailer					contains phpmailer classes

------------------------------------------------------------------------------------------------------------------------------------------------------
30.			uploads					contains all files uploaded with posts.

------------------------------------------------------------------------------------------------------------------------------------------------------
31. 		iitbplusplus database	It contains tables to hold information: tbl_course, tbl_user, tbl_class_allocation, tbl_post, tbl_thread, tbl_schedule_meeting.

------------------------------------------------------------------------------------------------------------------------------------------------------
=======================================================================================================================================================
INSTALL
=======================================================================================================================================================

Our project requires a LAMP (Linux, Apache, MySQL, and PHP Server stack to be hosted. It uses PHP over Apache server as the front end, and MySQL as the
back-end. Our database is based on MySQL, and the whole collation is set to 'utf8_general_ci' which allows for the database to store Indian Language
content. Our database already has Indian language content, and shows it out on the front-end to prove it.

For Installation on Ubuntu, follow,

https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu

After the LAMP stack has been installed using step by step info above, in your system go to the directory where web-server is hosted.
(usually /var/www/html)

1. Copy our folder 'softlabproject' in html folder.
2. Browse the folder to locate 'iitbplus.sql' file. This is the database dump of our DB.
3. Use the command:

mysql -u<your_username> -p -e "CREATE DATABASE iitbplusplus"

4. Use the command:

mysql -u<your_username> -p iitbplusplus < iitbplus.sql

5. Go to a web browser, and enter url

http://localhost/softlabproject

6. You can now start browsing the interface.

=======================================================================================================================================================
RUN
=======================================================================================================================================================

For using the project, Since it is a discussion forum we would prefer you start using the the forum by signing up for it.

Go through the steps above to install and host it on a server. Go to the project URL, and sign up for an account

IITBPlus+ would send you an email over your registered mail account to activate the account. Click on the link.

Now, Login to the server after activation of your ID.

Try enrolling for a course, and tell your friends to do the same, this would facilitate discussion and you would be able to discuss topic wise (thread-wise), and
heirarchically speaking post-wise as well.

You can upload files of upto 100 MB on the server, and download them anytime by accessing the post.

You should be able to "Schedule Meeting (Request)", using the Meeting tab above, with a faculty member is they join the forum. The meeting section in their
login session would get updated, and they would be able to "approve", "reject" or "postpone" the meeting as per their wish.

You should be able to browse through the posts, and also post anonymously.

We also provide you an Android app for our project to browse our system.
