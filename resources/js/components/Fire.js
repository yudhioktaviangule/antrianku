const { default: axios } = require("axios");
window.initFirebase =async(onInit)=>{

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
    
      
      
      window.sendTokenToServer = async(token)=>{
          const id = window.idUsr;
          const {data} = await axios.get(`api/fcm?user=${id}&token=${token}`);
          onInit();
      }
    
      window.messaging = firebase.messaging();
      messaging.getToken({vapid:$("vapid").html()}).then(currentToken=>{
          if(currentToken){
              sendTokenToServer(currentToken);
          }else{
            console.log('No registration token available. Request permission to generate one.');
          }
      }).catch((err) => {
         console.log('An error occurred while retrieving token. ', err);
        
      });
      
} 