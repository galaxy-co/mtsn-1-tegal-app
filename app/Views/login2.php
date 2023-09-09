<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Login MTs N 1 Tegal</title>
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
        height: 100vh;
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
      <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <form class="bg-white rounded shadow-5-strong p-5" action="login" method="post">
              <?php if(session()->getFlashdata('msg')):?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('msg') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif;?>
                <div class="form-outline mb-4">
                  <input type="email" id="form1Example1" class="form-control" />
                  <label class="form-label" for="form1Example1">Username</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form1Example2" class="form-control" />
                  <label class="form-label" for="form1Example2">Password</label>
                </div>



                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
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