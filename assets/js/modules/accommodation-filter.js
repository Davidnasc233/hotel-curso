export function initAccommodationFilter() {
    const filterLinks = document.querySelectorAll(".acomodacoes a[data-filter]");
    const filterableItems = document.querySelectorAll(".filterable-item");
    const todosLink = document.querySelector('.acomodacoes a[data-filter="todos"]');
  
    if (filterLinks.length === 0 || filterableItems.length === 0) {
      console.warn("Elementos para o filtro de acomodações não encontrados.");
      return;
    }
  
    filterLinks.forEach((link) => {
      link.addEventListener("click", function (event) {
        event.preventDefault();
  
        filterLinks.forEach((l) => l.classList.remove("active"));
        this.classList.add("active");
  
        const filterValue = this.getAttribute("data-filter");
  
        filterableItems.forEach((item) => {
          const shouldBeVisible = filterValue === "todos" || item.classList.contains(filterValue);
          item.style.display = shouldBeVisible ? "block" : "none";
        });
      });
    });
  
    if (todosLink) {
      todosLink.click();
    }
  }