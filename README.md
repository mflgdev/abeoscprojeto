# README.md

````md
# Site Institucional

Site institucional desenvolvido com foco em performance, organização modular, responsividade e facilidade de gerenciamento.

## ✨ Sobre o projeto

Este projeto foi criado para oferecer uma estrutura moderna e escalável para sites institucionais, utilizando uma arquitetura simples e organizada em PHP.

O sistema conta com:

- Estrutura modular
- Layout responsivo
- SEO otimizado
- Sistema de includes reutilizáveis
- Organização de assets
- Navegação dinâmica
- Estrutura preparada para expansão
- Compatibilidade com hospedagens compartilhadas

## 🚀 Tecnologias utilizadas

- PHP
- HTML5
- CSS3
- JavaScript
- jQuery

## 📁 Estrutura do projeto

```bash
/assets       → Arquivos CSS, JS, imagens e recursos visuais
/includes     → Arquivos reutilizáveis e configurações
/index.php    → Página principal
/navbar.php   → Navegação do site
/footer.php   → Rodapé do site
````

## 🎨 Recursos

* Design moderno
* Estrutura leve
* Fácil manutenção
* Organização de componentes
* Estrutura preparada para SEO
* Compatível com dispositivos móveis

## 🔒 Observações

Alguns arquivos e pastas foram ignorados no Git por conterem:

* Uploads de imagens
* Fotos internas
* Conteúdo dinâmico
* Notícias e mídias
* Arquivos locais de ambiente

## 👨‍💻 Autor

Desenvolvido por Mateus Gonçalves.

````

---

# .gitignore

```gitignore
# Dependências
/vendor/
/node_modules/

# Ambiente
.env
.env.local
.env.production

# Logs
*.log
npm-debug.log*
yarn-debug.log*

# Sistema
.DS_Store
Thumbs.db

# IDE
.vscode/
.idea/

# Uploads gerais
uploads/
public/uploads/
public_uploads/

# Fotos da creche
assets/img/creche/
assets/images/creche/
assets/uploads/creche/

# Notícias
assets/img/noticias/
assets/images/noticias/
assets/uploads/noticias/
noticias/uploads/
news/uploads/

# Cache
/cache/
/tmp/

# Arquivos compactados
*.zip
*.rar
````
