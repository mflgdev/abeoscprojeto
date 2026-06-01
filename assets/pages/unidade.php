<?php include_once __DIR__ . '/../../includes/global.php';
$title = "Unidades - Associação Beneficente Evangélica ABE";
$description = "Conheça nossas unidades de ensino infantil e apoio social. A ABE oferece educação de qualidade para crianças de 0 a 5 anos em situação de vulnerabilidade, com dedicação e carinho em cada uma de nossas seis unidades espalhadas pelo DF.";
$image = BASE_URL . "/assets/img/pagina-especifica.jpg";

$slug = $_GET['slug'] ?? '';
if (!$slug) {
    echo "Unidade não encontrada.";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM unidades WHERE slug = ?");
$stmt->execute([$slug]);
$unidade = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$unidade) {
    echo "Unidade não encontrada.";
    exit;
}
$title = $unidade['nome'] . " — Unidade | Associação Beneficente Evangélica ABE";
$description = mb_strimwidth(strip_tags($unidade['descricao']), 0, 160, '...');
$image = !empty($unidade['imagem']) 
         ? BASE_URL . $unidade['imagem']
         : BASE_URL . "/assets/img/padrao-unidade.jpg";
$url = BASE_URL . "/unidade/" . $slug;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($title) ?></title>
  <meta name="description" content="<?= htmlspecialchars($description) ?>" />

  <meta property="og:title" content="<?= htmlspecialchars($title) ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($description) ?>" />
  <meta property="og:image" content="<?= $image ?>" />
  <meta property="og:url" content="<?= $url ?>" />
  <meta property="og:type" content="website" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= htmlspecialchars($title) ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($description) ?>" />
  <meta name="twitter:image" content="<?= $image ?>" />

  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css" />
</head>
<body>
  <main id="unidade-container" role="main">
    <section id="unidade-header" aria-label="Informações principais da unidade">
      <?php if (!empty($unidade['imagem'])): ?>
        <img src="<?= htmlspecialchars($unidade['imagem']) ?>" alt="Imagem da unidade <?= htmlspecialchars($unidade['nome']) ?>" loading="lazy" />
      <?php endif; ?>
      <div id="unidade-header-info">
        <h1><?= htmlspecialchars($unidade['nome']) ?></h1>
        <?php if (!empty($unidade['endereco'])): ?>
          <div class="unidade-info-item"><span>Endereço:</span><?= htmlspecialchars($unidade['endereco']) ?></div>
        <?php endif; ?>
        <?php if (!empty($unidade['telefone'])): ?>
          <div class="unidade-info-item"><span>Telefone:</span><?= htmlspecialchars($unidade['telefone']) ?></div>
        <?php endif; ?>
        <?php if (!empty($unidade['horario_funcionamento'])): ?>
          <div class="unidade-info-item"><span>Horário:</span><?= htmlspecialchars($unidade['horario_funcionamento']) ?></div>
        <?php endif; ?>
      </div>
    </section>

    <?php if (!empty($unidade['descricao'])): ?>
      <article id="unidade-descricao" aria-label="Descrição detalhada da unidade">
        <?= $unidade['descricao'] ?>
      </article>
    <?php endif; ?>

    <?php if (!empty($unidade['embed_google_maps'])): ?>
      <section id="unidade-mapa" aria-label="Localização no mapa">
        <?= $unidade['embed_google_maps'] ?>
      </section>
    <?php endif; ?>
  </main>
</body>
</html>