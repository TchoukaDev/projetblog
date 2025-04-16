import { addArticle, updateArticle } from "./article.js";
import { addReview } from "./review.js";

document.addEventListener("DOMContentLoaded", () => {
  addArticle();
  updateArticle();
  addReview();
});
