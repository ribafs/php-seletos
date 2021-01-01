# Fluxo das informações no mvc-9

Tudo começa assim

- .htaccess

- public/index.php 
    - inclui o autoload e o config.php
    - Então instancia o Router

- Core/Router.php
    - Aqui encaminha por padrão paraa o ClientController, action index(). 

- No ClientController/index()
    - Recebe os clientes do ClientModel e os passa para a view clients/index

- A view clients/index:
    - Mostra a listagem de clients, com um form para adicionar um novo cliente e links para editar ou excluir cada cliente

- Na view clients/index, poderá clicar para ir ao products

- Adicionar um novo cliente
    - Estando em clients/index.php preencher os dados e clicar em Adicionar
    - Ele vai ao ClientController/add
    - Recebendo os dados o ClientController verifica se foi clicado no botão com name submit_add_client
    - Se sim ele instancia o ClientModel e passa para seu método add o nome e a idade recebidos
    - O ClientModel executa a consulta do seu método add
    - Então o ClientController redireciona de volta para a view clients/index

- Editar registro
    - Estando em clients/index, clicar no link Editar do registro delejado
    - Será enviado para ClientController/edit

    - O controller verifica se o id tá setado
    - Se sim ele instancia o ClientModel
    - Então chama o método edit do model passando para ele o id recebido da view

    - O model executa a consulta e devolve/return o resultado para o ClientController

    - p ClientController verifica se o queu foi retornado do model é válido.
    - Se não dispara o ErrorController

    - Se for válido o retorno do model, então chama a view clients/edit passando para ela o que recebeu do model
    - A clients/edit é aberta com o registro num form para edição.
    - Após efetuar alterações e clicar em Atualizar será enviado para o ClientController/update

    - Então o update verifica se as informações estão vindo do form com submit com name "submit_update_client" e via POST
    - Se sim ele instancia o ClientModel e passa os valores recebidos para o método update do model

- clients/index.php - por default este é o arquivo mostrado quando chamamos: http://localhost/mvc-9


