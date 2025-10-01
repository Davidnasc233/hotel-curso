// js/modules/headerScroll.js

export function initHeaderScroll() {
    const header = document.querySelector("header");
  
    if (!header) {
      console.warn("Elemento <header> não encontrado.");
      return;
    }
  
    document.addEventListener("scroll", () => {
      if (window.scrollY > 0) {
        header.classList.add("header-bg");
      } else {
        header.classList.remove("header-bg");
      }
    });
  }