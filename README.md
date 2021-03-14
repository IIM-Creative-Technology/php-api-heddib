## Pour démarrer le projet

Pour démarrer le projet, il faut copier le fichier `.env.example` en `.env` et le modifier.<br/>

Ensuite, il faut faire ses commandes :

```
php artisan migrate
php artisan db:seed
php artisan jwt:secret
```

Puis on lance le serveur :)

```
php artisan serve
```

## Se connecter à un compte administrateur

Afin de vous connecter à un compte administrateur [Karine, Nicolas, Alexis], veuillez réaliser une requête POST sur l'url (à adapter si le projet n'est pas hébergé localement)

```
http://127.0.0.1:8000/api/auth/login
```

Les identifiants sont :

|       email       | password |
| :---------------: | :------: |
| karine@gmail.com  | password |
| nicolas@gmail.com | password |
| alexis@gmail.com  | password |

## Routes

Toutes les routes ci-dessous sont uniquement accessibles aux administrateurs connectés. Veuillez ajouter le token obtenu lors de la connexion en tant que `Bearer Token` avec chaque requête.

### Liste des routes disponibles

#### Etudiant

-   `fristname` : String
-   `lastname` : String
-   `age` : Integer
-   `arrival_year` : Integer
-   `promotion_id` : Integer

```
GET http://127.0.0.1:8000/api/students
GET http://127.0.0.1:8000/api/students/{id}
POST http://127.0.0.1:8000/api/students
PUT http://127.0.0.1:8000/api/students/{id}
DELETE http://127.0.0.1:8000/api/students/{id}
```

#### Promotion

-   `name` : String
-   `end_year` : Integer

```
GET http://127.0.0.1:8000/api/promotions
GET http://127.0.0.1:8000/api/promotions/{id}
POST http://127.0.0.1:8000/api/promotions
PUT http://127.0.0.1:8000/api/promotions/{id}
DELETE http://127.0.0.1:8000/api/promotions/{id}
```

#### Professeur

-   `firstname` : String
-   `lastname` : String
-   `arrival_year` : Integer

```
GET http://127.0.0.1:8000/api/intervenants
GET http://127.0.0.1:8000/api/intervenants/{id}
POST http://127.0.0.1:8000/api/intervenants
PUT http://127.0.0.1:8000/api/intervenants/{id}
DELETE http://127.0.0.1:8000/api/intervenants/{id}
```

#### courses

-   `name` : String
-   `start_date` : Date (Y-m-d)
-   `end_date` : Date (Y-m-d)
-   `intervenant_id` : Integer
-   `promotion_id` : Integer

```
GET http://127.0.0.1:8000/api/courses
GET http://127.0.0.1:8000/api/courses/{id}
POST http://127.0.0.1:8000/api/courses
PUT http://127.0.0.1:8000/api/courses/{id}
DELETE http://127.0.0.1:8000/api/courses/{id}
```

#### Notes

-   `value` : Integer
-   `student_id` : Integer
-   `course_id` : Integer

```
GET http://127.0.0.1:8000/api/notes
GET http://127.0.0.1:8000/api/notes/{id}
POST http://127.0.0.1:8000/api/notes
PUT http://127.0.0.1:8000/api/notes/{id}
DELETE http://127.0.0.1:8000/api/notes/{id}
```
