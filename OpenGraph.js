/**
 * JS/jQuery for Typesetter CMS plugin 'OpenGraph'
 *
 * @package     OpenGraph
 * @author      J. Krausz (http://typesetter-addons.grafikrausz.at)
 * @version     1.0-b3
 */

var OpenGraphHelpers = {};

OpenGraphHelpers.init = function(){
  
  var warn_char_counts = {  title : 65, description : 156  };

  if( typeof(gp_editor) == 'object' ){
    // create a backup of current gp_editor
    OpenGraphHelpers.gp_editor_backup = gp_editor;
  }
  gp_editor = {};

  gp_editor.selectFile = function(target_input) {
    gp_editor.FinderSelect = function(fileUrl) { 
      if( fileUrl != "" ){
        target_input.val(OpenGraphHelper_Defaults.url_prefix + fileUrl);
        var td = target_input.closest("td");
        if( td.find(".ogp-image-preview").length ){
          td.find(".ogp-image-preview img").remove();
          td.find(".ogp-image-preview")
            .prepend('<img src="' + fileUrl + '"/>');
          td.find(".ogp-image-bg").css( "background-image" , "url('" + fileUrl + "')");
        }
        if( td.find(".ogp-auto-value input").prop("checked") ){
          td.find("input").prop("disabled", false);
          td.find(".ogp-auto-value input").prop("checked", false);
        }
      }
      return true;
    };
    var finderPopUp = window.open(gpFinderUrl, 'gpFinder', 'menubar=no,width=960,height=450');
    if (window.focus) { finderPopUp.focus(); }
  }; 
  
  $(".ogp-select-file-btn").on("click", function(e){
    e.preventDefault();
    var target_input = $(this).closest("td").find("input[type='text']");
    gp_editor.selectFile(target_input);
  });
  
  $(".ogp-image-preview").each(function(){
    var input = $(this).closest("td").find("input[type='text']").first();
    var src = input.val();
    if( src != "" ){
      $(this).prepend('<img src="' + src + '"/>');
      $(this).closest("td").find(".ogp-image-bg").css( "background-image" , "url('" + src + "')");
    }
    input.on("keyup change paste", function(){
      var src = $(this).val();
      if( src != "" ){
        $(this).closest("td").find(".ogp-image-preview img").remove();
        $(this).closest("td").find(".ogp-image-preview").prepend('<img src="' + src + '"/>');
        $(this).closest("td").find(".ogp-image-bg").css( "background-image" , "url('" + src + "')");
      }
    });
    $(this).on("click", function(){
      $(this).closest("td").find(".ogp-select-file-btn").click();
    });
  });

  $(".ogp-image-preview-btns a").on("click", function(){
    var socmed = $(this).attr("data-socialmedia");
    var img_prev = $(this).closest("td").find(".ogp-image-preview");
    img_prev.removeClass("ogp-facebook ogp-linkedin ogp-twitter ogp-googleplus ogp-pinterest")
     .addClass("ogp-" + socmed);
  });


  $(".ogp-char-count").each(function(){
    var input = $(this).closest("td").find("textarea, input").first();
    var charcount = input.val().length;
    $(this).text(charcount);
    input.on("keyup change paste", function(){
      var charcount = $(this).val().length;
      $(this).closest("td").find(".ogp-char-count").text(charcount);
    });    
  });


  $(".ogp-auto-value input").on("change", function(){
    var checked = $(this).prop("checked");
    var helper_name = $(this).attr("data-helper-name");
    var input = $(this).closest("td").find("textarea, select, input").first();
    input.prop("disabled", checked);
    if( checked ){
      input.data("userval", input.val() );
      input.val( OpenGraphHelper_Defaults[helper_name] );
    }else{
      if( input.data("userval") ){
        input.val( input.data("userval") ).focus().select();
      }else{  
        input.focus().select();
      }
    }
    input.trigger("change");
  });


};


OpenGraphHelpers.destroy = function(){

  if( typeof(OpenGraphHelpers.gp_editor_backup) == 'object' ){
    // restore backup'd gp_editor
    gp_editor = OpenGraphHelpers.gp_editor_backup;
  }

};