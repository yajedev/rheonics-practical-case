document.addEventListener("DOMContentLoaded", () => {
  const buttons = document.querySelectorAll(".filter-btn");
  const cards = document.querySelectorAll(".social-card");

  buttons.forEach((button) => {
    button.addEventListener("click", (e) => {
      /* Active Tabs */
      const currentActive = document.querySelector(".filter-btn.active");
      if (currentActive) {
        currentActive.classList.remove("active");
      }
      e.currentTarget.classList.add("active");

      /* Filtering */
      const filter = e.currentTarget.dataset.filter;

      cards.forEach((card) => {
        const categories = card.dataset.category;

        if (filter === "all" || categories.includes(filter)) {
          card.style.display = "";
        } else {
          card.style.display = "none";
        }
      });
    });
  });
});
