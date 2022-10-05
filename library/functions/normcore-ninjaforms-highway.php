<?php
/***************************************************************
* Ninja Forms Init
****************************************************************/

add_action( 'init', function(){
  if( ! isset( $_REQUEST[ 'async_form' ] ) ) return;

  global $wp_scripts;

  // Clear default loaded scripts.
  unset( $wp_scripts->registered );

  $form_id = absint($_REQUEST['form_id']);

  ob_start();
  $form = do_shortcode( "[ninja_forms id='{$form_id}']");
  ob_get_clean();

  ob_start();
  NF_Display_Render::output_templates();
  $templates = ob_get_clean();

  $response = [
    'form' => $form,
    'scripts' => $wp_scripts->registered,
    'templates' => $templates
  ];
  echo json_encode( $response );
  die();
});

add_action( 'wp_enqueue_scripts', function(){
  // Make sure that backbone is enqueued on the page.
  wp_enqueue_script( 'backbone' );
  // Enqueue styles
  wp_enqueue_style('nf-display-css', content_url('/plugins/ninja-forms/assets/css/display-opinions-light.css'));
});


// Adds a script to the footer.
add_action( 'wp_footer', function() {
  ?>
  <script type="text/javascript">

  var NinjaFormsAsyncForm = function(formID, page, targetContainer) {
    this.formID = formID;
    this.targetContainer = targetContainer;
    this.page = page;

    this.formHTML;
    this.formTemplates;
    this.formScripts;

    this.fetch = function(callback) {
        jQuery.post(this.page, { async_form: true, form_id: this.formID }, this.fetchHandler.bind(this))
              .then(callback);
    }
    this.fetchHandler = function(response) {
        response = JSON.parse( response );

        window.nfFrontEnd = window.nfFrontEnd || response.nfFrontEnd;
        window.nfi18n = window.nfi18n || response.nfi18n || {};

        this.formHTML = response.form;
        this.formTemplates = response.templates;
        this.formScripts = response.scripts;
    }

    this.load = function(cb) {
        this.loadFormHTML(this.formHTML, this.targetContainer);
        this.loadTemplates(this.formTemplates);
        this.loadScripts(this.formScripts);
        cb();
    }

    this.loadFormHTML = function(form, targetContainer) {
        jQuery(targetContainer).append( form );
    }
    this.loadTemplates = function(templates) {
        jQuery(targetContainer).append(templates);
    }
    this.loadScripts = function(scripts) {
        jQuery.each( scripts, function( nfScript ){
            var script = document.createElement('script');
            eval( scripts[nfScript].extra.data );
            window.nfFrontEnd = window.nfFrontEnd || nfFrontEnd;
            script.setAttribute('src',scripts[nfScript].src);
            var appendChild = document.head.appendChild(script);
        });
    }

    this.remove = function() {
        jQuery(this.targetContainer).empty();
        window.form = null;
        window.nfForms = [];
    }
  }
  </script>
  <?php
}, 100);

?>
