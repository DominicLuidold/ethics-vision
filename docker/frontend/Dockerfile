# syntax=docker/dockerfile:1

FROM node:18.16-alpine

WORKDIR /app

RUN yarn global add @angular/cli

COPY package.json yarn.lock ./
RUN yarn install

COPY . .

ENTRYPOINT ng serve --host 0.0.0.0
