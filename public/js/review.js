export function addReview() {
  // Gestion des formulaires de mise à jour des articles
  const addReviewForms = document.querySelectorAll('[id^="addReviewForm_"]');

  addReviewForms.forEach((form) => {
    // Récupérer l'ID de l'article depuis l'ID du formulaire en découpant l'id en tableau et en prenant l'index 1
    const articleId = form.getAttribute("id").split("_")[1];

    // Sélection des boutons associés à cet article
    const addReviewBtn = document.querySelector(`#addReviewBtn_${articleId}`);
    const closeAddReviewBtn = document.querySelector(
      `#closeAddReviewBtn_${articleId}`
    );

    // Ajout des écouteurs d'événements
    addReviewBtn.addEventListener("click", () => {
      form.style.display = "block";
      addReviewBtn.style.display = "none";
      closeAddReviewBtn.style.display = "block";
    });

    closeAddReviewBtn.addEventListener("click", () => {
      form.style.display = "none";
      closeAddReviewBtn.style.display = "none";
      addReviewBtn.style.display = "block";
    });
  });
}
