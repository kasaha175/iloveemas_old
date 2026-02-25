# TODO - Deployment Files Creation

## Task: Create deployment configuration files for iloveemas

- [x] 1. Create GitHub Actions Workflow (.github/workflows/deploy.yml)
  - rsync sync to /var/www/iloveemas/
  - docker compose up -d --build
  - docker exec for chmod 777 logs & cache
  - docker image prune -f

- [x] 2. Create Nginx Server Block (iloveemas.conf)
  - Reverse proxy from iloveemas.com to http://127.0.0.1:8082
  - Headers: X-Real-IP, X-Forwarded-For, Host, X-Forwarded-Proto
