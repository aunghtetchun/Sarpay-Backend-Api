FROM node:14.16.0-alpine3.13
RUN addgroup app && adduser -S -G app app
USER app

WORKDIR /app
RUN mkdir data
COPY package*.json ./
RUN composer install
COPY . .
#ENV API_URL=http://fgfhello.com/
EXPOSE 3000
CMD ["php", "artisan", "serve"]
#CMD command(example===[“npm”, “start”])
