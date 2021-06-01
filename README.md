# Salamate
As part of the preparation for the technical university diploma (equivalent 2 years), I was supposed to do an
end-of-studies internship to make a connection between the theory taught in the university and the practice.
My end-of-studies internship was about creating an Api-based web application that allows the administrators to
manage users, diseases, vaccines, as well as travel notices and global diseases news using a public internal REST API
of the Salamate site, and allows the different users to manage their trips while remaining safe because they will be
notified by the diseases that they have in their destinations in order to take precautions before the trip’s date of
departure and this will be done by completing the recommended vaccines and browsing travel notices.

I divided my tasks for chapters, the first one was devoted for the project presentation and the specifications, The
second chapter, I was interested in the conceptual study and the UML modeling as well as the database structure. The
third chapter was devoted to the presentation of UI / UX Design of the website, the forth chapter for creating the
Salamat-e website API. The fifth and last one goes to creating and coding the web app frontend & backend, finally
hosting the final product.

Think before acting, make plans before building, design first, then develop. This is the process that must be
followed when developing a website and in order to succeed in any project.

To model the functionalities of the application and represent its architecture as well as the interactions between its
various components, I chosed the UML language (Unified Modeling Language) which is a general-purpose,
developmental, modeling language in the field of software engineering that is intended to provide a standard way to
visualize the design of a system. I made different diagrams such as the “class diagram” to construct and visualize
object oriented systems, in addition to that there is the use case diagram which represents the set of use cases of the
web app and a sequence diagram as well as activity diagrams of different layers of the application.

As a code editor I used visual code which is known as a source code editor developed by Microsoft for Windows,
Linux and MacOs. It includes support for debugging Git Integrate control and GitHub. For the Frontend development
I had no choice than using HTML5/CSS3 and Javascript that allows me to recreate the design and prototypes that I
created in Adobe XD.Salamat-e is a beautiful interface that has a great user experience, moreover it is suitable for
mobiles, tablets, PCs etc, I used CSS technologies for the layout ’CSS Grid/Flexbox, keyframes’ and MEDIA
QUERIES for the adaptation of the web app with several devices.

the client side of the web app is rich by JavaScript and regular expressions for inputs validation as well as AJAX and
JSON which helped me to make the “asynchronous processing” will be much simpler, thanks to an easy-to-use API
that works on a multitude of browsers and they have the advantages: decrease latency times, avoid page reloading,
increase the responsiveness of the web application... So Salamat-e website is considered as Rich Internet Applications
(RIA) .

The salamate website is fast and secure because I used the OOP in PHP to create the REST API for the server
side. To interact with the REST API I used the tool Postman which is a collaboration platform for API Development.
And I also used PDO in PHP because it ensures interoperability, which means that it will be easy to migrate to another
DBMS, I just have to change the arguments passing to the constructor. The database was created using the relational
database management system MariaDB 10.4.10 where there are 11 tables.

Concerning hosting the web app I choose LiteSpeed Web Server, why LSWS? It doubles the maximum capacity
of our current Apache server with LSWS's streamlined event-driven architecture, capable of handling thousands of
concurrent clients with minimal memory consumption and CPU usage.

The biggest difference between LSWS and Apache is in the architecture and the way they handle connections.
LSWS is event-based and Apache is process-based. In addition to its ability to handle a higher number of requests per
second, LiteSpeed has also managed to handle huge traffic without increasing resource consumption, thus improving
overall stability. Using the Mobaxterm tool, it provided me with many functions to access my server and manage my
remote work in an easier way, MobaXterm provides all the remote network tools and the most important for me are
FTP (File Transfer Protocol) to transfer my files to the server, and SSH (Secure Script Shell) for secure connection
and communication, remote execution of commands, delivery of software patches and updates, and other
administrative or management tasks.

This project was a trigger to start to take more interest in this field, I do not intend to stop here, but to continue to
develop my skills and to dive more into software and service architectures.

Live website : http://salamati.nadisperformance.com
