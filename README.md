# 🏋️‍♂️ Eliana Dantas Personal

Este é um sistema de gerenciamento e dashboard web desenvolvido para personal trainers, focado no controle de alunos, planos e agendamentos de treinos. O sistema foi projetado para ser responsivo, intuitivo e facilitar o dia a dia da gestão de clientes.

---

## 🚀 Funcionalidades

* **Autenticação Segura:** Proteção de páginas via sessão (`session_start`).
* **Métricas em Tempo Real:** Indicadores visuais com o total de alunos e agendamentos ativos.
* **Gestão de Alunos:**
    * Cadastro rápido de novos alunos (Nome, E-mail, Telefone, Plano e Status).
    * Listagem dos últimos 10 alunos cadastrados.
    * Opções para editar e excluir registros.
* **Agenda de Treinos:** Exibição dos próximos 5 agendamentos ordenados por data e horário.
* **Interface Moderna:** Layout limpo criado com CSS Grid/Flexbox, tipografia Google Fonts (Poppins) e ícones Font Awesome.

---

## 🛠️ Tecnologias Utilizadas

* **Back-end:** PHP (com extensão MySQLi)
* **Front-end:** HTML5, CSS3 (Customizado/Responsivo)
* **Banco de Dados:** MySQL
* **Ícones e Fontes:** Font Awesome 6.6.0 / Google Fonts (Poppins)

---

## 📂 Estrutura de Pastas Sugerida

Para o correto funcionamento dos caminhos descritos no código (`../PHP/` e `../CSS/`), certifique-se de organizar o projeto da seguinte forma:

```text
├── CSS/
│   └── dashboard.css
├── PHP/
│   ├── conectar.php
│   ├── salvar_aluno.php
│   └── excluir_aluno.php
└── views/ (ou pasta principal)
    ├── dashboard.php  <-- (Este arquivo)
    ├── agenda.php
    ├── login.php
    └── logout.php


