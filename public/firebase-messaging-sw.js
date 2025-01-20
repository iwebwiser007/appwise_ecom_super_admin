importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "YOUR_API_KEY",
    authDomain: "YOUR_AUTH_DOMAIN",
    projectId: "YOUR_PROJECT_ID",
    storageBucket: "YOUR_STORAGE_BUCKET",
    messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
    appId: "YOUR_APP_ID"
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    const title = payload.notification.title;
    const options = {
        body: payload.notification.body,
        icon: '/notification-icon.png',
        badge: '/badge-icon.png'
    };
    return self.registration.showNotification(title, options);
});
