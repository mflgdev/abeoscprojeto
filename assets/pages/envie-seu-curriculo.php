<?php include_once __DIR__ . '/../../includes/global.php';
$title = "Trabalhe Conosco - Envie seu Currículo";
$description = "Envie seu currículo para fazer parte do nosso time. Estamos sempre em busca de profissionais dedicados e apaixonados pelo que fazem. Junte-se a nós e ajude a transformar vidas através da educação e do apoio social.";
$image = BASE_URL . "/assets/img/pagina-especifica.jpg";

function limpar($dado) {
  return htmlspecialchars(strip_tags(trim($dado)));
}
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
         strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && is_ajax()) {
  header('Content-Type: application/json; charset=utf-8');
  $nome            = limpar($_POST['nome'] ?? '');
  $email           = limpar($_POST['email'] ?? '');
  $celular         = limpar($_POST['celular'] ?? '');
  $data_nascimento = limpar($_POST['data_nascimento'] ?? '');
  if (!isset($_FILES['curriculo']) || $_FILES['curriculo']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'Erro ao enviar o arquivo.']);
    exit;
  }
  $arquivo_tmp  = $_FILES['curriculo']['tmp_name'];
  $arquivo_nome_original = $_FILES['curriculo']['name'];
  $extensao = strtolower(pathinfo($arquivo_nome_original, PATHINFO_EXTENSION));
  $permitidos = ['pdf', 'doc', 'docx'];
  if (!in_array($extensao, $permitidos)) {
    http_response_code(400);
    echo json_encode(['error' => 'Tipo de arquivo não permitido. Use PDF, DOC ou DOCX.']);
    exit;
  }
  $nome_arquivo_salvo = uniqid("cv_") . "." . $extensao;
  $pasta_upload = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . "/assets/curriculos/";
  if (!is_dir($pasta_upload)) {
    mkdir($pasta_upload, 0755, true);
  }
  $destino = $pasta_upload . $nome_arquivo_salvo;
  if (!move_uploaded_file($arquivo_tmp, $destino)) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao salvar o currículo.']);
    exit;
  }
  $sql = "INSERT INTO curriculos (nome, email, celular, data_nascimento, arquivo_nome)
           VALUES (:nome, :email, :celular, :data_nascimento, :arquivo_nome)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':nome', $nome);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':celular', $celular);
  $stmt->bindParam(':data_nascimento', $data_nascimento);
  $stmt->bindParam(':arquivo_nome', $nome_arquivo_salvo);

  if ($stmt->execute()) {
    echo json_encode(['success' => 'Currículo enviado com sucesso!']);
    exit;
  } else {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao salvar no banco de dados.']);
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <?php include_once __DIR__ . '/../../includes/head.php'; ?>
</head>
<body>
  <main>
    <section class="curriculo-section">
      <div class="curriculo-top-banner">
        <img src="<?= BASE_URL ?>/assets/img/curriculo.jpg" alt="Banner Trabalhe Conosco" />
      </div>
      <div class="curriculo-container">
        <h2>Envie seu Currículo</h2>
        <form id="curriculo-form" method="POST" enctype="multipart/form-data" class="curriculo-form" action="">
          <label for="nome">Nome completo:</label>
          <input type="text" id="nome" name="nome" required />
          <label for="email">E-mail:</label>
          <input type="email" id="email" name="email" required />
          <label for="celular">Celular:</label>
          <input type="tel" id="celular" name="celular" required placeholder="(61) 90000-0000" maxlength="15" />
          <label for="data_nascimento">Data de Nascimento:</label>
          <input type="date" id="data_nascimento" name="data_nascimento" required />
          <label for="curriculo">Anexo do Currículo:</label>
          <div class="custom-file-input">
            <input type="file" id="curriculo" name="curriculo" accept=".pdf,.doc,.docx" required />
            <label for="curriculo" id="file-button">
              <i class="fa-solid fa-paperclip"></i> Selecionar Currículo
            </label>
            <span id="file-name"><i class="fa-regular fa-file-lines"></i> Nenhum arquivo selecionado</span>
          </div>
          <button type="submit"><i class="fa-solid fa-paper-plane"></i> Enviar</button>
        </form>
        <div id="response-message" style="margin-top:20px;"></div>
      </div>
    </section>
  </main>
<script type="module" src="<?= BASE_URL ?>/assets/js/main.js"></script>
<script>
document.getElementById('curriculo').addEventListener('change', function () {
  const fileName = this.files[0]?.name || 'Nenhum arquivo selecionado';
  document.getElementById('file-name').innerHTML = `<i class="fa-regular fa-file-lines"></i> ${fileName}`;
});
document.getElementById('celular').addEventListener('input', function (e) {
    let valor = e.target.value.replace(/\D/g, '');

    if (valor.length > 11) valor = valor.slice(0, 11);

    if (valor.length > 10) {
      valor = valor.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
    } else if (valor.length > 6) {
      valor = valor.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
    } else if (valor.length > 2) {
      valor = valor.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
    } else {
      valor = valor.replace(/^(\d*)/, '($1');
    }
    e.target.value = valor;
  });
document.getElementById('curriculo-form').addEventListener('submit', function(e){
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);
  const responseMessage = document.getElementById('response-message');
  responseMessage.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Enviando...';
  fetch(form.action, {
    method: 'POST',
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if(data.success){
      responseMessage.style.color = 'green';
      responseMessage.textContent = data.success;
      form.reset();
      document.getElementById('file-name').innerHTML = '<i class="fa-regular fa-file-lines"></i> Nenhum arquivo selecionado';
    } else if(data.error){
      responseMessage.style.color = 'red';
      responseMessage.textContent = data.error;
    } else {
      responseMessage.style.color = 'red';
      responseMessage.textContent = 'Erro desconhecido.';
    }
  })
  .catch(() => {
    responseMessage.style.color = 'red';
    responseMessage.textContent = 'Erro na requisição.';
  });
});
</script>
</body>
</html>
