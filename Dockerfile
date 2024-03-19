# Use a imagem Sail do Laravel como base
FROM laravelsail/php81-composer:latest

# Instale o Ghostscript
RUN apt-get update && \
    apt-get install -y ghostscript && \
    rm -rf /var/lib/apt/lists/*
