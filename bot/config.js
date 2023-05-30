module.exports = {
 API_KEY: '1234123',
 BASE_URL:
  'http://127.0.0.1:8000/api/trigger_whatsapp',
 IMAGE_URL: (imageName) =>
  `http://127.0.0.1:8000/storage/uploads/orders/${imageName}`,
};
