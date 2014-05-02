Teem
=========

A project for Rensselaer Polytechnic Institute's ITWS 4200: Web Science Course. 


Teem was created with love by Alex Kumbar, Lauren Angelini, Josh McGraw, Chris Paradis, Candice Poon, & Hayley Schluter. 
=======

Setup:
------

Database aretechure is saved in a file inside of database.
This application runs on a apache stack. Tested a [Host Rocket](http://www.hostrocket.com/) domain.

=========

### General description:
	Teem is a mobile-responsive web application that will increase productivity for meetings and improve any group’s organization.


### Mission: 
	To make it incredibly easy for any group of people to schedule and manage agendas for their meetings.

### Vision: 
	To translate the efficiency of static agendas to the web, to make meetings easier to facilitate for everyone. 

### Stakeholders:
	College Students
	Professionals
	Sports/Recreational 
	Teams
	Groups that rely on 
	meetings to communicate 
	Any group that wants to get together

### Overview: 
	Our project Teem makes meetings more productive through an interactive meeting agenda that will allow members to adjust their own material and look at other’s materials during meetings. 

### Features:
	Personal accounts
	Unique groups for different meetings
	Customizable meeting agenda
	Easily share documents and files during meetings

### Technologies used:
	HTML5
	PHP
	CSS3
	JavaScript
	Foundation 5
	jQuery
	MySQL

### Future plans:
	To actually schedule meetings (via Google Calendar API)
	Account integration (Facebook, Google, LinkedIn).
	Focusing on providing tools that keep meetings productive.
	Added data security, more error checking

=========

Main Project Area:
----------------
Groups
Creating a Group
A group can be created via a link in the profile page by clicking one the group name. A popup window will appear and if no members are specified the owner will be the only member of the group. The name of the group is inserted into a table called “groups” along with a groupid which is auto incremented upon insertion. At the same time, group members are inserted into a table called “groupMembers,” in which users’ ids are paired with a group id and whether or not they are considered an “owner” of that group.
Adding members to a group
Members can be added during the creation of the group.
 
Editing a group
Once on the editgroup.php page, you can change the name, add a group member, and delete members. Only one member can be an “owner” of the group, and only the owner can edit the group. You can also delete the entire group, which will remove all the data from the groups and groupMembers tables associated with that group_id.
 
Meetings
Creating a meeting
A meeting is also created from the profile page. The data from the title, desired outcome, location, date, and time are all added to the meetings table. The array of attendees entered are all added to the meetingmembers table. The user can input both groups and specific users into this field. If a group is added all members in the group will be added to the meetingmembers table, and individual users are added all the same. The input is sanitized for each field.
Adding meeting items
Items are added to the meeting and assigned to someone. This person can then edit topics and associated files for that meeting item. 
Action Items
Action items give meeting members an indication of what people should accomplish before the next meeting.
File sharing
 
 
User Profile
Created Groups
All of the groups the user is a part of is displayed on the left hand side of the screen. If the user is the owner he/she can click on the group and be brought to the edit group page. Otherwise, static text is displayed.
Created Meetings
All the meetings the user is a part of are displayed here. Clicking on the title of the meeting will bring you to the agenda page of that meeting. The tasks listed for this section can be accomplished here.
User Settings
 
User Information

All of the user’s information can be edited here and the results are saved to the user table. Deleting the account associated with this user is also an option, and the user will be brought back to the index page.


Personal statements:
-------------------

Hayley:
	I very much enjoyed working with such a diverse, skilled group of like-minded people. I was going to give special thanks to specific team members, but then I realized I'd be thanking every single one of you. Thank you all for listening to my ideas, solving the problems I caused, and making me feel like a welcome and important member of the group. I think we've really made something special that could only come about through this kind of open collaboration and I'm so glad to have played a role in creating it.

Candice:
	This is my first group project working with the people the same year as me in ITWS and I am so glad I did. These people are kind, patient, and hard-working. It has been a wonderful experience to learn more about PHP, Foundation, etc., and how to program with some really talented people. I am genuinely proud of what we accomplished and what we created over the semester.

Lauren:
	This is honestly one of the best teams I have ever worked on. Besides getting bullied by Chris and Candice occassionaly (jokingly of course... i think), we got along great the entire project. We fought through endless merge conflicts, fatal errors, styling issues and tears while trying to fix everything we broke to create a pretty cool application. Everyone contributed what they were assigned to do and we had no issues with people not attending meetings or communicating. I learned a lot about Foundation, CSS, HTML etc. and even refined my skills a little in PHP.I will miss all my teammates and it's been an absolute privelage to be part of Team Snapchat-Roulette <3 

Chris: 
	Great group with a very interesting dynamic. Despite the appearance of conflict on the surface, this group worked very well together. I would say better than any group I have been a part of. I have never really had meetings where both the back-end, front-end, and really all involve truly work together on pages and use each others skill set. Most importantly we ended up with a fully functional final product that looks great. Good stuff guys.

Josh:
	"Coming Soon"
	

=========

(c) Team Snapchat-Roulette
