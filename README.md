## Introduction:

TUNbooking is a user-friendly web application that allows users to explore hotel chains and their associated hotels, while discovering the various rooms available for booking or direct rental. In addition to the user interface, we have developed an administration panel for managers, enabling them to manage and make changes to the details of the user interface. This administration panel offers managers the ability to modify, add and delete various elements of the user interface with ease

## Global architecture :

### Frontend :
The frontend of our e-hotel application is primarily developed in HTML, CSS and JavaScript. We also use libraries and frameworks such as Bootstrap for design and jQuery for easy handling of AJAX calls. Our application comprises several pages, such as the Home page, which will contain the chains, Hotel, which will give access to the different hotels, contact-us etc...

### Backend :
Our application's backend is developed in PHP and uses sessions to manage user authentication and store reservation data. We use custom PHP functions to interact with the database and perform operations such as inserting, updating and retrieving data. Our application also uses AJAX to communicate with the server and update information on screen without needing to reload the page.

### Database :
We use MySQL as our database management system (DBMS) to store information for our application. Several tables have been designed to organize our data, including tables for hotel chains, individual hotels and rooms. Foreign keys are used to maintain data integrity and establish relationships between tables, while triggers are used to automatically update certain information, such as the date of changes to the number of hotels or rooms in a chain after a new hotel has been added. To facilitate the development and management of our database, we use tools such as phpMyAdmin and XAMPP.

### Communication between components :
Communication between the various components of our system is ensured by standardized mechanisms to guarantee fluid and secure information exchange. The frontend communicates with the backend by sending HTTP requests. These requests can be GET, POST or DELETE methods, depending on the desired action, such as retrieving, creating, modifying or deleting data. The backend, developed in PHP, receives these HTTP requests and processes the information supplied by the frontend. It then interacts with the MySQL database to retrieve, store or modify the required data. To do this, it uses SQL queries adapted to the action requested, such as SELECT, INSERT, UPDATE or DELETE. Once the backend has performed the necessary operations on the database, it returns the results in the form of an HTTP response to the frontend. These responses can be structured in various formats, such as JSON or XML, which are easily understood by the frontend. The frontend then processes this data and displays it to the user in an appropriate manner. Finally, communication between the components of our system relies on the exchange of HTTP requests and responses between the frontend and the backend, as well as interaction between the backend and the database to manage application data.

## Conclusion
To conclude, our TUNbooking system is a complete solution for managing and booking hotel chains and individual hotels. Through our website, a user will be able to create an account, consult hotels, make reservations and even pay and finalize them.

---------------------------------------------

## Introduction :
TUNbooking est une application web conviviale qui permet aux utilisateurs d'explorer des chaînes hôtelières et leurs hôtels associés, tout en découvrant les différentes chambres disponibles pour réservation ou location directe. En plus de l'interface utilisateur, nous avons développé un panneau d'administration destiné aux managers, qui leur permet de gérer et d'apporter des modifications aux détails de l'interface utilisateur. Ce panneau d'administration offre aux managers la possibilité de modifier, ajouter et supprimer divers éléments de l'interface utilisateur en toute simplicité

## Architecture globale :
### Frontend :
Le frontend de notre application e-hôtel est principalement développé en HTML, CSS et JavaScript. Nous utilisons également des bibliothèques et des frameworks tels que Bootstrap pour le design et jQuery pour faciliter la manipulation des appels AJAX. Notre application comprend plusieurs pages, comme la page d’accueil (Home) qui contiendra les chaines, Hotel qui va donnera accès aux différents hotels , contact-us etc..

### Backend :
Le backend de notre application est développé en PHP et utilise des sessions pour gérer l'authentification des utilisateurs et conserver les données de réservation. Nous utilisons des fonctions PHP personnalisées pour interagir avec la base de données et effectuer des opérations telles que l'insertion, la mise à jour et la récupération de données. Notre application utilise également AJAX pour communiquer avec le serveur et mettre à jour les informations à l'écran sans avoir besoin de recharger la page.

### Base de données :
Nous utilisons MySQL comme système de gestion de base de données (SGBD) pour stocker les informations de notre application. Plusieurs tables ont été conçues pour organiser nos données, y compris des tables pour les chaînes d'hôtels, les hôtels individuels et les chambres. Des clés étrangères sont utilisées pour maintenir l'intégrité des données et établir des relations entre les tables, tandis que des triggers permettent de mettre à jour automatiquement certaines informations, comme la date des modifications apportés à l’hôtel ou à la chambre nombre d'hôtels d'une chaîne après l'ajout d'un nouvel hôtel. Pour faciliter le développement et la gestion de notre base de données, nous utilisons des outils tels que phpMyAdmin et XAMPP.

### Communication entre les composantes :
La communication entre les différentes composantes de notre système est assurée par des mécanismes standardisés pour garantir un échange d'informations fluide et sécurisé. Le frontend communique avec le backend en envoyant des requêtes HTTP. Ces requêtes peuvent être des méthodes GET, POST ou DELETE, en fonction de l'action souhaitée, comme récupérer, créer, modifier ou supprimer des données. Le backend, développé en PHP, reçoit ces requêtes HTTP et traite les informations fournies par le frontend. Il interagit ensuite avec la base de données MySQL pour récupérer, stocker ou modifier les données requises. Pour cela, il utilise des requêtes SQL adaptées à l'action demandée, telles que SELECT, INSERT, UPDATE ou DELETE. Une fois que le backend a effectué les opérations nécessaires sur la base de données, il renvoie les résultats sous forme de réponse HTTP au frontend. Ces réponses peuvent être structurées sous divers formats, tels que JSON ou XML, qui sont facilement compréhensibles par le frontend. Le frontend traite alors ces données et les affiche à l'utilisateur de manière appropriée. Pour finir, la communication entre les composantes de notre système repose sur l'échange de requêtes HTTP et de réponses entre le frontend et le backend, ainsi que sur l'interaction entre le backend et la base de données pour gérer les données de l'application.

## Conclusion
Pour conclure, notre système TUNbooking est une solution complète pour la gestion et la réservation de chaînes hôtelières et d'hôtels individuels. Grâce à note site web un utilisateur sera en mesure de créer un compte, consulter des hôtels faire des réservations et même payer et la finaliser.
