
![Badge](https://img.shields.io/badge/Project-Docker-blue)

<h4 align="center"> 
    :construction:  Projeto em construção  :construction:
</h4>

## Oque sao containers ?

Um pacote de codigo que pode executar uma acao,
ou seja nossos projetos serao executados dentro dos containers que temos.

Containers utilizam imagens para poderem ser executados.

Pega as recomendacoes da imagem( Dockerfile ) e roda isso.

## Imagem

E o projeto que seta executado pelo container, todas as instrucoes estao declaradas nela.

Configurada atraves do arquivo Dockerfile 

#### Instruções:
   
- `FROM`: Imagem base
- `WORKDIR`: diretorio da aplicacao
- `EXPOSE`: Porta da aplicacao
- `COPY`: quais arquivos precisam ser copiados 
    
    Comandos:

        docker build [Diretorio da imagem] : Fazer o build da imagem
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
            OBS: E necessario cria o repositorio no docker-hub antes, e o nome do repositorio devera ter o mesmo nome da imagem 
        docker pull [Imagem] : Atualizar/baixar a imagem

## Containers 

    Comandos:

        docker run -it [Imagem] : Roda a imagem e disponibiliza um terminal para acesso. 
        docker ps -a : Mostra os containers que ja rodaram.
        docker run -d [Imagem]: Roda o container em background  
        docker run -d -p 80:80 [Imagem]: Roda o container na porta 80
        docker stop [Id/Nome] : Parar o container 
        docker start [Id/Nome] : Reiniciar o container
        docker run -d -p 80:80 --name [Nome] [Imagem]: Roda o container na porta 80
        docker logs -f [Id/Nome] : Pegar logs de um container
        docker rm -f [Id/Nome] : Remover container 
        docker run --rm [Id/Nome] : Remove o container quando parar de executar
        docker cp [Fonte] [Destino] : Copiar algo para um container ou ao contrario.
        docker top [Id/Nome] : Verificar informacoes de processamento 
        docker inspect [Id/Nome] : Verificar dados de um container
        docker stats : Verificar processamento dos containers 

## Volume 

* Uma forma pratica de persistir dados em aplicacoes e nao depender de containers para isso
* Todo dado criado por um container e salvo nele, quando o container e removido, perdemos os dados
* Precisamos dos volumes para gerenciar os dados e fazer backups de forma mais simples.

    #### Tipos

    - `Anonimos`: diretorios criados pela flag -v, com um nome aleatorio
    - `Nomeados`: Sao volumes nomeados
    - `Bind mounts`: Uma forma de salvar dados na nossa maquina, sem  o gerenciamento do docker, informamos um diretorio para isso.

    #### Comandos:
        docker run -v /data : Escolher uma pasta para salvar os volumes ( volume anonimo )
        docker volume ls : Ver todos os volumes do ambiente 