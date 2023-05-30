const {
 Client,
 LocalAuth,
} = require('whatsapp-web.js');

const client = new Client({
 authStrategy: new LocalAuth(),
});

const {
 testing,
 checkStatus,
} = require('./features/messages');

// const pesan = new checkStatus();

const axios = require('axios');
const {
 BASE_URL,
 IMAGE_URL,
} = require('./config');

// console.table(checkStatus);

const cek = axios({
 url: BASE_URL,
 method: 'get',
})
 .then((response) => {
  console.log(
   IMAGE_URL +
    response.data.meta.message
     .proof_of_payment
  );
 })
 .catch((err) => {
  //   console.log(err);
 });
console.log(cek);

try {
 client.on('qr', (qr) => {
  qrcode.generate(qr, {
   small: true,
  });
 });

 client.on('ready', () => {
  console.log('Client is Ready');
 });

 client.on('message', async (msg) => {
  const text =
   msg.body.toLowerCase() || '';

  if (text === 'ping') {
   msg.sendMessage('pong');
  }
 });
} catch (error) {
 console.log(error);
}

client.initialize();
