$(document).on({
  ajaxStart: function() { 
    loading('show');
  },
  ajaxStop: function() {
    loading('hide');
  }    
});

if(typeof(localStorage.userid)==='undefined'){
	$.mobile.changePage('#login');
}

$(document).ready(function(){
	$("#addIng").click(function(){
		$.post("ajax/getAmounts.php",{action:"getAmounts"},function(response){
			var amounts = JSON.parse(response);
			var amountOptions = "";
			$.each(amounts,function(index,elem){
				amountOptions += "<option value='"+elem.id+"'>"+elem.name+"</option>";
			});
			$.post("ajax/getIngredients.php",{action:"getIngredients"},function(response){
				var ingredients = JSON.parse(response);
				var ingredientsOptions = "";
				$.each(ingredients,function(index,elem){
					ingredientsOptions += "<option value='"+elem.id+"'>"+elem.name+"</option>";
				});
				$("#ingredients-cont").append('<fieldset data-role="controlgroup" data-type="horizontal">'
				+'<select name="ing[]">'
				+'<option value="-1">בחר מרכיב</option>'
				+'<option value="0">רכיב חדש</option>'
				+ingredientsOptions+'</select>'
				+'<select name="amount[]">'
				+'<option value="-1">בחר כמות</option>'
				+'<option value="0">כמות חדשה</option>'
				+amountOptions+'</select>'
				+'<input type="button" class="deling" value="delete" />'
				+'</fieldset>'
				);
				$('#ingredients-cont').trigger('create');
			});
		});
	});
	$("#ingredients-cont").delegate(".deling","click",function(){
		$(this).parents("fieldset").remove();
	});
	$("#ingredients-cont").delegate("select[name='ing[]']","change",function(e){
		if($(this).val()==0){
			$( "#addIngredient" ).popup( "open" );
		}
	});
	$("#ingredients-cont").delegate("select[name='amount[]']","change",function(e){
		if($(this).val()==0){
			$( "#addAmount" ).popup( "open" );
		}
	});
	$(document).delegate('.unfav', 'click', function() {
		var parent = $(this).parents(".recipe");
		var id = parent.attr('data-id');
		// store some data
		$.post("ajax/getRecipes.php", {
			action:"user_unfav",
			userid:localStorage.userid,
			recipe_id:id
		}, function(response) {
			var status = JSON.parse(response);
			if(status.status){
				parent.remove();
			}
		});
	});
	$(document).delegate('.fav', 'click', function() {
		var id = $("#recipe").attr('data-id');
		// store some data
		$.post("ajax/getRecipes.php", {
			action:"user_fav",
			userid:localStorage.userid,
			recipe_id:id
		}, function(response) {
			var status = JSON.parse(response);
			if(status.status){
			}
		});
	});
});

function remakeSelect(type){
	if(type=='amount'){
		$("select[name='amount[]']").each(function(index,elem){
			var selected = $(elem).val();
			$.post("ajax/getAmounts.php",{action:"getAmounts"},function(response){
				var amounts = JSON.parse(response);
				var amountOptions = "";
				var select;
				$.each(amounts,function(index,elem){
					if(elem.id==selected){
						select = "selected";
					}
					else{
						select = "";
					}
					amountOptions += "<option value='"+elem.id+"' "+select+">"+elem.name+"</option>";
				});
				$(elem).html(
					+'<option value="-1">בחר כמות</option>'
					+'<option value="0">כמות חדשה</option>'
					+amountOptions
				);
				$('#ingredients-cont').trigger('create');
			});
			
		});
	}
	if(type=='ingredient'){
		$("select[name='ing[]']").each(function(index,elem){
			var selected = $(elem).val();
			$.post("ajax/getIngredients.php",{action:"getIngredients"},function(response){
				var ingredients = JSON.parse(response);
				var ingredientsOptions = "";
				var select;
				$.each(ingredients,function(index,elem){
					if(elem.id==selected){
						select = "selected";
					}
					else{
						select = "";
					}
					ingredientsOptions += "<option value='"+elem.id+"' "+select+">"+elem.name+"</option>";
				});
				$(elem).html(
					+'<option value="-1">בחר רכיב</option>'
					+'<option value="0">רכיב חדש</option>'
					+ingredientsOptions
				);
				$('#ingredients-cont').trigger('create');
			});
			
		});
	}
}

function loading(showOrHide) {
    setTimeout(function(){
        $.mobile.loading(showOrHide);
    }, 1); 
}
$(document).on('pageinit', '#login', function(){
	$(document).on('click', '#logbtn', function() { // catch the form's submit event
            if($('#login #name').val().length > 0 && $('#login #pass').val().length > 0){
            	var s = $('#login form').serialize();
            	$.post("ajax/user.php",{action : 'login', formData : $('#login form').serialize()},function(response){
            		var res = JSON.parse(response);
            		if(res.status) {
                    	localStorage.userid = res.id;
                    	$.mobile.changePage('#mainpage');
                    } else {
                        alert('שם המשתמש או הסיסמה לא נכונים');
                    }
            	});
  
            return false; // cancel original event to prevent form submitting
            }
        }); 
});
$(document).on('pageinit', '#register', function(){
	$(document).on('click', '#regbtn', function() { // catch the form's submit event
			var name = $('#register #name').val();
			var pass1 = $('#register #pass').val();
			var pass2 = $('#register #pass2').val();
            if(name.length>0&&pass1.length>0&&pass1==pass2){
            	var s = $('#register form').serialize();
            	$.post("ajax/user.php",{action : 'register', formData : $('#register form').serialize()},function(response){
            		var res = JSON.parse(response);
            		if(res.status) {
                    	localStorage.userid = res.id;
                    	$.mobile.changePage('#mainpage');
                    } else {
                        alert('שם המשתמש כבר קיים');
                    }
            	});
  
            return false; // cancel original event to prevent form submitting
            }
        }); 
});

$(document).on('pageinit', '#newrecipe', function(){
		$("#addIngredient").popup();
        $("#addAmount").popup();
        $(document).on('click', '#ingsub', function() { // catch the form's submit event
        	if($("#ingName").val().length>0){
        		$.post("ajax/getIngredients.php",{action:"addIngredient",name:$("#ingName").val()},function(response){
        			if(response=="1"){
        				$("#ingName").val('');
        				remakeSelect("ingredient");
        				$("#addIngredient").popup("close");
        			}
        			else{
        				alert("error");
        			}
        		});
        	}
        	return false;
     	});
     	$(document).on('click', '#amsub', function() { // catch the form's submit event
     		if($("#amountName").val().length>0){
        		$.post("ajax/getAmounts.php",{action:"addAmount",name:$("#amountName").val()},function(response){
        			if(response=="1"){
        				$("#amountName").val('');
        				remakeSelect("amount");
        				$("#addAmount").popup("close");
        			}
        			else{
        				alert("error");
        			}
        		});
        	}
     		return false;
     	});
        $(document).on('click', '#submit', function() { // catch the form's submit event
            if($('#newrecipe #name').val().length > 0 && $('#newrecipe #desc').val().length > 0 && $('#newrecipe #orders').val().length > 0){
            	var s = $('#newrecipe form').serialize();
            	$.post("ajax/newRecipe.php",{action : 'newRecipe', formData : $('#newrecipe form').serialize(),userid:localStorage.userid},function(response){
            		var res = JSON.parse(response);
            		if(res.status) {
                    	alert('התווסף בהצלחה');
                    } else {
                        alert('תקלה בשליחה');
                    }
            	});
                // Send data to server through the ajax call
                // action is functionality we want to call and outputJSON is our data
  
            return false; // cancel original event to prevent form submitting
            }
        });   
});
$(document).on("pageshow", "#myrecipes", function(event) {
	$.post("ajax/getRecipes.php",{action:"get_user_fav",userid:localStorage.userid},function(response){
		var recipes = JSON.parse(response);
		$('#myFavRecipes').empty();
		var addDelete,addEdit;
		$.each(recipes, function(index, value) {
			if(value.user_id==localStorage.userid){
				addEdit = '<a href="#" class="edit ui-btn ui-icon-edit ui-btn-icon-notext ui-corner-all ui-btn-inline" data-theme="c" >edit</a>';
			}
			else{
				addDelete = "";
				addEdit="";
			}
			$('#myFavRecipes').append(
			'<li class="recipe" data-id=' + value.id + '>'
			+'<div class="ui-grid-b">'
     		+'<div class="ui-block-b" style="">'
			+'<h2>'+value.name+'</h2>'
			+'<p>'+value.shortDesc+'</p>'
    		+'</div><div class="ui-block-c" style=" float: left;padding-top:5px;">'
			+'<div style="float: left;">'
			+addEdit
			+'<a href="#" class="unfav ui-btn ui-icon-star ui-btn-icon-notext ui-corner-all ui-btn-inline" data-theme="c" >unfav</a>'
			+'</div></div></div></li>');
		});
		$("#myFavRecipes").listview("refresh");
	});
	$(document).on('click', '.recipe .ui-block-b', function() {
		var id = $(this).parents(".recipe").attr('data-id');
		// store some data
		if ( typeof (Storage) !== "undefined") {
			localStorage.recipeid = id;
		}
		$.post("ajax/getRecipe.php", {
			id : id
		}, function(response) {
			var recipe = JSON.parse(response);
			$("#recipe #name").text(recipe.name);
			$("#recipe #description").text(recipe.desc);
			$("#recipe #orders").text(recipe.orders);
			$("#recipe").attr('data-id',id);
			$("#recipe #ing").empty();
			$.each(recipe.ingredients,function(index,element){
			 	$("#recipe #ing").append('<li>'+element.ing+'  '+element.amount+'</li>');
			 });
			// Change page
			$.mobile.changePage('#recipe');
		});
	});
});

$(document).on("pageinit", "#search", function(event) {
	getResults("");
	$(document).on('click', '.recipe', function() {
		var id = $(this).attr('data-id');
		// store some data
		if ( typeof (Storage) !== "undefined") {
			localStorage.recipeid = id;
		}
		$.post("ajax/getRecipe.php", {
			id : id
		}, function(response) {
			var recipe = JSON.parse(response);
			$("#recipe #name").text(recipe.name);
			$("#recipe #description").text(recipe.desc);
			$("#recipe #orders").text(recipe.orders);
			$("#recipe").attr('data-id',id);
			$("#recipe #ing").empty();
			$.each(recipe.ingredients,function(index,element){
			 	$("#recipe #ing").append('<li>'+element.ing+'  '+element.amount+'</li>');
			 });
			// Change page
			$.mobile.changePage('#recipe');
		});
	});
});

function getResults(value) {
	$.post("ajax/getRecipes.php", {
		str : value,
		search : true,
		action:"search"
	}, function(response) {
		var recipes = JSON.parse(response);
		$('#searchResults').empty();
		$.each(recipes, function(index, value) {
			$('#searchResults').append(
			'<li class="recipe" data-id=' + value.id + '>'
			+'<div class="ui-grid-b">'
     		+'<div class="ui-block-b" style="">'
			+'<h2>'+value.name+'</h2>'
			+'<p>'+value.shortDesc+'</p>'
    		+'</div></div></li>');
		});
		$("#searchResults").listview("refresh");
	});
}

function getUrlVars() {
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for (var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars;
}