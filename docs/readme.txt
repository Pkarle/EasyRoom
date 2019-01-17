Le but de notre projet était de créer une application web en PHP en utilisant le framework Symfony. Nous avons environ 3 jours pour ce projet, il a donc fallu prendre des décisions afin d’avoir un développement rapide sur les fonctions principales et les plus importantes.

Nous avons commencé par développer le système de création de comptes et de connexion afin d’avoir une gestion des rôles qui nous permet de gérer les autorisations.

Nous avons décidé de donner de gérer les droits des internautes de cette façon :
- Tous les visiteurs peuvent voir les propositions.
- Lorsque qu’un visiteur créer un compte, son compte passe en tant qu’utilisateur.
- Lorsque qu’un utilisateur créer un bien, son compte passe en tant que propriétaire.

**** Visiteur :
    Voir les propositions (/)

**** Utilisateur :
    Voir les propositions (/)
    Demander réservation pour une proposition
    Créer un bien (/property/create)

**** Propriétaire :
    Voir les propositions (/)
    Demander réservation pour une proposition
    Créer un bien (/property/create)
    Voir ses biens (/properties/user)
    Créer une proposition

Pour ce qui est de la partie esthétique, nous avons utilisé Bootstrap car nous avons quelques soucis avec Materialize.

Pour sauvegarder notre projet et gérer les différentes versions, nous utilisons un outil de versionning nommé Git (également GitHub) qui permet de travailler facilement sur un même projet.

Fonctionnalités effectuées : 
Création d’un compte
Connexion avec un compte
Créer un bien
Voir tous les biens
Voir ses propres biens
Voir le détail d’un bien

Fonctionnalités restantes :
Barre de recherche
Créer une disponibilité pour un bien (avec date de début, date de fin et prix)
Pouvoir indiquer les équipements disponibles pour chaque bien


Partage du travail : 
Philippe:
Ajout de Bootstrap
Création du système de création de compte
Création du système de connexion
Création de la page détail pour un bien
Création de la page des biens
Modification de la page d’accueil
Création de l’API

Benjamin:
Création des entity et génération des controller
Création des relations
Création du formulaire de création de bien
Création de la page des biens du propriétaire connecté
Modification du menu
Génération de l’application Ionic
