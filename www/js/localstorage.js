var mainTable = $('#table1').dataTable({
  "bStateSave": true,
  "stateSave": true,
  "bPaginate": false,
  "bLengthChange": false,
  "bFilter": false,
  "bInfo": false,
  "bAutoWidth": false
});

/*SELECT OPTION */
mainTable.on('click', 'tbody tr', function() {
  $(this).toggleClass('selected');
});

$('#copyToTable2').on('click', function() {
  let $elem = $(this);
  var table = $("#table" + $elem.attr('id').replace(/[a-zA-Z]/ig, ''));
  var tbl_id = table.attr('id');

  var $row = mainTable.find(".selected");
  if (!$row.length) {
    console.log('You must select some rows to copy first');
    return;
  } else {
    var r = confirm("Copy to table " + tbl_id + "?");
    var table_to_copy = table.dataTable();
    if (r == true) {
      copyRows(mainTable, table_to_copy);
      console.log("Copied!");
      setTimeout('console.clear()', 2000);
    }
  }
});

/* FROM HERE SAVE ROW ================*/

function copyRows(fromTable, toTable) {
  var $row = fromTable.find(".selected"),
    storageName = 'dataSet_' + toTable.attr('id'), //added this line 
    dataSet = localStorage.getItem(storageName) ? JSON.parse(localStorage.getItem(storageName)): []; //added this line 

      $.each($row, function(k, v) {
        if (this !== null) {
          addRow = fromTable.fnGetData(this);
          toTable.fnAddData(addRow);
          dataSet.push(addRow); //added this line 
        }
      });

      localStorage.setItem(storageName, JSON.stringify(dataSet)); //added this line 
    }

  /* =============== TABLE 2 ================== */

  $('#table2').dataTable({
    "data": localStorage.getItem('dataSet_table2') ? JSON.parse(localStorage.getItem('dataSet_table2')) : [], //changed here
    "columns": [{
      "title": "First Name"
    }, {
      "title": "Last Name"
    }, {
      "title": "Action"
    }],
    "bStateSave": true,
    "stateSave": true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    "bAutoWidth": false
  });

  
