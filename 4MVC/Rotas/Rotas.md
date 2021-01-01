# Rotas

## Meu sistema de rotas preferido

Trabalha sozinho, sem precisar ficar adicionando ou removendo novas rotas, pois as identifica pela URL.

Este exemplo de router captura a URL.

Quando estamos na view do aplicativo e ativamos a URL de alguma forma:
- Digitando algo no location do navegador
- Clicamos num dos links: menu, botão novo, editar, excluir

Então o Router recebe a solicitação e verifica:
- Nome do controller
- Nome do action
- parâmetros

Caso a solicitação confira com algum dos controllers, actions e parâmetros:
- Instanciará o controller e o chamará com o action e passará o parâmetro

Caso não exista o controller e/ou o action então.

Chamará o controller de erro e passará a devida mensagem de erro contendo controller e action para orientação do usuário

Tudo isso acontece sem a intervenção do programador, tudo de forma automática.

Tudo que foi dito acima pode ser constatado na prática e/ou no código Router.php.

Gostei muito deste exemplo de router e criei diversas customizações na tentativa tanto de enender quanto de simplificar.
Passei a enender melhor mas simplificar não consegui muito, o exemplo original é mais eficiente. Este Router praticamene é o original.

Tudo partiu deste aplicativo

https://github.com/panique/mini3

Algum código que derivou do mini3:

https://github.com/ribafs/livro-php-fontes/tree/master/MVC/ComBD/mini-framework

https://github.com/ribafs/tutoriais/tree/master/6PHPOO/MVC/mini-mvc7 (última customização)
