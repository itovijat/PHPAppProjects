<form name="submit-to-google-sheet">

  <input name="email" type="email" placeholder="Email" required>
  <input name="name" type="text" placeholder="Name" required>
  <input name="address" type="text" placeholder="Address" required>
  <input name="phone" type="text" placeholder="Phone" required>
  <input name="qr" type="number" placeholder="QR Code" required>
  <input name="timedate" type="hidden" value="<?php echo date('YmdHis'); ?>">




  <button type="submit">Send</button>
  </form>
  
  <script>
    const scriptURL = 'https://script.google.com/macros/s/AKfycbyW9NyJrWDMbt9ANoVD-ssYrlhcCA69ebP-dQX3pgQmN_DNumAl4VkeAdexf_zNlTa5Bw/exec'
    const form = document.forms['submit-to-google-sheet']
  
    form.addEventListener('submit', e => {
      e.preventDefault()
      fetch(scriptURL, { method: 'POST', body: new FormData(form)})
        .then(response => console.log('Success!', response))
        .catch(error => console.error('Error!', error.message))
    })
  </script>