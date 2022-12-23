 
![Badge](https://img.shields.io/badge/Project-Docker-blue)
 
<h4 align="center">
    :construction:  Projeto em construção  :construction:
</h4>
 
## O'Que são containers ?
 
Um pacote de código que pode executar uma ação,
ou seja nossos projetos serão executados dentro dos containers que temos.
 
Containers utilizam imagens para poderem ser executados.
 
Pega as recomendações da imagem( Dockerfile ) e roda isso.
 
## Imagem
 
E o projeto que será executado pelo container, todas as instruções estão declaradas nela.
 
Configurada atraves do arquivo Dockerfile
 
#### Instruções:
   
- `FROM`: Imagem base
- `WORKDIR`: diretório da aplicação
- `EXPOSE`: Porta da aplicacao
- `COPY`: quais arquivos precisam ser copiados
   
    Comandos:
 
        docker build [Diretório da imagem] : Fazer o build da imagem
        docker run [Imagem] : Executar a imagem
        docker image ls : Lista as imagens
        docker pull [Imagem] : Baixar uma imagem
        docker tag [Id] [nome] : Alterar o nome do container
        docker tag [Id] [nome]:[tag] : Alterar o nome e a tag do container
        docker build -t [nome]:[tag] : Criar o container com nome e tag
        docker start -it <id/nome> : Rodar o container de forma interativo
        docker rmi -f [Imagem] : Remover imagem, -f para forçar
        docker system prune : Remover imagens/containers/networks que nao estao sendo utilizadas
        docker login : Logar na conta do docker, para envio de imagens por exemplo
        docker logout : Deslogar
        docker push [Imagem] : Mandar a image para o docker-hub
            OBS: É necessário criar o repositório no docker-hub antes, e o nome do repositório deverá ter o mesmo nome da imagem
        docker pull [Imagem] : Atualizar/baixar a imagem
 
## Containers
 
    Comandos:
 
        docker run -it [Imagem] : Roda a imagem e disponibiliza um terminal para acesso.
        docker ps -a : Mostra os containers que já rodaram.
        docker run -d [Imagem]: Roda o container em background  
        docker run -d -p 80:80 [Imagem]: Roda o container na porta 80
        docker stop [Id/Nome] : Parar o container
        docker start [Id/Nome] : Reiniciar o container
        docker run -d -p 80:80 --name [Nome] [Imagem]: Roda o container na porta 80
        docker logs -f [Id/Nome] : Pegar logs de um container
        docker rm -f [Id/Nome] : Remover container
        docker run --rm [Id/Nome] : Remove o container quando parar de executar
        docker cp [Fonte] [Destino] : Copiar algo para um container ou ao contrario.
        docker top [Id/Nome] : Verificar informações de processamento
        docker inspect [Id/Nome] : Verificar dados de um container
        docker stats : Verificar processamento dos containers
 
## Volume
 
* Uma forma prática de persistir dados em aplicações e nao depender de containers para isso
* Todo dado criado por um container e salvo nele, quando o container é removido, perdemos os dados
* Precisamos dos volumes para gerenciar os dados e fazer backups de forma mais simples.
* Os dados salvos em volumes persistem as remoções de containers
 
    #### Tipos
 
    - `Anonymous`: diretórios criados pela flag -v, com um nome aleatório
    - `Nomeados`: São volumes nomeados
    - `Bind mounts`: Uma forma de salvar dados na nossa máquina, sem  o gerenciamento do docker, informamos um diretor para isso. Ele também serve para atualizar a aplicação em tempo real também.
 
    #### Comandos:
        docker run -v /data : Escolher uma pasta para salvar os volumes ( volume anônimo )
        docker volume ls : Ver todos os volumes do ambiente
        docker run -v [Nome do volume]:/data : Criar volume nomeado, o diretório tem que ser igual ao workdir
        docker run -v /dir/data:/data : bind mounts, salvas os dados na máquina host
        docker volume create [Nome] : Criar um volume com nome
        docker volume inspect [Nome] : Verificar detalhes do volume
        docker volume rm [Nome] : Remover um volume, todos os dados serão removidos
        docker volume prune : Remover todos os volumes que nao estao sendo utilizados
        docker run -v volume:/data:ro : Volume de apenas leitura, RO e a abreviação de read only

## Networks 

* Uma forma de gerenciar a conexão do Docker com outras plataformas ou até mesmo entre containers
* As redes ou networks são criadas separadas do containers, como os volumes
* Existem alguns drivers de redes
* Deixa fácil a comunicação entre containers
 
    #### Tipos de conexão
 
    - `Externa`: Conexão com Api de um servidor remoto
    - `Com Host`: Comunicação com a maquina que está executando o Docker
    - `Entre containers`: Utiliza um driver bridge, permite a comunicação entre dois ou mais containers

    #### Tipos de rede ( Drivers )

    - `Bridge`: o mais comum é default do docker, utilizado quando containers precisam se conectar
    - `Host`: permite a conexão entre um container e a maquina que esta hosteando o Docker
    - `Macvlan`: permite a conexao a um container por um MAC address
    - `None`: remove todas as conexões de rede de um container
    - `Plugins`: Permite extensões de terceiros para criar outras redes
    

    #### Comandos 
 
        docker network ls : listar as redes existentes
        docker network create [nome] : criar uma rede, essa rede seta do tipo bridge
        docker network create -d [Nome driver] [Nome rede] : criar uma rede com um driver específico
        docker network rm [nome] : remover uma rede existente
        docker network prune : Remover todas as redes que não estão sendo utilizadas
        docker run --network [Nome network] : Conectar container a network
        docker network connect [Nome network] [Nome container] : Conectar um container a uma network
        docker network disconnect [Nome network] [Nome container] : Desconectar um container de uma network
        docker network inspect [Nome network] : Exibe detalhes de uma rede


## YAML 

* E uma linguagem de serialização utilizada para criar composes
* Utilizada geralmente para arquivos de configuração
* Extensão do arquivo pode ser yml ou yaml
* O fim de uma linha indica o fim da instrucao, nao ha ponto e vírgula
* A indentação deve conter um ou mais espaços, e nao devemos utilizar tab
* O espaço e obrigatório após a declaração da chave
* Para criar um comentario e utilizado o símbolo #

## COMPOSE

* É uma ferramenta para rodar múltiplos containers
* Teremos uma arquivo de configuração que vai comandar os containers
* É uma forma de rodar múltiplos build e runs com um comando
 
- `version`: Versão do compose
- `services`: Containers/serviços que vão rodar nessa aplicação
- `Volumes`: Possível adição de volumes

    ### Comandos
        docker compose up : Executar o compose