var error = document.getElementById('error');
if(error != null) {
    //err = document.getElementById('error').innerText;
    var err = $('#error').text();
    //cut space
    err = err.replace(/\s+/g, '');
    if(err == 'email') {
       swal("Please enter username!", " ", "error");
    }
    else{
        swal("Please enter password!", " ", "error");
    }
}

var thongbao = document.getElementById('thongbao');
if(thongbao != null) {
    //err = document.getElementById('error').innerText;
    var tb = $('#thongbao').text();
    //cut space
    tb = tb.replace(/\s+/g, '');
    if(tb == 'incorrect') {
        swal("Username or password incorrect!", " ", "error");
    }
}

var success = document.getElementById('success');
if(success != null) {
    //err = document.getElementById('error').innerText;
    var send_success = $('#success').text();
    //cut space
    send_success = send_success.replace(/\s+/g, '');
    if(send_success == 'send_success') {
        swal("Success!", "We have send email to you. Please check your inbox.", "success");
    }
}