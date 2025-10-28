# Hotel Curso

# Sistema de Gerenciamento de Hotel

Este projeto é um sistema web para gerenciamento de reservas e quartos de hotel, desenvolvido em PHP seguindo o padrão MVC (Model-View-Controller).

## Funcionalidades

- Cadastro, edição e exclusão de reservas
- Gerenciamento de quartos (criação, edição, exclusão)
- Listagem de reservas e quartos
- Modais de feedback para ações de CRUD
- Autenticação de administrador (com senha mestre)
- Proteção de rotas por sessão
- Newsletter (front-end)

## Arquitetura

O projeto segue o padrão MVC:

- **Models**: Lógica de acesso a dados (`models/`)
- **Controllers**: Lógica de negócio e manipulação de dados (`controllers/`)
- **Views**: Exibição de dados e interface do usuário (`views/`)
- **Routes**: Arquivos de roteamento para endpoints (`routes/`)
- **Config**: Configurações e autoload (`config/`)
- **Assets**: CSS, JS e imagens (`assets/`)

## Estrutura de Pastas

```
projeto-hotel/
├── assets/
│   ├── css/
│   ├── images/
│   └── js/
│       ├── modules/
│       ├── services/
│       └── utils/
├── config/
│   ├── conexao.php
│   └── autoload.php
├── controllers/
│   ├── reserva-controller.php
│   └── room-controller.php
├── database/
│   └── create_db.php
├── models/
│   ├── quarto.php
│   └── reserva.php
│   
├── routes/
│   ├── quarto-routes.php
│   └── reserva-routes.php
├── views/
│   ├── includes/
│   ├── reservas/
│   └── login.php
├── index.php
└── README.md
```

## Como rodar o projeto

1. Clone o repositório e coloque na pasta do seu servidor local (ex: `htdocs` do XAMPP)
2. Crie o banco de dados executando o script em `database/create_db.php`
3. Configure o acesso ao banco em `config/conexao.php`
4. Acesse `index.php` pelo navegador

## Observações

- O projeto utiliza Bootstrap para o front-end
- O autoload de classes está em `config/autoload.php`
- Todas as regras de negócio e SQL estão centralizadas nos controllers e models
- As views não possuem lógica de negócio, apenas exibição

---
