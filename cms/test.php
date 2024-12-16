<?php


if (!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) || getIPCountry($_SERVER['REMOTE_ADDR']) != "Bangladesh") {
    echo '<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        font-family: sans-serif;
    }

    p {
        background-color: #f44336;
        color: white;
        padding: 20px;
        border-radius: 10px;
        font-size: 2em;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    </style>';
    echo '<p>Ovijat IT Team 01632950179<br>Your IP is blocked. Please contact administration.<br>Disable VPN and try again.</p>';
    die();
}

function getIPCountry($ip) {
    $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    if (property_exists($ipdat, 'geoplugin_countryName')) {
        $country = $ipdat->geoplugin_countryName;
    } else {
        $country = "Unknown";
    }
    return $country;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EOvijat</title>


<style>
  * {
    box-sizing: border-box;
    font-family: Arial, sans-serif;
  }

  h1 {
    text-align: center;
    font-size: 30px;
    margin-bottom: 20px;
    color: #4CAF50;
  }
  p {
    text-align: center;
    font-size: 15px;
    margin-bottom: 20px;
    color:rgb(226, 194, 12);
  }

  form {
    max-width: 400px;
    margin: 0 auto;
    text-align: left;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 10px #ccc;
  }

  input {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
  }

  button:hover {
    background-color: #45a049;
  }
</style>
</head>

<body>
<h1>Ovijat Raffle Draw</h1>
<p>Powered by Ovijat IT 01632950179</p>

<form name="submit-to-google-sheet" id="form">
  <input name="email" type="email" placeholder="Email ইমেইল" required>
  <input name="name" type="text" placeholder="Name নাম" required>
  <input name="address" type="text" placeholder="Address ঠিকানা" required>
  <input name="phone" type="text" placeholder="Phone ফোন" required>
  <input name="qr" type="number" placeholder="QR Code কোড" required>
  <input name="timedate" type="hidden" value="<?php echo date('YmdHis'); ?>">
  <button type="submit">Submit</button>
</form>

  <div id="msg" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 10px; border-radius: 10px; box-shadow: 0 0 10px #ccc;"></div>

  <script>
    document.querySelector('form').addEventListener('submit', e => {
      const inputs = document.querySelectorAll('input[required]');
      const allFilled = Array.from(inputs).every(input => input.value != '');
      if (!allFilled) {
        e.preventDefault();
        alert('Please fill out all fields');
      }
    });
    

    document.querySelector('button[type=submit]').addEventListener('click', e => {
      e.target.style.display = 'none';

      const form = document.querySelector('form[name=submit-to-google-sheet]');
      form.style.display = 'none';

      msg.innerHTML = 'Please Wait...';
      msg.style.display = 'block';
      msg.style.color = 'red';
      msg.style.marginTop = '10px';
      msg.style.animation = 'blinker 3s linear infinite';

      const style = document.createElement('style');
      style.innerHTML = `
        @keyframes blinker { 
          50% { opacity: 0; }
        }
      `;
      document.head.appendChild(style);
    });
    const scriptURL = 'https://script.google.com/macros/s/AKfycbyW9NyJrWDMbt9ANoVD-ssYrlhcCA69ebP-dQX3pgQmN_DNumAl4VkeAdexf_zNlTa5Bw/exec'
    const form = document.forms['submit-to-google-sheet']
    const msg = document.getElementById('msg');

    form.addEventListener('submit', e => {
      e.preventDefault()
      fetch(scriptURL, { method: 'POST', body: new FormData(form)})
        .then(response => {
          if (response.ok) {
            msg.style.display = 'block';
            msg.style.fontSize = '3em';
            msg.style.textAlign = 'center';
            msg.innerHTML = 'Success!';
            msg.style.backgroundColor = '#4CAF50';
            msg.style.color = 'white';
            form.style.display = 'none';
            window.addEventListener('beforeunload', e => e.preventDefault());
            const button = document.createElement('button');
            button.style.display = 'block';
            button.style.margin = '10px auto';
            button.style.width = '100%';
            button.innerHTML = 'Visit our Facebook Page';
            button.onclick = () => window.open('https://www.facebook.com/ovijatfood', '_self');
            document.body.appendChild(button);
          } else {
            msg.style.display = 'block';
            msg.style.backgroundColor = '#f44336';
            msg.innerHTML = 'Error!';
          }
        })
        .catch(error => {
          msg.style.display = 'block';
          msg.style.backgroundColor = '#f44336';
          msg.innerHTML = 'Error!' + error.message;
        })
    })
  </script>
</body>