# syntax=docker/dockerfile:1

FROM node:18.16-alpine

WORKDIR /app

RUN yarn global add @angular/cli

COPY ./docker/frontend/files/bin/entrypoint.development.sh /bin/entrypoint.sh

ENTRYPOINT sh /bin/entrypoint.sh
