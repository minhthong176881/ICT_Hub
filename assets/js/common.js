
function xhrPost (url, data, success, error) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);

    //Send the proper header information along with the request
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() { // Call a function when the state changes.
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            if (success) {
                success(this.responseText);
            }
        } else if (this.readyState == XMLHttpRequest.DONE && this.status !== 200) {
            if (error) {
                error(this.status, this.responseText);
            }
        }
    }
    xhr.send(JSON.stringify(data));
}

function xhrGet (url, success, error) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);

    //Send the proper header information along with the request
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() { // Call a function when the state changes.
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            if (success) {
                success(this.responseText);
            }
        } else if (this.readyState == XMLHttpRequest.DONE && this.status !== 200) {
            if (error) {
                error(this.status, this.responseText);
            }
        }
    }
    xhr.send();
}

function virtualFormSubmit (url, data, method) {
    const form = document.createElement('form');
    form.method = method;
    form.action = url;

    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = key;
            hiddenField.value = data[key];

            form.appendChild(hiddenField);
        }
    }
    document.body.appendChild(form);

    form.submit();
}

