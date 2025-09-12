# VelhaGame

VelhaGame é um projeto de jogo da velha desenvolvido com o objetivo de implementar práticas de Integração Contínua (CI) e Entrega Contínua (CD) utilizando Git e GitHub. Este projeto serve como base para explorar automações, testes e deploys em ambientes modernos de desenvolvimento colaborativo.

## Tecnologias Utilizadas
- PHP
- HTML
- CSS
- JavaScript

## Como Executar
Abra o terminal e execute os seguintes comandos:

```bash
php -S localhost:8000
```

# constrói a imagem
docker build -t velha-game .

# executa o container
docker run -d -p 8080:80 --name jogo-da-velha velha-game

# Acesse o jogo em seu navegador
http://localhost:8080
