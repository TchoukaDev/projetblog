export class Review {
  addReview(ReviewFormId, addReviewBtnId, closeAddReviewBtnId) {
    // Gestion des formulaires de mise à jour des Projets
    const addReviewForms = document.querySelectorAll(`[id^="${ReviewFormId}"]`);

    addReviewForms.forEach((form) => {
      // Récupérer l'ID d du projet depuis l'ID du formulaire en découpant l'id en tableau et en prenant l'index 1
      const projectId = form.getAttribute("id").split("_")[1];

      // Sélection des boutons associés à ce projet
      const addReviewBtn = document.querySelector(
        `${addReviewBtnId}${projectId}`
      );
      const closeAddReviewBtn = document.querySelector(
        `${closeAddReviewBtnId}${projectId}`
      );

      // Ajout des écouteurs d'événements
      addReviewBtn.addEventListener("click", () => {
        form.style.display = "block";
        addReviewBtn.style.display = "none";
        closeAddReviewBtn.style.removeProperty("display");
      });

      closeAddReviewBtn.addEventListener("click", () => {
        form.style.display = "none";
        closeAddReviewBtn.style.display = "none";
        addReviewBtn.style.removeProperty("display");
      });
    });
  }
}
