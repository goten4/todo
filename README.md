## Pré-requis
* Avoir git installé sur son poste
* Avoir meld (ou p4merge)
* Avoir un compte github et sa clé ssh déposée
* Avoir PHP 5.3 (ou plus)
* Avoir SQLite 3

## Premiers pas avec Git
### Initialisation
* Forker le repository
* Ajouter les droits de commit à deux développeurs sur votre repository
* Chaque développeur clone le repository
```bash
 $ git clone git@github.com:mon_nom/todo.git
```
* Mettre à jour composer et récupérer les dépendances
```bash
 $ php composer.phar selfupdate
 $ php composer.phar update
```
* Initialiser la base de données SQLite (avec ant)
```bash
 $ ant initdb
```
* Initialiser la base de données SQLite (sans ant)
```bash
 $ sqlite3 ./application/data/todos.db < ./application/data/schema.sql
 $ chmod ugo+w ./application/data/todos.db
```
* Démarrer l'application
```bash
 $ cd ./public
 $ php -S localhost:1234
```

### Principe
Chaque développeur va implémenter une story de son côté en suivant le workflow
http://nvie.com/posts/a-successful-git-branching-model/
* Créer et pousser la branche develop
```bash
 $ git checkout -b develop
 $ git push -u origin develop
```
* Les autres développeurs récupèrent la nouvelle branche et se positionnent dessus
```bash
 $ git pull
 $ git checkout develop
```

### Story-1 : Editer (Développeur 1)
* Créer une branche `edit`
* Appliquer le patch `patchs/edit.patch`
```bash
 $ patch -p1 < patchs/edit.patch
```
* Commiter
* Faire un rebase sur `develop`
* Pousser le commit sur `origin/develop`

### Story-2 : Supprimer (Développeur 2)
* Créer une branche `delete`
* Appliquer le patch `patchs/delete.patch`
```bash
 $ patch -p1 < patchs/delete.patch
```
* Commiter
* Récupérer la story 1 sur `develop`
* Faire un rebase de `develop` sur `delete`
* Résoudre les conflits
* Terminer le rebase
* Faire un rebase de `delete` sur `develop`
* Pousser le commit sur `origin/develop`

### Story-3 : Trier (Développeur 3)
* Créer une branche `delete`
* Appliquer le patch `patchs/delete.patch`
```bash
 $ patch -p1 < patchs/delete.patch
```
* Commiter
* Récupérer la story 1 sur `develop`
* Faire un rebase de `develop` sur `delete`
* Résoudre les conflits
* Terminer le rebase
* Faire un rebase de `delete` sur `develop`
* Pousser le commit sur `origin/develop`

### Story-4 : Ajout de Twitter bootstrap (Développeur 1)
* Mettre à jour la branche develop
* Créer une branche `bootstrap`
* Appliquer le patch `patchs/bootstrap.patch`
```bash
 $ patch -p1 < patchs/bootstrap.patch
```
* Commiter
* Faire un rebase sur `develop`
* Pousser le commit sur `origin/develop`
