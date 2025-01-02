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

# Substituir texto em todos os arquivos
replace_text() {
  local search_text=$1
  local replace_text=$2
  echo "Substituindo '$search_text' por '$replace_text' em todos os arquivos..."
  find . -type f -exec sed -i "s|$search_text|$replace_text|g" {} \;
  echo "Substituição concluída!"
  echo "---------------------------------------------"
}

section "Atualizando repositório"
time_command "git pull"

section "Atualizando URLs nos arquivos"
replace_text "http://localhost:8000" "http://10.20.10.34:8000"

section "Atualizando dependências do backend (Composer)"
cd backend || exit
time_command "sudo composer install"
cd ..

section "Atualizando dependências do frontend e construindo projeto"
cd frontend || exit
time_command "sudo npm install"
time_command "sudo npm run build"
time_command "sudo npm install -g serve"
cd ..

section "Processo concluído!"
