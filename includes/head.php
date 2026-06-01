<?php
$title = $title ?? 'Associação Beneficente Evangélica - ABE';
$description = $description ?? 'A Associação Beneficente Evangélica atua há mais de 30 anos no DF, oferecendo apoio social e educação infantil para 1.011 crianças de 0 a 5 anos em situação de vulnerabilidade, com a dedicação de 230 profissionais em seis unidades de ensino.';
$image = $image ?? 'https://site.com/assets/img/og-default.jpg';

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
     . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($title) ?></title>
  <meta name="description" content="<?= htmlspecialchars($description) ?>" />

  <!-- Open Graph -->
  <meta property="og:title" content="<?= htmlspecialchars($title) ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($description) ?>" />
  <meta property="og:image" content="<?= htmlspecialchars($image) ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?= htmlspecialchars($url) ?>" />

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= htmlspecialchars($title) ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($description) ?>" />
  <meta name="twitter:image" content="<?= htmlspecialchars($image) ?>" />

  <!-- Estilos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css" />
  <script type="module" src="<?= BASE_URL ?>/assets/js/main.js"></script>

</head>
