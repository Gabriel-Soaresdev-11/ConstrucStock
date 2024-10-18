
# ConstrucStock - Sistema de Controle de Estoque e Vendas

**ConstrucStock** é uma aplicação web desenvolvida para gerenciar o controle de estoque e vendas, projetada especificamente para empresas do setor de construção civil. O sistema oferece uma plataforma eficiente e intuitiva para gerenciar produtos, clientes, vendas, e gerar relatórios detalhados, otimizando a gestão de estoques e o fluxo de caixa.

## Funcionalidades Principais

- **Gerenciamento de Produtos**: Cadastro de produtos com informações como quantidade em estoque, preço de compra, preço de venda e categoria.
- **Controle de Vendas**: Registre e acompanhe todas as vendas realizadas, incluindo controle de pagamento (cartão, débito, PIX, fiado).
- **Controle de Estoque**: Atualize automaticamente o estoque ao registrar novas vendas, bloqueando a venda de produtos com estoque zerado.
- **Gerenciamento de Clientes**: Cadastro completo de clientes, incluindo informações de contato e histórico de compras.
- **Relatórios Detalhados**: Geração de relatórios mensais com informações detalhadas sobre vendas, produtos vendidos, pagamentos e estoque.
- **Importação de Produtos via Excel**: Suporte para importação de produtos através de arquivos Excel para facilitar o cadastro em massa.
- **Painel Administrativo**: Interface de fácil uso para visualização de estatísticas, como valor total de vendas do dia, faturamento mensal, e quantidade de vendas.

## Tecnologias Utilizadas

- **Laravel**: Framework PHP para backend e estruturação da aplicação.
- **PHPSpreadsheet**: Para geração de relatórios e manipulação de planilhas Excel.
- **MySQL**: Banco de dados relacional para armazenar informações de produtos, clientes, vendas e pagamentos.
- **CSS**: Design responsivo e estilização personalizada do sistema.
- **JavaScript**: Scripts dinâmicos para funcionalidades como carrosséis de imagens e interatividade.

## Como Instalar

1. Clone o repositório:
   ```
   git clone https://github.com/seuusuario/construcstock.git
   ```
2. Instale as dependências do Laravel:
   ```
   composer install
   npm install
   ```
3. Configure o arquivo `.env` e gere a chave da aplicação:
   ```
   cp .env.example .env
   php artisan key:generate
   ```
4. Execute as migrações para criar as tabelas no banco de dados:
   ```
   php artisan migrate
   ```

5. Execute o servidor de desenvolvimento:
   ```
   php artisan serve
   ```

## Licença

Este projeto está licenciado sob a MIT License - consulte o arquivo [LICENSE](LICENSE) para obter mais detalhes.
