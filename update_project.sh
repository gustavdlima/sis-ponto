#!/bin/bash

# Função para calcular o tempo
time_command() {
  local start_time=$(date +%s)
  echo "Executando: $1"
  eval $1
  local end_time=$(date +%s)
  local duration=$((end_time - start_time))
  echo "Tempo decorrido para '$1': ${duration}s"
  echo "---------------------------------------------"
}

section() {
  echo ""
  echo "============================================="
  echo "$1"
  echo "============================================="
  echo ""
}

# Substituir texto nos arquivos dentro do diretório 'frontend'
replace_text() {
  search_text="$1"
  replace_text="$2"

  echo "Procurando arquivos no diretório 'frontend' que contêm: $search_text..."
  start_time=$(date +%s)

  # Limita a busca ao diretório 'frontend' e seus subdiretórios
  find frontend -type f -exec grep -l "$search_text" {} \; | xargs -I {} sed -i "s|$search_text|$replace_text|g" {}

  end_time=$(date +%s)
  duration=$((end_time - start_time))
  echo "Substituição concluída em $duration segundos."
}

section "Atualizando repositório"
time_command "git pull"

section "Atualizando URLs nos arquivos no diretório 'frontend'"
replace_text "http://localhost:8000" "http://10.20.10.34:8000"

section "Atualizando dependências do backend (Composer)"
cd backend || exit
time_command "yes | sudo composer install"  # Automação do "yes" com sudo
cd ..

section "Atualizando dependências do frontend e construindo projeto"
cd frontend || exit
time_command "sudo npm install"
time_command "sudo npm run build"
time_command "sudo npm install -g serve"
cd ..

section "Processo concluído!"
