# Criação de um aplicativo com MVC em PHP

Abaixo descrevo o conteúdo do aplicativo
https://github.com/ribafs/mini-framework

O aplicativo acima parte do aplicativo base abaixo
https://github.com/panique/mini3

## Tutorial sobre a criação de um aplicativo em PHP usando MVC e bons recursos

Que na prática é a criação de um framework MVC do "zero".

Inicialmente fiz uma longa pesquisa via google e também perguntei em alguns grandes grupos de PHP internacionais por indicação de tutorial para a criação do meu próprio tutorial. As respostas são divididas, parte defende com paixão que se crie seu próprio framework e parte condena, dizendo que devemos usar os existentes que são muito bons. Alguns até citam estatísticas de que os frameworks atuais atendem a 95% das necessidades (não sei como conseguiram este número). Muitos dos tutoriais e vídeo aulas que encontrei estão desatualizados, uns ainda usando as funções mysql_connect, outros usando o mysqli, outros que não usam o PSR-4 e na maioria que não executa corretamente. Acusa erro. Assim também com os exemplos de pequenos frameworks que encontrei. Resumindo, somente o mini3 realmente executou bem, tem uma estrutura simples que me permitiu entender, usa o PSR-4, o PDO, tem também rotas e em apenas uma classe e .htaccess e não tem nenhuma dependência de pacote de terceiros. Aí a vantagem do software livre e open source, mesmo que não tenha um tutorial detalhado explicando como foi criado o aplicativo, como ele é aberto, se estivermos preparados podemos elaborar este tutorial e é o que irei fazer. Lembrando disso, voltei novamente ao repositório do mini3 e agradeci o autor, clicando na estrela e também fiz um fork novamente, pois havia excluído, para garantir que terei seu código por perto. Também mantive o rodapé do original, onde o autor faz a propaganda de uma hospedagem, pois acho que ele merece que eu faça isso. O grupo que defende a criação do seu próprio framework é muito enfático e me parece lógico, pois se ninguém mais quisesse criar o seu não haveria mais progresso.

Outra sugestão muito apontada é a criação de um aplicativo/framework usando componentes de outros grandes frameworks. Veja que muitos grandes frameworks como Laravel, CakePHP, etc usam componentes do Symfony. Inclusive encontrei um tutorial muito bom, onde o autor ensina a criar seu próprio framework apenas com componentes do Symfony2. Inclusive foi traduzido para o português e está abaixo nas referências. Não senti muita atração por esta alternativa, preferi partir do mini3 e, como o compreendi, vou adicionar minhas classes e outros recursos.

Tutorial de criação de um pequeno aplicativo em PHP com MVC e outros bons recursos. É um aplicativo muito simples e bem documentado, contendo 3 dependências mas todas opcionais. Portando pode ser modificado para atender outras necessidades.

## Recursos do aplicativo:

- Bons padões de codificação
- Convenção para nomes de arquivos, classes, métodos e propriedades, tabelas, campos, etc
- PHPOO com MVC e rotas
- PSR-4 com autoload, namespace e composer
- BootStrap 4
- Opcionais: Migrations com phinx e faker
- Outros recursos podem ser adicionados com certa facilidade, inclusive por programadores iniciantes, pois o código é simples e bem documentado

## Pacotes adicionais opcinais:

- composer require robmorgan/phinx
- composer require fzaninotto/faker
- composer require filp/whoops

## Porque criar seu próprio framework?
Opiniões diversas que encontrei sobre a criação um framework do "zero"

Algo que encontrei "Um desafio para você: da próxima vez que for iniciar um projeto, tente não usar o framework e isto não é uma intriga contra os frameworks, nem uma promoção do pensamento  not-invented-here. Mas hoje, graças a todo o trabalho de autoloading e interoperabilidade feito pelo PHP-FIG (https://www.php-fig.org/), construir sem um framework não significa construir tudo sozinho. Existem muitos pacotes excelentes e interoperáveis de uma ampla gama de frameworks. Juntar tudo é mais fácil do que você pensa!"

Absolutamente, faça o seu próprio se quiser. Não ouça pessimistas. A razão pela qual existem tantos frameworks atualmente para escolher, em primeiro lugar é porque as pessoas ignoraram o mantra cansado de 'não reinventar a roda' e tentaram fazer algo que pensavam ser melhor.

Então, reinvente a roda se você sentir vontade. Você aprenderá muito. E quem sabe, daqui a um ano, seu framework será o que todos estarão usando, em vez de fazer o seu próprio.

Eu não acho que faça sentido criar seu próprio framework completamente do zero com a riqueza de bibliotecas que existem por aí. Eu realmente criei (ou colei) meu próprio framework junto com o uso do Silex como base, adicionei algumas funcionalidades para poder usar yaml para configuração, ser capaz de usar classes como controladores facilmente, capacidade de criar APIs REST padrão com 6 linhas de código do controlador e, em seguida, adicionar um sistema DAL/Active Record completamente personalizado (porque eu não gosto de nenhum dos existentes lá fora). Eu também uso o Monolog para log.

Eu acho que escrever certos componentes do seu framework pode ser garantido, mas não a coisa toda, fazer uso dessas boas bibliotecas de propósito geral de código aberto (muitos dos componentes do Symfony2 podem ser usados ​​sozinhos e o Silex é apenas uma coleção dos principais) .

Tente seguir (e até mesmo definir) seus próprios padrões enquanto constrói a coisa, coloque a fonte em um local público (Github?) E tente fazer com que os outros ofereçam sua ajuda / opinião sobre se a direção da estrutura é boa.

Por que criar seu próprio framework?
Neste ponto, você pode estar se perguntando por que deveria passar pelo problema de criar um framework a partir do zero, quando pode facilmente começar a construir com qualquer uma das dezenas de estruturas pré-existentes: Symfony Framework, Laravel, CodeIgniter, CakePHP, etc…
Na minha opinião, a razão mais forte para criar seu próprio framework a partir do zero é aprender. Ao criar sua própria estrutura, você será forçado a tomar decisões arquitetônicas e estruturais. Quanto mais você se exercita tomando essas decisões, mais se familiarizará com os diferentes padrões de design existentes. Sem mencionar que se você está apenas começando em PHP, este exercício permitirá que você entenda quando usar interfaces, classes abstratas, etc.

O segundo caso mais forte para construir seu próprio framework PHP seria a flexibilidade. Agora, a maioria dos frameworks PHP já é bem flexível, mas como Steve Jobs disse uma vez: “O mundo e tudo ao seu redor foi criado por pessoas que não são mais inteligentes do que você”. Então, se você não está feliz com a maneira como algo funciona, então você pode mudar isso!

Elizabeth Smith diz basicamente a mesma coisa sobre frameworks em um tweet, quando ela disse “Eu acho que todo desenvolvedor PHP deveria escrever um framework - não necessariamente para usar, mas para APRENDER, é incrível como muitos não sabem o básico.” Isso leva para casa Um ponto muito importante: escrever seu próprio framework é uma experiência de aprendizado fabulosa.

Frameworks, usar ou não?
Por Talles Gazel em 27 de abril de 2017

Esse é um assunto muito importante e que ainda levanta muitas dúvidas nas comunidades de desenvolvedores.

Quando o assunto é frameworks sempre surge aquela dúvida, usar ou não?

Particularmente tenho um posicionamento muito bem definido a respeito disso. Acredito que sim, usar framework’s para o desenvolvimento é muito importante. Já que, um framework te oferece uma estrutura muito bem definida e testada para você trabalhar. E com o auxílio de um framework é possível entregar soluções complexas em período de tempo muito menor.

Independentemente do tamanho do sistema recomendo sempre que possível utilizem um framework para desenvolvimento de suas aplicações. Ainda não está convencido sobre uso framework’s? Nas próximas linhas vou listar algumas vantagens para te convencer.

 
## VANTAGENS

QUALIDADE Por utilizar um framework já testado e aprovado, é natural que a qualidade dos seus sistemas também sejam altos. É claro que é de extrema importância saber escolher um framework que já segue estes princípios.

SEGURANÇA Um framework por si só não garante que suas aplicações serão seguras, porém um bom framework oferece recursos que podem garantir a integridade de suas aplicações.

LIBERDADE Um bom framework te dá liberdade para desenvolver suas próprias bibliotecas e pacotes. Um bom framework não é engessado, ele te permite desenvolver as suas próprias bibliotecas.

DOCUMENTAÇÃO Uma das maiores vantagens de se utilizar um framework é a documentação. Normalmente softwares privados são mal documentados, já um bom framework é muito bem documentada.

FÓRUNS E GRUPOS DE DISCUSSÃO Particularmente tenho muito preconceito contra fóruns, porém quando o assunto é framework, minha opinião é outra, já que, em alguns momentos durante o desenvolvimento é natural passar por alguma dificuldade, neste momento basta recorrer ao fórum do framework, que provavelmente alguém também passou pelo mesmo problema e encontrou a solução.

EFICIÊNCIA Quando utiliza um bom framework, é natural que suas aplicações fiquem mais eficientes, mais estáveis e mais organizados. O que torna isso possível é o simples fato de se trabalhar com ótimos padrões de projetos.
------------

## Por que você deseja criar o seu próprio framework?

Em primeiro lugar, porque você gostaria de criar o seu próprio framework? Se você olhar em volta, todos vão dizer que é algo ruim reinventar a roda, e, que é melhor você escolher um framework existente e esquecer completamente de criar o seu próprio. Na maioria das vezes, eles estão certos, mas eu posso pensar em algumas boas razões para você começar a criar o seu próprio framework:
    • Para saber mais sobre a arquitetura de baixo nível dos frameworks web modernos em geral e sobre o funcionamento interno do framework full-stack Symfony2, em particular; 
    • Para criar um framework adequado às suas necessidades muito específicas (não se esqueça de, primeiro, certificar-se que as suas necessidades são realmente muito específicas); 
    • Para experimentar a criação de um framework para se divertir (em uma abordagem “aprender e descartar”); 
    • Para refatorar uma aplicação antiga/existente que precisa de uma boa dose das melhores práticas de desenvolvimento web recentes; 
    • Para provar ao mundo que você realmente pode criar um framework próprio (... mas com pouco esforço). 

## Justificando a Criação deste Aplicativo

Eu tinha poucos conhecimentos de orientação a objetos e MVC, especialmente insuficientes para a criação de um aplicativo completo usando MVC, com pastas separadas e namespace. Então comecei minha peregrinação para chegar a este conhecimento. Me cadastrei em alguns grupos de PHP, alguns em português e outros em inglês (consigo ler razoavelmente em inglês e escrever).  Procurei ajuda nos grupos e também efetuei diversas pesquisas por tutoriais em português e em inglês, por vídeos em português e também exemplos prontos no GitHub.

Durante minha pesquisa muita gente sugeriu a adoção do framework Slim como base,  especialmente na versão 4, que permite adicionar o próprio container. Acontece que eu quero um aplicativo com o qual possa criar CRUDs e o Slim está longe disso e dará mais trabalho para chegar lá, sem contar que para mim o código é complexo. Os grandes frameworks fazem isso e até entendo alguns, como Laravel e CakePHP, mas eu não tenho conhecimento para tirar deles uma estrutura mínima como pretendo. Até criei alguns plugins para o Cake, mas não tenho a disposição para estudar seu código, entender sua estrutura e tirar daí algo simples para meu uso.

Num dos grupos recebi uma resposta interessante. Alguém disse que quando alguém pergunta como criar seu próprio framework é que ainda não está pronto para criar. Faz um certo sentido, mas aí percebi uma lacuna que tentarei preencher. E se eu conseguir descer o nível de conhecimento ao ponto de alcançar quem está próximo disso? Algo como alguém que já atingiu um degrau superior de uma escada e estende a mão para quem está  no degrau imediatamente abaixo.

Uma grande vantagem do software livre e open é que todo o código está na nossa frente. Mas para saber usar, para saber mexer e customizar precisamos conhecer. Caso contrário ser livre e open não irá adiantar muita coisa. Como os programadores focam em criar o código não resta tempo nem interesse em documentar, em criar algo com grande simplicidade. O resultado é que a coisa fica fica num círculo meio fechado, que somente os experts tem acesso. Por favor, sei que estou generalizando e talvez até exagerando, mas estou querendo dizer que existe uma grande lacuna que precisa ser preenchida para que o software livre cresça ainda mais. Não teria sentido aqui criticar colegas que somente criam código, me entenda. Um forte exemplo é o Linus Torvalds que criou o Linux. Já viu a página dele? Eu já vi e há alguns anos eu o critiquei numa lista (alguém sabe o queu é?) me vangloriando de que meu site tinha mais informação do que o dele. Imaturidade da minha parte, pois o fato de ele não ter uma página com muito conteúdo não tira o mérido dele da criação do Linux. Cada um de nós tem um papel em todo o sistema, alguns fazem uma aprte, outros fazem outra. Bem, eu pretendo dar minha contribuição para que este quadro mude, de forma mais democrática.

Pesquisei muito e então decidi usar como ponto de partida o aplicativo mini3, encontrado no GitHub e que consegui fazer funcionar perfeitamente. Este atendeu minhas expectativas e foi  construído para ser simples, bem feito, além de bem documentado, de forma que consegui entender corretamente e efetuar customizações. Deste (mini3 - https://github.com/panique/mini3) eu criei um fork e customizei, chamando de mini-mvc e publiquei no GitHub (https://github.com/ribafs/mini-mvc). Traduzi o README e os comentários, adicionei novos models, controllers e views.

Agora estou partindo do mini-mvc para criar este projeto, que chamei de php-app-mvc (https://github.com/ribafs/php-app-mvc), mas agora procurando detalhar o mesmo e mostrar como foi criado, além de adicionar novos recursos importantes.

Durante a minha pesquisa encontrei uma estatística (não lembro onde) que a grande maioria dos aplicativos criados em PHP não usa framework. Imagino que uma grande contribuição para isso seja por conta de que a maioria dos programadores seja iniciante, mas não somente. Realmente, para muitos projetos não há necessidade nem é adequado o uso de um framework para sua construção, o php sozinho é suficiente, no máximo usando alguns pacotes de terceiros via composer.


## Alguns Padrões de Projeto

Geralmente é uma boa ideia seguir à padrões comuns, pois isso irá fazer com que seu código seja mais fácil de manter e de ser entendido por outros desenvolvedores. São soluções para problemas comuns que encontramos no desenvolvimento ou manutenção de um software orientado a objetos.

Engenheiros de softwares por décadas desenvolveram padrões de projeto para resolver problemas comuns.

A teoria dos padrões de projeto da Microsoft é: "O documento apresenta padrões e os apresenta em um repositório ou catálogo organizado para ajudá-lo a localizar a combinação certa de padrões que resolve seu problema".

Isaac Newton certa vez dissera:
Se cheguei até aqui foi porque me apoiei no ombro de gigantes. 


### Front Controller
O padrão front controller é quando você tem um único ponto de entrada para sua aplicação web, no nosso caso: public/index.php, que trata de todas as requisições. Esse código é mínimo, contendo apenas um require para o src/bootstrap.php, que é responsável por carregar todas as dependências, processar a requisição e enviar a resposta para o navegador. O padrão Front Controller pode ser benéfico pois ele encoraja o desenvolvimento de um código modular e provê um ponto central no código para inserir funcionalidades que deverão ser executadas em todas as requisições (como para higienização de entradas). Assim como também protege nosso código fonte, que fica na pasta src, no caso fica fora do alcance do servidor web.


### Model-View-Controller
O padrão de arquitetura model-view-controller (MVC) e os demais padrões relacionados como HMVC and MVVM permitem que você separe o código em diferentes objetos lógicos que servem para tarefas bastante específicas. Models servem como uma camada de acesso aos dados e esses dados são requisitados e retornados em formatos nos quais possam ser usados no decorrer de sua aplicação. Controllers (Controladores) tratam as requisições, processam os dados retornados dos Models e carregam as Views para enviar a resposta. E as Views são templates de saída (marcação, xml, etc) que são enviadas como resposta ao navegador.

O MVC é o padrão arquitetônico mais comumente utilizado nos populares Frameworks PHP.

http://br.phptherightway.com/pages/Design-Patterns.html 


### Quando usar o padrão de arquitetura MVC

O padrão de arquitetura MVC ajuda-nos a implementar a separação de interesses entre as classes de modelo, visualização e controlador nas aplicações.

A separação de interesses torna fácil testar nossa aplicação, já que a relação entre os diferentes componentes da aplicação é mais clara e coerente. O MVC nos ajuda a implementar uma abordagem de desenvolvimento orientada a testes, na qual implementamos casos de teste automatizados antes de escrevermos o código. Esses casos de teste de unidade nos ajudam a pré-definir e verificar os requisitos de um novo código antes de escrevê-lo.

Se estamos fazendo um aplicativo com bastante estímulo sério no lado do cliente para se recusar a ir junto com o JavaScript sozinho. Se estivermos desenvolvendo um aplicativo que tem um alto desempenho no lado do servidor e um pouco de comunicação no lado do cliente, não devemos usar a arquitetura de padrão MVC; em vez disso, devemos usar uma configuração simples como o modelo de formulário baseado na web. A seguir estão algumas características que nos ajudarão a usar a arquitetura MVC em nosso aplicativo ou não:

- i. Nosso aplicativo precisa de comunicação assíncrona no back-end.
- ii. Nosso aplicativo tem uma funcionalidade que resulta em não recarregar uma página inteira, por exemplo, comentando em um post usando o Facebook ou rolando infinitamente etc.
- iii. Manipulação de dados é principalmente no lado do cliente (navegador), em vez de lado do servidor.
- iv. O mesmo tipo de dados está sendo entregue de maneiras diferentes em uma única página (navegação).
- v. Quando nosso aplicativo possui muitas conexões insignificantes que são usadas para modificar dados (botão, switches).

### Vantagens da arquitetura MVC

- a. A arquitetura MVC nos ajuda a controlar a complexidade do aplicativo dividindo-o em três componentes, ou seja, model, view e controller.
- b. O MVC não usa formulários baseados em servidor, por isso é ideal para desenvolvedores que desejam ter controle total sobre o comportamento de seus aplicativos.
- c. A abordagem de desenvolvimento orientada a teste é suportada pela arquitetura MVC.
- d. O MVC usa o padrão do controlador frontal. O padrão do controlador frontal manipula as diversas solicitações recebidas usando uma única interface (controlador). O controlador frontal fornece controle centralizado. Precisamos configurar apenas um controlador no servidor da web em vez de muitos.
- e. O front controller fornece suporte a comunicações de roteamento avançadas para projetar nosso aplicativo da web.

### Recursos de um framework MVC
À medida que dividimos a lógica de nossa aplicação em três tarefas (lógica de entrada, lógica de negócios, lógica de interface), o teste desses componentes se tornaria mais fácil. A testabilidade é muito rápida e flexível, já que podemos usar qualquer estrutura de teste de unidade compatível com o framework MVC. É uma estrutura extensível e conectável. Podemos projetar os componentes de nossa aplicação de maneira que sejam facilmente substituíveis ou possam ser facilmente modificados. Podemos conectar nosso próprio mecanismo de visualização, estratégia de roteamento de URL, serialização de restrição de método de ação. Em vez de depender da classe para criar objetos, usamos uma técnica de injeção de dependência (DI) que nos permite injetar objetos nas classes. Outra técnica de inversão de controle (IOC) é usada para mostrar dependência entre objetos, especifica qual objeto precisa de outro objeto. O MVC fornece um componente de mapeamento de URL que nos ajuda a construir usando URLs compreensíveis e pesquisáveis. Em vez de usar extensões de nome de arquivo, os padrões de nomenclatura de URL de suporte MVC são muito úteis para o endereçamento de otimização de mecanismo de pesquisa (SEO) e de transferência de estado representacional (REST). Algumas estruturas do MVC, como a ASP.NET MVC, fornecem alguns recursos integrados, como autenticação de formulário, gerenciamento de sessão, lógica de negócios transacional, segurança de aplicativos web, mapeamento relacional de objeto, localização, associação e funções e autorização de URL, etc. as estruturas disponíveis hoje são backbone.js, ember.js; angular.js e knockout.js.

- I. Backbone. O framework Js-Backbone.js é útil quando nossa aplicação precisa de flexibilidade, temos requisitos incertos. Além disso, queremos acomodar a alteração durante o desenvolvimento do aplicativo.
- II. Ember.js- Quando queremos que nosso aplicativo interaja com a API JSON, devemos usar o framework ember.js em nosso aplicativo.
- III Angular.js- Se queremos mais confiabilidade e estabilidade em nosso aplicativo, queremos testes extensivos para nossa aplicação, então devemos usar o framework angular.js.
- IV. Knockout.js - se quisermos criar uma interface dinâmica complexa de aplicativo, o framework knockout.js será muito útil para nós.
Cada estrutura tem suas próprias vantagens e desvantagens. Os desenvolvedores podem usar qualquer um dos frameworks de acordo com seus requisitos, que se adequam ao seu aplicativo da web.

A view não deve ir direto ao model. O controller é mediador/middleware entre V e M.

MVC ajuda DRY.

Ajuda a organizar o código e a torná-lo manutenível.

### Model
A camada model é o backbone do aplicativo e lida com a lógica de dados. Na maioria das vezes,
considera-se que o model é responsável pelas operações CRUD em um banco de dados, que
pode ou não ser verdade. O modelo é responsável pela lógica de dados, o que significa que as operações de validação de dados também podem ser executadas aqui. Em palavras simples, os modelos fornecem uma abstração para os dados. As camadas restantes da aplicação não sabem ou não se importam como e de onde os dados vêm ou como uma operação é realizada em dados. É responsabilidade do modelo cuidar de toda a lógica de dados.

O método seguido é modelos gordos e controllers finos, o que significa manter toda a lógica da aplicação nos modelos e os controladores finos, o quanto possível.

### Controllers
Os controladores respondem às ações executadas por um usuário nas views e respondem a
view. Por exemplo, um usuário preenche um formulário e o submete. Aqui, o controlador vem
no meio e começa a agir sobre a apresentação do formulário. Agora o controlador irá primeiro verificar se o usuário tem permissão para fazer este pedido ou não. 

Em seguida, o controlador executará a ação apropriada, como se comunicar com o modelo ou qualquer outra operação. Em uma analogia simples, o controlador é o meio homem entre vews e models. Como mencionamos antes na seção de modelos, controladores devem ser pequenos. Então, principalmente, controladores são usados ​​apenas para lidar com solicitações e se comunicar com modelos e viws. Todos os tipos de operações de dados são executados em modelos.

O único trabalho do padrão de design MVC é separar as responsabilidades de diferentes partes em um aplicativo. Portanto, os modelos são usados p​para gerenciar os dados do aplicativo. Controladores são usados ​​para realizar ações nas entradas do usuário, e as views são responsáveis ​​pelo visual, pela representação de dados. Como mencionamos anteriormente, o MVC separa as responsabilidades de cada parte, por isso não importa se ele acessa o modelo de controladores ou views; a única coisa que importa é que as views e os controladores não devem ser usados para
executar operações em dados que são de responsabilidade do modelo, e controladores não devem ser usados para visualizar qualquer tipo de dados pelo usuário final, pois este é a responsabilidade da view. 


## Rotas
Roteamento é o que acontece quando uma aplicação determina qual controller e action será executado baseado em uma URL requisitada.

Uma rota é um caminho para acessar um recurso através da composição de uma URL válida.


Exemplo:

O framework recebe a URL http://localhost/users/list.html e executa o controller Users e o action list().

Nós precisamos ser hábeis para processar qualquer rota que não case com as que nós definimos para existentes controllers e actions ou mostrar uma mensagem de erro apropriada.

## Como uma requisição/request é atendida por uma resposta/response:

- A requisição é recebida pela aplicação
- A aplicação quebra a requisição em seus componentes: métodos (GET, POST, etc), host, path, etc.
- A aplicação procura por uma rota definida que case com a requisição
- Logo que encontre ela determina o controller e o action para atendê-la/response


Rotas não semânticas estão desatualizadas. Não existe razão para um usuário ver uma longa cadeia de query strings na URL. URLs assim não são fáceis de memorizar e expoem a configuração do servidor.

Uma classe para roteamento deve ser capaz de distinguir o tipo de HTTP request. Um request tipo GET requisita geralmente o retorno de um ou mais recursos.

O tipo POST cria um novo recurso.
PUP ou PATCH atualiza um existente.
DELETE remove um recurso existente.

### Protocolo HTTP

Ele é responsável por prover uma interface uma interface para a web. Ele permite que ocorra a troca de dados entre um dispositivo cliente e um servidor.

Quando um cliente faz um pedido de uma página (ou qualquer outro recurso) para um servidor que “fala” HTTP, ele está fazendo um Request. O servidor por sua vez tem a habilidade de compreender esse pedido e responder a ele com um Response. Esse ciclo se repete o tempo todo e quando você programa em PHP passa boa parte do tempo fazendo isso acontecer.

A PSR-7 (https://www.php-fig.org/psr/psr-7/) é a especificação de um conjunto de métodos que podem vir a ser usados para gerenciar Requests, Responses, Messages, e etc.

As Messages serão montadas no cliente para compor um Request informando alguns dados, em especial o método (Method) e que as Responses serão criadas no servidor respondendo no mesmo método.

Os métodos HTTP mais comuns são GET e POST.

Quanto mais simples para o desenvolvedor mais popular a ferramenta se torna, mas note que sempre tem um custo simplificar algo.

Mais detalhes em:

https://phpzm.rocks/php-like-a-boss-3-construa-seu-router-e024ea32ee8a 
https://github.com/phpzm/like-a-boss-3 
https://www.taniarascia.com/the-simplest-php-router/ 

## Estrutura de Arquivos e diretórios

Criar o diretório para este aplicativo

app-mvc

Iremos criar a seguinte estrutura de diretórios e arquivos (vazios por enquanto)
```php
/var/www/html/app-mvc
    /src
		/config
		/Controller
		/Core
		/Libs
		/Model
		/view
    /public
    /db
```
Detalhando:
```php
/app-mvc
    /src
		bootstrap.php
        /config/
            config.php
        /Controller/
            CustomersController.php
            ErrorController.php
            HomeController.php  
        /Core/
            Model.php
            Route.php
        /Libs/
            Helper.php
        /Model/
            Customer.php
            Product.php    
        /view/
            /customers
                edit.php
                index.php
            /error
                index.php
            /home
                index.php
            /_templates
                footer.php
                header.php
    /public
        /css
        /images
        /js
        index.php
        .htaccess
composer.json
.htaccess
```

Criação na pasta raiz do aplicativo o composer.json
```json
{
    "name": "ribafs/app-mvc",
    "description": "APP-MVC - an extremely simple naked MVC PHP application",
    "type": "project",
    "license": "MIT",
    "authors": [
        {
            "name": "Panique",
            "email": "panique@firemail.de"
        },
        {
            "name": "John Dias",
            "email": "joaodias@noctus.org"
        },
        {
            "name": "Ribamar FS",
            "email": "ribafs@gmail.com"
        }
    ],
    "minimum-stability": "dev",
    "require": {

    },
    "autoload":
    {
        "psr-4":
        {
            "Mini\\" : "src/"
        }
    }
}
```
Obs.: Veja que mantive os nomes dos autores originais, por gratidão  e por conta da licença.
Neste caso estamos criando o namespace Mini que aponta para a pasta src.

## Criação do .htaccess do raiz

app-mvc/.htaccess
O do raiz do aplicativo redireciona todas as requisições da pasta raiz para a pasta public

Criar o arquivo .htaccess

Contendo as linhas abaixo
```php
# This file is - if you set up MINI correctly - not needed.
# But, for fallback reasons (if you don't route your vhost to /public), it will stay here.
RewriteEngine on
RewriteRule ^(.*) public/$1 [L]
```

Criando a pasta 

public

Dentro desta pasta gravas o arquivo custom.css, que customiza o CSS do BootStrap. Veja abaixo:
```css
.navbar-dark .navbar-nav .nav-link {
    color: #a1e1ed;
}
.center-img {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 20%;
}

.bg-gray{
	background-color: #e8e3e3;
}
```
Também dentro de public tem uma pasta 'images' contendo uma imagem de cabeçalho.

## Criando o index.php dentro de public

Este arquivo é o ponto de entrada do aplicativo/entry point, chamado de front controller. Contendo as linhas abaixo:
```php
<?php

declare(strict_types = 1);

require_once __DIR__ . '/../src/bootstrap.php';
```
Veja que ele inclue o bootstrap

Dentro de public criar mais um .htaccess contendo:
```php
# Necessary to prevent problems when using a controller named "index" and having a root index.php
# more here: http://httpd.apache.org/docs/2.2/content-negotiation.html
Options -MultiViews

# Activates URL rewriting (like myproject.com/controller/action/1/2/3)
RewriteEngine On

# Prevent people from looking directly into folders
Options -Indexes

# If the following conditions are true, then rewrite the URL:
# If the requested filename is not a directory,
RewriteCond %{REQUEST_FILENAME} !-d
# and if the requested filename is not a regular file that exists,
RewriteCond %{REQUEST_FILENAME} !-f
# and if the requested filename is not a symbolic link,
RewriteCond %{REQUEST_FILENAME} !-l
# then rewrite the URL in the following way:
# Take the whole request filename and provide it as the value of a
# "url" query parameter to index.php. Append any query string from
# the original URL as further query parameters (QSA), and stop
# processing this .htaccess file (L).
RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
```

Criar a pasta

app-mvc/src

Dentro dela criar

bootstrap.php

Contendo
```php
<?php

/**
 * This file start the application
 */

/**
 * Now MINI-FRAMEWORK work with namespaces + composer's autoloader (PSR-4)
 *
 * @author Joao Vitor Dias <joaodias@noctus.org>
 *
 * For more info about namespaces plase @see http://php.net/manual/en/language.namespaces.importing.php
 */

// set a constant that holds the project's folder path, like "/var/www/html/mini-fw".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// set a constant that holds the project's 'src' folder, like '/var/www/html/mini-fw/src'.
define('APP', ROOT . 'src' . DIRECTORY_SEPARATOR);

// This is the auto-loader for Composer-dependencies (to load tools into your project).
require_once ROOT . 'vendor/autoload.php';

// load application config (error reporting etc.)
require_once APP . 'config/config.php';

// load application class
use Mini\Core\Router;

// start the application
$app = new Router();
```
Define algumas constantes e inclue os arquivos vendor/autoload.php e config/config.php.
Depois ele cria uma instância de Router().


Vejamos o config.php

Criar a pasta

src/config

E dentro dela criar o arquivo

config.php

Contendo
```php
<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

/**
 * Configuration for: URL
 * Here we auto-detect your applications URL and the potential sub-folder. Works perfectly on most servers and in local
 * development environments (like WAMP, MAMP, etc.). Don't touch this unless you know what you do.
 *
 * URL_PUBLIC_FOLDER:
 * The folder that is visible to public, users will only have access to that folder so nobody can have a look into
 * "/application" or other folder inside your application or call any other .php file than index.php inside "/public".
 *
 * URL_PROTOCOL:
 * The protocol. Don't change unless you know exactly what you do. This defines the protocol part of the URL, in older
 * versions of MINI it was 'http://' for normal HTTP and 'https://' if you have a HTTPS site for sure. Now the
 * protocol-independent '//' is used, which auto-recognized the protocol.
 *
 * URL_DOMAIN:
 * The domain. Don't change unless you know exactly what you do.
 * If your project runs with http and https, change to '//'
 *
 * URL_SUB_FOLDER:
 * The sub-folder. Leave it like it is, even if you don't use a sub-folder (then this will be just "/").
 *
 * URL:
 * The final, auto-detected URL (build via the segments above). If you don't want to use auto-detection,
 * then replace this line with full URL (and sub-folder) and a trailing slash.
 */

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);
// Controller and action defaults - a ser implementado na Router
define('CONTROLLER', array('customers','index'));
define('APP_TITTLE', 'Mini Framework');
define('CONTROLLER_DEFAULT', 'Customers');

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql'); // mysql or pgsql
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'mini-fw');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_PORT', '3306');// 3306 or 5432
define('DB_CHARSET', 'utf8mb4');
```
Define diversas constantes e ao final define as constantes com informações do banco de dados.

Criar os diretórios abaixo:
```php
src/Controller
src/Core
src/Libs
src/Model
src/template
src/View
```

Criaremos o suporte para apenas uma tabela, que é a products.

Criar o arquivo para tratamento de erros

src/Controller/ErrorController.php

Contendo:
```php
<?php

/**
 * Class Error
 *
 */

declare(strict_types = 1);

namespace Mini\Controller;

class ErrorController
{
  
  /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
    public function index($controller = null, $action = null)
    {
        // load views
        require APP . 'template/_templates/header.php';
        require APP . 'template/error/index.php';
        require APP . 'template/_templates/footer.php';
    }
}
```

Criar o arquivo

src/Controller/ProductsController.php

Contendo:
```php
<?php

/**
 * Class ProductsController
 * This is a demo Controller class.
 *
 * If you want, you can use multiple Models or Controllers.
 *
 */

declare(strict_types = 1);

namespace Mini\Controller;
use Mini\Model\ProductsModel;
use Mini\View\ProductsView;

class ProductsController
{

    /**
     * PAGE: index
     * This method handles what happens when you move to http://localhost/mini-fw/products/index
     */
    public function index()
    {
		// View products/index send request to Router, it request ProductsContoller/index, it request model Products/getAllProducts,
		// it response to ProductsContoller/index, it response to View products/index finally
        // Instance new Model (Products)
        $Products = new ProductsModel();
        // getting all products and amount of products to use in view products/index
        $products = $Products->getAllProducts();
        $amount_of_products = $Products->getAmountOfProducts();

       // load views. within the views we can echo out $products and $amount_of_products easily
		$view = new ProductsView();
		$view->index('products','index',$products,$amount_of_products);
    }

    /**
     * ACTION: add
     * This method handles what happens when you move to http://localhost/mini-fw/products/add
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a product" form on product s/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to product s/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function add()
    {
        // if we have POST data to create a new product entry. If button 'submit_add_product' in view products/index has clicked
        if (isset($_POST['submit_add_product'])) {
            // Instance new Model (Products)
            $Products = new ProductsModel();
            // do add() in model/Products.php
            $Products->add($_POST['description'], $_POST['unity'],  $_POST['date']);
	        // where to go after Products has been added
	        header('location: ' . URL . 'products/index');	
        }

        // load views. within the views we can echo out $product easily
		$view = new ProductsView();
		$view->add('products','add');
    }

    /**
     * ACTION: delete
     * This method handles what happens when you move to http://localhost/mini-fw/products/delete
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a product" button on products/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to products/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $product_id Id of the to-delete  product
     */
    public function delete($product_id)
    {
		// View products/index send request to Router, it request ProductsContoller/delete, it request model Products/delete,
		// it response to ProductsContoller/delete, it response/redirect to View products/index finally

        // if we have an id of a product that should be deleted
        if (isset($product_id)) {
            // Instance new Model (Products)
            $Products = new ProductsModel();
            // do delete() in model/model.php
            $Products->delete($product_id);
        }

        // where to go after product has been deleted
        header('location: ' . URL . 'products/index');
    }

     /**
     * ACTION: edit
     * This method handles what happens when you move to http://localhost/mini-fw/products/edit
     * @param int $product_id Id of the to-edit product
     */
    public function edit($product_id)
    {
        // if we have an id of a product that should be edited
        if (isset($product_id)) {
            // Instance new Model (Products)
            $Products = new ProductsModel();
	        $products = $Products->getAllProducts();

            // do getProducts() in model/model.php
            $product = $Products->getProduct($product_id);

            // If the product wasn't found, then it would have returned false, and we need to display the error page
            if ($product === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {
                // load views. within the views we can echo out $product easily
				$view = new ProductsView();
				$view->edit('products','edit',$products, $product);
            }
        } else {
            // redirect user to Products index page (as we don't have a product_id)
            header('location: ' . URL . 'products/index');
        }
    }

    /**
     * ACTION: update
     * This method handles what happens when you move to http://localhost/mini-fw/products/update
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a product" form on products/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to products/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function update()
    {
        // if we have POST data to create a new product entry
        if (isset($_POST['submit_update_product'])) {
            // Instance new Model (Products)
            $Products = new ProductsModel();
            // do update() from model/model.php
            $Products->update($_POST['description'], $_POST['unity'],  $_POST['date'], $_POST['product_id']);
        }

        // where to go after product has been added
        header('location: ' . URL . 'products/index');
    }
}
```

Criar o Model base

Criar

src/Core/Model.php

Contendo:
```php
<?php

declare(strict_types = 1);

namespace Mini\Core;
use PDO;

class Model
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * Whenever model is created, open a database connection.
     */
    function __construct()
    {
        try {
            self::openDatabaseConnection();
        } catch (\PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

		// TODO - Create a singleton classe to Model
        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
		$dsn = DB_TYPE . ':host=' . DB_HOST . ';port ='. DB_PORT . ';dbname=' . DB_NAME;// . $databaseEncodingenc;
        $this->db = new PDO($dsn , DB_USER, DB_PASS, $options);

    }
}
```

Criação da classe Router.php

src/Core/Router.php

Contendo
```php
<?php
/** For more info about namespaces plase @see http://php.net/manual/en/language.namespaces.importing.php */

declare(strict_types = 1);

namespace Mini\Core;

class Router
{
    /** @var null The controller */
    private $urlController = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $urlAction = null;

    /** @var array URL parameters */
    private $urlParams = array();

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        // create array with URL parts in $url
        $this->splitUrl();

        // check for controller: no controller given ? then load start-page
        if (!$this->urlController) {
			// if none controller is found call HomeController with index action
//            $page = new \Mini\Controller\HomeController(); // In mini3
			$controllerDefault = '\\Mini\\Controller\\' . CONTROLLER_DEFAULT . 'Controller';
			$page = new $controllerDefault;
            $page->index();

		// if encounter a controller
        } elseif (file_exists(APP . 'Controller/' . ucfirst($this->urlController) . 'Controller.php')) {
            // here we did check for controller: does such a controller exist ?

            // if so, then load this file and create this controller
            // like \Mini\Controller\CustomersController
            $controller = '\\Mini\\Controller\\' . ucfirst($this->urlController) . 'Controller';
            $this->urlController = new $controller();

            // check for method: does such a method exist in the controller ?
			// if exists method and if is callable method
            if (method_exists($this->urlController, $this->urlAction) && is_callable(array($this->urlController, $this->urlAction))) {
                
				// check if params is d'ont empty
                if (!empty($this->urlParams)) {
                    // if exists Call the method and pass arguments to it
                    call_user_func_array(array($this->urlController, $this->urlAction), $this->urlParams);
                } else {
                    // If no parameters are given, just call the method without parameters, like $this->home->method();
                    $this->urlController->{$this->urlAction}();
                }

			// if none method is found
            } else {
                if (strlen($this->urlAction) == 0) {
                    // no action defined: call the default index() method of a selected controller
                    $this->urlController->index();

				// otherwise fire ErrorController
                } else {
					$action = $this->urlAction;
					$contr = explode('\\',$controller);// Capture ucfirst($this->urlController) in [3]
                    $page = new \Mini\Controller\ErrorController();
                    $page->index($contr[3],$action);
                }
            }

		// if none controller is found fire ErrorController
        } else {
			$controller = $this->urlController;
			$action = $this->urlAction;
            $page = new \Mini\Controller\ErrorController();
//            $page->index($controller,$action);
            $page->index(ucfirst($controller).'Controller',$action);
        }
    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
		// check if url is isset
        if (isset($_GET['url'])) {

            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Put URL parts into according properties
            // By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
            $this->urlController = isset($url[0]) ? $url[0] : null;
            $this->urlAction = isset($url[1]) ? $url[1] : 'index';// era null

            // Remove controller and action from the split URL
            unset($url[0], $url[1]);

            // Rebase array keys and store the URL params
            $this->urlParams = array_values($url);

            // For DEBUGGING uncomment lines below if you have problems with the URL
            // echo 'Controller: ' . ucfirst($this->urlController) . '<br>';
            // echo 'Action: ' . $this->urlAction . '<br>';
            // echo 'Parameters: ' . print_r($this->urlParams, true) . '<br>';
        }
    }
}
```

Criar a classe Helper

src/Libs/Helper.php

Que é o debug para PDO.

Contendo:
```php
<?php

declare(strict_types = 1);

namespace Mini\Libs;

class Helper
{
    /**
     * debugPDO
     *
     * Shows the emulated SQL query in a PDO statement. What it does is just extremely simple, but powerful:
     * It combines the raw query and the placeholders. For sure not really perfect (as PDO is more complex than just
     * combining raw query and arguments), but it does the job.
     *
     * @author Panique
     * @param string $raw_sql
     * @param array $parameters
     * @return string
     */
    static public function debugPDO($raw_sql, $parameters) {

        $keys = array();
        $values = $parameters;

        foreach ($parameters as $key => $value) {

            // check if named parameters (':param') or anonymous parameters ('?') are used
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            // bring parameter into human-readable format
            if (is_string($value)) {
                $values[$key] = ''' . $value . '''; // Before "'"
            } elseif (is_array($value)) {
                $values[$key] = implode(',', $value);
            } elseif (is_null($value)) {
                $values[$key] = 'NULL';
            }
        }

        /*
        echo '<br> [DEBUG] Keys:<pre>';
        print_r($keys);

        echo '<br>[DEBUG] Values: ';
        print_r($values);
        echo '</pre>';
        */
        $raw_sql = preg_replace($keys, $values, $raw_sql, 1, $count);
        return $raw_sql;
    }
}
```php

Criar o model Products

src/Model/ProductsModel.php

Contendo:
```php
<?php

/**
 * Class Products
 * This is a demo Model class.
 *
 */

declare(strict_types = 1);

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Libs\Helper;

class ProductsModel extends Model
{

    /**
     * Get all products from database
     */
    public function getAllProducts()
    {
        $sql = 'SELECT id, description, unity, date FROM products ORDER BY id DESC';
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...

        return $query->fetchAll();
    }

    /**
     * Add a product to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $name Name
     * @param string $email E-amil
     * @param string $birthday Birthday
     */
    public function add($description, $unity, $date)
    {
        $sql = 'INSERT INTO products (description, unity, date) VALUES (:description, :unity, :date)';
        $query = $this->db->prepare($sql);
        $parameters = array(':description' => $description, ':unity' => $unity, ':date' => $date);

        // UNCOMMENT THE LINE BALOW, useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a product in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $product_id Id of  product
     */
    public function delete($product_id)
    {
        $sql = 'DELETE FROM products WHERE id = :product_id';
        $query = $this->db->prepare($sql);
        $parameters = array(':product_id' => $product_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a product from database
     * @param integer $product_id
     */
    public function getProduct($product_id)
    {
        $sql = 'SELECT id, description, unity, date FROM products WHERE id = :product_id LIMIT 1';
        $query = $this->db->prepare($sql);
        $parameters = array(':product_id' => $product_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Update a product in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $name Name
     * @param string $temail E-mail
     * @param string $birthday Birthday
     * @param int $product_id Id
     */
    public function update($description, $unity, $date, $product_id)
    {
        $sql = 'UPDATE products SET description = :description, unity = :unity, date = :date WHERE id = :product_id';
        $query = $this->db->prepare($sql);
        $parameters = array(':description' => $description, ':unity' => $unity, ':date' => $date, ':product_id' => $product_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats".
     */
    public function getAmountOfProducts()
    {
        $sql = 'SELECT COUNT(id) AS amount_of_products FROM products';
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result

        return $query->fetch()->amount_of_products;
    }
}
```php

Criar as pastas 'template' das views
```php
src/template
src/template/error
src/template/products
src/template/_templates
```

Criar

src/template/error/index.php

Contendo:
```html
<br><br>
<div class="container text-danger">
    <h3 align="center">This controller and/or action <b>( <?=$controller.'/'.$action?> )</b> does not exists.</h3>
</div>
<br><br><br><br>
```

Criar:

src/template/products/add.php

Contendo:
```html
<div class="container">
    <h2 class="text-center">Products</h2>
    <!--<b>You are in the View: src/template/products/add.php (everything in this box comes from that file)</b><br>-->
    <!-- add customer form -->
    <div>
        <br>
        <form action="<?php echo URL; ?>products/add" method="POST">   
        <table class="table table-hover table-stripped">
            <tr><td><label>Description</label></td>
            <td><input class="form-control" type="text" name="description" value="" required /></td></tr>
            <td><label>Unity</label></td>
            <td><input class="form-control" type="text" name="unity" value="" required /></td></tr>
            <td><label>Date</label></td>
            <td><input class="form-control" type="date" name="date" value="" /></td></tr>
            <tr><td></td><td><input type="submit" name="submit_add_product" value="Add Product" class="btn btn-primary btn-sm"/></td></tr>
		</table>
        </form>
    </div>
</div>
```
src/template/products/edit.php

Contendo:
```html
<div class="container">
    <h2 class="text-center">Product</h2>
    <!--<h5>You are in the View: src/template/products/edit.php (everything in this box comes from that file)</h5>-->
    <!-- add customer form -->
    <div>
		<br><br>

        <form action="<?php echo URL; ?>products/update" method="POST">   
        <table class="table table-hover table-stripped">
            <tr><td><label>Description</label></td>
            <td><input class="form-control" type="text" name="description" value="<?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>" required autofocus/></td></tr>
            <td><label>Unity</label></td>
            <td><input class="form-control" type="text" name="unity" value="<?php echo htmlspecialchars($product->unity, ENT_QUOTES, 'UTF-8'); ?>" required /></td></tr>
            <td><label>Date</label></td>
            <td><input class="form-control" type="date" name="date" value="<?php echo htmlspecialchars($product->date, ENT_QUOTES, 'UTF-8'); ?>" /></td></tr>
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <tr><td></td><td><input type="submit" name="submit_update_product" value="Update Product" class="btn btn-primary btn-sm"/></td></tr>
		</table>
        </form>
    </div>
</div>
<br><br><br>
```

src/template/products/index.php

Contendo:
```html
<div class="container">
    <h2 class="text-center">Products</h2>
    <!--<b>You are in the View: src/template/products/index.php (everything in this box comes from that file)</b><br>-->
    <!-- main content output -->

	<a class="btn btn-primary btn-sm" href="<?=URL . 'products/add'; ?>">Add Customer</a>

    <div>
        <br>        
        <b>List of products (data from model)</b><div class="text-right"><b>Amount of products: <?php echo $amount_of_products; ?></b></div>
        <table class="table table-hover table-stripped">
            <thead>
            <tr class="bg-gray">
                <td><b>ID</b></td>
                <td><b>Description</b></td>
                <td><b>Unity</b></td>
                <td><b>Date</b></td>
                <td colspan="2" align="center">ACTIONS</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product) { ?>
                <tr>
                    <td><?php if (isset($product->id)) echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($product->description)) echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($product->unity)) echo htmlspecialchars($product->unity, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($product->date)) echo htmlspecialchars($product->date, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'products/delete/' . htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>">Delete</a></td>
                    <td><a href="<?php echo URL . 'products/edit/' . htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>">Edit</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
```

Criar os dois arquivos de includes:

src/template/_templates/header.php

Contendo:
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=APP_TITTLE?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS from BootStrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="<?php echo URL; ?>css/custom.css" rel="stylesheet">                
</head>
<body>
    <div align="center"><h1><?=APP_TITTLE?></h1></div>
	<a href="<?php echo URL; ?>/public/images/mvc.png"><img class="center-img" src="<?php echo URL; ?>/public/images/mvc.png"></a>
	<div class="container">
		<!-- MENU -->
		<nav class="navbar-expand bg-dark navbar-dark">
			<ul class="navbar-nav justify-content-center">
			  <li class="nav-item">
				<a class="nav-link" href="<?php echo URL; ?>customers">Customers</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="<?php echo URL; ?>products">Products</a>
			  </li>
			</ul>
		</nav>
	</div>
```

src/template/_templates/footer.php

Contendo:
```html
<div class="container bg-gray">
    <div align="center">
        Find <a href="https://github.com/panique/mini3">MINI3 on GitHub</a>.
        If you like the mini3 project, support it by <a href="http://tracking.rackspace.com/SH1ES" target="_blank">using Rackspace</a> as your hoster [affiliate link].
    </div>
</div>
</body>
</html>
```

Criar a pasta das views principais

src/View

Criar

src/View/ProductsView.php

Contendo:
```php
<?php
// Used in methods from controllers to views

declare(strict_types = 1);

namespace Mini\View;

class ProductsView{

	public function index($controller, $action, $products, $amount_of_products){

        require APP . 'template/_templates/header.php';
        require APP . 'template/'.$controller.'/'.$action.'.php';
        require APP . 'template/_templates/footer.php';
	}

	public function edit($controller, $action, $products,$product){
        require APP . 'template/_templates/header.php';
        require APP . 'template/'.$controller.'/'.$action.'.php';
        require APP . 'template/_templates/footer.php';
	}

	public function add($controller, $action){

        require APP . 'template/_templates/header.php';
        require APP . 'template/'.$controller.'/'.$action.'.php';
        require APP . 'template/_templates/footer.php';
	}

}
```

Executar o composer

Acessar o raiz do aplicativo e executar:

composer update

ou apenas

commposer dump-autoload


Criar o banco e importar o script abaixo:
```sql
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `unity` varchar(5) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `products` (`id`, `description`, `unity`, `date`) VALUES
(1,	'Constance Doyle',	'W3',	'1989-01-21'),
(2,	'Prof. Marcia Rogahn',	'N3',	'2001-07-11'),
(3,	'Nyah Botsford',	'G3',	'1970-07-04'),
(4,	'Gilbert Kemmer',	'L3',	'1981-02-21'),
(5,	'Annamae Carroll',	'S3',	'1991-10-27'),
(6,	'Mrs. Audra Botsford',	'F3',	'1981-09-12'),
(7,	'Norris Nikolaus',	'J3',	'1981-11-28'),
(8,	'Mr. Zander Crist V',	'P3',	'1986-04-23'),
(9,	'Cheyanne Lowe',	'Y3',	'2007-03-11'),
(10,	'Sid Jacobi',	'T3',	'1985-02-18'),
(11,	'Nikki Hudson IV',	'W3',	'1970-05-22'),
(12,	'Neoma Bahringer',	'U3',	'1971-12-09'),
(13,	'Ms. Ines Ryan',	'L3',	'1996-04-17'),
(14,	'Prof. Citlalli Fadel DVM',	'E3',	'1993-09-02'),
(15,	'Eriberto Lakin',	'D3',	'1971-11-06'),
(16,	'Ms. Marlen Brakus',	'L3',	'2016-10-25'),
(17,	'Kenna Kilback',	'Y3',	'1985-01-31'),
(18,	'Diego Brown',	'V3',	'1982-12-13'),
(19,	'Lambert Harris',	'U3',	'1994-01-12'),
(20,	'Miss Rachelle Kiehn DVM',	'G3',	'1985-06-20');
```

Testar chamando pelo navegador

http://localhost/app-mvc

