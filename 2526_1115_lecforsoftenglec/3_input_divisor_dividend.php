<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Divide Two Numbers with SweetAlert</title>
  <link rel="stylesheet" href="vendor/bootstrap.css">
  <script src="vendor/axios.js"></script>
  <script src="vendor/sweetalert.js"></script>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header"><h1>Divide Two Numbers</h1></div>
          <div class="card-body">
            <form id="divideForm" autocomplete="off" onsubmit="return false;">
              <div class="form-group">
                <label>Numerator:</label>
                <input type="number" class="form-control" id="numerator" name="numerator" step="any" required />
              </div>
              <div class="form-group">
                <label>Denominator:</label>
                <input type="number" class="form-control" id="denominator" name="denominator" step="any" required />
              </div>
              <button type="submit" onclick="divideNumbers()" class="btn btn-primary float-right">Divide</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function divideNumbers() {
      var data = { 
        action: "divideNumber", 
        numerator: document.getElementById('numerator').value, 
        denominator: document.getElementById('denominator').value 
      };

      axios.post('3_receive_divisor_dividend.php', data, {
        headers: { 'Content-Type': 'application/json' }
      })
      .then(function (response) {
        console.log(response);
        var resp = response.data;
        if (resp.success) {
          Swal.fire({
            icon: 'success',
            title: 'Division Result',
            text: resp.message,
          });
        } else {
          Swal.fire({
            icon: 'warning',
            title: 'Notice',
            text: resp.message,
          });
        }
      })
      .catch(function (error) {
        var msg = 'Unknown error';
        if (error.response && error.response.data && error.response.data.message) {
          msg = error.response.data.message;
        } else if (error.message) {
          msg = error.message;
        }
        Swal.fire({
          icon: 'error',
          title: 'Request failed',
          text: msg
        });
      });
    }
  </script>
</body>
</html>
