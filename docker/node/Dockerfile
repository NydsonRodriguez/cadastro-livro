FROM node:14.17.6

RUN mkdir /app
WORKDIR /app

COPY . .

RUN npm install -g @angular/cli@11.2.18
RUN npm install
CMD ["ng", "serve", "--host", "0.0.0.0"]

#EXPOSE 4200