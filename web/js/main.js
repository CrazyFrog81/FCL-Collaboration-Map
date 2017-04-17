// Collection holder for the project collection
var $collectionHolder;

// To produce different ID for the slider
var sliderId = 0;

// Count existing projects
var existing_project_count = 0;

// To produce project number in the form
var project_index = 2;

// setup an "add a project" link
var $addprojectLink = $('<a href="#" class="add_project_link"><i class="fa fa-plus-circle"><span id="add-project"> Add a project </b></span></i></a>');
var $newLinkLi = $('<section></section>').append($addprojectLink);

jQuery(document).ready(function() {

	// Allow multiple selection, select2 plugin
	$(".mother_tongues").select2({
		placeholder: '--Multiple Select--',
		allowClear: true,
	});

	// Get the div that holds the collection of projects
	$collectionHolder = $('div.projects');

	// add a delete link to all of the existing project form section elements
	$collectionHolder.find('section').each(function() {
		addprojectFormDeleteLink($(this));
	});

	// add the "add a project" anchor and section to the projects div
	$collectionHolder.append($newLinkLi);

	// count the current form inputs we have (e.g. 2), use that as the new
	// index when inserting a new item (e.g. 2)
	$collectionHolder.data('index', $collectionHolder.find(':input').length);

	$addprojectLink.on('click', function(e) {
		// prevent the link from creating a "#" on the URL
		e.preventDefault();
		// add a new project form (see next code block)
		addprojectForm($collectionHolder, $newLinkLi);
	});

});

function addprojectForm($collectionHolder, $newLinkLi) {

	// Get the data-prototype explained earlier
	var prototype = $collectionHolder.data('prototype-project');

	// get the new index
	var index = $collectionHolder.data('index');

	// Replace '__name__' in the prototype's HTML to
	// instead be a number based on how many items we have
	var newForm = prototype.replace(/__project__/g, index);

	// increase the index with one for the next item
	$collectionHolder.data('index', index + 1);

	// Display the form in the page in a section, before the "Add a project" link section
	var $newFormLi = $('<section class="tab-pane active" id="projectIndex' + index + '"></section>').append(newForm);

	// Due to the way the project label is attached, hence minus one to match with the project list shown at the side bar
	var number = project_index - 1;

	// Adding project list at the side bar
	$('ul.projectList').append('<li><a class="project-name" href="#projectIndex' + index + '">Project ' + number + '</a></li>');

	$newLinkLi.before($newFormLi);

	// add a delete link to the new form
	addprojectFormDeleteLink($newFormLi);

	// Hide and disabled 'Others' textbox accordingly
	collectionOfCollaborators();

  // Range slider function
	rangeFunction();

  // Collaborator widget function
	$('[id$=_id_id]').select2({
		placeholder: '--Type to Search--',
		allowClear: true,
		'language': {
			'noResults': function() {
				return 'No results found, use "Other" instead';
			}
		},
	});

	// Hide and disabled 'Others' textbox accordingly
	checkboxFunction();

	// Hide and disabled 'Others' textbox accordingly
	projectTitleFunction();

	// For all the 'day' in dates are by default '1'
	// No need for user input
	$("[id$=_day]").hide();

	// Changing the style of second page of the form
	if ($('[id^=collaboration_information_projects_]').attr('id') == null) {
		$('.changeTop').css('height', '100vh');
	} else {
		$('.changeTop').css('height', '100%');
	}
	// Validation of projects after added
	validate();
}

function addprojectFormDeleteLink($projectFormLi) {

	var $removeFormA = $('<hr><a href="#" class="delete"> <i class="fa fa-minus-circle"><span id="remove-project""> Remove this project</span></i></a>');

	$projectFormLi.append($removeFormA);

	// Append project title with numbers
	$projectFormLi.append('<hr style="height:3px;" /><h3 id="project_label_' + project_index + '">Project #' + project_index + '</h3><br>');
	project_index++;

	$removeFormA.on('click', function(e) {
		// prevent the link from creating a "#" on the URL
		e.preventDefault();
		// Due to the way the project title is attached
		// To match the project title and project list
		var delete_text = $('li.active').text();
		var li_id = $('li.active').next().text();
		var substring = delete_text.substring(0, 7); //Project
		if (substring == 'Project') {
			var index_result = li_id.match(/\d+/);
			var result = 'Project #' + index_result;
			var delete_text_index = delete_text.match(/\d+/);
		} else {
			var index_result = li_id.match(/\d+/);
			var result = 'Project #' + index_result;
			var delete_text_index = existing_project_count - 1;
		}
		if (!li_id) {
			var text;
			$('[id^=project_label_]').each(function() {
				text = $(this).text().match(/\d+/);
			});
			var result = 'Project #' + text;
		}
		$('#project_label_' + delete_text_index).text(result);
		// Remove project list which is deleted
		$('li.active').remove();
		// Remove one project form
		$projectFormLi.remove();
		// Changing the style of second page of the form
		if ($('[id^=collaboration_information_projects_]').attr('id') == null) {
			$('.changeTop').css('height', '100vh');
		} else {
			$('.changeTop').css('height', '100%');
		}
	});
}

jQuery(document).ready(function() {

  // Showing modal to new user, change accordingly
	var pageURL = $(location).attr("href");
	if (pageURL == 'http://collaboration-network.fcl.sg/' && $('.number').text() == '1') {
		$('#myModal').modal('show');
	}

	/* All ----Function() are to hide and disable 'Others' textbox accordingly */

	collectionOfCollaborators();
	checkboxFunction();
	researchGroupFunction();
	nationalityFunction();
	disciplinaryBackgroundFunction();
	rangeFunction();
	projectTitleFunction();
	$("[id$=_day]").hide();
	collaboratorsFunction();

	toCamelCaseFunction('#general_information_name');
	toCamelCaseFunction('#general_information_research_group_Others');

	$('.my-selector').wrap("<div class='my-selector_style' style='position:relative; left:15%;' </div>");
	$('.add_collaborator').removeAttr('style');

  // Count number of projects exist
	$('[id^=project_label_]').each(function() {
		existing_project_count++;
	});

	$('li.stepLi').each(function() {
		if ($(this).css('color') == 'rgb(0, 0, 0)') {
			$(this).find('span.stepLiNumber').css('background-color', 'black');
			if ($(this).find('span.stepLiNumber').text() == 1) {
				$('button').css('margin-left', '63%');
			} else {
				$('button').css('margin-left', '');
			}
		}
	});

	if ($('[id^=collaboration_information_projects_]').attr('id') != null) {
		$('.changeTop').css('top', '5px');
		$('.changeTop').css('height', '100%');
		$('.changeSidebar').css('top', '8px');
	}

	$('[id$=_id_id]').select2({
		placeholder: '--Type to Search--',
		allowClear: true,
		'language': {
			'noResults': function() {
				return 'No results found, use "Other" instead';
			}
		},
	});

  // Create <br> after <hr> at the collection of collaborators at 'Collaborator Information' page
	$('label').each(function() {
		if ($(this).text() == 'Name') {
			$(this).after('<br class="breakHere">');
		}
	});

  validate();
});

function validate(){
  // validation where pass down id and step's number in the form
  validateTextbox('#general_information_research_group_Others', 1);
  validateDropdown('#general_information_research_group_Choices', 1);
  validateTextbox('#general_information_name', 1);
  $('[id$=_collaborated_before]').each(function() {
    id = '#' + $(this).attr('id');
    validateRadioChoices(id, 2);
  });
  $('[id$=_id_Others]').each(function() {
    id = '#' + $(this).attr('id');
    validateTextbox(id, 2);
  });
  $('[id$=_id_id]').each(function() {
    id = $(this).attr('id');
    validateSelect2(id, 2);
  });
  $('[id$=_project_outcomes_Others]').each(function() {
    id = '#' + $(this).attr('id');
    validateTextbox(id, 2);
  });
  $('[id$=_project_outcomes_RadioChoices]').each(function() {
    id = '#' + $(this).attr('id');
    validateCheckbox(id, 2);
  });
  $('[id$=_project_duration]').each(function() {
    id = '#' + $(this).attr('id');
    validateRadioChoices(id, 2);
  });
  $('[id$=_start_date]').each(function() {
    id = '#' + $(this).attr('id');
    validateDate(id, 2);
  });
  $('[id$=_name_Others]').each(function() {
    id = '#' + $(this).attr('id');
    validateTextbox(id, 2);
  });
  $('[id$=_name_name]').each(function() {
    id = '#' + $(this).attr('id');
    validateDropdown(id, 2);
  });
  validateTextbox('#background_information_nationality_Others', 3);
  validateDropdown('#background_information_nationality_Choices', 3);
  validateMotherTongues('.select2-selection__choice', 3);
  validateRadioChoices('#background_information_age', 3);
  validateRadioChoices('#background_information_gender', 3);
  validateRadioChoices('#background_information_academic_background', 3);
  validateRadioChoices('#background_information_before_fcl', 3);
  validateDate('#background_information_start_date', 3);
  validateTextbox('#background_information_disciplinary_backgrounds_Others', 3);
  validateCheckbox('#background_information_locations', 3);
  validateCheckbox('#background_information_disciplinary_backgrounds_RadioChoices', 3);
}

function findOtherIndex(id, step, number){
  var found = 0;
  var result = 0;
  if(number == step){
    while(found == 0){
      var combinedId = id + result;
      var value = $('[id$='+ combinedId + ']').val();
      if(value == 'Other'){
        found = 1;
      }else{
        result++;
      }
    }
  }
  return result;
}

function toCamelCaseFunction(id) {
	$(id).on('keyup', function() {
		var text = $(this).val();
		if (text) {
			for (var i = 0; i < text.length; i++) {
				if (i == 0) {
					var result = text[i].toUpperCase();
				} else if (text[i - 1] == ' ') {
					result = result + text[i].toUpperCase();
				} else {
					result = result + text[i];
				}
			}
		}
		$(this).val(result);
	});
}

function projectTitleOthers(id) {
	$(id).on('keyup', function() {
		var text = $(this).val();
		if (text) {
			for (var i = 0; i < text.length; i++) {
				if (i == 0) {
					var result = text[i].toUpperCase();
				} else if (text[i - 1] == ' ') {
					result = result + text[i].toUpperCase();
				} else {
					result = result + text[i].toLowerCase();
				}
			}
		}
		$(this).val(result);
	});
}

function rangeFunction() {
	$('.container').remove();
	$('[id$=_working_time]').each(function() {
		var id = '#' + $(this).attr('id');
		$(this).before('<div class="container" style="margin-left:-10px;"><p></p><input id="ex' + sliderId + '" style="width:50%; overflow:hidden;" data-slider-tooltip="hide" data-slider-id="ex' + sliderId + 'Slider" type="text" data-slider-handle="square" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value = "50"/><p></p></div>');
		$('#ex' + sliderId).slider({
			formatter: function(value) {
				return 'Current value: ' + value;
			}
		});
		if (!($(id).val())) {
			$(id).val('50 %');
		} else {
			var value = parseInt($(id).val());
			$('#ex' + sliderId + 'Slider').find('.slider-track').find('.slider-selection').attr('style', 'width:' + value + '%');
			$('#ex' + sliderId + 'Slider').find('.slider-handle').attr('style', 'left:' + value + '%');
		}
		$('#ex' + sliderId).on('slideStop', function(slideEvt) {
			$(id).val(slideEvt.value + ' %');
		});
		$('#ex' + sliderId).on('slide', function(slideEvt) {
			$(id).val(slideEvt.value + ' %');
		});
		sliderId++;
	});
}

function collectionOfCollaborators() {
	$('.each_collab_label').before('<hr class="style">');
	$('.style').remove();
	// Using jquery-symfony-collection plugin
	$(".my-selector").collection({
		min: 1,
		allow_up: $('#up').is(':checked'),
		allow_down: $('#down').is(':checked'),
		add_at_the_end: true,
		custom_remove_location: true,
		add: '<a href="#" class="add_collaborator" style="position:relative; left:15%;"><i class="fa fa-plus-circle" style="color:green;"><span style="color:black; font: bold italic 14px lato;"> Add a collaborator</span></i></a>',
		remove: '<a href="#" class="collection-remove"></br><i class="fa fa-minus-circle" style="color:orange;"><span style="color:black; font: italic 12px lato;"> Remove this person</span></br></i></a><hr style="width:85%; margin-left:0px;">',
		// Hide and disable 'Others' textbox accordingly
		after_add: function(collection, element) {
			$('.breakHere').remove();
			$('label').each(function() {
				if ($(this).text() == 'Name') {
					$(this).after('<br class="breakHere">');
				}
			});
			$('[id$=_id_id]').select2({
				placeholder: '--Type to Search--',
				allowClear: true,
				'language': {
					'noResults': function() {
						return 'No results found, use "Other" instead';
					}
				},
			});
			$('[id$=_id_id]').each(function() {
				id = $(this).attr('id');
				validateSelect2(id, 2);
			});
			$('[id$=_id_Others]').each(function() {
				id = '#' + $(this).attr('id');
				validateTextbox(id, 2);
			});
			$('[id$=_collaborated_before]').each(function() {
				id = '#' + $(this).attr('id');
				validateRadioChoices(id, 2);
			});
			collaboratorsFunction();
			$('.add_collaborator').removeAttr('style');
			$(collection).unwrap();
			$(collection).wrap("<div class='my-selector_style' style='position:relative; left:15%;' </div>");
			$('.each_collab_label').before('<hr class="style">');
			$('.style').remove();
			var collection_id = ($(collection).attr('id'));
			$('[id^=' + collection_id + '][id$=_id_id]').each(function() {
				var element_id = '#' + $(this).attr('id');
				var idOther = element_id.replace(/id$/, '') + 'Others';
				if ($(this).val() == 'Other') {
					$(idOther).show();
					$(idOther).removeAttr('disabled');
				} else {
					$(idOther).hide();
					$(idOther).attr('disabled', 'disabled');
				}
			});
			$('[id^=' + collection_id + '][id$=_id_id]').on('input change', function() {
				var element_id = '#' + $(this).attr('id');
				var idOther = element_id.replace(/id$/, '') + 'Others';
				if ($(this).val() == 'Other') {
					$(idOther).show();
					$(idOther).removeAttr('disabled');
				} else {
					$(idOther).hide();
					$(idOther).attr('disabled', 'disabled');
				}
			});
		},
	});
}

function checkboxFunction() {
  if($('[id$=_project_outcomes_RadioChoices]').attr('id') != null){
    var other_checkbox = findOtherIndex('_project_outcomes_RadioChoices_', 2, $('.number').text());
  }
	$("input[type=checkbox]").each(function() {
		$('.hr_label').remove();
		$('[id$=_project_outcomes_Others]').after("<span class='hr_label'><hr></span>");
		var id = ($(this).attr('id'));
		if ($('#' + id).val() == 'Other' && id.substr(id.length - 1) == other_checkbox) {
			var other_id = id.replace("RadioChoices_" + other_checkbox, "Others");
			if ($('#' + id).is(':checked')) {
				$('#' + other_id).removeAttr("disabled");
			} else {
				$('#' + other_id).attr("disabled", "disabled");
			}
		}
	});
	$('input[type=checkbox]').on('input change', function() {
		var id = ($(this).attr('id'));
		if ($('#' + id).val() == 'Other' && id.substr(id.length - 1) == other_checkbox) {
			var other_id = id.replace("RadioChoices_" + other_checkbox, "Others");
			if ($('#' + id).is(':checked')) {
				$('#' + other_id).removeAttr("disabled");
			} else {
				$('#' + other_id).attr("disabled", "disabled");
				if ($('#' + other_id).next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign') {
					$('#' + other_id).css('border-color', '');
					$('#' + other_id).next().remove();
				}
			}
		}
	});
}

function projectTitleFunction() {
	$("[id$=_name_name]").each(function() {
		var id = '#' + $(this).attr('id');
		var idOther = id.replace(/name$/, '') + 'Others';
		if ($(id).val() === 'Other') {
			projectTitleOthers(idOther);
			$(idOther).show();
			$(idOther).removeAttr("disabled");
		} else {
			$(idOther).hide();
			$(idOther).attr("disabled", "disabled");
		}
	});
	$("[id$=_name_name]").on('input change', function() {
		var id = '#' + $(this).attr('id');
		var idOther = id.replace(/name$/, '') + 'Others';
		if ($(id).val() === 'Other') {
			projectTitleOthers(idOther);
			$(idOther).show();
			$(idOther).removeAttr("disabled");
		} else {
			$(idOther).hide();
			$(idOther).attr("disabled", "disabled");
			if ($(idOther).next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign') {
				$(idOther).css('border-color', '');
				$(idOther).next().remove();
			}
		}
	});
}

function researchGroupFunction() {
	if ($('#general_information_research_group_Choices').val() == 'Other') {
		$('#general_information_research_group_Others').removeAttr("disabled");
		$('#general_information_research_group_Others').show();
	} else {
		$('#general_information_research_group_Others').attr("disabled", "disabled");
		$('#general_information_research_group_Others').hide();
	}
	$('#general_information_research_group_Choices').on("change", function() {
		if ($('#general_information_research_group_Choices').val() == 'Other') {
			$('#general_information_research_group_Others').removeAttr("disabled");
			$('#general_information_research_group_Others').show();
		} else {
			$('#general_information_research_group_Others').attr("disabled", "disabled");
			$('#general_information_research_group_Others').hide();
			if ($('#general_information_research_group_Others').next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign') {
				$('#general_information_research_group_Others').css('border-color', '');
				$('#general_information_research_group_Others').next().remove();
			}
		}
	});
}

function nationalityFunction() {
	if ($('#background_information_nationality_Choices').val() == 'Other') {
		toCamelCaseFunction('#background_information_nationality_Others');
		$('#background_information_nationality_Others').removeAttr("disabled");
		$('#background_information_nationality_Others').show();
	} else {
		$('#background_information_nationality_Others').attr("disabled", "disabled");
		$('#background_information_nationality_Others').hide();
	}
	$('#background_information_nationality_Choices').on("change", function() {
		if ($('#background_information_nationality_Choices').val() == 'Other') {
			toCamelCaseFunction('#background_information_nationality_Others');
			$('#background_information_nationality_Others').removeAttr("disabled");
			$('#background_information_nationality_Others').show();
		} else {
			$('#background_information_nationality_Others').attr("disabled", "disabled");
			$('#background_information_nationality_Others').hide();
			if ($('#background_information_nationality_Others').next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign') {
				$('#background_information_nationality_Others').css('border-color', '');
				$('#background_information_nationality_Others').next().remove();
			}
		}
	});
}

function disciplinaryBackgroundFunction() {
  var disciplinary_other_checkbox = findOtherIndex('_disciplinary_backgrounds_RadioChoices_', 3, $('.number').text());
	if ($('#background_information_disciplinary_backgrounds_RadioChoices_' + disciplinary_other_checkbox).is(':checked')) {
		$('#background_information_disciplinary_backgrounds_Others').removeAttr("disabled");
	} else {
		$('#background_information_disciplinary_backgrounds_Others').attr("disabled", "disabled");
	}
	$('#background_information_disciplinary_backgrounds_RadioChoices').on("change", function() {
		if ($('#background_information_disciplinary_backgrounds_RadioChoices_' + disciplinary_other_checkbox).is(':checked')) {
			$('#background_information_disciplinary_backgrounds_Others').removeAttr("disabled");
		} else {
			$('#background_information_disciplinary_backgrounds_Others').attr("disabled", "disabled");
			if ($('#background_information_disciplinary_backgrounds_Others').next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign') {
				$('#background_information_disciplinary_backgrounds_Others').css('border-color', '');
				$('#background_information_disciplinary_backgrounds_Others').next().remove();
			}
		}
	});
}

function collaboratorsFunction() {
	$("[id$=_id_id]").each(function() {
		var id = '#' + $(this).attr('id');
		var idOther = id.replace(/id$/, '') + 'Others';
		$(idOther).css('text-transform', 'capitalize');
		if ($(id).val() === 'Other') {
			toCamelCaseFunction(idOther);
			$(idOther).show();
			$(idOther).removeAttr("disabled");
		} else {
			$(idOther).hide();
			$(idOther).attr("disabled", "disabled");
		}
	});
	$('[id$=_id_id]').on('input change', function() {
		var element_id = '#' + $(this).attr('id');
		var idOther = element_id.replace(/id$/, '') + 'Others';
		if ($(this).val() === 'Other') {
			toCamelCaseFunction(idOther);
			$(idOther).show();
			$(idOther).removeAttr('disabled');
		} else {
			$(idOther).hide();
			$(idOther).attr('disabled', 'disabled');
			if ($(idOther).next().attr('class') == 'help-block glyphicon glyphicon-exclamation-sign') {
				$(idOther).css('border-color', '');
				$(idOther).next().remove();
			}
		}
	});
}
