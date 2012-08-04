var p = new Array();

var fieldsID = {
	'id': ['product-', 'checkbox-', 'sku-', 'listprice-', 'cost-', 'sellprice-', 'shippable-', 'weight-', 'measurement-', 'length-', 'width-', 'height-', 'vid-']
}

Drupal.behaviors.addCheckboxEvent = function() {
    for (var i = 0; i < $('.td-checker input[type="checkbox"]').length; i++) {
        $('.td-checker input[type="checkbox"]:eq('+i+')').click(function() {
            if ($(this).attr('class') == 'checked') {
                $(this).removeClass('checked');
                fieldsID.nid = $(this).attr('id').replace(fieldsID.id[1], '');
                for(var i = 0; i < fieldsID.id.length; i++ ) {
                    $('input[type="text"]#' + fieldsID.id[i+2] + fieldsID.nid).attr("disabled", "disabled").removeClass('enabled');
                    $('#tr-' + fieldsID.nid).removeClass('selectedrow');
                }
            }
            else {
                $(this).addClass('checked');
                fieldsID.nid = $(this).attr('id').replace(fieldsID.id[1], '');
                for(var i = 0; i < fieldsID.id.length; i++) {
                    $('input[type="text"]#' + fieldsID.id[i+2] + fieldsID.nid).removeAttr("disabled").addClass('enabled');
                    $('#tr-' + fieldsID.nid).addClass('selectedrow');
                }
            }
        });
    }
    
    for (var i = 0; i < $('.shippable').length; i++) {
        $('.shippable:eq('+i+')').click(function() {
            if ($(this).val() == '1') {
                $(this).val('0');
            }
            else if ($(this).val() == '0') {
                $(this).val('1');
            }
        });
    }
}

Drupal.behaviors.addButtonEvent = function() {
    var a = new Array();
    $('#sc').click(function() {
        for(var i = 0; i < $('.td-checker input[type="checkbox"].checked').length; i++) {
            var Product = {};
						var x;
            Product.nid = $('.td-checker input[type="checkbox"].checked:eq('+i+')').attr('id').replace(fieldsID.id[1], '');
						for (x in fieldsID.id) {
              if($('#' + fieldsID.id[x] + Product.nid)) {
								fieldName = fieldsID.id[x].replace('-','');
	  						Product[fieldName] = $('#' + fieldsID.id[x] + Product.nid).val();
		  				}
						}
            p[i] = Product;
        }
        var obj = JSON.stringify(p);
        $.ajax({
            type : 'POST',
            url : '?q=price-editor/save',
            data : 'obj=' + obj,
            success : function(data) {
                window.location = window.location.href;
            }
        });
    });
    
    for (var i = 0; i < $('.filter').length; i++) {
        $('.filter:eq('+i+')').click(function() {
            var id = $(this).attr('id').replace('filter-', '');
            var q = $('#productcategoryterm-'+id+' option:selected').val();
            var newhref = $(this).attr('href') + '/' + q;
            if (q == 'none') {
                window.location = '/admin/store/products/price-editor';
            }
            else { $(this).attr('href', newhref); }
        });    
    }
}