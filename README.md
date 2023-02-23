# Backend Challenge 20230105

>  This is a challenge by [Coodesh](https://coodesh.com/)

FitnessFoods API é uma REST API que utiliza os dados do projeto Open Food Facts, um banco de dados aberto com informação nutricional de diversos produtos alimentícios.

## Tecnologias
- Linguagem PHP
- Framework Laravel 9 com Sail (Docker)
- MongoDB
- Vite
- OpenAPI

## Instalação

- **Requisitos**: [Docker](https://docs.docker.com/engine/install/) e [Docker Compose](https://docs.docker.com/compose/) instalados
- Rodar o seguinte comando dentro da pasta raiz do projeto:
```shell
 docker compose build --no-cache 
 && docker compose up -d 
 && docker compose exec laravel.test composer install 
 && ./vendor/bin/sail npm install 
 && ./vendor/bin/sail up -d 
 && ./vendor/bin/sail npm run dev  
```
- o terminal ficará travado pelo Vite e a aplicação estará rodando na rede localhost na porta 8080 [localhost:8080](localhost:8080)
- para ver as documentações: [localhost:8080/swagger](localhost:8080/swagger)

## Rotas
- `GET /`: Detalhes da API, se conexão leitura e escritura com a base de dados está OK, horário da última vez que o CRON foi executado, tempo online e uso de memória.
- `PUT /products/:code`: Será responsável por receber atualizações do Projeto Web
- `DELETE /products/:code`: Mudar o status do produto para `trash`
- `GET /products/:code`: Obter a informação somente de um produto da base de dados
- `GET /products`: Listar todos os produtos da base de dados, adicionar sistema de paginação para não sobrecarregar o `REQUEST`.


## Desenvolvimento

### Day 1:
-  fiz todo o projeto no JIRA para me organizar melhor em tasks e ter um melhor fluxo. Melhor investir um pouco de tempo se organizando para ter mais produtividade no futuro.
-  além disso, consegui particionar o projeto e com isso consigo ver melhor não somente o todo, mas também cada etapa bem detalhada.

![Image1](https://raw.githubusercontent.com/faresmts/fitness-foods-api/main/resources/img/imagem1.png)



- Decidi aprender NoSQL com MongoDB e cair de vez no desafio. Fiz 3 cursos na Alura sobre o banco de dados e me familiarizei com os vários conceitos de NoSQL.
- Após estudar o bastante, fui ver como fazia a integração do Laravel usando Sail com MongoDB e consegui publicar os arquivos Dockerfile para adicionar a extensão do PHP para mongodb. Além disso mudei o php.ini, instalei o pacote **jenssegers/mongodb** e segui de acordo com o tutorial oficial em https://www.mongodb.com/compatibility/mongodb-laravel-intergration


### Day 2:
- tive que mudar a versão pro laravel 9, pois as instalações padrão estão vindo já na versão 10. então alterei o composer.json e reinstalei a vendor para instalar o pacote


- Após isso, comecei a task CCTP-11 : Criar Model, Factory e Migration de Product + MongoDB Schema. Fazer por task me coloca em um estado mais produtivo e consigo me organizar melhor com o versionamento da aplicação. 

```
db.createCollection("products", {
    validator: {
        $jsonSchema: {
            bsonType: "object",
            "additionalProperties" : false,
            
            required: [ "code", "status", "imported_t", "url", "creator", "created_t", 
            "last_modified_t", "product_name", "quantity", "brands", "categories", 
            "labels", "cities", "purchase_places", "stores", "ingredients_text", "traces", 
            "serving_size", "serving_quantity", "nutriscore_score", "nutriscore_grade", 
            "main_category", "image_url"],
            
            properties: {
                _id: {
                    bsonType: "objectId"
                }
                code: {
                    bsonType: ["string"],
                    description: "code must be a string if the field exists"
                },
                status: {
                    enum : ["draft", "trash", "published"],
                    description: "can only be one of the enum values and is required"
                },
                imported_t: {
                    bsonType: "string"
                    description: "imported_t must be a string and is required"
                },
                url: {
                    bsonType: ["string"],
                    description: "url must be a string if the field exists"
                },
                creator: {
                    bsonType: ["string"],
                    description: "creator must be a string if the field exists"
                },
                created_t: {
                    bsonType: ["string"],
                    description: "created_t must be an integer if the field exists"
                },
                last_modified_t: {
                    bsonType: ["string"],
                    description: "last_modified_t must be an integer if the field exists"
                },
                product_name: {
                    bsonType: ["string"],
                    description: "product_name must be a string if the field exists"
                },
                quantity: {
                    bsonType: ["string"],
                    description: "quantity must be a string if the field exists"
                }
                brands: {
                    bsonType: ["string"],
                    description: "brands must be a string if the field exists"
                },
                categories: {
                    bsonType: ["string"],
                    description: "categories must be a string if the field exists"
                },
                labels: {
                    bsonType: ["string"],
                    description: "labels must be a string if the field exists"
                },
                cities: {
                    bsonType: ["string"],
                    description: "cities must be a string if the field exists"
                }, 
                purchase_places: {
                    bsonType: ["string"],
                    description: "purchase_places must be a string if the field exists"
                },    
                stores: {
                    bsonType: ["string"],
                    description: "stores must be a string if the field exists"
                },
                ingredients_text: {
                    bsonType: ["string"],
                    description: "ingredients_text must be a string if the field exists"
                },
                traces: {
                    bsonType: ["string"],
                    description: "traces must be a string if the field exists"
                },
                serving_size: {
                    bsonType: ["string"],
                    description: "serving_size must be a string if the field exists"
                },
                serving_quantity: {
                    bsonType: ["double", "null"],
                    description: "serving_quantity must be a double if the field exists"
                },
                nutriscore_score: {
                    bsonType: ["int"],
                    minimum: -15,
                    maximum: 40,
                    description: "nutriscore_score must be an integer [ -15, 40 ] if the field exists"
                },
                nutriscore_grade: {
                    bsonType: ["string"],
                    minLength: 1, 
                    maxLength: 1,
                    description: "nutriscore_grade must be a string if the field exists"
                },
                main_category: {
                    bsonType: ["string"],
                    description: "main_category must be a string if the field exists"
                },
                image_url: {
                    bsonType: ["string"],
                    description: "serving_quantity must be a string if the field exists if the field exists"
                }
            }
        }
    }
})
```

- Estava tendo problemas de compatibilidade do Laravel com a validação do MongoDB e optei por deixar a validação
dos campos concentrada na aplicação e o banco de dados sem validação. 
- Desse modo, consigo ainda ter uma solidez nas informações persistidas em nossa database.

![Image2](https://raw.githubusercontent.com/faresmts/fitness-foods-api/main/resources/img/imagem2.png)
### Day 3
fiz a implementação do sistema de Cron e tive dois grandes desafios:
  1. Criar um cron dentro do container, melhorando meus conhecimentos de Docker e Dockerfile
  2. Saber trabalhar com streams de arquivos .gz

- A parte do Docker foi mais empírica, procurando soluções e acabei tendo êxito em programar a schedule run do artisan de maneira até que elegante. 
- Após isso, desenvolvi uma leitura de stream line by line dos arquivos e salvando um produto de cada vez dentro da nossa collection de Products.
- Configurei o horário do Cron usando um model de SystemEnv para termos o controle de Sync dos produtos a partir de uma informação no banco de dados 
- Desenvolvi uma chamada recursiva em caso de falhas do Sync dos produtos, salvando um log de erro dentro de um documento de Cron, mas sem travar a nossa aplicação. 
Desse modo, o **Diferencial 3**: Configurar um sistema de alerta se tem algum falho durante o Sync dos produtos 
foi atendido por termos como saber se o Sync falhou pelo DB, mas ainda assim a nossa aplicação vai importar **todos** os arquivos caso dê algum erro. 
- tentei fazer tudo por TDD, porém há um erro de compatibilidade do PHPUnit com MongoDB em testes, pois o código que era escrito nos Testes acessava diretamente o
nosso banco, fugindo do escopo de teste unitário. Na internet não há muita informação sobre PHPUnit e MongoDB, tornando bastante difícil o desenvolvimento. 
Se eu tivesse mais tempo, conseguiria até mesmo desenvolver uma solução nova e que pudesse ser utilizada por outros desenvolvedores, mas optei por não
investir nos testes pela falta de compatibilidade.

### Day 4
- Fui desenvolver a REST API e tive um desafio maior desenvolvendo a primeira rota `GET /:`, pois tinham informações ali que eu nunca
tinha trabalhado. Mas consegui aprender execução de comandos no terminal a partir do Laravel.
- As outras rotas são mais simples, usando a boa arquitetura MVC do Laravel consegui ser bastante produtivo 
e desenvolvê-las rapidamente. 


- Nesse mesmo dia, fiz a autenticação do sistema com API Key usando Middlewares nas rotas. Para ter 
acesso à api, precisa cadastrar uma credencial no Banco de Dados. Vou deixar uma para testes:
  - Key: `FitnessFoodApiKey`
  - Value: `db72758b-6ef0-4b10-9f86-4f62274198a1
- **No final vou deixar a collection do Postman!**

### Day 5
- Fui procurar uma solução nova para escrever a documentação Open API de maneira automatizada e
me pareceu interessante uma lib chamada [laravel open api](https://vyuldashev.github.io/laravel-openapi/)
- Não satisfeito em somente escrever classes novas de uma lib para a documentação, aprendi a configurar o Vite e
expor a documentação como uma página front-end do nosso projeto, ficando na rota [localhost:8080/swagger](localhost:8080/swagger)

# Conclusão
- consegui entregar API com todas as funcionalidades obrigatórias e recomendadas.
- relação dos diferenciais:
  - Diferencial 1 Configuração de um endpoint de busca com Elastic Search ou similares;
    - Não cumprido, tentei ainda mas por ser algo novo pra mim demandaria mais tempo para o aprendizado.
  - Diferencial 2 Configurar Docker no Projeto para facilitar o Deploy da equipe de DevOps;
    - OK
  - Diferencial 3 Configurar um sistema de alerta se tem algum falho durante o Sync dos produtos;
    - OK
  - Diferencial 4 Descrever a documentação da API utilizando o conceito de Open API 3.0;
    - OK
  - Diferencial 5 Escrever Unit Tests para os endpoints GET e PUT do CRUD;
    - Não cumprido, mas tenho um teste escrito na pasta tests/Feature/Http/Controllers como prova de que sei escrever testes, mas que a incompatibilidade do MongoDB com PHPUnit me atrapalhou no desenvolvimento e que não achei uma solução para esse problema.
  - Diferencial 6 Escrever um esquema de segurança utilizando API KEY nos endpoints.
    - OK

# Collection do Postman:
```JSON
{
	"info": {
		"_postman_id": "cbe9b0b6-db0b-492d-a0c3-d5097ab682be",
		"name": "fitness foods api",
		"schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json",
		"_exporter_id": "20390374"
	},
	"item": [
		{
			"name": "system info",
			"request": {
				"auth": {
					"type": "apikey",
					"apikey": [
						{
							"key": "value",
							"value": "db72758b-6ef0-4b10-9f86-4f62274198a1",
							"type": "string"
						},
						{
							"key": "key",
							"value": "FitnessFoodApiKey",
							"type": "string"
						}
					]
				},
				"method": "GET",
				"header": [],
				"url": {
					"raw": "http://localhost:8080/api/",
					"protocol": "http",
					"host": [
						"localhost"
					],
					"port": "8080",
					"path": [
						"api",
						""
					]
				}
			},
			"response": []
		},
		{
			"name": "show all products",
			"request": {
				"auth": {
					"type": "apikey",
					"apikey": [
						{
							"key": "value",
							"value": "db72758b-6ef0-4b10-9f86-4f62274198a1",
							"type": "string"
						},
						{
							"key": "key",
							"value": "FitnessFoodApiKey",
							"type": "string"
						}
					]
				},
				"method": "GET",
				"header": [],
				"url": {
					"raw": "http://localhost:8080/api/products?per_page=2&page=1",
					"protocol": "http",
					"host": [
						"localhost"
					],
					"port": "8080",
					"path": [
						"api",
						"products"
					],
					"query": [
						{
							"key": "per_page",
							"value": "2"
						},
						{
							"key": "page",
							"value": "1"
						}
					]
				}
			},
			"response": []
		},
		{
			"name": "show specific product",
			"request": {
				"auth": {
					"type": "apikey",
					"apikey": [
						{
							"key": "value",
							"value": "db72758b-6ef0-4b10-9f86-4f62274198a1",
							"type": "string"
						},
						{
							"key": "key",
							"value": "FitnessFoodApiKey",
							"type": "string"
						}
					]
				},
				"method": "GET",
				"header": [],
				"url": {
					"raw": "http://localhost:8080/api/products/17",
					"protocol": "http",
					"host": [
						"localhost"
					],
					"port": "8080",
					"path": [
						"api",
						"products",
						"17"
					]
				}
			},
			"response": []
		},
		{
			"name": "edit specific product",
			"request": {
				"auth": {
					"type": "apikey",
					"apikey": [
						{
							"key": "value",
							"value": "db72758b-6ef0-4b10-9f86-4f62274198a1",
							"type": "string"
						},
						{
							"key": "key",
							"value": "FitnessFoodApiKey",
							"type": "string"
						}
					]
				},
				"method": "PUT",
				"header": [],
				"body": {
					"mode": "raw",
					"raw": "{\n    \"creator\" : \"fares THE DEV\"\n}",
					"options": {
						"raw": {
							"language": "json"
						}
					}
				},
				"url": {
					"raw": "http://localhost:8080/api/products/17",
					"protocol": "http",
					"host": [
						"localhost"
					],
					"port": "8080",
					"path": [
						"api",
						"products",
						"17"
					]
				}
			},
			"response": []
		},
		{
			"name": "delete specific product",
			"request": {
				"auth": {
					"type": "apikey",
					"apikey": [
						{
							"key": "value",
							"value": "db72758b-6ef0-4b10-9f86-4f62274198a1",
							"type": "string"
						},
						{
							"key": "key",
							"value": "FitnessFoodApiKey",
							"type": "string"
						}
					]
				},
				"method": "DELETE",
				"header": [],
				"url": {
					"raw": "http://localhost:8080/api/products/100",
					"protocol": "http",
					"host": [
						"localhost"
					],
					"port": "8080",
					"path": [
						"api",
						"products",
						"100"
					]
				}
			},
			"response": []
		}
	]
}
```
