<?php include_once __DIR__ . '/../../includes/global.php';
$title = "Veja todas nossas notícias";
$description = "Fique por dentro das últimas notícias, eventos e atualizações da nossa organização. Acompanhe nossas iniciativas e o impacto positivo que estamos fazendo na comunidade.";
$image = BASE_URL . "/assets/img/pagina-especifica.jpg";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM noticias WHERE id_noticia = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT); 
    $stmt->execute();

    $noticia = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$noticia) {
        echo "<p>Notícia não encontrada.</p>";
        exit;
    }

$imagem_noticia = $noticia['imagem_noticia'] ?: 'noticia.jpg';

if (strpos($imagem_noticia, '/') === 0 || strpos($imagem_noticia, 'http') === 0) {
    $caminho_imagem = $imagem_noticia;
} else {
    $caminho_imagem = '/assets/noticias/img_capa/' . $imagem_noticia;
}
    ?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($noticia['titulo']) ?> | Associação Beneficente Evangélica</title>
  <meta name="description" content="<?= htmlspecialchars(mb_strimwidth(strip_tags($noticia['conteudo']), 0, 160, '...')) ?>" />
  
  <meta property="og:title" content="<?= htmlspecialchars($noticia['titulo']) ?>" />
  <meta property="og:description" content="<?= htmlspecialchars(mb_strimwidth(strip_tags($noticia['conteudo']), 0, 160, '...')) ?>" />
  <meta property="og:image" content="<?= BASE_URL . $caminho_imagem ?>" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="<?= BASE_URL . '/noticias/' . $noticia['id_noticia'] ?>" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= htmlspecialchars($noticia['titulo']) ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars(mb_strimwidth(strip_tags($noticia['conteudo']), 0, 160, '...')) ?>" />
  <meta name="twitter:image" content="<?= BASE_URL . $caminho_imagem ?>" />

  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css" />
</head>
    <body class="pagina-noticia-detalhada">
      <main class="noticia-detalhada" style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <h1><?= htmlspecialchars($noticia['titulo']) ?></h1>
        <p style="color: gray;"><i class="fa-regular fa-calendar"></i> <?= mb_convert_case(strftime('%d %b %Y', strtotime($noticia['data_publicacao'])), MB_CASE_TITLE, "UTF-8") ?></p>
        <img src="<?= $caminho_imagem ?>" alt="<?= htmlspecialchars($noticia['titulo']) ?>" style="max-width:100%; height:auto; margin: 20px 0;">
        <div class="conteudo-noticia">
           <?= $noticia['conteudo'] ?>
        </div>
        <a href="<?= $baseURL ?>/noticias" style="display:inline-block; margin-top:20px;">&larr; Voltar para notícias</a>
      </main>
      <script type="module" src="<?= $baseURL ?>/assets/js/script.js"></script>
    </body>
    </html>
    <?php
    exit;
}

$limite = 6;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($pagina < 1) $pagina = 1;
$offset = ($pagina - 1) * $limite;
$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';
$where = "";
$params = [];
if ($busca !== '') {
    $where = " WHERE titulo LIKE :busca OR conteudo LIKE :busca ";
    $params[':busca'] = "%$busca%";
}
$totalQuery = "SELECT COUNT(*) as total FROM noticias $where";
$stmtTotal = $conn->prepare($totalQuery);
$stmtTotal->execute($params);
$totalNoticias = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];
$totalPaginas = ceil($totalNoticias / $limite);
$sql = "SELECT id_noticia, titulo, imagem_noticia, conteudo, data_publicacao, id_unidade
        FROM noticias
        $where
        ORDER BY data_publicacao DESC
        LIMIT :limite OFFSET :offset";

$stmt = $conn->prepare($sql);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="br-pt">
<head>
  <?php include_once __DIR__ . '/../../includes/head.php'; ?>
</head>
<body class="pagina-noticias">
  <main>
    <section class="noticias ultimas-noticias">
      <div class="section-header">
        <h2 class="section-title">
          <i class="fa-regular fa-newspaper"></i> Últimas Notícias
        </h2>

        <!-- Formulário de busca -->
        <form method="GET" action="" class="search-bar" style="display:flex; align-items:center; gap:8px;">
          <i class="fas fa-search"></i>
          <input 
            type="text" 
            name="busca" 
            placeholder="Buscar notícias..." 
            id="busca-noticia" 
            value="<?= htmlspecialchars($busca) ?>" 
          />
        </form>
      </div>

      <div class="tag-filters">
        <span class="tag" onclick="filtrarPorTag('educacao')">Educação</span>
        <span class="tag" onclick="filtrarPorTag('esporte')">Esporte</span>
        <span class="tag" onclick="filtrarPorTag('cultura')">Cultura</span>
        <span class="tag" onclick="filtrarPorTag('eventos')">Eventos</span>
      </div>

<div class="main-ultimas-noticias" style="justify-content: start;">
  <?php
  if ($stmt->rowCount() > 0) {
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $imagem_noticia = $row['imagem_noticia'];

    if (empty($imagem_noticia)) {
        $imagem_noticia = '/assets/noticias/img_capa/noticia.jpg'; // imagem padrão
    } elseif (!preg_match('#^(/|http)#', $imagem_noticia)) {
        $imagem_noticia = '/assets/noticias/img_capa/' . $imagem_noticia;
    }

          ?>
        <a href="<?= $baseURL ?>/noticias/<?= $row['id_noticia'] ?>" class="news-card" style="text-decoration: none; color: inherit;">
            <img src="<?= htmlspecialchars($imagem_noticia) ?>" alt="<?= htmlspecialchars($row['titulo']) ?>" />
            <div class="card-content">
                <h3><?= mb_strimwidth($row['titulo'], 0, 31, '...') ?></h3>
                <p><?= htmlspecialchars(substr(strip_tags($row['conteudo']), 0, 100)) ?>...</p>
                <div class="news-meta">
                    <span><i class="fa-regular fa-calendar"></i> <?= mb_convert_case(strftime('%d %b %Y', strtotime($row['data_publicacao'])), MB_CASE_TITLE, "UTF-8") ?></span>
                    <span><i class="fa-solid fa-location-dot"></i> São Paulo, SP</span>
                </div>
            </div>
        </a>
          <?php
      }
  } else {
      echo "<p>Nenhuma notícia encontrada.</p>";
  }
  ?>
</div>

      <!-- Paginação -->
      <div class="paginacao" style="text-align:center; margin-top: 30px;">
        <?php
        $queryParams = $_GET;
        unset($queryParams['pagina']);

        if ($totalPaginas > 1):
            for ($i = 1; $i <= $totalPaginas; $i++):
                $queryParams['pagina'] = $i;
                $url = '?' . http_build_query($queryParams);
        ?>
            <a href="<?= $url ?>" class="<?= ($i == $pagina) ? 'ativa' : '' ?>"
               style="
                 margin: 0 5px; 
                 padding: 8px 12px; 
                 background-color: <?= ($i == $pagina) ? '#333' : '#f0f0f0' ?>; 
                 color: <?= ($i == $pagina) ? '#fff' : '#333' ?>; 
                 text-decoration: none; 
                 border-radius: 4px;
               ">
               <?= $i ?>
            </a>
        <?php
            endfor;
        endif;
        ?>
      </div>
    </section>
  </main>

  <script type="module" src="<?= BASE_URL ?>/assets/js/main.js"></script>
  <script>
    function filtrarPorTag(tag) {
    const inputBusca = document.getElementById('busca-noticia');
    inputBusca.value = tag;

    const tags = document.querySelectorAll('.tag-filters .tag');
    tags.forEach(el => {
      el.classList.toggle('active', el.textContent.toLowerCase() === tag.toLowerCase());
    });
    inputBusca.form.submit();
    }
  </script>

  <!-- Slick slider CDN (JS e CSS) -->
  <link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
  />
  <script
    type="text/javascript"
    src="https://code.jquery.com/jquery-3.6.0.min.js"
  ></script>
  <script
    type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
  ></script>

  <div id="global-modal" class="modal">
    <div class="modal-content">
      <span class="modal-close">&times;</span>
      <div id="modal-body"></div>
    </div>
  </div>

</body>
</html>
