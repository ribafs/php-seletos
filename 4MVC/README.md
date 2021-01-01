# Introdução ao MVC

O MVC é o padrão de arquitetura mais usado na web e é requisito praticamente essencial para qualquer programador.

O MVC (Model View Controller) é um dos padrões de arquitetura mais utilizados atualmente. A maioria dos grandes frameworks e CMS o utilizam para separar o código em camadas lógicas. Cada camada  tem uma resposabilidade. Veja abaixo.

Aqui é até redundante dizer que para os que estão querendo aprender sobre MVC, a experimentação prática dos exemplos é imprescindível, portanto experimente, altere, personalize e teste bastante até entender e ficar satisfeito.

## Model
Representa a letra M do MVC. Nesta camada são realizadas as operações de validação, leitura e escrita de dados no banco de dados. É responsável por salvar e receber dados do banco de dados, como também efetua diversos processamentos com os dados.

Basicamente qualquer coisa para ler, alterar, salvar ou excluir dados é nesta camada. A camada Model é a camada que sofreu a maior transformação na versão 3.

Uma boa prática é trazer para esta camada tudo que diz respeito às regras de negócio, como cálculos ou validações de integridade de dados.

## Controller
É o responsável pela integração entre as camadas Model e View. Basicamente a View irá realizar uma solicitação para o Controller como por exemplo uma coleção de dados ou a solicitação de remover algum item do banco e o Controller, por sua vez, irá enviar a instrução para a camada Model executar.

Controllers

Os controllers correspondem ao ‘C’ no padrão MVC. Após o roteamento ter sido aplicado e o controller correto encontrado, a ação do controller é chamada. Seu controller deve lidar com a interpretação dos dados de uma requisição, certificando-se que os models corretos são chamados e a resposta ou view esperada seja exibida. Os controllers podem ser vistos como intermediários entre a camada Model e View. Você vai querer manter seus controllers magros e seus Models gordos. Isso lhe ajudará a reutilizar seu código e testá-los mais facilmente.

Mais comumente, controllers são usados para gerenciar a lógica de um único model. Por exemplo, se você está construindo um site para uma padaria online, você pode ter um RecipesController e um IngredientsController gerenciando suas receitas e seus ingredientes. No CakePHP, controllers são nomeados de acordo com o model que manipulam. É também absolutamente possível ter controllers que usam mais de um model.

Os controllers fornecem uma série de métodos que são chamados de ações. Ações são métodos em um controller que manipulam requisições. Por padrão, todos os métodos públicos em um controller são ações e acessíveis por urls.

Nesta camada (Controller) também podemos realizar verificações que não se referem às regras de negócio, visto que a boa prática é manter as regras de
negócio no Model.

## View
Representa a letra V do MVC. É a camada responsável por tudo que é visual, páginas, formulários, listagens, menus, o HTML em geral. Tudo aquilo que interage com o usuário deve estar presente nesta camada. Representadas por HTML.

A View não realiza operações diretamente com o banco de dados nem trata diretamente com o Model. Ela as solicita e e exibe através do Controller, que intermedia suas solicitações com o Model.

## URL

### Diferença entre aplicativo comum em PHP e aplicativo com MVC e rotas

Supondo um aplicativo em /var/www/html/cadastro (ou c:\xampp\htdocs\cadastro)

- Comun - Se for um aplicativo comum ele geralmente tem um arquivo index.php no raiz.
- MVC - Se for com MVC, rotas e front controller, no raiz terá apenas um .htaccess apontando para public/index.php. O index, que é o front controller estará na pasta public ou outro nome, com outro .htaccess redirecionando para o index.php ao seu lado.

- Comum - /var/www/html/cadastro/index.php corresponde a http://localhost/cadastro
- MVC - /var/www/html/cadastro corresponde a http://localhost/cadastro

- Comum - Um link para "clients/edit.php" leva para o arquivo edit.php da pasta clients, que está no diretório atual
- MVC - Um link "clients/edit" não aponta para um arquivo, mas sim para o método edit do controller ClientController. Isso é definido no sistema de rotas

Veja que precisamos conhecer o sistema de rotas de um aplicativo para entendê-lo, visto inclusive que a implementação das rotas pode mudar para cada programador. No caso do aplicativo SimplestMVC a rota cria links assim:

- clients/edit

O primeiro representa o controller, mas não com o mesmo nome: no singular, inicial maiúscula e com sufixo Controller: ClientController

Mais detalhes sobre o sistema de rotas so SimplestMVC no arquivo Rotas.md.



## Fluxo das Informações no MVC 
- Geralmente Nascem na View quando um usuário faz uma solicitação, clicando num botão submit ou num link ou entrando um link diretamente no navegador
- Então são recebidos num Router que ativa o devido action/controller
- Daí são enviadas para o Controller, que a filtra (se for o caso) e a envia para o Model
- O Model analisa de acordo com a solicitação (uma consulta ao banco) e a devolve ao Controller
- O Controler por sua vez devolve o resultado para a View
- E a View renderiza o resultado e o mostra para o usuário

Abordagem sobre as 3 camadas: [C]ontroller, [V]iew e [M]odel

Um exemplo bem organizado de uso do MVC é o Framework CakePKP, que traz as 3 camadas bem definidas e organizadas dentro da pasta "src".

De forma mais completa o fluxo das informações entre as 3 camadas acontece assim no CakePHP:
- O usuário clica num link para editar um registro
- O dispatcher (expedidor) verifica a URL requisitada (/cakes/comprar) e redireciona ao controller correto;
- O controller executa a lógica específica da aplicação. Por exemplo, verifica se o Ricardo está logado e tem acesso ao site;
- O controller também usa os models para acessar os dados da sua aplicação. Muitas vezes, os models representam as tabelas do banco de dados, mas podem representar registros LDAP, feeds de RSS ou até mesmo arquivos do sistema. 
- Neste exemplo, o controller usa o model para trazer ao usuário as últimas compras do banco de dados;
- Depois que o controller fez sua mágica sobre os dados, ele repassa para a view. A view faz com que os dados fiquem prontos para a representação do usuário;
- Uma vez que a view tenha usado os dados provenientes do controller para construir a página, o conteúdo é retornado ao browser do usuário.

![](mvc.png)

## Benefícios

Por que usar MVC? Porque é um verdadeiro padrão de projeto (design pattern) e torna fácil a manutenção da sua aplicação, com pacotes modulares de rápido desenvolvimento. Elaborar tarefas divididas entre models, views e controllers faz com que sua aplicação fique leve e independente. Novas funcionalidades são facilmente adicionadas e pode-se dar nova cara nas características antigas num piscar de olhos. O design modular e separado também permite aos desenvolvedores e designers trabalharem simultaneamente, incluindo a habilidade de se construir um rápido protótipo. A separação também permite que os desenvolvedores alterem uma parte da aplicação sem afetar outras.

Se você nunca desenvolveu uma aplicação neste sentido, isso vai lhe agradar muito, mas estamos confiantes que depois de construir sua primeira aplicação em CakePHP, você não vai querer voltar atrás.

## Referências
https://www.youtube.com/watch?v=VInLNcHm8tA&list=PLtxCFY2ITssBl_nihh4HC5-ZlnIPEpVQD - Curso de PHP + MVC grátis em 21 aulas
https://www.youtube.com/watch?v=vvS7JgEcmic - PHP MVC Fácil
https://www.youtube.com/watch?v=GlMZDMyy-jE&list=PLxNM4ef1Bpxiah1JPIqK1mkwi0h20EoQ1 - PHP7 com MVC
https://www.youtube.com/watch?v=2dqI8o6bvjM&list=PLLfNZbkxufIUsLRzQCCGaek4PxQB4RLGe - Curso de MVC com PHP OO
https://phpro.org/tutorials/Model-View-Controller-MVC.html


## Informações Extras

[mvc-aplicativo.md](mvc-aplicativo.md)

[MVC-dicas.md](MVC-dicas.md)

[Padroes.md](Padroes.md)

O MVC - Model View Controller é um padrão de arquitetura que quando bem implementado separa estas 3 camadas num software, tanto em pastas quanto em classes.

O MVC é o padrão de arquitetura mais usado na web e é requisito praticamente essencial para qualquer programador.

Model - manipula os dados, escrita,leitura e validação dos dados. Nele são implementadas as regras de negócios. Regras de negócios são as definições, de como a empresa em questão faz negócios. É a declaração de como a empresa trabalha, todos os processos para execução do serviço, ou entrega do produto com que a empresa trabalha. Exemplo: código específico de um controle de estoque, caixa, etc.
O Controller é a primeira camada que recebe os parâmetros de requisições dos usuários e algumas vezes responde com um response mesmo sem nenhuma interação com as outras duas camadas, decidindo baseado nesta requisição. O controller é quem controla model e view e por conta da segurança a view não deve ir diretamente ao model, mas sempre passar antes pelo con troller. Ela gerência as ações realizadas, fala qual Model e qual View utilizar para que a ação seja completada. 
Interage com o model e envia dados para a view. Cada model está ligado a somente um único controller.
View renderiza a resposta para o usuário recebida do Controller.

Desta forma, alterações feitas no layout não afetam a manipulação de dados, e estes poderão ser reorganizados sem alterar o layout. Então poderemos ter alguns programadores e designers trabalhando em um único projeto sem afetar a área dos outros.

A maior parte dos frameworks em PHP (todos os populares que conheço) e dos CMS (exceto WordPress), todos usam orientação a objetos e MVC.

Aqui é até redundante dizer que para os que estão querendo aprender sobre MVC, a experimentação prática dos exemplos é imprescindível, portanto experimente, altere, personalize e teste bastante até entender e ficar satisfeito.

Fluxo das Informações no MVC

- Geralmente o fluxo começa a ser atentido pelo Controller quando um usuário faz uma requisição, clicando num botão submit ou num link
- Daí o Controller a filtra (se for o caso) e a envia para o Model, ou devolve diretamente ao usuário sem interagir nem com model ou a view
- CAso o model receba solicitação do Controller, analisa de acordo com a solicitação (uma consulta ao banco) e a devolve ao Controller
- O Controler por sua vez devolve o resultado para a View
- E a View renderiza o resultado e o mostra para o usuário

Lembrar que geralmente o usuário está frente a um computador ou celular e o software está num servidor.

Alguns programadores dizem que a implementação do MVC é inadequada para o PHP. Eu fecho os olhos/ouvidos para isso por conta do que sinto na prática, ou seja, eu vejo um software mais organizado e reutilização de código e isso para mim basta.

Criar seu próprio framework aqui não tem a pretensão de oferecer um software que substitua os grandes frameworks atuais, mas de fornecer uma forma de aprendizado sobre o PHP, sobre a orientação a objetos, sobre alguns padrões e sobre o MVC. Assim você ficará mais apto a usar com eficiência os grandes frameworks.

SOLID
S.O.L.I.D: Os 5 princípios da POO

    S — Single Responsiblity Principle (Princípio da responsabilidade única)
    O — Open-Closed Principle (Princípio Aberto-Fechado)
    L — Liskov Substitution Principle (Princípio da substituição de Liskov)
    I — Interface Segregation Principle (Princípio da Segregação da Interface)
    D — Dependency Inversion Principle (Princípio da inversão da dependência)
Bom tutorial sobre uso do SOLID com PHP
https://medium.com/joaorobertopb/o-que-%C3%A9-solid-o-guia-completo-para-voc%C3%AA-entender-os-5-princ%C3%ADpios-da-poo-2b937b3fc530

Front Controller - é o único ponto de entrada para o aplicativo. Podemos usar um .htaccess para redirecionar tudo para este ponto. Um exemplo é ter um diretório public e dentro dele um index.php. Este index.php será nosso FrontController.


