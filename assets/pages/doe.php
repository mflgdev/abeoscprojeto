<?php
include_once __DIR__ . '/../../includes/global.php';
$title = "Doe - Apoie nossa causa";
$description = "Sua contribuição nos ajuda a manter nossos projetos sociais, eventos e iniciativas educacionais. Com sua ajuda, conseguimos impactar positivamente a vida de muitas pessoas. Toda doação, por menor que seja, faz uma grande diferença.";
$image = BASE_URL . "/assets/img/pagina-especifica.jpg";

$query_banners = "SELECT * FROM banners ORDER BY id ASC";
$stmt_banners = $conn->prepare($query_banners);
$stmt_banners->execute();
$banners = $stmt_banners->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="br-pt">
<head>
  <?php include_once __DIR__ . '/../../includes/head.php'; ?>
</head>
<body>
  <!-- Conteúdo Principal -->
  <main>
<section class="doacao-page" aria-label="Página de Doação">
  <!-- Bloco QR Code + Dados -->
  <div class="doacao-bloco-superior">
    <!--<div class="doacao-qrcode">
      <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=https://exemplo.com/doar" alt="QR Code para doação" />
    </div>!-->
    <div class="doacao-dados-conta">
      <h2 class="doacao-subtitulo">Dados para transferência</h2>
      <p><strong>Banco:</strong> Banco Exemplo S.A.</p>
      <p><strong>Agência:</strong> 1234-5</p>
      <p><strong>Conta:</strong> 67890-1</p>
      <p><strong>Favorecido:</strong> Nome do Beneficiário</p>
      <p><strong>CPF/CNPJ:</strong> 00.000.000/0001-00</p>
    </div>
  </div>

  <!-- Bloco Texto + Formulário -->
  <div class="doacao-bloco-inferior">
    <div class="doacao-texto">
      <h1 class="doacao-titulo">Por que doar?</h1>
      <p class="doacao-intro">
        Sua contribuição nos ajuda a manter nossos projetos sociais, eventos e iniciativas educacionais.  
        Com sua ajuda, conseguimos impactar positivamente a vida de muitas pessoas.  
        Toda doação, por menor que seja, faz uma grande diferença.
      </p><br>
      <p class="doacao-intro">
        Sua contribuição nos ajuda a manter nossos projetos sociais, eventos e iniciativas educacionais.  
        Com sua ajuda, conseguimos impactar positivamente a vida de muitas pessoas.  
        Toda doação, por menor que seja, faz uma grande diferença.
      </p><br>
      <p class="doacao-intro">
        Sua contribuição nos ajuda a manter nossos projetos sociais, eventos e iniciativas educacionais.  
        Com sua ajuda, conseguimos impactar positivamente a vida de muitas pessoas.  
        Toda doação, por menor que seja, faz uma grande diferença.
      </p>
    </div>

    <form class="doacao-form" action="#" method="post" novalidate aria-label="Formulário de contato para dúvidas">
      <label for="doacao-nome" class="doacao-label">Nome</label>
      <input type="text" id="doacao-nome" name="nome" class="doacao-input" placeholder="Seu nome completo" required />

      <label for="doacao-email" class="doacao-label">Email</label>
      <input type="email" id="doacao-email" name="email" class="doacao-input" placeholder="seu@email.com" required />

      <label for="doacao-mensagem" class="doacao-label">Mensagem</label>
      <textarea id="doacao-mensagem" name="mensagem" class="doacao-textarea" placeholder="Escreva sua mensagem ou dúvida" required></textarea>

      <button type="submit" class="doacao-botao">Enviar</button>
    </form>
  </div>
  </main>
  <script>
    document.querySelectorAll(".accordion-header").forEach(header => {
      header.addEventListener("click", () => {
        const accordion = header.parentElement;
        const content = accordion.querySelector(".accordion-content");

        if (accordion.classList.contains("active")) {
          accordion.classList.remove("active");
          content.style.maxHeight = null;
        } else {
          document.querySelectorAll(".accordion").forEach(a => {
            a.classList.remove("active");
            a.querySelector(".accordion-content").style.maxHeight = null;
          });
          accordion.classList.add("active");
          content.style.maxHeight = content.scrollHeight + "px";
        }
      });
    });
  </script>
</body>
</html>
