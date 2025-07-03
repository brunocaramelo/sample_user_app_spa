
#!/bin/bash
WEBSERVER_PORT=8003

for arg in "$@"; do
  case $arg in
    --webserver-port=*)
      WEBSERVER_PORT="${arg#*=}"
      shift
      ;;
  esac
done

php artisan migrate

php artisan optimize

php artisan octane:frankenphp --port=$WEBSERVER_PORT

