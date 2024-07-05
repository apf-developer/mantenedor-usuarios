FROM node:20.5.0-alpine3.18

RUN addgroup vue && adduser -S -G vue vue

# Asigna usuario
USER vue

WORKDIR /app/

# Cambia permisos del usuario y grupo, copia archivo de dependencias
COPY --chown=vue package*.json .

# Instala las dependencias
RUN npm install

COPY --chown=vue . .

EXPOSE 5173

CMD ["npm", "run", "dev"]
