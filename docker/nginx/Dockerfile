FROM node:20.0.0 as build-frontend

WORKDIR /app

COPY ./package.json ./package-lock.json /app/

RUN npm install

COPY . /app

RUN npm run build

FROM nginx:1.19.10-alpine

COPY --from=build-frontend /app/public /app/public

# COPY ./nginx/default /etc/nginx/conf.d/default.conf

RUN rm -rf /etc/nginx/conf.d/default.conf

WORKDIR /app

RUN ls -la public/build/assets
RUN ls -la /app

CMD ["nginx", "-g", "daemon off;"]
