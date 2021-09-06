const messaging = firebase.messaging();


messaging.onMessage((payload) => {
    console.log('Mensaje recibido. ', payload);
    // [START_EXCLUDE]
    // Update the UI to include the received message.
    //appendMessage(payload);
    console.log(payload)
    // [END_EXCLUDE]
});

clearMessages();
showToken('loading...');

function resetUI() {
    clearMessages();
    showToken('loading...');
    // [START get_token]
    // Get registration token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    messaging.getToken({vapidKey: 'BFdaXnUQ8NiRyhg3tImxr6FBCSoNMBK1oAQgrcqMHi7imKuQYxdd9Lq6hjWGcKR29xQctT7YvHyGkl5v5dN6VBs'}).then((currentToken) => {
        if (currentToken) {
            sendTokenToServer(currentToken);
            updateUIForPushEnabled(currentToken);
        } else {
            // Show permission request.
            console.log('No registration token available. Request permission to generate one.');
            // Show permission UI.
            updateUIForPushPermissionRequired();
            setTokenSentToServer(false);
        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        showToken('Error retrieving registration token. ', err);
        setTokenSentToServer(false);
    });
    // [END get_token]
}

function showToken(currentToken) {
    // Show token in console and UI.
    //const tokenElement = document.querySelector('#token');
    console.log(currentToken)
}

function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
        console.log('Sending token to server...');
        // TODO(developer): Send the current token to your server.
        setTokenSentToServer(true);

        console.log(currentToken)
    } else {
        console.log(currentToken)
    }
    setToServer(currentToken);

}

function isTokenSentToServer() {
    return window.localStorage.getItem('sentToServer') === '1';
}

function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
}

function showHideDiv(divId, show) {

}

function requestPermission() {
    console.log('Requesting permission...');
    // [START request_permission]
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
            // TODO(developer): Retrieve a registration token for use with FCM.
            // [START_EXCLUDE]
            // In many cases once an app has been granted notification permission,
            // it should update its UI reflecting this.
            resetUI();
            // [END_EXCLUDE]
        } else {
            console.log('Unable to get permission to notify.');
        }
    });
    // [END request_permission]
}


function deleteToken() {
    // Delete registraion token.
    // [START delete_token]
    messaging.getToken().then((currentToken) => {
        messaging.deleteToken(currentToken).then(() => {
            console.log('Token deleted.');
            setTokenSentToServer(false);
            // [START_EXCLUDE]
            // Once token is deleted update UI.
            resetUI();
            // [END_EXCLUDE]
        }).catch((err) => {
            console.log('Unable to delete token. ', err);
        });
        // [END delete_token]
    }).catch((err) => {
        console.log('Error retrieving registration token. ', err);
        showToken('Error retrieving registration token. ', err);
    });

}


function appendMessage(payload) {
    const messagesElement = document.querySelector('#messages');
    const dataHeaderElement = document.createElement('h5');
    const dataElement = document.createElement('pre');
    dataElement.style = 'overflow-x:hidden;';
    dataHeaderElement.textContent = 'Received message:';
    dataElement.textContent = JSON.stringify(payload, null, 2);
    messagesElement.appendChild(dataHeaderElement);
    messagesElement.appendChild(dataElement);
}

// Clear the messages element of all children.
function clearMessages() {

}

function updateUIForPushEnabled(currentToken) {

}

function updateUIForPushPermissionRequired() {
}

resetUI();
const tokenWb = $('meta[name="csrf-token"]').attr('content');//token de seguridad
function setToServer(currentToken) {

    const options = {
        method: 'POST',
        body: JSON.stringify({
            'token': currentToken,
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-Token': tokenWb
        }
    };


    fetch('/guardar/token', options)
        .then((res) => res.json())
        .then((res) => {


            if (res.status === 'success') {
                console.log(res.message)
            } else {
                console.log(res.message)
            }


        });


}
