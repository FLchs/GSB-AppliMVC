# GSB-AppliMVC

PPE BTS SIO : Application web de gestion des frais

## Pour commencer

Ces instructions vont vous permettre de lancer en local une copie de cette application pour des raisons de test ou de développement.


### Prérequis

Pour pouvoir exécuter l'application en local avec docker vous devez avoir :

* [git](https://git-scm.com/)


* [docker](https://www.docker.com/)

* [docker-compose](https://docs.docker.com/compose/)

### Installation

Pour lancer l'application en local avec docker :

Commencez par cloner le dépôt

```
git clone git@github.com:FLchs/GSB-AppliAndroid.git
```

Et lancer avec docker-compose

```
docker-compose up
```

Vous pouvez maintenant vous connecter à l'application directement en local : [http://localhost:3000](http://localhost:3000)


    login : dandre
    mot de passe : oppg5


## Developpement

Si vous modifiez le script de la base de données il peut être necessaire de suprimer les données locales de Mysql/Mariadb.  

```
rm ./database/data
```
