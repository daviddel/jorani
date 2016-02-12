<?php 
/**
 * This view is included into all desktop full views. It contains the footer of the application.
 * @copyright  Copyright (c) 2014-2016 Benjamin BALET
 * @license      http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link            https://github.com/bbalet/jorani
 * @since         0.1.0
 */
?>
                    </div><!-- /span12 -->
                </div><!-- /row -->
            </div><!-- /container -->
        <div id="push"></div>
    </div><!-- /wrap -->
    <!-- FOOTER -->
    <div class="row" id="footer">
      <div class="span4">&copy; Kozikaza</div>
      <div class="span4">
          <center>
              <img src="<?php echo base_url();?>assets/images/kzkz_logo_small.png" style="margin-top:-6px;">&nbsp;&nbsp;
              <b>
<?php switch ($language_code){
    case 'fr' : echo '<a class="anchor" href="https://www.kozikaza.com/" target="_blank">Kozikaza</a>'; break;
    default : echo '<a class="anchor" href="https://www.kozikaza.com/" target="_blank">Kozikaza</a>'; break;
} ?>
                  </b>&nbsp;&nbsp;v0.4.5
          </center>
      </div>
      <div class="span4">&nbsp;</div></div>
    </div>
</body>
</html>
