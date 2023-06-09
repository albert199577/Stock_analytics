#!/bin/sh

# 啟動 Docker Compose
docker-compose up -d

# 找到指定的容器名稱
container_name="php"
container_id=$(docker-compose ps -q "$container_name")


if [ -z "$container_id" ]
then
    echo "無法找到容器：$container_name"
    exit 1
fi

# 進入容器交互式模式
docker exec -it "$container_id" sh