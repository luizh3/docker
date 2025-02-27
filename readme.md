 
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
        docker system prune : Remover imagens/containers/networks que não estao sendo utilizadas
        docker login : Logar na conta do docker, para envio de imagens por exemplo
        docker logout : Deslogar
        docker push [Imagem] : Mandar a image para o docker-hub
            OBS: É necessário criar o repositório no docker-hub antes, e o nome do repositório deverá ter o mesmo nome da imagem
        docker pull [Imagem] : Atualizar/baixar a imagem
 
## Containers
 
    Comandos:
        docker kill $( docker ps -q ) : Parar todos os containers
        docker rm $(docker ps -a -q) : Remover todos os containers
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
 
* Uma forma prática de persistir dados em aplicações e não depender de containers para isso
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
        docker volume prune : Remover todos os volumes que não estao sendo utilizados
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
* O fim de uma linha indica o fim da instrucao, não ha ponto e vírgula
* A indentação deve conter um ou mais espaços, e não devemos utilizar tab
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
        docker compose up -d : Rodar em detached 
        docker compose down : Parar o compose 
        docker compose ps : Ver os serviços do compose que estao rodando 
    
    ### Variaveis de ambiente 

        * Para isso vamos definir um arquivo base em env_file
        * As variáveis podem ser chamadas pela sintaxe: ${VARIAVEL}
        * Esta técnica é útil para armazenar dados sensíveis

## Docker Swarm

    * É uma ferramenta para trabalhar com orquestração de containers
    * Temos um serviço que monitor os outros serviços
    * Podemos escalar os serviço para mais de uma máquina, dividindo o custo de processamento
    * Podemos escalar horizontalmente nossos projetos de maneira simples
    * O famoso Cluster ( Colocar várias máquinas em paralelo, criando novas instâncias sincronizadas com o mesmo projeto )
    * Os comandos são semelhantes ao Docker
    * Garantir que os serviços estejam sempre disponíveis, se o container do worker for parado, ele reiniciará automaticamente
 
### Conceitos
    
- `Nodes`: E uma instância ( Máquina ) que participa do swarm
- `Manager Node`: Node que gerencia os demais Nodes
- `Worker Node`: Nodes que trabalham em função do manager
- `Service`: Tasks que o Manager Node manda o Work Node executar
- `Task`:  Comandos que são executados nos Nodes

    ### Comandos

        docker swarm init --advertise-addr [IP] : Iniciando o swarm indicando o ip de qual máquina está gerenciando o docker
            Obs: Nesse caso vai ser criado um node, e essa máquina vai virar um Manager Node
        docker swarm leav -f : Sai do swarm, o -f e necessário se apenas houver um node no swarm
        docker swarm join --token [TOKEN] [IP]:[PORTA] : Entrar no swarm
        docker node ls : Verificar os nodes que estão ativos, vai ser listado quais máquinas o swarm está utilizando para fazer o cluster
        docker service create --name [NOME] -p [PORTA] [Imagem]  : Dessa forma o container será adicionado ao manager
        docker service ls : Listar serviços que estão rodando
        docker service ps [ID]: Containers do serviço, incluindo os workers
        docker service rm [NOME/ID] : Remover servico
        docker service create --name [NOME] --replicas [Número] [Imagem] : Cria serviço que será replicado nos workers
        docker swarm join-token manager : Pegar o token do manager
        docker node rm [ID] : A instância não será mais considerada um node, caso exista algum serviço rodando, é necessário o -f
        docker service inspect [ID] : Inspecionar o serviço
        docker stack deploy -c [ARQUIVO.YML] [NOME] : Executar arquivo do compose
        docker service scale [NOME]=[RÉPLICAS] : Escalar o serviço para os demais workers
        docker node update --availability drain [ID] : Alterando o status do node para drain, parar de receber ordens do manager, o status ativo e o active
        docker service update --image [IMAGEM] [SERVICO] : Atualizando a imagem dos nodes
        docker network create --driver [DRIVER] [NOME] : Criar network
            Obs: o driver utilizado é o overlay
        docker service update --network-add [NETWORK] [SERVIÇO] : Conectar um serviço a uma network
 
## Kubernetes
   
    * É uma ferramenta para trabalhar com orquestração de containers
    * Permite a criação de múltiplos contêineres em diferentes máquinas( nodes )
    * Escala projetos, formando um cluster
 
### Conceitos
   
- `Control Plane`: Onde é gerenciado o controle dos processos dos Nodes
- `Nodes`: Máquinas que são gerenciadas pelo Control Plane
- `Deployment`: A execução de uma imagem/projeto em um Pod
- `Pod`: Um ou mais containers que estão em um node
- `Services`:  Serviços que expõe os Pods ao mundo externo
- `Kubectl`:  Cliente de linha de comando para Kubernetes
 
### Dependências 

- `Kubectl`: A maneira de executar o Kubernetes
- `Minikube`: Uma espécie de simulador de Kubernetes, assim não vamos precisar de vários computadores
 
   ### Comandos:
        kubectl create deployment [NOME] --imagem=[IMAGEM] : Fazer o deployment, rodar os containers das aplicações nos Pods
        kubectl get deployments : Visualizar os deployments
        kubectl describe deployments : Receber mais detalhes
        kubectl get pods : Verificar os Pods
        kubectl describe pods : Detalhes dos Pods
        kubectl expose deployment [NOME] --type=[TIPO] --port=[PORTA] : Expor nossos serviços, o tipo mais utilizado e LoadBalancer ( Todos os pods são expostos )
        kubectl get services : Ver os serviços já criados
        kubectl describe services/[NOME] : Ver detalhes
        kubectl scale deployment/[NOME] --replicas=[NUMERO] : Replicando a aplicao em outros pods, para diminuir o número de réplicas basta executar o mesmo comando passando uma quantidade menor
        kubectl get rs: Checar as réplicas
        kubectl set image deployment/[NOME] [NOME_CONTAINER]=[NOVA_IMAGEM] : Atualizar imagem do container
        kubectl rollout status deployment/[NOME] : Verificar uma alteracao
        kubectl rollout undo deployment/[NOME] : Voltar uma alteração
        kubectl delete service [NOME] : Deletar um serviço, dessa maneira nossos pods vão perder a conexão externa
        kubectl delete deployment [NOME] : Deletar o deployment
        kubectl apply -f [ARQUIVO] : Executar arquivo Deployment
        kubectl delete -f [ARQUIVO] : Parar deployment
 
   ### Modo Declarativo
 
   Chaves mais utilizadas
 
   - `apiVersion`: Versão utilizada da ferramenta
   - `kind`: Tipo do arquivo ( Deployment, Service )
   - `metadata`: Descrever algum objeto, inserindo chaves como name
   - `replicas`: Numero de replicas de Nodes/Pods
   - `containers`: Definir as especificações de containers como, nome e imagem
 
### Minikube
 
   ### Comandos:
        minikube start --driver=[DRIVER] : Inicializar o minikube, drivers possiveis: virtualbox, hyperv, docker
        minikube status : Verificar status
        minikube stop : Parar o minikube
        minikube dashboard : Ver detalhes do nosso projeto
        minikube service [NOME] : Acessar o serviço que criamos
 
 

