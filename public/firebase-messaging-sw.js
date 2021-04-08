importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
var firebaseConfig = {
    apiKey: "AIzaSyAiMS4VEPYNwcNfqCkqkHnzwopX7-bhHuI",
    authDomain: "antrian-2297e.firebaseapp.com",
    projectId: "antrian-2297e",
    storageBucket: "antrian-2297e.appspot.com",
    messagingSenderId: "296520279617",
    appId: "1:296520279617:web:459aed88a7fdb273d288c0",
    measurementId: "G-71SP3TW0VY"
  };
  firebase.initializeApp(firebaseConfig);
  const message = firebase.messaging();
 