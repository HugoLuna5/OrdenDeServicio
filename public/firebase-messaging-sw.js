importScripts('https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.7.1/firebase-messaging.js');
importScripts('/js/init.js');
const messaging = firebase.messaging();


messaging.onBackgroundMessage(function (payload) {

    const promiseChain = clients
        .matchAll({
            type: "window",
            includeUncontrolled: true
        })
        .then(windowClients => {
            for (let i = 0; i < windowClients.length; i++) {
                const windowClient = windowClients[i];
                windowClient.postMessage(payload);
            }
        })
        .then(() => {
            return registration.showNotification(payload.notification.title,{
                body: payload.notification.body,
                icon: '/notification.png',
                actions: payload.data.actions,
                data: payload.data

            });
        });
    return promiseChain;

});




self.addEventListener('notificationclick', function (event) {
    console.log("Notification click Received");
    console.log(event);
    //event.notification.close();

    /*
    let action = event.notification.data.action;
    if (action === 'civil') {
        let notifi = JSON.parse(event.notification.data.notification);
        event.waitUntil(
            //clients.openWindow('/proteccion-civil/reports/show/'+notifi.uuid)
        );
    }else if(action === 'orders'){
        let notifi = JSON.parse(event.notification.data.order);
        event.waitUntil(
            //clients.openWindow('/company/orders/show/'+notifi.uuid)
        );
    }
     */



});
