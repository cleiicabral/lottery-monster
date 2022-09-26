# test-nerdmonster

##### Copiar o arquivo .envExample para .env`

#### Executar o container

```
docker-compose up -d
```
##### Rotas para testar a aplicação

```
POST "/create-ticket"
http://localhost:8009/api/create-ticket

GET "/ticket/:ticketCode"
http://localhost:8009/api/ticket/{ticketCode}
```

