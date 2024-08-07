importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyDtuGtDTSefhB9ztK6H9FBAmaig5TrDbTI",
    authDomain: "raja-gadai-49960.firebaseapp.com",
    projectId: "raja-gadai-49960",
    storageBucket: "raja-gadai-49960.appspot.com",
    messagingSenderId: "586849902994",
    appId: "1:586849902994:web:d00b0a9192e9b0b337614b",
    measurementId: "G-7F73G0VN4S"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});