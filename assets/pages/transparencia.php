<?php include_once __DIR__ . '/../../includes/global.php';
$title = "Portal da Transparência - ABE";
$description = "Acesse nosso Portal da Transparência para conferir relatórios financeiros, auditorias e informações detalhadas sobre a gestão da Associação Beneficente Evangélica. Transparência e responsabilidade são pilares fundamentais do nosso trabalho.";
$image = BASE_URL . "/assets/img/pagina-especifica.jpg";

$query_banners = "SELECT * FROM banners ORDER BY id ASC";
$stmt_banners = $conn->prepare($query_banners);
$stmt_banners->execute();
$banners = $stmt_banners->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="br-pt">
<head>
  <?php include_once __DIR__ . '/../../includes/head.php';?>
</head>
<body>
<main>
  <div class="container">
    <?php foreach ($banners as $banner): ?>
      <?php 
        // Fallback imagem
        $bgImage = !empty($banner['imagem']) ? $banner['imagem'] : 'https://picsum.photos/1200/300'; 
      ?>
      <div 
        class="banner" 
        style="background-image: url('<?= htmlspecialchars($bgImage) ?>');"
      >
        <h2><?= htmlspecialchars($banner['titulo']) ?></h2>
      </div>
      <?php
        $stmt_accordions = $conn->prepare("SELECT * FROM acordeoes WHERE banner_id = :id ORDER BY id ASC");
        $stmt_accordions->execute([':id' => $banner['id']]);
        $accordions = $stmt_accordions->fetchAll(PDO::FETCH_ASSOC);
        foreach ($accordions as $accordion): ?>
          <div class="accordion">
            <div class="accordion-header">
              <?= htmlspecialchars($accordion['titulo']) ?>
              <i class="fas fa-chevron-down"></i>
            </div>
            <div class="accordion-content">
              <ul>
                <?php
                $stmt_items = $conn->prepare("SELECT * FROM itens WHERE acordeao_id = :id ORDER BY id ASC");
                $stmt_items->execute([':id' => $accordion['id']]);
                foreach ($stmt_items->fetchAll(PDO::FETCH_ASSOC) as $item): ?>
                  <li>
                    <a href="<?= htmlspecialchars($item['link']) ?>" target="_blank" rel="noopener noreferrer">
                      <?= htmlspecialchars($item['titulo']) ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
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
