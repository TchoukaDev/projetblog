tinymce.init({
  selector: ".tiny", // Cibler la textarea avec l'ID "myTextarea"
  plugins: "image", // Activer le plugin pour les images
  toolbar: "undo redo | bold italic | alignleft aligncenter alignright | image", // Personnaliser la barre d'outils
  images_upload_url: "upload",

  // Taille maximale acceptable (en octets)
  images_upload_max_filesize: "5mb",

  // Types d'images acceptés
  images_upload_allowed_file_types: "jpg,jpeg,png,gif",

  images_upload_handler: function (blobInfo, progress) {
    return new Promise(function (resolve, reject) {
      // Crée la requête AJAX
      const req = new XMLHttpRequest();

      // Prépare le formulaire avec le fichier à envoyer
      const formData = new FormData();
      formData.append("file", blobInfo.blob(), blobInfo.filename());

      // Ouvre une requête POST vers l'endpoint "upload"
      req.open("POST", "upload");

      // Écoute le chargement complet (réponse du serveur)
      req.onload = function () {
        let json;

        // Vérifie le code HTTP (200 = OK)
        if (req.status !== 200) {
          return reject("Erreur HTTP: " + req.status);
        }

        try {
          // Tente de convertir la réponse en JSON
          json = JSON.parse(req.responseText);
        } catch (e) {
          return reject("Réponse invalide: " + req.responseText);
        }

        // Vérifie si l'URL de l'image est présente dans le JSON
        if (!json || typeof json.location !== "string") {
          return reject(
            "Réponse invalide: manque URL dans " + req.responseText
          );
        }
        //Vérifie si une erreur est envoyée depuis PHP
        if (json.error) {
          return reject("Erreur serveur: " + json.error); // Rejette l'erreur et affiche à l'utilisateur
        }

        // Tout est bon, on retourne l'URL
        resolve(json.location);
      };

      // Gestion des erreurs réseau
      req.onerror = function () {
        reject("Erreur réseau");
      };

      // 🎯 Ajout de la gestion de la progression de l'upload
      req.upload.onprogress = (e) => {
        if (e.lengthComputable) {
          // Calcul du pourcentage d'envoi
          const percent = (e.loaded / e.total) * 100;
          progress(percent); // 🔁 Callback fourni par TinyMCE
        }
      };

      // Envoi de la requête avec le fichier
      req.send(formData);
    });
  },

  content_style:
    "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
});
