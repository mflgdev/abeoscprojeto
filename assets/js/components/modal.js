export function initModalEvents() {
  const modal = document.getElementById('global-modal');
  const modalBody = document.getElementById('modal-body');
  const modalClose = modal?.querySelector('.modal-close');

  if (!modal || !modalBody) return;

  let isClosing = false;
  let cachedMapHtml = null;

  function openModal(contentHtml) {
    if (isClosing) return;
    modalBody.innerHTML = contentHtml;
    modal.classList.add('show');
    modal.classList.remove('closing');
    modal.setAttribute('aria-hidden', 'false');
    modal.style.display = 'flex';
    modal.focus();
  }

  function closeModal() {
    if (isClosing) return;
    isClosing = true;
    modal.classList.add('closing');
    modal.setAttribute('aria-hidden', 'true');
  }

  modal.querySelector('.modal-content')?.addEventListener('animationend', (e) => {
    if (e.animationName === 'windowClose') {
      modal.classList.remove('show', 'closing');
      modalBody.innerHTML = '';
      modal.style.display = 'none';
      isClosing = false;
      cachedMapHtml = null; // Opcional: limpa cache ao fechar para liberar memória
    }
  });

  modalClose?.addEventListener('click', closeModal);
  modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
  window.addEventListener('keydown', e => { if (e.key === 'Escape' && modal.classList.contains('show')) closeModal(); });

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.siteinstitucional-btn-ver-mais');
    if (!btn) return;

    e.preventDefault();

    const title = btn.dataset.title || '';
    const content = (btn.dataset.content || '').replace(/\n/g, '<br>');

    const decodeHtml = (html) => {
      const txt = document.createElement('textarea');
      txt.innerHTML = html;
      return txt.value;
    };

    const slug = btn.dataset.slug || '';
    const baseUrl = window.BASE_URL || '';
    const urlUnidade = slug ? `${baseUrl}/unidade/${slug}` : '#';

    if (!cachedMapHtml) {
      cachedMapHtml = decodeHtml(btn.dataset.map || '');
    }

    const html = `
      <h2 class="modal-title">${title}</h2>
      <p class="modal-desc">${content}</p>
      <div style="margin-top: 1rem;">
        ${cachedMapHtml || ''}
      </div>
      <button
        class="modal-detail-button"
        style="margin-top: 1rem;"
        onclick="window.location.href='${urlUnidade}'"
      >
        Conferir detalhes
      </button>
    `;

    openModal(html);
  });
}
