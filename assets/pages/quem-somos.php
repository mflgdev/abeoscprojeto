<?php include_once __DIR__ . '/../../includes/global.php';
$title = "Quem Somos - Conhelça a ABE";
$description = "Saiba mais sobre a Associação Beneficente Evangélica (ABE), uma entidade filantrópica dedicada ao amparo social e ao desenvolvimento infantil no Distrito Federal. Com mais de 30 anos de história, a ABE oferece educação infantil de qualidade para crianças em situação de vulnerabilidade, promovendo inclusão, cidadania e direitos desde a primeira infância.";
$image = BASE_URL . "/assets/img/pagina-especifica.jpg";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once __DIR__ . '/../../includes/head.php'; ?>
</head>
<body>
<main style="max-width: 1100px; display: flex; flex-wrap: wrap; background: var(--cor-tema-background); margin: 0 auto; padding: 40px 20px;">
<!-- Seção Sobre sem imagem lateral -->
<section class="abe-sobre-section" aria-label="Sobre a Associação Beneficente Evangélica">
  <div class="abe-sobre-container--fullwidth">
    <h2 class="abe-sobre-container__title">Sobre a Associação Beneficente Evangélica (ABE)</h2>
    <p>
      Fundada em <strong>17 de setembro de 1993</strong>, a ABE nasceu do compromisso com a justiça social, a fé e o cuidado com o próximo.
      Sua missão é transformar vidas por meio da educação e da assistência às famílias em situação de vulnerabilidade social, oferecendo
      oportunidades de desenvolvimento desde a primeira infância.
    </p>
    <p>
      A primeira grande realização da ABE foi a criação da <strong>Creche Pastor Francisco Miranda</strong>, carinhosamente conhecida como
      Creche Matriz, localizada em Samambaia, Distrito Federal. Seu nome é uma homenagem ao Pastor Francisco Miranda — um homem íntegro e generoso,
      que dedicou sua vida a ações sociais em prol dos mais necessitados.
    </p>
    <p>
      A construção da creche foi possível graças à união de forças entre a ABE, o Governo do Distrito Federal, a Legião da Boa Vontade (LBV)
      e o Fundo do Banco do Brasil (FBB). Inaugurada apenas quatro anos após a fundação da cidade de Samambaia, a unidade é um marco de esperança e transformação para a comunidade.
    </p>
    <p>
      Por mais de 30 anos, a Creche Pastor Francisco Miranda tem sido um espaço de acolhimento, aprendizado e dignidade para centenas de crianças,
      especialmente aquelas oriundas de famílias com grandes desafios socioeconômicos.
    </p>
    <p>
      Hoje, a ABE segue firme no propósito de semear amor, educação e fé, com uma história construída por mãos solidárias e corações comprometidos com o bem comum.
    </p>
  </div>
</section>
    <!-- CARDS MISSÃO, VISÃO E VALORES -->
    <section class="cards-container" aria-label="Missão, Visão e Valores">
      <article class="card">
        <h3><i class="fas fa-bullseye"></i> Missão</h3>
        <ul>
          <li><i class="fas fa-check"></i>Acolher e apoiar crianças e suas famílias</li>
          <li><i class="fas fa-check"></i>Promover o desenvolvimento das potencialidades</li>
          <li><i class="fas fa-check"></i>Focar na inclusão e na conquista de direitos</li>
          <li><i class="fas fa-check"></i>Formar cidadãos conscientes, críticos e responsáveis</li>
        </ul>
      </article>

      <article class="card">
        <h3><i class="fas fa-eye"></i> Visão</h3>
        <ul>
          <li><i class="fas fa-check"></i>Ser reconhecida como espaço de crescimento conjunto</li>
          <li><i class="fas fa-check"></i>Desenvolver cidadãos éticos e atuantes</li>
          <li><i class="fas fa-check"></i>Contribuir para uma sociedade justa e humana</li>
          <li><i class="fas fa-check"></i>Promover competência social e cidadã</li>
        </ul>
      </article>

      <article class="card">
        <h3><i class="fas fa-heart"></i> Valores</h3>
        <ul>
          <li><i class="fas fa-check"></i>Respeito à individualidade de cada criança</li>
          <li><i class="fas fa-check"></i>Solidariedade e empatia</li>
          <li><i class="fas fa-check"></i>Comprometimento com educação de qualidade</li>
          <li><i class="fas fa-check"></i>Busca pela felicidade como direito</li>
          <li><i class="fas fa-check"></i>Valorização do brincar e do diálogo</li>
        </ul>
      </article>
    </section>
    <!-- Quem Somos-->
  <section class="quem-somos-modern" aria-label="Quem Somos">
    <div class="quem-somos-wrapper">
      <h2 class="qs-titulo">Quem Somos</h2>
      <div class="qs-bloco">
        <i class="fas fa-hands-helping qs-icone"></i>
        <div>
          <p>
            Há mais de <strong>30 anos</strong>, a Associação Beneficente Evangélica atua como uma entidade filantrópica, sem fins lucrativos, dedicada ao amparo social e ao desenvolvimento infantil no Distrito Federal.
          </p>
          <p>
            Com <strong>6 unidades de educação infantil</strong>, acolhemos diariamente <strong>mais de 1.000 crianças</strong> com o suporte de <strong>230 profissionais</strong> altamente comprometidos.
          </p>
        </div>
    </div>
    <div class="qs-bloco">
      <i class="fas fa-brain qs-icone"></i>
      <div>
        <p>
          Inspiramo-nos em educadores como <strong>Montessori, Piaget, Vygotsky</strong> e <strong>Paulo Freire</strong>, valorizando o <strong>brincar, o cuidar e o diálogo</strong> como elementos centrais de uma educação transformadora.
        </p>
      </div>
    </div>
    <div class="qs-bloco">
      <i class="fas fa-heart qs-icone"></i>
      <div>
        <p>
          Nosso compromisso é formar <strong>crianças felizes, críticas e conscientes</strong> de seus direitos, promovendo uma sociedade mais justa, humana e igualitária.
        </p>
      </div>
    </div>
  </div>
</section>
<section class="unidades-modern" style="max-width: 1100px;" aria-label="Nossas Unidades">
  <h2 class="unidades-titulo">Nossas Unidades</h2>
  <div class="unidades-wrapper">
    <article class="unidade-card">
      <img src="https://picsum.photos/300/200?random=1" alt="Creche ABE" class="unidade-card__imagem" />
      <h3 class="unidade-card__nome">Creche ABE</h3>
      <p class="unidade-card__descricao">Atendimento integral para crianças de 0 a 5 anos.</p>
    </article>
    <article class="unidade-card">
      <img src="https://picsum.photos/300/200?random=2" alt="CEPI Angico" class="unidade-card__imagem" />
      <h3 class="unidade-card__nome">CEPI Angico</h3>
      <p class="unidade-card__descricao">Educação infantil com foco no desenvolvimento integral.</p>
    </article>
    <article class="unidade-card">
      <img src="https://picsum.photos/300/200?random=3" alt="CEPI Periquito" class="unidade-card__imagem" />
      <h3 class="unidade-card__nome">CEPI Periquito</h3>
      <p class="unidade-card__descricao">Ambiente acolhedor para crianças em situação de vulnerabilidade.</p>
    </article>
    <article class="unidade-card">
      <img src="https://picsum.photos/300/200?random=4" alt="CEPI Raposa do Cerrado" class="unidade-card__imagem" />
      <h3 class="unidade-card__nome">CEPI Raposa do Cerrado</h3>
      <p class="unidade-card__descricao">Promoção da cidadania e desenvolvimento social.</p>
    </article>
    <article class="unidade-card">
      <img src="https://picsum.photos/300/200?random=5" alt="CEPI Sarah Kubitschek" class="unidade-card__imagem" />
      <h3 class="unidade-card__nome">CEPI Sarah Kubitschek</h3>
      <p class="unidade-card__descricao">Espaço para aprendizado e brincadeiras inclusivas.</p>
    </article>
    <article class="unidade-card">
      <img src="https://picsum.photos/300/200?random=6" alt="CEPI Tamanduá-Bandeira" class="unidade-card__imagem" />
      <h3 class="unidade-card__nome">CEPI Tamanduá-Bandeira</h3>
      <p class="unidade-card__descricao">Apoio integral para o desenvolvimento infantil.</p>
    </article>
  </div>
</section>
    <!-- TIMELINE HORIZONTAL -->
<section class="timeline-horizontal" aria-label="Linha do Tempo da ABE">
  <h2 class="timeline-title">Nossa História</h2>
  <div class="timeline-wrapper">
    <div class="timeline-track">

      <div class="timeline-event">
        <div class="dot"></div>
        <div class="content">
          <h4>1993</h4>
          <p>Fundação da Associação Beneficente Evangélica (ABE).</p>
        </div>
      </div>
      <div class="timeline-event">
        <div class="dot"></div>
        <div class="content">
          <h4>1997</h4>
          <p>Inauguração da Creche Pastor Francisco Miranda.</p>
        </div>
      </div>
      <div class="timeline-event">
        <div class="dot"></div>
        <div class="content">
          <h4>2000</h4>
          <p>Expansão para cinco unidades no Distrito Federal.</p>
        </div>
      </div>
      <div class="timeline-event">
        <div class="dot"></div>
        <div class="content">
          <h4>2010</h4>
          <p>Implementação do atendimento integral (10h diárias).</p>
        </div>
      </div>
      <div class="timeline-event">
        <div class="dot"></div>
        <div class="content">
          <h4>2023</h4>
          <p>Mais de 1.000 crianças atendidas por 230 profissionais.</p>
        </div>
      </div>
    </div>
  </div>
</section>
</main>
<script>
    $(document).ready(function () {
      $('.slider').slick({
        dots: false,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 1000,
        adaptiveHeight: true,
      });
    });
</script>
</body>
</html>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.querySelector('.timeline-wrapper');
    const track = document.querySelector('.timeline-track');

    let scrollSpeed = 0.3;
    let accumulatedScroll = 0;
    let isFading = false;

    function fadeOutIn(callback) {
      isFading = true;
      track.style.transition = 'opacity 0.8s';
      track.style.opacity = '0';

      setTimeout(() => {
        wrapper.scrollLeft = 0;
        accumulatedScroll = 0;
        track.style.transition = 'opacity 0.8s';
        track.style.opacity = '1';

        setTimeout(() => {
          isFading = false;
          callback();
        }, 800);
      }, 800);
    }
    function smoothScroll() {
      if (isFading) return;
      accumulatedScroll += scrollSpeed;
      if (accumulatedScroll >= 1) {
        wrapper.scrollLeft += Math.floor(accumulatedScroll);
        accumulatedScroll -= Math.floor(accumulatedScroll);
      }
      if (wrapper.scrollLeft + wrapper.clientWidth >= wrapper.scrollWidth - 1) {
        fadeOutIn(() => requestAnimationFrame(smoothScroll));
        return;
      }
      requestAnimationFrame(smoothScroll);
    }
    track.style.opacity = '1';
    requestAnimationFrame(smoothScroll);
  });
</script>

