# README - WebAppGestionRepas

Ce fichier README contient les instructions pour l'installation de l'application web "WebAppGestionRepas" utilisée pour la gestion des repas en lien avec les commissions et le budget.

## Manuel d'Installation

Veuillez suivre les étapes ci-dessous dans l'ordre spécifié pour éviter les erreurs de clés étrangères.

### 1) Cloner le repository GitHub

Clonez le repository GitHub en utilisant la commande suivante :

```
git clone https://github.com/TimotheeRapin/WebAppGestionRepas.git
```

### 2) Connexion à distance à la base de données

Connectez-vous à distance à la base de données. Veuillez vous référer à la Figure 1 pour plus de détails sur les connexions MySQL.

![Figure 1: MySQL Connections](https://github.com/TimotheeRapin/WebAppGestionRepas/tree/main/Documentation/02%20Rapport%20de%20projet/01%20Installation/MySQL%20Connections.png)

### 3) Création de la base de données

Créez la base de données en exécutant le script suivant :

```
\WebAppGestionRepas\Documentation\07 BDD\03 Scripts\01_createDB.sql
```

### 4) Ajout des données

Ajoutez des données à la base de données en utilisant les scripts suivants :

```
\WebAppGestionRepas\Documentation\07 BDD\03 Scripts\02_script.sql
\WebAppGestionRepas\Documentation\07 BDD\03 Scripts\03_script.sql
\WebAppGestionRepas\Documentation\07 BDD\03 Scripts\04_script.sql
\WebAppGestionRepas\Documentation\07 BDD\03 Scripts\05_script.sql
\WebAppGestionRepas\Documentation\07 BDD\03 Scripts\06_script.sql
```

<span style="color:red">
/!\ Il est important de les exécuter dans l'ordre pour éviter les erreurs de clés étrangères.
</span>

### 5) Connexion au serveur FTP

Connectez-vous au serveur FTP. Veuillez vous référer à la Figure 2 pour plus de détails sur la connexion à FileZilla.

![Figure 2: FileZilla Connection](https://github.com/TimotheeRapin/WebAppGestionRepas/tree/main/Documentation/02%20Rapport%20de%20projet/01%20Installation/FileZilla%20Connection.png)

### 6) Ajout du contenu du dossier

Ajoutez le contenu du dossier suivant, à l'exception du fichier `.idea`, sur le serveur FTP :

```
\WebAppGestionRepas\Code\
```

### 7) Vérification de l'installation

Vérifiez que l'installation s'est déroulée avec succès en accédant au site web suivant :

[https://gesrep.mycpnv.ch/](https://gesrep.mycpnv.ch/)

---

Ces instructions devraient vous guider tout au long du processus d'installation de l'application web "WebAppGestionRepas". Si vous rencontrez des problèmes, veuillez vous référer à la documentation ou contacter l'équipe de support.