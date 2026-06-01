<nav class="navbar">
  <div class="logo"><a href="<?= BASE_URL ?>/"></li>LOGO<span> AQUI</span></a></div>

  <div class="menu-toggle" id="menu-toggle" aria-label="Menu Toggle" role="button" tabindex="0">
    <span></span>
    <span></span>
    <span></span>
  </div>

  <ul class="nav-links" id="nav-links">
    <li><a href="<?= BASE_URL ?>/quem-somos">Quem Somos</a></li>
    <li><a href="<?= BASE_URL ?>/transparencia">Transparência</a></li>
    <li class="dropdown">
      <a href="#">Unidades</a>
      <ul class="dropdown-menu">
        <?php
          $stmt = $conn->query("SELECT nome, slug FROM unidades ORDER BY nome ASC");
          $unidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

          foreach ($unidades as $unidade):
        ?>
          <li>
            <a href="<?= BASE_URL ?>/unidade/<?= htmlspecialchars($unidade['slug']) ?>">
              <?= htmlspecialchars($unidade['nome']) ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </li>
    <li><a href="<?= BASE_URL ?>/noticias">Notícias</a></li>
    <li><a href="<?= BASE_URL ?>/">Projetos</a></li>
    <li><a href="<?= BASE_URL ?>/doe">Doe</a></li>
    <li><a href="<?= BASE_URL ?>/envie-seu-curriculo">Envie seu Currículo</a></li>
  </ul>
</nav>
