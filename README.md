Tecnologia em Análise e Desenvolvimento de Sistemas

Setor de Educação Profissional e Tecnológica - SEPT

Universidade Federal do Paraná - UFPR

---

*DS122 - Desenvolvimento de Aplicações Web 1*

Prof. Alexander Robert Kutzke

# Especificação de Trabalho Prático Web I 2023/2

O trabalho prático envolve a criação de uma aplicação WEB completa. Ou seja,
que inclua a implementação de front-end, back-end e que possua integração com 
um banco de dados.

## Tema

A aplicação deve implementar um jogo de digitação utilizando Javascript e utilizar PHP para armazenar e exibir quadros de pontuação.

O funcionamento é o seguinte:

1. O usuário deve se registrar e se autenticar para acessar o sistema;
2. Uma vez autenticado, o usuário pode jogar partidas de um jogo de digitação;
3. A cada partida, o usuário acumula pontos, exibidos pelo sistema.
4. O usuário pode acessar seu histórico de partidas (e pontuação), bem como diferentes quadros de pontuação (pelo menos geral e ligas)

O jogo de digitação a ser implementado é livre, desde que envolva o princípio básico de digitação correta de palavras. Os jogos [typing.com](https://www.typing.com/student/lesson/333/skill-builder) e [ztype](https://zty.pe/) são bons exemplos desse princípio.

O sistema deve disponibilizar a inscrição do usuário em ligas. Ligas são um conjunto de usuários que competem entre si.
O usuário pode criar e se cadastrar em ligas. Para o cadastro do usuário em uma liga é necessário uma palavra-chave, definida pelo criador da liga.

A pontuação da liga deve ser exibida de duas formas: 1) pontuação desde a criação da liga; e 2) pontuação semanal.

Além da pontuação em suas respectivas ligas, o usuário também pode verificar sua pontuação geral, envolvendo todos os jogadores. Esse quadro também deve apresentar a pontuação desde a criação do sistema e pontuação semanal.

A qualquer momento, o usuário pode acessar um relatório com os dados de todas as partidas jogadas, com suas respectivas pontuações.


## Requisitos

A aplicação desenvolvida deve atender os seguintes requisitos:

 **Front-end**:
  - [x] Uso de HTML5, CSS3 e JS;
  - [x] Interface amigável;
  - [ ] Validação de campos de formulário;
  - [x] Implementação do Jogo de digitação completamente em JS;
      
 **Back-end**:
  - [x] Integração com um banco de dados;
  - [ ] Sistema de autenticação/autorização de usuário(s) salvo(s) em banco de dados;
  - [ ] Validação de campos de formulário e outras informações recebidas.

## Ambiente de Desenvolvimento

* O sistema deve ser desenvolvido utilizando **apenas** os recursos demonstrados
na disciplina DS122 (PHP, Javascript (JQuery), HTML5, CSS3 e algum banco de dados);
  * É permitido o uso de frameworks *front-end*, como Bootstrap e W3.CSS;
  * **Não** é permitido o uso de frameworks *back-end*.

## Entrega

**Datas de entrega e defesa no moodle**.

O trabalho pode ser feito em **grupos de 2 até 4 alunos**.

O código deve ser entregue através do moodle da disciplina, por meio de link para repositório git.

O trabalho deverá ser defendido através de uma rápida demonstração de seu funcionamento e explicação do código.
A defesa é realizada apenas para o professor, não para a turma.

## Documentação

O repositório deverá conter um arquivo chamado `README.md` com a descrição
do sistema e de seu funcionamento. Deve-se utilizar a sintaxe correta da
linguagem **Markdown** nesse documento (para saber mais, consulte: https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet).

## Critério para avaliação

Os critérios para avaliação serão os seguintes:

 * **Defesa e conceitos** [3 pontos]:
    * Estrutura e clareza do código [1 ponto]
    * Qualidade da defesa [1 ponto];
    * Domínio do código [1 ponto];

 * **Funcionalidades e implementação** [7 pontos]:
    * Qualidade da interface do usuário [1 ponto];
    * Funcionamento do Jogo de digitação [3 ponto];
    * Funcionamento da aplicação back-end [3 pontos];

**Atenção**: em nenhuma hipótese serão aceitos trabalhos com qualquer traço de plágio. A identificação de plágio implica em nota zero a todos os integrantes do grupo.
