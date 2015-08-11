<?php
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
        <form name="log" autocomplete="off">
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
      </div>
		</div>
    </div><!-- #global -->
</td></tr></table>
<?php
  //FOOTER
  include("footer.php");
?>