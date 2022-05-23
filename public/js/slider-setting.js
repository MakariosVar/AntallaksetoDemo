/*---------------------------------------------------------------------
    File Name: slider-setting.js
---------------------------------------------------------------------*/

"use strict";
	var tpj = jQuery;

	var revapi486;
	tpj(document).ready(function () {
		if (tpj("#rev_slider_486_1").revolution == undefined) {
			revslider_showDoubleJqueryError("#rev_slider_486_1");
		} else {
			revapi486 = tpj("#rev_slider_486_1").show().revolution({
				sliderType: "standard",
				jsFileLocation: "revolution/js/",
				sliderLayout: "fullscreen",
				dottedOverlay: "none",
				delay: 5000,
				navigation: {
					keyboardNavigation: "on",
					keyboard_direction: "horizontal",
					mouseScrollNavigation: "off",
					mouseScrollReverse: "default",
					onHoverStop: "on",
					touch: {
						touchenabled: "on",
						swipe_threshold: 75,
						swipe_min_touches: 1,
						swipe_direction: "horizontal",
						drag_block_vertical: false
					},
					arrows: {
						  style: "gyges",
						  enable: true,
						  hide_onmobile: false,
						  hide_onleave: true,
						  hide_delay: 200,
						  hide_delay_mobile: 1200,
						  tmp: '',
						  left: {
							  h_align: "left",
							  v_align: "center",
							  h_offset: 0,
							  v_offset: 0
						  },
						  right: {
							  h_align: "right",
							  v_align: "center",
							  h_offset: 0,
							  v_offset: 0
						  }
					  },
					bullets: {
						enable: true,
						hide_onmobile: true,
						hide_under: 800,
						style: "hebe",
						hide_onleave: false,
						direction: "horizontal",
						h_align: "center",
						v_align: "bottom",
						h_offset: 0,
						v_offset: 30,
						space: 5,
						tmp: '<span class="tp-bullet-image"></span><span class="tp-bullet-imageoverlay"></span><span class="tp-bullet-title"></span>'
					}
				},
				viewPort: {
					enable: true,
					outof: "pause",
					visible_area: "70%",
					presize: false
				},
				responsiveLevels: [1240, 1024, 778, 480],
				visibilityLevels: [1240, 1024, 778, 480],
				gridwidth: [1240, 1024, 778, 480],
				gridheight: [500, 450, 400, 350],
				lazyType: "none",
				parallax: {
					type: "scroll",
					origo: "enterpoint",
					speed: 400,
					levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 46, 47, 48, 49, 50, 55],
					type: "scroll",
				},
				shadow: 0,
				spinner: "off",
				stopLoop: "off",
				stopAfterLoops: -1,
				stopAtSlide: -1,
				shuffle: "off",
				autoHeight: "off",
				hideThumbsOnMobile: "off",
				hideSliderAtLimit: 0,
				hideCaptionAtLimit: 0,
				hideAllCaptionAtLilmit: 0,
				debugMode: false,
				fallbacks: {
					simplifyAll: "off",
					nextSlideOnWindowFocus: "off",
					disableFocusListener: false,
				}
			});
		}
	});
	$(document).on("change", ".uploadProfileInput", function () {
		var triggerInput = this;
		var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
		var holder = $(this).closest(".pic-holder");
		var wrapper = $(this).closest(".profile-pic-wrapper");
		$(wrapper).find('[role="alert"]').remove();
		triggerInput.blur();
		var files = !!this.files ? this.files : [];
		if (!files.length || !window.FileReader) {
		  return;
		}
		if (/^image/.test(files[0].type)) {
		  // only image file
		  var reader = new FileReader(); // instance of the FileReader
		  reader.readAsDataURL(files[0]); // read the local file
	      
		  reader.onloadend = function () {
		    $(holder).addClass("uploadInProgress");
		    $(holder).find(".pic").attr("src", this.result);
		    $(holder).append(
		      '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
		    );
	      
		    // Dummy timeout; call API or AJAX below
		    setTimeout(() => {
		      $(holder).removeClass("uploadInProgress");
		      $(holder).find(".upload-loader").remove();
		      // If upload successful
		      if (Math.random() < 0.9) {
			$(wrapper).append(
			  '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Profile image updated successfully</div>'
			);
	      
			// Clear input after upload
			$(triggerInput).val("");
	      
			setTimeout(() => {
			  $(wrapper).find('[role="alert"]').remove();
			}, 3000);
		      } else {
			$(holder).find(".pic").attr("src", currentImg);
			$(wrapper).append(
			  '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
			);
	      
			// Clear input after upload
			$(triggerInput).val("");
			setTimeout(() => {
			  $(wrapper).find('[role="alert"]').remove();
			}, 3000);
		      }
		    }, 1500);
		  };
		} else {
		  $(wrapper).append(
		    '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
		  );
		  setTimeout(() => {
		    $(wrapper).find('role="alert"').remove();
		  }, 3000);
		}
	      });
	      