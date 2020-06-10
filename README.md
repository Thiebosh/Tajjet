# MyDaw webApp by Tajjet Team


### Setup de votre environnement

1. Télécharger et installer [WampServeur 3.2](www.wampserver.com/#download-group)

    - Apache version 2.4

    - MySQL version 8.0
    
    - PHP version 7.3

2. Placer le projet dans le dossier www de Wamp (chemin absolu : '\*yourDisc\*:/wamp64/www')

2. Télécharger et installer [Python 3.6](www.python.org/downloads/release/python-368/)

3. Installer les dépendances du projet via la commande : `pip install -r requirements.txt`(automatisation ?)

4. Réaliser les manipulations suivantes pour autoriser l'appel de script Python par le serveur PHP :(à oublier : plus d'actualité)

    - Lancer Wamp et attendre que les trois services soient actifs

    - Opérer un clic gauche sur l'icone de Wamp, à gauche de la barre des tâches
    
    - Cliquer sur 'Apache', puis sur 'httpd.conf' (copier le contenu du fichier dans un fichier backup)
    
    - Ouvrir la barre de recherche (ctrl+f)
    
        - Chercher '<Directory />' : pour 'Require all', remplacer 'denied' par 'granted'
        
        - Chercher 'Options +Indexes +FollowSymLinks +Multiviews' : ajouter à la suite ' +ExecCGI'
        
        - Chercher 'AddHandler cgi-script .cgi' : décommenter la ligne (supprimer le #) et ajouter à la suite ' .py'

    - Fermer le fichier, redémarrer Wamp (clic gauche - redémarrer les services)

    - En cas de problème, réappliquer la configuration intiale, enregistrée dans le fichier backup
    


### Setup du fichier config.json

La configuration du projet s'effectue dans le fichier config.json. Avant lancement du programme, il est conseillé de vérifier les informations contenues dans ce fichier.

* train_recognition_model : si true, le modèle de reconnaissance faciale se réentraîne au lancement du programme
* mtcnn_model_path : chemin d'accès au modèle de détection faciale
* arface_model
  * path : chemin d'accès au modèle de reconnaissance faciale
  * confidence_threshold : seuil à partir duquel le modèle reconnaît un individu
* data
  * dataset_path : chemin d'accès au dataset d'entraînement
  * embedding_path : chemin d'accès au dossier contenant l'embedding généré lors du dernier entraînement
  * unknown_path : chemin d'accès au dossier où seront sauvegardées les photos des personnes inconnues 
  * logs_path : chemin d'accès au dossier contenant les logs

* camera_ip : adresse IP de la caméra utilisée (spécifier 0 si utilisation de la webcam)


### Lancement du programme

1. Lancer Wamp et attendre que les trois services soient actifs

2. A la première utilisation, configurer l'import et le remplissage de la base de données (push : true, fill : true)

3. Dans le navigateur, entrer l'url localhost/\*yourPathBetweenWWWFolderAndTajjetFolder\*/Tajjet/Web-interface
