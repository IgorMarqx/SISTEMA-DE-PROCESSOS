# Sistema de Processos para a SINDJUF-PB

Este projeto é um sistema desenvolvido para a SINDJUF-PB com o intuito de auxiliar no acompanhamento e visualização de processos. Ele foi construído utilizando a linguagem PHP em conjunto com o framework Laravel, e o banco de dados relacional MySQL. A interface do sistema foi construída utilizando o sistema de templates Blade do Laravel.

# Funcionalidades
**1. Acompanhamento de Processos:** O sistema permite o acompanhamento detalhado de todos os processos da SINDJUF-PB. Os usuários podem visualizar informações importantes como status, andamento, partes envolvidas, prazos, entre outros.

**2. Gerenciamento de Processos:** Os usuários autorizados têm permissões para gerenciar os processos, incluindo a adição de novos processos, atualização de informações, alteração de status e atribuição de responsáveis.

**3. Visualização Personalizada:** O sistema oferece uma interface intuitiva e amigável, construída com o sistema de templates Blade do Laravel. Através dessa interface, os usuários podem visualizar seus processos de maneira organizada e filtrar por diferentes critérios, como status, data de criação e responsável.

**4. Notificações e Alertas:** O sistema possui um sistema de notificações e alertas que mantém os usuários informados sobre atualizações e prazos importantes. Os usuários receberão notificações por e-mail e também poderão visualizá-las no próprio sistema.

**5. Segurança e Autenticação:** O sistema possui um sistema robusto de autenticação e controle de acesso. Cada usuário possui um login exclusivo e as permissões são definidas de acordo com seu papel na organização.

# Requisitos Técnicos
- PHP 7.4 ou superior
- Laravel 9.x ou superior
- MySQL 5.7 ou superior


# Instalação
**1.** Clone o repositório para o seu ambiente local.

**2.** Certifique-se de ter o PHP e o MySQL instalados em sua máquina.

**3.** Execute o comando `composer create-project laravel/laravel 'nomedoprojeto'` para instalar as dependências do Laravel.

**4.** Copie o arquivo `.env.example` para `.env` e configure as informações do banco de dados.

**5.** Execute o comando `php artisan key:generate` para gerar uma chave única para a aplicação.

**6.** Execute o comando `php artisan migrate` para criar as tabelas necessárias no banco de dados.

**7.** Execute o comando `php artisan serve` para iniciar o servidor de desenvolvimento do Laravel.

# Contribuição
Se você deseja contribuir com o desenvolvimento deste sistema, sinta-se à vontade para fazer um fork do repositório e enviar pull requests com suas melhorias e correções.

# Suporte
Se você tiver alguma dúvida ou encontrar algum problema, abra uma nova issue neste repositório. Faremos o possível para ajudá-lo.

Esperamos que este sistema de processos seja útil para a SINDJUF-PB e contribua para um acompanhamento mais eficiente e organizado dos processos. Agradecemos por utilizar nosso sistema e estamos abertos a sugestões de melhoria.

# Documentação
Para utilizar o sistema de processos da SINDJUF-PB, siga as instruções abaixo:

**1. Login:** Acesse a página de login do sistema e insira suas credenciais de acesso. Se você não possui uma conta, entre em contato com o administrador para criar uma para você.

**2. Painel de Controle:** Após efetuar o login, você será redirecionado para o painel de controle. Nesta página, você poderá visualizar uma visão geral dos seus processos, incluindo o número total de processos, processos em andamento, concluídos e pendentes.

**3. Visualização de Processos:** No menu lateral, clique em "Processos" para acessar a página de visualização de processos. Nesta página, você poderá ver todos os processos disponíveis, filtrar por status, data de criação e responsável, e visualizar informações detalhadas de cada processo.

**4. Adição de Processos:** Para adicionar um novo processo, clique em "Novo Processo" no menu lateral. Preencha as informações solicitadas, como número do processo, partes envolvidas, descrição, entre outros. Após preencher os campos, clique em "Salvar" para adicionar o processo ao sistema.

**5. Atualização de Processos:** Para atualizar as informações de um processo existente, vá para a página de visualização de processos e clique no botão de edição correspondente ao processo desejado. Faça as alterações necessárias e clique em "Salvar" para atualizar as informações.

**6. Alteração de Status:** Na página de visualização de processos, é possível alterar o status de um processo. Basta clicar no botão de status correspondente ao processo desejado e selecionar o novo status na lista suspensa.

**7. Notificações:** O sistema enviará notificações por e-mail sempre que houver uma atualização importante em um processo ou quando um prazo estiver próximo de expirar. Certifique-se de manter seu e-mail atualizado para receber essas notificações.

**8. Visualização de PDF:** O advogado poderá inserir arquivos tipo PDF e imagens para que o usuário que esteja cadastrado no sistema possa visualizar ou baixar caso queira.

# Personalização
O sistema de processos foi desenvolvido com o intuito de atender às necessidades específicas da SINDJUF-PB. No entanto, é possível personalizá-lo e adaptá-lo às suas necessidades.

**1. Estilos e Layout:** O sistema utiliza o sistema de templates Blade do Laravel para a construção da interface. Você pode personalizar os estilos e o layout do sistema alterando os arquivos de templates localizados na pasta resources/views.

**2. Funcionalidades Adicionais:** Se você deseja adicionar funcionalidades específicas ao sistema, o Laravel oferece uma ampla gama de recursos e extensões. Consulte a documentação oficial do Laravel para obter mais informações sobre como estender o sistema de acordo com suas necessidades.

# Conclusão
O sistema de processos desenvolvido para a SINDJUF-PB utilizando PHP com o framework Laravel, juntamente com o banco de dados MySQL, é uma solução eficiente para auxiliar no acompanhamento e gerenciamento de processos. Através da interface intuitiva construída com o sistema Blade do Laravel, os usuários podem visualizar e gerenciar seus processos de forma organizada.

Esperamos que este sistema contribua significativamente para o trabalho da SINDJUF-PB, proporcionando uma melhor organização, controle e acompanhamento dos processos. Caso tenha alguma dúvida ou precise de assistência, não hesite em entrar em contato conosco.

Agradecemos por utilizar nosso sistema e desejamos a você e à SINDJUF-PB muito sucesso em seus processos.
