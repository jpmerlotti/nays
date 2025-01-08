<p align="center">
	<h2 align="center">Nays</h2>
</p>
<h4 align="center"> 
	🚧  Projeto em construção... 🚀  🚧
</h4>
<p align="center">
	<img src="https://img.shields.io/badge/version project-1.0-brightgreen" alt="version project">
    <img src="https://img.shields.io/badge/Php-8.4.1-informational" alt="stack php">
    <img src="https://img.shields.io/badge/Laravel-11.4-informational&color=brightgreen" alt="stack laravel">
    <img src="https://img.shields.io/badge/Filament-3.2-informational" alt="stack Filament">
    <img src="https://img.shields.io/badge/TailwindCss-3.2-brightgreen" alt="stack Tailwind">
	<a href="https://opensource.org/licenses/GPL-3.0">
		<img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="GPLv3 License">
	</a>
</p>

---

### :package: dependências do projeto

-   Docker + docker-compose
-   curl
-   Make 4.x

---

### :books: Configurando o projeto em um novo ambiente

Simplesmente execute o comando `make` no seu terminal:

```bash
make
```

Agora, basta acessar a URL `http://localhost`

---

### :books: Comandos make

Simplesmente execute o comando `make` no seu terminal:

```bash
make up // inicializa o projeto (docker)
```

```bash
make down // encerra o projeto (docker)
```

```bash
make restart // executa make down e make up
```

```bash
make populate // roda migrate:fresh --seed
```

## :information_source: Ferramentas de desenvolvimento

**Laravel Stan** é uma ferramenta de análise estática para o PHP. Ela ajuda os desenvolvedores a detectar potenciais erros de código, inconsistências e problemas de tipo durante o desenvolvimento. O PHPStan examina o código-fonte do PHP sem realmente executá-lo e fornece feedback sobre possíveis problemas, como chamadas de métodos inexistentes, acessos a propriedades indefinidas, erros de tipo e muito mais. Isso ajuda os desenvolvedores a escrever código mais seguro, robusto e menos propenso a erros.

```bash
make stan // analisador erros no código
```

**Laravel Pint** é um corretor de estilo de código. Ele é construído sobre o PHP-CS-Fixer e torna simples garantir que seu estilo de código permaneça limpo e consistente.

```bash
make pint // aplica estilização de código conforme PSR
```

## :heavy_check_mark: Testes automatizados

É possivel criação de testes E2E automzatizados utilizando o Laravel Dusk.
Após a criação dos arquivos de testes, para executa-los utilize o comando abaixo. Ele executará os testes conforme ambiente informado no arquivo cypress.confi.js.

```bash
sh testing.sh
```

---

### :ledger: Documentação

A documentação para o usuário final foi utilizado o **Larecipe**. Ele uma ferramenta desenvolvida pelo Facebook que permite criar conteúdos estáticos usando como base documentos Markdown. [Site oficial Larecipe](https://larecipe.saleem.dev/docs/2.2/overview)
\
\
Todos os arquivos da documentaçãoestá localizado no diretório `/resources/docs` e após compilado, as páginas são geradas no diretório publico através do comando.

```bash
make doc
```

---

### :exclamation: Orientações

-   Caso tenha algum problema com a instalação, execute o comando `make rebuild`
-   Para fazer uma nova instalação execute o comando `make`
-   Inicializar os container do projeto execute o comando `make up`
-   Encerrar os container do projeto execute o comando `make down`
-   Maiores informações, vide o arquivo Makefile
-   Correr pro abraço!
