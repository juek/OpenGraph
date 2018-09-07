<?php
/**
 * PHP class for Typesetter CMS plugin 'OpenGraph'
 *
 * @package     OpenGraph
 * @author      J. Krausz (http://typesetter-addons.grafikrausz.at)
 * @version     1.0-b3
 */

defined('is_running') or die('Not an entry point...');

class OpenGraph{

  static $ogp_data = array();
  static $ogp_settings = array();
  static $ogp_tags = array(

    array(
      'property' => 'og:type',
      'hint' => 'optional:  The type of your object, e.g., &quot;website&quot;. Depending on the type you specify, other properties may also be required.',
      'content' => '',
      'control' => array(
        'type' => 'select',
        'values' => array(
          array( 'value' => 'website',  'text' => 'website' ),
          array( 'value' => 'blog',     'text' => 'blog' ),
          array( 'value' => 'article',  'text' => 'article' ),
          array( 'value' => 'product',  'text' => 'product' ),
        ),
        'default_value' => array('website'),
        'attributes' => array(
          'class' => 'gpinput has-helper',
        ),
        'helpers' => array('type'),
      ),
    ),

    array(
      'property' => 'og:title',
      'hint' => '<strong>required:</strong> The title of your object as it should appear within the graph, e.g., &quot;Heading Page&quot;.',
      'content' => '',
      'inherit' => 1,
      'control' => array(
        'type' => 'text',
        'values' => array(''),
        'default_value' => array(''),
        'attributes' => array(
          'class' => 'gpinput has-helper',
          'placeholder' => 'the title must not be empty!',
          'required' => 'required',
        ),
        'helpers' => array('title', 'char_counter'),
      ),
    ),

    array(
      'property' => 'og:url',
      'hint' => '<strong>required:</strong> The canonical URL of your object that will be used as its permanent ID in the graph, e.g., &quot;http://www.imdb.com/title/tt0117500/&quot;',
      'content' => '',
      'inherit' => 1,
      'control' => array(
        'type' => 'text',
        'values' => array(''),
        'default_value' => array(''),
        'attributes' => array(
          'class' => 'gpinput has-helper',
          'placeholder' => 'the URL must not be empty!',
          'required' => 'required',
        ),
        'helpers' => array('url'),
      ),
    ),

    array(
      'property' => 'og:image',
      'hint' => '<strong>required:</strong> An image URL which should represent your object within the graph.',
      'content' => '',
      'inherit' => 1,
      'control' => array(
        'type' => 'text',
        'values' => array(''),
        'default_value' => array(''),
        'attributes' => array(
          'class' => 'gpinput has-helper',
          'placeholder' => 'the image URL must not be empty!',
          'required' => 'required',
        ),
        'helpers' => array('show_image','image','select_file'),
      ),
    ),

    array(
      'property' => 'og:site_name',
      'hint' => 'optional: If your object is part of a larger web site, the name which should be displayed for the overall site.',
      'content' => '',
      'inherit' => 1,
      'control' => array(
        'type' => 'text',
        'values' => array(''),
        'default_value' => array(''),
        'attributes' => array(
          'class' => 'gpinput has-helper',
          'placeholder' => '',
        ),
        'helpers' => array('site_name', 'char_counter'),
      ),
    ),

    array(
      'property' => 'og:description',
      'hint' => 'optional: A one to two sentence description of your object.',
      'content' => '',
      'inherit' => 1,
      'control' => array(
        'type' => 'textarea',
        'values' => array(''),
        'default_value' => array(''),
        'attributes' => array(
          'class' => 'gptextarea has-helper',
          'placeholder' => '',
        ),
        'helpers' => array('description', 'char_counter'),
      ),
    ),

    array(
      'property' => 'og:video',
      'hint' => 'optional: A URL to a video file that complements this object.',
      'content' => '',
      'inherit' => 1,
      'control' => array(
        'type' => 'text',
        'values' => array(''),
        'default_value' => array(''),
        'attributes' => array(
          'class' => 'gpinput has-helper',
          'placeholder' => '',
        ),
        'helpers' => array('video', 'select_file'),
      ),
    ),

    array(
      'property' => 'og:audio',
      'hint' => 'optional: A URL to an audio file to accompany this object.',
      'content' => '',
      'inherit' => 1,
      'control' => array(
        'type' => 'text',
        'values' => array(''),
        'default_value' => array(''),
        'attributes' => array(
          'class' => 'gpinput has-helper',
          'placeholder' => '',
        ),
        'helpers' => array('audio', 'select_file'),
      ),
    ),

    array(
      'property' => 'og:locale',
      'hint' => 'optional: The locale these tags are marked up in. Of the format language_TERRITORY. Default is en_US.',
      'content' => '',
      'control' => array(
        'type' => 'select',
        'values' => array(
          array( 'value' => '', 'text' => '--- none ---' ),
          array( 'value' => 'af_ZA', 'text' => 'af_ZA &rarr; Afrikaans' ),
          array( 'value' => 'ak_GH', 'text' => 'ak_GH &rarr; Akan' ),
          array( 'value' => 'am_ET', 'text' => 'am_ET &rarr; Amharic' ),
          array( 'value' => 'ar_AR', 'text' => 'ar_AR &rarr; Arabic' ),
          array( 'value' => 'as_IN', 'text' => 'as_IN &rarr; Assamese' ),
          array( 'value' => 'ay_BO', 'text' => 'ay_BO &rarr; Aymara' ),
          array( 'value' => 'az_AZ', 'text' => 'az_AZ &rarr; Azerbaijani' ),
          array( 'value' => 'be_BY', 'text' => 'be_BY &rarr; Belarusian' ),
          array( 'value' => 'bg_BG', 'text' => 'bg_BG &rarr; Bulgarian' ),
          array( 'value' => 'bn_IN', 'text' => 'bn_IN &rarr; Bengali' ),
          array( 'value' => 'br_FR', 'text' => 'br_FR &rarr; Breton' ),
          array( 'value' => 'bs_BA', 'text' => 'bs_BA &rarr; Bosnian' ),
          array( 'value' => 'ca_ES', 'text' => 'ca_ES &rarr; Catalan' ),
          array( 'value' => 'cb_IQ', 'text' => 'cb_IQ &rarr; Sorani Kurdish' ),
          array( 'value' => 'ck_US', 'text' => 'ck_US &rarr; Cherokee' ),
          array( 'value' => 'co_FR', 'text' => 'co_FR &rarr; Corsican' ),
          array( 'value' => 'cs_CZ', 'text' => 'cs_CZ &rarr; Czech' ),
          array( 'value' => 'cx_PH', 'text' => 'cx_PH &rarr; Cebuano' ),
          array( 'value' => 'cy_GB', 'text' => 'cy_GB &rarr; Welsh' ),
          array( 'value' => 'da_DK', 'text' => 'da_DK &rarr; Danish' ),
          array( 'value' => 'de_DE', 'text' => 'de_DE &rarr; German' ),
          array( 'value' => 'el_GR', 'text' => 'el_GR &rarr; Greek' ),
          array( 'value' => 'en_GB', 'text' => 'en_GB &rarr; English (UK)' ),
          array( 'value' => 'en_IN', 'text' => 'en_IN &rarr; English (India)' ),
          array( 'value' => 'en_PI', 'text' => 'en_PI &rarr; English (Pirate)' ),
          array( 'value' => 'en_UD', 'text' => 'en_UD &rarr; English (Upside Down)' ),
          array( 'value' => 'en_US', 'text' => 'en_US &rarr; English (US)' ),
          array( 'value' => 'eo_EO', 'text' => 'eo_EO &rarr; Esperanto' ),
          array( 'value' => 'es_CL', 'text' => 'es_CL &rarr; Spanish (Chile)' ),
          array( 'value' => 'es_CO', 'text' => 'es_CO &rarr; Spanish (Colombia)' ),
          array( 'value' => 'es_ES', 'text' => 'es_ES &rarr; Spanish (Spain)' ),
          array( 'value' => 'es_LA', 'text' => 'es_LA &rarr; Spanish' ),
          array( 'value' => 'es_MX', 'text' => 'es_MX &rarr; Spanish (Mexico)' ),
          array( 'value' => 'es_VE', 'text' => 'es_VE &rarr; Spanish (Venezuela)' ),
          array( 'value' => 'et_EE', 'text' => 'et_EE &rarr; Estonian' ),
          array( 'value' => 'eu_ES', 'text' => 'eu_ES &rarr; Basque' ),
          array( 'value' => 'fa_IR', 'text' => 'fa_IR &rarr; Persian' ),
          array( 'value' => 'fb_LT', 'text' => 'fb_LT &rarr; Leet Speak' ),
          array( 'value' => 'ff_NG', 'text' => 'ff_NG &rarr; Fulah' ),
          array( 'value' => 'fi_FI', 'text' => 'fi_FI &rarr; Finnish' ),
          array( 'value' => 'fo_FO', 'text' => 'fo_FO &rarr; Faroese' ),
          array( 'value' => 'fr_CA', 'text' => 'fr_CA &rarr; French (Canada)' ),
          array( 'value' => 'fr_FR', 'text' => 'fr_FR &rarr; French (France)' ),
          array( 'value' => 'fy_NL', 'text' => 'fy_NL &rarr; Frisian' ),
          array( 'value' => 'ga_IE', 'text' => 'ga_IE &rarr; Irish' ),
          array( 'value' => 'gl_ES', 'text' => 'gl_ES &rarr; Galician' ),
          array( 'value' => 'gn_PY', 'text' => 'gn_PY &rarr; Guarani' ),
          array( 'value' => 'gu_IN', 'text' => 'gu_IN &rarr; Gujarati' ),
          array( 'value' => 'gx_GR', 'text' => 'gx_GR &rarr; Classical Greek' ),
          array( 'value' => 'ha_NG', 'text' => 'ha_NG &rarr; Hausa' ),
          array( 'value' => 'he_IL', 'text' => 'he_IL &rarr; Hebrew' ),
          array( 'value' => 'hi_IN', 'text' => 'hi_IN &rarr; Hindi' ),
          array( 'value' => 'hr_HR', 'text' => 'hr_HR &rarr; Croatian' ),
          array( 'value' => 'ht_HT', 'text' => 'ht_HT &rarr; Haitian Creole' ),
          array( 'value' => 'hu_HU', 'text' => 'hu_HU &rarr; Hungarian' ),
          array( 'value' => 'hy_AM', 'text' => 'hy_AM &rarr; Armenian' ),
          array( 'value' => 'id_ID', 'text' => 'id_ID &rarr; Indonesian' ),
          array( 'value' => 'ig_NG', 'text' => 'ig_NG &rarr; Igbo' ),
          array( 'value' => 'is_IS', 'text' => 'is_IS &rarr; Icelandic' ),
          array( 'value' => 'it_IT', 'text' => 'it_IT &rarr; Italian' ),
          array( 'value' => 'ja_JP', 'text' => 'ja_JP &rarr; Japanese' ),
          array( 'value' => 'ja_KS', 'text' => 'ja_KS &rarr; Japanese (Kansai)' ),
          array( 'value' => 'jv_ID', 'text' => 'jv_ID &rarr; Javanese' ),
          array( 'value' => 'ka_GE', 'text' => 'ka_GE &rarr; Georgian' ),
          array( 'value' => 'kk_KZ', 'text' => 'kk_KZ &rarr; Kazakh' ),
          array( 'value' => 'km_KH', 'text' => 'km_KH &rarr; Khmer' ),
          array( 'value' => 'kn_IN', 'text' => 'kn_IN &rarr; Kannada' ),
          array( 'value' => 'ko_KR', 'text' => 'ko_KR &rarr; Korean' ),
          array( 'value' => 'ku_TR', 'text' => 'ku_TR &rarr; Kurdish (Kurmanji)' ),
          array( 'value' => 'ky_KG', 'text' => 'ky_KG &rarr; Kyrgyz' ),
          array( 'value' => 'la_VA', 'text' => 'la_VA &rarr; Latin' ),
          array( 'value' => 'lg_UG', 'text' => 'lg_UG &rarr; Ganda' ),
          array( 'value' => 'li_NL', 'text' => 'li_NL &rarr; Limburgish' ),
          array( 'value' => 'ln_CD', 'text' => 'ln_CD &rarr; Lingala' ),
          array( 'value' => 'lo_LA', 'text' => 'lo_LA &rarr; Lao' ),
          array( 'value' => 'lt_LT', 'text' => 'lt_LT &rarr; Lithuanian' ),
          array( 'value' => 'lv_LV', 'text' => 'lv_LV &rarr; Latvian' ),
          array( 'value' => 'mg_MG', 'text' => 'mg_MG &rarr; Malagasy' ),
          array( 'value' => 'mi_NZ', 'text' => 'mi_NZ &rarr; Maori' ),
          array( 'value' => 'mk_MK', 'text' => 'mk_MK &rarr; Macedonian' ),
          array( 'value' => 'ml_IN', 'text' => 'ml_IN &rarr; Malayalam' ),
          array( 'value' => 'mn_MN', 'text' => 'mn_MN &rarr; Mongolian' ),
          array( 'value' => 'mr_IN', 'text' => 'mr_IN &rarr; Marathi' ),
          array( 'value' => 'ms_MY', 'text' => 'ms_MY &rarr; Malay' ),
          array( 'value' => 'mt_MT', 'text' => 'mt_MT &rarr; Maltese' ),
          array( 'value' => 'my_MM', 'text' => 'my_MM &rarr; Burmese' ),
          array( 'value' => 'nb_NO', 'text' => 'nb_NO &rarr; Norwegian (bokmal)' ),
          array( 'value' => 'nd_ZW', 'text' => 'nd_ZW &rarr; Ndebele' ),
          array( 'value' => 'ne_NP', 'text' => 'ne_NP &rarr; Nepali' ),
          array( 'value' => 'nl_BE', 'text' => 'nl_BE &rarr; Dutch (België)' ),
          array( 'value' => 'nl_NL', 'text' => 'nl_NL &rarr; Dutch' ),
          array( 'value' => 'nn_NO', 'text' => 'nn_NO &rarr; Norwegian (nynorsk)' ),
          array( 'value' => 'ny_MW', 'text' => 'ny_MW &rarr; Chewa' ),
          array( 'value' => 'or_IN', 'text' => 'or_IN &rarr; Oriya' ),
          array( 'value' => 'pa_IN', 'text' => 'pa_IN &rarr; Punjabi' ),
          array( 'value' => 'pl_PL', 'text' => 'pl_PL &rarr; Polish' ),
          array( 'value' => 'ps_AF', 'text' => 'ps_AF &rarr; Pashto' ),
          array( 'value' => 'pt_BR', 'text' => 'pt_BR &rarr; Portuguese (Brazil)' ),
          array( 'value' => 'pt_PT', 'text' => 'pt_PT &rarr; Portuguese (Portugal)' ),
          array( 'value' => 'qc_GT', 'text' => 'qc_GT &rarr; Quiché' ),
          array( 'value' => 'qu_PE', 'text' => 'qu_PE &rarr; Quechua' ),
          array( 'value' => 'rm_CH', 'text' => 'rm_CH &rarr; Romansh' ),
          array( 'value' => 'ro_RO', 'text' => 'ro_RO &rarr; Romanian' ),
          array( 'value' => 'ru_RU', 'text' => 'ru_RU &rarr; Russian' ),
          array( 'value' => 'rw_RW', 'text' => 'rw_RW &rarr; Kinyarwanda' ),
          array( 'value' => 'sa_IN', 'text' => 'sa_IN &rarr; Sanskrit' ),
          array( 'value' => 'sc_IT', 'text' => 'sc_IT &rarr; Sardinian' ),
          array( 'value' => 'se_NO', 'text' => 'se_NO &rarr; Northern Sámi' ),
          array( 'value' => 'si_LK', 'text' => 'si_LK &rarr; Sinhala' ),
          array( 'value' => 'sk_SK', 'text' => 'sk_SK &rarr; Slovak' ),
          array( 'value' => 'sl_SI', 'text' => 'sl_SI &rarr; Slovenian' ),
          array( 'value' => 'sn_ZW', 'text' => 'sn_ZW &rarr; Shona' ),
          array( 'value' => 'so_SO', 'text' => 'so_SO &rarr; Somali' ),
          array( 'value' => 'sq_AL', 'text' => 'sq_AL &rarr; Albanian' ),
          array( 'value' => 'sr_RS', 'text' => 'sr_RS &rarr; Serbian' ),
          array( 'value' => 'sv_SE', 'text' => 'sv_SE &rarr; Swedish' ),
          array( 'value' => 'sw_KE', 'text' => 'sw_KE &rarr; Swahili' ),
          array( 'value' => 'sy_SY', 'text' => 'sy_SY &rarr; Syriac' ),
          array( 'value' => 'sz_PL', 'text' => 'sz_PL &rarr; Silesian' ),
          array( 'value' => 'ta_IN', 'text' => 'ta_IN &rarr; Tamil' ),
          array( 'value' => 'te_IN', 'text' => 'te_IN &rarr; Telugu' ),
          array( 'value' => 'tg_TJ', 'text' => 'tg_TJ &rarr; Tajik' ),
          array( 'value' => 'th_TH', 'text' => 'th_TH &rarr; Thai' ),
          array( 'value' => 'tk_TM', 'text' => 'tk_TM &rarr; Turkmen' ),
          array( 'value' => 'tl_PH', 'text' => 'tl_PH &rarr; Filipino' ),
          array( 'value' => 'tl_ST', 'text' => 'tl_ST &rarr; Klingon' ),
          array( 'value' => 'tr_TR', 'text' => 'tr_TR &rarr; Turkish' ),
          array( 'value' => 'tt_RU', 'text' => 'tt_RU &rarr; Tatar' ),
          array( 'value' => 'tz_MA', 'text' => 'tz_MA &rarr; Tamazight' ),
          array( 'value' => 'uk_UA', 'text' => 'uk_UA &rarr; Ukrainian' ),
          array( 'value' => 'ur_PK', 'text' => 'ur_PK &rarr; Urdu' ),
          array( 'value' => 'uz_UZ', 'text' => 'uz_UZ &rarr; Uzbek' ),
          array( 'value' => 'vi_VN', 'text' => 'vi_VN &rarr; Vietnamese' ),
          array( 'value' => 'wo_SN', 'text' => 'wo_SN &rarr; Wolof' ),
          array( 'value' => 'xh_ZA', 'text' => 'xh_ZA &rarr; Xhosa' ),
          array( 'value' => 'yi_DE', 'text' => 'yi_DE &rarr; Yiddish' ),
          array( 'value' => 'yo_NG', 'text' => 'yo_NG &rarr; Yoruba' ),
          array( 'value' => 'zh_CN', 'text' => 'zh_CN &rarr; Simplified Chinese (China)' ),
          array( 'value' => 'zh_HK', 'text' => 'zh_HK &rarr; Traditional Chinese (Hong Kong)' ),
          array( 'value' => 'zh_TW', 'text' => 'zh_TW &rarr; Traditional Chinese (Taiwan)' ),
          array( 'value' => 'zu_ZA', 'text' => 'zu_ZA &rarr; Zulu' ),
          array( 'value' => 'zz_TR', 'text' => 'zz_TR &rarr; Zazaki' )
        ),
        'default_value' => array(''),
        'attributes' => array(
          'class' => 'gpinput has-helper',
          'placeholder' => '',
        ),
        'helpers' => array('locale'),
      ),
    ),

  );




  /* 
   * Typesetter Action hook 
   */
  public static function GetHead() {
    global $page, $addonRelativeCode;
    if( \gp\tool::LoggedIn() ){
      $page->css_admin[] =    $addonRelativeCode . '/OpenGraph.css';
      $page->head_js[] =      $addonRelativeCode . '/OpenGraph.js';

      $ogp_helper_data = array();
      $ogp_helper_data['url_prefix']    = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://" ) . \gp\tool::ServerName();
      $ogp_helper_data['url']           = self::GetDefaultContent('og:url');
      $ogp_helper_data['type']          = self::GetDefaultContent('og:type');
      $ogp_helper_data['site_name']     = self::GetDefaultContent('og:site_name');
      $ogp_helper_data['title']         = self::GetDefaultContent('og:title');
      $ogp_helper_data['locale']        = self::GetDefaultContent('og:locale');
      $ogp_helper_data['description']   = self::GetDefaultContent('og:description');
      $ogp_helper_data['image']         = self::UrlPrefix( self::GetDefaultContent('og:image'), 'add' );
      $ogp_helper_data['video']         = self::UrlPrefix( self::GetDefaultContent('og:video'), 'add' );
      $ogp_helper_data['audio']         = self::UrlPrefix( self::GetDefaultContent('og:audio'), 'add' );

      $page->head_script .=   "\n" . 'var OpenGraphHelper_Defaults = ' . json_encode($ogp_helper_data, JSON_FORCE_OBJECT) . ';' . "\n\n";
    }

    self::GetOgpData();
    $page->head .= "\n<!-- OpenGraph start -->";
    foreach( self::$ogp_tags as $key => $tag_arr ){
      $property = $tag_arr['property'];
      if( isset(self::$ogp_data[$property]) ){
        $content = self::$ogp_data[$property];
        switch( $property ){
          case 'og:url':
          case 'og:image':
          case 'og:video':
          case 'og:audio':
            //$content = urlencode(self::UrlPrefix($content, 'add'));
            $content = self::UrlPrefix($content, 'add');
            break;
        }
      }else{
        $content = self::GetDefaultContent($property);
      }
      if( !empty($content) ){
        $page->head .= "\n" . '<meta property="' . $property . '" content="' . $content . '" />';
      }
    }
    $page->head .= "\n<!-- OpenGraph end -->\n";
  }





  /* 
   * Typesetter Filter hook 
   */
  public static function PageRunScript($cmd) {
    global $page, $langmessage, $addonRelativeCode;
    if( \gp\tool::LoggedIn() ){

      $page->admin_links[] = array(
        $page->requested, 
        '<i class="ogp-icon"></i> Open Graph', 
        'cmd=OpenGraphForm', 
        'title="set OpenGraph tags" class="ogp-button" data-cmd="gpabox"'
      );

      switch( $cmd ){
        case 'OpenGraphForm':
          self::GetOgpData();
          ob_start();
          echo  \gp\tool::Link('Admin_OpenGraph', 'Default Settings', '', 'class="gpsubmit" style="float:right;"');
          echo  '<h4 style="margin-top:0;">';
          echo    '<img src="' . $addonRelativeCode . '/img/OpenGraph-color.svg" class="ogp-logo-color" />';
          echo    'Open Graph &raquo; ' . $langmessage['page_options'];
          echo  '</h4>'; 
          self::OgpForm('page');
          echo  '<script>';
          echo  'OpenGraphHelpers.init();';
          echo  '</script>';
          $page->contentBuffer = ob_get_clean();
          return 'return';
          break;
        
        case 'SaveOgpData':
          self::SaveOgpData();
          return $cmd;
          break;
      }


    }
    return $cmd;
  }




  public static function AdminPage() {
    global $page, $addonRelativeCode;
    $page->jQueryCode .= "\n/* OpenGraph start */\n" . 'OpenGraphHelpers.init();' . "\n/* OpenGraph end */\n";
    
    $cmd = \gp\tool::GetCommand();
    if( $cmd == 'SaveOgpData' ){
      self::SaveOgpData();
    }

    echo  '<h3>';
    echo    '<img src="' . $addonRelativeCode . '/img/OpenGraph-color.svg" class="ogp-logo-color" />';
    echo    'Open Graph &raquo; Default Settings';
    echo  '</h3><br/>';
    self::GetOgpData();
    self::OgpForm('admin');
  }




  public static function GetDefaultContent($property) {
    global $page, $config, $addonRelativeCode, $langmessage;
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $content = '';
    $blog_page_title = self::GetBlogPageTitle();

    switch( $property ){

      case 'og:title':
        // use page label
        $content = $langmessage['unavailable'];
        if( $blog_page_title ){
          // Blog pages
          $content = str_replace('_', ' ', $blog_page_title);
        }elseif( isset($page->TitleInfo['label']) ){
          // Regular pages
          $content = $page->TitleInfo['label'];
        }elseif( isset($page->TitleInfo['lang_index']) ){
          // Special pages
          $content = gpOutput::SelectText($page->TitleInfo['lang_index']);
        }
        break;

      case 'og:type':
        // this is always 'website'
        $content = 'website';
        if( $page->gp_index == 'special_blog' || $page->gp_index == 'special_blog_categories' ){
          $content = 'blog';
        }
        if( $page->gp_index == 'special_blog' && $blog_page_title ){
          $content = 'article';
        }
        break;

      case 'og:url':
        // use page URL
        $content = $protocol . \gp\tool::ServerName() . \gp\tool::GetUrl($page->requested);
        break;

      case 'og:description':
        if( isset($page->TitleInfo['description']) ){
          // use page meta description
          $content = $page->TitleInfo['description'];
        }else{
          // use website meta description
          $content = $config['desc'];
        }
        break;

      case 'og:locale':
        // $content = self::GetPageLanguage();
        if( isset($config['opengraph']['og:locale']) ){
          // use default locale, if set
          $content = $config['opengraph']['og:locale'];
        }else{
          $content = '';
        }
        break;

      case 'og:site_name':
        // use website title
        $content = $config['title'];
        break;

      case 'og:image':
        if( isset($config['opengraph']['og:image']) ){
          // use default image, if set
          $content = $config['opengraph']['og:image'];
        }else{
          // use plugin's preset image
          $content = $protocol . \gp\tool::ServerName() . $addonRelativeCode . '/img/default_image.png';
        }
        break;

      case 'og:video':
        if( isset($config['opengraph']['og:video']) ){
          // use default video, if set
          $content = $config['opengraph']['og:video'];
        }else{
          $content = '';
        }
        break;

      case 'og:audio':
        if( isset($config['opengraph']['og:audio']) ){
          // use default audio, if set
          $content = $config['opengraph']['og:audio'];
        }else{
          $content = '';
        }
        break;
    }

    return $content;
  }




  public static function GetOgpData() {
    global $page, $addonPathData;
    $page_ogp_data = array();

    if( isset($page->TitleInfo['opengraph']) ){
      $page_ogp_data = $page->TitleInfo['opengraph'];
    }

    $blog_page_title = self::GetBlogPageTitle();
    if( $blog_page_title ){
      $ogp_data_file = $addonPathData . '/' . $page->gp_index . '.php'; 
      if( file_exists($ogp_data_file) ){
        include($ogp_data_file);
        if( !empty($ogp_data[$blog_page_title]) ){
          $page_ogp_data = $ogp_data[$blog_page_title];
        }
      }
    }

    foreach( self::$ogp_tags as $key => $tag_arr ){
      $property = $tag_arr['property'];
      if( isset($page_ogp_data[$property]) ){
        // stored property for page
        self::$ogp_data[$property] = $page_ogp_data[$property];
        self::$ogp_settings[$property] = 'custom';
      }else{
        // page property is not defined, get default value
        self::$ogp_data[$property] = self::GetDefaultContent($property);
        self::$ogp_settings[$property] = 'default';
      }
    }
  
    if( $page->title ){
      self::$ogp_data = \gp\tool\Plugins::Filter('OpenGraph', array(self::$ogp_data));
    }
    // msg('ogp_settings: ' . pre(self::$ogp_settings));
    // msg('ogp_data: ' . pre(self::$ogp_data));
  }




  public static function SaveOgpData() {
    global $page, $config, $gp_index, $gp_titles, $langmessage, $addonPathData;

    $opengraph_arr = array();
    // overwrite defaults with post values
    foreach( self::$ogp_tags as $key => $tag_arr ){
      $property = $tag_arr['property'];
      if( !empty($_POST[$property]) ){
        $content = trim($_POST[$property]);
        switch( $property ){
          case 'og:url':
          case 'og:image':
          case 'og:video':
          case 'og:audio':
            $content = self::UrlPrefix($content,'remove');
            break;
          default : 
            $content = htmlspecialchars($content);
        }
        $opengraph_arr[$property] = $content;
      }
    }

    $blog_page_title = self::GetBlogPageTitle(); // returns false if page is not Simple Blog generated

    if( !$page->gp_index ){
      $save_to = 'site_config'; // admin page, default values posted
    }elseif( $blog_page_title ){
      $save_to = 'blog_info';   // page is a Simple Blog subpage (post or category)
    }else{
      $save_to = 'gp_titles';   // regular page
    }

    switch( $save_to ){

      case 'gp_titles':
        $gp_titles[$page->gp_index]['opengraph'] = $opengraph_arr;
        \gp\admin\Tools::SavePagesPHP(true, true);
        break;

      case 'blog_info':
        // $page->gp_index will be 'special_blog' or 'special_blog_categories'
        $ogp_data_file = $addonPathData . '/' . $page->gp_index . '.php'; 
        $ogp_data = array();
        if( file_exists($ogp_data_file) ){
          // load existing data
          include($ogp_data_file);
        }
        $ogp_data[$blog_page_title] = $opengraph_arr;
        if( \gp\tool\Files::SaveData($ogp_data_file, 'ogp_data', $ogp_data) ){
          msg($langmessage['SAVED'] . ' (Simple Blog)');
        }else{
          msg($langmessage['OOPS'] . ' (Simple Blog)');
        }
        break;

      case 'site_config':
        $config['opengraph'] = $opengraph_arr;
        \gp\admin\Tools::SaveConfig(true, true);
        break;

    }

  }



 /**
  * For Simple Blog support
  * @return (string)title of single blog post or blog category page
  * @return (boolean)false if current page is not such a page
  */
  public static function GetBlogPageTitle(){
    global $page;
    return substr($page->requested, strlen($page->title . '/')); 
  }




  public static function OgpForm($render_mode='admin'){
    global $page, $langmessage, $config;
    // msg('$page = ' . pre(get_object_vars($page)));
    $form_action =      \gp\tool::GetUrl($page->requested);
    $data_cmd =         $page->gp_index ?  ' data-cmd="gppost" ' : '';
    $admin_box_close =  $page->gp_index ?  'admin_box_close ' : '';

    echo  '<form method="post" action="' . $form_action . '" id="ogp-form">';
    echo    '<table class="bordered full_width ogp-table">';
    echo      '<thead>';
    echo        '<tr>';
    echo          '<th class="gp_header">property</th>';
    echo          '<th class="gp_header">content</th>';
    echo        '</tr>';
    echo      '</thead>';
    echo      '<tbody>';

    foreach( self::$ogp_tags as $key => $tag_arr ){
      $property =  $tag_arr['property'];
      if( $render_mode == 'admin' && ($property == 'og:title' || $property == 'og:url' || $property == 'og:site_name' || $property == 'og:description') ){
        // on Admin Page/Defalt Settings don't render title, url, site_name and description
        continue;
      }

      $content = !empty(self::$ogp_data[$property]) ? self::$ogp_data[$property] : '' ;
      switch( $property ){
          case 'og:url':
          case 'og:image':
          case 'og:video':
          case 'og:audio':
            $content = self::UrlPrefix($content,'add');
            break;
      }

      echo      '<tr>';

      echo        '<td>';
      echo          '<div class="ogp-text-large">' . $property . '</div>';
      echo          '<div class="ogp-text-small">' . $tag_arr['hint'] . '</div>';
      echo        '</td>';

      echo        '<td>';
      
      $attributes = ' ';
      foreach( $tag_arr['control']['attributes'] as $attr => $attr_val ){
        $attributes .= $attr . '="' . $attr_val . '" ';
      }

      $disabled = self::$ogp_settings[$property] == 'default' && $render_mode == 'page' ? ' disabled="disabled" ' : ' ';

      switch( $tag_arr['control']['type'] ){

        case 'text':
          echo '<input' . $attributes . $disabled . 'type="text" name="'. $property . '" value="' . $content . '"/>';
          break;

        case 'textarea':
          echo '<textarea' . $attributes . ' name="'. $property . '">' . $content . '</textarea>';
          break;

        case 'select':
          echo '<select' . $attributes . $disabled . ' name="'. $property . '">';
          foreach( $tag_arr['control']['values'] as $key => $value_arr ){
            $selected = $content == $value_arr['value'] ? ' selected="selected" ' : ' ';
            echo '<option' . $selected . 'value="' . $value_arr['value'] . '">' . $value_arr['text'] . '</option>';
          }
          echo '</select>';
          break;

        case 'radio':
          foreach( $tag_arr['control']['values'] as $key => $value_arr ){
            $checked = $content == 'on' ? ' checked="checked" ' : ' ';
            echo '<input type="radio"' . $attributes . $checked . $disabled . ' name="'. $property . '" ';
            echo 'value="' . $value_arr['value'] . '"/> ' . htmlspecialchars($value_arr['text']) . ' &nbsp;&nbsp;&nbsp;';
          }
          break;

        case 'checkbox':
          $checked = !empty($content) ? ' checked="checked" ' : ' ';
          echo '<input' . $attributes . $checked . $disabled . 'type="checkbox" name="'. $property . '"/>&nbsp;' . $tag_arr['content'];
          break;
      }

      self::GetHelpers($tag_arr['control']['helpers'], $render_mode);
      echo        '</td>';
      echo      '</tr>';
    }

    echo      '</tbody>';
    echo    '</table>';
    
    echo    '<br/>';

    echo    '<span style="float:right;">See also ';
    echo      '<a href="http://ogp.me" target="_blank">ogp.me</a>, ';
    echo      '<a href="https://developers.facebook.com/docs/sharing/best-practices#tags" target="_blank"><i class="fa fa-facebook-official"></i> Best Practices</a>';
    echo    '</span>';

    echo    '<input type="hidden" name="cmd" value="SaveOgpData"/> ';
    echo    '<input onclick="OpenGraphHelpers.destroy()" type="submit" name="" value="' . $langmessage['save'] . '" class="gpsubmit"' . $data_cmd . '/>';
    echo    '<input onclick="OpenGraphHelpers.destroy()" type="button" class="' . $admin_box_close . 'gpcancel" name="" value="' . $langmessage['cancel'] . '" />';

    echo  '</form>';
    
  }



  public static function GetHelpers($helpers=array(), $render_mode){
    global $langmessage;
    if( count($helpers) ){
      echo  '<div class="ogp-helper cf">';
      foreach( $helpers as $key => $helper ){
        switch( $helper ){

          case 'select_file':
            echo  '<a href="#" class="ogp-select-file-btn gpsubmit">Select File</a>';
            break;

          case 'show_image':
            echo  '<div class="ogp-image-preview">';
            echo    '<div class="ogp-image-bg"></div>';
            echo  '</div>';
            echo  '<div class="ogp-image-preview-btns">';
            echo    '<a class="gpcancel" href="javascript:;" data-socialmedia="facebook"><i class="fa fa-fw fa-facebook-official"></i> facebook</a>';
            echo    '<a class="gpcancel" href="javascript:;" data-socialmedia="googleplus"><i class="fa fa-fw fa-google-plus"></i> Google+</a>';
            echo    '<a class="gpcancel" href="javascript:;" data-socialmedia="linkedin"><i class="fa fa-fw fa-linkedin"></i> LinkedIn</a>';
            echo    '<a class="gpcancel" href="javascript:;" data-socialmedia="pinterest"><i class="fa fa-fw fa-pinterest"></i> Pinterest</a>';
            echo    '<a class="gpcancel" href="javascript:;" data-socialmedia="twitter"><i class="fa fa-fw fa-twitter"></i> Twitter</a>';
            echo  '</div>';
            echo  '<br style="clear:both; height:0; margin:0;" />';
            break;

          case 'char_counter':
            echo  '<div class="ogp-char-counter"><span class="ogp-char-count"></span> ' . str_replace('%s ', '', $langmessage['_characters']) . '</div>';
            break;

          case 'type':
          case 'site_name':
          case 'title':
          case 'url':
          case 'description':
            if( $render_mode == 'page'){
              // auto checkbox only in page render mode
              $checked = self::$ogp_settings['og:' . $helper ] == 'default' ? ' checked="checked" ' : ' ';
              echo  '<label class="ogp-checkbox ogp-auto-value" title="generate from existing page data">';
              echo    '<input' . $checked . 'type="checkbox" data-helper-name="' . $helper . '"/><span></span> auto';
              echo  '</label>';
            }
            break;

          case 'image':
          case 'video':
          case 'audio':
          case 'locale':
            if( $render_mode == 'page'){
              $checked = self::$ogp_settings['og:' . $helper ] == 'default' ? ' checked="checked" ' : ' ';
              echo  '<label class="ogp-checkbox ogp-auto-value" title="use default settings">';
              echo    '<input' . $checked . 'type="checkbox" data-helper-name="' . $helper . '"/><span></span> default';
              echo  '</label>';
            }
            break;
        }
      }
      echo  '</div>';
    }
  }


 /**
  * Multi-Language Manager Support
  * @return (string) language code
  */
  public static function GetPageLanguage(){
    global $page, $config, $ml_object;
    if( !$ml_object ){ 
      return $config['language'];
    }else{
      // only if Multi-Language Manager ist installed
      $ml_list = $ml_object->GetList($page->gp_index);
      $ml_lang = is_array($ml_list) && ($ml_lang = array_search($page->gp_index, $ml_list)) !== false ? $ml_lang : $config['language'];
      return $ml_lang;  
    }
  }


 /** 
  * Strips or adds protocol, server name and $dirPrefix 
  * from/to internal URLs (starting with '/') 
  * to store them in a portable format
  */
  public static function UrlPrefix($url, $action=false){
    global $dirPrefix;
    $url_prefix = 
      ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://" )
        . \gp\tool::ServerName()
        . $dirPrefix;

    switch( $action ){
      case 'add':
        if( substr($url, 0, 1) == '/' &&  substr($url, 0, 2) !== '//' ){
          $url = $url_prefix . $url;
        }
        break;

      case 'remove':
        if( strpos($url, $url_prefix) !== false ){
          $url = substr($url, strlen($url_prefix));
        }
        break;
    }
    return $url;
  }


}
