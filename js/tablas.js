function cabecera(titulos) {  
  var headerRow = '';
  var bodyRows = '';
  $.each(titulos, function(i, item) {
    headerRow += '<th scope="col" id="' + item.name + '" class="text-center" ' + item.hidden + ' >   <a href="#">' + item.label + '<i class="arrow right"></i></a></th>';
  });
  return '<table id="bus_tabla" name="bus_tabla"><thead><tr>' + headerRow + '</tr></thead><tbody></tbody></table>';
}

function detalle(json, titulos) {
  var headerRow = '';
  var bodyRows = '';  
  $.each(json, function(i, row) {
    bodyRows += '<tr>';
    $.each(titulos, function(i, item) {       
      clase = '';
      if (typeof item.opciones !== 'undefined' && typeof item.opciones.atr !== 'undefined' && typeof item.opciones.atr.class !== 'undefined') {
        clase = item.opciones.atr.class;
      }
      bodyRows += '<td id="' + item.name + '" data-label="' + item.label + '" class="' + clase + '"  ' + item.hidden + ' >' + row[item.name] + '</td>';
    });
    bodyRows += '</tr>';
  });
  //console.log(bodyRows);
  return bodyRows;

}

function paginador(rowsShown = 5) {
$('#indicador').remove();
 var html = '<div id="indicador" class="flex-container"> \
     <div id="nav_indicador" class="col-50 col align-self-end"></div>\
     <div class="col-50 justify-content-end d-flex align-self-end"><div id="nav" class="pagination"></div></div>\
</div>';

    $('#bus_tabla').before(html);
   // var rowsShown = 5;
    var rowsTotal = $('#bus_tabla tbody tr:not(.d-none)').length;
    var numPages =Math.ceil(rowsTotal/rowsShown);
    var prev ='<a id="prev" class="link_disabled" name="prev" href="#"  aria-label="Anterior"><span aria-hidden="true">«</span></a>';
    $('#nav').append(prev);
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
    }
    var nextclass = (numPages > 1) ? "":"link_disabled"; 
    var next ='<a id="next" name="next"  class="'+ nextclass+ '" href="#" rel="1" aria-label="Siguiente"><span aria-hidden="true">»</span></a>';    
    $('#nav').append(next);
    $('#bus_tabla tbody tr').hide();
    $('#bus_tabla tbody tr').slice(0, rowsShown).show();
    $('#nav a[rel=0]').addClass('active');
    $('#nav a:gt(3)[name!="next"][name!="prev"]').hide();
    var itemFinal = (rowsTotal < rowsShown) ? rowsTotal:rowsShown; 
    var str = '<b>'+itemFinal+' registros (de 1 a '+ itemFinal+ ') de '+ rowsTotal+ ', pagina 1 de '+numPages+'</b>';
    $( "#nav_indicador" ).html( str );
    $('#nav a').bind('click', function(){

        $('#nav a').removeClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        var itemFinal = (endItem < rowsTotal) ? endItem:rowsTotal; 
        $('#bus_tabla tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','table-row').animate( { opacity:1 } , 300);
        var str = '<b>'+rowsShown+' registros (de '+(parseInt(startItem)+1)+' a '+itemFinal+') de '+ rowsTotal+ ', pagina '+(parseInt(currPage)+1)+' de '+numPages+'</b>';
        $( "#nav_indicador" ).html( str );
        $("#next").attr('rel', (parseInt(currPage)+1));
        $("#prev").attr('rel', (parseInt(currPage)-1));
        $('#nav a[rel='+currPage+']').addClass('active');
        $('#nav a').show();
      
        
        if (parseInt(currPage) < 1) {
          $("#prev").addClass('link_disabled')
        }   else{
          $("#prev").removeClass('link_disabled');
          $('#nav a:lt('+(parseInt(currPage)-1)+')[name!="next"][name!="prev"]').hide();
        } 
        if (parseInt(currPage) == (numPages-1)) {
          $("#next").addClass('link_disabled')
        }   else{
          $("#next").removeClass('link_disabled');
          $('#nav a:gt('+(parseInt(currPage)+3)+')[name!="next"][name!="prev"]').hide();
        } 

    });

}    

function filterItems(query, arr) {
  const search = query;
  const res = arr.filter(obj => Object.values(obj).some(val => val!==null && val.toLowerCase().includes(search.toLowerCase())));
  return res;
}

function sortBy(inputData, key) {
  // Sort our data based on the given key
  inputData.sort(function(a, b) {
    var aVal = a[key],
      bVal = b[key];       
    if(!isNaN(aVal) && !isNaN(bVal) ){      
       return aVal - bVal;
    }    
    if (aVal == bVal) return 0;
    return aVal > bVal ? 1 : -1;
  });
  return inputData;
}


function ordenarDesc(p_array_json, p_key, order) {
  sortBy(p_array_json, p_key);
  if (order == 1) p_array_json.reverse();
}

function editarRow(ctl) {
  var $row = $(ctl).closest("tr"); // Find the row
  var $tabla =  $('ctl').closest('table');
  $('tr').removeClass("table-warning");
  $.each($row, function() {   
    var td = $row.children("td");
    $.each(td, function() {
       var id = $(this).attr("id");
       $("#" +id + "").val($.trim($(this).text())).trigger("input");

    });
  });
  $row.attr("class","table-warning");
   $("#delitem").prop('disabled', false); 
   $("#additem").prop('value', 'Modificar'); 
}

function eliminarRow(ctl) {
  var $row = $(ctl).closest("tr"); // Find the row
  $row.remove();
}



(function( $ ) {
  'use strict';

  $.fn.tableToJSON = function(opts) {

    // Set options
    var defaults = {
      ignoreColumns: [],
      onlyColumns: null,
      ignoreHiddenRows: true,
      ignoreEmptyRows: false,
      headings: null,
      allowHTML: false,
      includeRowId: false,
      textDataOverride: 'data-override',
      extractor: null,
      textExtractor: null
    };
    opts = $.extend(defaults, opts);

    var notNull = function(value) {
      return value !== undefined && value !== null;
    };
    
    var notEmpty = function(value) {
      return value !== undefined && value.length > 0;
    };
    
    var ignoredColumn = function(index) {
      if( notNull(opts.onlyColumns) ) {
        return $.inArray(index, opts.onlyColumns) === -1;
      }
      return $.inArray(index, opts.ignoreColumns) !== -1;
    };

    var arraysToHash = function(keys, values) {
      var result = {}, index = 0;
      $.each(values, function(i, value) {
        // when ignoring columns, the header option still starts
        // with the first defined column
        if ( index < keys.length && notNull(value) ) {
          if (notEmpty(keys[index])){
            result[ keys[index] ] = value;
          }
          index++;
        }
      });
      return result;
    };

    var cellValues = function(cellIndex, cell, isHeader) {
      var $cell = $(cell),
        // extractor
        extractor = opts.extractor || opts.textExtractor,
        override = $cell.attr(opts.textDataOverride),
        value;
      // don't use extractor for header cells
      if ( extractor === null || isHeader ) {
        return $.trim( override || ( opts.allowHTML ? $cell.html() : cell.textContent || $cell.text() ) || '' );
      } else {
        // overall extractor function
        if ( $.isFunction(extractor) ) {
          value = override || extractor(cellIndex, $cell);
          return typeof value === 'string' ? $.trim( value ) : value;
        } else if ( typeof extractor === 'object' && $.isFunction( extractor[cellIndex] ) ) {
          value = override || extractor[cellIndex](cellIndex, $cell);
          return typeof value === 'string' ? $.trim( value ) : value;
        }
      }
      // fallback
      return $.trim( override || ( opts.allowHTML ? $cell.html() : cell.textContent || $cell.text() ) || '' );
    };

    var rowValues = function(row, isHeader) {
      var result = [];
      var includeRowId = opts.includeRowId;
      var useRowId = (typeof includeRowId === 'boolean') ? includeRowId : (typeof includeRowId === 'string') ? true : false;
      var rowIdName = (typeof includeRowId === 'string') === true ? includeRowId : 'rowId';
      if (useRowId) {
        if (typeof $(row).attr('id') === 'undefined') {
          result.push(rowIdName);
        }
      }
      $(row).children('td,th').each(function(cellIndex, cell) {
        result.push( cellValues(cellIndex, cell, isHeader) );
      });
      return result;
    };

    var getHeadings = function(table) {
      var firstRow = table.find('tr:first').first();
      return notNull(opts.headings) ? opts.headings : rowValues(firstRow, true);
    };

    var construct = function(table, headings) {
      var i, j, len, len2, txt, $row, $cell,
        tmpArray = [], cellIndex = 0, result = [];
      table.children('tbody,*').children('tr').each(function(rowIndex, row) {
        if( rowIndex > 0 || notNull(opts.headings) ) {
          var includeRowId = opts.includeRowId;
          var useRowId = (typeof includeRowId === 'boolean') ? includeRowId : (typeof includeRowId === 'string') ? true : false;

          $row = $(row);

          var isEmpty = ($row.find('td').length === $row.find('td:empty').length) ? true : false;

          if( ( $row.is(':visible') || !$row.hasClass( "d-none" ) &&  !opts.ignoreHiddenRows ) && ( !isEmpty || !opts.ignoreEmptyRows ) && ( !$row.data('ignore') || $row.data('ignore') === 'false' ) ) {
            cellIndex = 0;
            if (!tmpArray[rowIndex]) {
              tmpArray[rowIndex] = [];
            }
            if (useRowId) {
              cellIndex = cellIndex + 1;
              if (typeof $row.attr('id') !== 'undefined') {
                tmpArray[rowIndex].push($row.attr('id'));
              } else {
                tmpArray[rowIndex].push('');
              }
            }

            $row.children().each(function(){
              $cell = $(this);
              // skip column if already defined
              while (tmpArray[rowIndex][cellIndex]) { cellIndex++; }

              // process rowspans
              if ($cell.filter('[rowspan]').length) {
                len = parseInt( $cell.attr('rowspan'), 10) - 1;
                txt = cellValues(cellIndex, $cell);
                for (i = 1; i <= len; i++) {
                  if (!tmpArray[rowIndex + i]) { tmpArray[rowIndex + i] = []; }
                  tmpArray[rowIndex + i][cellIndex] = txt;
                }
              }
              // process colspans
              if ($cell.filter('[colspan]').length) {
                len = parseInt( $cell.attr('colspan'), 10) - 1;
                txt = cellValues(cellIndex, $cell);
                for (i = 1; i <= len; i++) {
                  // cell has both col and row spans
                  if ($cell.filter('[rowspan]').length) {
                    len2 = parseInt( $cell.attr('rowspan'), 10);
                    for (j = 0; j < len2; j++) {
                      tmpArray[rowIndex + j][cellIndex + i] = txt;
                    }
                  } else {
                    tmpArray[rowIndex][cellIndex + i] = txt;
                  }
                }
              }

              txt = tmpArray[rowIndex][cellIndex] || cellValues(cellIndex, $cell);
              if (notNull(txt)) {
                tmpArray[rowIndex][cellIndex] = txt;
              }
              cellIndex++;
            });
          }
        }
      });
      $.each(tmpArray, function( i, row ){
        if (notNull(row)) {
          // remove ignoredColumns / add onlyColumns
          var newRow = notNull(opts.onlyColumns) || opts.ignoreColumns.length ?
            $.grep(row, function(v, index){ return !ignoredColumn(index); }) : row,

            // remove ignoredColumns / add onlyColumns if headings is not defined
            newHeadings = notNull(opts.headings) ? headings :
              $.grep(headings, function(v, index){ return !ignoredColumn(index); });

          txt = arraysToHash(newHeadings, newRow);
          result[result.length] = txt;
        }
      });
      return result;
    };

    // Run
    var headings = getHeadings(this);
    return construct(this, headings);
  };
})( jQuery );





