// $Id: quote_table.js,v 1.1 2010/10/22 16:41:25 longwave Exp $

displayQuote = function (data) {
  var quoteDiv = $("#quote").empty()/* .append("<input type=\"hidden\" name=\"method-quoted\" value=\"" + details["method"] + "\" />") */;
  var numQuotes = 0;
  var errorFlag = true;
  var i;
  for (i in data) {
    if (data[i].rate != undefined || data[i].error || data[i].notes) {
      numQuotes++;
    }
  }

  var keys = [];
  for (i in data) {
    keys.push({key: i, rate: data[i].rate});
  }
  keys.sort(function(a, b) {
    if (a.rate == 0) a.rate = 9999;
    if (b.rate == 0) b.rate = 9999;
    return a.rate - b.rate
  });

  quoteDiv.append('<table></table>')
  for (key in keys) {
    i = keys[key].key;
    var item = '';
    var label = data[i].option_label;
    if (data[i].rate != undefined || data[i].error || data[i].notes) {

      if (data[i].rate != undefined) {
        if (numQuotes > 1 && page != 'cart') {
          item = "<input type=\"hidden\" name=\"rate[" + i + "]\" value=\"" + data[i].rate + "\" />"
            + "<label class=\"option\">"
            + "<input type=\"radio\" class=\"form-radio\" name=\"quote-option\" value=\"" + i + "\" />"
            + label + ":</td><td>" + data[i].format + "</label>";
        }
        else {
          item = "<input type=\"hidden\" name=\"quote-option\" value=\"" + i + "\" />"
            + "<input type=\"hidden\" name=\"rate[" + i + "]\" value=\"" + data[i].rate + "\" />"
            + "<label class=\"option\">" + label + ":</td><td>" + data[i].format + "</label>";
          if (page == "checkout") {
            if (label != "" && window.set_line_item) {
              set_line_item("shipping", label, data[i].rate, 1);
            }
          }
        }
      }
      if (data[i].error) {
        item += '<div class="quote-error">' + data[i].error + "</div>";
      }
      if (data[i].notes) {
        item += '<div class="quote-notes">' + data[i].notes + "</div>";
      }
      if (data[i].rate == undefined && item.length) {
        item = label + ': ' + item;
      }
      quoteDiv.find('table').append('<tr><td>' + item + "</td></tr>\n");
      Drupal.attachBehaviors(quoteDiv);
      if (page == "checkout") {
        // Choosing to use click because of IE's bloody stupid bug not to
        // trigger onChange until focus is lost. Click is better than doing
        // set_line_item() and getTax() twice, I believe.
        quoteDiv.find("input:radio[value=" + i +"]").click(function() {
          var i = $(this).val();
          if (window.set_line_item) {
            set_line_item("shipping", data[i].option_label, data[i].rate, 1, 1);
          }
        });
      }
    }
    if (data[i].debug != undefined) {
      quoteDiv.append("<pre>" + data[i].debug + "</pre>");
    }
  }
  if (quoteDiv.find("input").length == 0) {
    quoteDiv.append(Drupal.settings.uc_quote.err_msg);
  }
  else {
    quoteDiv.find("input:radio").eq(0).click().attr("checked", "checked");
    var quoteForm = quoteDiv.html();
    quoteDiv.append("<input type=\"hidden\" name=\"quote-form\" value=\"" + Drupal.encodeURIComponent(quoteForm) + "\" />");
  }

  /* if (page == "checkout") {
    if (window.getTax) {
      getTax();
    }
    else if (window.render_line_items) {
      render_line_items();
    }
  } */
}
