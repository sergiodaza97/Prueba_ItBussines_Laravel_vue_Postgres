FROM node:14-alpine

USER root

COPY ./ /usr/src/app

WORKDIR /usr/src/app

RUN npm install