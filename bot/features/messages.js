const axios = require('axios');
const {
 BASE_URL,
} = require('../config');

const checkStatus = async () => {
 try {
  const response = await axios.get(
   BASE_URL
  );
  return response;
 } catch (error) {
  console.log(error);
 }
};

const message_whatsapp = async (
 image,
 text
) => {};

const testing = () => {
 console.log('yaya');
};

module.exports = {
 testing,
 checkStatus,
};
