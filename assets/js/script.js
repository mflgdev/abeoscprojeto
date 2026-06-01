
/*
export function initNavbarEvents() {
  const menuToggle = document.getElementById('menu-toggle');
  const navLinks = document.getElementById('nav-links');

  if (!menuToggle || !navLinks) return;

  menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');
    menuToggle.classList.toggle('active');
  });

  document.addEventListener('click', (e) => {
    const isClickInsideMenu = navLinks.contains(e.target);
    const isClickOnToggle = menuToggle.contains(e.target);

    if (!isClickInsideMenu && !isClickOnToggle && navLinks.classList.contains('active')) {
      navLinks.classList.remove('active');
      menuToggle.classList.remove('active');
    }
  });

  const dropdowns = document.querySelectorAll('.dropdown');
  dropdowns.forEach(dropdown => {
    const link = dropdown.querySelector('a');

    link.addEventListener('click', (e) => {
      if (window.innerWidth <= 768) {
        e.preventDefault();
        dropdown.classList.toggle('active');
      }
    });
  });
}




const modal = document.getElementById('global-modal');
const modalBody = document.getElementById('modal-body');
const modalClose = modal.querySelector('.modal-close');

let isClosing = false;

function openModal(contentHtml) {
  if (isClosing) return; // evita abrir enquanto está fechando

  modalBody.innerHTML = contentHtml;
  modal.classList.add('show');
  modal.classList.remove('closing');
  modal.setAttribute('aria-hidden', 'false');
  modal.style.display = 'flex'; // garante que está visível
  modal.focus();
}

function closeModal() {
  if (isClosing) return; // evita fechar duas vezes

  isClosing = true;
  modal.classList.add('closing');
  modal.setAttribute('aria-hidden', 'true');
}

// Evento para quando a animação terminar
modal.querySelector('.modal-content').addEventListener('animationend', (event) => {
  if (event.animationName === 'windowClose') {
    modal.classList.remove('show', 'closing');
    modalBody.innerHTML = '';
    modal.style.display = 'none';
    isClosing = false;
  }
});

modalClose.addEventListener('click', closeModal);

modal.addEventListener('click', (e) => {
  if (e.target === modal) closeModal();
});

window.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && modal.classList.contains('show')) {
    closeModal();
  }
});


modal.addEventListener('click', (event) => {
  if (event.target === modal) {
    closeModal();
  }
});
const buttons = document.querySelectorAll('.btn-ver-mais');

buttons.forEach(button => {
  button.addEventListener('click', function(event) {
    event.preventDefault();  // evita o comportamento padrão do link

    // Pega os dados do botão
    const title = this.getAttribute('data-title');
    const content = this.getAttribute('data-content');

    // Monta o HTML para a modal
    const modalContent = `
      <h2>${title}</h2>
      <p>${content}</p>
    `;

    // Abre a modal com o conteúdo
    openModal(modalContent);
  });
});


document.querySelectorAll('.btn-ver-mais').forEach(btn => {
  btn.addEventListener('click', (e) => {
    e.preventDefault(); // evita comportamento padrão do link

    const title = btn.dataset.title || '';
    const content = btn.dataset.content || '';
    const map = btn.dataset.map || '';

    const html = `
      <h2 id="modal-title">${title}</h2>
      <p id="modal-desc">${content}</p>
      ${map ? `<div style="margin-top: 1rem;">${map}</div>` : ''}
    `;

    openModal(html);
  });
});


















// Script para página de notícias 
document.addEventListener('DOMContentLoaded', function () {
  if (document.body.classList.contains('pagina-noticias')) {
    const inputBusca = document.getElementById('busca-noticia');
    const containerNoticias = document.querySelector('.main-ultimas-noticias');

    if (inputBusca && containerNoticias) {
      inputBusca.addEventListener('input', function () {
        const termo = this.value.trim();

        if (termo.length === 0) {
          // Se apagar tudo, recarrega a página para mostrar todas as notícias
          const paginaAtual = window.location.pathname; // pega a URL sem o domínio
          window.location.href = paginaAtual.split('?')[0];
          return;
        }

        // Troque aqui para o caminho absoluto correto do seu projeto
        const urlFetch = '/siteinstitucional/assets/ajax/buscar_noticias.php?busca=' + encodeURIComponent(termo);

        fetch(urlFetch)
          .then(res => {
            if (!res.ok) {
              throw new Error(`HTTP error! status: ${res.status}`);
            }
            return res.json();
          })
          .then(data => {
            console.log('Dados recebidos:', data); // DEBUG - remover depois

            containerNoticias.innerHTML = '';

            if (data.length === 0) {
              containerNoticias.innerHTML = '<p>Nenhuma notícia encontrada.</p>';
              return;
            }

            data.forEach(noticia => {
              const imgSrc = noticia.imagem_noticia ? `/siteinstitucional/assets/img/noticias/${noticia.imagem_noticia}` : '/siteinstitucional/assets/img/noticias/noticia.jpg';
              const dataFormatada = new Date(noticia.data_publicacao).toLocaleDateString('pt-BR', { day: '2-digit', month: 'short', year: 'numeric' });

              const card = `
                <div class="news-card">
                  <img src="${imgSrc}" alt="${noticia.titulo}">
                  <div class="card-content">
                    <h3>${noticia.titulo}</h3>
                    <p>${noticia.conteudo.substring(0, 100)}...</p>
                    <div class="news-meta">
                      <span><i class="fa-regular fa-calendar"></i> ${dataFormatada}</span>
                      <span><i class="fa-solid fa-location-dot"></i> São Paulo, SP</span>
                    </div>
                  </div>
                </div>
              `;
              containerNoticias.insertAdjacentHTML('beforeend', card);
            });
          })
          .catch(err => {
            console.error('Erro no fetch:', err);
            containerNoticias.innerHTML = '<p>Erro ao carregar notícias.</p>';
          });
      });
    }
  }
});

*/