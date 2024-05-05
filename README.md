## Rating System

Este é um projeto de sistema de avaliação de recursos humanos, desenvolvido para atender às necessidades de avaliação de desempenho e gestão de recursos humanos em uma empresa. O sistema permite que os funcionários sejam avaliados por meio de questionários específicos de acordo com o seu setor, além de fornecer recursos administrativos para a criação, edição, exclusão e controle de avaliações.

### Características do Sistema

- **Sistema de Rotas**: O projeto utiliza um sistema de rotas para direcionar as solicitações HTTP para os controladores apropriados.
- **Arquitetura MVC**: A aplicação segue o padrão de arquitetura Model-View-Controller para separar a lógica de negócios, a apresentação e a manipulação de dados.
- **PHP**: A linguagem de programação principal utilizada no desenvolvimento é o PHP.
- **Blade**: O Blade é o mecanismo de templates utilizado para renderizar as visualizações HTML do sistema.
- **phpdotenv**: A biblioteca phpdotenv é utilizada para carregar variáveis de ambiente a partir de um arquivo `.env`.
- **PHPUnit**: É utilizado o PHPUnit para testes unitários, garantindo a qualidade e a integridade do código.
- **Faker**: O Faker é utilizado para gerar dados fictícios durante os testes e desenvolvimento.

### Funcionalidades

- **Página Inicial**: Apresenta uma visão geral do sistema e fornece acesso às funcionalidades principais.
- **Formulário de Cadastro de Setor para Funcionários**: Permite o cadastro e a edição de setores para os funcionários, associando-os aos respectivos setores da empresa.
- **Formulário de Login**: Permite que os funcionários e administradores façam login no sistema para acessar as funcionalidades disponíveis.
- **Restrição de Acesso por Setor**: Cada funcionário só pode responder às avaliações relacionadas ao seu setor.
- **Administração de Avaliações**: O administrador pode criar, editar, remover e controlar a disponibilidade das avaliações no sistema.
- **Promoção de Administrador**: O administrador pode promover outros usuários a administradores, concedendo-lhes acesso às funcionalidades administrativas do sistema.

### Como Executar o Projeto

1. Clone o repositório para o seu ambiente local.
2. Instale as dependências do projeto utilizando o Composer.
![image](https://github.com/FernandoIzidio/Rating-System/assets/129561137/f0764ff9-fa49-4de9-b341-36978f2a90ae)
3. Configure as variáveis de ambiente no arquivo .env conforme necessário.
4. Execute as migrações do banco de dados para criar a estrutura necessária.

### Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue para discutir novas funcionalidades, relatar bugs ou enviar pull requests para melhorias no código.

### Licença

Este projeto está licenciado sob a Licença Apache.

