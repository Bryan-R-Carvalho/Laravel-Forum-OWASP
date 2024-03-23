
# TCC - Construção de Fórum Web com Laravel e OWASP Top 10

Descrição do Projeto
Este repositório contém o Trabalho de Conclusão de Curso (TCC) intitulado "Construção de Fórum Web com Laravel e OWASP Top 10". O objetivo principal deste projeto é desenvolver um fórum online utilizando o framework Laravel, enquanto aborda e implementa as melhores práticas de segurança preconizadas pelo OWASP Top 10.

Conteúdo
Documentação: A documentação do TCC, incluindo a introdução, justificativa, objetivos, revisão bibliográfica, metodologia, desenvolvimento, resultados e conclusões.

Código-fonte: O código-fonte do fórum web construído usando o Laravel, seguindo as boas práticas de desenvolvimento e as diretrizes de segurança do OWASP Top 10.

Tecnologias Utilizadas
Laravel 10: Um poderoso framework PHP que proporciona uma estrutura elegante para o desenvolvimento de aplicativos web.

OWASP Top 10: As principais ameaças à segurança em aplicações web, abordadas e mitigadas ao longo do projeto.


## Como Executar
**1.Clone este repositório:**

```
git clone https://github.com/seu-usuario/tcc-forum-laravel-owasp.git
```
**2.Instale as dependências do Laravel:**

```
composer install
```
**3.Configure o arquivo .env baseado no .env.example:**

```
cp .env.example .env
```
Certifique-se de configurar corretamente o banco de dados.

**4.Execute as migrações para criar as tabelas do banco de dados e alimenta :**
```
php artisan migrate:refresh --seed
```
**5.Instale os pacotes json:**
```
npm install
```
**6.Build o vite:**
```
npm run build
```
**7.Inicie o servidor de desenvolvimento:**
```
php artisan serve
ou
./vendor/bin/sail up
```

Acesse o fórum no navegador:
 http://localhost:8000

## Contribuições
Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests.
