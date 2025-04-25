import {} from "./article.js";
import { Content } from "./project.js";
import { Review } from "./review.js";

document.addEventListener("DOMContentLoaded", () => {
  let article = new Content();
  article.addContent(
    "#addArticleForm",
    "#addArticleBtn",
    "#divAddArticleBtn",
    "#closeAddArticleBtn"
  );
  article.updateContent(
    "updateArticleForm_",
    "#updateArticleBtn_",
    "#closeUpdateArticleBtn_",
    "#validUpdateArticleBtn_"
  );

  let articleReview = new Review();
  articleReview.addReview(
    "addArticleReviewForm_",
    "#addArticleReviewBtn_",
    "#closeAddArticleReviewBtn_"
  );

  let project = new Content();
  project.addContent(
    "#addProjectForm",
    "#addProjectBtn",
    "#divAddProjectBtn",
    "#closeAddProjectBtn"
  );
  project.updateContent(
    "updateProjectForm_",
    "#updateProjectBtn_",
    "#closeUpdateProjectBtn_",
    "#validUpdateProjectBtn_"
  );

  let projectReview = new Review();
  projectReview.addReview(
    "addProjectReviewForm_",
    "#addProjectReviewBtn_",
    "#closeAddProjectReviewBtn_"
  );
});
