export class Content {
  addContent(
    addContentFormId,
    addContentBtnId,
    divAddContentBtnId,
    closeAddContentBtnId
  ) {
    // Sélection des éléments pour l'ajout de projet
    const addContentForm = document.querySelector(`${addContentFormId}`);
    const addContentBtn = document.querySelector(`${addContentBtnId}`);
    const divAddContentBtn = document.querySelector(`${divAddContentBtnId}`);
    const closeAddContentBtn = document.querySelector(
      `${closeAddContentBtnId}`
    );

    // Gestion du formulaire d'ajout
    if (
      addContentBtn &&
      addContentForm &&
      closeAddContentBtn &&
      divAddContentBtn
    ) {
      addContentBtn.addEventListener("click", () => {
        addContentForm.style.display = "block";
        divAddContentBtn.style.display = "none";
        window.scrollTo({
          top: addContentForm.offsetTop,
          behavior: "smooth",
        });
      });

      closeAddContentBtn.addEventListener("click", () => {
        addContentForm.style.display = "none";
        divAddContentBtn.style.display = "block";
      });
    }
  }

  updateContent(
    updateContentFormId,
    updateContentBtnId,
    closeUpdateContentBtnId,
    valideUpdateContentBtnId
  ) {
    // Gestion des formulaires de mise à jour des projets
    const updateContentForms = document.querySelectorAll(
      `[id^=${updateContentFormId}]`
    );

    updateContentForms.forEach((form) => {
      // Récupérer l'ID de l'article depuis l'ID du formulaire en découpant l'id en tableau et en prenant l'index 1
      const contentId = form.getAttribute("id").split("_")[1];

      // Sélection des boutons associés à cet article
      const updateContentBtn = document.querySelector(
        `${updateContentBtnId}${contentId}`
      );
      const closeUpdateContentBtn = document.querySelector(
        `${closeUpdateContentBtnId}${contentId}`
      );
      const validUpdateContentBtn = document.querySelector(
        `${valideUpdateContentBtnId}${contentId}`
      );

      // Ajout des écouteurs d'événements
      closeUpdateContentBtn.addEventListener("click", (event) => {
        event.preventDefault();
        form.style.display = "none";
        updateContentBtn.style.removeProperty("display");
        closeUpdateContentBtn.style.display = "none";
        validUpdateContentBtn.style.display = "none";
      });

      updateContentBtn.addEventListener("click", (event) => {
        event.preventDefault();
        form.style.display = "block";
        updateContentBtn.style.display = "none";
        closeUpdateContentBtn.style.removeProperty("display");
        validUpdateContentBtn.style.removeProperty("display");
        window.scrollTo({
          top: form.offsetTop,
          behavior: "smooth",
        });
      });
    });
  }
}
// export function addProject() {
//   // Sélection des éléments pour l'ajout de projet
//   const addProjectForm = document.querySelector("#addProjectForm");
//   const addProjectBtn = document.querySelector("#addProjectBtn");
//   const divAddProjectBtn = document.querySelector("#divAddProjectBtn");
//   const closeAddProjectBtn = document.querySelector("#closeAddProjectBtn");

//   // Gestion du formulaire d'ajout
//   if (
//     addProjectBtn &&
//     addProjectForm &&
//     closeAddProjectBtn &&
//     divAddProjectBtn
//   ) {
//     addProjectBtn.addEventListener("click", () => {
//       addProjectForm.style.display = "block";
//       divAddProjectBtn.style.display = "none";
//       window.scrollTo({
//         top: addProjectForm.offsetTop,
//         behavior: "smooth",
//       });
//     });

//     closeAddProjectBtn.addEventListener("click", () => {
//       addProjectForm.style.display = "none";
//       divAddProjectBtn.style.display = "block";
//     });
//   }
// }

// export function updateProject() {
//   // Gestion des formulaires de mise à jour des projets
//   const updateProjectForms = document.querySelectorAll(
//     '[id^="updateProjectForm_"]'
//   );

//   updateProjectForms.forEach((form) => {
//     // Récupérer l'ID de l'article depuis l'ID du formulaire en découpant l'id en tableau et en prenant l'index 1
//     const projectId = form.getAttribute("id").split("_")[1];

//     // Sélection des boutons associés à cet article
//     const updateProjectBtn = document.querySelector(
//       `#updateProjectBtn_${projectId}`
//     );
//     const closeUpdateProjectBtn = document.querySelector(
//       `#closeUpdateProjectBtn_${projectId}`
//     );
//     const validUpdateProjectBtn = document.querySelector(
//       `#validUpdateProjectBtn_${projectId}`
//     );

//     // Ajout des écouteurs d'événements
//     closeUpdateProjectBtn.addEventListener("click", (event) => {
//       event.preventDefault();
//       form.style.display = "none";
//       updateProjectBtn.style.removeProperty("display");
//       closeUpdateProjectBtn.style.display = "none";
//       validUpdateProjectBtn.style.display = "none";
//     });

//     updateProjectBtn.addEventListener("click", (event) => {
//       event.preventDefault();
//       form.style.display = "block";
//       updateProjectBtn.style.display = "none";
//       closeUpdateProjectBtn.style.removeProperty("display");
//       validUpdateProjectBtn.style.removeProperty("display");
//       window.scrollTo({
//         top: form.offsetTop,
//         behavior: "smooth",
//       });
//     });
//   });
// }
