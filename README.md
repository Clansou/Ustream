<p align="center"><img src="public/img/logo.png" width="400" alt="Laravel Logo"></p>

</br>

Le projet a été réalisé en duo, en utilisant Laravel pour l'affichage de l'API (TMDB) et avec du CSS et Tailwind pour la partie style.
<li>Recherche de films,</li>
<hr>

## Page principale :

<ul>    
    <li>Affichage des films de base, selon leur popularité,</li>
    <li>Affichage selon le nom et leurs notes IMDB,</li>
    <li>Affichage des films selon leurs genres,</li>
    <li>Recherche de films,</li>
    <li>Consultation de la page de film seul</li>
</ul>

<hr>

## Page film :

<ul>    
    <li>Affichage des caractéristiques du film (date, durée, genres),</li>
    <li>Résumé du film,</li>
    <li>Note IMDB,</li>
    <li>Affichage des acteurs,</li>
    <li>Affichage des films similaires et navigation dessus</li>
    <li>Enregistrer des films dans des albums</li>
    <li>Recherche de films</li>
</ul>


<hr>

## Page profil :

<ul>    
    <li>Consulter ses albums privés et publics de films,</li>
    <li>Consulter ses albums partagés,</li>
    <li>Supprimer les films de ses albums,</li>
    <li>Créer des albums privés ou publics,</li>
    <li>Partager des albums avec d'autres utilisateurs (cela envoie une invitation à l'autre),</li>
    <li>Voir tous les utilisateurs existants,</li>
    <li>Voir tous les albums publics des utilisateurs et pouvoir les liker,</li>
    <li>Recevoir des invitations</li>
</ul>

<hr>

## Autres :

<ul>    
    <li>Possibilité de se créer un compte,</li>
    <li>Possibilité de se connecter avec son compte,</li>
    <li>Possibilité de se déconnecter et changer d'utilisateur</li>
</ul>
Footer
© 2023 GitHub, Inc.
Footer navigation
Terms
Privacy

## Étapes

1. Clonez le projet depuis Github.com:

    ```bash
    git clone https://github.com/username/project-name.git
    ```

2. Installez les dépendances du projet:

    ```bash
    composer install
    npm install
    ```

3. Copiez le fichier `.env.example` en `.env` et générez une nouvelle clé pour l'application:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Mettez à jour le fichier `.env` avec les informations de votre base de données:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nom_de_votre_base_de_donnees
    DB_USERNAME=votre_nom_d'utilisateur_de_la_base_de_donnees
    DB_PASSWORD=votre_mot_de_passe_de_la_base_de_donnees
    ```

5. Exécutez les migrations de la base de données:

    ```bash
    php artisan migrate
    ```

6. Lancez l'application:

    ```bash
    php artisan serve
    ```
    vous avez aussi besoin de 
     ```bash
    npm run dev
    ```


L'application sera disponible à l'adresse http://localhost:8000.

Enjoy ;)
