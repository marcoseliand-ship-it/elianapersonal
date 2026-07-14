💪 Eliana Dantas Personal - Sistema de Agendamento de Treinos

Sistema web desenvolvido para gerenciamento de alunos, agendamento de treinos e administração de uma Personal Trainer. O projeto foi criado com foco em organização, produtividade e uma interface moderna, oferecendo uma experiência intuitiva tanto para administradores quanto para alunos.

📸 Demonstração

Em desenvolvimento

Em breve serão adicionadas capturas de tela do sistema.

🚀 Funcionalidades

👩‍💼 Área Administrativa

Login seguro

Dashboard moderno

Cadastro de alunos

Edição de alunos

Exclusão de alunos

Agenda de treinos

Cadastro de treinos

Controle financeiro

Relatórios

Estatísticas em tempo real

Logout seguro

🏋️ Área do Aluno

Login individual

Visualização dos treinos

Agendamento de horários
Consulta da agenda

Perfil do aluno

Histórico de treinos

📊 Dashboard

Total de alunos

Agendamentos do dia

Treinos ativos

Receita mensal

Agenda diária

Últimos alunos cadastrados

Gráficos de evolução

Menu lateral responsivo

🛠 Tecnologias Utilizadas

HTML5

CSS3

JavaScript

PHP 8

MySQL

XAMPP

Chart.js

Font Awesome

Google Fonts

📂 Estrutura do Projeto

elianapersonal/

│── index.php
│── login.php
│── cadastro.php
│── dashboard.php
│── agenda.php
│── README.md


├── css/
│   ├── style.css
│   ├── login.css
│   ├── dashboard.css
│   ├── agenda.css
│   └── cadastro.css


├── js/
│   ├── script.js
│   ├── login.js
│   ├── dashboard.js
│   ├── agenda.js
│   └── cadastro.js


├── php/
│   ├── conectar.php
│   ├── autenticar.php
│   ├── cadastrar.php
│   ├── verificar_login.php
│   ├── logout.php
│   └── salvar_agendamento.php


├── img/


└── banco/

🗄 Banco de Dados

Banco:

eliana_personal

Tabela principal:

usuarios

Campos:

id
nome
email
senha
tipo

⚙️ Como Executar o Projeto

1. Instalar o XAMPP

Ative:

Apache

MySQL

2. Copiar o projeto

Coloque a pasta dentro de:

C:\xampp\htdocs\

3. Criar o banco

Abra:

http://localhost/phpmyadmin

Crie o banco:

eliana_personal

4. Configurar a conexão

Arquivo:

php/conectar.php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "eliana_personal";

5. Executar

Abra:

http://localhost/elianapersonal

ou

http://localhost/elianapersonal/login.php

📋 Funcionalidades Planejadas

Cadastro de exercícios

Planos de treino personalizados

Evolução física

Upload de fotos

Histórico de avaliações

Controle financeiro

Pagamentos

WhatsApp integrado

Notificações automáticas

Envio de e-mails

Exportação em PDF

Calendário inteligente

Tema escuro

Painel responsivo

Backup automático

🎨 Interface

O sistema utiliza um design moderno inspirado em dashboards profissionais, com:

Glassmorphism

Layout responsivo

Sidebar dinâmica

Cards informativos

Ícones Font Awesome

Gráficos interativos

Interface intuitiva

📈 Objetivos do Projeto

Organizar a rotina da Personal Trainer.

Facilitar o agendamento de treinos.

Melhorar o acompanhamento dos alunos.

Centralizar informações em um único sistema.

Proporcionar uma experiência moderna e eficiente.

👨‍💻 Autor

Marcos Eliandro de Lima

Estudante de Sistemas de Informação | Desenvolvedor Full Stack

📄 Licença

Este projeto está licenciado sob a Licença MIT.

Sinta-se à vontade para estudar, utilizar e contribuir com melhorias.

⭐ Se este projeto foi útil para você, deixe uma estrela no repositório!

Esse apoio ajuda na divulgação do projeto e incentiva a evolução contínua do sistema.
