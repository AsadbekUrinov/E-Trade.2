<?php
use App\meta;

require_once (app_path().'/meta.php'); 
$api = new meta();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>OnlineTrader - Deactivator</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css"/>
    <style type="text/css">
      body, html {
        background: #F7F7F7;
      }
    </style>
  </head>
  <body>
    <div class="container"> 
      <div class="section" >
        <div class="column is-6 is-offset-3">
          <center>
            <h1 class="title" style="padding-top: 20px">OnlineTrader Deactivator</h1><br>
          </center>
          <div class="box">
            <article class="message is-success">
              <div class="message-body">
                Click on deactivate license to deactivate and remove the currently installed license from this installation, So that you can activate the same license on some other domain.
              </div>
            </article>
            <?php
              if(!empty($_POST)){
               
                $deactivate_response = $api->deactivate_license();
                if(empty($deactivate_response)){
                  $msg='Server is unavailable.';
                }else{
                  $msg=$deactivate_response['message'];
                }
                if($deactivate_response['status'] != true){ ?>
                  <form action="revoke" method="POST">
                    <div class="notification is-danger"><?php echo ucfirst($msg); ?></div>
                    <input type="hidden" name="something">
                    <center>
                      <button type="submit" class="button is-warning">Deactivate License</button>
                    </center>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  </form><?php
                }else{ ?>
                  <div class="notification is-success"><?php echo ucfirst($msg); ?></div><?php 
                }
              }else{ ?>
                <form action="revoke" method="POST">
                  <input type="hidden" name="something">
                  <center>
                    <button type="submit" class="button is-warning">Deactivate License</button>
                  </center>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form><?php 
              } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="content has-text-centered">
      <p>Copyright <?php echo date('Y'); ?> Brynamics, All rights reserved.</p><br>
    </div>
  </body>
</html>