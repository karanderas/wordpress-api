FROM node:10

# Create app directory
WORKDIR /usr/src/app

RUN mkdir -p /usr/src/app/appjs

# Install app dependencies
# A wildcard is used to ensure both package.json AND package-lock.json are copied
# where available (npm@5+)
COPY package*.json ./
COPY server.js ./
COPY appjs ./appjs

RUN npm install
# If you are building your code for production
# RUN npm ci --only=production

# Bundle app source
EXPOSE 8080
CMD [ "node", "server.js" ]