<?php include_once __DIR__ . '/includes/global.php';

$title = $title ?? 'Associação Beneficente Evangélica - ABE';
$description = $description ?? 'A Associação Beneficente Evangélica atua há mais de 30 anos no DF, oferecendo apoio social e educação infantil para 1.011 crianças de 0 a 5 anos em situação de vulnerabilidade, com a dedicação de 230 profissionais em seis unidades de ensino.';
$image = $image ?? 'https://site.com/assets/img/og-default.jpg';
// Últimas notícias
$sql = "SELECT id_noticia, titulo, imagem_noticia, conteudo, data_publicacao, id_unidade FROM noticias ORDER BY data_publicacao DESC LIMIT 5";
$result = $conn->query($sql);

// Super destaque (destaque = 2)
$sqlSuperDestaque = "SELECT id_noticia, titulo, imagem_noticia, conteudo, data_publicacao FROM noticias WHERE destaque = 2 ORDER BY data_publicacao DESC LIMIT 5";
$resultSuper = $conn->query($sqlSuperDestaque);

// Destaques menores (destaque = 1)
$sqlDestaques = "SELECT id_noticia, titulo, imagem_noticia FROM noticias WHERE destaque = 1 ORDER BY data_publicacao DESC LIMIT 4";
$resultDestaques = $conn->query($sqlDestaques);

// Verifica erros nas consultas
if (!$result || !$resultSuper || !$resultDestaques) {
    die("Erro em uma das consultas: " . $conn->error);
}

function resumoTexto($html, $limite = 200) {
    $texto = strip_tags($html);

    if (mb_strlen($texto) > $limite) {
        $texto = mb_substr($texto, 0, $limite) . '...';
    }

    return $texto;
}
?>

<!DOCTYPE html>
<html lang="br-pt">
<head>
  <?php include_once __DIR__ . '/includes/head.php';?>
</head>
<body>
  <main>
    <!-- Slider com fundo e cards fixos -->
     <!--<h2 class="section-title"><i class="fa-regular fa-newspaper"></i>Últimas Notícias</h2>!-->
  <section class="noticias principais-noticias">

  <!-- SUPER DESTAQUE -->
<div class="main-principais-noticias slider-super-destaques">
  <?php
  if ($resultSuper && $resultSuper->rowCount() > 0) {
      while ($super = $resultSuper->fetch(PDO::FETCH_ASSOC)) {
          $imagem_super = !empty($super['imagem_noticia']) ? $super['imagem_noticia'] : '/assets/noticias/img_capa/noticia.jpg';
          // Usa direto, sem concatenar
          $caminho_super = $imagem_super;
  ?>
    <div class="slide-item">
      <a href="<?= $baseURL ?>/noticias/<?= $super['id_noticia'] ?>" class="slide-link">
        <div class="super-slide" style="background-image: url('<?= htmlspecialchars($caminho_super) ?>');">
          <div class="main-principais-noticias-overlay">
            <h2><i class="fa-solid fa-bullhorn"></i> <?= htmlspecialchars($super['titulo']) ?></h2>
          </div>
        </div>
      </a>
    </div>
  <?php
      }
  }
  ?>
</div>

  <!-- DESTAQUES MENORES -->
<aside class="highlights">
  <h3><i class="fa-solid fa-heart"></i> Destaques</h3>
  <ul>
    <?php
    if ($resultDestaques && $resultDestaques->rowCount() > 0) {
        while ($destaque = $resultDestaques->fetch(PDO::FETCH_ASSOC)) {
            $imagem_destaque = !empty($destaque['imagem_noticia']) ? $destaque['imagem_noticia'] : '/assets/noticias/img_capa/noticia.jpg';
            // Usa direto, sem concatenar
            $caminho_destaque = $imagem_destaque;
    ?>
    <li>
      <a href="<?= $baseURL ?>/noticias/<?= $destaque['id_noticia'] ?>" class="destaque-link" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 10px;">
        <div class="img-container">
          <img src="<?= htmlspecialchars($caminho_destaque) ?>" alt="<?= htmlspecialchars($destaque['titulo']) ?>">
        </div>
        <p><?= htmlspecialchars($destaque['titulo']) ?></p>
      </a>
    </li>
    <?php
        }
    } else {
        echo "<li><p>Nenhum destaque encontrado.</p></li>";
    }
    ?>
  </ul>
</aside>
</section>
 <!-- Exibição das últimas notícias -->
<section class="noticias ultimas-noticias">
  <h2 class="section-title"><i class="fa-regular fa-newspaper"></i>Últimas Notícias</h2>
  <div class="main-ultimas-noticias">
    <?php
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Usa direto o caminho da imagem vindo do banco, ou um padrão se vazio
            $imagem_noticia = $row['imagem_noticia'];
            if (empty($imagem_noticia)) {
                $imagem_noticia = '/assets/noticias/img_capa/noticia.jpg';
            }
            $caminho_imagem = $imagem_noticia;
    ?>
<a href="<?= $baseURL ?>/noticias/<?= $row['id_noticia'] ?>" class="news-card" style="text-decoration: none; color: inherit;">
    <img src="<?= htmlspecialchars($caminho_imagem) ?>" alt="<?= htmlspecialchars($row['titulo']) ?>" />
    <div class="card-content">
        <h3><?= mb_strimwidth($row['titulo'], 0, 32, '...') ?></h3>
        <p><?= mb_substr(strip_tags($row['conteudo']), 0, 50, 'UTF-8') ?>...</p>
        <div class="news-meta">
            <span><i class="fa-regular fa-calendar"></i> <?= mb_convert_case(strftime('%d %b %Y', strtotime($row['data_publicacao'])), MB_CASE_TITLE, "UTF-8") ?></span>
            <span><i class="fa-solid fa-location-dot"></i> Brasília, DF</span>
        </div>
    </div>
</a>
    <?php
        }
    } else {
        echo "Nenhuma notícia encontrada.";
    }
    ?>
  </div>
</section>
  <!-- BLOCO: QUEM SOMOS -->
<section class="quem-somos-block">
  <h2 class="section-title"><i class="fa-solid fa-users"></i> Quem somos</h2>
  <div class="quem-somos-content">
    <div class="quem-somos-text">
      <p>A <strong>Associação Beneficente Evangélica</strong> atua há mais de 30 anos no DF, oferecendo apoio social e educação infantil para <strong>1.011 crianças de 0 a 5 anos</strong> em situação de vulnerabilidade, com a dedicação de <strong>230 profissionais</strong> em seis unidades de ensino.</p>
      <p>Com base em educadores como Vygotsky e Paulo Freire, a instituição valoriza o brincar, o cuidado e as interações para promover uma educação inclusiva, democrática e transformadora, formando crianças felizes, críticas e conscientes de seus direitos.</p>
      <a href="<?= BASE_URL ?>/quem-somos"><button class="button">Saiba mais</button></a>
    </div>
    <!-- SLIDER DE IMAGENS -->
    <div class="quem-somos-slider">
      <div><img src="assets/img/background.jpg" alt="Nossa equipe em ação"></div>
      <div><img src="assets/img/background.jpg" alt="Atividades com as crianças"></div>
      <div><img src="assets/img/background.jpg" alt="Ambiente escolar"></div>
    </div>
  </div>
  <!-- ESTATÍSTICAS -->
  <div class="quem-somos-stats">
    <div class="stat-item">
      <i class="fa-solid fa-child-reaching"></i>
      <h3>+1000 crianças atendidas</h3>
      <p>Atendimento integral de 10 horas diárias para crianças de 0 a 5 anos.</p>
    </div>
    <div class="stat-item">
      <i class="fa-solid fa-users-line"></i>
      <h3>230 colaboradores</h3>
      <p>Equipe qualificada e alinhada aos nossos valores educacionais.</p>
    </div>
    <div class="stat-item">
      <i class="fa-solid fa-school-flag"></i>
      <h3>6 unidades</h3>
      <p>Expansão contínua para atender mais famílias com qualidade e carinho.</p>
    </div>
  </div>
</section>
<?php
$stmt = $conn->query("SELECT * FROM unidades ORDER BY nome");
?>

<section class="nossas-unidades-clean">
  <h2 class="section-title"><i class="fa-regular fa-newspaper"></i> Nossas Unidades</h2>
  <div class="unidades-slider-wrapper">
    <div class="unidades-slider">

      <?php while ($unidade = $stmt->fetch(PDO::FETCH_ASSOC)): 
          $imagem = (!empty($unidade['imagem']) && str_starts_with($unidade['imagem'], '/assets/'))
                    ? $unidade['imagem']
                    : '/assets/img/default-unidade.jpg';

          $modalTitle = htmlspecialchars($unidade['nome'], ENT_QUOTES);

          // Conteúdo modal, sem tags HTML para não complicar o escaping
          $modalContent = 
              $unidade['endereco'] . "\n" .
              "<strong>Horário:</strong> " . $unidade['horario_funcionamento'] . "\n" .
              "<strong>Telefone:</strong> " . $unidade['telefone'];

          // Adiciona loading="lazy" no iframe do Google Maps
          $modalMap = str_replace(
            '<iframe',
            '<iframe loading="lazy"',
            $unidade['embed_google_maps']
          );
      ?>
        <div class="unidade">
          <img src="<?= htmlspecialchars($imagem, ENT_QUOTES) ?>" alt="<?= htmlspecialchars($unidade['nome'], ENT_QUOTES) ?>">
          <h3><?= htmlspecialchars($unidade['nome'], ENT_QUOTES) ?></h3>
          <p><?= nl2br(htmlspecialchars($unidade['endereco'])) ?></p>

          <button
            class="siteinstitucional-btn-ver-mais"
            data-title="<?= $modalTitle ?>"
            data-content="<?= htmlspecialchars($modalContent, ENT_QUOTES) ?>"
            data-map="<?= htmlspecialchars($modalMap, ENT_QUOTES) ?>"
            data-slug="<?= htmlspecialchars($unidade['slug'], ENT_QUOTES) ?>"
          >
            Ver Mais
          </button>
        </div>
      <?php endwhile; ?>

    </div>
  </div>
</section>














<!-- Bloco Transparência -->
<section class="transparency-wrapper">
  <div class="transparency-left">
    <h2>Portal da Transparência</h2>
    <p>Aqui você pode conferir os principais gastos e verbas da nossa creche, com total clareza e responsabilidade.</p>
    <a href="/transparencia"><button class="button">Ver Mais</button></a>
  </div>

  <!-- Lado direito: slider com cards -->
  <div class="transparency-right">
    <div class="transparency-slider">
      <div class="transp-card">
        <h3>Investimentos em Infraestrutura</h3>
        <button class="button">Ver Mais</button>
      </div>
      <div class="transp-card">
        <h3>Investimentos em Infraestrutura</h3>
        <button class="button">Ver Mais</button>
      </div>
      <div class="transp-card">
        <h3>Investimentos em Infraestrutura</h3>
        <button class="button">Ver Mais</button>
      </div>
      <div class="transp-card">
        <h3>Investimentos em Infraestrutura</h3>
        <button class="button">Ver Mais</button>
      </div>
    </div>
  </div>
</section>
      </main>




<section class="apoio-carousel-container">
  <h2 class="section-title"><i class="fa-regular fa-newspaper"></i> Nossos Apoiadores</h2>
  <div class="apoio-carousel-slider">
    <?php
    $stmt = $conn->query("SELECT * FROM parceiros ORDER BY id_parceiro DESC");
    $parceiros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($parceiros as $p):
        $src = htmlspecialchars($p['imagem']);
        $alt = htmlspecialchars($p['nome']);
    ?>
      <div class="apoio-carousel-slide">
        <img src="<?= $src ?>" alt="<?= $alt ?>">
      </div>
    <?php endforeach; ?>
  </div>
</section>









<!-- DOAÇÃO PÁGINA INICIAL-->
<section class="donation">
  <div class="donation-container">
    <h2 class="donation-title">
      <i class="fa-solid fa-hand-holding-heart animated-icon"></i> Apoie Nossa Causa
    </h2>
    <p class="donation-text">
      Sua doação ajuda a transformar o futuro de centenas de crianças em situação de vulnerabilidade.
      Com o seu apoio, podemos ampliar nosso impacto e oferecer educação, acolhimento e oportunidades reais.
    </p>
   <a href="<?= BASE_URL ?>/doe"><button class="donation" style="padding: 15px 50px;">Quero Doar Agora</button></a>
  </div>
</section>


<script>
  $(document).ready(function() {
    // Slider notícias
    $('.main-ultimas-noticias').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: true,
      dots: true,
      infinite: false,
      autoplay: true,
      autoplaySpeed: 2000,
      prevArrow: `
        <button type="button" class="slick-prev custom-arrow" aria-label="Anterior">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M15 18L9 12L15 6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      `,
      nextArrow: `
        <button type="button" class="slick-next custom-arrow" aria-label="Próximo">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M9 6L15 12L9 18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      `,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });

    // Slider "Quem somos"
    $('.quem-somos-slider').slick({
      centerMode: true,
      centerPadding: '0px',
      slidesToShow: 1,
      arrows: true,
      dots: true,
      autoplay: true,
      autoplaySpeed: 3500,
      prevArrow: `
        <button type="button" class="slick-prev custom-arrow" aria-label="Anterior">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M15 18L9 12L15 6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      `,
      nextArrow: `
        <button type="button" class="slick-next custom-arrow" aria-label="Próximo">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M9 6L15 12L9 18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      `,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            centerPadding: '20px'
          }
        }
      ]
    });

    // Slider Unidades
    $('.unidades-slider').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      dots: true,
      arrows: true,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 1000,
      prevArrow: `
        <button type="button" class="slick-prev custom-arrow" aria-label="Anterior">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M15 18L9 12L15 6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      `,
      nextArrow: `
        <button type="button" class="slick-next custom-arrow" aria-label="Próximo">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M9 6L15 12L9 18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      `,
      responsive: [
        {
          breakpoint: 1024,
          settings: { slidesToShow: 2 }
        },
        {
          breakpoint: 600,
          settings: { slidesToShow: 1 }
        }
      ]
    });

    // Slider Transparência
    $('.transparency-slider').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      infinite: false,
      arrows: false,
      dots: false,
      autoplay: true,
      autoplaySpeed: 1000,
      responsive: [
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });

    // Slider Apoio Carousel
$('.apoio-carousel-slider').slick({
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 5,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 1500, // <- correção aqui: estava "autoplayspeed"
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: false,
        centerPadding: '40px',
        slidesToShow: 4,
      }
    },
    {
      breakpoint: 480,
      settings: {
        centerMode: true,
        centerPadding: '50px',
        slidesToShow: 2,
      }
    }
  ]
});
    // Slider Super Destaques
    $('.slider-super-destaques').slick({
      dots: false,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 5000,
      fade: true,
      speed: 600,
      infinite: true
    });
  });
</script>



<div id="global-modal" class="modal">
  <div class="modal-content">
    <span class="modal-close">&times;</span>
    <div id="modal-body"></div>
  </div>
</div>

</body>
</html>
