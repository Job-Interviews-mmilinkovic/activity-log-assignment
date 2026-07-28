#!/usr/bin/env bash
# Wait for a service to be ready
host="$1"
shift
cmd="$@"

until nc -z "$host" 3306; do
  echo "Waiting for MySQL..."
  sleep 2
done

until nc -z "$host" 6379; do
  echo "Waiting for Redis..."
  sleep 2
done

exec $cmd
