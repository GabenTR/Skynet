<?php
  session_start();
  $titre="login";
  //BDD (connexion)
  include_once("bdd.php");
  //Scripts_bdd
  include_once("profils.php");
  //HEAD
  include("head.php");
?>
<table id="page-table"><tr><td id="page-td">
    <div id="global">
      <div class="login_img"></div>
      <div id="login_text">
        <?php
        //SERVER ONLINE/OFFLINE
        $server = true;
        if ($server == true): ?>
          <p>SYSTEM ONLINE</p>
        <?php else: ?>
          <p><font color="#fa2537">SYSTEM OFFLINE</font></p>
        <?php endif; ?>
      </div>
      <div class="login_area">
        <?php
        if (!isset($_POST['username'])){ /*Dans un premier temps, on vérifie donc que le visiteur n'est pas connecté, 
        ensuite on regarde si la variable $_POST['pseudo'] est remplie, si ce n'est pas le cas, 
        c'est que notre visiteur vient d'arriver et on lui affiche le login.*/
        ?>
        <!-- ******************************* !-->
          <form method="post" action="login.php" autocomplete="off">
            <p>
              <label for="user_login">
                <!-- Username -->
               <input type="text" name="username" id="user_login" placeholder='Username'>
              </label>
            </p>
            <p>
              <label for="user_pass">
                <!-- Password -->
                <input type="password" name="password" id="user_pass" placeholder='Password'>
              </label>
            </p>
            <div id="button_login">
              <input type="submit" name="buttonlog" value="Log In">
            </div>
            <div id="horloge">
              <!-- <input type="text" readonly="readonly" name="display" size="15" value=""> -->
            </div>
          </form>
        <!-- ******************************* !-->
        <?php
        }
        else
        {
            //VERIFICATION
            if (empty($_POST['username']) || empty($_POST['password']) ) //Oublie d'un champ
            {
              echo '<div class="login_text_message"><p>Une erreur s\'est produite pendant votre identification.
              Merci de bien vouloir remplir tous les champs.</p>
              <p><a href="./login.php">Retour</a></p></div>';
            }
            else //On check le mot de passe
            {
              check_profile($bdd, $_POST['username'], $_POST['password']);
            }
            echo '</div></body></html>';
        }
        ?>

      </div>
		</div>
    </div><!-- #global -->
</td></tr></table>
<?php
  //FOOTER
  include("footer.php");
?>