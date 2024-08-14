## Tabelas do Banco de Dados

### Tabela `funcionarios`

A tabela `funcionarios` armazena informações detalhadas sobre os funcionários da organização. Cada registro corresponde a um funcionário e contém dados pessoais, profissionais, e de contato.

| Coluna             | Tipo de Dados     | Descrição                                                           |
|--------------------|-------------------|----------------------------------------------------------------------|
| `id`               | `INTEGER`         | Chave primária, identificador único do funcionário.                 |
| `nome`             | `VARCHAR`         | Nome completo do funcionário.                                       |
| `setor`            | `VARCHAR`         | Setor em que o funcionário trabalha.                                |
| `matricula`        | `VARCHAR`         | Número de matrícula do funcionário.                                 |
| `carga_horaria`    | `VARCHAR`         | Carga horária de trabalho do funcionário.                           |
| `data_nascimento`  | `DATE`            | Data de nascimento do funcionário.                                  |
| `rg`               | `VARCHAR`         | Número do Registro Geral (RG) do funcionário.                       |
| `cpf`              | `VARCHAR`         | Número do Cadastro de Pessoa Física (CPF) do funcionário.           |
| `pis_pasep`        | `VARCHAR`         | Número do PIS/PASEP do funcionário.                                 |
| `titulo_eleitor`   | `VARCHAR`         | Número do título de eleitor do funcionário.                         |
| `cartao_sus`       | `VARCHAR`         | Número do Cartão SUS do funcionário.                                |
| `mae`              | `VARCHAR`         | Nome da mãe do funcionário.                                         |
| `pai`              | `VARCHAR`         | Nome do pai do funcionário.                                         |
| `celular`          | `VARCHAR`         | Número de celular do funcionário.                                   |
| `bairro`           | `VARCHAR`         | Bairro onde o funcionário reside.                                   |
| `rua`              | `VARCHAR`         | Rua onde o funcionário reside.                                      |
| `numero`           | `VARCHAR`         | Número da residência do funcionário.                                |
| `cidade`           | `VARCHAR`         | Cidade onde o funcionário reside.                                   |
| `uf`               | `VARCHAR`         | Unidade Federativa (estado) onde o funcionário reside.              |
| `cep`              | `VARCHAR`         | Código de Endereçamento Postal (CEP) do funcionário.                |
| `estado_civil`     | `VARCHAR`         | Estado civil do funcionário.                                        |
| `email`            | `VARCHAR`         | Endereço de e-mail do funcionário.                                  |
| `id_cargo`         | `VARCHAR`         | Chave estrangeira, referência ao cargo do funcionário.              |
| `id_horario`       | `VARCHAR`         | Chave estrangeira, referência ao horário de trabalho do funcionário.|
| `sexo`             | `VARCHAR`         | Sexo do funcionário.                                                |
| `deficiente`       | `BOOLEAN`         | Indicador se o funcionário possui deficiência (`true` ou `false`).  |
| `id_dia_da_semana` | `INTEGER`         | Chave estrangeira, referência ao dia da semana relacionado.         |
| `created_at`       | `TIMESTAMP`       | Data e hora em que o registro foi criado.                           |
| `updated_at`       | `TIMESTAMP`       | Data e hora da última atualização do registro.                      |

### Relacionamentos

- A coluna `id_cargo` referencia a tabela `cargos`, que define os cargos disponíveis na organização.
- A coluna `id_horario` referencia a tabela `horarios`, que define os horários de trabalho atribuídos aos funcionários.
- A coluna `id_dia_da_semana` referencia a tabela `dias_da_semana`, que especifica os dias da semana relacionados ao horário de trabalho do funcionário.

### Tabela `registros`

A tabela `registros` armazena informações detalhadas sobre os registros de ponto dos funcionários. Cada registro corresponde a um dia de trabalho para um funcionário específico e contém informações sobre os horários de entrada e saída, bem como se houve atraso em algum dos pontos registrados.

| Coluna                    | Tipo de Dados | Descrição                                                                 |
|---------------------------|---------------|----------------------------------------------------------------------------|
| `id`                      | `INTEGER`     | Chave primária, identificador único do registro.                          |
| `id_funcionario`          | `INTEGER`     | Chave estrangeira, referência ao funcionário na tabela `funcionarios`.    |
| `id_horario`              | `INTEGER`     | Chave estrangeira, referência ao horário de trabalho na tabela `horarios`.|
| `primeiro_ponto`          | `VARCHAR`        | Horário do primeiro ponto registrado (geralmente a entrada).              |
| `segundo_ponto`           | `VARCHAR`        | Horário do segundo ponto registrado (geralmente a saída para almoço).     |
| `terceiro_ponto`          | `VARCHAR`        | Horário do terceiro ponto registrado (geralmente o retorno do almoço).    |
| `quarto_ponto`            | `VARCHAR`        | Horário do quarto ponto registrado (geralmente a saída).                  |
| `atrasou_primeiro_ponto`  | `BOOLEAN`     | Indicador se houve atraso no primeiro ponto (`true` ou `false`).          |
| `atrasou_segundo_ponto`   | `BOOLEAN`     | Indicador se houve atraso no segundo ponto (`true` ou `false`).           |
| `atrasou_terceiro_ponto`  | `BOOLEAN`     | Indicador se houve atraso no terceiro ponto (`true` ou `false`).          |
| `atrasou_quarto_ponto`    | `BOOLEAN`     | Indicador se houve atraso no quarto ponto (`true` ou `false`).            |
| `id_falta`                | `INTEGER`     | Chave estrangeira, referência ao registro de falta na tabela `faltas`.    |
| `data`                    | `DATE`        | Data do registro de ponto.                                                |
| `created_at`              | `TIMESTAMP`   | Data e hora em que o registro foi criado.                                 |
| `updated_at`              | `TIMESTAMP`   | Data e hora da última atualização do registro.                            |

### Relacionamentos

- A coluna `id_funcionario` referencia a tabela `funcionarios`, que contém os dados dos funcionários.
- A coluna `id_horario` referencia a tabela `horarios`, que define os horários de trabalho associados ao registro.
- A coluna `id_falta` referencia a tabela `faltas`, que registra as faltas de funcionários, caso existam.

### Tabela `justificativas`

A tabela `justificativas` armazena as justificativas fornecidas pelos funcionários para ausências ou atrasos em seus registros de ponto. Essa tabela é importante para manter um histórico das razões apresentadas por cada funcionário e pode ser referenciada em relatórios de frequência e pontualidade.

| Coluna        | Tipo de Dados | Descrição                                                  |
|---------------|---------------|------------------------------------------------------------|
| `id`          | `INTEGER`     | Chave primária, identificador único da justificativa.      |
| `justificativa`| `VARCHAR`       | Texto contendo a justificativa fornecida pelo funcionário. |
| `created_at`  | `TIMESTAMP`   | Data e hora em que a justificativa foi criada.             |
| `updated_at`  | `TIMESTAMP`   | Data e hora da última atualização da justificativa.        |

### Tabela `dias_da_semana`

A tabela `dias_da_semana` contém os dias da semana e é utilizada para configurar horário semanal do funcionário. Esta tabela permite padronizar os dias da semana e facilita a manutenção de regras de negócios baseadas nos dias.

| Coluna        | Tipo de Dados | Descrição                                    |
|---------------|---------------|----------------------------------------------|
| `id`          | `INTEGER`     | Chave primária, identificador único do dia.  |
| `segunda`     | `BOOLEAN`     | Indica se o dia é segunda-feira.             |
| `terca`       | `BOOLEAN`     | Indica se o dia é terça-feira.               |
| `quarta`      | `BOOLEAN`     | Indica se o dia é quarta-feira.              |
| `quinta`      | `BOOLEAN`     | Indica se o dia é quinta-feira.              |
| `sexta`       | `BOOLEAN`     | Indica se o dia é sexta-feira.               |
| `sabado`      | `BOOLEAN`     | Indica se o dia é sábado.                    |
| `domingo`     | `BOOLEAN`     | Indica se o dia é domingo.                   |
| `created_at`  | `TIMESTAMP`   | Data e hora em que o registro foi criado.    |
| `updated_at`  | `TIMESTAMP`   | Data e hora da última atualização do registro.|

## Tabela `faltas`

A tabela `faltas` armazena informações sobre as faltas dos funcionários, incluindo detalhes sobre a justificativa e a data da falta.

| Coluna             | Tipo de Dados     | Descrição                                                              |
|--------------------|-------------------|------------------------------------------------------------------------|
| `id`               | `INTEGER`         | Chave primária, identificador único da falta.                          |
| `id_funcionario`  | `INTEGER`         | Chave estrangeira, referência ao funcionário na tabela `funcionarios`.|
| `id_justificativa` | `INTEGER`         | Chave estrangeira, referência ao tipo de justificativa na tabela `justificativas`. |
| `data`              | `DATE`            | Data da falta.                                                        |
| `created_at`       | `TIMESTAMP`       | Data e hora em que o registro foi criado.                             |
| `updated_at`       | `TIMESTAMP`       | Data e hora da última atualização do registro.                        |

### Relacionamentos

- A coluna `id_funcionario` referencia a tabela `funcionarios`, que contém os dados dos funcionários.
- A coluna `id_justificativa` referencia a tabela `justificativas`, que contém os tipos de justificativas para as faltas dos funcionários.

## Tabela `horarios`

A tabela `horarios` armazena informações detalhadas sobre os horários de trabalho dos funcionários. Cada registro corresponde a um horário específico e contém informações sobre os horários de entrada, intervalo e saída.

| Coluna             | Tipo de Dados     | Descrição                                                              |
|--------------------|-------------------|------------------------------------------------------------------------|
| `id`               | `INTEGER`         | Chave primária, identificador único do horário.                          |
| `primeiro_horario` | `VARCHAR`        | Horário do primeiro ponto (geralmente a entrada).                        |
| `segundo_horario`  | `VARCHAR`        | Horário do segundo ponto (geralmente a saída para almoço).               |
| `terceiro_horario` | `VARCHAR`        | Horário do terceiro ponto (geralmente o retorno do almoço).              |
| `quarto_horario`  | `VARCHAR`        | Horário do quarto ponto (geralmente a saída).                            |
| `created_at`       | `TIMESTAMP`       | Data e hora em que o registro foi criado.                             |
| `updated_at`       | `TIMESTAMP`       | Data e hora da última atualização do registro.                        |


## Tabela `cargos`

A tabela `cargos` armazena informações detalhadas sobre os cargos disponíveis na organização. Cada registro corresponde a um cargo específico e contém informações sobre o nome do cargo.

| Coluna             | Tipo de Dados     | Descrição                                                              |
|--------------------|-------------------|------------------------------------------------------------------------|
| `id`               | `INTEGER`         | Chave primária, identificador único do cargo.                          |
| `cargo`            | `VARCHAR`         | Nome do cargo.                                                         |
| `created_at`       | `TIMESTAMP`       | Data e hora em que o registro foi criado.                             |
| `updated_at`       | `TIMESTAMP`       | Data e hora da última atualização do registro.                        |

## Tabela `users`

A tabela `users` armazena informações detalhadas sobre os operadores do sistema. Cada registro corresponde a um usuário específico e contém informações sobre o nome, email, senha, nível de acesso, token de recuperação de senha e data de criação/atualização do usuário.

| Coluna             | Tipo de Dados     | Descrição                                                              |
|--------------------|-------------------|------------------------------------------------------------------------|
| `id`               | `INTEGER`         | Chave primária, identificador único do usuário.                          |
| `name`             | `VARCHAR`         | Nome do usuário.                                                         |
| `email`            | `VARCHAR`         | Endereço de email do usuário.                                           |
| `email_verified_at` | `TIMESTAMP`       | Data e hora em que o email do usuário foi verificado.                 |
| `password`         | `VARCHAR`         | Senha do usuário.                                                       |
| `level`            | `VARCHAR`         | Nível de acesso do usuário.                                             |
| `remember_token`   | `VARCHAR`         | Token de recuperação de senha do usuário.                               |
| `created_at`       | `TIMESTAMP`       | Data e hora em que o registro foi criado.                             |
| `updated_at`       | `TIMESTAMP`       | Data e hora da última atualização do registro.                        |

