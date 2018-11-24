<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">Update</strong>
        </div>
        <div class="card-body m-2">
          Update software E-Poin ke release terbaru dari repositori GitHub.
          <br>
          <br>
          <form method="post">
            <button name="update" class="btn btn-warning" style="text-align:center;">Update</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">Output</strong>
        </div>
        <div class="card-body">
          <div class="m-2">
            <?php
            if (isset($_POST['update'])) {
              $output = shell_exec ( "git pull 2>&1" );
              echo "<pre>$output</pre>";
            }
             ?>
          </div>
      </div>
    </div>
  </div>
