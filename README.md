#Server Setup

## Start Docker (Linux)
    sudo systemctl start docker

## Build images
    docker compose build

## Start everything
    docker compose up -d

## Or do both at once
    docker compose up -d --build
