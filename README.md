# webtech-university


#about "Into The Green" Final Term Project(Partial)
content ideas inspired by https://stateofgreen.com/en/

Key Functionalities

**Reporter/News and Researcher/Publication are not implemented here. Only Admin and Solution/Solution Provider are implemented.

User Roles: The system encompasses four distinct user roles: Admin, Solution Provider, Reporter, and Researcher, each with specific privileges and responsibilities.

User Registration and Login: Users can securely create accounts and log in to access their personalized dashboards.

Descriptive Profiles: Except for Admin, users can create and edit detailed profiles, showcasing their expertise and affiliations.

Content Submission: Solution Providers can submit green solutions, Reporters can contribute news articles, and Researchers can share publications, all subject to approval by Admin. Content can be edited later as well but edit will make the content unpublic and send it for admin revision.  

Content Review and Approval: Admins review submissions, either approving them for public view or sending them back for revision with feedback. Approved solutions can again be made unpublic and sent for revision.

Publication of Approved Content: Once approved, green solutions, news articles, and publications are made accessible to the public, contributing to knowledge dissemination.

Content Viewing: Public users can browse and access published solutions, news, and publications, fostering a broader understanding of sustainable practices.

Admin Privileges: Admins possess the authority to delete user accounts, and only they can create additional admin accounts, maintaining control over the platform's integrity.


To Try:

1. Download and install XAMPP(Default Installation recommended)
2. Go to the directory xampp/htdocs and delete all the files there
3. Put Into The Green Folder in xampp/htdocs directory
4. Start XAMPP Control Panel
5. Start Apache and MySQL in XAMPP control panel
6. press admin on MySQL
7. create a new database naming "wt_a" and import the given database(.sql) file(if database named different change the database name in the models/db_connect.php)
8. press admin of apache on xampp control panel(if it doesnt work the port may be being used by other application)
9. Go to Into The Green file and go to index.php
10. Demo-ID-Pass are given in demoIdPass.txt



