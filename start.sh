PORT=${PORT:-8080}

echo "Starting Laravel on port $PORT"
php -S 0.0.0.0:$PORT -t public