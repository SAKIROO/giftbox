# giftbox

Membres du groupe : OZEN Burak, FRANOUX Noé, LAMBERT Valentino


# OZEN Burak
# FRANOUX Noé
# LAMBERT Valentino
# S4 DWM2

## URL du dépôt GitHub
https://github.com/SAKIROO/giftbox.git

## Pour lancer le projet
Lancer docker desktop  
Se mettre dans le répertoire du projet et exécuter la commande:  
docker compose up --build

Lancer la BD :  
http://localhost:8080  
Système : MariaDB  
Serveur : sql.db
Utilisateur : gift  
Mot de passe : gift  
Base de données : giftbox

Importer les données de la BD pour la 1ère fois :  
Copier ce qu'il y a dans /sql/gift.schema.sql et coller dans "Requête SQL" après s'être connecté sur http://localhost:8080  
Exécuter  
Faire de même avec /sql/gift.data.sql

Accéder à l'appli :  
http://localhost:7777

## Liste des fonctionnalités
- [x] 1-Afficher la liste des presations
- [x] 2-Afficher le détail d'une prestation
- [x] 3-Liste des prestations par catégories
- [x] 4-Liste des catégories
- [x] 5-Affichage des coffrets types classés par thèmes
- [x] 6-Affichage d'un coffret type
- [x] 7-Création d'une Box vide
- [x] 8-Création d'une box à partir d'un coffret type
- [x] 9-Ajout de prestations dans la box
- [x] 10-Affiche d'une box
- [x] 11-Validation d'une box
- [ ] 12-Génération de l'URL d'accès
- [ ] 13-Utilisation de l'url : accès au contenu de la box
- [x] 14-Signin
- [ ] 15-Register
- [ ] 16-Accéder à ses box
- [ ] 17-Modification d'une box : suppression de prestations
- [ ] 18-Modification d'une box : modification des quantités
- [ ] 19-Utilisation de l'url : impression du contenu de la box
- [x] 20-API : liste des prestations
- [x] 21-API : liste des catégories
- [x] 22-API : liste des prestations d'une catégorie
- [x] 23-API : accès à une box