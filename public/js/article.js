export function addArticle() {
  // Sélection des éléments pour l'ajout d'article
  const addArticleForm = document.querySelector("#addArticleForm");
  const addArticleBtn = document.querySelector("#addArticleBtn");
  const divAddArticleBtn = document.querySelector("#divAddArticleBtn");
  const closeAddArticleBtn = document.querySelector("#closeAddArticleBtn");

  // Gestion du formulaire d'ajout
  if (
    addArticleBtn &&
    addArticleForm &&
    closeAddArticleBtn &&
    divAddArticleBtn
  ) {
    addArticleBtn.addEventListener("click", () => {
      addArticleForm.style.display = "block";
      divAddArticleBtn.style.display = "none";
      closeAddArticleBtn.style.display = "block";
    });

    closeAddArticleBtn.addEventListener("click", () => {
      addArticleForm.style.display = "none";
      divAddArticleBtn.style.display = "block";
      closeAddArticleBtn.style.display = "none";
    });
  }
}

export function updateArticle() {
  // Gestion des formulaires de mise à jour des articles
  const updateArticleForms = document.querySelectorAll(
    '[id^="updateArticleForm_"]'
  );

  updateArticleForms.forEach((form) => {
    // Récupérer l'ID de l'article depuis l'ID du formulaire en découpant l'id en tableau et en prenant l'index 1
    const articleId = form.getAttribute("id").split("_")[1];

    // Sélection des boutons associés à cet article
    const updateArticleBtn = document.querySelector(
      `#updateArticleBtn_${articleId}`
    );
    const closeUpdateArticleBtn = document.querySelector(
      `#closeUpdateArticleBtn_${articleId}`
    );
    const validUpdateArticleBtn = document.querySelector(
      `#validUpdateArticleBtn_${articleId}`
    );

    // Ajout des écouteurs d'événements
    updateArticleBtn.addEventListener("click", () => {
      form.style.display = "block";
      updateArticleBtn.style.display = "none";
      closeUpdateArticleBtn.style.display = "block";
      validUpdateArticleBtn.style.display = "block";
    });

    closeUpdateArticleBtn.addEventListener("click", () => {
      form.style.display = "none";
      updateArticleBtn.style.display = "block";
      closeUpdateArticleBtn.style.display = "none";
      validUpdateArticleBtn.style.display = "none";
    });
  });
}
