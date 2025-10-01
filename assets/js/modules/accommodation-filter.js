// js/modules/accommodationFilter.js

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
  
        // Remove a classe 'active' de todos os links
        filterLinks.forEach((l) => l.classList.remove("active"));
        // Adiciona 'active' ao link clicado
        this.classList.add("active");
  
        const filterValue = this.getAttribute("data-filter");
  
        filterableItems.forEach((item) => {
          const shouldBeVisible = filterValue === "todos" || item.classList.contains(filterValue);
          item.style.display = shouldBeVisible ? "block" : "none";
        });
      });
    });
  
    // Simula o clique no filtro "todos" para exibir tudo inicialmente
    if (todosLink) {
      todosLink.click();
    }
  }