# Free Ads :newspaper:

## Table des Matières

- [Introduction](#introduction)
- [Fonctionnalités](#fonctionnalités)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Utilisation](#utilisation)
- [Auteur](#auteur)

## Introduction

Le projet "FreeAds" est développé en utilisant le langage de programmation PHP et le framework Laravel. Il comprend des fonctionnalités telles que la création et l'affichage d'annonces, un système de recherche d'annonces avec filtres, un système de messagerie entre utilisateurs, et une page d'inscription et de connexion.

## Fonctionnalités

- **Authentification des utilisateurs** : Les utilisateurs peuvent s'inscrire et se connecter en utilisant leur email et mot de passe. Une fois connecté, l'utilisateur est redirigé vers la page de création d'annonce.
- **Création d'annonces** : Les utilisateurs peuvent créer des annonces avec un titre, une description, une photographie et un prix. Les annonces peuvent être modifiées et supprimées par leurs propriétaires.
- **Liste d'annonces** : Les utilisateurs peuvent voir une liste de toutes les annonces.
- **Recherche et filtrage d'annonces** : Les utilisateurs peuvent rechercher des annonces et filtrer les résultats par nom, type de produit, prix, etc.
- **Système de messagerie** : Les utilisateurs peuvent envoyer et recevoir des messages. Le nombre de nouveaux messages reçus est indiqué dans le menu.

## Prérequis

- PHP 7.3 ou supérieur
- Composer
- XAMPP MySQL

## Installation

1. Clonez le dépôt GitHub.

```sh
git clone https://github.com/Github-GIBILARO-Anthony/FreeAds.git
```
2. Installez les dépendances PHP avec Composer
```sh
composer install
```
3. Créez une base de données MySQL en utilisant XAMPP.
4. Configurez votre fichier .env avec vos informations de base de données.
5. Exécutez les migrations pour créer les tables dans votre base de données.
```sh
php artisan migrate
```
6. Lier le stockage locale
```sh
php artisan storage:link
```
## Utilisation 
1. Lancer le serveur
```sh
php artisan serve
```
## Auteur 

👤 **Anthony GIBILARO**

* Site: [Portfolio ](https://www.a-gibilaro.com/)
* GitHub: [@Github-GIBILARO-Anthony](https://github.com/Github-GIBILARO-Anthony)
* LinkedIn: [@Anthony Gibilaro](https://www.linkedin.com/in/anthony-gibilaro/)

