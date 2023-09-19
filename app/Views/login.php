<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Login MTs N 1 Tegal</title>
    <link rel="icon" href="<?= base_url('assets/')?>assets/img/logo.png" type="image/x-icon"/>
    <link rel="stylesheet" href="<?= base_url('login/')?>https://use.fontawesome.com/releases/v5.11.2/css/all.css" />

    <link rel="stylesheet" href="<?= base_url('login/')?>https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

    <link rel="stylesheet" href="<?= base_url('login/')?>css/mdb.min.css" />

    <link rel="stylesheet" href="<?= base_url('login/')?>css/style.css" />
</head>
<body>

  <header>
    <style>
      #intro {
        background-image: url(<?= base_url('login/img/login_bg.jpeg')?>);
        height: 110vh;
      }


      @media (min-width: 992px) {
        #intro {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
    </style>


<div id="intro" class="bg-image shadow-2-strong">
  <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.4);">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-md-8">
          <form class="rounded shadow-5-strong p-5" action="login" method="post" style="background-color: rgba(255, 255, 255, 0.9);">
            <div class="d-flex justify-content-center pb-3">
              <img src="<?= base_url('login/img/logo.png') ?>" alt="" height="70px">
            </div>
            <div class="d-flex justify-content-center pb-3">
              <h3 style="color: #078068; font-family: Fantasy;">MTs Negeri 1 Tegal</h3>
            </div>
            <?php if(session()->getFlashdata('msg')):?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= session()->getFlashdata('msg') ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif;?>
            <div class="form-outline mb-4">
              <input type="text" id="username" name="username" class="form-control" />
              <label class="form-label" for="username">Username</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="password" name="password" class="form-control" />
              <label class="form-label" for="password">Password</label>
            </div>

            <button type="submit" class="btn btn-success btn-block">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

   
  </header>

    <script type="text/javascript" src="<?= base_url('login/')?>js/mdb.min.js"></script>

    <script type="text/javascript" src="<?= base_url('login/')?>js/script.js"></script>
</body>
</html>